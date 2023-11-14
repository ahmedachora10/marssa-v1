<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Store;
use App\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SubscribeController extends Controller
{
    public function index()
    {
        $context = [
            'route' => route('dashboard.admin.subscriptions.register'),
            'title_page' => 'subscriptions',
            'subscribes' => Subscribe::whereStatus(1)->orderBy('id', 'desc')->get(),
            'stores' => Store::where('domain', '<>', env('MainDomain'))->get(),
            'plans' => Plan::all(),
        ];
        //dd(Subscribe::whereStatus(1)->orderBy('id', 'desc')->paginate(12));
        return view('dashboard.subscriptions', $context);
    }

    public function reSubscribeTrial()
    {
        $store = auth()->user()->store;
        $subscribe = $store->subscribes()->first();
        $subscribe_deadline = false;
        if ($subscribe) {
            if (Carbon::parse($subscribe->deadline) < now()) {
                $subscribe_deadline = true;
            }
        }
        if ($store->plan->id == 4 and $store->getOrdersStoreAttribute()->count('*') < 3 and $subscribe_deadline) {
            $subscribe->deadline = now()->addDays(14);
            $subscribe->status = 1;
            $subscribe->save();
            $store->status = 1;
            $store->save();
            Alert::success(__("Done"));
            return back();
        } else {
            abort(404);
        }
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'store' => ['required', 'string', 'exists:stores,id'],
            'plan' => ['required', 'string', 'exists:plans,id'],
            'deadline' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $store = Store::whereId($data['store'])->first();
        $plan = Plan::whereId($data['plan'])->first();
        $subscribe = new Subscribe();
        $subscribe['deadline'] = Carbon::parse($data['deadline']);
        $subscribe['pay'] = 'System';
        $subscribe->store()->associate($store);
        $subscribe->plan()->associate($plan);

        $status = $subscribe->deadline > now();
        if ($subscribe->save()) {
            Subscribe::whereStore_id($data['store'])->update(['status' => false]);
            $subscribe->update(['status' => $status]);
            $store->update(['status' => $status, 'plan_id' => $plan->id]);
        };

        return redirect()->back();
    }

    public function edit($id, Request $request)
    {
        $subscribe = Subscribe::whereId($id)->first();
        if (!$subscribe) {
            return redirect()->back();
        }
        $context = [
            'route' => route('dashboard.admin.subscriptions.update'),
            'title_page' => 'subscription_edit',
            'stores' => Store::where('domain', '<>', env('MainDomain'))->get(),
            'plans' => Plan::all(),
            'subscribe' => $subscribe,
        ];
        return view('dashboard.subscriptions', $context);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'id' => ['required', 'exists:subscribes,id'],
            'plan' => ['required', 'string', 'exists:plans,id'],
            'deadline' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $subscribe = Subscribe::whereId($data['id'])->first();
        $subscribe->update([
            'deadline' => Carbon::parse($data['deadline']),
            'plan_id' => $data['plan'],
        ]);
        $status = $subscribe->deadline > now();
        $subscribe->store()->update(['status' => $status, 'plan_id' => $data['plan']]);

        return redirect()->route('dashboard.admin.subscriptions.index');
    }


}
//Developed Saed Z. Sinwar
