<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Tampilkan daftar artikel
     */
  public function index(Request $request)
{
    $query = Artikel::query();

    // Jika ada parameter pencarian
    if ($request->filled('q')) {
        $query->where('judul', 'like', '%'.$request->q.'%')
              ->orWhere('isi', 'like', '%'.$request->q.'%');
    }

    // Ambil artikel terbaru dengan pagination (10 per halaman)
    $artikels = $query->latest()->paginate(10);

    if (auth()->check()) {
        // kalau admin login
        return view('admin.artikel.index', compact('artikels'));
    }

    // kalau guest
    return view('home', compact('artikels'));
}



    /**
     * Form tambah artikel (admin only)
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Simpan artikel baru (admin only)
     */
    public function store(Request $request)
{
    $request->validate([
        'judul'  => 'required|string|max:255',
        'subjudul' => 'nullable|string|max:255',
        'isi'    => 'required',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:40960', // 40MB
    ]);

    $artikel = new Artikel();
    $artikel->judul = $request->judul;
    $artikel->subjudul = $request->subjudul; // ⬅️ tambahin ini
    $artikel->isi = $request->isi;
    $artikel->penulis = auth()->user()->name ?? 'Admin Desa';

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $artikel->gambar = $filename;
    }

    $artikel->save();

    return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
}

    /**
     * Form edit artikel (admin only)
     */
    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    /**
     * Update artikel
     */
   public function update(Request $request, Artikel $artikel)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'subjudul' => 'nullable|string|max:255',
        'isi' => 'required',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $artikel->judul = $request->judul;
    $artikel->subjudul = $request->subjudul; // ⬅️ tambahin ini
    $artikel->isi = $request->isi;

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $artikel->gambar = $filename;
    }

    $artikel->save();

    return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
}

    /**
     * Hapus artikel
     */
    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar && file_exists(public_path('uploads/'.$artikel->gambar))) {
            unlink(public_path('uploads/'.$artikel->gambar));
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Detail artikel untuk publik
     */
    public function show(Artikel $artikel)
{
    // Tambah views setiap dibuka
    $artikel->increment('views');

    // Ambil 3 artikel terkait paling banyak dibaca (biar sekalian)
    $related = Artikel::where('id', '!=', $artikel->id)
        ->orderByDesc('views')
        ->take(3)
        ->get();

    return view('artikel.show', compact('artikel', 'related'));
}




}
