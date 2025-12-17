<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class AdminLayananController extends Controller
{
    /**
     * Tampilkan dashboard admin layanan masyarakat
     */
    public function index(Request $request)
    {
        $pengajuan = Pengajuan::with('warga')
            ->when($request->search, function ($query, $search) {
                $query->whereHas('warga', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhere('jenis_dokumen', 'like', "%{$search}%");
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderByDesc('created_at')
            ->paginate(10) // tampilkan 10 data per halaman
            ->appends($request->query()); // pertahankan filter & search di URL

        return view('layanan.admin.dashboard', compact('pengajuan'));
    }

    /**
     * Update status pengajuan (Menunggu / Diproses / Selesai)
     */
    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string',
        'catatan_admin' => 'nullable|string',
        'lampiran_admin.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
    ]);

    $pengajuan = \App\Models\Pengajuan::findOrFail($id);

    // ambil lampiran lama
    $lampiranLama = $pengajuan->lampiran_admin
        ? json_decode($pengajuan->lampiran_admin, true)
        : [];

    if (!is_array($lampiranLama)) $lampiranLama = [];

    $lampiranBaru = [];

    // simpan file baru
    if ($request->hasFile('lampiran_admin')) {
        foreach ($request->file('lampiran_admin') as $file) {
            if ($file->isValid()) {
                $path = $file->store('lampiran_admin', 'public');
                $lampiranBaru[] = $path;
            }
        }
    }

    // gabung file lama + baru
    $semuaLampiran = array_merge($lampiranLama, $lampiranBaru);

    $pengajuan->update([
        'status' => $request->status,
        'catatan_admin' => $request->catatan_admin,
        'lampiran_admin' => json_encode($semuaLampiran),
    ]);

    return back()->with('success', '✅ Status dan balasan berhasil diperbarui!');
}


}
