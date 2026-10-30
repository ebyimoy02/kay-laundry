document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       MODAL TAMBAH PELANGGAN
    ====================================================== */

    const modalTambah = document.getElementById('modalTambahPelanggan');
    const openTambahButton = document.getElementById('openTambahPelanggan');
    const closeTambahButton = document.getElementById('closeTambahPelanggan');
    const cancelTambahButton = document.getElementById('cancelTambahPelanggan');

    function openModalTambah() {
        if (!modalTambah) return;

        modalTambah.classList.add('active');
        document.body.style.overflow = 'hidden';

        const namaInput = document.getElementById('modal_nama');

        if (namaInput) {
            setTimeout(function () {
                namaInput.focus();
            }, 200);
        }
    }

    function closeModalTambah() {
        if (!modalTambah) return;

        modalTambah.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (openTambahButton) {
        openTambahButton.addEventListener('click', openModalTambah);
    }

    if (closeTambahButton) {
        closeTambahButton.addEventListener('click', closeModalTambah);
    }

    if (cancelTambahButton) {
        cancelTambahButton.addEventListener('click', closeModalTambah);
    }

    if (modalTambah) {
        modalTambah.addEventListener('click', function (event) {
            if (event.target === modalTambah) {
                closeModalTambah();
            }
        });
    }


    /* =====================================================
       MODAL EDIT PELANGGAN
    ====================================================== */

    const modalEdit = document.getElementById('modalEditPelanggan');
    const formEdit = document.getElementById('formEditPelanggan');
    const closeEditButton = document.getElementById('closeEditPelanggan');
    const cancelEditButton = document.getElementById('cancelEditPelanggan');

    const editButtons = document.querySelectorAll('.btn-edit-pelanggan');

    function openModalEdit(button) {
        if (!modalEdit || !formEdit) return;

        const id = button.dataset.id;
        const nama = button.dataset.nama;
        const noHp = button.dataset.noHp;
        const alamat = button.dataset.alamat;

        const namaInput = document.getElementById('edit_nama');
        const noHpInput = document.getElementById('edit_no_hp');
        const alamatInput = document.getElementById('edit_alamat');

        if (namaInput) namaInput.value = nama;
        if (noHpInput) noHpInput.value = noHp;
        if (alamatInput) alamatInput.value = alamat;

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
        if (!modalEdit) return;

        modalEdit.classList.remove('active');
        document.body.style.overflow = '';
    }

    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            openModalEdit(button);
        });
    });

    if (closeEditButton) {
        closeEditButton.addEventListener('click', closeModalEdit);
    }

    if (cancelEditButton) {
        cancelEditButton.addEventListener('click', closeModalEdit);
    }

    if (modalEdit) {
        modalEdit.addEventListener('click', function (event) {
            if (event.target === modalEdit) {
                closeModalEdit();
            }
        });
    }


    /* =====================================================
       MODAL KONFIRMASI HAPUS PELANGGAN
    ====================================================== */

    const modalHapus = document.getElementById('modalHapus');
    const formHapus = document.getElementById('formHapusPelanggan');
    const namaPelangganHapus = document.getElementById('namaPelangganHapus');
    const batalHapusButton = document.getElementById('batalHapusPelanggan');

    const hapusButtons = document.querySelectorAll('.btn-hapus-pelanggan');

    function openModalHapus(button) {
        if (!modalHapus || !formHapus) return;

        const urlHapus = button.dataset.url;
        const namaPelanggan = button.dataset.nama || 'pelanggan ini';

        if (!urlHapus) return;

        formHapus.action = urlHapus;

        if (namaPelangganHapus) {
            namaPelangganHapus.textContent = namaPelanggan;
        }

        modalHapus.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModalHapus() {
        if (!modalHapus) return;

        modalHapus.classList.remove('active');
        document.body.style.overflow = '';
    }

    hapusButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            openModalHapus(button);
        });
    });

    if (batalHapusButton) {
        batalHapusButton.addEventListener('click', closeModalHapus);
    }

    if (modalHapus) {
        modalHapus.addEventListener('click', function (event) {
            if (event.target === modalHapus) {
                closeModalHapus();
            }
        });
    }


    /* =====================================================
       SEARCH PELANGGAN
       Pencarian diproses oleh Laravel melalui form GET.
       Tidak memfilter baris tabel secara langsung.
    ====================================================== */

    const searchPelanggan = document.getElementById('searchPelanggan');

    if (searchPelanggan) {
        searchPelanggan.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();

                const searchForm = searchPelanggan.closest('form');

                if (searchForm) {
                    searchForm.submit();
                }
            }
        });
    }


    /* =====================================================
       TOMBOL ESCAPE UNTUK MENUTUP MODAL
    ====================================================== */

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') return;

        if (modalTambah && modalTambah.classList.contains('active')) {
            closeModalTambah();
        }

        if (modalEdit && modalEdit.classList.contains('active')) {
            closeModalEdit();
        }

        if (modalHapus && modalHapus.classList.contains('active')) {
            closeModalHapus();
        }
    });

});