<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'country_id',
        'ip',
        'gender',
        'phone',
        'country_id',
        'terms_conditions',
        'newsletter'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $nullable = [
        'ip',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function billing()
    {
        return $this->hasOne(Address::class)->where('type',1)->where('is_default',1)->first();
    }
    public function shipping()
    {
        return $this->hasOne(Address::class)->where('type',2)->where('is_default',1)->first();
    }
    public function billingShipping()
    {
        return $this->hasOne(Address::class)->where('type',0)->where('is_default',1)->first();
    }

}
