<?php

namespace App\Http\Controllers;

use App\User;
use App\Plan;
use Mail;
use App\Mail\TechnicalSupport;
use App\PromoCodePlan;
use App\Subscribe;
use App\Payment as PaymentTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Wallet\MerchantWalletController;
use Session;
use Redirect;
use Log;

class PaymentController extends Controller
{

    public function check_promo($id, Request $request)
    {
        $code = $request->all()['code'];
        $months_subscription = $request->all()['months_subscription'];
        $plan = Plan::whereId($id)->first();
        if (!$plan) {
            return response()->json(['status' => 'fail']);
        }
        $promo_code = $plan->promo_codes_plan()->whereStatus(1)->whereCode($code)->where('end', '>', now())->where('start', '<=', now())->first();
        $total = SELF::total_promo_or_months_subcription([
            'months'  =>$months_subscription ?? 1,
            'discount'=>$promo_code->discount ?? 0,
        ],$plan);
        if ($promo_code) {
            return response()->json(['status' => 'done', 'discount' => $promo_code->discount, 'total' => $total]);
        } else {

            return response()->json(['status' => 'fail','total' => $total]);
        }
    }

    public function check_subscription_term($id, Request $request)
    {
        $months_subscription = $request->all()['months_subscription'];
        $discount = $request->all()['discount'];
        $plan = Plan::whereId($id)->first();
        if (!$plan) {
            return response()->json(['status' => 'fail']);
        }

        $total = SELF::total_promo_or_months_subcription([
            'months'  =>$months_subscription ?? 1,
            'discount'=>$discount,
        ],$plan);

        return response()->json(['status' => 'done', 'total' =>$total ]);

    }
    public static function total_promo_or_months_subcription($data = array(),$plan = null){

        if( count($data) <= 0) return;

        $total = 0;

        if(!empty($data['months'])){
            if($data['months'] == 1):
               $total =  $plan->percentage_discount($data['months'],0);
            elseif($data['months'] == 2):
               $total =  $plan->percentage_discount($data['months'],0);
            elseif($data['months'] == 3):
               $total =  $plan->percentage_discount($data['months'],5);
            elseif($data['months'] == 6):
               $total =  $plan->months_discount($data['months'],1);
            elseif($data['months'] == 12):
               $total =  $plan->months_discount($data['months'],2);
            endif;
        }

        if(!empty($data['discount'])){
            $total = round( ($total != 0 ? $total : $plan->price) - $data['discount'], 2);
        }

        return $total;
    }

    public function pending($id, Request $request)
    {
        return redirect()->route('site.index');
    }

    public function free(Request $request){
        $user = auth()->user();
        $data = $request->all();
        
        $store = $user->store()->first();
        $plan = Plan::where('id',$request->id)->first();
        
        $days = 0;
        if($plan->is_commission == 1) {
            $days = now()->addDays(99);
            $store->max_indebtedness = $plan->max_indebtedness;
            $store->indebtedness_percent = $plan->commission_precent;
            $store->save();
            
        } else {
           $days = now()->addDays(env('NumberDaysSubscribeFreePlan'));
        }
        
        $subscribe = new Subscribe();
        $subscribe['deadline'] = $days;
        $subscribe->store()->associate($store);
        
        $subscribe->plan()->associate($plan);
        
        if ($subscribe->save()) {
            Subscribe::whereStore_id($store->id)->update(['status' => false]);
            $subscribe->update(['status' => true]);
            $user->update(['status' => true]);
            $store->update(['status' => true, 'plan_id' => $plan->id]);
            
            
            return redirect(route('dashboard.index'))->with('message', 'payment_success');
        };
        return redirect(route('dashboard.index'))->with('message', 'payment_failed');
    }

    public function subscription_package(Request $request){

            $data = $request->all();
            $user = auth()->user();
            $store = $user->store()->first();
            $plan = Plan::whereId($data['id'])->first();
            if (!$plan) {
                return redirect(route('dashboard.index'))->with('danger', 'payment_failed');
            }
            if($store->indebtedness > 0) {
                return redirect(route('dashboard.index'))->with('message', 'Please pay total commissions');
            }
            $code = empty($data['valid_code']) ? $data['promo_code'] : $data['valid_code'];
            $total = $plan->price;
            $promo_code = $plan->promo_codes_plan()->whereStatus(1)->whereCode($code)->where('end', '>', now())->where('start', '<=', now())->first();

            $total = SELF::total_promo_or_months_subcription([
                'months'  =>$data['months'] ?? 1,
                'discount'=>$promo_code->discount ?? 0,
            ],$plan);
            $total_amount = number_format((float)$total, 2, '.', '');
            $months = $data['months'] ?? 1;
            
            

            $withdraw_Amount_from_wallet = MerchantWalletController::withdraw_amount_from_wallet([
                'total_amount'=>$total_amount
            ]);


            if($withdraw_Amount_from_wallet['status'] == 'success'){
                $pay = new PaymentTable();
                $pay->user()->associate($user);
                $pay->plan()->associate($plan);
                $promo_code ? $pay->promo_code()->associate($promo_code) : null;
                $pay['amount_total'] = $total_amount;
                $pay['discount'] = $promo_code ? $promo_code->discount : 0;
                $pay['type'] = 'Wallet';
                $pay->save();
                $subscribe = new Subscribe();
                $subscribe['deadline'] = $months ? date('Y-m-d h:i:s',strtotime($months.' months ')) : now()->addMonth();
                $subscribe->payment()->associate($pay);
                $subscribe->store()->associate($store);
                $subscribe->plan()->associate($plan);

                if ($subscribe->save()) {
                    Subscribe::whereStore_id($store->id)->update(['status' => false]);
                    $subscribe->update(['status' => true]);
                };

                $user->update(['status' => true]);
                $store->update(['status' => true, 'plan_id' => $plan->id]);
                $message = 'payment_success';
                return redirect(route('dashboard.index'))->with('message', $message);
            }

            $message = 'payment_failed';
            return redirect(route('dashboard.index'))->with('message', $message);


    }


}
//Developed Saed Z. Sinwar
