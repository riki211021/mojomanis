@extends('layouts.layanan')

@section('content')

<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-bold mb-4 text-center">Reset Password</h2>

    @if(session('success'))
        <p class="text-green-600 text-center mb-3">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p class="text-red-600 text-center mb-3">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('layanan.password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <label class="block mb-1 font-medium">Password Baru</label>
        <input type="password" name="password"
               class="w-full border rounded-lg px-3 py-2 mb-3"
               required>

        <label class="block mb-1 font-medium">Konfirmasi Password</label>
        <input type="password" name="password_confirmation"
               class="w-full border rounded-lg px-3 py-2 mb-4"
               required>

        <button class="w-full bg-green-600 text-white py-2 rounded-lg">
            Simpan Password Baru
        </button>
    </form>
</div>

@endsection
