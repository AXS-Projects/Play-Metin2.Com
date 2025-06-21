<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'reaction',
    ];

    public function reactionable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(Metin2User::class, 'user_id');
    }
}
