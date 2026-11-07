document.addEventListener('DOMContentLoaded', function () {
    const tombolCetak = document.getElementById('btnCetakTransaksi');

    if (tombolCetak) {
        tombolCetak.addEventListener('click', function () {
            window.print();
        });
    }
});