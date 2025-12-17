@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-lg shadow w-full">
    <h2 class="text-xl font-bold text-blue-700 mb-4">Pengaturan Website</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Nama Website --}}
        <div>
            <label class="block font-semibold mb-2">Nama Website</label>
            <input type="text" name="site_name" class="border rounded p-2 w-full"
                   value="{{ $settings['site_name'] ?? '' }}">
        </div>

        {{-- Alamat Desa --}}
        <div>
            <label class="block font-semibold mb-2">Alamat Desa</label>
            <input type="text" name="site_address" class="border rounded p-2 w-full"
                   value="{{ $settings['site_address'] ?? '' }}">
        </div>

        {{-- Logo --}}
        <div>
            <label class="block font-semibold mb-2">Logo Website</label>
            <input type="file" name="logo" class="border rounded p-2 w-full">
            @if(!empty($settings['logo']))
                <p class="text-sm text-gray-600 mt-2">Logo saat ini:</p>
                <img src="{{ asset('storage/'.$settings['logo']) }}" class="w-20 h-20 object-cover rounded">
            @endif
        </div>

        {{-- Favicon --}}
        <div>
            <label class="block font-semibold mb-2">Favicon (ikon browser)</label>
            <input type="file" name="favicon" class="border rounded p-2 w-full">
            @if(!empty($settings['favicon']))
                <p class="text-sm text-gray-600 mt-2">Favicon saat ini:</p>
                <img src="{{ asset('storage/'.$settings['favicon']) }}" class="w-8 h-8">
            @endif
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Pengaturan
        </button>
    </form>
</div>
@endsection
