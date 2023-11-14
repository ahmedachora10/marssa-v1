<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{

    public $fillable = ['color_ar','color_en','color_fr'];


    public function product_options()
    {
        return $this->hasMany(Product_options::class);
    }
}
