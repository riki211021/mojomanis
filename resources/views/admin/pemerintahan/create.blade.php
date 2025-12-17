@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-6">Tambah Jabatan Baru</h2>

    <form action="{{ route('admin.struktur.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-left font-semibold">Jabatan</label>
            <input type="text" name="jabatan" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-left font-semibold">Nama</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" required>
        </div>
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
        <a href="{{ route('admin.struktur.index') }}"
           class="ml-2 bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
           Batal
        </a>
    </form>
</div>
@endsection
