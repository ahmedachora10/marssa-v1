<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    protected $table = "product_attributes";
    protected $guarded = ["id"];

    public function values()
    {
        return $this->hasMany(ProductAttributesValues::class,'attribute_id');
    }
    public function store()
    {
        return $this->hasOne(Store::class,'id');
    }
    public function colors(){
        return $this->hasManyThrough(ProductAttributesColors::class,ProductAttributesValues::class,'attribute_id','attribute_value_id','id','id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}
