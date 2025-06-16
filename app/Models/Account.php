<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $connection = 'account'; // ✅ Folosește baza de date Metin2
    protected $table = 'account'; // ✅ Setează tabela corectă

    protected $primaryKey = 'id'; // Cheia primară

    public $timestamps = false; // ✅ Dezactivează timestamps dacă tabela nu are `created_at` și `updated_at`

    protected $fillable = [
        'login',
        'password',
        'email',
        'coins',
        'status',
        'register_ip',
        'ban_until',
        'ban_reason',
        'reffer',
    ];
}
