<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Generic key/value application setting.
 */
class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['key', 'value'];

    /**
     * Retrieve a setting value by key.
     */
    public static function getValue(string $key, $default = null)
    {
        return static::query()->where('key', $key)->value('value') ?? $default;
    }

    /**
     * Determine if a boolean setting is enabled.
     */
    public static function isEnabled(string $key, bool $default = false): bool
    {
        return filter_var(static::getValue($key, $default), FILTER_VALIDATE_BOOLEAN);
    }
}
