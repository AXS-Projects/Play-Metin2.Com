<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content'];

    // Auto-generare slug la salvare
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($page) {
            $page->slug = Str::slug($page->title); // Generează slug automat
        });
    }
}
