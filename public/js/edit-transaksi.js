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

            if (!selectPaket || !inputBerat) {
                return;
            }

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
    | PERBARUI INDEX ITEMS
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
    | ATUR TOMBOL HAPUS
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
    | EVENT PAKET: HITUNG DAN HAPUS
    |--------------------------------------------------------------------------
    */

    container.addEventListener('change', function (event) {
        if (event.target.matches('.paket-select')) {
            hitungTotal();
        }
    });

    container.addEventListener('input', function (event) {
        if (event.target.matches('.berat-input')) {
            hitungTotal();
        }
    });

    container.addEventListener('click', function (event) {
        const tombolHapus = event.target.closest('.btn-hapus-paket');

        if (!tombolHapus || !container.contains(tombolHapus)) {
            return;
        }

        const rows = container.querySelectorAll('.detail-paket-row');

        if (rows.length <= 1) {
            return;
        }

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
    | TAMBAH PAKET LAUNDRY
    |--------------------------------------------------------------------------
    */

    btnTambahPaket.addEventListener('click', function () {
        const barisPertama = container.querySelector('.detail-paket-row');

        if (!barisPertama) {
            return;
        }

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
    | INISIALISASI
    |--------------------------------------------------------------------------
    */

    perbaruiIndex();
    aturTombolHapus();
    hitungTotal();
});