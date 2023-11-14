<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upsell extends Model
{
    protected $table='upsells';

    public function prod()
    {
        return $this->hasOne(Product::class,'id','offer_id');
    }
    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
