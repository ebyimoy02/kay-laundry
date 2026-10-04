document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('incomeChart');

    if (!canvas) return;

    // Data dummy default jika database belum berisi transaksi
    let labels = ['10 Jun', '11 Jun', '12 Jun', '13 Jun', '14 Jun', '15 Jun', '16 Jun'];
    let values = [400000, 450000, 500000, 650000, 750000, 800000, 1000000];

    if (window.dashboardChartData && window.dashboardChartData.length > 0) {
        labels = [];
        values = [];
        window.dashboardChartData.forEach(function (item) {
            labels.push(item.tanggal || item.label || '');
            values.push(Number(item.total || 0));
        });
    }

    new Chart(canvas, {
        type: 'bar',

        data: {
            labels: labels,

            datasets: [{
                label: 'Pendapatan',
                data: values,
                backgroundColor: '#3B82F6',
                borderRadius: 4,
                barThickness: 32
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return 'Rp ' + Number(context.raw).toLocaleString('id-ID');
                        }
                    }
                }
            },

            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#64748B',
                        font: { size: 12 }
                    }
                },
                y: {
                    beginAtZero: true,
                    max: 1250000,
                    ticks: {
                        stepSize: 250000,
                        color: '#64748B',
                        font: { size: 12 },
                        callback: function (value) {
                            return value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        color: '#F1F5F9'
                    }
                }
            }
        }
    });

});