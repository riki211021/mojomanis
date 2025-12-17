@extends('layouts.layanan')

@section('content')
{{-- Header --}}
<div class="bg-gradient-to-r from-blue-900 via-indigo-500 to-blue-900 text-white p-8 rounded-2xl shadow-lg mb-6 text-center">
  <h1 class="text-3xl md:text-4xl font-extrabold tracking-wide">✏️ Edit Pengajuan Dokumen</h1>
  <p class="text-blue-100 text-sm md:text-base mt-2">
    Ubah data dokumen pengajuan kamu di bawah ini.
  </p>
</div>

{{-- Form Edit --}}
<div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 max-w-3xl mx-auto">
  <form action="{{ route('layanan.pengajuan.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Jenis Dokumen --}}
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Jenis Dokumen</label>
      <input type="text" name="jenis_dokumen"
             value="{{ old('jenis_dokumen', $pengajuan->jenis_dokumen) }}"
             class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
      @error('jenis_dokumen')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Keterangan --}}
    <div class="mb-4">
      <label class="block text-gray-700 font-semibold mb-2">Keterangan</label>
      <textarea name="keterangan" rows="3"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
        placeholder="Tuliskan keterangan tambahan...">{{ old('keterangan', $pengajuan->keterangan) }}</textarea>
    </div>

    {{-- Lampiran Lama --}}
    @if($pengajuan->lampiran)
      <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Lampiran Saat Ini</label>
        @php
          $files = json_decode($pengajuan->lampiran, true);
          $files = is_array($files) ? $files : [$pengajuan->lampiran];
        @endphp
        <ul class="space-y-1">
          @foreach($files as $file)
            <li>
              <a href="{{ asset('storage/'.$file) }}" target="_blank"
                 class="text-blue-600 hover:underline"><i class="fas fa-paperclip"></i> Lihat Lampiran</a>
            </li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Upload Baru --}}
    <div class="mb-6">
      <label class="block text-gray-700 font-semibold mb-2">Ganti Lampiran (opsional)</label>
      <input type="file" name="lampiran[]" multiple
             class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
      <p class="text-sm text-gray-500 mt-1">Format: PDF, JPG, PNG (maks. 10MB per file)</p>
    </div>

    {{-- Tombol --}}
    <div class="flex justify-between items-center">
      <a href="{{ route('layanan.pengajuan.index') }}"
         class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow transition">
         <i class="fas fa-arrow-left"></i> Kembali
      </a>

      <button type="submit"
              class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg shadow transition font-semibold">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>

  </form>
</div>
@endsection
