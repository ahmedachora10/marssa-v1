<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\MarketPlaceAffiliate;
class Store extends Model
{

    protected $table = 'stores';

    use SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'css_style' => 'json',
        'payment' => 'json',
        'payment_methods' => 'array',
        'language' => 'array',
    ];


    public function visitors()
    {
        return $this->hasMany(Visitors::class, 'store_id');
    }

    public function wallet()
    {
        return $this->hasMany(MerchantWallet::class, 'store_id', 'id');
    }

    public function getTotalBalanceAttribute()
    {
        // total_balance
        return $this->wallet()->where(['type_operation' => 0, 'status' => 1])->sum('amount') - $this->wallet()->where(['type_operation' => 1, 'status' => 1])->sum('amount');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'store_id');
    }

    public function customDomain()
    {
        return $this->hasMany(CustomDomain::class, 'store_id');
    }

    public function getCurrency()
    {
        return $this->information()->first()->currency;
    }

    public function users()
    {
        return $this->hasMany(User::class, 'store_id');
    }

    //Developer Muhamed Fawzy 3-12-2023
     public function Competition()
    {
        return $this->hasMany(Competition::class,'user_id','id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function information()
    {
        return $this->belongsTo(Information::class, 'information_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }

    public function product_offers()
    {
        return $this->hasMany(ProductOffer::class, 'store_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'store_id');
    }

    public function upsell()
    {
        return $this->hasMany(Upsell::class, 'store_id');
    }

    public function promo_codes()
    {
        return $this->hasMany(PromoCode::class, 'store_id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'store_id');
    }

    public function target()
    {
        return $this->hasOne(Target::class, 'store_id');
    }

    public function market_place_affiliaters(){
        return $this->hasMany(AffiliaterMarketplace::class, 'store_id','id');
    }

    public function route_store()
    {
        $user = $this->users()->first();
        if ($user->getRoleNames()[0] == 'SuperAdmin' or $user->getRoleNames()[0] == 'Admin') {
            return route('site.index');
        }
        $host = $this->customDomain()->whereStatus(true)->first();
        if ($host) {
            return 'https://' . $host->custom;
        }
        return route('store.index', ['sub_domain' => $this->domain]);
    }

    public function EgMakeRoute($type)
    {
        $host = $this->customDomain()->whereStatus(true)->first();
        if ($type == 'cart_update') {
            if ($host) {
                $url = route('update_cart');
            } else {
                $url = route('store.update_cart', [
                    'sub_domain' => $this->domain,
                    'rowId' => null
                ]);
            }
        }
        if ($type == 'cart_delete') {
            if ($host) {
                $url = route('remove_from_cart');
            } else {
                $url = route('store.remove_from_cart', [
                    'sub_domain' => $this->domain,
                    'rowId' => null
                ]);
            }
        }
        return $url;
    }

    public function orders()
    {
        return $this
            ->hasMany(Order::class, 'store_id')
            ->groupBy('order_id')
            ->havingRaw('count("order_id") >= 1');
    }

    public function abandoned_orders()
    {
        return $this->hasMany(AbandonedOrder::class, 'store_id','id');
    }


    public function order_records()
    {
        return $this->hasMany(OrderRecord::class, 'store_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'store_id');
    }

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'store_id');
    }

    public function getCurrentSubscriptions()
    {
        return $this->subscribes()->orderBy('id', 'DESC')->first();
    }

    public function getLang()
    {
        if ($this->language == 0)
            $language = 'ar';
        elseif ($this->language == 1)
            $language = 'en';
        elseif ($this->language == 3)
            $language = 'fr';
        else
            $language = app()->getLocale();
        return $language;
    }

    public function getOffersForThisMonth()
    {
        $subscription = $this->getCurrentSubscriptions();
        return $this->offers()->whereBetween('created_at', [$subscription->created_at, $subscription->deadline])->get();
    }

    public function getOrdersForThisMonth()
    {
        $subscription = $this->getCurrentSubscriptions();
        return $this->orders()->whereBetween('created_at', [$subscription->created_at, $subscription->deadline])->get();
    }

    protected $attributes = [
        'payment_methods' => '{"paypal":{"paypal_status":"0","paypal_client_id":"","paypal_secret":"","paypal_type":"sandbox","Feilds":{"fullname":1,"address":1,"email":1,"more_details":0}},"Bankily":{"Bankily_status":"1","Bankily_name_transfer_method":null,"Bankily_account_number":null,"Bankily_account_name":null,"Bankily_account_iban":null,"Feilds":{"fullname":1,"address":1,"email":0,"more_details":0}},"Paiement_when_receiving":{"Paiement_when_receiving_status":"1","Feilds":{"fullname":1,"address":1,"email":0,"more_details":0}},"Bank_transfer":{"Bank_transfer_status":"0","Feilds":{"fullname":1,"address":1,"email":1,"more_details":0}}}'
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'store_id', 'id');
    }

    public function getOrdersStoreAttribute()
    {
        # orders_store
        return $this->hasMany(Order::class, 'store_id');
    }

    public function getChievmentOfTargetAttribute()
    {
        # chievment_of_target
        return $this->orders_store->where('status', 4)->
        where('created_at', '>=', $this->target->updated_at ?? date('Y-m-d h:i:s'))->whereHas('payment', function (Builder $query) {
            $query->where('order_payments.status', 1);
        })->sum('amount');
    }
    public function subscribe_last()
    {
        return $this->hasOne(Subscribe::class, 'store_id')->latest();
    }
    public function getPercentAchievementTargetAttribute()
    {
        #percent_achievement_target
        if (empty($this->target->value)) {
            return '0%';
        }

        return (($this->chievment_of_target / $this->target->value) * 100) . '%';

    }

    public function paymentNote()
    {
        return $this->hasOne(\App\Models\Attribute::class, 'store_id', 'id')->where(['key' => 'payment_note', 'lang' => l()]);
    }

    public function thanksNote()
    {
        return $this->hasOne(\App\Models\Attribute::class, 'store_id', 'id')->where(['key' => 'thanks_note', 'lang' => l()]);
    }

    public function market_place_affilites(){
        return $this->hasOne(MarketPlaceAffiliate::class,'store_id','id');
    }

    public function wait_to_be_market_place_affiliates(){
        return $this->market_place_affilites->where('status',0)->exists();
    }

    public function has_market_place_affiliates(){
        return $this->market_place_affilites->where('status',1)->exists();
    }

    public function refused_market_place_affiliates(){
        return $this->market_place_affilites->where('status',2)->exists();
    }

    public function competitons()
    {
        return $this->hasMany(Competition::class, 'store_id', 'id');
    }
}


//Developed Saed Z. Sinwar
