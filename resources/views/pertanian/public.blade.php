@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <div class="max-w-6xl mx-auto space-y-10">

        {{-- 🌾 Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-10 rounded-3xl shadow-lg text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Data Pertanian Desa Mojomanis</h1>
            <p class="text-yellow-100 mt-2 text-sm md:text-base">
                Data koordinat lahan, jenis tanaman, dan dokumentasi kegiatan pertanian masyarakat Desa Mojomanis
            </p>
        </div>

        {{-- 🔍 Filter & Search --}}
        <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Tahun --}}
            <div class="flex items-center gap-3 w-full md:w-auto">
                <label class="text-gray-600 font-medium">Tahun</label>
                <select id="filterTahun"
                        class="border border-gray-300 rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-400">
                    <option value="">Semua</option>
                    @foreach($data->pluck('tahun')->unique()->sortDesc() as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Dusun --}}
            <div class="flex items-center gap-3 w-full md:w-auto">
                <label class="text-gray-600 font-medium">Dusun</label>
                <select id="filterDusun"
                        class="border border-gray-300 rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-400">
                    <option value="">Semua</option>
                    @foreach($data->pluck('dusun')->unique()->sort() as $dusun)
                        <option value="{{ $dusun }}">{{ ucfirst($dusun) }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Search --}}
            <div class="relative w-full md:w-1/2">
                <input type="text" id="searchInput" placeholder="Cari jenis tanaman..."
                       class="border border-gray-300 rounded-xl w-full px-4 py-2 pl-10 focus:ring-2 focus:ring-blue-400">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>

        </div>

        {{-- 📊 Tabel Data --}}
        <div class="bg-white p-6 rounded-3xl shadow-lg overflow-x-auto">
            <table id="pertanianTable" class="w-full border-collapse text-sm text-gray-700">
                <thead>
                    <tr class="bg-blue-100 text-gray-800 text-center font-bold uppercase">
                        <th class="border px-4 py-3">No</th>
                        <th class="border px-4 py-3">Dusun</th>
                        <th class="border px-4 py-3">RT</th>
                        <th class="border px-4 py-3">Tahun</th>
                        <th class="border px-4 py-3">Jenis Tanaman</th>
                        <th class="border px-4 py-3">Koordinat</th>
                        <th class="border px-4 py-3">Foto</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $row)
                    <tr class="hover:bg-blue-50 transition duration-200">
                        <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2 text-center">{{ $row->dusun }}</td>
                        <td class="border px-4 py-2 text-center">{{ $row->rt }}</td>
                        <td class="border px-4 py-2 text-center">{{ $row->tahun }}</td>
                        <td class="border px-4 py-2">{{ $row->jenis_tanaman }}</td>

                        {{-- 🌍 Tombol Lihat Lokasi --}}
<td class="border px-4 py-2 text-center">
    @if($row->koordinat)
        <a href="https://www.google.com/maps?q={{ $row->koordinat }}"
           target="_blank"
           class="inline-block bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow hover:bg-blue-700 transition">
            Lihat Lokasi
        </a>
    @else
        <span class="text-gray-400 italic">Tidak ada</span>
    @endif
</td>




                        {{-- 📷 Foto --}}
                        <td class="border px-4 py-2 text-center">
                            @if($row->foto)
                                <img src="{{ asset('storage/'.$row->foto) }}"
                                    onclick="showImage('{{ asset('storage/'.$row->foto) }}')"
                                    class="w-16 h-16 object-cover rounded-lg mx-auto cursor-pointer hover:scale-110 transition">
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500 italic">
                            Belum ada data pertanian tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

{{-- 🌾 Lightbox --}}
<div id="lightbox"
     class="fixed inset-0 bg-black bg-opacity-90 hidden items-center justify-center z-50"
     onclick="closeLightbox(event)">

    {{-- ❌ Tombol Close --}}
    <button onclick="closeLightbox(event)"
            class="absolute top-6 right-8 text-white hover:text-red-400 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <img id="lightbox-img"
         class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-2xl transform scale-95 opacity-0 transition duration-300 ease-out">
</div>

<script>
function showImage(src) {
    const modal = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');
    img.src = src;

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        img.classList.remove('scale-95', 'opacity-0');
        img.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeLightbox(event) {
    const modal = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');

    if (event.target.id === 'lightbox-img') return;

    img.classList.remove('scale-100', 'opacity-100');
    img.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}
</script>

<script>
// =======================
//  FILTER FIX (WORK 100%)
// =======================
const filterTahun = document.getElementById('filterTahun');
const filterDusun = document.getElementById('filterDusun');
const searchInput = document.getElementById('searchInput');

filterTahun.addEventListener('change', applyFilter);
filterDusun.addEventListener('change', applyFilter);
searchInput.addEventListener('keyup', applyFilter);

function applyFilter() {
    let tahun = filterTahun.value.toLowerCase();
    let dusun = filterDusun.value.toLowerCase();
    let search = searchInput.value.toLowerCase();

    document.querySelectorAll('#pertanianTable tbody tr').forEach(row => {

        let colDusun = row.children[1].innerText.toLowerCase();      // kolom dusun
        let colRT = row.children[2].innerText.toLowerCase();         // kolom RT (ga dipakai filter tapi tetap disimpan)
        let colTahun = row.children[3].innerText.toLowerCase();      // kolom tahun
        let colTanaman = row.children[4].innerText.toLowerCase();    // kolom jenis tanaman

        let match =
            (tahun === "" || colTahun.includes(tahun)) &&
            (dusun === "" || colDusun.includes(dusun)) &&
            (search === "" || colTanaman.includes(search));

        row.style.display = match ? "" : "none";
    });
}
</script>

@endsection
