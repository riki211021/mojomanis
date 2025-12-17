@extends('layouts.master')


@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Kelola Informasi Publik</h2>

    {{-- Tombol Tambah --}}
    <a href="{{ route('admin.informasi_publik.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
        + Tambah Data
    </a>

    {{-- Table --}}
    <div class="mt-4 overflow-x-auto">
        <table class="w-full border text-sm">
            <thead class="bg-gray-200 text-center font-bold">
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2 text-left">Judul Informasi</th>
                    <th class="border px-4 py-2">Kategori</th>
                    <th class="border px-4 py-2">Tahun</th>
                    <th class="border px-4 py-2">File</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $row->judul }}</td>
                        <td class="border px-4 py-2 text-center">{{ $row->kategori ?? '-' }}</td>
                        <td class="border px-4 py-2 text-center">{{ $row->tahun ?? '-' }}</td>
                        <td class="border px-4 py-2 text-center">
                            @if($row->file)
                                <a href="{{ asset('storage/'.$row->file) }}"
                                   target="_blank"
                                   class="text-blue-600 hover:underline">
                                   Lihat PDF
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('admin.informasi_publik.edit', $row->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('admin.informasi_publik.destroy', $row->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">
                            Belum ada data informasi publik
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
