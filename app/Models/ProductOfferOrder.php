<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOfferOrder extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];
	public $fillable = [ 'product_offer_id','currency', 'amount', 'name', 'mobile', 'address', 'ip_address', 'status',
	'store_id','payment_method','viewed','notes','order_id'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function product()
    {
        return $this->belongsTo(ProductOffer::class,'product_offer_id');
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
