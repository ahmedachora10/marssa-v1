<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCodePlan extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'promo_code_id');
    }

    public function FormatStart()
    {
        return date('m/d/Y', strtotime($this->start));
    }

    public function FormatEnd()
    {
        return date('m/d/Y', strtotime($this->end));
    }
}
//Developed Saed Z. Sinwar
