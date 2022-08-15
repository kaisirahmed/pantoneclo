<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $guard = [];

    public function country()
    {
        return $this->belongsTo(Country::class);    
    }
    public function city()
    {
        return $this->belongsTo(City::class);    
    }
    public function state()
    {
        return $this->belongsTo(State::class);    
    }
}
