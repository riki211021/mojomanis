@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">
    <h1 class="text-xl font-bold mb-4">Kelola Data Jenis Kelamin</h1>

    {{-- Tombol tambah --}}
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.jenis_kelamin.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Data</a>
    </div>

    {{-- Table --}}
    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-200 text-center font-bold">
                <th class="border px-4 py-2">Kode</th>
                <th class="border px-4 py-2">Kelompok</th>
                <th class="border px-4 py-2">Jumlah (n)</th>
                <th class="border px-4 py-2 w-40">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
                <tr>
                    <td class="border px-4 py-2 text-center">{{ $row->kode }}</td>
                    <td class="border px-4 py-2">{{ $row->kelompok }}</td>
                    <td class="border px-4 py-2 text-center">{{ $row->jumlah }}</td>
                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('admin.jenis_kelamin.edit', $row->id) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('admin.jenis_kelamin.destroy', $row->id) }}"
                              method="POST" class="inline-block"
                              onsubmit="return confirm('Yakin mau hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
