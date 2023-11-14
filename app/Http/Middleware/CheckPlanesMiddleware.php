<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Subscribe;
use App\Models\User;
use App\Models\Store;
use App\Models\CustomDomain;

class CheckPlanesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next , $section)
    {
        $user  = auth()->user();
        $plans = $user->store->plan->permissions;
        if( !empty($plans) && $user->permission != 1 ){
            if( $plans[$section]  == '0' ){
                return redirect('must-upgrade/'.$section);
            }
        }

        return $next($request);

    }
}
