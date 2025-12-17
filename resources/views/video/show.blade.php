@extends('layouts.master')

@section('content')

<style>
    /* Responsive 16:9 Video Wrapper */
    .video-wrapper {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 ratio */
        overflow: hidden;
        border-radius: 16px;
    }
    .video-wrapper iframe,
    .video-wrapper video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<div class="max-w-4xl mx-auto p-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $video->judul }}</h1>
        <p class="text-gray-500 mt-1">Galeri Video Desa</p>
    </div>

    <!-- Video -->
    <div class="video-wrapper shadow-lg mb-6">
        @if($video->video)
            <video controls>
                <source src="{{ asset('storage/'.$video->video) }}" type="video/mp4">
            </video>
        @else
            <iframe
                src="{{ str_replace('watch?v=', 'embed/', $video->link_youtube) }}"
                allowfullscreen>
            </iframe>
        @endif
    </div>

    <!-- Deskripsi -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
        <p class="text-gray-700 leading-relaxed">
            {{ $video->deskripsi ?? 'Tidak ada deskripsi.' }}
        </p>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-6">
        <a href="{{ route('video.public') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            &larr; Kembali ke Galeri Video
        </a>
    </div>

</div>

@endsection
