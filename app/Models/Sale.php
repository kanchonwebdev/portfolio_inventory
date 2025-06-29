<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'shop_id',
        'per_unit_price',
        'sold_unit',
        'total_amount',
        'vat',
        'discount',
        'discount_type',
        'status',
        'paid_amount',
        'due_amount',
        'sale_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
