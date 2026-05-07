<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['group', 'key', 'value'];

    // Helper: Get a setting value
    public static function get($group, $key, $default = null)
    {
        $setting = self::where('group', $group)->where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    // Helper: Set a setting value
    public static function set($group, $key, $value)
    {
        return self::updateOrCreate(
            ['group' => $group, 'key' => $key],
            ['value' => $value]
        );
    }

    // Helper: Get all settings for a group as an associative array
    public static function getGroup($group)
    {
        return self::where('group', $group)->pluck('value', 'key')->toArray();
    }
}
