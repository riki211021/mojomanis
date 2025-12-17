<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    // Halaman profil untuk publik
    public function index()
    {
        $profil = Profil::first();
        return view('profil.index', compact('profil'));
    }

    // Form edit profil (admin)
    public function edit()
    {
        // kalau belum ada data, buat baru
        $profil = Profil::firstOrCreate([]);
        return view('admin.profil.edit', compact('profil'));
    }

    // Proses update profil
    public function update(Request $request)
    {
        $request->validate([
            'judul'        => 'nullable|string|max:255',
            'sejarah'      => 'nullable|string',
            'visi'         => 'nullable|string',
            'misi'         => 'nullable|string',
            'struktur'     => 'nullable|string',
            'potensi'      => 'nullable|string',
            'peta'         => 'nullable|string',
            'foto_sejarah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 🆕 validasi foto
        ]);

        $profil = Profil::firstOrCreate([]);

        // Ambil field teks dari request
        $data = $request->only([
            'judul',
            'sejarah',
            'visi',
            'misi',
            'struktur',
            'potensi',
            'peta',
        ]);

        // 🖼️ Jika ada foto baru diupload
        if ($request->hasFile('foto_sejarah')) {
            // Hapus foto lama jika ada
            if ($profil->foto_sejarah && Storage::disk('public')->exists($profil->foto_sejarah)) {
                Storage::disk('public')->delete($profil->foto_sejarah);
            }

            // Simpan foto baru
            $path = $request->file('foto_sejarah')->store('profil', 'public');
            $data['foto_sejarah'] = $path;
        }

        // Update data profil
        $profil->update($data);

        return redirect()->route('admin.profil.edit')
                         ->with('success', 'Profil Desa berhasil diperbarui!');
    }

    // Reset profil (opsional)
    public function destroy()
    {
        $profil = Profil::first();

        if ($profil) {
            // Hapus foto jika ada
            if ($profil->foto_sejarah && Storage::disk('public')->exists($profil->foto_sejarah)) {
                Storage::disk('public')->delete($profil->foto_sejarah);
            }

            $profil->delete();
        }

        return redirect()->route('admin.profil.edit')
                         ->with('success', 'Profil Desa berhasil dihapus!');
    }
}
