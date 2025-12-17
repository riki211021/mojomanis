@extends('layouts.layanan')


@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-md mt-6">
  <h2 class="text-2xl font-bold text-center mb-6">Registrasi Akun Warga</h2>

  <form method="POST" action="{{ route('layanan.register.post') }}">
    @csrf
    <div class="mb-4">
      <label class="block font-medium mb-1">Nama Lengkap</label>
      <input type="text" name="name" class="border rounded-lg w-full px-3 py-2" required>
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1">Email</label>
      <input type="email" name="email" class="border rounded-lg w-full px-3 py-2" required>
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1">Password</label>
      <input type="password" name="password" class="border rounded-lg w-full px-3 py-2" required>
    </div>

    <div class="mb-6">
      <label class="block font-medium mb-1">Konfirmasi Password</label>
      <input type="password" name="password_confirmation" class="border rounded-lg w-full px-3 py-2" required>
    </div>

    <button class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">Daftar</button>
  </form>
</div>
@endsection
