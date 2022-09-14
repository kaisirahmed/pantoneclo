<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $guard = [];

    public function optionValues() 
    {
        return $this->hasMany(OptionValue::class);
    }
}
