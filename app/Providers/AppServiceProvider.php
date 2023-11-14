<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Subscribe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Order::observe(\App\Observers\OrderObserve::class);
        User::observe(\App\Observers\UserObserve::class);
        Schema::defaultStringLength(191);
        Blade::if('PlanPermissions', function ($rule,$count=null) {
            $user  = auth()->user();
            $plans = $user->store->plan->permissions;
            if( !empty($plans) && $user->permission != 1 ){
                if( $plans[$rule]  == '0'  ){
                  return false;
                }

                if( !empty( $count )  && ( $count >= $plans[$rule] ) ){
                    return false;
                }
            }

            return true;
        });


        Blade::if('Plan_near_complete', function () {
            $user     = auth()->user();
            $plan_id  = $user->store->plan->id;
            $store_id = $user->store->id;
            if( $user->permission != 1 ){
               $deadline = Subscribe::where(['plan_id'=>$plan_id,'store_id'=>$store_id])->pluck('deadline')[0];
               if( ( Carbon::parse($deadline) >= now() ) && ( ( Carbon::parse($deadline) ) <= Carbon::now()->addDays(10) ) ){
                   $exitCode = Artisan::call('view:clear');
                   return true;
               }
               return false;
            }

            return false;
        });

        Blade::directive('RenewAlert', function () {

            $user     = auth()->user();
            $plan_id  = $user->store->plan->id;
            $store_id = $user->store->id;
            if( $user->permission != 1 ){
               $deadline = Subscribe::where(['plan_id'=>$plan_id,'store_id'=>$store_id])->pluck('deadline')[0];
               return __('master.renew_alert',['day'=>Carbon::parse($deadline)->day - now()->day ]);
            }
        });
        if (!session()->has('locale')) {
            if (request()->server('HTTP_ACCEPT_LANGUAGE')) {
                $lang = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
                if (in_array($lang, ['ar', 'en', 'fr'])) {
                    session()->put('locale', $lang);
                }
            }
        }
    }
}