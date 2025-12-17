@extends('layouts.layanan')

@section('content')
<div class="bg-gradient-to-r from-blue-900 via-indigo-500 to-blue-900 text-white p-8 rounded-2xl shadow-lg mb-6 text-center">
  <h1 class="text-3xl font-extrabold drop-shadow-lg">Dashboard Layanan Masyarakat</h1>
  <p class="text-sm text-blue-100 mt-2">Selamat datang, {{ Auth::guard('layanan')->user()->name ?? 'Warga' }} 👋</p>
</div>

<div class="bg-white p-6 rounded-2xl shadow-md">
  <h2 class="text-xl font-bold text-gray-700 mb-4">Menu Layanan</h2>

  <div class="flex flex-wrap gap-4">
    {{-- 🔹 Jika pengguna adalah Admin --}}
    @if(Auth::guard('layanan')->user()->role === 'admin')
      <a href="{{ route('layanan.admin.dashboard') }}"
         class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-3 rounded-lg font-semibold shadow-md transition transform hover:scale-105">
         🛠 Kelola Pengajuan Warga
      </a>
    @else
      {{-- 🔹 Jika pengguna adalah Warga --}}
      <a href="{{ route('layanan.pengajuan.create') }}"
         class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold shadow-md transition transform hover:scale-105">
         + Ajukan Dokumen
      </a>

      <a href="{{ route('layanan.pengajuan.index') }}"
         class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg font-semibold shadow-md transition transform hover:scale-105">
         📄 Lihat Pengajuan Saya
      </a>

      <a href="{{ route('layanan.pengajuan.balasan') }}"
   class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg shadow transition">
   💌 Balasan Admin
</a>

    @endif

    {{-- 🔹 Tombol Logout (untuk semua pengguna) --}}
    <form action="{{ route('layanan.logout') }}" method="POST" class="inline">
      @csrf
      <button type="submit"
              class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg font-semibold shadow-md transition transform hover:scale-105">
              🚪 Logout
      </button>
    </form>
  </div>
</div>
@endsection
