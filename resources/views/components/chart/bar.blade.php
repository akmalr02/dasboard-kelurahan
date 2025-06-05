{{-- @props(['id', 'title', 'labels' => [], 'data' => [], 'color' => '#3b82f6'])

<div class="w-full p-4 bg-white rounded-xl shadow-md" data-chart data-chart-id="{{ $id }}"
    data-chart-labels='@json($labels)' data-chart-data='@json($data)'
    data-chart-color="{{ $color }}" data-chart-title="{{ $title }}">
    <h2 class="text-lg font-semibold mb-2">{{ $title }}</h2>
    <canvas id="{{ $id }}" class="w-full h-64"></canvas>
</div>

@props(['id', 'title', 'labels' => [], 'datasets' => []])

<div class="w-full p-4 bg-white rounded-xl shadow-md">
    <h2 class="text-lg font-semibold mb-2">{{ $title }}</h2>
    <canvas id="{{ $id }}" class="w-full h-64"></canvas>

    <script type="module">
        import Chart from 'chart.js/auto';
        const ctx = document.getElementById('{{ $id }}');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: {!! json_encode($datasets) !!}
                },
                options: {
                    responsive: true,
                    indexAxis: 'y',
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
</div> --}}
