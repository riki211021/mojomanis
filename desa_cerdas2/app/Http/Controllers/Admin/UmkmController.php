<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Umkm;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    public function index()
    {
        $data = Umkm::latest()->get();
        return view('admin.umkm.index', compact('data'));
    }

    public function create()
    {
        return view('admin.umkm.create');
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'wa' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('umkm', 'public');
        }

        Umkm::create([
    'nama_usaha' => $request->nama_usaha,
    'pemilik' => $request->pemilik,
    'kategori' => $request->kategori,
    'wa' => $request->wa,
    'alamat' => $request->alamat,
    'deskripsi' => $request->deskripsi,
    'foto' => $foto,
]);


        return redirect()->route('admin.umkm.index')->with('success', 'Data UMKM berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('admin.umkm.edit', compact('umkm'));
    }

    public function update(Request $request, $id)
    {
        $umkm = Umkm::findOrFail($id);

        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'wa' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = $umkm->foto;
        if ($request->hasFile('foto')) {
            if ($foto && Storage::disk('public')->exists($foto)) {
                Storage::disk('public')->delete($foto);
            }
            $foto = $request->file('foto')->store('umkm', 'public');
        }

        $umkm->update([
    'nama_usaha' => $request->nama_usaha,
    'pemilik' => $request->pemilik,
    'kategori' => $request->kategori,
    'wa' => $request->wa,
    'alamat' => $request->alamat,
    'deskripsi' => $request->deskripsi,
    'foto' => $foto,
]);


        return redirect()->route('admin.umkm.index')->with('success', 'Data UMKM berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        if ($umkm->foto && Storage::disk('public')->exists($umkm->foto)) {
            Storage::disk('public')->delete($umkm->foto);
        }
        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'Data UMKM berhasil dihapus.');
    }
}
