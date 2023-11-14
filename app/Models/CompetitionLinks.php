<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionLinks extends Model
{
    //

    protected $fillable = ['link','competition_id','count_required'];

    public function competition(){
        return $this->belongsTo(Competition::class,'competition_id','id');
    }
}
