@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-xl shadow w-full">

    <h2 class="text-2xl font-bold text-blue-700 mb-6">📝 Tambah Artikel Baru</h2>

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- FORM --}}
    <form action="{{ route('admin.artikel.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf

        {{-- Judul --}}
        <div>
            <label class="block font-semibold">Judul Artikel</label>
            <input type="text"
                   name="judul"
                   class="w-full border rounded p-2"
                   value="{{ old('judul') }}"
                   required>
        </div>

        {{-- Subjudul --}}
        <div>
            <label class="block font-semibold">Subjudul (opsional)</label>
            <input type="text"
                   name="subjudul"
                   class="w-full border rounded p-2"
                   value="{{ old('subjudul') }}">
        </div>

        {{-- Isi --}}
        <div>
            <label class="block font-semibold">Isi Artikel</label>
            <textarea name="isi"
                      rows="6"
                      class="w-full border rounded p-2"
                      required>{{ old('isi') }}</textarea>
        </div>

        {{-- Foto Utama --}}
        <div>
            <label class="block font-semibold">Foto Utama (opsional)</label>
            <input type="file"
                   name="gambar"
                   class="w-full border rounded p-2">
            <p class="text-xs text-gray-500 mt-1">
                Maksimal 40MB (jpg, png, jpeg, webp)
            </p>
        </div>

        {{-- Foto Tambahan MULTIPLE --}}
        <div>
            <label class="block font-semibold">Foto Tambahan (Opsional) — Bisa Upload Banyak</label>
            <input type="file"
                   name="photos[]"
                   multiple
                   class="w-full border rounded p-2">
            <p class="text-xs text-gray-500 mt-1">
                Kamu bisa pilih lebih dari 1 foto (MAX 40MB per foto)
            </p>
        </div>

        {{-- Tombol --}}
        <div class="pt-3">
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                💾 Simpan Artikel
            </button>

            <a href="{{ route('admin.artikel.index') }}"
               class="ml-3 text-gray-600 hover:underline">
                Batal
            </a>
        </div>
    </form>

</div>
@endsection
