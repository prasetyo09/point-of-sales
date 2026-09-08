<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'unit_price',
        'subtotal'
    ];

    public function items()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
