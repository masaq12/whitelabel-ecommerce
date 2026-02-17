<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhiteLabelSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = WhiteLabelSetting::getSettings();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'      => 'required|string|max:255',
            'primary_color'  => 'required|string|max:7',
            'secondary_color'=> 'required|string|max:7',
            'contact_email'  => 'nullable|email',
            'contact_phone'  => 'nullable|string|max:20',
            'footer_text'    => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $settings = WhiteLabelSetting::first() ?? new WhiteLabelSetting();

        $settings->site_name       = $request->site_name;
        $settings->primary_color   = $request->primary_color;
        $settings->secondary_color = $request->secondary_color;
        $settings->contact_email   = $request->contact_email;
        $settings->contact_phone   = $request->contact_phone;
        $settings->footer_text     = $request->footer_text;

        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $settings->logo = $request->file('logo')->store('settings', 'public');
        }

        $settings->save();

        return back()->with('success', 'White label settings updated.');
    }
}
