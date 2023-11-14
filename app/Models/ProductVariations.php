<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariations extends Model
{
    protected $table = "product_variations";
    protected $guarded = ["id"];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function attribute()
    {
        return $this->belongsTo(ProductAttributes::class,"attribute_id");
    }
    public function attributeValue()
    {
        return $this->belongsTo(ProductAttributesValues::class,"attribute_value_id");
    }

}
