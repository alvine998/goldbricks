<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'    => 'required|string|max:100',
            'site_tagline' => 'nullable|string|max:200',
            'menu_home'    => 'required|string|max:50',
            'menu_project' => 'required|string|max:50',
            'menu_gallery' => 'required|string|max:50',
            'menu_about'   => 'required|string|max:50',
            'menu_contact' => 'required|string|max:50',
            'contact_email'   => 'nullable|email|max:100',
            'contact_phone'   => 'nullable|string|max:30',
            'contact_address' => 'nullable|string|max:300',
            'social_instagram' => 'nullable|string|max:200',
            'social_facebook'  => 'nullable|string|max:200',
            'social_whatsapp'  => 'nullable|string|max:20',
        ]);

        foreach ($request->except(['_token', '_method']) as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
