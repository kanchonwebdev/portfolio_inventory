<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'transport_cost',
        'store_rent_cost',
        'labour_cost',
        'others_cost',
        'total_cost',
        'shop_id'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
