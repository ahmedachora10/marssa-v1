<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbandonedOrder extends Model
{
    //
    protected $fillable = [ 'store_id' , 'cart_items' , 'name' , 'mobile' , 'address'];

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }
}