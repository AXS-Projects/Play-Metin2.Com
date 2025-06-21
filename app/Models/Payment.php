<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'metin2_user_id',
        'payment_package_id',
        'stripe_session_id',
        'status',
        'amount',
        'coins',
        'ip_address',
    ];

    public function package()
    {
        return $this->belongsTo(PaymentPackage::class, 'payment_package_id');
    }

    public function user()
    {
        return $this->belongsTo(Metin2User::class, 'metin2_user_id');
    }
}
