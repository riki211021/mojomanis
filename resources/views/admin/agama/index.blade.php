@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">
    <h1 class="text-xl font-bold mb-4">Kelola Data Agama</h1>

    <a href="{{ route('admin.agama.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
       + Tambah Data
    </a>

    <table class="w-full mt-4 border text-sm">
        <thead>
            <tr class="bg-gray-200 text-center font-bold">
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Kode</th>
                <th class="border px-4 py-2">Kelompok</th>
                <th class="border px-4 py-2">Jumlah</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
            <tr>
                <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2 text-center">{{ $row->kode }}</td>
                <td class="border px-4 py-2">{{ $row->kelompok }}</td>
                <td class="border px-4 py-2 text-center">{{ $row->jumlah }}</td>
                <td class="border px-4 py-2 text-center">
                    <a href="{{ route('admin.agama.edit', $row->id) }}"
                       class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('admin.agama.destroy', $row->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700"
                                onclick="return confirm('Yakin hapus data ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data agama</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
