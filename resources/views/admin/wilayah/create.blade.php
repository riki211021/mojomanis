@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Data Wilayah</h2>

    <form action="{{ route('admin.wilayah.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block">Nama</label>
            <input type="text" name="nama" class="border w-full px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block">Tingkat</label>
            <select name="tingkat" class="border w-full px-3 py-2 rounded" required>
                <option value="">-- Pilih Tingkat --</option>
                <option value="dusun">Dusun</option>
                <option value="rw">RW</option>
                <option value="rt">RT</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="block">Parent (Kosongkan jika Dusun)</label>
            <select name="parent_id" class="border w-full px-3 py-2 rounded">
                <option value="">-- Pilih Parent --</option>
                @foreach($dusun as $d)
                    <option value="{{ $d->id }}">Dusun {{ $d->nama }}</option>
                @endforeach
                @foreach($rw as $r)
                    <option value="{{ $r->id }}">RW {{ $r->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block">Ketua</label>
            <input type="text" name="ketua" class="border w-full px-3 py-2 rounded">
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label>KK</label>
                <input type="number" name="kk" class="border w-full px-3 py-2 rounded" required>
            </div>
            <div>
                <label>Laki-laki</label>
                <input type="number" name="l" class="border w-full px-3 py-2 rounded" required>
            </div>
            <div>
                <label>Perempuan</label>
                <input type="number" name="p" class="border w-full px-3 py-2 rounded" required>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">
            Simpan
        </button>
    </form>
</div>
@endsection
