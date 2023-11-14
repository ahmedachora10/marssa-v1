<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributesColors extends Model
{
    use HasFactory;
    protected $table = "product_attributes_colors";
    protected $guarded = ["id"];

    public function attribute_value()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
