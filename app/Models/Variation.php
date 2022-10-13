<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'sku',
        'product_id',
        'code',
        'name',
        'options',
        'image',
        'front_side_image',
        'back_side_image',
        'left_side_image',
        'right_side_image',
        'price',
        'discount_amount',
        'discount_percentage',
        'sale_price',
        'quantity',
        'weight',
        'is_default'
    ];

    protected $nullable = [
        'options',
        'image',
        'front_side_image',
        'back_side_image',
        'left_side_image',
        'right_side_image',
        'price',
        'discount_amount',
        'discount_percentage',
        'sale_price',
        'quantity',
        'weight',
        'is_default'
    ];

    public function optionValues() 
    {
        return $this->belongsToMany(OptionValue::class);
    }
    public function product() 
    {
        return $this->belongsTo(Product::class);
    }
    public function stock() 
    {
        return $this->belongsTo(Stock::class);
    }
}
