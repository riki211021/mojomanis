@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    {{-- Breadcrumb/Back --}}
    <a href="{{ route('home') }}" class="text-sm text-blue-600 hover:underline">
        ← Kembali ke Beranda
    </a>

    {{-- Judul --}}
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight mt-2">
        {{ $artikel->judul }}
    </h1>

    {{-- Subjudul --}}
    @if($artikel->subjudul)
        <blockquote class="mt-3 pl-4 border-l-4 border-blue-500 text-gray-600 italic bg-gray-50 rounded">
            {{ $artikel->subjudul }}
        </blockquote>
    @endif

    {{-- Meta --}}
    <div class="text-sm text-gray-500 mt-3 flex flex-wrap items-center gap-6">
        <span class="flex items-center gap-1">
            {{-- Calendar Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10m-12 9h14a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z"/>
            </svg>
            {{ $artikel->created_at->translatedFormat('d F Y') }}
        </span>

        <span class="flex items-center gap-1">
            {{-- User Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A9 9 0 1118.364 4.56 9 9 0 015.12 17.804zM12 12a3 3 0 100-6 3 3 0 000 6z"/>
            </svg>
            {{ $artikel->penulis }}
        </span>

        <span class="flex items-center gap-1">
            {{-- Eye Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            {{ $artikel->views }} kali dibaca
        </span>
    </div>

    {{-- Gambar Utama --}}
@if($artikel->gambar)
    <figure class="my-6">
        <div class="w-full rounded-xl overflow-hidden">
            <img src="{{ asset('uploads/'.$artikel->gambar) }}"
                 alt="Gambar {{ $artikel->judul }}"
                 class="w-full max-h-[650px] object-cover rounded-xl shadow-md cursor-pointer"
                 onclick="openLightbox('{{ asset('uploads/'.$artikel->gambar) }}')">
        </div>

        <figcaption class="text-sm text-gray-500 mt-2 text-center italic">
            Dokumentasi: {{ $artikel->penulis }} (klik gambar untuk memperbesar)
        </figcaption>
    </figure>
@endif



    {{-- Isi --}}
    <article class="prose prose-blue max-w-none text-gray-800 leading-relaxed text-lg">
        {!! nl2br(e($artikel->isi)) !!}
    </article>

{{-- GALERI FOTO TAMBAHAN --}}
@if($artikel->photos->count())
    <div class="mt-10">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Galeri Foto Tambahan</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($artikel->photos as $p)

                <div class="rounded-xl overflow-hidden shadow-md bg-gray-100 cursor-pointer
                            hover:shadow-xl transition duration-300 group"
                     onclick="openLightbox('{{ asset('uploads/artikel_photos/'.$p->foto) }}')">

                    <img src="{{ asset('uploads/artikel_photos/'.$p->foto) }}"
                         class="w-full h-40 md:h-48 object-cover transform transition duration-300
                                group-hover:scale-105">
                </div>

            @endforeach
        </div>
    </div>
@endif



    {{-- Artikel Terkait --}}
    @if($related->count())
    <div class="mt-12">
        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Artikel Terkait</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($related as $rel)
            <div class="bg-white rounded-lg shadow hover:shadow-lg hover:scale-[1.02] transition overflow-hidden">
                {{-- Gambar --}}
                @if($rel->gambar)
                    <img src="{{ asset('uploads/'.$rel->gambar) }}" alt="{{ $rel->judul }}" class="w-full h-32 object-cover">
                @else
                    <div class="w-full h-32 bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                @endif
                {{-- Isi --}}
                <div class="p-3">
                    <h3 class="font-semibold text-black text-sm mb-2">
                        <a href="{{ route('artikel.show', $rel->id) }}" class="hover:text-blue-600 hover:underline">
                            {{ Str::limit($rel->judul, 60) }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-xs flex items-center gap-1">
                        {{-- Eye Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        {{ $rel->views }} kali dibaca
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Tombol Share --}}
    <div class="mt-8 flex flex-wrap items-center gap-4">
        <span class="text-gray-600">Bagikan:</span>

        {{-- Facebook --}}
<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
   target="_blank"
   class="flex items-center gap-2 text-blue-600 hover:text-blue-800 transition">
   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
       <path d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.5l-.4 3h-2.1v7A10 10 0 0022 12z"/>
   </svg>
   Facebook
</a>

{{-- Twitter --}}
<a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
   target="_blank"
   class="flex items-center gap-2 text-sky-500 hover:text-sky-700 transition">
   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
       <path d="M23 3a10.9 10.9 0 01-3.1 1.5 4.48 4.48 0 00-7.9 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.1-1z"/>
   </svg>
   Twitter
</a>

{{-- Telegram --}}
<a href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($artikel->judul) }}"
   target="_blank"
   class="flex items-center gap-2 text-blue-500 hover:text-blue-700 transition">
   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
       <path d="M9.999 15.17l-1.16 4.09c.166.046.34.07.518.07.26 0 .518-.064.75-.192l2.91-1.64 3.83 2.84c.26.194.59.303.92.303.27 0 .54-.063.785-.191.54-.29.86-.87.775-1.49l-1.37-9.78c-.09-.66-.6-1.19-1.26-1.28a1.29 1.29 0 00-1.09.27l-10.09 8.4c-.52.43-.68 1.16-.4 1.77.28.61.91.97 1.58.86l2.63-.5z"/>
   </svg>
   Telegram
</a>

{{-- WhatsApp --}}
<a href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}"
   target="_blank"
   class="flex items-center gap-2 text-green-600 hover:text-green-700 transition">
   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
       <path d="M16.7 15.1c-.3-.2-1.7-.9-1.9-1s-.4-.2-.6.2-.7 1-.9 1.2-.3.3-.6.1a7.8 7.8 0 01-2.3-1.4 8.5 8.5 0 01-1.6-2c-.2-.3 0-.5.2-.7s.4-.5.6-.7.3-.4.4-.6.1-.3 0-.5c0-.2-.6-1.5-.8-2s-.4-.5-.6-.5h-.5c-.2 0-.5.1-.7.3-.2.3-.9.9-.9 2.2s1 2.6 1.1 2.7a9.4 9.4 0 002.1 2.7c.8.7 1.6 1.1 2.2 1.4s1.1.4 1.5.2c.5-.2 1.7-.7 1.9-1s.3-.4.2-.6z"/>
   </svg>
   WhatsApp
</a>

{{-- Email --}}
<a href="mailto:?subject={{ urlencode($artikel->judul) }}&body={{ urlencode(request()->fullUrl()) }}"
   class="flex items-center gap-2 text-red-600 hover:text-red-800 transition">
   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
       <path d="M12 13.065L0 6V4h24v2l-12 7.065zm0 2.935l12-7V20H0V9l12 7z"/>
   </svg>
   Email
</a>

{{-- Cetak Artikel --}}
<button onclick="window.print()"
        class="flex items-center gap-2 text-gray-700 hover:text-black transition no-print">
   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
       <path stroke-linecap="round" stroke-linejoin="round"
             d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-4 0h-4v4h4v-4z"/>
   </svg>
   Cetak Artikel
</button>


    {{-- Tambahkan CSS ini sekali saja --}}
    @push('styles')
    <style>
    @media print {
        body * { visibility: hidden; }          /* Semua disembunyikan */
        .artikel-print, .artikel-print * { visibility: visible; } /* Artikel tetap kelihatan */
        .artikel-print { position: absolute; top: 0; left: 0; width: 100%; }
        .no-print { display: none !important; } /* Tombol, sidebar, dll hilang */
    }
    </style>
    @endpush

    {{-- Optional: tombol edit/hapus --}}
    @auth
    <div class="mt-6 flex gap-2">
        <a href="{{ route('artikel.edit', $artikel->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
        <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('Yakin hapus artikel ini?')">
            @csrf @method('DELETE')
            <button class="bg-red-600 text-white px-4 py-2 rounded">Hapus</button>
        </form>
    </div>
    @endauth
</div>

{{-- Lightbox FULLSCREEN MODERN TANPA FRAME --}}
<div id="lightbox"
     class="fixed inset-0 bg-black/90 hidden items-center justify-center z-[9999] backdrop-blur-sm"
     onclick="closeLightbox(event)">

    {{-- Tombol Tutup --}}
    <button onclick="closeLightbox(event)"
            class="absolute top-6 right-6 bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-full text-lg backdrop-blur-md transition">
        ✕ Tutup
    </button>

    {{-- Gambar --}}
    <img id="lightbox-img"
         src=""
         class="max-h-[90vh] max-w-[90vw] object-contain rounded-xl shadow-2xl scale-95 opacity-0 transition duration-300 ease-out">
</div>

<script>
function openLightbox(src) {
    const box = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');

    img.src = src;
    box.classList.remove('hidden');
    box.classList.add('flex');

    setTimeout(() => {
        img.classList.remove('scale-95', 'opacity-0');
        img.classList.add('scale-100', 'opacity-100');
    }, 20);
}

function closeLightbox(event) {
    if (event.target.id === 'lightbox-img') return; // biar klik gambar tidak menutup

    const box = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');

    img.classList.remove('scale-100', 'opacity-100');
    img.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        box.classList.remove('flex');
        box.classList.add('hidden');
    }, 200);
}
</script>
@endsection
