<?php

namespace App\Http\Controllers;

use App\Models\HasilProduk;
use Illuminate\Http\Request;

class HasilProdukController extends Controller
{
    // -------- ADMIN --------
    public function index()
    {
        $data = HasilProduk::orderBy('tahun', 'desc')->get();
        return view('hasil_produk.index', compact('data'));
    }

    public function create()
    {
        return view('hasil_produk.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'dusun' => 'required|string|max:100',
        'rt' => 'required|string|max:10',
        'tahun' => 'required|numeric|min:2000|max:' . date('Y'),
        'produk' => 'required|string|max:100',

        // Validasi musim
        'musim_1' => 'nullable|numeric|min:0',
        'musim_2' => 'nullable|numeric|min:0',
        'musim_3' => 'nullable|numeric|min:0',

        // Validasi koordinat opsional
        'koordinat' => 'nullable|string|max:100',

        // Validasi foto (maks 20 MB)
        'foto' => 'nullable|image|max:20480',
    ]);

    $foto = null;
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('produk', 'public');
    }

    HasilProduk::create([
        'dusun' => $request->dusun,
        'rt' => $request->rt,
        'tahun' => $request->tahun,
        'produk' => $request->produk,
        'musim_1' => $request->musim_1,
        'musim_2' => $request->musim_2,
        'musim_3' => $request->musim_3,
        'total_tahun' =>
            ($request->musim_1 ?? 0) +
            ($request->musim_2 ?? 0) +
            ($request->musim_3 ?? 0),
        'foto' => $foto,
        'koordinat' => $request->koordinat,
    ]);

    return redirect()->route('admin.hasil_produk.index')
        ->with('success', 'Data berhasil ditambahkan');
}


    public function edit(HasilProduk $hasil_produk)
    {
        return view('hasil_produk.edit', compact('hasil_produk'));
    }

    public function update(Request $request, HasilProduk $hasil_produk)
{
    $request->validate([
        'dusun' => 'required|string|max:100',
        'rt' => 'required|string|max:10',
        'tahun' => 'required|numeric|min:2000|max:' . date('Y'),
        'produk' => 'required|string|max:100',

        'musim_1' => 'nullable|numeric|min:0',
        'musim_2' => 'nullable|numeric|min:0',
        'musim_3' => 'nullable|numeric|min:0',

        'koordinat' => 'nullable|string|max:100',
        'foto' => 'nullable|image|max:20480',
    ]);

    $foto = $hasil_produk->foto;

    if ($request->hasFile('foto')) {

        // Hapus foto lama (jika ada)
        if ($foto && file_exists(storage_path('app/public/'.$foto))) {
            unlink(storage_path('app/public/'.$foto));
        }

        // Upload baru
        $foto = $request->file('foto')->store('produk', 'public');
    }

    $hasil_produk->update([
        'dusun' => $request->dusun,
        'rt' => $request->rt,
        'tahun' => $request->tahun,
        'produk' => $request->produk,
        'musim_1' => $request->musim_1,
        'musim_2' => $request->musim_2,
        'musim_3' => $request->musim_3,
        'total_tahun' =>
            ($request->musim_1 ?? 0) +
            ($request->musim_2 ?? 0) +
            ($request->musim_3 ?? 0),
        'foto' => $foto,
        'koordinat' => $request->koordinat,
    ]);

    return redirect()->route('admin.hasil_produk.index')
        ->with('success', 'Data berhasil diupdate');
}


    public function destroy(HasilProduk $hasil_produk)
    {
        $hasil_produk->delete();

        return redirect()->route('admin.hasil_produk.index')->with('success', 'Data berhasil dihapus');
    }

    // -------- PUBLIC --------
    public function public()
{
    $data = HasilProduk::orderBy('tahun', 'desc')->paginate(10);
    return view('hasil_produk.public', compact('data'));
}


}
