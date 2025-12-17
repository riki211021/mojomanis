@extends('layouts.master')


@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Edit Produk Hukum</h2>

    <form action="{{ route('admin.produk_hukum.update', $produkHukum->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Judul Produk Hukum</label>
            <input type="text" name="judul" class="border rounded-lg w-full px-3 py-2" value="{{ $produkHukum->judul }}" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Jenis</label>
            <input type="text" name="jenis" class="border rounded-lg w-full px-3 py-2" value="{{ $produkHukum->jenis }}">
        </div>

        <div>
            <label class="block font-medium mb-1">Tahun</label>
            <input type="number" name="tahun" class="border rounded-lg w-full px-3 py-2" value="{{ $produkHukum->tahun }}">
        </div>

        <div>
            <label class="block font-medium mb-1">File Saat Ini</label><br>
            @if($produkHukum->file)
                <a href="{{ asset('storage/'.$produkHukum->file) }}" target="_blank" class="text-blue-600 underline">Lihat PDF</a>
            @else
                <span class="text-gray-400">Belum ada file</span>
            @endif
        </div>

        <div>
            <label class="block font-medium mb-1">Ganti File (Opsional)</label>
            <input type="file" name="file" accept="application/pdf" class="border rounded-lg w-full px-3 py-2">
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.produk_hukum.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
