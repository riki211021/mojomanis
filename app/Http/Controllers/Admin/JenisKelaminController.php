<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKelamin;
use Illuminate\Http\Request;

class JenisKelaminController extends Controller
{
    public function index()
    {
        $data = JenisKelamin::all();
        return view('admin.jenis_kelamin.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenis_kelamin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'nullable|string',
            'kelompok' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        JenisKelamin::create($request->all());
        return redirect()->route('admin.jenis_kelamin.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = JenisKelamin::findOrFail($id);
        return view('admin.jenis_kelamin.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'nullable|string',
            'kelompok' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        $data = JenisKelamin::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('admin.jenis_kelamin.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = JenisKelamin::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.jenis_kelamin.index')->with('success', 'Data berhasil dihapus');
    }
}
