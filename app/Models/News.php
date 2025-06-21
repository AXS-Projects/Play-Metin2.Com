<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use App\Models\Reaction;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'news_category_id', 'author', 'views', 'likes', 'dislikes'];

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

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactionable');
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }
}
