<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_options extends Model
{
	public $fillable = ['product_id','size','color_id','price'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Colors::class);
    }

}
