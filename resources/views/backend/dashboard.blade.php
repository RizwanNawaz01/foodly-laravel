@extends('layouts.admin')

@section('content')
    <livewire:admin.sidebar />
    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">

            <h2 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('Dashboard Overview') }}</h2>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ($stats as $stat)
                    <div
                        class="flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition-all rounded-xl shadow-sm p-5">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">{{ $stat['title'] }}</p>
                            <h3 class="text-2xl font-bold text-slate-800 mt-2">{{ $stat['value'] }}</h3>
                        </div>
                        <div class="w-12 h-12 flex items-center justify-center rounded-full text-white {{ $stat['color'] }}">
                            <i class="iconify" data-icon="{{ $stat['icon'] }}" data-width="24" data-height="24"></i>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Earnings Chart --}}
            <div class="mt-10">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">{{ __('Earnings (Last 7 Days)') }}</h3>

                <div class="bg-gray-50 rounded-xl p-6">
                    <canvas id="earningsChart"></canvas>
                </div>
            </div>

        </div>
    </div>
@endsection


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const chartData = @json($chart);

        const ctx = document.getElementById('earningsChart');

        console.log(chartData);
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.map(c => c.date),
                datasets: [{
                    label: '{{ __('Earnings') }}',
                    data: chartData.map(c => c.total),
                    borderWidth: 2,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

    });
</script>
