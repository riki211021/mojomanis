@extends('layouts.layanan')

@section('content')
{{-- Header Section --}}
<div class="bg-gradient-to-r from-blue-900 via-indigo-500 to-blue-900 text-white p-8 rounded-2xl shadow-lg mb-6 text-center">
  <h1 class="text-3xl md:text-4xl font-extrabold tracking-wide">📘 Daftar Pengajuan Saya</h1>
  <p class="text-blue-100 text-sm md:text-base mt-2">
    Lihat status pengajuan dokumen resmi yang telah kamu kirim ke layanan masyarakat Desa Mojomanis
  </p>
</div>

{{-- Content Section --}}
<div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
  {{-- Notifikasi Sukses --}}
  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
      {{ session('success') }}
    </div>
  @endif

  {{-- Jika belum ada data --}}
  @if($pengajuan->isEmpty())
    <div class="text-center text-gray-500 py-12">
      <i class="fas fa-folder-open text-4xl mb-3"></i>
      <p>Belum ada pengajuan dokumen yang kamu kirim.</p>
      <a href="{{ route('layanan.pengajuan.create') }}"
         class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
         + Ajukan Dokumen
      </a>
    </div>
  @else
    {{-- Tabel Data --}}
    <div class="w-full overflow-x-auto mt-4">
      <table class="w-full border-collapse bg-white rounded-xl shadow-md overflow-hidden">

        {{-- Header --}}
        <thead>
          <tr class="bg-blue-600 text-white text-left uppercase tracking-wider">
            <th class="p-4 font-semibold">#</th>
            <th class="p-4 font-semibold">Jenis Dokumen</th>
            <th class="p-4 font-semibold">Keterangan</th>
            <th class="p-4 font-semibold">Lampiran</th>
            <th class="p-4 font-semibold">Status</th>
            <th class="p-4 font-semibold">Tanggal</th>
            <th class="p-4 font-semibold text-center">Aksi</th>
          </tr>
        </thead>

        {{-- Isi Tabel --}}
        <tbody>
          @foreach ($pengajuan as $p)
          <tr class="border-b hover:bg-gray-50 transition">
            <td class="p-4 text-gray-700">{{ $loop->iteration }}</td>
            <td class="p-4 font-semibold text-gray-800">{{ $p->jenis_dokumen }}</td>
            <td class="p-4 text-gray-600">{{ $p->keterangan ?? '-' }}</td>

           {{-- Lampiran --}}
<td class="p-4">
  @if($p->lampiran)
    @php
      $files = json_decode($p->lampiran, true);
      if (!is_array($files)) $files = [$p->lampiran];
    @endphp

    <div class="flex flex-wrap gap-3">
      @foreach ($files as $file)
        @php
          $ext = pathinfo($file, PATHINFO_EXTENSION);
          $isImage = in_array($ext, ['jpg', 'jpeg', 'png']);
          $color = match($ext) {
            'pdf' => 'bg-red-50 border-red-200 text-red-700',
            'jpg', 'jpeg', 'png' => 'bg-green-50 border-green-200 text-green-700',
            'doc', 'docx' => 'bg-blue-50 border-blue-200 text-blue-700',
            'xls', 'xlsx' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
            default => 'bg-gray-50 border-gray-200 text-gray-700',
          };
        @endphp

        <a href="{{ asset('storage/'.$file) }}" target="_blank"
           class="flex flex-col items-center justify-center w-20 h-20 border rounded-xl {{ $color }} hover:shadow-md hover:scale-105 transition duration-200 overflow-hidden relative group">

          @if($isImage)
            <img src="{{ asset('storage/'.$file) }}" class="w-full h-full object-cover rounded-xl opacity-90 group-hover:opacity-100 transition">
          @else
            <i class="fas fa-file text-2xl"></i>
          @endif

          <div class="absolute bottom-0 bg-white/80 text-[10px] font-semibold px-2 py-0.5 rounded-t-md text-center w-full">
            {{ strtoupper($ext) }}
          </div>
        </a>
      @endforeach
    </div>
  @else
    <span class="text-gray-400 italic">Tidak ada</span>
  @endif
</td>




            {{-- Status --}}
            <td class="p-4">
              @if($p->status == 'Menunggu')
                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                  Menunggu
                </span>
              @elseif($p->status == 'Diproses')
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                  Diproses
                </span>
              @else
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                  Selesai
                </span>
              @endif
            </td>

            {{-- Tanggal --}}
            <td class="p-4 text-gray-600">
              {{ $p->created_at->format('d M Y') }}
            </td>
{{-- Aksi --}}
<td class="p-4 text-center">
  <div class="flex justify-center items-center gap-2">

    {{-- Tombol Edit (kuning) --}}
    <a href="{{ route('layanan.pengajuan.edit', $p->id) }}"
       class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-sm font-semibold transition-all duration-200 shadow-sm">
       <i class="fas fa-edit"></i> Edit
    </a>

    {{-- Tombol Hapus (merah) --}}
    <form action="{{ route('layanan.pengajuan.destroy', $p->id) }}" method="POST" class="inline">
      @csrf
      @method('DELETE')
      <button type="submit"
        onclick="return confirm('Yakin ingin menghapus pengajuan ini?')"
        class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm font-semibold transition-all duration-200 shadow-sm">
        <i class="fas fa-trash-alt"></i> Hapus
      </button>
    </form>

  </div>
</td>


          @endforeach
        </tbody>
      </table>
    </div>

    {{-- 🔢 Pagination --}}
<div class="mt-6 mb-4 flex justify-center">
  {{ $pengajuan->links('pagination::tailwind') }}
</div>

    </div>

    <div class="mt-4">
      <a href="{{ route('layanan.dashboard') }}"
         class="inline-flex items-center gap-2 text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition font-medium shadow-sm">
         <i class="fas fa-arrow-left"></i> Kembali ke Dashboard Layanan
      </a>
    </div>
  @endif
</div>
@endsection
