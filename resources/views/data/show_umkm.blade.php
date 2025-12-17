@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-lg overflow-hidden">

        {{-- Foto UMKM --}}
        @if($umkm->foto)
            <figure class="my-6">
                <div class="w-full flex items-center justify-center bg-gray-100 rounded-xl overflow-hidden">
                    <img src="{{ asset('storage/'.$umkm->foto) }}"
                        alt="Foto {{ $umkm->nama_usaha }}"
                        class="max-h-[600px] w-auto object-contain rounded-xl shadow-md cursor-pointer transition-transform duration-300 hover:scale-105"
                        onclick="openLightbox('{{ asset('storage/'.$umkm->foto) }}')">
                </div>

                <figcaption class="text-sm text-gray-500 mt-2 text-center italic">
                    Dokumentasi UMKM: {{ $umkm->pemilik ?? 'Desa Mojomanis' }} (klik gambar untuk memperbesar)
                </figcaption>
            </figure>
        @endif

        {{-- Lightbox Modal --}}
        <div id="lightbox"
            class="hidden fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center p-4 opacity-0 transition-opacity duration-500 ease-out">
            <div class="relative max-w-4xl w-full transform scale-95 transition-transform duration-500 ease-out flex justify-center">

                {{-- Tombol Tutup --}}
                <button onclick="closeLightbox()"
                        class="absolute -top-10 right-0 text-white text-4xl font-bold hover:text-red-400 transition z-50">
                    &times;
                </button>

                <img id="lightbox-img" src="" alt="Preview UMKM"
                    class="rounded-2xl border-4 border-white w-auto max-h-[90vh] object-contain shadow-2xl">
            </div>
        </div>

        @push('scripts')
        <script>
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxContent = lightbox.querySelector('div');

            function openLightbox(imgSrc) {
                lightboxImg.src = imgSrc;
                lightbox.classList.remove('hidden');
                setTimeout(() => {
                    lightbox.classList.add('opacity-100');
                    lightboxContent.classList.add('scale-100');
                }, 10);
            }

            function closeLightbox() {
                lightbox.classList.remove('opacity-100');
                lightboxContent.classList.remove('scale-100');
                setTimeout(() => lightbox.classList.add('hidden'), 300);
            }

            lightbox.addEventListener('click', function(e) {
                if (e.target === this) closeLightbox();
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeLightbox();
            });
        </script>
        @endpush

        {{-- Konten --}}
        <div class="p-8">

            {{-- Judul --}}
            <h1 class="text-3xl font-extrabold text-gray-800 mb-6">
                {{ $umkm->nama_usaha }}
            </h1>

            {{-- ====================== INFO UMKM RAPI PREMIUM ====================== --}}
            <div class="space-y-2 mb-8">

                <div class="flex text-gray-700">
                    <span class="w-40 font-semibold">Pemilik</span>
                    <span>: {{ $umkm->pemilik ?? '-' }}</span>
                </div>

                <div class="flex text-gray-700">
                    <span class="w-40 font-semibold">Kategori</span>
                    <span>: {{ $umkm->kategori ?? '-' }}</span>
                </div>

                <div class="flex text-gray-700">
                    <span class="w-40 font-semibold">No WhatsApp</span>
                    <span>:
                        @if ($umkm->wa)
                            <a href="https://wa.me/{{ $umkm->wa }}"
                               class="text-green-600 hover:underline"
                               target="_blank">
                               {{ $umkm->wa }}
                            </a>
                        @else
                            -
                        @endif
                    </span>
                </div>

                <div class="flex text-gray-700 leading-relaxed">
                    <span class="w-40 font-semibold">Alamat UMKM</span>
                    <span>: {{ $umkm->alamat ?? '-' }}</span>
                </div>

            </div>
            {{-- =================== END INFO UMKM =================== --}}

            {{-- Deskripsi UMKM --}}
            <div class="text-gray-700 text-justify leading-[1.75] mb-6">
                {!! preg_replace('/\n\s*\n/', '</p><p>', '<p>' . nl2br(e(trim($umkm->deskripsi))) . '</p>') !!}
            </div>

            {{-- Tombol kembali --}}
            <a href="{{ route('data.umkm') }}"
                class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                ← Kembali ke daftar UMKM
            </a>

        </div>
    </div>
</div>
@endsection
