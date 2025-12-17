@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-6">
  <div class="max-w-6xl mx-auto space-y-8">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-10 rounded-3xl shadow-lg text-center">
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">UMKM Desa Mojomanis</h1>
      <p class="text-green-100 mt-2 text-sm md:text-base">
        Galeri usaha mikro, kecil, dan menengah yang ada di Desa Mojomanis
      </p>
    </div>

    {{-- Galeri UMKM --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse($data as $item)
      <a href="{{ route('data.umkm.show', $item->id) }}"
         class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-1 duration-300 block">

        {{-- Foto --}}
        @if($item->foto)
          <img src="{{ asset('storage/'.$item->foto) }}"
               alt="Foto {{ $item->nama_usaha }}"
               class="w-full h-48 object-cover">
        @else
          <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
            Tidak ada foto
          </div>
        @endif

        {{-- Konten --}}
        <div class="p-4">
          <h3 class="text-lg font-bold text-gray-800">{{ $item->nama_usaha }}</h3>

          <p class="text-sm text-gray-600">Pemilik: {{ $item->pemilik ?? '-' }}</p>
          <p class="text-sm text-gray-600 mt-1">Kategori: {{ $item->kategori ?? '-' }}</p>

          {{-- Deskripsi singkat --}}
          <p class="text-gray-700 mt-3 text-sm leading-relaxed">
            {{ Str::limit($item->deskripsi, 100, '...') }}
          </p>

          <p class="mt-3 text-blue-600 font-semibold text-sm hover:underline">
            Lihat selengkapnya →
          </p>
        </div>
      </a>

      @empty
      <div class="col-span-full text-center py-10 text-gray-500">
        Belum ada data UMKM yang tersedia.
      </div>
      @endforelse
    </div>

  </div>
</div>
@endsection
