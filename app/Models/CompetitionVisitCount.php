<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionVisitCount extends Model
{
    //

    protected $fillable = ['competition_link_id','competition_join_id','count_visits'];

    public function competition_link(){
        return $this->belongsTo(CompetitionLinks::class,'competition_link_id','id');
    }

    public function competition_joins(){
        return $this->belongsTo(CompetitionJoin::class,'competition_join_id','id');
    }


    public function link_visits(){
        return $this->hasMany(LinkVisit::class,'competition_visit_link_id','id');
    }
}
