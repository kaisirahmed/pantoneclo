<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guard = [];

    public function user()
    {
        return $this->belongsToMany(User::class);    
    }
}
