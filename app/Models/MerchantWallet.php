<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantWallet extends Model
{
    //

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function merchant(){
        return $this->belongsTo(User::class,'user_id','id');
    }


}
