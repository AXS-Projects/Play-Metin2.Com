<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Metin2User extends Authenticatable
{
    protected $connection = 'account'; // Conectare la baza de date `account`
    protected $table = 'account'; // ⚠️ Asigură-te că tabela este corectă

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id', 'login', 'password', 'email', 'coins', 'jcoins'];

    protected $hidden = ['password'];

    /**
     * Specifică identificatorul utilizatorului pentru autentificare.
     */
    public function getAuthIdentifierName()
    {
        return 'login'; // Laravel folosește implicit 'email', dar noi avem 'login'
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Accesor pentru `coins` și `jcoins` - returnează 0 dacă nu există valoare.
     */
    public function getCoinsAttribute()
    {
        return $this->attributes['coins'] ?? 0;
    }

    public function getJcoinsAttribute()
    {
        return $this->attributes['jcoins'] ?? 0;
    }
}
