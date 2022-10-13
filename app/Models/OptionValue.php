<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionValue extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'option_id',
        'product_id',
        'value'
    ];
 
}
