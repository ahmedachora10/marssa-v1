<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function promo_code()
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function order_records()
    {
        return $this->hasMany(OrderRecord::class, 'order_id');
    }

    public function payment()
    {
        return $this->belongsTo(OrderPayment::class,'order_payments_id','id');
    }
}
//Developed Saed Z. Sinwar
