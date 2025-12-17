<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WargaNegara;
use Illuminate\Http\Request;

class WargaNegaraController extends Controller
{
    public function index()
    {
        $data = WargaNegara::all();
        return view('admin.warga_negara.index', compact('data'));
    }

    public function create()
    {
        return view('admin.warga_negara.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'nullable|string',
            'kelompok' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        WargaNegara::create($request->all());
        return redirect()->route('admin.warga_negara.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = WargaNegara::findOrFail($id);
        return view('admin.warga_negara.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'nullable|string',
            'kelompok' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        $data = WargaNegara::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('admin.warga_negara.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = WargaNegara::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.warga_negara.index')->with('success', 'Data berhasil dihapus');
    }
}
