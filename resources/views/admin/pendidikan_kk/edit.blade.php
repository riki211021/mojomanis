@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-lg shadow w-full">
    <h2 class="text-xl font-bold text-blue-700 mb-4">Edit Data Pendidikan Dalam KK</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ form update --}}
    <form action="{{ route('admin.pendidikan_kk.update', $pendidikan_kk->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Kode (opsional)</label>
            <input type="text" name="kode" value="{{ old('kode', $pendidikan_kk->kode ?? '') }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold">Kelompok</label>
            <input type="text" name="kelompok" value="{{ old('kelompok', $pendidikan_kk->kelompok) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold">Jumlah</label>
            <input type="number" name="jumlah" value="{{ old('jumlah', $pendidikan_kk->jumlah) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>
            <a href="{{ route('admin.pendidikan_kk.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
