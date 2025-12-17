<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index()
    {
        $data = Pekerjaan::all();
        $total = $data->sum('jumlah');

        $chartData = $data->map(fn($row) => [
            'name' => $row->kelompok,
            'y' => (int) $row->jumlah,
        ]);

        return view('admin.pekerjaan.index', compact('data', 'total', 'chartData'));
    }

    public function create()
    {
        return view('admin.pekerjaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'nullable|string',
            'kelompok' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        Pekerjaan::create($request->all());
        return redirect()->route('admin.pekerjaan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Pekerjaan::findOrFail($id);
        return view('admin.pekerjaan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Pekerjaan::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('admin.pekerjaan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = Pekerjaan::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.pekerjaan.index')->with('success', 'Data berhasil dihapus');
    }
}
