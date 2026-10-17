
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formEditTransaksi');
    const container = document.getElementById('detailPaketContainer');
    const btnTambahPaket = document.getElementById('btnTambahPaket');
    const totalTransaksi = document.getElementById('totalTransaksi');

    if (!form || !container || !btnTambahPaket || !totalTransaksi) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | TANGGAL MASUK OTOMATIS
    |--------------------------------------------------------------------------
    */

    const tanggalDisplay = document.getElementById('tgl_masuk_display');
    const tanggalISO = document.getElementById('tgl_masuk');

    if (tanggalDisplay && tanggalISO && typeof flatpickr === 'function') {

        function ubahKeISO(nilai) {
            const cocok = nilai.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);

            if (!cocok) return null;

            const hari = Number(cocok[1]);
            const bulan = Number(cocok[2]);
            const tahun = Number(cocok[3]);

            const tanggal = new Date(tahun, bulan - 1, hari);

            if (
                tanggal.getFullYear() !== tahun ||
                tanggal.getMonth() !== bulan - 1 ||
                tanggal.getDate() !== hari
            ) {
                return null;
            }

            return [
                tahun,
                String(bulan).padStart(2, '0'),
                String(hari).padStart(2, '0')
            ].join('-');
        }

        // Mengambil tanggal hari ini dari waktu lokal komputer
        const hariIni = new Date();
        const tahun = hariIni.getFullYear();
        const bulan = String(hariIni.getMonth() + 1).padStart(2, '0');
        const hari = String(hariIni.getDate()).padStart(2, '0');

        const tanggalHariIniISO = `${tahun}-${bulan}-${hari}`;

        flatpickr(tanggalDisplay, {
            locale: flatpickr.l10ns.id || 'default',
            dateFormat: 'd/m/Y',
            allowInput: true,
            defaultDate: tanggalHariIniISO,

        onReady: function (selectedDates, dateStr, instance) {
            tanggalISO.value = tanggalHariIniISO;
            instance.setDate(tanggalHariIniISO, true, 'Y-m-d');
        },

            onChange: function (tanggalTerpilih) {
                if (!tanggalTerpilih.length) {
                    tanggalISO.value = '';
                    return;
                }

                const tanggal = tanggalTerpilih[0];
                const tahun = tanggal.getFullYear();
                const bulan = String(tanggal.getMonth() + 1).padStart(2, '0');
                const hari = String(tanggal.getDate()).padStart(2, '0');

                tanggalISO.value = `${tahun}-${bulan}-${hari}`;
                tanggalDisplay.setCustomValidity('');
            }
        });

        // Memeriksa tanggal jika diketik secara manual
        tanggalDisplay.addEventListener('input', function () {
            const nilai = tanggalDisplay.value.trim();

            if (nilai === '') {
                tanggalISO.value = '';
                tanggalDisplay.setCustomValidity('');
                return;
            }

            const tanggalValid = ubahKeISO(nilai);

            if (tanggalValid) {
                tanggalISO.value = tanggalValid;
                tanggalDisplay.setCustomValidity('');
            } else {
                tanggalISO.value = '';
                tanggalDisplay.setCustomValidity(
                    'Masukkan tanggal yang valid dengan format dd/mm/yyyy.'
                );
            }
        });

        // Memeriksa tanggal sebelum formulir disimpan
        form.addEventListener('submit', function (event) {
            const tanggalValid = ubahKeISO(tanggalDisplay.value.trim());

            if (!tanggalValid) {
                event.preventDefault();

                tanggalDisplay.setCustomValidity(
                    'Masukkan tanggal yang valid dengan format dd/mm/yyyy.'
                );

                tanggalDisplay.reportValidity();
                return;
            }

            tanggalISO.value = tanggalValid;
            tanggalDisplay.setCustomValidity('');
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FORMAT RUPIAH
    |--------------------------------------------------------------------------
    */

    function formatRupiah(angka) {
        return 'Rp ' + Math.round(angka).toLocaleString('id-ID');
    }

    /*
    |--------------------------------------------------------------------------
    | HITUNG TOTAL TRANSAKSI
    |--------------------------------------------------------------------------
    */

    function hitungTotal() {
        let total = 0;

        container.querySelectorAll('.detail-paket-row').forEach(function (row) {
            const selectPaket = row.querySelector('.paket-select');
            const inputBerat = row.querySelector('.berat-input');
            const inputHarga = row.querySelector('.harga-paket');

            if (!selectPaket || !inputBerat) return;

            const option = selectPaket.options[selectPaket.selectedIndex];
            const harga = option ? Number(option.dataset.harga || 0) : 0;
            const berat = Number(inputBerat.value || 0);

            total += harga * berat;

            if (inputHarga) {
                inputHarga.value = formatRupiah(harga);
            }
        });

        totalTransaksi.value = formatRupiah(total);
    }

    /*
    |--------------------------------------------------------------------------
    | PERBARUI INDEX DETAIL PAKET
    |--------------------------------------------------------------------------
    */

    function perbaruiIndex() {
        container.querySelectorAll('.detail-paket-row').forEach(function (row, index) {
            const selectPaket = row.querySelector('.paket-select');
            const inputBerat = row.querySelector('.berat-input');

            if (selectPaket) {
                selectPaket.name = `items[${index}][id_paket]`;
            }

            if (inputBerat) {
                inputBerat.name = `items[${index}][berat]`;
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | ATUR TOMBOL HAPUS PAKET
    |--------------------------------------------------------------------------
    */

    function aturTombolHapus() {
        const rows = container.querySelectorAll('.detail-paket-row');

        rows.forEach(function (row) {
            const tombolHapus = row.querySelector('.btn-hapus-paket');

            if (tombolHapus) {
                tombolHapus.hidden = rows.length === 1;
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | PERUBAHAN PILIHAN PAKET
    |--------------------------------------------------------------------------
    */

    container.addEventListener('change', function (event) {
        if (event.target.matches('.paket-select')) {
            hitungTotal();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | PERUBAHAN BERAT PAKET
    |--------------------------------------------------------------------------
    */

    container.addEventListener('input', function (event) {
        if (event.target.matches('.berat-input')) {
            hitungTotal();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | HAPUS BARIS DETAIL PAKET
    |--------------------------------------------------------------------------
    */

    container.addEventListener('click', function (event) {
        const tombolHapus = event.target.closest('.btn-hapus-paket');

        if (!tombolHapus || !container.contains(tombolHapus)) return;

        const rows = container.querySelectorAll('.detail-paket-row');

        if (rows.length <= 1) return;

        const row = tombolHapus.closest('.detail-paket-row');

        if (row) {
            row.remove();
            perbaruiIndex();
            aturTombolHapus();
            hitungTotal();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | TAMBAH BARIS DETAIL PAKET
    |--------------------------------------------------------------------------
    */

    btnTambahPaket.addEventListener('click', function () {
        const barisPertama = container.querySelector('.detail-paket-row');

        if (!barisPertama) return;

        const barisBaru = barisPertama.cloneNode(true);

        const selectPaket = barisBaru.querySelector('.paket-select');
        const inputBerat = barisBaru.querySelector('.berat-input');
        const inputHarga = barisBaru.querySelector('.harga-paket');
        const tombolHapus = barisBaru.querySelector('.btn-hapus-paket');

        if (selectPaket) {
            selectPaket.selectedIndex = 0;
        }

        if (inputBerat) {
            inputBerat.value = '';
        }

        if (inputHarga) {
            inputHarga.value = formatRupiah(0);
        }

        if (tombolHapus) {
            tombolHapus.hidden = false;
        }

        container.appendChild(barisBaru);

        perbaruiIndex();
        aturTombolHapus();
        hitungTotal();
    });

    /*
    |--------------------------------------------------------------------------
    | INISIALISASI AWAL
    |--------------------------------------------------------------------------
    */

    perbaruiIndex();
    aturTombolHapus();
    hitungTotal();
});
