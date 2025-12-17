<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        // ambil semua wilayah dengan parent (biar bisa keliatan hirarkinya)
        $wilayah = Wilayah::with('parent')->orderBy('tingkat')->get();
        return view('admin.wilayah.index', compact('wilayah'));
    }

    public function create()
    {
        // ambil dusun dan rw untuk dijadikan parent saat bikin data baru
        $dusun = Wilayah::where('tingkat', 'dusun')->get();
        $rw    = Wilayah::where('tingkat', 'rw')->get();

        return view('admin.wilayah.create', compact('dusun', 'rw'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required',
            'tingkat' => 'required|in:dusun,rw,rt',
            'ketua'   => 'required|string',
            'kk'      => 'required|integer',
            'l'       => 'required|integer',
            'p'       => 'required|integer',
            'parent_id' => 'nullable|exists:wilayah,id',
        ]);

        Wilayah::create($request->all());

        return redirect()->route('admin.wilayah.index')
                         ->with('success', 'Data wilayah berhasil ditambahkan');
    }

    public function edit(Wilayah $wilayah)
    {
        $dusun = Wilayah::where('tingkat', 'dusun')->get();
        $rw    = Wilayah::where('tingkat', 'rw')->get();

        return view('admin.wilayah.edit', compact('wilayah', 'dusun', 'rw'));
    }

    public function update(Request $request, Wilayah $wilayah)
    {
        $request->validate([
            'nama'    => 'required',
            'tingkat' => 'required|in:dusun,rw,rt',
            'ketua'   => 'required|string',
            'kk'      => 'required|integer',
            'l'       => 'required|integer',
            'p'       => 'required|integer',
            'parent_id' => 'nullable|exists:wilayah,id',
        ]);

        $wilayah->update($request->all());

        return redirect()->route('admin.wilayah.index')
                         ->with('success', 'Data wilayah berhasil diupdate');
    }

    public function destroy(Wilayah $wilayah)
    {
        $wilayah->delete();

        return redirect()->route('admin.wilayah.index')
                         ->with('success', 'Data wilayah berhasil dihapus');
    }
}
