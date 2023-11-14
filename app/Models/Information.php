<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $casts = [

        'language'      => 'array',
    ];
    public function store()
    {
        return $this->hasMany(Store::class,'id');
    }

}
//Developed Saed Z. Sinwar
