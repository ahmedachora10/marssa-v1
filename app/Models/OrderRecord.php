<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderRecord extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
//Developed Saed Z. Sinwar