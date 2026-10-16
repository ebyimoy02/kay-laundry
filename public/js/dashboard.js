/* =========================================================
   dashboard.js
   Simpan di: public/js/dashboard.js
   Membaca window.dashboardChartData (dari @json($grafik ?? []))
   lalu menggambar grafik batang di <canvas id="incomeChart">.
   ========================================================= */
(function () {
    'use strict';

    var BAR_COLOR = '#2f80e6';
    var GRID_COLOR = '#e3ecf8';
    var TEXT_COLOR = '#4a5568';

    // Nama kunci yang dikenali bila $grafik berupa array of object.
    var LABEL_KEYS = ['label', 'tanggal', 'date', 'hari', 'x'];
    var VALUE_KEYS = ['total', 'pendapatan', 'jumlah', 'value', 'y', 'nominal', 'total_pendapatan'];

    function pick(obj, keys) {
        for (var i = 0; i < keys.length; i++) {
            if (obj[keys[i]] !== undefined && obj[keys[i]] !== null) {
                return obj[keys[i]];
            }
        }
        return undefined;
    }

    // "2026-06-10" -> "10 Jun"; teks lain dibiarkan apa adanya.
    function formatLabel(label) {
        var text = String(label);
        if (/^\d{4}-\d{2}-\d{2}/.test(text)) {
            var d = new Date(text.slice(0, 10) + 'T00:00:00');
            if (!isNaN(d.getTime())) {
                return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
            }
        }
        return text;
    }

    // Aman untuk number, "150000.00" (decimal dari DB), dan "1.500.000".
    function toNumber(value) {
        if (typeof value === 'number') {
            return isFinite(value) ? value : 0;
        }
        var text = String(value === undefined || value === null ? '' : value).trim();
        if (/^-?\d+(\.\d+)?$/.test(text)) {
            return parseFloat(text);
        }
        var digits = text.replace(/[^\d-]/g, '');
        var n = parseInt(digits, 10);
        return isNaN(n) ? 0 : n;
    }

    // Ubah berbagai bentuk data menjadi { labels: [], values: [] }.
    function normalize(raw) {
        var labels = [];
        var values = [];

        if (!raw) {
            return { labels: labels, values: values };
        }

        if (Array.isArray(raw)) {
            raw.forEach(function (item, i) {
                if (item !== null && typeof item === 'object') {
                    var l = pick(item, LABEL_KEYS);
                    labels.push(formatLabel(l !== undefined ? l : i + 1));
                    values.push(toNumber(pick(item, VALUE_KEYS)));
                } else {
                    labels.push(String(i + 1));
                    values.push(toNumber(item));
                }
            });
        } else if (typeof raw === 'object') {
            if (Array.isArray(raw.labels)) {
                var series = raw.data || raw.values || raw.totals || [];
                raw.labels.forEach(function (l, i) {
                    labels.push(formatLabel(l));
                    values.push(toNumber(series[i]));
                });
            } else {
                Object.keys(raw).forEach(function (key) {
                    labels.push(formatLabel(key));
                    values.push(toNumber(raw[key]));
                });
            }
        }

        return { labels: labels, values: values };
    }

    // Bila belum ada data: tampilkan 7 hari terakhir dengan nilai 0.
    function emptyWeek() {
        var labels = [];
        var values = [];
        for (var i = 6; i >= 0; i--) {
            var d = new Date();
            d.setDate(d.getDate() - i);
            labels.push(d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }));
            values.push(0);
        }
        return { labels: labels, values: values };
    }

    function formatNumber(n) {
        return Number(n).toLocaleString('id-ID');
    }

    function init() {
        var canvas = document.getElementById('incomeChart');
        if (!canvas || typeof Chart === 'undefined') {
            return;
        }

        var data = normalize(window.dashboardChartData);
        if (!data.labels.length) {
            data = emptyWeek();
        }

        var allZero = data.values.every(function (v) { return v === 0; });

        Chart.defaults.font.family = "'Roboto', 'Segoe UI', sans-serif";
        Chart.defaults.font.size = 13;
        Chart.defaults.color = TEXT_COLOR;

        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: data.values,
                    backgroundColor: BAR_COLOR,
                    hoverBackgroundColor: '#1f6fd6',
                    borderRadius: 0,           // ujung batang lurus seperti Figma
                    barPercentage: 0.5,
                    categoryPercentage: 0.8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,    // wajib agar tinggi .chart-container (300px) dipakai
                plugins: {
                    legend: { display: false }, // legend sudah ada di HTML (.chart-legend)
                    tooltip: {
                        displayColors: false,
                        callbacks: {
                            label: function (ctx) {
                                return 'Pendapatan: Rp ' + formatNumber(ctx.parsed.y);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { color: GRID_COLOR }
                    },
                    y: {
                        beginAtZero: true,
                        suggestedMax: allZero ? 1000000 : undefined,
                        grid: { color: GRID_COLOR },
                        border: { display: false },
                        ticks: {
                            padding: 8,
                            callback: function (value) {
                                return formatNumber(value);
                            }
                        }
                    }
                }
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();