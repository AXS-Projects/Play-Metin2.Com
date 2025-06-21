<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reaction;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'video_url',
        'author',
        'views',
        'likes',
        'dislikes',
    ];

    public function comments()
    {
        return $this->hasMany(GalleryComment::class);
    }

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactionable');
    }
}
