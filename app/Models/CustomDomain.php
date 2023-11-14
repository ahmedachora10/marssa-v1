<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomDomain extends Model
{
    protected $guarded = [];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
//Developed Saed Z. Sinwar
