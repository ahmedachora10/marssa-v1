<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
	public $fillable = [ 'name_ar','name_en','name_fr', 'content_ar', 'content_en','content_fr', 'price', 'price_notice', 'price1', 'price_notice1', 'price2', 'price_notice2', 'price3', 'price_notice3', 'price4', 'price_notice4', 'desc', 'notes', 'page_num', 'status',
	'image','vedio1','vedio2','featured_image','store_id','btn_text','delivery_text','pay_text','notice_text'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getCurrency()
    {
        return $this->store()->first()->information()->first()->currency;
    }

    public function firstImage()
    {
        return $this->image[0] ?? '';
    }

}
