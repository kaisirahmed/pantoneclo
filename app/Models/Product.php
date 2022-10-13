<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'code',
        'model',
        'slug',
        'price',
        'image',
        'front_side_image',
        'right_side_image',
        'left_side_image',
        'back_side_image',
        'description',
        'discount_amount',
        'discount_percentage',
        'sale_price',
        'quantity',
        'unit_id',
        'affiliate_link',
        'status',
        'is_slider',
        'is_featured',
        'meta_title',
        'meta_tags',
        'meta_description',
    ];

    protected $nullable = [
        'code',
        'model',
        'is_slider',
        'is_featured',
        'affiliate_link',
        'meta_title',
        'meta_tags',
        'meta_description',
    ];

    public function unit() 
    {
        return $this->belongsTo(Unit::class);
    }
    // public function color() 
    // {
    //     return $this->belongsTo(Color::class)->withDefault(['name' => 'None']);
    // }
    // public function sizes() 
    // {
    //     return $this->hasMany(Size::class);
    // }
    public function options() 
    {
        return $this->hasMany(Option::class);
    }
    public function optionValues() 
    {
        return $this->hasMany(OptionValue::class);
    }
    public function variants() 
    {
        return $this->hasMany(Variation::class);
    }
    public function stocks() 
    {
        return $this->hasMany(Stock::class);
    }
    public function variant() 
    {
        return $this->hasOne(Variation::class)->where('is_default',1)->first();
    }
  
    public function categories()
    {
        return $this->belongsToMany(Category::class)
                    ->withTimestamps();
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
}
