<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'username',
        'action',
        'details',
        'ip_address',
        'user_agent',
        'session_id',
        'browser',
        'platform',
        'location',
    ];
}
