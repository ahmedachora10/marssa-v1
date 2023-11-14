<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $guarded = [];

    // protected $table = 'competition';

    protected $appendTo = ['condition_text'];

    public function setThumbnailsAttribute($value){
        $this->attributes['thumbnails'] = serialize($value);
    }

    public function getThumbnailsAttribute($value){
        return unserialize($value);
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_replace(' ','-',$this->name);
    }


    public function getConditionTextAttribute(){
        if($this->condition_type == 'buy_products'):
            return __('master.buy_products');
        else:
            return __('master.visits_links');
        endif;
    }

    public function competition_products(){
        return $this->hasMany(CompetitionProduct::class,'competition_id','id');
    }

    public function competition_links(){
        return $this->hasMany(CompetitionLinks::class,'competition_id','id');
    }

    public function competitors(){
        return $this->hasMany(Competitor::class,'competition_id','id');
    }

     public function competition_joiners(){
        return $this->hasMany(CompetitionJoin::class,'competition_id','id');
    }

    public function winner(){
        return $this->hasOne(Competitor::class,'competition_id','id')->where('winner',1);
    }

    public function winner_visits_links(){
        return $this->HasMany(CompetitionJoin::class,'competition_id','id')->where('winner',1);
    }

    public function User()
    {
        return $this->belongsTo(User::class , 'id' ,'user_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'category_id');
    // }
}

//Developer Muhamed Fawzy 3-12-2023
