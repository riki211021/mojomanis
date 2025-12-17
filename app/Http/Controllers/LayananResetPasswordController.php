<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // model layanan kamu
use Illuminate\Support\Facades\Hash;

class LayananResetPasswordController extends Controller
{
    // Tampilkan form request email
    public function showRequestForm()
    {
        return view('layanan.auth.lupa_password');
    }

    // Proses kirim token
    public function sendResetToken(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // Buat token reset
        $token = rand(100000, 999999);

        // Simpan token ke user
        $user->reset_token = $token;
        $user->save();

        return redirect()
            ->route('layanan.password.reset', $token)
            ->with('success', 'Gunakan kode berikut untuk reset password: ' . $token);
    }

    // Form reset password
    public function showResetForm($token)
    {
        return view('layanan.auth.reset_password', compact('token'));
    }

    // Update password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min-6|confirmed'
        ]);

        $user = User::where('reset_token', $request->token)->first();

        if (!$user) {
            return back()->with('error', 'Token tidak valid.');
        }

        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->save();

        return redirect()->route('layanan.login')->with('success', 'Password berhasil direset!');
    }
}
