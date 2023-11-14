<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    //

    protected $fillable = ['inviter_id','code_affiliate','status','status_affiliate_rate'];

    public function affiliatees(){
        return $this->hasMany(User::class,'reference_affiliate_id','id');
    }

    public function affiliaters(){
        return $this->belongsTo(User::class,'inviter_id','id');
    }

    public function profits(){
        return $this->hasMany(ProfitAffiliate::class,'affiliate_id','id');
    }

    public function value_profits(){
        return $this->profits()->sum('value');
    }

    public function withdraw(){
        return $this->morphMany(BalanceWithdraw::class, 'withdrawable');
    }

    public function getWithdrawTotalAttribute(){
        //withdraw_total
        return $this->withdraw()->where('status',1)->sum('withdraw_value');
    }


}