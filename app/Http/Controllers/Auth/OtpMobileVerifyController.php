<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use App\CustomDomain;
class OtpMobileVerifyController extends Controller
{
    //

    function otp_verify_mobile(){
        $store = Store::where('domain', env('MainDomain'))->first();
        $information = $store->information()->first();
        $Context =[
            'information' => $information,
        ];
        return view('auth.verify-otp')->with($Context);
    }

    function otp_verified_mobile(){
        try{
            auth()->user()->update([
                'mobile_verify'=>1,
            ]);
            return json_encode(['status'=>'success','message'=>__('site.success_otp')]);
        }
        catch(\Exception $e){
            return json_encode(['status'=>'error','message'=>__('site.error_otp')]);
        }

    }
}
