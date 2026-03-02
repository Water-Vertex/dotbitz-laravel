<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'order_number',
        'guardian_id',
        'student_id',
        'sub_amount',
        'total_amount',
        'status',
        'ordered_at',
        'is_financeed',
        'finance_id',
        'finance_provider',
        'discount',
        'coupon_code',
        'payment_method',
        'note',
    ];

    // Optional: cast amounts to decimal and dates to datetime
    protected $casts = [
        'sub_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'ordered_at' => 'datetime',
    ];

    // Relationships
    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
