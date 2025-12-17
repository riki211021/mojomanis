<?php

namespace App\Http\Controllers;

use App\Models\Pertanian;
use Illuminate\Http\Request;

class PertanianController extends Controller
{
    public function index()
    {
        $data = Pertanian::orderBy('dusun', 'asc')->get();
        return view('pertanian.index', compact('data'));
    }

    public function create()
    {
        return view('pertanian.create');
    }

    public function store(Request $request)
{
    $request->validate([
    'dusun' => 'required|string|max:100',
    'rt' => 'required|string|max:10',
    'tahun' => 'required|numeric|min:2000|max:' . date('Y'),
    'jenis_tanaman' => 'required|string|max:50',
    'koordinat' => 'required|string|max:100',

    // 🔥 Tambahkan validasi foto max 20MB
    'foto' => 'nullable|image|max:20480',
]);





    $data = $request->all();

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('pertanian', 'public');
    }

    Pertanian::create($data);

    return redirect()->route('admin.pertanian.index')
        ->with('success', 'Data pertanian berhasil ditambahkan.');
}


    public function edit($id)
    {
        $data = Pertanian::findOrFail($id);
        return view('pertanian.edit', compact('data'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
    'dusun' => 'required|string|max:100',
    'rt' => 'required|string|max:10',
    'tahun' => 'required|numeric|min:2000|max:' . date('Y'),
    'jenis_tanaman' => 'required|string|max:50',
    'koordinat' => 'required|string|max:100',

    // 🔥 Tambahkan validasi foto max 20MB
    'foto' => 'nullable|image|max:20480',
]);


    $data = Pertanian::findOrFail($id);
    $updateData = $request->all();

    // kalau ada file baru, hapus lama lalu upload baru
    if ($request->hasFile('foto')) {
        if ($data->foto && file_exists(storage_path('app/public/' . $data->foto))) {
            unlink(storage_path('app/public/' . $data->foto));
        }
        $updateData['foto'] = $request->file('foto')->store('pertanian', 'public');
    }

    $data->update($updateData);

    return redirect()->route('admin.pertanian.index')
        ->with('success', 'Data pertanian berhasil diperbarui.');
}


    public function destroy($id)
    {
        $data = Pertanian::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.pertanian.index')
            ->with('success', 'Data pertanian berhasil dihapus.');
    }

    // ===============================
    // 🟢 PUBLIC: HALAMAN PERTANIAN (TANPA LOGIN)
    // ===============================
    public function publicIndex()
    {
        // Ambil semua data pertanian untuk ditampilkan di halaman publik
        $data = Pertanian::orderBy('dusun', 'asc')->get();

        // Kirim ke view publik
        return view('pertanian.public', compact('data'));
    }
}
