@extends('layouts.master')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <div class="bg-white rounded-2xl shadow p-6">
    <h3 class="text-xl font-semibold mb-4">➕ Tambah Hasil Produk Pertanian</h3>

    @if($errors->any())
      <div class="bg-red-50 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.hasil_produk.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Dusun</label>
          <input name="dusun" value="{{ old('dusun') }}" class="w-full border rounded p-2" />
        </div>

        <div>
          <label class="block text-sm font-medium">RT</label>
          <input name="rt" value="{{ old('rt') }}" class="w-full border rounded p-2" />
        </div>

        <div>
          <label class="block text-sm font-medium">Tahun</label>
          <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" class="w-full border rounded p-2" required />
        </div>
      </div>

      <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium">Produk</label>
          <select name="produk" class="w-full border rounded p-2" required>
            <option value="">-- Pilih Produk --</option>
            <option value="Padi" {{ old('produk')=='Padi'?'selected':'' }}>Padi</option>
            <option value="Polowijo" {{ old('produk')=='Polowijo'?'selected':'' }}>Polowijo</option>
            <option value="Tebu" {{ old('produk')=='Tebu'?'selected':'' }}>Tebu</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium">Koordinat (opsional)</label>
          <input name="koordinat" value="{{ old('koordinat') }}" class="w-full border rounded p-2" placeholder="lat,long" />
        </div>
      </div>

      <div class="mt-4 grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Musim 1 (kg)</label>
          <input type="number" name="musim_1" value="{{ old('musim_1',0) }}" class="w-full border rounded p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Musim 2 (kg)</label>
          <input type="number" name="musim_2" value="{{ old('musim_2',0) }}" class="w-full border rounded p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Musim 3 (kg)</label>
          <input type="number" name="musim_3" value="{{ old('musim_3',0) }}" class="w-full border rounded p-2" />
        </div>
      </div>

      <div class="mt-4">
        <label class="block text-sm font-medium">Foto (opsional)</label>
        <input type="file" name="foto" accept="image/*" class="w-full" />
      </div>

      <div class="mt-6 flex justify-between">
        <a href="{{ route('admin.hasil_produk.index') }}" class="px-4 py-2 bg-gray-200 rounded">Kembali</a>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
