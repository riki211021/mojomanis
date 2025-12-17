@extends('layouts.layanan')

@section('content')

<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-bold mb-4 text-center">Lupa Password</h2>

    @if(session('error'))
        <p class="text-red-600 text-center mb-3">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('layanan.password.send') }}">
        @csrf

        <label class="block mb-1 font-medium">Email</label>
        <input type="email" name="email"
               class="w-full border rounded-lg px-3 py-2 mb-4"
               required>

        <button class="w-full bg-blue-600 text-white py-2 rounded-lg">
            Kirim Kode Reset
        </button>
    </form>

    <p class="text-center mt-4">
        <a class="text-blue-600" href="{{ route('layanan.login') }}">Kembali ke Login</a>
    </p>
</div>

@endsection
