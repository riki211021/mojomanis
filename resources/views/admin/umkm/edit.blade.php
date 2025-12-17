@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Data UMKM</h2>

    <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1 text-gray-700">Nama Usaha</label>
            <input type="text" name="nama_usaha" class="border rounded-lg w-full px-3 py-2"
                   value="{{ $umkm->nama_usaha }}" required>
        </div>

        <div>
            <label class="block font-medium mb-1 text-gray-700">Nama Pemilik</label>
            <input type="text" name="pemilik" class="border rounded-lg w-full px-3 py-2"
                   value="{{ $umkm->pemilik }}">
        </div>

        <div>
            <label class="block font-medium mb-1 text-gray-700">Kategori</label>
            <input type="text" name="kategori" class="border rounded-lg w-full px-3 py-2"
                   value="{{ $umkm->kategori }}">
        </div>

        {{-- -------------------- WA -------------------- --}}
        <div>
            <label class="block font-medium mb-1 text-gray-700">No WhatsApp</label>
            <input type="text" name="wa" class="border rounded-lg w-full px-3 py-2"
                   value="{{ $umkm->wa }}" placeholder="08123456789">
        </div>

        {{-- -------------------- ALAMAT -------------------- --}}
        <div>
            <label class="block font-medium mb-1 text-gray-700">Alamat UMKM</label>
            <textarea name="alamat" rows="3" class="border rounded-lg w-full px-3 py-2">{{ $umkm->alamat }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1 text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="border rounded-lg w-full px-3 py-2">{{ $umkm->deskripsi }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1 text-gray-700">Foto Saat Ini</label><br>

            @if($umkm->foto)
                <img src="{{ asset('storage/'.$umkm->foto) }}" class="w-48 h-48 object-cover rounded shadow mb-3">
            @else
                <span class="text-gray-400">Tidak ada foto</span>
            @endif

            <input type="file" name="foto" id="foto" class="border rounded-lg w-full px-3 py-2 mt-2"
                   accept="image/*">

            <img id="preview" class="hidden w-48 h-48 object-cover rounded shadow mt-3">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.umkm.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Kembali
            </a>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Update
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('foto').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    const file = e.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
});
</script>
@endsection
