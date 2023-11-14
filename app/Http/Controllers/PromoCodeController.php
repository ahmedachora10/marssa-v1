<?php

namespace App\Http\Controllers;

use App\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $context = ['title_page' => 'promo_codes'];
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User' or $auth_user->getRoleNames()[0] == 'SubUser') {
            $promo_codes = $auth_user->store()->first()->promo_codes()->orderBy('id', 'DESC')->paginate(12);
        } else {
            $promo_codes = PromoCode::orderBy('id', 'DESC')->paginate(12);
        }
        $context['promo_codes'] = $promo_codes;
        return view('dashboard.promo_codes', $context);
    }

    public function add()
    {
        $auth_user = auth()->user();
        $context = [
            'title_page' => 'add_new',
            'promo_code' => false,
            'route' => route('dashboard.admin.promo_codes.add'),
        ];
        return view('dashboard.add_promo', $context);
    }


    public function promo_code_add(Request $request)
    {
        $data = $request->all();
        $auth_user = auth()->user();
        $validator = Validator::make($data, [
            'code' => ['required', 'string', 'unique:promo_codes,code'],
            'promo_code_start' => ['required', 'date'],
            'promo_code_end' => ['required', 'date', 'after:promo_code_start'],
            'discount_promo' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $promo_code = new PromoCode();
        $promo_code['start'] = date('Y/m/d', strtotime($data['promo_code_start']));
        $promo_code['end'] = date('Y/m/d', strtotime($data['promo_code_end']));
        $promo_code['discount'] = $data['discount_promo'];
        $promo_code['code'] = $data['code'];
        $promo_code['type_discount'] = $data['type_discount'];
        $promo_code['count']         = $data['count'];
        $promo_code->store()->associate($auth_user->store()->first());
        $promo_code->save();
        return redirect()->route('dashboard.admin.promo_codes');
    }

    public function promo_code_delete($id)
    {
        $auth_user = auth()->user();
        $promo_code = $auth_user->store()->first()->promo_codes()->whereId($id)->first();
        if (!$promo_code) {
            return back()->with('error', 'The Request Failed To Execute');
        }
        $promo_code->delete();
        toast(__('master.Successfully'),'success');
        return back();
    }

    public function promo_code_edit($id)
    {
        $auth_user = auth()->user();
        $promo_code = $auth_user->store()->first()->promo_codes()->whereId($id)->first();
        if ($promo_code) {
            $route = route('dashboard.admin.promo_codes.update', ['id' => $id]);
            $context = [
                'title_page' => 'promo_code_edit',
                'promo_code' => $promo_code,
                'route' => $route
            ];
            return view('dashboard.add_promo', $context);
        }
        return redirect()->back();
    }

    public function promo_code_update(Request $request)
    {
        $data = $request->all();
        $auth_user = auth()->user();
        $promo_code = $auth_user->store()->first()->promo_codes()->whereId($data['id'])->first();
        if ($promo_code) {
            $validator = Validator::make($data, [
                'code' => ['required', 'string', 'unique:promo_codes,code,' . $data['id']],
                'promo_code_start' => ['required', 'date'],
                'promo_code_end' => ['required', 'date', 'after:promo_code_start'],
                'discount_promo' => ['required', 'numeric'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput($data)->withErrors($validator->errors());
            }
            $promo_code->update([
                'start' => date('Y/m/d', strtotime($data['promo_code_start'])),
                'end' => date('Y/m/d', strtotime($data['promo_code_end'])),
                'discount' => $data['discount_promo'],
                'code' => $data['code'],
                'type_discount'  => $data['type_discount'],
                'count'          => $data['count']
            ]);
        }

        return redirect(route('dashboard.admin.promo_codes'));
    }

}

//Developed Saed Z. Sinwar
