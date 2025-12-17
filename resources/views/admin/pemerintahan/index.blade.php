@extends('layouts.master')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Kelola Struktur Pemerintahan Desa</h2>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('admin.struktur.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
           + Tambah Jabatan
        </a>
    </div>

    <table class="w-full border border-gray-300 rounded-lg shadow-sm">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="py-3 px-4 text-left">Jabatan</th>
                <th class="py-3 px-4 text-left">Nama</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($struktur as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4 font-semibold">{{ $item->jabatan }}</td>
                <td class="py-3 px-4">{{ $item->nama }}</td>
                <td class="py-3 px-4 text-center space-x-2">
                    <a href="{{ route('admin.struktur.edit', $item->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                        Edit
                    </a>
                    <form action="{{ route('admin.struktur.destroy', $item->id) }}"
                          method="POST" class="inline"
                          onsubmit="return confirm('Yakin mau hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
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
