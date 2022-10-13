<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $guard = [];

    protected $fillable = [
        'order_id',
        'product_id',
        'variation_id',
        'product_price',
        'unit',
        'quantity',
        'total_price',
        'weight',
        'color',
        'discount_amount',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}
