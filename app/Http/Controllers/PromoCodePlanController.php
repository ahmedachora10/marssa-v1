<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Plan;
use App\PromoCodePlan;

class PromoCodePlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function promo_codes()
    {
        $plans = Plan::all();
        $promo_codes = PromoCodePlan::all();
        $route = route('dashboard.admin.plans.promo_codes.add');
        $context = [
            'title_page' => 'promo_codes',
            'plans' => $plans,
            'promo_codes' => $promo_codes,
            'promo_code' => false,
            'route' => $route,
        ];
        return view('dashboard.promo_codes_plans', $context);
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'code' => ['required', 'string', 'unique:promo_codes,code'],
            'promo_code_start' => ['required', 'date'],
            'promo_code_end' => ['required', 'date', 'after:promo_code_start'],
            'discount_promo' => ['required', 'numeric'],
            'plan_id' => ['required', 'exists:plans,id'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $plan = Plan::whereId($data['plan_id'])->first();
        $promo_code = new PromoCodePlan();
        $promo_code['start'] = date('Y/m/d', strtotime($data['promo_code_start']));
        $promo_code['end'] = date('Y/m/d', strtotime($data['promo_code_end']));
        $promo_code['discount'] = $data['discount_promo'];
        $promo_code['code'] = $data['code'];
        $promo_code->plan()->associate($plan);
        $promo_code->save();

        return redirect()->route('dashboard.admin.plans.promo_codes');
    }

    public function edit($id)
    {
        $promo_code = PromoCodePlan::whereId($id)->first();
        if ($promo_code) {
            $route = route('dashboard.admin.plans.promo_codes.update', ['id' => $id]);
            $context = [
                'title_page' => 'promo_code_edit',
                'promo_code' => $promo_code,
                'route' => $route
            ];
            return view('dashboard.promo_codes_plans', $context);
        }
        return redirect()->back();
    }

    public function delete($id)
    {
        $promo_code = PromoCodePlan::whereId($id)->first();
        if (!$promo_code) {
            return back()->with('error', 'The Request Failed To Execute');
        }
        $promo_code->delete();
        toast(__('master.Successfully'),'success');
        return redirect()->back();
        //return back()->with('success', 'Successfully');
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $promo_code = PromoCodePlan::whereId($data['id'])->first();
        if ($promo_code) {
            $price = $promo_code->plan()->first()->price;
            $validator = Validator::make($data, [
                'code' => ['required', 'string', 'unique:promo_codes,code,' . $data['id']],
                'promo_code_start' => ['required', 'date'],
                'promo_code_end' => ['required', 'date', 'after:promo_code_start'],
                'discount_promo' => ['required', 'numeric', 'lt:' . $price],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($data)->withErrors($validator->errors());
            }
            $promo_code->update([
                'start' => date('Y/m/d', strtotime($data['promo_code_start'])),
                'end' => date('Y/m/d', strtotime($data['promo_code_end'])),
                'discount' => $data['discount_promo'],
                'code' => $data['code'],
            ]);
        }
        return redirect(route('dashboard.admin.plans.promo_codes'));
    }

}
//Developed Saed Z. Sinwar