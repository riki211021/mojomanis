@extends('layouts.layanan')

@section('content')
{{-- 🔷 Header --}}
<div class="bg-gradient-to-r from-blue-900 via-indigo-500 to-blue-900 text-white p-8 rounded-2xl shadow-lg mb-8 text-center">
  <h1 class="text-3xl font-extrabold">Kelola Pengajuan Warga</h1>
  <p class="text-indigo-100 text-sm mt-1">Pantau dan proses semua pengajuan layanan masyarakat Desa Mojomanis</p>
</div>

{{-- 🔹 Container --}}
<div class="bg-white p-6 rounded-2xl shadow-md">
  {{-- ✅ Notifikasi --}}
  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5 flex items-center gap-2">
      <i class="fas fa-check-circle text-green-500"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  {{-- 🔍 Filter & Search --}}
  <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-3">
    <form method="GET" action="{{ route('layanan.admin.dashboard') }}" class="flex flex-wrap gap-3 items-center">
      <input type="text" name="search" value="{{ request('search') }}"
             class="border border-gray-300 rounded-lg px-3 py-2 w-60 focus:ring-2 focus:ring-blue-400 focus:outline-none"
             placeholder="Cari nama warga / dokumen...">

      <select name="status"
              class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        <option value="">Semua Status</option>
        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
        <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
      </select>

      <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
        <i class="fas fa-search"></i> <span>Cari</span>
      </button>
    </form>
  </div>

  {{-- 📋 Data Table --}}
  <div class="overflow-x-auto">
    <table class="w-full border-collapse bg-white shadow rounded-xl overflow-hidden">
      <thead>
        <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
          <th class="p-3">#</th>
          <th class="p-3">Nama Warga</th>
          <th class="p-3">Jenis Dokumen</th>
          <th class="p-3">Keterangan</th>
          <th class="p-3">Lampiran</th>
          <th class="p-3">Balasan Admin</th>
          <th class="p-3">Status / Catatan / Aksi</th>
        </tr>
      </thead>

      <tbody class="text-sm">
        @forelse ($pengajuan as $p)
        <tr class="border-t hover:bg-gray-50 transition">
          {{-- # --}}
          <td class="p-3 text-gray-600">{{ $loop->iteration }}</td>

          {{-- Nama --}}
          <td class="p-3 font-semibold text-gray-800">{{ ucfirst($p->warga->name) }}</td>

          {{-- Jenis Dokumen --}}
          <td class="p-3">{{ $p->jenis_dokumen }}</td>

          {{-- Keterangan --}}
          <td class="p-3 text-gray-600">{{ $p->keterangan ?? '-' }}</td>

          {{-- 📎 Lampiran Warga --}}
          <td class="p-3">
            @if($p->lampiran)
              @php
                $decoded = json_decode($p->lampiran, true);
                $lampiranList = is_array($decoded) ? $decoded : [$p->lampiran];
              @endphp

              <div class="flex flex-wrap gap-2">
                @foreach ($lampiranList as $file)
                  @php
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $isImage = in_array($ext, ['jpg','jpeg','png']);
                    $color = match($ext) {
                      'pdf' => 'bg-red-50 border-red-200 text-red-700',
                      'jpg','jpeg','png' => 'bg-green-50 border-green-200 text-green-700',
                      'doc','docx' => 'bg-blue-50 border-blue-200 text-blue-700',
                      default => 'bg-gray-50 border-gray-200 text-gray-700',
                    };
                  @endphp
                  <a href="{{ asset('storage/'.$file) }}" target="_blank"
                     class="flex flex-col items-center justify-center w-16 h-16 border rounded-xl {{ $color }} hover:shadow-md hover:scale-105 transition overflow-hidden relative group">
                    @if($isImage)
                      <img src="{{ asset('storage/'.$file) }}" class="w-full h-full object-cover rounded-xl opacity-90 group-hover:opacity-100 transition">
                    @else
                      <i class="fas fa-file text-lg"></i>
                    @endif
                    <div class="absolute bottom-0 bg-white/90 text-[10px] font-semibold px-2 py-0.5 rounded-t-md w-full text-center">
                      {{ strtoupper($ext) }}
                    </div>
                  </a>
                @endforeach
              </div>
            @else
              <span class="text-gray-400 italic">Tidak ada</span>
            @endif
          </td>

          {{-- 📂 Balasan Admin --}}
          <td class="p-3">
            @if($p->lampiran_admin)
              @php $balasanList = json_decode($p->lampiran_admin, true); @endphp
              <div class="flex flex-wrap gap-2">
                @foreach ($balasanList as $file)
                  @php $ext = pathinfo($file, PATHINFO_EXTENSION); @endphp
                  <a href="{{ asset('storage/'.$file) }}" target="_blank"
                     class="bg-blue-50 border border-blue-200 text-blue-700 px-3 py-1 rounded-md text-xs font-medium hover:bg-blue-100 transition">
                     <i class="fas fa-file-alt"></i> {{ strtoupper($ext) }}
                  </a>
                @endforeach
              </div>
            @else
              <span class="text-gray-400 italic">Belum ada</span>
            @endif
          </td>

          {{-- ⚙️ Status, Catatan, Upload, Aksi --}}
          <td class="p-3">
            <form action="{{ route('layanan.admin.updateStatus', $p->id) }}" method="POST" enctype="multipart/form-data"
                  class="flex flex-col gap-2">
              @csrf
              @method('PUT')

              {{-- Status --}}
              <select name="status" class="border rounded-lg px-2 py-1 text-sm focus:ring-2 focus:ring-blue-400">
                <option value="Menunggu" {{ $p->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Diproses" {{ $p->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Selesai" {{ $p->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
              </select>

              {{-- Catatan --}}
              <input type="text" name="catatan_admin" placeholder="Catatan..."
                     value="{{ $p->catatan_admin }}"
                     class="border rounded-lg px-2 py-1 text-sm w-full focus:ring-2 focus:ring-indigo-400">

              {{-- Upload Balasan --}}
              <input type="file" name="lampiran_admin[]" multiple
                     class="border rounded-lg px-2 py-1 text-sm w-full focus:ring-2 focus:ring-indigo-400">
              <p class="text-xs text-gray-500">Unggah file balasan (PDF/JPG/PNG, maks 10MB)</p>

              {{-- Tombol Update --}}
              <button type="submit"
                      class="bg-blue-600 text-white text-sm px-4 py-1 rounded-lg hover:bg-blue-700 transition flex items-center gap-1 justify-center">
                <i class="fas fa-save"></i> Update
              </button>
            </form>
          </td>
        </tr>
        @empty
          <tr>
            <td colspan="7" class="p-4 text-center text-gray-500 italic">Belum ada pengajuan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{-- 🔢 Pagination --}}
    <div class="mt-6 flex justify-center">
      {{ $pengajuan->links('pagination::tailwind') }}
    </div>
  </div>
</div>
@endsection
