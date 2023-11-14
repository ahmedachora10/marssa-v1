<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionJoin extends Model
{
    //

    protected $fillable = ['competition_id','mobile','winner','code'];

    public function competition(){
        return $this->belongsTo(Competition::class,'competition_id','id');
    }

    public function competition_link_visits(){
        return $this->hasMany(CompetitionVisitCount::class,'competition_join_id','id');
    }

    public function link_visits(){
        return $this->hasManyThrough(LinkVisit::class,CompetitionVisitCount::class,'competition_join_id','competition_visit_link_id');
    }

}
