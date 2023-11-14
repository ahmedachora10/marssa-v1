<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $hidden = ['updated_at', 'deleted_at'];

}
//Developed Saed Z. Sinwar
