<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfitAffiliate extends Model
{
    //
    protected $fillable = ['value','invitee_id'];
    public function affiliater(){
        return $this->belongsTo(Affiliate::class,'affiliate_id','id');
    }

    public function affiliatee(){
        return $this->belongsTo(User::class,'invitee_id','id');
    }
}