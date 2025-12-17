@extends('layouts.master')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg max-w-5xl mx-auto">
    {{-- Judul --}}
    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800 mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7H3z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 3v4H8V3"/>
        </svg>
        Edit Profil Desa
    </h1>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="mb-5 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            <strong>✅ Berhasil:</strong> {{ session('success') }}
        </div>
    @endif

    {{-- Form Update --}}
    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- Foto Sejarah --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2">🖼️ Foto Sejarah Desa</label>
            <input type="file" name="foto_sejarah"
                   accept="image/*"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">

            @error('foto_sejarah')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror

            {{-- Preview foto saat ini --}}
            @if($profil->foto_sejarah)
                <div class="mt-4">
                    <p class="text-sm text-gray-500 mb-2">Foto saat ini:</p>
                    <img src="{{ asset('storage/'.$profil->foto_sejarah) }}"
                         alt="Foto Sejarah Desa"
                         class="rounded-xl shadow-md w-full md:w-1/2 object-cover">
                </div>
            @endif
        </div>

        {{-- Sejarah --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2">📜 Sejarah Desa</label>
            <textarea name="sejarah" rows="5"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
        </div>

        {{-- Potensi --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2">🌱 Potensi Desa</label>
            <textarea name="potensi" rows="4"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">{{ old('potensi', $profil->potensi ?? '') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Contoh: pertanian, perikanan, UMKM, wisata, dll.</p>
        </div>

        {{-- Peta --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2">🗺️ Peta Desa (Google Maps Embed)</label>
            <textarea name="peta" rows="3"
                      placeholder="<iframe ...> tempel kode embed dari Google Maps di sini"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">{{ old('peta', $profil->peta ?? '') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">
                Cara: Buka Google Maps → Bagikan → Sematkan Peta → Salin kode iframe → tempel di sini.
            </p>
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>

    {{-- Tombol Hapus Profil --}}
    <form action="{{ route('admin.profil.destroy') }}" method="POST" class="mt-6"
          onsubmit="return confirm('Yakin ingin menghapus seluruh data profil desa ini?')">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="px-6 py-2.5 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
            🗑️ Hapus Profil
        </button>
    </form>
</div>
@endsection
