<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Payment;
use App\Subscribe;

class InvoicesController extends Controller
{
    public function index()
    {
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User' or $auth_user->getRoleNames()[0] == 'SubUser') {
            $invoices = $auth_user->payments()->orderBy('id', 'desc')->paginate(12);
        } else {
            $invoices = Payment::orderBy('id', 'desc')->paginate(12);
        }
        $context = [
            'title_page' => 'invoices',
            'invoices' => $invoices
        ];
//        dd($context);
        return view('dashboard.invoices', $context);
    }

    public function edit($id)
    {
        $payment = Payment::whereId($id)->first();
        if (!$payment) {
            return redirect()->back();
        }
        $context = [
            'title_page' => 'invoice_edit',
            'invoice' => $payment,
        ];
        return view('dashboard.invoices', $context);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'id' => ['required', 'exists:payments,id'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $payment = Payment::whereId($data['id'])->first();
        if ($payment->bill) {
            $status = $data['status'] ?? false;
            $payment->update(['status' => $status]);
            if ($status == 1) {
                $plan = $payment->plan()->first();
                $user = $payment->user()->first();
                $store = $user->store()->first();
                $new_deadline = Subscribe::whereStore_id($store->id)->pluck('new_deadline')->toArray();
                $subscribe = new Subscribe();
                $subscribe['deadline'] = $new_deadline[0] ? $new_deadline[0] :  now()->addMonth();
                $subscribe->payment()->associate($payment);
                $subscribe->store()->associate($store);
                $subscribe->plan()->associate($plan);

                if ($subscribe->save()) {
                    Subscribe::whereStore_id($store->id)->update(['status' => false,'new_deadline'=>null]);
                    $subscribe->update(['status' => true]);
                    
                };

                $user->update(['status' => true]);
                $store->update(['status' => true, 'plan_id' => $plan->id]);
            }
        }
        return redirect()->back();
    }
}
//Developed Saed Z. Sinwar
