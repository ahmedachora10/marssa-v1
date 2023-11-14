<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    //
    protected $fillable = ['client_id','competition_id','mobile','status','winner'];

    public function client(){
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function competition(){
        return $this->belongsTo(Competition::class,'competition_id','id');
    }
}
