<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Subscribe;
use App\Models\User;
use App\Models\Store;
use App\Models\CustomDomain;

class CheckStoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $context = [];
        $store = false;

        $domain = $request->sub_domain;

        $host = parse_url($request->url())['host'];
        $host = preg_replace('/^www\./', '', $host);

        if (strpos($host, env('MAIN_DOMAIN')) === false and $domain === null) {

            $custom = CustomDomain::whereCustom($host)->whereStatus(true)->first();
            if ($custom) {
                $store = $custom->store()->first();
            }
        } else {
            $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();

        }

        if ($store) {

            if ($store->status == 0) {
                $context['error'] = 'store';
            } else {
                // if (!$store->getCurrentSubscriptions() or $store->getCurrentSubscriptions()->deadline <= now()) {
                //     Subscribe::whereStore_id($store->id)->update(['status' => false]);
                //     $store->update(['status' => false]);
                //     $context['error'] = 'store';
                // }



                # Automatic data verification
                if (!$store->plan()->first()->language) {
                    if ($store->language == 2) {
                        $store->update(['language' => 0]);
                        app()->setLocale('ar');
                        session()->put('locale', 'ar');

                    }elseif ($store->language == 4){


                        $store->update(['language' => 0]);
                        app()->setLocale('ar');
                        session()->put('locale', 'ar');

                    } else {

                        $locale = $store->language == 0 ? 'ar' : 'en';

                        app()->setLocale($locale);
                        session()->put('locale', $locale);
                    }
                } else {

                    if ($store->language != 2 ) {

                        if ($store->language == 0) {
                            $locale = 'ar';
                        } elseif($store->language == 1) {
                            $locale = 'en';
                        } elseif($store->language == 3) {
                            $locale = 'fr';
                        }
                        elseif($store->language == 4) {
                            $locale=session()->get('locale');
                            if ($locale==null){
                                $locale='ar';
                            }else{
                                $locale =$locale;
                            }

                        }
                        app()->setLocale($locale);
                        session()->put('locale', $locale);
                    }
                }
                if (!$store->plan()->first()->custom_design) {
                    if ($store->design) {
                        $store->update(['design' => null]);
                    }
                }
                if (!$store->plan()->first()->custom_domain) {
                    if ($store->new_domain) {
                        $store->update(['new_domain' => null]);
                        CustomDomain::whereStore_id($store->id)->update(['status' => false]);
                    }
                }
            }
        } else {
            $context['error'] = 'store';
        }

        if (count($context) > 0) {

            $information = User::role('SuperAdmin')->first()?->store()?->first()?->information()?->first();
            $context['information'] = $information;
            $context[''] = $information;

            return response(view('Store.handle_404', $context));
        }

        return $next($request);
    }
}