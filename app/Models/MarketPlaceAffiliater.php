<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketPlaceAffiliater extends Model
{
    //
    protected $fillable = ['store_id','affiliater_id','status'];

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'affiliater_id','id');
    }
}