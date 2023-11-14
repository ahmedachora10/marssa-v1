<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function promo_code()
    {
        return $this->belongsTo(PromoCodePlan::class, 'promo_code_id');
    }

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'payment_id');
    }
}
//Developed Saed Z. Sinwar
