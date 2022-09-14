<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    protected $guard = [];

    public function optionValues() 
    {
        return $this->belongsToMany(OptionValue::class);
    }
    public function product() 
    {
        return $this->belongsTo(Product::class);
    }
}
