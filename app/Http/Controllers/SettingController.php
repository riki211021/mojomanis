<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key'); // ambil semua setting key-value
        return view('admin.setting.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'    => 'required|string|max:255',
            'site_address' => 'required|string|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'favicon'      => 'nullable|image|mimes:ico,png|max:1024',
        ]);

        // simpan nama website
        Setting::updateOrCreate(['key' => 'site_name'], ['value' => $request->site_name]);

        // simpan alamat desa
        Setting::updateOrCreate(['key' => 'site_address'], ['value' => $request->site_address]);

        // simpan logo
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logo', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
        }

        // simpan favicon
        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('favicon', 'public');
            Setting::updateOrCreate(['key' => 'favicon'], ['value' => $path]);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
