@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <div class="max-w-6xl mx-auto space-y-10">

        {{-- Hero --}}
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-8 rounded-2xl shadow-lg">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">
                Data Demografi Berdasar Jenis Kelamin
            </h1>
            <p class="text-blue-100">Statistik penduduk berdasarkan jenis kelamin di Desa Mojomanis</p>
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
            <div id="jenisKelaminChart"></div>
        </div>

        {{-- Table --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg overflow-x-auto">
            <table class="w-full border text-sm">
                <thead>
                    <tr class="bg-gray-200 text-center font-bold">
                        <th class="border px-4 py-2">Kode</th>
                        <th class="border px-4 py-2 text-left">Kelompok</th>
                        <th class="border px-4 py-2">Jumlah (n)</th>
                        <th class="border px-4 py-2">%</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $row->kode }}</td>
                            <td class="border px-4 py-2">{{ $row->kelompok }}</td>
                            <td class="border px-4 py-2 text-center">{{ $row->jumlah }}</td>
                            <td class="border px-4 py-2 text-center">
                                {{ $total > 0 ? number_format(($row->jumlah / $total) * 100, 2) : '0.00' }}%
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data jenis kelamin</td>
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

    function renderChart(type) {
        Highcharts.chart('jenisKelaminChart', {
            chart: { type: type === 'pie' ? 'pie' : 'column' },
            title: { text: 'Distribusi Jenis Kelamin' },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.2f}%)</b>'
            },
            plotOptions: {
                pie: {
                    innerSize: '50%',
                    dataLabels: { enabled: true, format: '{point.name}: {point.y}' }
                },
                column: {
                    dataLabels: { enabled: true }
                }
            },
            xAxis: type === 'column' ? { categories: chartData.map(d => d.name) } : undefined,
            yAxis: type === 'column' ? { title: { text: 'Jumlah' } } : undefined,
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: chartData
            }]
        });
    }

    renderChart('pie');
    document.getElementById('togglePie').addEventListener('click', () => renderChart('pie'));
    document.getElementById('toggleBar').addEventListener('click', () => renderChart('column'));
});
</script>
@endpush
