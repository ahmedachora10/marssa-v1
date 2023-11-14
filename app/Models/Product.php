<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $casts = [
        'image' => 'array'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCurrency()
    {
        return $this->store()->first()->information()->first()->currency;
    }
    public function variations()
    {
        return $this->hasMany(ProductVariations::class);
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttrs::class);
    }

    public function product_options()
    {
        return $this->hasMany(Product_options::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->where('status', '!=', 5);
    }

    public function upsell()
    {
        return $this->hasOne(Upsell::class, 'product_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    public function land_offer()
    {
        return $this->hasMany(ProductOffer::class);
    }

    public function get_current_offer()
    {
        return $this->offers()->whereStatus(1)->where('end', '>', now())->where('start', '<=', now())->first();
    }

    public function promo_codes()
    {
        return $this->hasMany(PromoCode::class);
    }

    public function route_details()
    {
        $host = $this->store()->first()->customDomain()->whereStatus(true)->first();

        if ($host) {
            return '/product/details/' . $this->id;
        }
        return route('store.product_details', ['sub_domain' => $this->store->domain, 'id' => $this->id]);
    }

    public function product_order()
    {
        return route('store.product_order', ['sub_domain' => $this->store->domain, 'id' => $this->id]);
    }

    public function getCureentOffer()
    {
        return $this->offers()->whereStatus(1)->where('end', '>', now())->where('start', '<=', now())->first();
    }

    public function getCureentPromoCode()
    {
        return $this->promo_codes()->whereStatus(1)->where('end', '>', now())->where('start', '<=', now())->first();
    }

    public function firstImage()
    {
        return $this->image[0] ?? '';
    }
}
//Developed Saed Z. Sinwar
