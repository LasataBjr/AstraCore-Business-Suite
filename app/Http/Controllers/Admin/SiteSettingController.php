<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    /**
     * Display settings form.
     */
    public function edit()
    {
        $settings = SiteSetting::first(); // There's only one settings record

        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $setting = SiteSetting::first();

        $request->validate([
            'site_name'   => 'required|string|max:255',
            'tagline'     => 'nullable|string|max:255',
            'email'       => 'nullable|email|max:255',
            'phone'       => 'nullable|string|max:50',
            'address'     => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon'     => 'nullable|image|mimes:jpg,jpeg,png,ico|max:1024',
            'facebook'    => 'nullable|url',
            'linkedin'    => 'nullable|url',
            'instagram'   => 'nullable|url',
            'footer_text' => 'nullable|string',
        ]);

        $data = $request->except(['logo', 'favicon']);

        // Logo upload
        if ($request->hasFile('logo')) {

            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }

            $data['logo'] = $request->file('logo')
                ->store('settings', 'public');
        }

        // Favicon upload
        if ($request->hasFile('favicon')) {

            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }

            $data['favicon'] = $request->file('favicon')
                ->store('settings', 'public');
        }

        $setting->update($data);

        return back()->with(
            'success',
            'Site settings updated successfully.'
        );
    }
}