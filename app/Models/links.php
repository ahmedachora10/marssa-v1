<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class links extends Model
{
    //
    protected $fillable = [ 'store_id' , 'link' , 'description'];

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }

}