@extends('layouts.master')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">🌾 Data Pertanian Desa Mojomanis</h2>

    {{-- Tombol Tambah Data --}}
    <a href="{{ route('admin.pertanian.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
       ➕ Tambah Data
    </a>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mt-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Data --}}
    <table class="w-full mt-4 border text-sm text-left shadow-md rounded overflow-hidden">
        <thead class="bg-blue-100 text-blue-800">
    <tr>
        <th class="p-2 border text-center">No</th>
        <th class="p-2 border">Dusun</th>
        <th class="p-2 border">RT</th>
        <th class="p-2 border">Tahun</th>
        <th class="p-2 border">Jenis Tanaman</th>
        <th class="p-2 border">Koordinat</th>
        <th class="p-2 border text-center">Foto</th>
        <th class="p-2 border text-center">Aksi</th>
    </tr>
</thead>
<tbody>
    @forelse ($data as $index => $item)
    <tr class="hover:bg-gray-50">
        <td class="p-2 border text-center">{{ $index + 1 }}</td>
        <td class="p-2 border">{{ $item->dusun }}</td>
        <td class="p-2 border">{{ $item->rt }}</td>
        <td class="p-2 border">{{ $item->tahun }}</td>
        <td class="p-2 border">{{ $item->jenis_tanaman }}</td>
        <td class="p-2 border text-green-700 font-semibold">{{ $item->koordinat ?? '-' }}</td>

        {{-- Foto --}}
        <td class="p-2 border text-center">
            @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}"
                     class="w-16 h-16 object-cover rounded-md mx-auto cursor-pointer hover:scale-110 transition"
                     onclick="showImage('{{ asset('storage/'.$item->foto) }}')">
            @else
                <span class="text-gray-400 italic">Tidak ada</span>
            @endif
        </td>

        {{-- Aksi --}}
        <td class="p-2 border text-center space-x-2">
            <a href="{{ route('admin.pertanian.edit', $item->id) }}"
               class="text-yellow-600 hover:text-yellow-800 font-semibold">Edit</a>

            <form action="{{ route('admin.pertanian.destroy', $item->id) }}" method="POST"
                  class="inline"
                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
            </form>
        </td>
    </tr>

    @empty
    <tr>
        <td colspan="8" class="text-center text-gray-500 py-3">
            Belum ada data pertanian
        </td>
    </tr>
    @endforelse
</tbody>
    </table>
</div>

{{-- 🌾 Lightbox Preview Foto --}}
<div id="lightbox"
     class="fixed inset-0 bg-black bg-opacity-90 hidden items-center justify-center z-50 transition-opacity duration-300"
     onclick="closeLightbox(event)">

    {{-- Tombol ❌ --}}
    <button onclick="closeLightbox(event)"
            class="absolute top-6 right-8 text-white hover:text-red-400 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    {{-- Gambar --}}
    <img id="lightbox-img"
         src=""
         class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-2xl transform scale-95 opacity-0 transition duration-300 ease-out">
</div>

{{-- Script Lightbox --}}
<script>
function showImage(src) {
    const lightbox = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');

    img.src = src;
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');

    // Animasi masuk
    setTimeout(() => {
        img.classList.remove('scale-95', 'opacity-0');
        img.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeLightbox(event) {
    const lightbox = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');

    // biar klik gambar gak nutup modal
    if (event.target.id === 'lightbox-img') return;

    img.classList.remove('scale-100', 'opacity-100');
    img.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        lightbox.classList.remove('flex');
        lightbox.classList.add('hidden');
    }, 200);
}
</script>
@endsection
