<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendidikanKK;
use Illuminate\Http\Request;

class PendidikanKKController extends Controller
{
    public function index()
    {
        $data = PendidikanKK::all();
        $total = $data->sum('jumlah');
        return view('admin.pendidikan_kk.index', compact('data','total'));
    }

    public function create()
    {
        return view('admin.pendidikan_kk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelompok' => 'required',
            'jumlah'   => 'required|integer',
        ]);
        PendidikanKK::create($request->all());
        return redirect()->route('admin.pendidikan_kk.index')->with('success','Data berhasil ditambahkan');
    }

    public function edit(PendidikanKK $pendidikan_kk)
    {
        return view('admin.pendidikan_kk.edit', compact('pendidikan_kk'));
    }

    public function update(Request $request, PendidikanKK $pendidikan_kk)
    {
        $request->validate([
            'kelompok' => 'required',
            'jumlah'   => 'required|integer',
        ]);
        $pendidikan_kk->update($request->all());
        return redirect()->route('admin.pendidikan_kk.index')->with('success','Data berhasil diupdate');
    }

    public function destroy(PendidikanKK $pendidikan_kk)
    {
        $pendidikan_kk->delete();
        return redirect()->route('admin.pendidikan_kk.index')->with('success','Data berhasil dihapus');
    }
}
