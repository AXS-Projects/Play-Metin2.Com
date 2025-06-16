<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['news_id', 'author', 'content', 'likes', 'dislikes'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
