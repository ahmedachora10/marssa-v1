<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesignPlan extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function design()
    {
        return $this->belongsTo(Design::class, 'design_id');
    }

}
//Developed Saed Z. Sinwar
