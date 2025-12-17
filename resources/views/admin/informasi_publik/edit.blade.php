@extends('layouts.master')


@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Edit Informasi Publik</h2>

    <form action="{{ route('admin.informasi_publik.update', $informasiPublik->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Judul Informasi</label>
            <input type="text" name="judul" class="border rounded-lg w-full px-3 py-2" value="{{ $informasiPublik->judul }}" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <input type="text" name="kategori" class="border rounded-lg w-full px-3 py-2" value="{{ $informasiPublik->kategori }}">
        </div>

        <div>
            <label class="block font-medium mb-1">Tahun</label>
            <input type="number" name="tahun" class="border rounded-lg w-full px-3 py-2" value="{{ $informasiPublik->tahun }}">
        </div>

        <div>
            <label class="block font-medium mb-1">File Saat Ini</label><br>
            @if($informasiPublik->file)
                <a href="{{ asset('storage/'.$informasiPublik->file) }}" target="_blank" class="text-blue-600 underline">Lihat PDF</a>
            @else
                <span class="text-gray-400">Belum ada file</span>
            @endif
        </div>

        <div>
            <label class="block font-medium mb-1">Ganti File (Opsional)</label>
            <input type="file" name="file" accept="application/pdf" class="border rounded-lg w-full px-3 py-2">
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.informasi_publik.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
        </div>
    </form>
</div>
@endsection
