@extends('layouts.layanan')

@section('content')
<div class="bg-gradient-to-r from-blue-900 via-indigo-500 to-blue-900 text-white p-8 rounded-2xl shadow-lg mb-6 text-center">
  <h1 class="text-3xl md:text-4xl font-extrabold tracking-wide">📄 Ajukan Dokumen</h1>
  <p class="text-blue-100 text-sm md:text-base mt-2">
    Isi form berikut untuk mengajukan layanan surat resmi secara digital
  </p>
</div>

<div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 w-full">
 <form method="POST" action="{{ route('layanan.pengajuan.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- Jenis Dokumen --}}
    <div class="mb-6">
      <label class="block font-semibold mb-2 text-gray-800">Jenis Dokumen</label>
      <select name="jenis_dokumen"
              class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
              required>
        <option value="">-- Pilih Jenis Dokumen --</option>
        <option value="Surat Domisili">Surat Domisili</option>
        <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
        <option value="Surat Pengantar SKCK">Surat Pengantar SKCK</option>
        <option value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu</option>
        <option value="Surat Pindah Penduduk">Surat Pindah Penduduk</option>
        <option value="Surat Keterangan Kelahiran">Surat Keterangan Kelahiran</option>
      </select>
    </div>

    {{-- Keterangan --}}
    <div class="mb-6">
      <label class="block font-semibold mb-2 text-gray-800">Keterangan Tambahan</label>
      <textarea name="keterangan" rows="3"
        class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none resize-none"
        placeholder="Tuliskan keterangan tambahan jika perlu..."></textarea>
    </div>

    {{-- Upload Lampiran --}}
    <div class="mb-6">
      <label class="block font-semibold mb-2 text-gray-800">
        Upload Lampiran (KTP, KK, atau dokumen lain)
      </label>
      <input type="file" name="lampiran[]" multiple accept=".pdf,.jpg,.jpeg,.png"
             class="block w-full text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer focus:ring-2 focus:ring-blue-400 focus:outline-none">
      <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG (maks. 10 MB per file)</p>

      {{-- Preview file --}}
      <div id="preview-container" class="mt-3 grid grid-cols-2 md:grid-cols-4 gap-3"></div>
    </div>

    {{-- Tombol --}}
    <div class="flex justify-between mt-8">
      <a href="{{ route('layanan.dashboard') }}"
         class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg shadow transition">
        ← Kembali
      </a>

      <button type="submit"
              class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">
        Kirim Pengajuan
      </button>
    </div>
  </form>
</div>

{{-- Preview Script --}}
<script>
document.querySelector('input[name="lampiran[]"]').addEventListener('change', function(e) {
  const container = document.getElementById('preview-container');
  container.innerHTML = '';
  Array.from(e.target.files).forEach(file => {
    const div = document.createElement('div');
    div.classList.add('border', 'p-2', 'rounded', 'shadow-sm', 'bg-gray-50', 'text-center', 'text-xs');
    if (file.type.includes('image')) {
      const img = document.createElement('img');
      img.src = URL.createObjectURL(file);
      img.classList.add('w-full', 'h-24', 'object-cover', 'rounded');
      div.appendChild(img);
    } else {
      div.innerHTML = `<i class="fas fa-file-pdf text-red-500 text-3xl"></i><p>${file.name}</p>`;
    }
    container.appendChild(div);
  });
});
</script>
@endsection
