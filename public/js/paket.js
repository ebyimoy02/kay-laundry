document.addEventListener('DOMContentLoaded', function () {

    // =====================================================
    // MODAL TAMBAH PAKET
    // =====================================================

    const openButton = document.getElementById('openTambahPaket');
    const modalTambah = document.getElementById('modalTambahPaket');
    const closeButton = document.getElementById('closeTambahPaket');
    const cancelButton = document.getElementById('cancelTambahPaket');

    if (openButton && modalTambah) {

        openButton.addEventListener('click', function () {
            modalTambah.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        if (closeButton) {
            closeButton.addEventListener('click', function () {
                modalTambah.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        if (cancelButton) {
            cancelButton.addEventListener('click', function () {
                modalTambah.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        modalTambah.addEventListener('click', function (event) {
            if (event.target === modalTambah) {
                modalTambah.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }


    // =====================================================
    // MODAL EDIT PAKET
    // =====================================================

    const modalEdit = document.getElementById('modalEditPaket');
    const formEdit = document.getElementById('formEditPaket');

    const closeEditButton = document.getElementById('closeEditPaket');
    const cancelEditButton = document.getElementById('cancelEditPaket');

    const editButtons = document.querySelectorAll('.btn-edit-paket');


    editButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const id = button.dataset.id;
            const nama = button.dataset.nama;
            const harga = button.dataset.harga;
            const satuan = button.dataset.satuan;


            const namaInput = document.getElementById('edit_nama_paket');
            const hargaInput = document.getElementById('edit_harga');
            const satuanInput = document.getElementById('edit_satuan');


            if (namaInput) {
                namaInput.value = nama;
            }

            if (hargaInput) {
                hargaInput.value = harga;
            }

            if (satuanInput) {
                satuanInput.value = satuan;
            }


            if (formEdit) {
                formEdit.action = '/paket/' + id;
            }


            if (modalEdit) {
                modalEdit.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

        });

    });


    // =====================================================
    // TUTUP MODAL EDIT
    // =====================================================

    if (closeEditButton && modalEdit) {

        closeEditButton.addEventListener('click', function () {

            modalEdit.classList.remove('active');
            document.body.style.overflow = '';

        });

    }


    if (cancelEditButton && modalEdit) {

        cancelEditButton.addEventListener('click', function () {

            modalEdit.classList.remove('active');
            document.body.style.overflow = '';

        });

    }


    if (modalEdit) {

        modalEdit.addEventListener('click', function (event) {

            if (event.target === modalEdit) {

                modalEdit.classList.remove('active');
                document.body.style.overflow = '';

            }

        });

    }


    // =====================================================
    // TOMBOL ESCAPE
    // =====================================================

    document.addEventListener('keydown', function (event) {

        if (event.key !== 'Escape') {
            return;
        }


        if (
            modalTambah &&
            modalTambah.classList.contains('active')
        ) {

            modalTambah.classList.remove('active');
            document.body.style.overflow = '';

        }


        if (
            modalEdit &&
            modalEdit.classList.contains('active')
        ) {

            modalEdit.classList.remove('active');
            document.body.style.overflow = '';

        }

    });

});