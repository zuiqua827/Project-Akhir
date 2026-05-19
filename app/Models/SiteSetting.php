<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    protected $fillable = ['group', 'key', 'value'];

    protected static function tableIsReady(): bool
    {
        try {
            return Schema::hasTable((new static())->getTable());
        } catch (\Throwable $exception) {
            return false;
        }
    }

    // Helper: Get a setting value
    public static function get($group, $key, $default = null)
    {
        if (! self::tableIsReady()) {
            return $default;
        }

        try {
            $setting = self::where('group', $group)->where('key', $key)->first();
        } catch (\Throwable $exception) {
            return $default;
        }

        return $setting ? $setting->value : $default;
    }

    // Helper: Set a setting value
    public static function set($group, $key, $value)
    {
        if (! self::tableIsReady()) {
            return null;
        }

        try {
            return self::updateOrCreate(
                ['group' => $group, 'key' => $key],
                ['value' => $value]
            );
        } catch (\Throwable $exception) {
            return null;
        }
    }

    // Helper: Get all settings for a group as an associative array
    public static function getGroup($group)
    {
        if (! self::tableIsReady()) {
            return [];
        }

        try {
            return self::where('group', $group)->pluck('value', 'key')->toArray();
        } catch (\Throwable $exception) {
            return [];
        }
    }
}
