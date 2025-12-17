@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-xl shadow max-w-lg mx-auto">
    <h1 class="text-xl font-bold mb-4">Tambah Data Jenis Kelamin</h1>

    <form action="{{ route('admin.jenis_kelamin.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium mb-1">Kode</label>
            <input type="text" name="kode" class="w-full border rounded px-3 py-2"
                   placeholder="Contoh: 1" value="{{ old('kode') }}">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Kelompok</label>
            <input type="text" name="kelompok" class="w-full border rounded px-3 py-2"
                   placeholder="Contoh: LAKI-LAKI" value="{{ old('kelompok') }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Jumlah</label>
            <input type="number" name="jumlah" class="w-full border rounded px-3 py-2"
                   placeholder="Masukkan jumlah" value="{{ old('jumlah') }}" required>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.jenis_kelamin.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
