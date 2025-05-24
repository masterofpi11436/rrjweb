<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Avg. Duration per Jurisdiction</h2>

    <select wire:model="range" class="mb-4 p-2 rounded border dark:bg-gray-800">
        <option value="7">Last 7 Days</option>
        <option value="30">Last 30 Days</option>
        <option value="90">Last 90 Days</option>
        <option value="all">All Time</option>
    </select>

    <canvas id="jurisdictionDurationChart" height="100"></canvas>

    <script>
        let chart;

        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('jurisdictionDurationChart').getContext('2d');

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Avg. Duration (minutes)',
                        data: @json($data),
                        backgroundColor: 'rgba(16, 185, 129, 0.6)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'x',
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Minutes'
                            }
                        }
                    }
                }
            });
        });

        window.addEventListener('updateChart', event => {
            chart.data.labels = event.detail.labels;
            chart.data.datasets[0].data = event.detail.data;
            chart.update();
        });
    </script>
</div>
