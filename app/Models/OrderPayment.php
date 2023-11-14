<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    protected $fillable = ['status'];
    protected $casts = [
        'data' => 'object'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class,'order_payments_id','id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
