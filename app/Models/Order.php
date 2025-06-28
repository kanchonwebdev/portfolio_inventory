<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'checkout_id',
        'user_id',
        'status',
        'total_amount',
        'payment_method',
        'payment_status',
    ];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
