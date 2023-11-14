<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id')->where('status',4);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}

//Developed Saed Z. Sinwar