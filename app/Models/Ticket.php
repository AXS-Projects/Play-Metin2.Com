<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'message', 'status', 'response'];

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function user()
    {
        return $this->belongsTo(Metin2User::class, 'user_id');
    }
}
