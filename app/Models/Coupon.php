<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $fillable = [
        'code',
        'discount_type',
        'discount_amount',
        'usage_limit',
        'used_count',
        'description',
        'is_active',
        'valid_from',
        'valid_until'
    ];
}
