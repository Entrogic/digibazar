<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display settings page
     */
    public function index()
    {
        $settings = Setting::getAllGrouped();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            $setting = Setting::where('setting_key', $key)->first();

            if ($setting) {
                // Handle file uploads
                if ($setting->type === 'image' && $request->hasFile($key)) {
                    $file = $request->file($key);
                    $path = $file->store('uploads/settings', 'public');
                    $value = '/storage/' . $path;

                    // Delete old file if exists
                    if ($setting->value && $setting->value !== '/logo1.png' && $setting->value !== '/favicon.ico') {
                        $oldPath = str_replace('/storage/', '', $setting->value);
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                $setting->update(['value' => $value]);
            }
        }

        // Clear cache
        Setting::clearCache();

        return back()->with('success', 'Settings updated successfully!');
    }

    /**
     * Reset settings to default
     */
    public function reset()
    {
        // Clear cache first
        Setting::clearCache();

        // Run seeder to reset to defaults
        Artisan::call('db:seed', ['--class' => 'SettingSeeder']);

        return back()->with('success', 'Settings reset to default values!');
    }
}
