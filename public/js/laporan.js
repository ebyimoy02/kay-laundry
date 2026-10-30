
document.addEventListener('DOMContentLoaded', function () {
    const mulaiDisplay = document.getElementById('tanggal_mulai_display');
    const mulaiISO = document.getElementById('tanggal_mulai');
    const selesaiDisplay = document.getElementById('tanggal_selesai_display');
    const selesaiISO = document.getElementById('tanggal_selesai');
    const form = document.querySelector('.laporan-filter');

    if (
        typeof flatpickr !== 'function' ||
        !mulaiDisplay || !mulaiISO ||
        !selesaiDisplay || !selesaiISO || !form
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

        const date = new Date(parts[0], parts[1] - 1, parts[2]);

        return Number.isNaN(date.getTime()) ? null : date;
    }

    const today = new Date();
    const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);

    if (!mulaiISO.value) {
        mulaiISO.value = formatISO(firstDay);
    }

    if (!selesaiISO.value) {
        selesaiISO.value = formatISO(today);
    }

    const localeIndonesia = flatpickr.l10ns.id || 'default';

    function syncDisplay(date, display, hidden) {
        if (date) {
            display.value = flatpickr.formatDate(date, 'd/m/Y');
            hidden.value = formatISO(date);
        }
    }

    const kalenderMulai = flatpickr(mulaiDisplay, {
        locale: localeIndonesia,
        dateFormat: 'd/m/Y',
        defaultDate: parseISO(mulaiISO.value),
        disableMobile: true,
        onChange: function (dates) {
            if (!dates.length) return;

            syncDisplay(dates[0], mulaiDisplay, mulaiISO);
            kalenderSelesai.set('minDate', dates[0]);
        }
    });

    const kalenderSelesai = flatpickr(selesaiDisplay, {
        locale: localeIndonesia,
        dateFormat: 'd/m/Y',
        defaultDate: parseISO(selesaiISO.value),
        minDate: parseISO(mulaiISO.value),
        disableMobile: true,
        onChange: function (dates) {
            if (!dates.length) return;

            syncDisplay(dates[0], selesaiDisplay, selesaiISO);
            kalenderMulai.set('maxDate', dates[0]);
        }
    });

    syncDisplay(parseISO(mulaiISO.value), mulaiDisplay, mulaiISO);
    syncDisplay(parseISO(selesaiISO.value), selesaiDisplay, selesaiISO);

    form.addEventListener('submit', function (event) {
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
