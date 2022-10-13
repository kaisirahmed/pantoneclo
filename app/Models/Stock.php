<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'product_id',
        'variation_id',
        'quantity',
        'marchant_id',
        'status'
    ];

    protected $nullable = [
        'marchant_id'
    ];
 
}
