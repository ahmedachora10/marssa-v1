<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Store;
class MarketPlaceAffiliate extends Model
{
    //
    protected $fillable = ['store_id','status'];

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }
}
