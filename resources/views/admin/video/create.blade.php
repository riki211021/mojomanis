@extends('layouts.master')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">🎥 Tambah Video Baru</h2>

    <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
        <form action="{{ route('admin.video.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Judul --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">Judul Video</label>
                <input type="text" name="judul"
                       class="w-full border-gray-300 rounded-lg p-3 focus:ring-blue-500"
                       required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">Deskripsi (opsional)</label>
                <textarea name="deskripsi" rows="3"
                          class="w-full border-gray-300 rounded-lg p-3 focus:ring-blue-500"></textarea>
            </div>

            {{-- Thumbnail --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">Thumbnail</label>
                <input type="file" name="thumbnail"
                       class="w-full border rounded-lg p-2 bg-white" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG</p>
            </div>

            {{-- Jenis Video --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">Tipe Video</label>

                <select id="typeSelector" class="border-gray-300 rounded-lg p-3 w-full">
                    <option value="upload">Upload Video</option>
                    <option value="youtube">Link YouTube</option>
                </select>
            </div>

            {{-- Upload Video --}}
            <div id="videoUpload" class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">Upload Video (MP4)</label>
                <input type="file" name="video"
                       class="w-full border rounded-lg p-2 bg-white"
                       accept="video/mp4">
                <p class="text-xs text-gray-500 mt-1">Format: MP4 saja</p>
            </div>

            {{-- YouTube Link --}}
            <div id="youtubeLink" class="mb-4 hidden">
                <label class="block mb-1 font-semibold text-gray-700">Link YouTube</label>
                <input type="text" name="link_youtube"
                       class="w-full border-gray-300 rounded-lg p-3 focus:ring-blue-500"
                       placeholder="https://youtube.com/...">
            </div>

            {{-- Tombol --}}
            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.video.index') }}"
                   class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Batal
                </a>

                <button class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">
                    Simpan Video
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    const typeSelector = document.getElementById('typeSelector');
    const upload = document.getElementById('videoUpload');
    const youtube = document.getElementById('youtubeLink');

    typeSelector.addEventListener('change', function () {
        if (this.value === 'youtube') {
            upload.classList.add('hidden');
            youtube.classList.remove('hidden');
        } else {
            upload.classList.remove('hidden');
            youtube.classList.add('hidden');
        }
    });
</script>

@endsection
