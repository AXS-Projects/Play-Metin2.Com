<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image_path', 'video_url'];

    public function comments()
    {
        return $this->hasMany(GalleryComment::class);
    }
}
