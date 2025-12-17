<?php

namespace App\Http\Controllers;

use App\Models\ArtikelPhoto;

class ArtikelPhotoController extends Controller
{
    public function delete($id)
    {
        $photo = ArtikelPhoto::findOrFail($id);

        // hapus file fisiknya
        $path = public_path('uploads/artikel_photos/' . $photo->foto);
        if (file_exists($path)) {
            unlink($path);
        }

        // hapus database
        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
