@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-xl shadow max-w-lg mx-auto">
    <h1 class="text-xl font-bold mb-4">Tambah Warga Negara</h1>

    <form action="{{ route('admin.warga_negara.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Kode</label>
            <input type="text" name="kode" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Kelompok</label>
            <input type="text" name="kelompok" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Jumlah</label>
            <input type="number" name="jumlah" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.warga_negara.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
