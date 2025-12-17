<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  @php
      use App\Models\Setting;
      $settings = Setting::pluck('value','key');
  @endphp

  <title>{{ $settings['site_name'] ?? 'Website Resmi Desa Cerdas' }}</title>

  {{-- favicon --}}
  @if(!empty($settings['favicon']))
      <link rel="icon" href="{{ asset('storage/'.$settings['favicon']) }}" type="image/x-icon"/>
  @else
      <link rel="icon" href="{{ asset('images/default-favicon.png') }}" type="image/x-icon"/>
  @endif

  {{-- Font modern --}}
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
      body { font-family: 'Inter', sans-serif; }
  </style>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Header -->
  <header class="flex items-center justify-between bg-gradient-to-r from-blue-700 to-blue-600 text-white px-6 py-4 shadow">
      <div class="flex items-center space-x-3">
          {{-- Logo --}}
          @if(!empty($settings['logo']))
              <img src="{{ asset('storage/'.$settings['logo']) }}" alt="Logo Desa"
                   class="w-12 h-12 rounded-full bg-white p-1 shadow">
          @else
              <img src="{{ asset('images/default-logo.png') }}" alt="Logo Default"
                   class="w-12 h-12 rounded-full bg-white p-1 shadow">
          @endif

          {{-- Nama Website --}}
          <div>
              <h1 class="text-lg font-bold">{{ $settings['site_name'] ?? 'WEBSITE RESMI DESA CERDAS' }}</h1>
              <p class="text-sm opacity-90">{{ $settings['site_address'] ?? 'Kec. Contoh, Kab. Contoh, Prov. Jawa Timur' }}</p>
          </div>
      </div>

      {{-- Jam Digital --}}
      <div class="text-right hidden md:block">
          <span id="clock" class="font-mono text-sm"></span>
      </div>
  </header>

<!-- 🌐 Navbar Modern Dinamis -->
<nav class="bg-blue-800 text-white px-6 shadow-md relative z-50">
  <ul class="flex flex-wrap gap-6 py-3 text-sm font-medium">

    <!-- 🏠 Beranda -->
    <li class="relative">
      <a href="{{ route('home') }}"
         class="pb-1 transition hover:text-yellow-300 {{ request()->routeIs('home') ? 'text-yellow-300 font-semibold after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-full after:bg-yellow-300 after:rounded-full transition-all duration-300' : '' }}">
        Beranda
      </a>
    </li>

    <!-- 🏡 Profil Desa -->
    <li class="relative">
      <a href="{{ route('profil') }}"
         class="pb-1 transition hover:text-yellow-300 {{ request()->routeIs('profil') ? 'text-yellow-300 font-semibold after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-full after:bg-yellow-300 after:rounded-full transition-all duration-300' : '' }}">
        Profil Desa
      </a>
    </li>

    <!-- 👥 Pemerintahan Desa -->
    <li class="relative">
      <a href="{{ route('pemerintahan.index') }}"
         class="pb-1 transition hover:text-yellow-300 {{ request()->routeIs('pemerintahan.index') ? 'text-yellow-300 font-semibold after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-full after:bg-yellow-300 after:rounded-full transition-all duration-300' : '' }}">
        Pemerintahan Desa
      </a>
    </li>

    <!-- 📊 Dropdown Data Desa -->
    <li class="relative group">
      <div class="flex items-center gap-1 cursor-pointer select-none">
        <a href="{{ route('data.desa') }}"
           class="pb-1 transition hover:text-yellow-300 {{ request()->is('data*') ? 'text-yellow-300 font-semibold after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-full after:bg-yellow-300 after:rounded-full transition-all duration-300' : '' }}">
          Data Desa
        </a>
        <button onclick="toggleDropdown('data-desa')" class="focus:outline-none hover:text-yellow-300 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-[1px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
      </div>

      <!-- Dropdown Menu -->
      <ul id="dropdown-data-desa"
          class="absolute hidden bg-blue-800 text-white rounded-lg shadow-xl mt-2 w-64 z-50 transition-all duration-300 ease-out opacity-0 transform scale-95">
        <li><a href="{{ route('data.wilayah') }}" class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300"><i class="fas fa-map-marked-alt w-5"></i><span class="ml-2">Data Wilayah</span></a></li>
        <li><a href="{{ route('data.pendidikan.kk') }}" class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300"><i class="fas fa-school w-5"></i><span class="ml-2">Pendidikan KK</span></a></li>
        <li><a href="{{ route('data.pendidikan.ditempuh') }}" class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300"><i class="fas fa-book-open w-5"></i><span class="ml-2">Pendidikan Ditempuh</span></a></li>
        <li><a href="{{ route('data.pekerjaan') }}" class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300"><i class="fas fa-briefcase w-5"></i><span class="ml-2">Pekerjaan</span></a></li>
        <li><a href="{{ route('data.agama') }}" class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300"><i class="fas fa-praying-hands w-5"></i><span class="ml-2">Agama</span></a></li>
        <li><a href="{{ route('data.jenis.kelamin') }}" class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300"><i class="fas fa-venus-mars w-5"></i><span class="ml-2">Jenis Kelamin</span></a></li>
        <li><a href="{{ route('data.warga.negara') }}" class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300"><i class="fas fa-id-card w-5"></i><span class="ml-2">Warga Negara</span></a></li>
      </ul>
    </li>

    <!-- ⚖️ Dropdown Regulasi -->
    <li class="relative group">
      <div class="flex items-center gap-1 cursor-pointer select-none">
        <a href="{{ route('data.produk.hukum') }}"
           class="pb-1 transition hover:text-yellow-300 {{ request()->is('data/produk-hukum*') || request()->is('data/informasi-publik*') ? 'text-yellow-300 font-semibold after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-full after:bg-yellow-300 after:rounded-full transition-all duration-300' : '' }}">
          Regulasi
        </a>
        <button onclick="toggleDropdown('regulasi')" class="focus:outline-none hover:text-yellow-300 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-[1px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
      </div>

      <!-- Dropdown Menu -->
      <ul id="dropdown-regulasi"
          class="absolute hidden bg-blue-800 text-white rounded-lg shadow-xl mt-2 w-56 z-50 transition-all duration-300 ease-out opacity-0 transform scale-95">
        <li>
          <a href="{{ route('data.produk.hukum') }}"
             class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300 transition {{ request()->is('data/produk-hukum*') ? 'bg-blue-700 text-yellow-300' : '' }}">
            <i class="fas fa-balance-scale w-5"></i>
            <span class="ml-2">Produk Hukum</span>
          </a>
        </li>
        <li>
          <a href="{{ route('data.informasi.publik') }}"
             class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300 transition {{ request()->is('data/informasi-publik*') ? 'bg-blue-700 text-yellow-300' : '' }}">
            <i class="fas fa-info-circle w-5"></i>
            <span class="ml-2">Informasi Publik</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- 🏪 UMKM -->
    <li class="relative">
      <a href="{{ route('data.umkm') }}"
         class="pb-1 transition hover:text-yellow-300 {{ request()->is('umkm-desa*') ? 'text-yellow-300 font-semibold after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-full after:bg-yellow-300 after:rounded-full transition-all duration-300' : '' }}">
        UMKM Desa
      </a>
    </li>

    <!-- 🌾 Pertanian (Dropdown Klik Panah) -->
<li class="relative group">
  <div class="flex items-center gap-1 cursor-pointer select-none">
      <a href="{{ route('pertanian.public') }}"
         class="pb-1 transition hover:text-yellow-300 {{ request()->is('pertanian*') || request()->is('hasil-produk*') ? 'text-yellow-300 font-semibold after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-full after:bg-yellow-300 after:rounded-full' : '' }}">
          Pertanian
      </a>

      <!-- Tombol Panah -->
      <button onclick="toggleDropdown('pertanian')"
              class="focus:outline-none hover:text-yellow-300 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
      </button>
  </div>

  <!-- DROPDOWN MENU -->
  <ul id="dropdown-pertanian"
      class="absolute hidden bg-blue-800 text-white rounded-lg shadow-xl mt-2 w-60 z-50 transition-all duration-300 ease-out opacity-0 transform scale-95">

      <li>
        <a href="{{ route('pertanian.public') }}"
           class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300 transition {{ request()->is('pertanian') ? 'bg-blue-700 text-yellow-300' : '' }}">
            <i class="fas fa-tractor w-5"></i>
            <span class="ml-2">Data Pertanian</span>
        </a>
      </li>

      <li>
        <a href="{{ route('hasil_produk.public') }}"
           class="flex items-center px-4 py-2 hover:bg-blue-700 hover:text-yellow-300 transition {{ request()->is('hasil-produk*') ? 'bg-blue-700 text-yellow-300' : '' }}">
            <i class="fas fa-leaf w-5"></i>
            <span class="ml-2">Hasil Produk Pertanian</span>
        </a>
      </li>

  </ul>
</li>

<!-- 🎥 Galeri Video -->
<li class="relative">
  <a href="{{ route('video.public') }}"
     class="pb-1 transition hover:text-yellow-300
     {{ request()->is('video-galeri*') ? 'text-yellow-300 font-semibold
        after:absolute after:left-0 after:bottom-0 after:h-[3px]
        after:w-full after:bg-yellow-300 after:rounded-full transition-all duration-300' : '' }}">
      Galeri Video
  </a>
</li>





</nav>

<!-- ✨ Script -->
<script>
function toggleDropdown(id) {
  const dropdown = document.getElementById('dropdown-' + id);

  // animasi buka/tutup dengan fade & scale
  if (dropdown.classList.contains('hidden')) {
    dropdown.classList.remove('hidden');
    setTimeout(() => {
      dropdown.classList.remove('opacity-0', 'scale-95');
      dropdown.classList.add('opacity-100', 'scale-100');
    }, 10);
  } else {
    dropdown.classList.remove('opacity-100', 'scale-100');
    dropdown.classList.add('opacity-0', 'scale-95');
    setTimeout(() => dropdown.classList.add('hidden'), 150);
  }
}

// klik di luar → dropdown nutup
window.addEventListener('click', function(e) {
  ['data-desa', 'regulasi', 'pertanian'].forEach(id => {
    const dropdown = document.getElementById('dropdown-' + id);
    const btn = document.querySelector(`button[onclick="toggleDropdown('${id}')"]`);

    if (dropdown && !dropdown.contains(e.target) && !btn.contains(e.target)) {
        dropdown.classList.add('hidden', 'opacity-0', 'scale-95');
        dropdown.classList.remove('opacity-100', 'scale-100');
    }
  });
});
</script>





  <!-- Main Content -->
  <main class="max-w-7xl mx-auto p-6 flex flex-col md:flex-row gap-6">

    <!-- Artikel -->
    <section class="md:w-2/3 bg-white p-6 rounded-2xl shadow-lg">
    <!-- Running Header Modern -->
<div class="relative overflow-hidden h-12 mb-6 rounded-xl bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500 shadow-lg">
  <!-- Efek Fade Kiri -->
  <div class="absolute left-0 top-0 w-20 h-full bg-gradient-to-r from-indigo-600 via-indigo-600/70 to-transparent z-10"></div>

  <!-- Efek Fade Kanan -->
  <div class="absolute right-0 top-0 w-20 h-full bg-gradient-to-l from-cyan-500 via-cyan-500/70 to-transparent z-10"></div>

  <!-- Teks Bergerak -->
  <div class="absolute whitespace-nowrap animate-marquee flex items-center gap-10 text-white font-semibold text-lg tracking-wide">
    <div class="flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-300 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-10H21M3 12H2.34M4.93 4.93l.7.7m12.73 12.73l.7.7M19.07 4.93l-.7.7M4.93 19.07l-.7.7M12 5a7 7 0 100 14 7 7 0 000-14z" />
      </svg>
      <span class="uppercase">Website Desa Mojomanis</span>
    </div>

    <div class="flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-300 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 9h4m5 5H5a2 2 0 01-2-2V9a2 2 0 012-2h3m10 0h3a2 2 0 012 2v13a2 2 0 01-2 2z" />
      </svg>
      <span class="uppercase">Kecamatan Kwadungan, Kabupaten Ngawi</span>
    </div>

    <div class="flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-300 animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
      </svg>
      <span class="uppercase">Membangun Desa Digital Cerdas 🌐</span>
    </div>
  </div>
</div>

<style>
@keyframes marquee {
  0% { transform: translateX(100%); }
  100% { transform: translateX(-100%); }
}
.animate-marquee {
  animation: marquee 18s linear infinite;
}
@keyframes spin-slow {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}
.animate-spin-slow {
  animation: spin-slow 10s linear infinite;
}
</style>


     <!-- 🌈 Garis Dekoratif Modern Bergerak -->
<div class="relative w-full h-[4px] overflow-hidden rounded-full mb-6">
  <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-cyan-400 to-purple-500 animate-gradient-move"></div>
</div>

<style>
@keyframes gradientMove {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}
.animate-gradient-move {
  background-size: 200% 200%;
  animation: gradientMove 5s ease-in-out infinite;
  box-shadow: 0 0 15px rgba(56, 189, 248, 0.5);
}
</style>



      @yield('content')
    </section>

    <!-- Sidebar -->
    <aside class="md:w-1/3 space-y-6">
      <!-- Tanggal & Waktu -->
      <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 rounded-xl shadow-md">
        <h3 class="font-bold mb-1">Tanggal & Waktu</h3>
        <p id="datetime" class="text-sm"></p>
      </div>

      <!-- Login / Admin Menu -->
      <div class="bg-white p-4 rounded-xl shadow-md">
        <h3 class="font-bold mb-3">Menu</h3>

        @guest
          <a href="{{ route('login') }}"
             class="block bg-blue-600 text-white py-2 rounded-lg text-center hover:bg-blue-700 transition">
             Login Admin
          </a>
        @endguest

      <!-- 🏛️ Layanan Masyarakat -->
@guest
<div class="mt-4">
  <a href="{{ route('layanan.login') }}"
     class="block bg-gradient-to-r from-green-500 to-green-600 text-white py-2 rounded-lg text-center hover:from-green-600 hover:to-green-700 transition shadow">
     <i class="fas fa-users"></i>
     <span class="ml-2">Layanan Masyarakat</span>
  </a>
</div>
@endguest



       @auth
    <div class="space-y-3">

        {{-- Kelola Artikel --}}
<a href="{{ route('admin.artikel.index') }}"
   class="flex items-center gap-2 bg-green-600 text-white py-2 px-4 rounded-lg text-center hover:bg-green-700 transition shadow">
    <i class="fas fa-newspaper"></i>
    <span>Kelola Artikel</span>
</a>

       {{-- Pengaturan Website --}}
<a href="{{ route('admin.setting.edit') }}"
   class="flex items-center gap-2 bg-yellow-500 text-white py-2 px-4 rounded-lg text-center hover:bg-yellow-600 transition shadow">
    <i class="fas fa-cogs"></i>
    <span>Pengaturan Website</span>
</a>


        {{-- Kelola Profil Desa --}}
        <a href="{{ route('admin.profil.edit') }}"
           class="flex items-center gap-2 bg-purple-600 text-white py-2 px-4 rounded-lg text-center hover:bg-purple-700 transition shadow">
            <i class="fas fa-id-card-alt"></i>
            <span>Kelola Profil Desa</span>
        </a>

        {{-- ✅ Kelola Pemerintahan Desa (BARU) --}}
        <a href="{{ route('admin.pemerintahan.edit') }}"
   class="flex items-center gap-2 bg-blue-600 text-white py-2 px-4 rounded-lg text-center hover:bg-blue-700 transition shadow">
    <i class="fas fa-sitemap"></i>
    <span>Kelola Pemerintahan Desa</span>
</a>

{{-- ✅ Kelola Data Wilayah --}}
<a href="{{ route('admin.wilayah.index') }}"
   class="flex items-center gap-2 bg-indigo-600 text-white py-2 px-4 rounded-lg text-center hover:bg-indigo-700 transition shadow">
    <i class="fas fa-map-marked-alt"></i>
    <span>Kelola Data Wilayah</span>
</a>
{{-- ✅ Kelola Pendidikan Dalam KK --}}
<a href="{{ route('admin.pendidikan_kk.index') }}"
   class="flex items-center gap-2 bg-pink-600 text-white py-2 px-4 rounded-lg text-center hover:bg-pink-700 transition shadow">
    <i class="fas fa-school"></i>
    <span>Kelola Pendidikan KK</span>
</a>

{{-- ✅ Kelola Pendidikan Ditempuh --}}
<a href="{{ route('admin.pendidikan_ditempuh.index') }}"
   class="flex items-center gap-2 bg-teal-600 text-white py-2 px-4 rounded-lg text-center hover:bg-teal-700 transition shadow">
    <i class="fas fa-book-open"></i>
    <span>Kelola Pendidikan Ditempuh</span>
</a>

{{-- ✅ Kelola Pekerjaan --}}
<a href="{{ route('admin.pekerjaan.index') }}"
   class="flex items-center gap-2 bg-orange-600 text-white py-2 px-4 rounded-lg text-center hover:bg-orange-700 transition shadow">
    <i class="fas fa-briefcase"></i>
    <span>Kelola Pekerjaan</span>
</a>

{{-- ✅ Kelola Agama --}}
<a href="{{ route('admin.agama.index') }}"
   class="flex items-center gap-2 bg-purple-500 text-white py-2 px-4 rounded-lg text-center hover:bg-purple-600 transition shadow">
    <i class="fas fa-praying-hands"></i>
    <span>Kelola Agama</span>
</a>

{{-- ✅ Kelola Jenis Kelamin --}}
<a href="{{ route('admin.jenis_kelamin.index') }}"
   class="flex items-center gap-2 bg-blue-400 text-white py-2 px-4 rounded-lg text-center hover:bg-blue-500 transition shadow">
    <i class="fas fa-venus-mars"></i>
    <span>Kelola Jenis Kelamin</span>
</a>

{{-- ✅ Kelola Warga Negara --}}
<a href="{{ route('admin.warga_negara.index') }}"
   class="flex items-center gap-2 bg-green-700 text-white py-2 px-4 rounded-lg text-center hover:bg-green-800 transition shadow">
    <i class="fas fa-id-card"></i>
    <span>Kelola Warga Negara</span>
</a>
 {{-- ✅ Kelola Produk Hukum --}}
<a href="{{ route('admin.produk_hukum.index') }}"
   class="flex items-center gap-2 bg-red-600 text-white py-2 px-4 rounded-lg text-center hover:bg-red-700 transition shadow">
    <i class="fas fa-balance-scale"></i>
    <span>Kelola Produk Hukum</span>
</a>

{{-- ✅ Kelola Informasi Publik --}}
<a href="{{ route('admin.informasi_publik.index') }}"
   class="flex items-center gap-2 bg-amber-600 text-white py-2 px-4 rounded-lg text-center hover:bg-amber-700 transition shadow">
    <i class="fas fa-info-circle"></i>
    <span>Kelola Informasi Publik</span>
</a>

{{-- ✅ Kelola UMKM Desa --}}
<a href="{{ route('admin.umkm.index') }}"
   class="flex items-center gap-2 bg-green-600 text-white py-2 px-4 rounded-lg text-center hover:bg-green-700 transition shadow">
    <i class="fas fa-store"></i>
    <span>Kelola UMKM Desa</span>
</a>

{{-- ✅ Kelola Pertanian --}}
<a href="{{ route('admin.pertanian.index') }}"
   class="flex items-center gap-2 bg-lime-600 text-white py-2 px-4 rounded-lg text-center hover:bg-lime-700 transition shadow">
    <i class="fas fa-tractor"></i>
    <span>Kelola Pertanian</span>
</a>

{{-- ✅ Kelola Hasil Produk Pertanian (BARU) --}}
<a href="{{ route('admin.hasil_produk.index') }}"
   class="flex items-center gap-2 bg-lime-700 text-white py-2 px-4 rounded-lg text-center hover:bg-lime-800 transition shadow">
    <i class="fas fa-leaf"></i>
    <span>Kelola Hasil Produk Pertanian</span>
</a>

{{-- ✅ Kelola Galeri Video --}}
<a href="{{ route('admin.video.index') }}"
   class="flex items-center gap-2 bg-blue-700 text-white py-2 px-4 rounded-lg text-center hover:bg-blue-800 transition shadow">
    <i class="fas fa-video"></i>
    <span>Kelola Galeri Video</span>
</a>




        {{-- Logout --}}
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="flex items-center gap-2 bg-red-600 text-white py-2 px-4 rounded-lg text-center hover:bg-red-700 transition shadow">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
@endauth

      </div>

      <!-- Statistik -->
      <div class="bg-white p-4 rounded-xl shadow-md">
        <h3 class="font-bold mb-2 border-b pb-2">Statistik</h3>
        <p class="text-gray-600">Jumlah Penduduk</p>
        <p class="text-4xl font-extrabold text-gray-900">3.278</p>
      </div>
    </aside>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-400 text-center py-4 mt-6">
    <p>© {{ date('Y') }} {{ $settings['site_name'] ?? 'Desa Mojomanis' }}. Dibuat oleh kelompok 41 kknT unipma 2025.</p>
  </footer>

  <script>
    function updateClock() {
      const now = new Date();
      const time = now.toLocaleTimeString('id-ID');
      const date = now.toLocaleDateString('id-ID', { weekday:'long', year:'numeric', month:'long', day:'numeric'});
      document.getElementById('datetime').innerHTML = date + " | " + time;
      document.getElementById('clock').innerHTML = time;
    }
    setInterval(updateClock, 1000);
    updateClock();
  </script>
  <script>
    function updateClock() {
      const now = new Date();
      const time = now.toLocaleTimeString('id-ID');
      const date = now.toLocaleDateString('id-ID', { weekday:'long', year:'numeric', month:'long', day:'numeric'});
      document.getElementById('datetime').innerHTML = date + " | " + time;
      document.getElementById('clock').innerHTML = time;
    }
    setInterval(updateClock, 1000);
    updateClock();
  </script>

  {{-- ✅ Taruh ini biar script dari @push('scripts') (misal chart) ikut ke-render --}}
  @stack('scripts')

</body>
</html>

</body>
</html>
