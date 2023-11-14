<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\CustomDomain;
use App\Plan;

use Mail;
use App\Mail\TechnicalSupport;

class CustomDomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function requests()
    {
        $requests = CustomDomain::orderBy('id', 'DESC')->paginate(12);
       
        return view('dashboard.change_domain_requests', ['title_page' => 'DomainChangeOrders', 'requests' => $requests]);
    }

    public function subdomain(Request $request)
    {
        $store = auth()->user()->store()->first();
        $data = $request->all();
        $validator = Validator::make($data, [
            'domain' => ['required', 'string', 'max:255', 'unique:stores,domain,' . $store->id],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $updated = $store->update(['domain' => $data['domain'], 'new_domain' => $data['domain']]);
        if ($updated) {
            toast(__('master.Successfully'),'success');
            return back();
            //return back()->with('success', 'Successfully');
        } else {
            return back()->with('success', 'Fail');
        }
    }

    public function change_requests($id)
    {
        $obj = CustomDomain::whereId($id)->first();
        if ($obj) {
            CustomDomain::whereStore_id($obj->store_id)->update(['status' => false]);
            $obj->update(['status' => !$obj['status']]);
        }
        return redirect()->back();
    }

    public function customdomain(Request $request)
    {
        $store = auth()->user()->store()->first();
        $data = $request->all();
        $validator = Validator::make($data, [
            'customdomain' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        if ($store->plan()->first()->custom_domain) {
            $parse_url = parse_url($data['customdomain']);
            if (array_key_exists("host", $parse_url) or array_key_exists("path", $parse_url)) {
                $host = array_key_exists("host", $parse_url) ? $parse_url['host'] : $parse_url['path'];
                $host = preg_replace('/^www\./', '', $host);
                $data['customdomain'] = $host;
                $unique = CustomDomain::whereCustom($host)->first();
                if (!$unique) {
                    $custom = new CustomDomain();
                    $custom['custom'] = $host;
                    $custom->store()->associate($store);
                    if ($custom->save()) {
                        $store->update(['new_domain' => $host]);
                        $response = 'طلب تغيير نطاق بحاجة لمعالجة ، للمتجر رقم #' . $store->id . ', نرجو مراجعة العملية والتحقق من علمية ربط أسماء الخوادم؛ لتفاصيل أكثر نرجو زيارة لوحة التحكم الخاصة بالمنصة.';
                        $data_message = array('status' => 'domain', 'id' => $custom->id, 'name' => 'SuperManager', 'response' => $response);
                        try {
                            Mail::to(env('MAIL_NOTIFY'), 'SuperManager')
                                ->cc(env('MAIL_USERNAME'), env('APP_NAME'))
                                ->send(new TechnicalSupport($data_message));
                        } catch (Exception $e) {
                        }

                        toast(__('master.Successfully'),'success');
                        return back();
                        //return back()->with('success', 'Successfully');
                    }
                }
            }
        }
        return back()->with('success', 'Fail');
    }
}
//Developed Saed Z. Sinwar
