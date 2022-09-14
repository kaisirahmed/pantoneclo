<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'tags',
        'banner',
        'image',
        'icon',
        'order_no',
        'status',
    ];

    protected $nullable = [
        'order_no',
        'tags',
        'banner',
        'image',
        'icon',
    ];

    protected $casts = [
        'order_no' =>  'integer',
    ];

    public function getNameAttribute($name) {
        return ucwords($name);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withTimestamps();
    }
}
