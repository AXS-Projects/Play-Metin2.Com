<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryComment extends Model
{
    use HasFactory;

    protected $fillable = ['gallery_item_id', 'author', 'content', 'likes', 'dislikes'];

    public function galleryItem()
    {
        return $this->belongsTo(GalleryItem::class);
    }
}
