@extends('layouts.master')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg p-6 rounded-lg">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">✏️ Edit Data Pertanian</h2>

    {{-- Pesan Error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pertanian.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Dusun</label>
            <input type="text" name="dusun" value="{{ old('dusun', $data->dusun) }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">RT</label>
            <input type="text" name="rt" value="{{ old('rt', $data->rt) }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Tahun</label>
            <input type="number" name="tahun" value="{{ old('tahun', $data->tahun) }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Jenis Tanaman</label>
            <select name="jenis_tanaman" class="w-full border rounded p-2" required>
                <option value="Padi" {{ $data->jenis_tanaman == 'Padi' ? 'selected' : '' }}>Padi</option>
                <option value="Polowijo" {{ $data->jenis_tanaman == 'Polowijo' ? 'selected' : '' }}>Polowijo</option>
                <option value="Tebu" {{ $data->jenis_tanaman == 'Tebu' ? 'selected' : '' }}>Tebu</option>
            </select>
        </div>

        <div class="mb-4">
    <label class="block font-semibold mb-1">Koordinat Lahan</label>
    <input type="text" name="koordinat" value="{{ old('koordinat', $data->koordinat ?? '') }}"
           class="w-full border rounded p-2" placeholder="-7.8234, 111.5120" required>
    <small class="text-gray-500">Masukkan format: latitude, longitude</small>
</div>


        {{-- 🖼️ Foto Lama + Upload Baru --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Foto Saat Ini</label>

            @if ($data->foto)
                <img src="{{ asset('storage/'.$data->foto) }}" alt="Foto Panen" class="w-40 h-40 object-cover rounded-lg mb-3 border">
            @else
                <p class="text-gray-500 italic mb-3">Belum ada foto diunggah.</p>
            @endif

            <label class="block font-semibold mb-1">Ganti Foto (Opsional)</label>
            <input type="file" name="foto" accept="image/*" class="w-full border rounded p-2">
            <small class="text-gray-500">*Kosongkan jika tidak ingin mengganti foto</small>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.pertanian.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
               Kembali
            </a>

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
