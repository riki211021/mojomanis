@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <div class="max-w-6xl mx-auto space-y-10">

        {{-- Header (Disamakan dengan Produk Hukum) --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-10 rounded-3xl shadow-lg text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Informasi Publik Desa Mojomanis</h1>
            <p class="text-yellow-100 mt-2 text-sm md:text-base">
                Dokumen, laporan, dan pengumuman resmi dari Pemerintah Desa Mojomanis
            </p>
        </div>

        {{-- Filter & Search (Struktur identik dengan Produk Hukum) --}}
        <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3 w-full md:w-auto">
                <label for="filterTahun" class="text-gray-600 font-medium">Tahun</label>
                <select id="filterTahun"
                        class="border border-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 w-full md:w-40">
                    <option value="">Semua</option>
                    @foreach($data->pluck('tahun')->unique()->sortDesc() as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <label for="filterKategori" class="text-gray-600 font-medium">Kategori</label>
                <select id="filterKategori"
                        class="border border-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 w-full md:w-52">
                    <option value="">Semua</option>
                    @foreach($data->pluck('kategori')->unique()->sort() as $kategori)
                        <option value="{{ $kategori }}">{{ ucfirst($kategori) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="relative w-full md:w-1/2">
                <input type="text" id="searchInput" placeholder="Cari judul informasi publik..."
                       class="border border-gray-300 rounded-xl w-full px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>

        {{-- Table (juga diseragamkan tampilannya) --}}
        <div class="bg-white p-6 rounded-3xl shadow-lg overflow-x-auto">
            <table id="informasiTable" class="w-full border-collapse text-sm text-gray-700">
                <thead>
                    <tr class="bg-yellow-100 text-gray-800 text-center font-bold uppercase">
                        <th class="border px-4 py-3 w-12">No</th>
                        <th class="border px-4 py-3 text-left">Judul Informasi</th>
                        <th class="border px-4 py-3 w-32">Kategori</th>
                        <th class="border px-4 py-3 w-24">Tahun</th>
                        <th class="border px-4 py-3 w-32">Tanggal Upload</th>
                        <th class="border px-4 py-3 w-32">File</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                    <tr class="hover:bg-yellow-50 transition duration-200">
                        <td class="border px-4 py-2 text-center font-semibold text-gray-800">
                            {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                        </td>
                        <td class="border px-4 py-2">{{ $row->judul }}</td>
                        <td class="border px-4 py-2 text-center capitalize">{{ $row->kategori ?? '-' }}</td>
                        <td class="border px-4 py-2 text-center">{{ $row->tahun ?? '-' }}</td>
                        <td class="border px-4 py-2 text-center text-gray-700">
                            {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d F Y') }}
                        </td>
                        <td class="border px-4 py-2 text-center">
                            @if($row->file)
                                <a href="{{ asset('storage/'.$row->file) }}"
   download
   class="inline-flex items-center gap-1 bg-blue-600 text-white px-3 py-1.5 rounded-lg shadow hover:bg-blue-700 transition">
    <i class="fas fa-download"></i> Unduh File
</a>


                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500 italic">
                            Belum ada informasi publik yang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-6 flex justify-center">
                {{ $data->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>

{{-- JS Filter & Search --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tahunFilter = document.getElementById('filterTahun');
    const kategoriFilter = document.getElementById('filterKategori');
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('#informasiTable tbody tr');

    function filterTable() {
        const tahun = tahunFilter.value.toLowerCase();
        const kategori = kategoriFilter.value.toLowerCase();
        const search = searchInput.value.toLowerCase();

        rows.forEach(row => {
            const tahunText = row.children[3].innerText.toLowerCase();
            const kategoriText = row.children[2].innerText.toLowerCase();
            const judulText = row.children[1].innerText.toLowerCase();

            const matchTahun = !tahun || tahunText.includes(tahun);
            const matchKategori = !kategori || kategoriText.includes(kategori);
            const matchSearch = judulText.includes(search);

            row.style.display = matchTahun && matchKategori && matchSearch ? '' : 'none';
        });
    }

    tahunFilter.addEventListener('change', filterTable);
    kategoriFilter.addEventListener('change', filterTable);
    searchInput.addEventListener('input', filterTable);
});
</script>
@endsection
