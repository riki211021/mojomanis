@extends('layouts.master')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">🎥 Kelola Galeri Video</h2>

        <a href="{{ route('admin.video.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            + Tambah Video
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white shadow-lg rounded-2xl border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-4 border">Judul</th>
                    <th class="p-4 border">Thumbnail</th>
                    <th class="p-4 border">Video</th>
                    <th class="p-4 border text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $v)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 border font-semibold">{{ $v->judul }}</td>

                    <td class="p-4 border">
                        @if($v->thumbnail)
                            <img src="{{ asset('storage/'.$v->thumbnail) }}"
                                 class="w-20 h-14 object-cover rounded shadow">
                        @else
                            <span class="text-gray-400 text-xs italic">Tidak ada</span>
                        @endif
                    </td>

                    <td class="p-4 border">
                        @if($v->video)
                            <video src="{{ asset('storage/'.$v->video) }}"
                                   class="w-32 rounded shadow" controls></video>
                        @else
                            <a href="{{ $v->link_youtube }}"
                               class="text-blue-600 hover:underline"
                               target="_blank">
                                Lihat YouTube
                            </a>
                        @endif
                    </td>

                    <td class="p-4 border text-center">

                        {{-- Tombol Edit --}}
                        <a href="{{ route('admin.video.edit', $v->id) }}"
                           class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded shadow mr-1">
                            Edit
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.video.destroy', $v->id) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus video ini?')">

                            @csrf
                            @method('DELETE')

                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded shadow">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4">
            {{ $data->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
