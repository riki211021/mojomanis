<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdukHukum;

class ProdukHukumController extends Controller
{
    public function index()
    {
        $data = ProdukHukum::latest()->get();
        return view('admin.produk_hukum.index', compact('data'));
    }

    public function create()
    {
        return view('admin.produk_hukum.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:100',
            'tahun' => 'nullable|numeric',
            'file'  => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('produk_hukum', 'public');
        }

        ProdukHukum::create($validated);

        return redirect()->route('admin.produk_hukum.index')
            ->with('success', 'Produk hukum berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produkHukum = ProdukHukum::findOrFail($id);
        return view('admin.produk_hukum.edit', compact('produkHukum'));
    }

    public function update(Request $request, $id)
    {
        $produkHukum = ProdukHukum::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:100',
            'tahun' => 'nullable|numeric',
            'file'  => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('produk_hukum', 'public');
        }

        $produkHukum->update($validated);

        return redirect()->route('admin.produk_hukum.index')
            ->with('success', 'Produk hukum berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produkHukum = ProdukHukum::findOrFail($id);
        $produkHukum->delete();

        return redirect()->route('admin.produk_hukum.index')
            ->with('success', 'Produk hukum berhasil dihapus.');
    }
}
