@extends('layouts.master')


@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Tambah Informasi Publik</h2>

    <form action="{{ route('admin.informasi_publik.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block font-medium mb-1">Judul Informasi</label>
            <input type="text" name="judul" class="border rounded-lg w-full px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <input type="text" name="kategori" class="border rounded-lg w-full px-3 py-2" placeholder="Contoh: Pengumuman, Laporan, Arsip">
        </div>

        <div>
            <label class="block font-medium mb-1">Tahun</label>
            <input type="number" name="tahun" class="border rounded-lg w-full px-3 py-2" min="2000" max="{{ date('Y') }}">
        </div>

        <div>
            <label class="block font-medium mb-1">Upload File (PDF)</label>
            <input type="file" name="file" accept="application/pdf" class="border rounded-lg w-full px-3 py-2">
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.informasi_publik.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
