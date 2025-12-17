<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiPublik;
use Illuminate\Http\Request;

class InformasiPublikController extends Controller
{
    public function index() {
        $data = InformasiPublik::all();
        return view('admin.informasi_publik.index', compact('data'));
    }

    public function create() {
        return view('admin.informasi_publik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'kategori' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'file'  => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $path = $request->file('file') ? $request->file('file')->store('informasi_publik', 'public') : null;

        InformasiPublik::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'tahun' => $request->tahun,
            'file'  => $path,
        ]);

        return redirect()->route('admin.informasi_publik.index')->with('success', 'Informasi publik berhasil ditambahkan.');
    }

   public function edit($id)
{
    $informasiPublik = InformasiPublik::findOrFail($id);
    return view('admin.informasi_publik.edit', compact('informasiPublik'));
}


    public function update(Request $request, $id)
    {
        $data = InformasiPublik::findOrFail($id);
        $path = $data->file;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('informasi_publik', 'public');
        }

        $data->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'tahun' => $request->tahun,
            'file'  => $path,
        ]);

        return redirect()->route('admin.informasi_publik.index')->with('success', 'Informasi publik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        InformasiPublik::findOrFail($id)->delete();
        return back()->with('success', 'Informasi publik dihapus.');
    }
}

