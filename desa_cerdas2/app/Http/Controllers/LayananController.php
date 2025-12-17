<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LayananController extends Controller
{
    // 🔹 Halaman login
    public function showLogin()
    {
        return view('layanan.login');
    }

    // 🔹 Halaman registrasi
    public function showRegister()
    {
        return view('layanan.register');
    }

    // 🔹 Proses registrasi warga
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:wargas',
            'password' => 'required|min:6|confirmed',
        ]);

        Warga::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('layanan.login')
            ->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    // 🔹 Proses login
   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('layanan')->attempt($credentials)) {
        $user = Auth::guard('layanan')->user();

        // Cek role
        if ($user->role === 'admin') {
            return redirect()->route('layanan.admin.dashboard');
        } else {
            return redirect()->route('layanan.dashboard');
        }
    }

    return back()->withErrors(['email' => 'Email atau password salah!']);
}




    // 🔹 Dashboard warga
    public function dashboard()
    {
        $user = Auth::guard('layanan')->user();
        return view('layanan.dashboard', compact('user'));
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::guard('layanan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Anda telah logout dari layanan masyarakat.');

    }
}
