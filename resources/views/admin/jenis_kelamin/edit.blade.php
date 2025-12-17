@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-xl shadow max-w-lg mx-auto">
    <h1 class="text-xl font-bold mb-4">Edit Data Jenis Kelamin</h1>

    <form action="{{ route('admin.jenis_kelamin.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Kode</label>
            <input type="text" name="kode" class="w-full border rounded px-3 py-2"
                   value="{{ old('kode', $data->kode) }}">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Kelompok</label>
            <input type="text" name="kelompok" class="w-full border rounded px-3 py-2"
                   value="{{ old('kelompok', $data->kelompok) }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Jumlah</label>
            <input type="number" name="jumlah" class="w-full border rounded px-3 py-2"
                   value="{{ old('jumlah', $data->jumlah) }}" required>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.jenis_kelamin.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
        </div>
    </form>
</div>
@endsection
