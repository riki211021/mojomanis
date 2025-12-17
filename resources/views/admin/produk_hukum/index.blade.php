@extends('layouts.master')


@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Kelola Produk Hukum</h2>
    <a href="{{ route('admin.produk_hukum.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Tambah Data</a>

    <table class="w-full mt-4 border text-sm">
        <thead class="bg-gray-200 text-center font-bold">
            <tr>
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Judul</th>
                <th class="border px-4 py-2">Jenis</th>
                <th class="border px-4 py-2">Tahun</th>
                <th class="border px-4 py-2">File</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">{{ $row->judul }}</td>
                <td class="border px-4 py-2 text-center">{{ $row->jenis }}</td>
                <td class="border px-4 py-2 text-center">{{ $row->tahun }}</td>
                <td class="border px-4 py-2 text-center">
                    @if($row->file)
                        <a href="{{ asset('storage/'.$row->file) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="border px-4 py-2 text-center">
                    <a href="{{ route('admin.produk_hukum.edit', $row->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('admin.produk_hukum.destroy', $row->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus data ini?')" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
