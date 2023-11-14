<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{

    use SoftDeletes, Notifiable, HasRoles;

    protected $fillable = [
        'video_watched',
        'steps',
        'reference_affiliate_id',
        'invitation_code'
    ];
    protected $guarded = [];
    protected $hidden = [
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function wallet_payments()
    {
        return $this->hasMany(MerchantWallet::class, 'user_id', 'id');
    }

    public function getCurrency()
    {
        return $this->store()->first()->information()->first()->currency;
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    //Developer Muhamed Fawzy 3-12-2023
     public function Competition()
    {
        return $this->hasMany(Competition::class,'user_id','id');
    }

    public function get_store_domain()
    {
        if ($this->getRoleNames()[0] == 'SuperAdmin' or $this->getRoleNames()[0] == 'Admin') {
            return route('site.index');
        }
        $host = $this->store()->first()->customDomain()->whereStatus(true)->first();
        if ($host) {
            return 'https://' . $host->custom;
        }
        return route('store.index', ['sub_domain' => $this->store()->first()->domain]);
    }

    public function getCurrentSubscriptions()
    {
        $store = $this->store()->first();
        if ($store) {
            return $store->subscribes()->orderBy('id', 'DESC')->first();
        }
        return;
    }

    public function getWalletTotalAttribute()
    {
        // wallet_total
        return $this->wallet_payments()->where(['type_operation' => 0, 'status' => 1])->sum('amount') - $this->wallet_payments()->where(['type_operation' => 1, 'status' => 1])->sum('amount');
    }

    public function affiliates(){
        return $this->hasOne(Affiliate::class,'inviter_id','id');
    }

    public function affiliatee(){
        return $this->belongsTo(Affiliate::class,'reference_affiliate_id','id');
    }

    public function invitee_profit(){
        return $this->hasMany(ProfitAffiliate::class,'invitee_id','id');
    }


    public function is_affiliater(){
        return $this->affiliates()->exists();
    }

    public function is_invited_by_affiliate(){
        return $this->affiliatee()->exists();
    }

    public function affiliater_marketplace(){
        return $this->hasMany(AffiliaterMarketplace::class,'user_id','id');
    }

    public function competition_joins(){
        return $this->HasMany(CompetitionJoin::class,'user_id','id');
    }

    public function competition_visits_count(){
        return $this->HasMany(CompetitionVisitCount::class,'user_id','id');
    }
}
//Developed Saed Z. Sinwar