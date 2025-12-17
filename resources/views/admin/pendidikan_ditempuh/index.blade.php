@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-xl shadow">
    <h1 class="text-xl font-bold mb-4">Kelola Pendidikan Ditempuh</h1>

    <a href="{{ route('admin.pendidikan_ditempuh.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Data</a>

    <table class="w-full mt-4 border text-sm">
        <thead>
            <tr class="bg-gray-200 text-center font-bold">
                <th class="border px-4 py-2">Kode</th>
                <th class="border px-4 py-2">Kelompok</th>
                <th class="border px-4 py-2">Jumlah</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td class="border px-4 py-2 text-center">{{ $row->kode }}</td>
                <td class="border px-4 py-2">{{ $row->kelompok }}</td>
                <td class="border px-4 py-2 text-center">{{ $row->jumlah }}</td>
                <td class="border px-4 py-2 text-center">
                    <a href="{{ route('admin.pendidikan_ditempuh.edit', $row->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                    <form action="{{ route('admin.pendidikan_ditempuh.destroy', $row->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
