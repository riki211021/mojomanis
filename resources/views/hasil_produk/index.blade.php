@extends('layouts.master')

@section('content')
<div class="container mx-auto p-6">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">📊 Hasil Produk Pertanian (Admin)</h2>
    <a href="{{ route('admin.hasil_produk.create') }}"
       class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
       ➕ Tambah Data
    </a>
  </div>

  @if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
  @endif

  <div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full table-auto text-sm">
      <thead class="bg-gray-50 text-gray-700">
        <tr>
          <th class="p-3 border">No</th>
          <th class="p-3 border">Dusun</th>
          <th class="p-3 border">RT</th>
          <th class="p-3 border">Tahun</th>
          <th class="p-3 border">Produk</th>
          <th class="p-3 border">Musim 1</th>
          <th class="p-3 border">Musim 2</th>
          <th class="p-3 border">Musim 3</th>
          <th class="p-3 border">Total</th>
          <th class="p-3 border">Foto (KG)</th>
          <th class="p-3 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $i => $item)
        <tr class="hover:bg-gray-50">
          <td class="p-3 border text-center">{{ $i + 1 }}</td>
          <td class="p-3 border">{{ $item->dusun }}</td>
          <td class="p-3 border text-center">{{ $item->rt }}</td>
          <td class="p-3 border text-center">{{ $item->tahun }}</td>
          <td class="p-3 border text-center">{{ $item->produk }}</td>
          <td class="p-3 border text-right">{{ number_format($item->musim_1 ?? 0) }}</td>
          <td class="p-3 border text-right">{{ number_format($item->musim_2 ?? 0) }}</td>
          <td class="p-3 border text-right">{{ number_format($item->musim_3 ?? 0) }}</td>
          <td class="p-3 border text-right font-bold text-green-700">{{ number_format($item->total_tahun ?? 0) }}</td>
          <td class="p-3 border text-center">
            @if($item->foto)
              <img src="{{ asset('storage/'.$item->foto) }}"
                   alt="foto"
                   class="w-14 h-14 object-cover rounded-lg mx-auto cursor-pointer"
                   onclick="openLightbox('{{ asset('storage/'.$item->foto) }}')">
            @else
              <span class="text-gray-400 text-xs">Tidak ada</span>
            @endif
          </td>
          <td class="p-3 border text-center">
            <a href="{{ route('admin.hasil_produk.edit', $item->id) }}"
               class="text-yellow-600 hover:text-yellow-800 mr-3">Edit</a>

            <form action="{{ route('admin.hasil_produk.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="11" class="p-6 text-center text-gray-500">Belum ada data.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Lightbox (reusable) --}}
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-80 hidden items-center justify-center z-50">
  {{-- Tombol close di pojok luar kanan --}}
  <button onclick="closeLightbox()" class="absolute top-6 right-8 text-white p-2 rounded-full hover:bg-white/10">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
  </button>

  <img id="lightbox-img" src="" class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-2xl transform scale-95 opacity-0 transition duration-200">
</div>

<script>
function openLightbox(src){
  const lb = document.getElementById('lightbox');
  const img = document.getElementById('lightbox-img');
  img.src = src;
  lb.classList.remove('hidden');
  lb.classList.add('flex');
  setTimeout(()=> {
    img.classList.remove('scale-95','opacity-0');
    img.classList.add('scale-100','opacity-100');
  }, 10);
}
function closeLightbox(){
  const lb = document.getElementById('lightbox');
  const img = document.getElementById('lightbox-img');
  img.classList.remove('scale-100','opacity-100');
  img.classList.add('scale-95','opacity-0');
  setTimeout(()=> {
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    img.src = '';
  }, 180);
}
</script>
@endsection
