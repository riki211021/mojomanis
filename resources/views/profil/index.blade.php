@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen pb-16">

    {{-- Hero Banner --}}
    <section class="bg-gradient-to-r from-blue-600 to-blue-500 text-white py-12 px-6 shadow-lg rounded-b-3xl">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-extrabold tracking-tight">
                Profil Desa {{ $profil->judul ?? 'Mojomanis' }}
            </h1>
            <p class="text-blue-100 mt-3 text-base">
                Mengenal sejarah, potensi desa, dan identitas masyarakat Mojomanis.
            </p>
        </div>
    </section>

    <div class="max-w-5xl mx-auto px-6 mt-10 space-y-10">

        {{-- ============================
            SEJARAH DESA
        ============================= --}}
        @if(!empty($profil->sejarah))
        <section class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all">

            {{-- Title --}}
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full shadow-sm">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Sejarah Desa</h2>
            </div>

            {{-- Foto --}}
            @if(!empty($profil->foto_sejarah))
            <div class="mb-6 relative group">
                <img src="{{ asset('storage/'.$profil->foto_sejarah) }}"
                     onclick="openModal('{{ asset('storage/'.$profil->foto_sejarah) }}')"
                     class="w-full h-72 md:h-80 object-cover rounded-xl shadow-lg cursor-pointer transition duration-300 group-hover:scale-105">
                <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-sm p-2 rounded-b-xl text-center">
                    Klik gambar untuk memperbesar
                </div>
            </div>
            @endif

            {{-- Isi Sejarah --}}
            <div class="konten-profil text-gray-700 text-justify leading-relaxed text-lg">
                {!! nl2br(e($profil->sejarah)) !!}
            </div>

        </section>
        @endif


        {{-- ============================
            POTENSI DESA
        ============================= --}}
        @if(!empty($profil->potensi))
        <section class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all">

            {{-- Title --}}
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full shadow-sm">
                    <i class="fas fa-seedling text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Potensi Desa</h2>
            </div>

            {{-- Isi Potensi --}}
            <div class="konten-profil text-gray-700 text-justify leading-relaxed text-lg">
                {!! nl2br(e($profil->potensi)) !!}
            </div>
        </section>
        @endif

    </div>
</div>

{{-- ============================
      MODAL FOTO
=============================== --}}
<div id="imageModal"
     class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 backdrop-blur-sm">

    <img id="modalImage"
         class="max-w-5xl max-h-[90vh] rounded-xl shadow-2xl border-4 border-white transform scale-95 opacity-0 transition duration-300">

    <button onclick="closeModal()"
            class="absolute top-6 right-6 bg-white/90 text-black rounded-full px-4 py-2 font-bold shadow-lg hover:bg-white transition">
        ✕ Tutup
    </button>
</div>

{{-- ============================
      SCRIPT MODAL
=============================== --}}
<script>
function openModal(src) {
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('modalImage');

    img.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        img.classList.remove('scale-95', 'opacity-0');
        img.classList.add('scale-100', 'opacity-100');
    }, 50);
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('modalImage');

    img.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}
</script>

{{-- ============================
      STYLE PARAGRAF (RAPI)
=============================== --}}
<style>
    .konten-profil p {
        margin-bottom: 10px;     /* paragraf lebih rapat dan rapi */
        line-height: 1.7;        /* nyaman dibaca */
    }
</style>

@endsection
