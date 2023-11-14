<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getCurrency()
    {
        return $this->store()->first()->information()->first()->currency;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
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
