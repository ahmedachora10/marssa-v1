<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributesValues extends Model
{
    protected $table = "product_attributes_values";
    protected $guarded = [];

    protected $fillable = ['attribute_id','value'];
    public function attribute()
    {
        return $this->belongsTo(ProductAttributes::class, 'attribute_id');
    }
    public function color()
    {
        return $this->hasOne(Color::class);
    }
    public function productVariation(){
        return $this->hasOne(ProductVariations::class,'attribute_value_id','id');
    }
}
