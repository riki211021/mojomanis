@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-bold text-blue-700 flex items-center gap-2">
            📚 Manajemen Artikel
        </h2>

        <a href="{{ route('admin.artikel.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow">
            + Tambah Artikel
        </a>
    </div>

    @if($artikels->isEmpty())
        <div class="text-center text-gray-600 py-10">
            <p class="text-lg">Belum ada artikel yang ditambahkan.</p>
        </div>

    @else

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full text-sm text-gray-700">
    <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
        <tr>
            <th class="px-4 py-3 border">Judul</th>              {{-- 1 --}}
            <th class="px-4 py-3 border">Penulis</th>           {{-- 2 --}}
            <th class="px-4 py-3 border">Tanggal</th>           {{-- 3 --}}
            <th class="px-4 py-3 border text-center">Foto Utama</th>  {{-- 4 --}}
            <th class="px-4 py-3 border text-center">Foto Tambahan</th> {{-- 5 --}}
            <th class="px-4 py-3 border text-center">Aksi</th>  {{-- 6 --}}
        </tr>
    </thead>

    <tbody>
        @foreach($artikels as $artikel)
        <tr class="hover:bg-blue-50 transition">

            {{-- 1. Judul --}}
            <td class="border px-4 py-3 font-semibold">
                {{ Str::limit($artikel->judul, 50) }}
            </td>

            {{-- 2. Penulis --}}
            <td class="border px-4 py-3">
                {{ $artikel->penulis }}
            </td>

            {{-- 3. Tanggal --}}
            <td class="border px-4 py-3">
                {{ $artikel->created_at->format('d-m-Y') }}
            </td>

            {{-- 4. FOTO UTAMA --}}
            <td class="border px-4 py-3 text-center">
                @if($artikel->gambar)
                    <img src="{{ asset('uploads/'.$artikel->gambar) }}"
                        class="w-16 h-12 rounded object-cover mx-auto shadow">
                @else
                    <div class="w-16 h-12 bg-gray-200 rounded flex items-center justify-center mx-auto text-gray-500 text-xs">
                        No Image
                    </div>
                @endif
            </td>

            {{-- 5. FOTO TAMBAHAN --}}
            <td class="border px-4 py-3 text-center">
                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">
                    {{ $artikel->photos->count() }} foto
                </span>
            </td>

            {{-- 6. AKSI --}}
            <td class="border px-4 py-3 text-center space-x-1">

                {{-- Edit --}}
                <a href="{{ route('admin.artikel.edit', $artikel->id) }}"
                    class="inline-block bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                    ✏️ Edit
                </a>

                {{-- Hapus --}}
                <form action="{{ route('admin.artikel.destroy', $artikel->id) }}"
                    method="POST" class="inline"
                    onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                        🗑️ Hapus
                    </button>
                </form>

            </td>

        </tr>
        @endforeach
    </tbody>
</table>
    </div>

    <div class="mt-4">
        {{ $artikels->links('pagination::tailwind') }}
    </div>

    @endif
</div>
@endsection
