@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg">
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl font-bold text-gray-800">Kelola UMKM Desa Mojomanis</h2>
        <a href="{{ route('admin.umkm.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
           + Tambah UMKM
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-200 text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr class="text-center font-semibold">
                <th class="border px-3 py-2 w-12">No</th>
                <th class="border px-3 py-2">Nama Usaha</th>
                <th class="border px-3 py-2">Pemilik</th>
                <th class="border px-3 py-2">Kategori</th>

                {{-- Tambahan Kolom Baru --}}
                <th class="border px-3 py-2">No WA</th>
                <th class="border px-3 py-2">Alamat</th>

                <th class="border px-3 py-2">Foto</th>
                <th class="border px-3 py-2 w-32">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $row)
            <tr class="hover:bg-gray-50 text-center">
                <td class="border px-3 py-2">{{ $loop->iteration }}</td>
                <td class="border px-3 py-2 text-left font-medium text-gray-800">{{ $row->nama_usaha }}</td>
                <td class="border px-3 py-2">{{ $row->pemilik ?? '-' }}</td>
                <td class="border px-3 py-2 capitalize">{{ $row->kategori ?? '-' }}</td>

                {{-- WA --}}
                <td class="border px-3 py-2 text-green-700 font-medium">
                    @if($row->wa)
                        <a href="https://wa.me/{{ $row->wa }}" target="_blank" class="underline hover:text-green-900">
                            {{ $row->wa }}
                        </a>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>

                {{-- Alamat --}}
                <td class="border px-3 py-2 text-left">
                    {{ $row->alamat ? Str::limit($row->alamat, 30) : '-' }}
                </td>

                <td class="border px-3 py-2">
                    @if($row->foto)
                        <img src="{{ asset('storage/'.$row->foto) }}" class="w-16 h-16 object-cover rounded-lg mx-auto shadow">
                    @else
                        <span class="text-gray-400 italic">Tidak ada</span>
                    @endif
                </td>

                <td class="border px-3 py-2">
                    <a href="{{ route('admin.umkm.edit', $row->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                        Edit
                    </a>

                    <form action="{{ route('admin.umkm.destroy', $row->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus data ini?')"
                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center py-4 text-gray-500 italic">Belum ada data UMKM.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
