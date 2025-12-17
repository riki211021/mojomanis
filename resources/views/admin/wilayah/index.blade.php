@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Kelola Data Wilayah</h2>
    <a href="{{ route('admin.wilayah.create') }}"
       class="bg-blue-600 text-white px-3 py-2 rounded">+ Tambah Wilayah</a>

    <table class="w-full border mt-4 text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-2">No</th>
                <th class="border px-2">Nama</th>
                <th class="border px-2">Tingkat</th>
                <th class="border px-2">Parent</th>
                <th class="border px-2">Ketua</th>
                <th class="border px-2">KK</th>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wilayah as $i => $w)
            <tr>
                <td class="border px-2 text-center">{{ $i+1 }}</td>
                <td class="border px-2">{{ $w->nama }}</td>
                <td class="border px-2">{{ strtoupper($w->tingkat) }}</td>
                <td class="border px-2">
                    {{ $w->parent ? $w->parent->nama : '-' }}
                </td>
                <td class="border px-2">{{ $w->ketua }}</td>
                <td class="border px-2 text-center">{{ $w->kk }}</td>
                <td class="border px-2 text-center">{{ $w->l }}</td>
                <td class="border px-2 text-center">{{ $w->p }}</td>
                <td class="border px-2 text-center">
                    <a href="{{ route('admin.wilayah.edit',$w->id) }}"
                       class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                    <form action="{{ route('admin.wilayah.destroy',$w->id) }}"
                          method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="bg-red-600 text-white px-2 py-1 rounded"
                                onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
