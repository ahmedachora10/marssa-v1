<?php

namespace App\Http\Middleware;

use Closure;

class CheckMobileVerify
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*if(auth()->user()->mobile_verify == 0 ){
            return redirect('verify-mobile');
        }*/
        if (session()->has('pre')) {
            $url = session('pre');
            session()->forget('pre');
            return redirect($url);
        }
        return $next($request);
    }
}
