<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\ArtikelPhoto;   // ⬅️ WAJIB ADA
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::query();

        if ($request->filled('q')) {
            $query->where('judul', 'like', '%'.$request->q.'%')
                  ->orWhere('isi', 'like', '%'.$request->q.'%');
        }

        $artikels = $query->latest()->paginate(10);

        if (auth()->check()) {
            return view('admin.artikel.index', compact('artikels'));
        }

        return view('home', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'subjudul' => 'nullable|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:40960',
            'photos.*' => 'image|mimes:jpg,jpeg,png,webp|max:40960',
        ]);

        $artikel = new Artikel();
        $artikel->judul = $request->judul;
        $artikel->subjudul = $request->subjudul;
        $artikel->isi = $request->isi;
        $artikel->penulis = auth()->user()->name ?? 'Admin Desa';

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $artikel->gambar = $filename;
        }

        $artikel->save();

        // Foto tambahan
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoname = time().'_'.$photo->getClientOriginalName();
                $photo->move(public_path('uploads/artikel_photos'), $photoname);

                ArtikelPhoto::create([
                    'artikel_id' => $artikel->id,
                    'foto' => $photoname
                ]);
            }
        }

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'subjudul' => 'nullable|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:40960',
            'photos.*' => 'image|mimes:jpg,png,jpeg,webp|max:40960',
        ]);

        $artikel->judul = $request->judul;
        $artikel->subjudul = $request->subjudul;
        $artikel->isi = $request->isi;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $artikel->gambar = $filename;
        }

        $artikel->save();

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoname = time().'_'.$photo->getClientOriginalName();
                $photo->move(public_path('uploads/artikel_photos'), $photoname);

                ArtikelPhoto::create([
                    'artikel_id' => $artikel->id,
                    'foto' => $photoname
                ]);
            }
        }

        return redirect()->route('admin.artikel.index')
    ->with('success', 'Artikel berhasil diperbarui!');

    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar && file_exists(public_path('uploads/'.$artikel->gambar))) {
            unlink(public_path('uploads/'.$artikel->gambar));
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }

    public function show(Artikel $artikel)
    {
        $artikel->increment('views');

        $related = Artikel::where('id', '!=', $artikel->id)
            ->orderByDesc('views')
            ->take(3)
            ->get();

        return view('artikel.show', compact('artikel', 'related'));
    }

    public function deletePhoto($id)
{
    $photo = ArtikelPhoto::findOrFail($id);

    // Hapus file
    $file = public_path('uploads/artikel_photos/'.$photo->foto);
    if (file_exists($file)) {
        unlink($file);
    }

    $photo->delete();

    return back()->with('success', 'Foto berhasil dihapus!');
}

}

