@extends('layouts.layanan')

@section('content')

<div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-md mt-10">

  {{-- Judul Login --}}
  <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
    Login Layanan Masyarakat
  </h2>

  {{-- Notifikasi --}}
  @if(session('success'))
    <p class="text-green-600 text-center mb-4">{{ session('success') }}</p>
  @endif

  {{-- Form Login --}}
  <form method="POST" action="{{ route('layanan.login.post') }}">
    @csrf

    <div class="mb-4">
      <label class="block font-medium mb-1">Email</label>
      <input type="email" name="email"
             class="border rounded-lg w-full px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
             required>
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1">Password</label>
      <input type="password" name="password"
             class="border rounded-lg w-full px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
             required>
    </div>

    {{-- ⭐ LINK LUPA PASSWORD --}}
    <div class="flex justify-end mb-4 -mt-1">
      <a href="{{ route('layanan.password.request') }}"
         class="text-blue-600 text-sm hover:underline">
         Lupa password?
      </a>
    </div>
    {{-- ⭐ END --}}


    {{-- Login Sebagai --}}
    <div class="mb-4">
      <label class="block font-medium mb-1">Masuk Sebagai</label>
      <select name="role"
              class="border rounded-lg w-full px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        <option value="warga">Warga</option>
        <option value="admin">Admin</option>
      </select>
    </div>

    <button class="w-full bg-blue-600 text-white py-2 mt-2 rounded-lg hover:bg-blue-700 transition shadow">
      Login
    </button>

    <p class="text-center text-sm mt-4 text-gray-700">
      Belum punya akun?
      <a href="{{ route('layanan.register') }}" class="text-blue-600 hover:underline font-medium">
        Daftar di sini
      </a>
    </p>
  </form>
</div>

{{-- 🔙 Tombol kembali ke beranda --}}
<div class="max-w-md mx-auto mt-4 text-center">
  <a href="{{ url('/') }}"
     class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition shadow">
     <i class="fas fa-arrow-left"></i> Kembali ke Beranda
  </a>
</div>

@endsection
