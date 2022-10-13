<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'name'
    ];

    public function product() 
    {
        return $this->belongsTo(Product::class);
    }

    public function optionValues() 
    {
        return $this->hasMany(OptionValue::class);
    }
}
