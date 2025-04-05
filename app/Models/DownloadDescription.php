<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadDescription extends Model
{
    use HasFactory;

    protected $table = 'download_description'; // Specificăm numele corect al tabelei
    protected $fillable = ['language', 'description'];

}
