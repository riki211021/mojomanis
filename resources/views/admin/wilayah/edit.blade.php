@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Edit Data Wilayah</h2>

    <form action="{{ route('admin.wilayah.update', $wilayah->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Wilayah</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama', $wilayah->nama) }}" required>
        </div>

        <div class="mb-3">
            <label>Tingkat</label>
            <select name="tingkat" class="form-control" required>
                <option value="dusun" {{ $wilayah->tingkat == 'dusun' ? 'selected' : '' }}>Dusun</option>
                <option value="rw" {{ $wilayah->tingkat == 'rw' ? 'selected' : '' }}>RW</option>
                <option value="rt" {{ $wilayah->tingkat == 'rt' ? 'selected' : '' }}>RT</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Parent (Kosongkan jika Dusun)</label>
            <select name="parent_id" class="form-control">
                <option value="">-- Tidak ada (Dusun) --</option>
                @foreach($dusun as $d)
                    <option value="{{ $d->id }}"
                        {{ $wilayah->parent_id == $d->id ? 'selected' : '' }}>
                        Dusun {{ $d->nama }}
                    </option>
                @endforeach
                @foreach($rw as $r)
                    <option value="{{ $r->id }}"
                        {{ $wilayah->parent_id == $r->id ? 'selected' : '' }}>
                        RW {{ $r->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Ketua</label>
            <input type="text" name="ketua" class="form-control"
                   value="{{ old('ketua', $wilayah->ketua) }}" required>
        </div>

        <div class="row">
            <div class="col">
                <label>KK</label>
                <input type="number" name="kk" class="form-control"
                       value="{{ old('kk', $wilayah->kk) }}" required>
            </div>
            <div class="col">
                <label>Laki-laki</label>
                <input type="number" name="l" class="form-control"
                       value="{{ old('l', $wilayah->l) }}" required>
            </div>
            <div class="col">
                <label>Perempuan</label>
                <input type="number" name="p" class="form-control"
                       value="{{ old('p', $wilayah->p) }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
        <a href="{{ route('admin.wilayah.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection
