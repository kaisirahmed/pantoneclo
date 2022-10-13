<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
        'email',
        'mobile',
        'street',
        'street2',
        'city_id',
        'state_id',
        'zip',
        'country_id',
        'type',
        'is_default'
    ];

    protected $nullable = [
        'street2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);    
    }
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
