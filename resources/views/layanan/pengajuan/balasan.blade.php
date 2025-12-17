@extends('layouts.layanan')

@section('content')
<div class="bg-gradient-to-r from-blue-900 via-indigo-500 to-blue-900 text-white p-8 rounded-2xl shadow-lg mb-8 text-center">
  <h1 class="text-3xl font-extrabold">📩 Balasan dari Admin</h1>
  <p class="text-emerald-100 text-sm mt-1">Lihat hasil atau dokumen yang sudah dikirim oleh Admin Desa Mojomanis</p>
</div>

<div class="bg-white p-6 rounded-2xl shadow-lg">
  @if($pengajuan->isEmpty())
    <div class="text-center py-10 text-gray-500">
      <i class="fas fa-inbox text-4xl mb-3"></i>
      <p>Belum ada balasan dari admin untuk pengajuan kamu.</p>
    </div>
  @else
    <div class="overflow-x-auto">
      <table class="w-full border-collapse bg-white shadow rounded-xl">
        <thead>
          <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
            <th class="p-3">#</th>
            <th class="p-3">Jenis Dokumen</th>
            <th class="p-3">Catatan Admin</th>
            <th class="p-3">Lampiran Balasan</th>
            <th class="p-3">Diperbarui</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pengajuan as $p)
          <tr class="border-t hover:bg-gray-50 transition">
            <td class="p-3">{{ $loop->iteration }}</td>
            <td class="p-3 font-semibold text-gray-800">{{ $p->jenis_dokumen }}</td>
            <td class="p-3 text-gray-700">{{ $p->catatan_admin ?? '-' }}</td>
            <td class="p-3">
              @php
                  $files = json_decode($p->lampiran_admin, true);
              @endphp
              @if(is_array($files))
                <div class="flex flex-wrap gap-2">
                  @foreach ($files as $file)
                    @php
                      $ext = pathinfo($file, PATHINFO_EXTENSION);
                      $isImage = in_array($ext, ['jpg', 'jpeg', 'png']);
                      $color = match($ext) {
                        'pdf' => 'bg-red-50 border-red-200 text-red-700',
                        'jpg', 'jpeg', 'png' => 'bg-green-50 border-green-200 text-green-700',
                        default => 'bg-gray-50 border-gray-200 text-gray-700',
                      };
                    @endphp
                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                       class="flex flex-col items-center justify-center w-20 h-20 border rounded-xl {{ $color }} hover:shadow-md hover:scale-105 transition duration-200 overflow-hidden relative group">
                      @if($isImage)
                        <img src="{{ asset('storage/' . $file) }}" class="w-full h-full object-cover rounded-xl">
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
                <span class="text-gray-400 italic">Tidak ada lampiran</span>
              @endif
            </td>
            <td class="p-3 text-gray-600">{{ $p->updated_at->format('d M Y H:i') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>

{{-- ✅ Tombol kembali ditempatkan di dalam section content --}}
<div class="mt-4">
  <a href="{{ route('layanan.dashboard') }}"
     class="inline-flex items-center gap-2 text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition font-medium shadow-sm">
     <i class="fas fa-arrow-left"></i> Kembali ke Dashboard Layanan
  </a>
</div>

@endsection
