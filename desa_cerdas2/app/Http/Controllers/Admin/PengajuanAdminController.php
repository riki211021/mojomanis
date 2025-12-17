<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanAdminController extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::with('warga')->latest()->get();
        return view('admin.pengajuan.index', compact('pengajuan'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->catatan_admin = $request->catatan_admin;
        $pengajuan->save();

        return back()->with('success', 'Status pengajuan berhasil diperbarui!');
    }
}

