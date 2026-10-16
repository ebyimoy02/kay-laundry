document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | MODAL TAMBAH TRANSAKSI
    |--------------------------------------------------------------------------
    */

    const openButton = document.getElementById(
        'openTambahTransaksi'
    );

    const modal = document.getElementById(
        'modalTambahTransaksi'
    );

    const closeButton = document.getElementById(
        'closeTambahTransaksi'
    );

    const cancelButton = document.getElementById(
        'cancelTambahTransaksi'
    );


    /*
    |--------------------------------------------------------------------------
    | KALENDER TANGGAL INDONESIA
    |--------------------------------------------------------------------------
    */

    const tanggalDisplay = document.getElementById(
        'tgl_masuk'
    );

    const tanggalISO = document.getElementById(
        'tgl_masuk_iso'
    );

    let kalenderTanggal = null;

    if (
        tanggalDisplay &&
        tanggalISO &&
        typeof flatpickr === 'function'
    ) {

        function konversiTanggal(value) {

            const match = value.match(
                /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/
            );

            if (!match) {
                return null;
            }

            const hari = Number(match[1]);
            const bulan = Number(match[2]);
            const tahun = Number(match[3]);

            const tanggal = new Date(
                tahun,
                bulan - 1,
                hari
            );

            const valid =
                tanggal.getFullYear() === tahun &&
                tanggal.getMonth() === bulan - 1 &&
                tanggal.getDate() === hari;

            if (!valid) {
                return null;
            }

            return {
                hari: String(hari).padStart(2, '0'),
                bulan: String(bulan).padStart(2, '0'),
                tahun: String(tahun)
            };
        }


        kalenderTanggal = flatpickr(tanggalDisplay, {

            locale: flatpickr.l10ns.id || 'default',

            dateFormat: 'd/m/Y',

            allowInput: true,

            defaultDate: tanggalISO.value || null,

            onChange: function (selectedDates) {

                if (selectedDates.length === 0) {
                    tanggalISO.value = '';
                    return;
                }

                const tanggal = selectedDates[0];

                const tahun = tanggal.getFullYear();

                const bulan = String(
                    tanggal.getMonth() + 1
                ).padStart(2, '0');

                const hari = String(
                    tanggal.getDate()
                ).padStart(2, '0');

                tanggalISO.value =
                    `${tahun}-${bulan}-${hari}`;

                tanggalDisplay.setCustomValidity('');
            },

            onClose: function (selectedDates) {

                if (selectedDates.length > 0) {

                    const tanggal = selectedDates[0];

                    const tahun = tanggal.getFullYear();

                    const bulan = String(
                        tanggal.getMonth() + 1
                    ).padStart(2, '0');

                    const hari = String(
                        tanggal.getDate()
                    ).padStart(2, '0');

                    tanggalISO.value =
                        `${tahun}-${bulan}-${hari}`;

                    tanggalDisplay.setCustomValidity('');

                    return;
                }

                const hasil = konversiTanggal(
                    tanggalDisplay.value.trim()
                );

                if (hasil) {

                    tanggalISO.value =
                        `${hasil.tahun}-${hasil.bulan}-${hasil.hari}`;

                    tanggalDisplay.setCustomValidity('');

                } else {

                    tanggalISO.value = '';

                    tanggalDisplay.setCustomValidity(
                        'Masukkan tanggal yang valid dengan format dd/mm/yyyy.'
                    );
                }
            }
        });


        tanggalDisplay.addEventListener(
            'input',
            function () {

                const hasil = konversiTanggal(
                    tanggalDisplay.value.trim()
                );

                if (hasil) {

                    tanggalISO.value =
                        `${hasil.tahun}-${hasil.bulan}-${hasil.hari}`;

                    tanggalDisplay.setCustomValidity('');

                } else {

                    tanggalISO.value = '';

                    tanggalDisplay.setCustomValidity(
                        'Masukkan tanggal yang valid dengan format dd/mm/yyyy.'
                    );
                }
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | BUKA MODAL TAMBAH TRANSAKSI
    |--------------------------------------------------------------------------
    */

    
if (openButton && modal) {

    openButton.addEventListener('click', function () {

        // Atur tanggal sesuai tanggal hari ini.
        if (kalenderTanggal) {
            kalenderTanggal.setDate(new Date(), true);
        }

        modal.classList.add('active');

        document.body.style.overflow = 'hidden';
    });
}



    /*
    |--------------------------------------------------------------------------
    | TUTUP MODAL TAMBAH TRANSAKSI
    |--------------------------------------------------------------------------
    */

    function closeModal() {

        if (!modal) {
            return;
        }

        modal.classList.remove('active');

        document.body.style.overflow = '';
    }


    if (closeButton) {

        closeButton.addEventListener(
            'click',
            closeModal
        );
    }


    if (cancelButton) {

        cancelButton.addEventListener(
            'click',
            closeModal
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TUTUP MODAL TAMBAH KETIKA KLIK BACKDROP
    |--------------------------------------------------------------------------
    */

    if (modal) {

        modal.addEventListener(
            'click',
            function (event) {

                if (event.target === modal) {
                    closeModal();
                }
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MODAL KONFIRMASI HAPUS TRANSAKSI
    |--------------------------------------------------------------------------
    */

    const modalHapusTransaksi = document.getElementById(
        'modalHapusTransaksi'
    );

    const formHapusTransaksi = document.getElementById(
        'formHapusTransaksi'
    );

    const namaTransaksiHapus = document.getElementById(
        'namaTransaksiHapus'
    );

    const batalHapusTransaksi = document.getElementById(
        'batalHapusTransaksi'
    );

    const tombolHapusTransaksi = document.querySelectorAll(
        '.btn-hapus-transaksi'
    );


    /*
    |--------------------------------------------------------------------------
    | BUKA MODAL HAPUS
    |--------------------------------------------------------------------------
    */

    function bukaModalHapusTransaksi(button) {

        if (!modalHapusTransaksi || !formHapusTransaksi) {
            return;
        }

        const urlHapus = button.dataset.url;

        const namaPelanggan =
            button.dataset.nama || 'pelanggan ini';

        if (!urlHapus) {
            return;
        }

        formHapusTransaksi.action = urlHapus;

        if (namaTransaksiHapus) {

            namaTransaksiHapus.textContent =
                namaPelanggan;
        }

        modalHapusTransaksi.classList.add('active');

        document.body.style.overflow = 'hidden';
    }


    /*
    |--------------------------------------------------------------------------
    | TUTUP MODAL HAPUS
    |--------------------------------------------------------------------------
    */

    function tutupModalHapusTransaksi() {

        if (!modalHapusTransaksi) {
            return;
        }

        modalHapusTransaksi.classList.remove('active');

        document.body.style.overflow = '';
    }


    /*
    |--------------------------------------------------------------------------
    | EVENT TOMBOL HAPUS TRANSAKSI
    |--------------------------------------------------------------------------
    */

    tombolHapusTransaksi.forEach(function (button) {

        button.addEventListener('click', function () {

            bukaModalHapusTransaksi(button);
        });
    });


    /*
    |--------------------------------------------------------------------------
    | TOMBOL BATAL HAPUS
    |--------------------------------------------------------------------------
    */

    if (batalHapusTransaksi) {

        batalHapusTransaksi.addEventListener(
            'click',
            tutupModalHapusTransaksi
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TUTUP MODAL HAPUS KETIKA KLIK BACKDROP
    |--------------------------------------------------------------------------
    */

    if (modalHapusTransaksi) {

        modalHapusTransaksi.addEventListener(
            'click',
            function (event) {

                if (event.target === modalHapusTransaksi) {

                    tutupModalHapusTransaksi();
                }
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TUTUP MODAL DENGAN TOMBOL ESCAPE
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key !== 'Escape') {
                return;
            }

            if (
                modalHapusTransaksi &&
                modalHapusTransaksi.classList.contains('active')
            ) {

                tutupModalHapusTransaksi();

            } else if (
                modal &&
                modal.classList.contains('active')
            ) {

                closeModal();
            }
        }
    );


    /*
    |--------------------------------------------------------------------------
    | DETAIL PAKET
    |--------------------------------------------------------------------------
    */

    const container = document.getElementById(
        'detailPaketContainer'
    );

    const addPackageButton = document.getElementById(
        'btnTambahPaket'
    );

    const totalElement = document.getElementById(
        'totalTransaksi'
    );

    const totalInput = document.getElementById(
        'totalInput'
    );


    /*
    |--------------------------------------------------------------------------
    | FORMAT RUPIAH
    |--------------------------------------------------------------------------
    */

    function formatRupiah(value) {

        value = Number(value) || 0;

        return 'Rp ' + value.toLocaleString('id-ID');
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG SUBTOTAL DAN TOTAL
    |--------------------------------------------------------------------------
    */

    function calculateTotal() {

        if (!container) {
            return;
        }

        let total = 0;

        const rows = container.querySelectorAll(
            '.detail-paket-row'
        );

        rows.forEach(function (row) {

            const select = row.querySelector(
                '.paket-select'
            );

            const beratInput = row.querySelector(
                '.paket-berat'
            );

            const hargaInput = row.querySelector(
                '.paket-harga'
            );

            if (
                !select ||
                !beratInput ||
                !hargaInput
            ) {
                return;
            }

            const selectedOption =
                select.options[select.selectedIndex];

            const harga = selectedOption
                ? Number(selectedOption.dataset.harga) || 0
                : 0;

            const berat = Number(beratInput.value) || 0;

            const subtotal = harga * berat;

            /*
            | Harga otomatis
            */

            hargaInput.value = formatRupiah(harga);

            /*
            | Hitung total berdasarkan harga dan berat
            */

            total += subtotal;
        });


        /*
        | Tampilkan total
        */

        if (totalElement) {

            totalElement.textContent =
                formatRupiah(total);
        }


        /*
        | Simpan total ke hidden input
        */

        if (totalInput) {

            totalInput.value = total;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | EVENT PAKET DAN BERAT
    |--------------------------------------------------------------------------
    */

    function bindPackageEvents(row) {

        const select = row.querySelector(
            '.paket-select'
        );

        const beratInput = row.querySelector(
            '.paket-berat'
        );

        const deleteButton = row.querySelector(
            '.btn-hapus-paket'
        );


        if (select) {

            select.addEventListener(
                'change',
                calculateTotal
            );
        }


        if (beratInput) {

            beratInput.addEventListener(
                'input',
                calculateTotal
            );
        }


        if (deleteButton) {

            deleteButton.addEventListener(
                'click',
                function () {

                    row.remove();

                    updateInputNames();

                    updateDeleteButtons();

                    calculateTotal();
                }
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE TOMBOL HAPUS PAKET
    |--------------------------------------------------------------------------
    */

    function updateDeleteButtons() {

        if (!container) {
            return;
        }

        const rows = container.querySelectorAll(
            '.detail-paket-row'
        );

        rows.forEach(function (row) {

            const deleteButton = row.querySelector(
                '.btn-hapus-paket'
            );

            if (!deleteButton) {
                return;
            }

            deleteButton.disabled = rows.length === 1;
        });
    }


    /*
    |--------------------------------------------------------------------------
    | RENAME INPUT ITEMS
    |--------------------------------------------------------------------------
    */

    function updateInputNames() {

        if (!container) {
            return;
        }

        const rows = container.querySelectorAll(
            '.detail-paket-row'
        );

        rows.forEach(function (row, index) {

            const select = row.querySelector(
                '.paket-select'
            );

            const berat = row.querySelector(
                '.paket-berat'
            );

            if (select) {

                select.name =
                    'items[' + index + '][id_paket]';
            }

            if (berat) {

                berat.name =
                    'items[' + index + '][berat]';
            }

            row.dataset.row = index;
        });
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH BARIS PAKET
    |--------------------------------------------------------------------------
    */

    if (addPackageButton && container) {

        addPackageButton.addEventListener(
            'click',
            function () {

                const rows = container.querySelectorAll(
                    '.detail-paket-row'
                );

                const index = rows.length;

                const firstRow = rows[0];

                if (!firstRow) {
                    return;
                }

                const newRow = firstRow.cloneNode(true);


                /*
                | Bersihkan pilihan paket
                */

                const select = newRow.querySelector(
                    '.paket-select'
                );

                if (select) {
                    select.value = '';
                }


                /*
                | Bersihkan berat
                */

                const berat = newRow.querySelector(
                    '.paket-berat'
                );

                if (berat) {
                    berat.value = '';
                }


                /*
                | Reset harga
                */

                const harga = newRow.querySelector(
                    '.paket-harga'
                );

                if (harga) {
                    harga.value = 'Rp 0';
                }


                /*
                | Aktifkan tombol hapus
                */

                const deleteButton = newRow.querySelector(
                    '.btn-hapus-paket'
                );

                if (deleteButton) {
                    deleteButton.disabled = false;
                }


                newRow.dataset.row = index;

                container.appendChild(newRow);

                bindPackageEvents(newRow);

                updateInputNames();

                updateDeleteButtons();

                calculateTotal();
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | INISIALISASI BARIS PERTAMA
    |--------------------------------------------------------------------------
    */

    if (container) {

        const firstRow = container.querySelector(
            '.detail-paket-row'
        );

        if (firstRow) {

            bindPackageEvents(firstRow);
        }

        updateDeleteButtons();

        calculateTotal();
    }

});
