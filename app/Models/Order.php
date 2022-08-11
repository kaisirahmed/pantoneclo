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

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
