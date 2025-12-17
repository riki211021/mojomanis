@extends('layouts.master')

@section('content')
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Form Pencarian --}}
<form method="GET" action="{{ route('home') }}" class="mb-6 flex gap-2">
    <input type="text" name="q" value="{{ request('q') }}"
           placeholder="Cari artikel..."
           class="w-1/2 border rounded p-2 focus:outline-none focus:ring focus:ring-blue-300">
    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Cari
    </button>
</form>

@forelse($artikels as $artikel)
<div class="flex flex-col sm:flex-row gap-4 mb-6 bg-white rounded-lg shadow hover:shadow-md transition p-4">

    {{-- Thumbnail --}}
    @if($artikel->gambar)
        <div class="w-full sm:w-40 h-48 sm:h-28 flex-shrink-0">
            <img src="{{ asset('uploads/'.$artikel->gambar) }}"
                 alt="Thumbnail {{ $artikel->judul }}"
                 class="w-full h-full rounded-lg object-cover cursor-pointer hover:opacity-90 transition"
                 data-img="{{ asset('uploads/'.$artikel->gambar) }}"
                 onclick="openLightbox(this.dataset.img)">
        </div>
    @else
        <div class="w-full sm:w-40 h-48 sm:h-28 flex items-center justify-center bg-gray-200 rounded-lg text-gray-500">
            No Image
        </div>
    @endif

    {{-- Isi Artikel --}}
    <div class="flex-1">
        <h3 class="font-bold text-lg text-black mb-1 leading-snug">
            <a href="{{ route('artikel.show', $artikel->id) }}"
               class="hover:text-blue-700 hover:underline">
                {{ $artikel->judul }}
            </a>
        </h3>

        {{-- Meta Info --}}
        <div class="text-sm text-gray-500 flex flex-wrap items-center gap-4 mb-2">

            {{-- Tanggal --}}
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10m-12 9h14a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                </svg>
                {{ $artikel->created_at->translatedFormat('d F Y') }}
            </span>

            {{-- Penulis --}}
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A9 9 0 1118.364 4.56 9 9 0 015.12 17.804zM12 12a3 3 0 100-6 3 3 0 000 6z"/>
                </svg>
                {{ $artikel->penulis }}
            </span>

            {{-- Views --}}
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                {{ $artikel->views }} kali dilihat
            </span>

        </div>

        {{-- Cuplikan isi --}}
        <p class="text-gray-700 leading-relaxed text-sm">
            {{ Str::limit($artikel->isi, 120) }}
        </p>
    </div>

</div>
@empty
<p class="text-gray-600">Belum ada artikel.</p>
@endforelse


{{-- Pagination --}}
<div class="mt-6">
    {{ $artikels->appends(['q' => request('q')])->links() }}
</div>

{{-- Lightbox --}}
<div id="lightbox"
     class="fixed inset-0 bg-black bg-opacity-90 hidden items-center justify-center z-50 transition-opacity duration-300"
     onclick="closeLightbox(event)">

    {{-- Tombol Close --}}
    <button onclick="closeLightbox(event)"
            class="absolute top-6 right-8 text-white hover:text-red-400 transition">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    {{-- Gambar --}}
    <img id="lightbox-img"
         src=""
         class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-2xl transform scale-95 opacity-0 transition duration-300 ease-out">
</div>

<script>
function openLightbox(src) {
    const lightbox = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');

    img.src = src;
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');

    setTimeout(() => {
        img.classList.remove('scale-95', 'opacity-0');
        img.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeLightbox(event) {
    if (event.target.id === 'lightbox-img') return; // klik gambar biar gak nutup

    const lightbox = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');

    img.classList.remove('scale-100', 'opacity-100');
    img.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        lightbox.classList.remove('flex');
        lightbox.classList.add('hidden');
    }, 200);
}
</script>

@endsection
