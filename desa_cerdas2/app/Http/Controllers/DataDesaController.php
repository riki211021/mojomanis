<?php

namespace App\Http\Controllers;
 use App\Models\Wilayah;
use Illuminate\Http\Request;

class DataDesaController extends Controller
{
    public function index() {
        return view('data.index');
    }


public function wilayah()
{
    // Ambil semua dusun beserta anak-anaknya (RW dan RT)
    $dusun = Wilayah::where('tingkat', 'dusun')
                ->with(['children.children'])
                ->get();

    return view('data.wilayah', compact('dusun'));
}

public function pendidikanKK()
{
    $data = \App\Models\PendidikanKK::all();
    $total = $data->sum('jumlah');

    // Siapin data buat chart (format sesuai Highcharts)
    $chartData = $data->map(function ($row) {
        return [
            'name' => $row->kelompok,   // label di chart
            'y'    => (int) $row->jumlah // nilai di chart
        ];
    })->values(); // reset index biar array [0,1,2,...]

    return view('data.pendidikan_kk', compact('data', 'total', 'chartData'));
}





    public function pendidikanDitempuh()
{
    $data = \App\Models\PendidikanDitempuh::all();
    $total = $data->sum('jumlah');

    // Data buat chart
    $chartData = $data->map(function ($row) {
        return [
            'name' => $row->kelompok,
            'y'    => (int) $row->jumlah,
        ];
    });

    return view('data.pendidikan_ditempuh', compact('data', 'total', 'chartData'));
}


    public function pekerjaan()
{
    $data = \App\Models\Pekerjaan::all();
    $total = $data->sum('jumlah');
    $chartData = $data->map(fn($row) => [
        'name' => $row->kelompok,
        'y' => (int) $row->jumlah,
    ]);

    return view('data.pekerjaan', compact('data', 'total', 'chartData'));
}


    public function agama()
{
    $data = \App\Models\Agama::all();
    $total = $data->sum('jumlah');

    $chartData = $data->map(function ($row) {
        return [
            'name' => $row->kelompok,
            'y'    => (int) $row->jumlah,
        ];
    })->values();

    return view('data.agama', compact('data', 'total', 'chartData'));
}


    public function jenisKelamin()
{
    $data = \App\Models\JenisKelamin::all();
    $total = $data->sum('jumlah');

    $chartData = $data->map(fn($row) => [
        'name' => $row->kelompok,
        'y' => (int) $row->jumlah,
    ])->values();

    return view('data.jenis_kelamin', compact('data', 'total', 'chartData'));
}


    public function wargaNegara()
{
    $data = \App\Models\WargaNegara::all();
    $total = $data->sum('jumlah');

    $chartData = $data->map(fn($row) => [
        'name' => $row->kelompok,
        'y'    => (int) $row->jumlah,
    ]);

    return view('data.warga_negara', compact('data', 'total', 'chartData'));
}

public function produkHukum()
{
    $data = \App\Models\ProdukHukum::orderBy('created_at', 'desc')->paginate(5);
    return view('data.produk_hukum', compact('data'));
}


public function informasiPublik()
{
    $data = \App\Models\InformasiPublik::orderBy('created_at', 'desc')->paginate(5); // ⬅️ tampil 5 data per halaman
    return view('data.informasi_publik', compact('data'));
}

public function umkm()
{
    $data = \App\Models\Umkm::latest()->get();
    return view('data.umkm', compact('data'));
}

public function showUmkm($id)
{
    $umkm = \App\Models\Umkm::findOrFail($id);
    return view('data.show_umkm', compact('umkm'));
}


}
