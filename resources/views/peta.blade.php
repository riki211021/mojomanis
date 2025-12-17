@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-500 text-white py-5 text-center">
            <h1 class="text-2xl font-extrabold">🗺️ Peta Interaktif Desa Mojomanis</h1>
            <p class="text-sm opacity-90">Kecamatan Kwadungan, Kabupaten Ngawi, Provinsi Jawa Timur</p>
        </div>

        <!-- Peta -->
        <div id="map" class="w-full h-[600px] rounded-b-3xl z-0"></div>

        <!-- Keterangan -->
        <div class="p-6 text-gray-700 text-justify leading-relaxed">
            <p>
                Peta interaktif ini menampilkan batas wilayah dan lokasi penting di Desa Mojomanis.
                Gunakan fitur zoom dan geser untuk menjelajahi area sekitar.
                Klik marker atau area peta untuk melihat informasi tambahan.
            </p>
            <p class="mt-3">
                Data koordinat di bawah ini hanya contoh ilustrasi.
                Kamu bisa menggantinya dengan data koordinat asli dari hasil GPS atau data Bappeda setempat.
            </p>
        </div>
    </div>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@push('scripts')
<script>
    // Inisialisasi peta
    var map = L.map('map').setView([-7.4474, 111.3984], 15);

    // Layer dasar (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Marker lokasi kantor desa
    var marker = L.marker([-7.4474, 111.3984]).addTo(map);
    marker.bindPopup(`
        <div class='text-center'>
            <h2 class='font-bold text-blue-600 text-lg'>Kantor Desa Mojomanis</h2>
            <p class='text-sm text-gray-700'>Kecamatan Kwadungan, Kabupaten Ngawi</p>
            <a href='https://www.google.com/maps?q=-7.4474,111.3984' target='_blank' class='text-blue-500 underline text-sm'>Lihat di Google Maps</a>
        </div>
    `);

    // Polygon batas wilayah desa (contoh area sekitar)
    var batasDesa = L.polygon([
        [-7.4465, 111.3965],
        [-7.4458, 111.4000],
        [-7.4482, 111.4020],
        [-7.4495, 111.3980],
        [-7.4475, 111.3955]
    ], {
        color: '#16a34a',        // warna garis
        fillColor: '#86efac',    // warna isi (hijau lembut)
        fillOpacity: 0.4,        // transparansi isi
        weight: 2,               // ketebalan garis
    }).addTo(map);

    batasDesa.bindPopup("<b>Wilayah Administratif Desa Mojomanis</b><br>Kecamatan Kwadungan, Kabupaten Ngawi.");

    // Efek hover (ubah warna batas saat disentuh)
    batasDesa.on('mouseover', function (e) {
        this.setStyle({
            color: '#15803d',
            fillOpacity: 0.6
        });
    });
    batasDesa.on('mouseout', function (e) {
        this.setStyle({
            color: '#16a34a',
            fillOpacity: 0.4
        });
    });

    // Label tengah polygon
    var center = batasDesa.getBounds().getCenter();
    L.marker(center, {
        icon: L.divIcon({
            className: 'text-green-700 font-bold text-sm',
            html: 'Desa Mojomanis',
            iconSize: [100, 20]
        })
    }).addTo(map);

    // Tambahkan skala peta
    L.control.scale().addTo(map);
</script>
@endpush
@endsection
