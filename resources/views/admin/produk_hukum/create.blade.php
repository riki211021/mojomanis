@extends('layouts.master')


@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Tambah Produk Hukum</h2>

    <form action="{{ route('admin.produk_hukum.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block font-medium mb-1">Judul Produk Hukum</label>
            <input type="text" name="judul" class="border rounded-lg w-full px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Jenis</label>
            <input type="text" name="jenis" class="border rounded-lg w-full px-3 py-2" placeholder="Misal: Peraturan Desa">
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
            <a href="{{ route('admin.produk_hukum.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
