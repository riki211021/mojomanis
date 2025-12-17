@extends('layouts.master')

@section('content')

<style>
    .video-card {
        transition: .3s;
    }
    .video-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
</style>

<div class="max-w-7xl mx-auto p-6">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-8 rounded-2xl shadow-xl mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-wide flex items-center gap-3">
            📹 Galeri Video Desa Mojomanis
        </h1>
        <p class="text-blue-100 text-sm md:text-base mt-2">
            Kumpulan dokumentasi kegiatan desa dalam bentuk video
        </p>
    </div>

    {{-- GRID VIDEO --}}
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($videos as $v)
        <a href="{{ route('video.show', $v->id) }}"
           class="bg-white rounded-2xl shadow video-card overflow-hidden border border-gray-100 block">

            {{-- THUMBNAIL --}}
            <div class="relative">
                <img src="{{ asset('storage/'.$v->thumbnail) }}"
                     class="w-full h-44 object-cover rounded-t-2xl">
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                    <i class="fas fa-play text-3xl text-white opacity-90"></i>
                </div>
            </div>

            {{-- JUDUL --}}
            <div class="p-4">
                <h3 class="font-bold text-gray-800 text-lg">
                    {{ $v->judul }}
                </h3>
            </div>
        </a>
        @endforeach

    </div>

</div>

@endsection
