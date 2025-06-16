<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content'];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($news) {
            $news->slug = Str::slug($news->title);
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
