document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       MODAL TAMBAH PELANGGAN
    ====================================================== */

    const modalTambah = document.getElementById(
        'modalTambahPelanggan'
    );

    const openTambahButton = document.getElementById(
        'openTambahPelanggan'
    );

    const closeTambahButton = document.getElementById(
        'closeTambahPelanggan'
    );

    const cancelTambahButton = document.getElementById(
        'cancelTambahPelanggan'
    );


    function openModalTambah() {

        if (!modalTambah) {
            return;
        }


        modalTambah.classList.add('active');

        document.body.style.overflow = 'hidden';


        const namaInput = document.getElementById(
            'modal_nama'
        );


        if (namaInput) {

            setTimeout(function () {

                namaInput.focus();

            }, 200);

        }

    }


    function closeModalTambah() {

        if (!modalTambah) {
            return;
        }


        modalTambah.classList.remove('active');

        document.body.style.overflow = '';

    }


    if (openTambahButton) {

        openTambahButton.addEventListener(
            'click',
            function () {

                openModalTambah();

            }
        );

    }


    if (closeTambahButton) {

        closeTambahButton.addEventListener(
            'click',
            function () {

                closeModalTambah();

            }
        );

    }


    if (cancelTambahButton) {

        cancelTambahButton.addEventListener(
            'click',
            function () {

                closeModalTambah();

            }
        );

    }


    if (modalTambah) {

        modalTambah.addEventListener(
            'click',
            function (event) {

                if (event.target === modalTambah) {

                    closeModalTambah();

                }

            }
        );

    }



    /* =====================================================
       MODAL EDIT PELANGGAN
    ====================================================== */

    const modalEdit = document.getElementById(
        'modalEditPelanggan'
    );

    const formEdit = document.getElementById(
        'formEditPelanggan'
    );

    const closeEditButton = document.getElementById(
        'closeEditPelanggan'
    );

    const cancelEditButton = document.getElementById(
        'cancelEditPelanggan'
    );

    const editButtons = document.querySelectorAll(
        '.btn-edit-pelanggan'
    );


    function openModalEdit(button) {

        if (!modalEdit || !formEdit) {
            return;
        }


        const id = button.dataset.id;

        const nama = button.dataset.nama;

        const noHp = button.dataset.noHp;

        const alamat = button.dataset.alamat;


        const namaInput = document.getElementById(
            'edit_nama'
        );

        const noHpInput = document.getElementById(
            'edit_no_hp'
        );

        const alamatInput = document.getElementById(
            'edit_alamat'
        );


        if (namaInput) {

            namaInput.value = nama;

        }


        if (noHpInput) {

            noHpInput.value = noHp;

        }


        if (alamatInput) {

            alamatInput.value = alamat;

        }


        formEdit.action = '/pelanggan/' + id;


        modalEdit.classList.add('active');

        document.body.style.overflow = 'hidden';


        if (namaInput) {

            setTimeout(function () {

                namaInput.focus();

            }, 200);

        }

    }


    function closeModalEdit() {

        if (!modalEdit) {
            return;
        }


        modalEdit.classList.remove('active');

        document.body.style.overflow = '';

    }


    /* =====================================================
       TOMBOL EDIT
    ====================================================== */

    editButtons.forEach(function (button) {

        button.addEventListener(
            'click',
            function () {

                openModalEdit(button);

            }
        );

    });



    /* =====================================================
       CLOSE MODAL EDIT
    ====================================================== */

    if (closeEditButton) {

        closeEditButton.addEventListener(
            'click',
            function () {

                closeModalEdit();

            }
        );

    }



    /* =====================================================
       BATAL EDIT
    ====================================================== */

    if (cancelEditButton) {

        cancelEditButton.addEventListener(
            'click',
            function () {

                closeModalEdit();

            }
        );

    }



    /* =====================================================
       KLIK LUAR MODAL EDIT
    ====================================================== */

    if (modalEdit) {

        modalEdit.addEventListener(
            'click',
            function (event) {

                if (event.target === modalEdit) {

                    closeModalEdit();

                }

            }
        );

    }



    /* =====================================================
       TOMBOL ESCAPE
    ====================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key !== 'Escape') {
                return;
            }


            if (
                modalTambah &&
                modalTambah.classList.contains('active')
            ) {

                closeModalTambah();

            }


            if (
                modalEdit &&
                modalEdit.classList.contains('active')
            ) {

                closeModalEdit();

            }

        }
    );

});