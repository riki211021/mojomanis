<?php

namespace App\Http\Controllers;

use App\Models\PendidikanDitempuh;
use Illuminate\Http\Request;

class PendidikanDitempuhController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $data = PendidikanDitempuh::all();
        return view('admin.pendidikan_ditempuh.index', compact('data'));
    }

    // Form tambah data
    public function create()
    {
        return view('admin.pendidikan_ditempuh.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'nullable|string',
            'kelompok' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        PendidikanDitempuh::create($request->all());

        return redirect()->route('admin.pendidikan_ditempuh.index')
                         ->with('success', 'Data berhasil ditambahkan');
    }

    // Form edit data
    public function edit($id)
    {
        $data = PendidikanDitempuh::findOrFail($id);
        return view('admin.pendidikan_ditempuh.edit', compact('data'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'nullable|string',
            'kelompok' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        $data = PendidikanDitempuh::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('admin.pendidikan_ditempuh.index')
                         ->with('success', 'Data berhasil diperbarui');
    }

    // Hapus data
    public function destroy($id)
    {
        $data = PendidikanDitempuh::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.pendidikan_ditempuh.index')
                         ->with('success', 'Data berhasil dihapus');
    }
}
