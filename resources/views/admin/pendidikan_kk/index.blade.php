@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Kelola Pendidikan Dalam KK</h2>
    <a href="{{ route('admin.pendidikan_kk.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Tambah Data</a>

    <table class="w-full mt-4 border text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-2">No</th>
                <th class="border px-2">Kelompok</th>
                <th class="border px-2">Jumlah</th>
                <th class="border px-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $row)
            <tr>
                <td class="border px-2">{{ $i+1 }}</td>
                <td class="border px-2">{{ $row->kelompok }}</td>
                <td class="border px-2 text-center">{{ $row->jumlah }}</td>
                <td class="border px-2 text-center">
                    <a href="{{ route('admin.pendidikan_kk.edit',$row->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                    <form action="{{ route('admin.pendidikan_kk.destroy',$row->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="bg-red-600 text-white px-2 py-1 rounded" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
