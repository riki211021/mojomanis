<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    public function index()
    {
        $data = Agama::all();
        return view('admin.agama.index', compact('data'));
    }

    public function create()
    {
        return view('admin.agama.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'nullable|string',
            'kelompok' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        Agama::create($request->all());
        return redirect()->route('admin.agama.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Agama::findOrFail($id);
        return view('admin.agama.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'nullable|string',
            'kelompok' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        $data = Agama::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('admin.agama.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = Agama::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.agama.index')->with('success', 'Data berhasil dihapus');
    }
}
