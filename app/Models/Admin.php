<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\AdminEmailVerificationNotification;
use App\Notifications\AdminResetPasswordNotification as Notification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable, SoftDeletes;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Custom password reset notification.
     * 
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new Notification($token));
    }

    /**
     * Send email verification notice.
     * 
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new AdminEmailVerificationNotification);
    }

    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    // public function getRouteKey()
    // {
    //     return $this->slug;
    // }

    // public function superAdmin()
    // {
    // 	if(Auth::user()->role === 'superAdmin'){
    // 		return true;
    // 	}   
    // 	return false;
    // }

    // public function chiefAdmin()
    // {
    //     if(Auth::user()->role === 'chiefAdmin'){
    //         return true;
    //     }   
    //     return false;
    // }

    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class);
    // }

    // public function hasAnyRole($role)
    // {
    //     if ($this->whereIn('role',$role)->first()) {
    //         return true;
    //     }

    //     return false;
    // }
    
    // public function hasAnyPermissions($permissions)
    // {
    //     if ($this->permissions()->whereIn('names',$permissions)->first()) {
    //         return true;
    //     }

    //     return false;
    // }

}
