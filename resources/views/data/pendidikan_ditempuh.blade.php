@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <div class="max-w-6xl mx-auto space-y-10">

        {{-- Hero --}}
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-8 rounded-2xl shadow-lg">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">
                Data Pendidikan Sedang Ditempuh
            </h1>
            <p class="text-green-100">Statistik pendidikan sedang ditempuh di Desa Mojomanis</p>
        </div>

        {{-- Toggle Chart --}}
        <div class="flex justify-end gap-2">
            <button id="togglePie" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Pie Chart
            </button>
            <button id="toggleBar" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Bar Chart
            </button>
        </div>

        {{-- Charts --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <div id="pendidikanDitempuhChart"></div>
        </div>

        {{-- Tabel --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg overflow-x-auto">
            <table class="w-full border text-sm">
                <thead>
                    <tr class="bg-gray-200 text-center font-bold">
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2 text-left">Kelompok</th>
                        <th class="border px-4 py-2">Jumlah (n)</th>
                        <th class="border px-4 py-2">%</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $row->kelompok }}</td>
                            <td class="border px-4 py-2 text-center">{{ $row->jumlah }}</td>
                            <td class="border px-4 py-2 text-center">
                                {{ $total > 0 ? number_format(($row->jumlah / $total) * 100, 2) : '0.00' }}%
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data pendidikan ditempuh</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($total > 0)
                <tfoot>
                    <tr class="bg-gray-100 font-bold">
                        <td colspan="2" class="border px-4 py-2 text-right">TOTAL</td>
                        <td class="border px-4 py-2 text-center">{{ $total }}</td>
                        <td class="border px-4 py-2 text-center">100,00%</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const chartData = @json($chartData);

    if (!chartData || chartData.length === 0) {
        document.getElementById('pendidikanDitempuhChart').innerHTML =
            "<p class='text-center text-gray-500'>Belum ada data untuk ditampilkan</p>";
        return;
    }

    function renderChart(type) {
        Highcharts.chart('pendidikanDitempuhChart', {
            chart: {
                type: type === 'pie' ? 'pie' : 'column',
                height: 500, // ✅ bikin chart lebih tinggi
                style: { fontFamily: 'Inter, sans-serif' }
            },
            title: {
                text: 'Distribusi Pendidikan Sedang Ditempuh',
                style: { fontSize: '20px', fontWeight: 'bold' }
            },
            colors: [
                '#1E90FF', '#32CD32', '#FF8C00', '#8A2BE2', '#FF1493',
                '#20B2AA', '#FFD700', '#DC143C', '#708090', '#00CED1'
            ],
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.2f}%)</b>',
                style: { fontSize: '13px' }
            },
            plotOptions: {
                pie: {
                    innerSize: '40%', // donut lebih rapi
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y}',
                        style: { fontSize: '12px', fontWeight: 'bold' }
                    }
                },
                column: {
                    dataLabels: {
                        enabled: true,
                        style: { fontSize: '12px', fontWeight: 'bold' }
                    }
                }
            },
            xAxis: type === 'column' ? {
                categories: chartData.map(d => d.name),
                labels: { style: { fontSize: '12px' } }
            } : undefined,
            yAxis: type === 'column' ? {
                title: { text: 'Jumlah' },
                labels: { style: { fontSize: '12px' } }
            } : undefined,
            legend: {
                itemStyle: { fontSize: '12px' }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: chartData
            }]
        });
    }

    // Default: Pie Chart
    renderChart('pie');

    // Toggle buttons
    document.getElementById('togglePie').addEventListener('click', () => renderChart('pie'));
    document.getElementById('toggleBar').addEventListener('click', () => renderChart('column'));
});
</script>
@endpush

