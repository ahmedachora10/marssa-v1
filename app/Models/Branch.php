<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    protected $fillable = ['name','store_id'];

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function order_payments(){
        return $this->hasMany(OrderPayment::class);
    }
}
