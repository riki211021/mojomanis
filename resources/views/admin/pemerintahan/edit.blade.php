@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">

    <h2 class="text-xl font-bold mb-6">Edit Pemerintahan Desa</h2>

    <form action="{{ route('admin.pemerintahan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-left font-semibold">Visi</label>
            <textarea name="visi" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('visi', $data->visi ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-left font-semibold">Misi</label>
            <textarea name="misi" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('misi', $data->misi ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-left font-semibold">Foto Struktur Organisasi</label>
            @if(!empty($data->struktur_foto))
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $data->struktur_foto) }}" alt="Struktur Organisasi" class="rounded shadow max-h-64 mx-auto">
                </div>
            @endif
            <input type="file" name="struktur_foto" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </form>

</div>
@endsection
