<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'setting_key',
        'value',
        'type',
        'group_name',
        'label',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        $cacheKey = 'setting_' . $key;

        return Cache::remember($cacheKey, 3600, function () use ($key, $default) {
            $setting = self::where('setting_key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value, $type = 'text', $group = 'general', $label = null, $description = null)
    {
        $setting = self::updateOrCreate(
            ['setting_key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group_name' => $group,
                'label' => $label ?: ucfirst(str_replace('_', ' ', $key)),
                'description' => $description,
            ]
        );

        // Clear cache
        Cache::forget('setting_' . $key);
        Cache::forget('all_settings');

        return $setting;
    }

    /**
     * Get all settings grouped
     */
    public static function getAllGrouped()
    {
        return Cache::remember('all_settings', 3600, function () {
            return self::orderBy('group_name')->orderBy('sort_order')->get()->groupBy('group_name');
        });
    }

    /**
     * Get settings by group
     */
    public static function getByGroup($group)
    {
        $cacheKey = 'settings_group_' . $group;

        return Cache::remember($cacheKey, 3600, function () use ($group) {
            return self::where('group_name', $group)->orderBy('sort_order')->get();
        });
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache()
    {
        Cache::flush();
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($setting) {
            Cache::forget('setting_' . $setting->setting_key);
            Cache::forget('all_settings');
            Cache::forget('settings_group_' . $setting->group_name);
        });

        static::deleted(function ($setting) {
            Cache::forget('setting_' . $setting->setting_key);
            Cache::forget('all_settings');
            Cache::forget('settings_group_' . $setting->group_name);
        });
    }
}
