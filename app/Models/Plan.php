<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;

class Plan extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $casts   =[
       'permissions' => 'array',
    ];


    public function stores()
    {
        return $this->hasMany(Store::class, 'plan_id');
    }

    public function DesignPlan()
    {
        return $this->hasMany(DesignPlan::class, 'plan_id');
    }

    public function promo_codes_plan()
    {
        return $this->hasMany(PromoCodePlan::class, 'plan_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'plan_id');
    }

    public function months_discount($months,$discount){
         $total_discount = ($this->price * $months) - ($this->price * $discount);
         return $total_discount;
    }

    public function percentage_discount($months,$discount){
         $total_discount = ( ( $this->price * $months ) - ( ( ($this->price * $months) * $discount) / 100 ) );
         return $total_discount;
    }

    public function plan_permissions(){
        if( $this->permissions == null )
            return json_decode("{'products':1,'orders':1,'clients':1,'coupons':1,'questions-clients':1,'share-orders':1
                    'cod':1,'subdomain':1,'design':1,'private-domain':1,'reviews':1,'social-media':1,
                    'statics':1,'market':1,'paypal-bankily':1,'multi-languages':1,'team-works':1,'make-roles':1,
                    'sell-by-branches':1,'blogger':1,'support-monthly':1,'count-products':unlimited,'count-orders':unlimited,'count-teamworks':unlimited}",true);


        return collect($this->permissions);
    }

    protected $attributes=[
       'permissions' => "{products':true,'orders':1,'clients':1,'coupons':1,'questions-clients':1,'share-orders':1,
                    'cod':1,'subdomain':1,'design':1,'private-domain':1,'reviews':1,'social-media':1,
                    'statics':1,'market':1,'paypal-bankily':1,'multi-languages':1,'team-works':1,'make-roles':1,
                    'sell-by-branches':1,'blogger':1,'support-monthly':1,'count-products':unlimited,'count-orders':unlimited,'count-teamworks':unlimited}",
    ];

}
//Developed Saed Z. Sinwar