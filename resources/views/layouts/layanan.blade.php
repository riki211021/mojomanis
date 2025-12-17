<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layanan Masyarakat | Desa Mojomanis</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Header -->
  <header class="bg-gradient-to-r from-blue-900 to-blue-900 text-white px-6 py-4 shadow">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <h1 class="text-lg md:text-xl font-bold">
        💬 Layanan Masyarakat Desa Mojomanis
      </h1>

      @php
        // Deteksi apakah halaman sekarang adalah dashboard layanan
        $isDashboard = request()->routeIs('layanan.dashboard');
      @endphp

      <div>
        @if ($isDashboard)
          {{-- Kalau di Dashboard, tombol kembali ke Beranda Utama --}}
          <a href="{{ route('home') }}"
             class="inline-flex items-center gap-2 text-blue-100 hover:text-white transition">
             <i class="fas fa-arrow-left"></i> Kembali ke Beranda Desa
          </a>
        @else
          {{-- Kalau di halaman lain, tombol kembali ke Dashboard --}}
          <a href="{{ route('layanan.dashboard') }}"
             class="inline-flex items-center gap-2 text-blue-100 hover:text-white transition">
             <i class="fas fa-arrow-left"></i> Kembali ke Dashboard Layanan
          </a>
        @endif
      </div>
    </div>
  </header>

  <!-- Main -->
  <main class="max-w-5xl mx-auto p-6">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="text-center py-4 text-gray-500 mt-10">
    <p>© {{ date('Y') }} Desa Mojomanis — Layanan Masyarakat Digital</p>
  </footer>

</body>
</html>
