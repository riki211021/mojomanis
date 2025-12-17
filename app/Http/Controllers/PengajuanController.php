<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PengajuanController extends Controller
{
    public function index()
{
    $pengajuan = Pengajuan::where('warga_id', Auth::guard('layanan')->id())
        ->orderBy('created_at', 'desc')
        ->paginate(10); // 🔹 tampilkan 10 data per halaman

    return view('layanan.pengajuan.index', compact('pengajuan'));
}


    public function create()
    {
        return view('layanan.pengajuan.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'jenis_dokumen' => 'required|string|max:255',
        'lampiran.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB
    ]);

    $lampiran = null;

    if ($request->hasFile('lampiran')) {
        $paths = [];
        foreach ($request->file('lampiran') as $file) {
            $paths[] = $file->store('lampiran', 'public');
        }
        $lampiran = json_encode($paths);
    }

    \App\Models\Pengajuan::create([
        'warga_id' => Auth::guard('layanan')->id(),
        'jenis_dokumen' => $request->jenis_dokumen,
        'keterangan' => $request->keterangan,
        'lampiran' => $lampiran,
        'status' => 'Menunggu',
    ]);

    return redirect()->route('layanan.pengajuan.index')
        ->with('success', 'Pengajuan dokumen kamu sudah berhasil dikirim!');
}

public function edit($id)
{
    $pengajuan = Pengajuan::findOrFail($id);
    return view('layanan.pengajuan.edit', compact('pengajuan'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'jenis_dokumen' => 'required|string|max:100',
        'keterangan' => 'nullable|string|max:255',
        'lampiran.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB
    ]);

    $pengajuan = \App\Models\Pengajuan::findOrFail($id);

    // 🔹 Pastikan selalu array, meskipun null
    $lampiranLama = $pengajuan->lampiran ? json_decode($pengajuan->lampiran, true) : [];
    if (!is_array($lampiranLama)) {
        $lampiranLama = [];
    }

    // 🔹 Jika ada file baru diupload
    if ($request->hasFile('lampiran')) {
        $lampiranBaru = [];

        foreach ($request->file('lampiran') as $file) {
            $path = $file->store('lampiran', 'public');
            $lampiranBaru[] = $path;
        }

        // Pilih mode penyimpanan:
        // ✅ (A) Tambah file baru tanpa hapus lama
        $allLampiran = array_merge($lampiranLama, $lampiranBaru);

        // ❌ (B) Kalau mau ganti total lampiran lama, pakai ini:
        // foreach ($lampiranLama as $lama) {
        //     \Storage::disk('public')->delete($lama);
        // }
        // $allLampiran = $lampiranBaru;

        $pengajuan->lampiran = json_encode($allLampiran);
    }

    // 🔹 Update data lainnya
    $pengajuan->update([
        'jenis_dokumen' => $request->jenis_dokumen,
        'keterangan' => $request->keterangan,
        'lampiran' => $pengajuan->lampiran, // pastikan tersimpan
    ]);

    return redirect()
        ->route('layanan.pengajuan.index')
        ->with('success', '✅ Pengajuan berhasil diperbarui!');
}



public function destroy($id)
{
    $pengajuan = Pengajuan::findOrFail($id);

    // hapus file lampiran juga
    if ($pengajuan->lampiran) {
        $lampiranList = json_decode($pengajuan->lampiran, true);
        foreach ((array) $lampiranList as $file) {
            Storage::disk('public')->delete($file);
        }
    }

    $pengajuan->delete();
    return redirect()->route('layanan.pengajuan.index')->with('success', 'Pengajuan berhasil dihapus!');
}

public function balasan()
{
    $pengajuan = Pengajuan::where('warga_id', Auth::guard('layanan')->id())
        ->whereNotNull('lampiran_admin')
        ->orderBy('updated_at', 'desc')
        ->paginate(10);

    return view('layanan.pengajuan.balasan', compact('pengajuan'));
}


}
