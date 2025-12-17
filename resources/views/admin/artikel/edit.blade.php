@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-xl shadow w-full">

    <h2 class="text-2xl font-bold text-blue-700 mb-6">✏️ Edit Artikel</h2>

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


    {{-- ====================== --}}
    {{-- FORM UPDATE ARTIKEL   --}}
    {{-- ====================== --}}
    <form action="{{ route('admin.artikel.update', $artikel->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div>
            <label class="block font-semibold mb-1">Judul Artikel</label>
            <input type="text" name="judul"
                   value="{{ $artikel->judul }}"
                   class="w-full border rounded p-2"
                   required>
        </div>

        {{-- Subjudul --}}
        <div>
            <label class="block font-semibold mb-1">Subjudul (opsional)</label>
            <input type="text" name="subjudul"
                   value="{{ old('subjudul', $artikel->subjudul) }}"
                   class="w-full border rounded p-2">
        </div>

        {{-- Isi --}}
        <div>
            <label class="block font-semibold mb-1">Isi Artikel</label>
            <textarea name="isi" rows="6"
                      class="w-full border rounded p-2"
                      required>{{ $artikel->isi }}</textarea>
        </div>

        {{-- Foto Utama --}}
        <div>
            <label class="block font-semibold mb-1">Foto Utama</label>

            @if($artikel->gambar)
                <p class="text-sm text-gray-600 mb-1">Foto saat ini:</p>
                <img src="{{ asset('uploads/'.$artikel->gambar) }}"
                     class="w-40 rounded shadow mb-2 object-cover">
            @endif

            <input type="file" name="gambar" class="w-full border rounded p-2">
            <p class="text-xs text-gray-500">Kosongkan jika tidak ingin mengganti.</p>
        </div>

        {{-- Foto Tambahan --}}
        <div>
            <label class="block font-semibold mb-1">Foto Tambahan (Multiple)</label>
            <input type="file"
                   name="photos[]"
                   multiple
                   class="w-full border rounded p-2">
            <p class="text-xs text-gray-500 mt-1">Bisa pilih lebih dari 1 foto.</p>
        </div>

        {{-- Tombol Update --}}
        <div>
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                💾 Update Artikel
            </button>

            <a href="{{ route('admin.artikel.index') }}"
               class="ml-3 text-gray-600 hover:underline">
                Batal
            </a>
        </div>

    </form>
    {{-- ====================== --}}
    {{-- END FORM UPDATE        --}}
    {{-- ====================== --}}



    {{-- ====================== --}}
    {{-- SECTION UNTUK HAPUS FOTO (DILUAR FORM) --}}
    {{-- ====================== --}}
    @if($artikel->photos->count())
    <div class="mt-10 pt-5 border-t">
        <h3 class="font-semibold text-gray-700 mb-3 text-lg">Foto Tambahan Saat Ini:</h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($artikel->photos as $photo)
            <div class="relative group">

                <img src="{{ asset('uploads/artikel_photos/'.$photo->foto) }}"
                     class="w-full h-32 object-cover rounded shadow">

                {{-- Form hapus foto (INDEPENDENT, BUKAN DI DALAM FORM UPDATE) --}}
                <form action="{{ route('admin.artikel.photo.delete', $photo->id) }}"
                      method="POST"
                      class="absolute top-1 right-1 hidden group-hover:flex"
                      onsubmit="return confirm('Yakin ingin menghapus foto ini?')">

                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 text-white px-2 py-1 text-xs rounded shadow">
                        ✖
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
