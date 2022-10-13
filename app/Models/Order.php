<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guard = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->invoice_number = IdGenerator::generate(['table' => 'orders','field'=>'invoice_number', 'length' => 8, 'prefix' => date('#Ymd').$model->id]);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function billing()
    {
        return $this->hasOne(Address::class,'id','billing_id')->where('type',1)->where('is_default',1)->first();
    }
    public function shipping()
    {
        return $this->hasOne(Address::class,'id','shipping_id')->where('type',2)->where('is_default',1)->first();
    }
     
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
