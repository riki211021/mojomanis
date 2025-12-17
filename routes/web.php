<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ArtikelPhotoController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PemerintahanController;
use App\Http\Controllers\DataDesaController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\Admin\PendidikanKKController;
use App\Http\Controllers\PendidikanDitempuhController;
use App\Http\Controllers\Admin\PekerjaanController;
use App\Http\Controllers\Admin\AgamaController;
use App\Http\Controllers\Admin\JenisKelaminController;
use App\Http\Controllers\Admin\WargaNegaraController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Admin\PengajuanAdminController; // ✅ Tambahkan ini
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PengajuanController; // ✅ Tambahkan ini juga
use App\Http\Controllers\AdminLayananController;
use App\Http\Controllers\PertanianController;
use App\Http\Controllers\HasilProdukController;
use App\Http\Controllers\GaleriVideoController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\LayananResetPasswordController;


// ======================
// 🌾 Data Pertanian (Publik & Admin)
// ======================





// ===================
// LAYANAN MASYARAKAT
// ===================
Route::prefix('layanan')->group(function () {

    // 🔹 Guest (belum login)
    Route::middleware('guest:web')->group(function () {
        Route::get('/login', [LayananController::class, 'showLogin'])->name('layanan.login');
        Route::post('/login', [LayananController::class, 'login'])->name('layanan.login.post');
        Route::get('/register', [LayananController::class, 'showRegister'])->name('layanan.register');
        Route::post('/register', [LayananController::class, 'register'])->name('layanan.register.post');
    });

    // 🔹 Setelah login
Route::middleware('auth:layanan')->group(function () {
    Route::get('/dashboard', [LayananController::class, 'dashboard'])->name('layanan.dashboard');
    Route::post('/logout', [LayananController::class, 'logout'])->name('layanan.logout');

    // 🔹 💌 Halaman Balasan Admin (harus di atas resource!)
    Route::get('/pengajuan/balasan', [App\Http\Controllers\PengajuanController::class, 'balasan'])
        ->name('layanan.pengajuan.balasan');

    // 🔹 Resource pengajuan (otomatis: index, create, edit, delete, dll)
    Route::resource('/pengajuan', PengajuanController::class, ['as' => 'layanan']);
});


});

// 🔹 Dashboard Admin Layanan (role = admin)
Route::prefix('layanan/admin')->middleware('auth:layanan')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminLayananController::class, 'index'])
        ->name('layanan.admin.dashboard');

    // 🔹 Update status pengajuan
    Route::put('/pengajuan/{id}/status', [App\Http\Controllers\AdminLayananController::class, 'updateStatus'])
        ->name('layanan.admin.updateStatus');
});



Route::middleware('auth:layanan')->group(function () {
    Route::get('/dashboard', [LayananController::class, 'dashboard'])->name('layanan.dashboard');
    Route::resource('/pengajuan', pengajuancontroller::class);
});


// ==========================
// LAYANAN MASYARAKAT – LUPA PASSWORD
// ==========================


Route::get('/layanan/lupa-password', [LayananResetPasswordController::class, 'showRequestForm'])
    ->name('layanan.password.request');

Route::post('/layanan/lupa-password', [LayananResetPasswordController::class, 'sendResetToken'])
    ->name('layanan.password.send');

Route::get('/layanan/reset-password/{token}', [LayananResetPasswordController::class, 'showResetForm'])
    ->name('layanan.password.reset');

Route::post('/layanan/reset-password', [LayananResetPasswordController::class, 'resetPassword'])
    ->name('layanan.password.update');


// ======================
// Halaman Publik
// ======================
// produk hukum dan informasi publik
Route::get('/regulasi/produk-hukum', [\App\Http\Controllers\DataDesaController::class, 'produkHukum'])->name('data.produk.hukum');
Route::get('/regulasi/informasi-publik', [\App\Http\Controllers\DataDesaController::class, 'informasiPublik'])->name('data.informasi.publik');

// ======================
// Download Produk Hukum
// ======================
Route::get('/produk-hukum/download/{filename}', function ($filename) {

    $path = storage_path('app/public/produk_hukum/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'File Produk Hukum tidak ditemukan');
    }

    return response()->download($path);

})->name('produk_hukum.download');


// ======================
// Download Informasi Publik
// ======================
Route::get('/informasi-publik/download/{filename}', function ($filename) {

    $path = storage_path('app/public/informasi_publik/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'File Informasi Publik tidak ditemukan');
    }

    return response()->download($path);

})->name('informasi_publik.download');



// Halaman publik UMKM Desa
Route::get('/umkm-desa', [DataDesaController::class, 'umkm'])->name('data.umkm');

// Detail UMKM publik
Route::get('/umkm-desa/{id}', [DataDesaController::class, 'showUmkm'])->name('data.umkm.show');


// Home (artikel terbaru)
Route::get('/', [ArtikelController::class, 'index'])->name('home');

// Profil Desa (publik)
Route::get('/profil-desa', [ProfilController::class, 'index'])->name('profil');

// Pemerintahan Desa (publik)
Route::get('/pemerintahan-desa', [PemerintahanController::class, 'index'])->name('pemerintahan.index');

//pertanian
Route::get('/pertanian', [App\Http\Controllers\PertanianController::class, 'publicIndex'])
    ->name('pertanian.public');

    //hasl produk publik
    Route::get('/hasil-produk-pertanian', [HasilProdukController::class, 'public'])
     ->name('hasil_produk.public');

//galery video public
Route::get('/galeri-video', [GaleriVideoController::class, 'public'])->name('video.public');
Route::get('/galeri-video/{id}', [GaleriVideoController::class, 'show'])->name('video.show');



//peta
Route::get('/peta', function () {
    return view('peta');
})->name('peta');


// =====================
// Data Desa (publik)
// =====================
Route::prefix('data-desa')->group(function () {
    Route::get('/', [DataDesaController::class, 'index'])->name('data.desa');
    Route::get('/wilayah', [DataDesaController::class, 'wilayah'])->name('data.wilayah');
    Route::get('/pendidikan-kk', [DataDesaController::class, 'pendidikanKK'])->name('data.pendidikan.kk');
    Route::get('/pendidikan-ditempuh', [DataDesaController::class, 'pendidikanDitempuh'])->name('data.pendidikan.ditempuh');
    Route::get('/pekerjaan', [DataDesaController::class, 'pekerjaan'])->name('data.pekerjaan');
    Route::get('/agama', [DataDesaController::class, 'agama'])->name('data.agama');
    Route::get('/jenis-kelamin', [DataDesaController::class, 'jenisKelamin'])->name('data.jenis.kelamin');
    Route::get('/warga-negara', [DataDesaController::class, 'wargaNegara'])->name('data.warga.negara');
});




// ======================
// Admin (Login Required)
// ======================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Artikel
    Route::resource('artikel', ArtikelController::class)->except(['show']);

   Route::delete('artikel/photos/{id}', [ArtikelPhotoController::class, 'delete'])
    ->name('artikel.photo.delete');


    // Data Wilayah
    Route::resource('wilayah', WilayahController::class);

    // Data Pendidikan
    Route::resource('pendidikan_kk', PendidikanKKController::class);
    Route::resource('pendidikan_ditempuh', PendidikanDitempuhController::class); // ✅ ini cukup

    // Data Pekerjaan & Lainnya
    Route::resource('pekerjaan', \App\Http\Controllers\Admin\PekerjaanController::class);
    Route::resource('agama', \App\Http\Controllers\Admin\AgamaController::class);
    Route::resource('jenis_kelamin', JenisKelaminController::class);
    Route::resource('warga_negara', \App\Http\Controllers\Admin\WargaNegaraController::class);


    // Pengaturan Website
    Route::get('/setting', [SettingController::class, 'edit'])->name('setting.edit');
    Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');

    // Profil Desa
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/profil/delete', [ProfilController::class, 'destroy'])->name('profil.destroy');

    // Pemerintahan Desa
    Route::get('/pemerintahan/edit', [PemerintahanController::class, 'edit'])->name('pemerintahan.edit');
    Route::post('/pemerintahan/update', [PemerintahanController::class, 'update'])->name('pemerintahan.update');

    // produk hukum dan informasi publik
    Route::resource('produk_hukum', \App\Http\Controllers\Admin\ProdukHukumController::class);
    Route::resource('informasi_publik', \App\Http\Controllers\Admin\InformasiPublikController::class);

    // umkm desa
    Route::resource('umkm', \App\Http\Controllers\Admin\UmkmController::class);

    //pertanian
    Route::resource('pertanian', App\Http\Controllers\PertanianController::class);

    //hasil produk admin
    Route::resource('hasil_produk', HasilProdukController::class);

    //galery video admin
     Route::resource('video', GaleriVideoController::class)->names('video');
     Route::get('/galeri-video/{id}', [GaleriVideoController::class, 'show'])->name('video.show');



    // 🔹 Pengajuan Dokumen dari Warga
     Route::get('/pengajuan', [PengajuanAdminController::class, 'index'])->name('pengajuan.index');
    Route::put('/pengajuan/{id}', [PengajuanAdminController::class, 'update'])->name('pengajuan.update');

    // Profile User (akun admin)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ======================
// Artikel Show (publik)
// ======================
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');

// ======================
// Dashboard
// ======================
Route::get('/dashboard', function () {
    return redirect()->route('admin.artikel.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// ======================
// Auth Routes
// ======================
require __DIR__.'/auth.php';
