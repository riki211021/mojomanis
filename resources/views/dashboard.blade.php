@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold text-blue-700 mb-4">Dashboard Admin Desa</h2>
    <p>Halo, {{ Auth::user()->name }}! 👋</p>

    <a href="{{ route('artikel.index') }}"
       class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded">
       Kelola Artikel
    </a>
</div>
@endsection
