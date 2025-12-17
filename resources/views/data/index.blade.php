@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <div class="max-w-6xl mx-auto space-y-10">

        {{-- Hero Section --}}
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-8 rounded-2xl shadow-lg text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Data Desa Mojomanis</h1>
            <p class="text-blue-100 text-lg">
                Selamat datang di halaman Data Desa Mojomanis, Kecamatan Kwadungan, Kabupaten Ngawi
            </p>
        </div>

        {{-- Informasi --}}
        <div class="bg-white p-8 rounded-2xl shadow-lg">
            <p class="text-gray-700 leading-relaxed mb-6 text-justify">
                Halaman ini berisi tautan menuju informasi mengenai <strong>Basis Data Desa</strong>.
                Data yang dimuat meliputi basis data kependudukan dan basis data sumber daya desa.
                Silakan pilih kategori di bawah ini untuk melihat tampilan data statistik secara lebih detail.
            </p>

            {{-- Grid Data Desa --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('data.wilayah') }}" class="flex items-center p-5 bg-blue-50 rounded-xl border hover:bg-blue-100 transition shadow-sm">
                    <i class="fas fa-map-marked-alt text-blue-600 text-xl mr-3"></i>
                    <span class="font-medium text-gray-800">Data Wilayah Administratif</span>
                </a>

                <a href="{{ route('data.pendidikan.kk') }}" class="flex items-center p-5 bg-blue-50 rounded-xl border hover:bg-blue-100 transition shadow-sm">
                    <i class="fas fa-school text-blue-600 text-xl mr-3"></i>
                    <span class="font-medium text-gray-800">Data Pendidikan dalam KK</span>
                </a>

                <a href="{{ route('data.pendidikan.ditempuh') }}" class="flex items-center p-5 bg-blue-50 rounded-xl border hover:bg-blue-100 transition shadow-sm">
                    <i class="fas fa-book-open text-blue-600 text-xl mr-3"></i>
                    <span class="font-medium text-gray-800">Data Pendidikan Ditempuh</span>
                </a>

                <a href="{{ route('data.pekerjaan') }}" class="flex items-center p-5 bg-blue-50 rounded-xl border hover:bg-blue-100 transition shadow-sm">
                    <i class="fas fa-briefcase text-blue-600 text-xl mr-3"></i>
                    <span class="font-medium text-gray-800">Data Pekerjaan</span>
                </a>

                <a href="{{ route('data.agama') }}" class="flex items-center p-5 bg-blue-50 rounded-xl border hover:bg-blue-100 transition shadow-sm">
                    <i class="fas fa-praying-hands text-blue-600 text-xl mr-3"></i>
                    <span class="font-medium text-gray-800">Data Agama</span>
                </a>

                <a href="{{ route('data.jenis.kelamin') }}" class="flex items-center p-5 bg-blue-50 rounded-xl border hover:bg-blue-100 transition shadow-sm">
                    <i class="fas fa-venus-mars text-blue-600 text-xl mr-3"></i>
                    <span class="font-medium text-gray-800">Data Jenis Kelamin</span>
                </a>

                <a href="{{ route('data.warga.negara') }}" class="flex items-center p-5 bg-blue-50 rounded-xl border hover:bg-blue-100 transition shadow-sm">
                    <i class="fas fa-flag text-blue-600 text-xl mr-3"></i>
                    <span class="font-medium text-gray-800">Data Warga Negara</span>
                </a>
            </div>

            {{-- Penjelasan --}}
            <p class="text-gray-600 leading-relaxed mt-8 text-sm text-justify">
                Data yang tampil adalah hasil pengolahan dari data dasar yang dilakukan secara <em>offline</em> di kantor desa.
                Data dasar kemudian diunggah ke sistem <em>online</em> pada website ini secara berkala.
                Silakan hubungi pemerintah desa untuk mendapatkan informasi terbaru.
            </p>
        </div>
    </div>
</div>
@endsection
