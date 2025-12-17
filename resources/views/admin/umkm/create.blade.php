@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Data UMKM</h2>

    <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block font-medium mb-1 text-gray-700">Nama Usaha</label>
            <input type="text" name="nama_usaha" class="border rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" required>
        </div>

        <div>
            <label class="block font-medium mb-1 text-gray-700">Nama Pemilik</label>
            <input type="text" name="pemilik" class="border rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        <div>
            <label class="block font-medium mb-1 text-gray-700">Kategori</label>
            <input type="text" name="kategori" class="border rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        {{-- -------------------- WA -------------------- --}}
        <div>
            <label class="block font-medium mb-1 text-gray-700">No WhatsApp</label>
            <input type="text" name="wa" placeholder="08123456789" class="border rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        {{-- -------------------- ALAMAT -------------------- --}}
        <div>
            <label class="block font-medium mb-1 text-gray-700">Alamat UMKM</label>
            <textarea name="alamat" rows="3" class="border rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"></textarea>
        </div>

        <div>
            <label class="block font-medium mb-1 text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="border rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"></textarea>
        </div>

        <div>
            <label class="block font-medium mb-1 text-gray-700">Foto UMKM</label>
            <input type="file" name="foto" accept="image/*" class="border rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.umkm.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition mr-2">
                Batal
            </a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
