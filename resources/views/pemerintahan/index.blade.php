@extends('layouts.master')

@section('content')
<div class="bg-gray-50">

   {{-- Hero Section Modern (seragam dengan UMKM) --}}
<div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-10 rounded-3xl shadow-lg text-center">
  <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
    Pemerintahan {{ $pemerintahan->judul ?? 'Desa Mojomanis' }}
  </h1>
  <p class="text-green-100 mt-2 text-sm md:text-base">
    Mengenal visi, misi, dan struktur organisasi Pemerintahan Desa Mojomanis
  </p>
</div>


        {{-- Visi & Misi --}}
<div class="grid md:grid-cols-2 gap-8">

   {{-- Visi --}}
@if(!empty($data->visi))
<div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition border-l-8 border-green-500 relative">
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-green-100 text-green-600 p-4 rounded-full">
            <i data-lucide="target" class="w-7 h-7"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Visi</h2>
    </div>
    <div class="overflow-hidden max-h-40 text-gray-700 text-lg leading-relaxed transition-all duration-500" id="visi-content">
        <blockquote class="italic">{!! nl2br(e($data->visi)) !!}</blockquote>
    </div>
    <button onclick="toggleContent('visi')"
            class="mt-3 text-blue-600 hover:text-blue-800 font-semibold text-sm">
        Lihat Selengkapnya
    </button>
</div>
@endif

{{-- Misi --}}
@if(!empty($data->misi))
<div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition border-l-8 border-purple-500 relative">
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-purple-100 text-purple-600 p-4 rounded-full">
            <i data-lucide="list-checks" class="w-7 h-7"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Misi</h2>
    </div>
    <div class="overflow-hidden max-h-40 text-gray-700 text-lg leading-relaxed transition-all duration-500" id="misi-content">
        {!! nl2br(e($data->misi)) !!}
    </div>
    <button onclick="toggleContent('misi')"
            class="mt-3 text-blue-600 hover:text-blue-800 font-semibold text-sm">
        Lihat Selengkapnya
    </button>
</div>
@endif

<script>
function toggleContent(type) {
    const content = document.getElementById(type + '-content');
    const button = event.target;

    if (content.classList.contains('max-h-40')) {
        content.classList.remove('max-h-40');
        content.classList.add('max-h-full');
        button.textContent = "Tutup";
    } else {
        content.classList.add('max-h-40');
        content.classList.remove('max-h-full');
        button.textContent = "Lihat Selengkapnya";
    }
}
</script>




   {{-- Struktur Organisasi --}}
@if(!empty($data->struktur_foto))
<div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition col-span-2">
    <div class="flex items-center gap-3 mb-4">
        <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
            <i data-lucide="sitemap" class="w-6 h-6"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Struktur Organisasi Pemerintahan Desa</h2>
    </div>
    <div class="rounded-xl overflow-hidden shadow-md flex justify-center">
        <img src="{{ asset('storage/'.$data->struktur_foto) }}"
             alt="Struktur Organisasi"
             class="w-full max-h-[700px] object-contain cursor-pointer hover:opacity-90 transition"
             onclick="openLightbox(this.src)">
    </div>
    <p class="text-sm text-gray-500 mt-2 text-center italic">
        Klik gambar untuk memperbesar, scroll untuk zoom, drag untuk geser
    </p>
</div>
@endif



{{-- Lightbox --}}
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 hidden items-center justify-center z-50">
    <button onclick="closeLightbox(event)" class="absolute top-6 right-8 text-white hover:text-red-400 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <div class="w-full h-full flex justify-center items-center p-4 overflow-auto">
        <img id="lightbox-img" src=""
             class="rounded-lg shadow-2xl transition-transform duration-200 ease-out cursor-grab max-w-full max-h-full object-contain">
    </div>
</div>

{{-- Script --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();

    let zoomLevel = 1;
    let isDragging = false;
    let startX, startY, scrollLeft, scrollTop;

    function openLightbox(src) {
        const lightbox = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        img.src = src;
        zoomLevel = 1;
        img.style.transform = `scale(${zoomLevel})`;
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
    }

    function closeLightbox(event) {
        if (event.target.id === 'lightbox-img') return;
        document.getElementById('lightbox').classList.add('hidden');
    }

    // Zoom pakai scroll mouse
    document.getElementById('lightbox').addEventListener('wheel', function(e) {
        e.preventDefault();
        const img = document.getElementById('lightbox-img');
        if (e.deltaY < 0) {
            zoomLevel += 0.1;
        } else {
            zoomLevel = Math.max(0.5, zoomLevel - 0.1);
        }
        img.style.transform = `scale(${zoomLevel})`;
    });

    // Drag to pan
    const lightboxContainer = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');

    img.addEventListener('mousedown', (e) => {
        isDragging = true;
        img.style.cursor = "grabbing";
        startX = e.pageX - lightboxContainer.offsetLeft;
        startY = e.pageY - lightboxContainer.offsetTop;
        scrollLeft = lightboxContainer.scrollLeft;
        scrollTop = lightboxContainer.scrollTop;
    });

    img.addEventListener('mouseup', () => {
        isDragging = false;
        img.style.cursor = "grab";
    });

    img.addEventListener('mouseleave', () => {
        isDragging = false;
        img.style.cursor = "grab";
    });

    img.addEventListener('mousemove', (e) => {
        if(!isDragging) return;
        e.preventDefault();
        const x = e.pageX - lightboxContainer.offsetLeft;
        const y = e.pageY - lightboxContainer.offsetTop;
        const walkX = (x - startX);
        const walkY = (y - startY);
        lightboxContainer.scrollLeft = scrollLeft - walkX;
        lightboxContainer.scrollTop = scrollTop - walkY;
    });
</script>



@endsection
