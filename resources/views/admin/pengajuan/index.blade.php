@extends('layouts.layanan')


@section('content')
<div class="bg-gradient-to-r from-blue-600 to-indigo-500 text-white p-6 rounded-xl shadow-md mb-6">
  <h2 class="text-2xl font-bold">Kelola Pengajuan Warga</h2>
  <p class="text-blue-100 text-sm">Daftar semua pengajuan layanan masyarakat yang masuk</p>
</div>

@if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
  </div>
@endif

<table class="w-full border-collapse bg-white shadow-md rounded-xl overflow-hidden">
  <thead>
    <tr class="bg-gray-100 text-left">
      <th class="p-3">#</th>
      <th class="p-3">Nama Warga</th>
      <th class="p-3">Jenis Dokumen</th>
      <th class="p-3">Keterangan</th>
      <th class="p-3">Lampiran</th>
      <th class="p-3">Status</th>
      <th class="p-3">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pengajuan as $p)
    <tr class="border-t">
      <td class="p-3">{{ $loop->iteration }}</td>
      <td class="p-3">{{ $p->warga->name }}</td>
      <td class="p-3">{{ $p->jenis_dokumen }}</td>
      <td class="p-3">{{ $p->keterangan ?? '-' }}</td>
      <td class="p-3">
        @if($p->lampiran)
          <a href="{{ asset('storage/'.$p->lampiran) }}" class="text-blue-600 underline" target="_blank">Lihat</a>
        @else
          <span class="text-gray-400">Tidak ada</span>
        @endif
      </td>
      <td class="p-3">
        <span class="font-semibold
          {{ $p->status == 'Menunggu' ? 'text-yellow-600' : ($p->status == 'Diproses' ? 'text-blue-600' : 'text-green-600') }}">
          {{ $p->status }}
        </span>
      </td>
      <td class="p-3">
        <form action="{{ route('admin.pengajuan.update', $p->id) }}" method="POST" class="flex flex-col md:flex-row gap-2">
          @csrf
          @method('PUT')
          <select name="status" class="border rounded-lg px-2 py-1 text-sm">
            <option {{ $p->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option {{ $p->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
            <option {{ $p->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
          </select>
          <input type="text" name="catatan_admin" placeholder="Catatan..." value="{{ $p->catatan_admin }}" class="border rounded-lg px-2 py-1 text-sm flex-1">
          <button class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 text-sm">Update</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection

