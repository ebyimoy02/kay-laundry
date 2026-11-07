document.addEventListener('DOMContentLoaded', function () {

    // ==================================================
    // ELEMEN FILTER PERIODE
    // ==================================================

    const form = document.querySelector('.laporan-filter');
    const periodeSelect = document.getElementById('periode_laporan');

    const tanggalAcuan = document.getElementById('tanggal_acuan');
    const bulanLaporan = document.getElementById('bulan_laporan');
    const tahunLaporan = document.getElementById('tahun_laporan');

    const mulaiDisplay = document.getElementById('tanggal_mulai_display');
    const mulaiISO = document.getElementById('tanggal_mulai');

    const selesaiDisplay = document.getElementById('tanggal_selesai_display');
    const selesaiISO = document.getElementById('tanggal_selesai');

    if (!form || !periodeSelect) {
        return;
    }

    // ==================================================
    // TAMPILKAN INPUT SESUAI PERIODE
    // ==================================================

    function aturTampilanPeriode() {
        const periode = periodeSelect.value;

        if (tanggalAcuan) {
            tanggalAcuan.style.display =
                periode === 'mingguan' ? '' : 'none';
        }

        if (bulanLaporan) {
            bulanLaporan.style.display =
                periode === 'bulanan' ? '' : 'none';
        }

        if (tahunLaporan) {
            tahunLaporan.style.display =
                periode === 'tahunan' ? '' : 'none';
        }

        if (mulaiDisplay) {
            mulaiDisplay.style.display =
                periode === 'rentang' ? '' : 'none';
        }

        if (selesaiDisplay) {
            selesaiDisplay.style.display =
                periode === 'rentang' ? '' : 'none';
        }
    }

    periodeSelect.addEventListener('change', aturTampilanPeriode);

    aturTampilanPeriode();

    // ==================================================
    // KALENDER RENTANG TANGGAL
    // ==================================================

    if (
        typeof flatpickr !== 'function' ||
        !mulaiDisplay ||
        !mulaiISO ||
        !selesaiDisplay ||
        !selesaiISO
    ) {
        return;
    }

    function formatISO(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');

        return `${year}-${month}-${day}`;
    }

    function parseISO(value) {
        if (!value) return null;

        const parts = value.split('-').map(Number);

        if (parts.length !== 3) return null;

        const date = new Date(
            parts[0],
            parts[1] - 1,
            parts[2]
        );

        return Number.isNaN(date.getTime()) ? null : date;
    }

    const localeIndonesia = flatpickr.l10ns.id || 'default';

    function syncDisplay(date, display, hidden) {
        if (date) {
            display.value = flatpickr.formatDate(date, 'd/m/Y');
            hidden.value = formatISO(date);
        }
    }

    let kalenderMulai;
    let kalenderSelesai;

    kalenderMulai = flatpickr(mulaiDisplay, {
        locale: localeIndonesia,
        dateFormat: 'd/m/Y',
        defaultDate: parseISO(mulaiISO.value),
        disableMobile: true,

        onChange: function (dates) {
            if (!dates.length) return;

            syncDisplay(dates[0], mulaiDisplay, mulaiISO);

            if (kalenderSelesai) {
                kalenderSelesai.set('minDate', dates[0]);
            }
        }
    });

    kalenderSelesai = flatpickr(selesaiDisplay, {
        locale: localeIndonesia,
        dateFormat: 'd/m/Y',
        defaultDate: parseISO(selesaiISO.value),
        minDate: parseISO(mulaiISO.value),
        disableMobile: true,

        onChange: function (dates) {
            if (!dates.length) return;

            syncDisplay(dates[0], selesaiDisplay, selesaiISO);

            if (kalenderMulai) {
                kalenderMulai.set('maxDate', dates[0]);
            }
        }
    });

    syncDisplay(
        parseISO(mulaiISO.value),
        mulaiDisplay,
        mulaiISO
    );

    syncDisplay(
        parseISO(selesaiISO.value),
        selesaiDisplay,
        selesaiISO
    );

    // ==================================================
    // VALIDASI FORM
    // ==================================================

    form.addEventListener('submit', function (event) {

        if (periodeSelect.value !== 'rentang') {
            return;
        }

        if (!mulaiISO.value || !selesaiISO.value) {
            event.preventDefault();

            alert('Silakan pilih tanggal awal dan tanggal akhir.');

            return;
        }

        if (mulaiISO.value > selesaiISO.value) {
            event.preventDefault();

            alert('Tanggal awal tidak boleh melewati tanggal akhir.');
        }
    });

});