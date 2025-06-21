<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentPackage extends Model
{
    protected $fillable = [
        'name',
        'coins',
        'price',
        'currency',
        'stripe_price_id',
    ];
}
