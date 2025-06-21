<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reaction;

class GalleryComment extends Model
{
    use HasFactory;

    protected $fillable = ['gallery_item_id', 'author', 'content', 'likes', 'dislikes', 'parent_id'];

    public function galleryItem()
    {
        return $this->belongsTo(GalleryItem::class);
    }

    public function parent()
    {
        return $this->belongsTo(GalleryComment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(GalleryComment::class, 'parent_id');
    }

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactionable');
    }
}
