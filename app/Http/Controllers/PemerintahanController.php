<?php

namespace App\Http\Controllers;

use App\Models\Pemerintahan;
use Illuminate\Http\Request;

class PemerintahanController extends Controller
{
    public function index()
    {
        $data = Pemerintahan::first();
        return view('pemerintahan.index', compact('data'));
    }

    public function edit()
{
    $data = Pemerintahan::first(); // ambil data pertama
    return view('admin.pemerintahan.edit', compact('data'));
}



    public function update(Request $request)
    {
        $data = Pemerintahan::first() ?? new Pemerintahan();
        $data->visi = $request->visi;
        $data->misi = $request->misi;

        if ($request->hasFile('struktur_foto')) {
            $path = $request->file('struktur_foto')->store('struktur', 'public');
            $data->struktur_foto = $path;
        }

        $data->save();

        return redirect()->route('admin.pemerintahan.edit')->with('success', 'Data berhasil diperbarui!');
    }
}
