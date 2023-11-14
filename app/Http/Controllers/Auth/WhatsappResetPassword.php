<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Ws;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Store;
use App\CustomDomain;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;

class WhatsappResetPassword extends Controller
{
    function index()
    {

        $store = Store::where('domain', env('MainDomain'))->first();
        $information = $store->information()->first();
        return view('auth.whatsapp-form', ['information' => $information]);
    }

    function whatsapp_message_handle(Request $request)
    {
//        dd($request->all());
       /* $this->validate($request, [
            'mobile' => 'required',
            '_country_mobile_code_country' => 'required',
        ]);*/

        $mobile = "+" . $request->_country_mobile_code_country . $request->mobile;
        $name = $request->name;
        $user = User::where(['mobile' => $mobile])->first();
        if ($user) {
            $code = genratePassword();
            $user->password = Hash::make($code);
            $user->save();
            $message = "تم طلب كلمة مرور بناء على رغبتك" . PHP_EOL;
            $message .= "كلمة المرور الجديدة" . PHP_EOL;
            $message .= "$code" . PHP_EOL;
        \Log::info($message);
            Ws::make($mobile, "$message")->send();
        \Log::info('don');
            session()->flash('success', 'done');
            return back();
        } else {
            Alert::error(__("Store.error"));
            return back();
        }

    }
}
