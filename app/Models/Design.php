<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\DesignPlan;
use Illuminate\Database\Eloquent\SoftDeletes;

class Design extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function DesignPlan()
    {
        return $this->hasMany(DesignPlan::class, 'design_id');
    }

    public function check_plan($plan)
    {

        return 1;
    }

    public function check_store($store)
    {
        $store = Store::whereId($store)->first();
        return $this->id == $store->design ? 1 : 0;
    }
}
//Developed Saed Z. Sinwar