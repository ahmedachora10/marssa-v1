<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\DataTables\affiliateesDataTable;
use App\ProfitAffiliate;
use App\BalanceWithdraw;
use App\User;
use Mail;
use App\Mail\InvitationAffiliateMail;

class AffiliateController extends Controller
{
    //

    public function affiliate_index(){
        $title_page = 'affiliate';
        return view('dashboard.affiliate_index',compact('title_page'));
    }
    public function create_affiliate(){
        $title_page = 'create-affiliate';
        return view('dashboard.affiliates.index',compact('title_page'));
    }

    public function store_affiliate(Request $request){
        $request->merge(['inviter_id'=>auth()->user()->id]);

        $this->validate($request,[
            'inviter_id' => 'unique:affiliates,inviter_id'
        ]);

        $code_generate = auth()->user()->id.rand(1,10);
        
        auth()->user()->affiliates()->create([
           'code_affiliate' => $code_generate
        ]);
        

        return redirect()->back()->with('message',__('master.affiliate_success_created'));
    }

    public function show_affiliatees() {
         $Context['my_affilitees'] = auth()->user()->affiliates ? auth()->user()->affiliates->affiliatees : null;
         $Context['title_page']    = 'show-affiliate';
         return view('dashboard.affiliates.affiliatee')->with($Context);
    }

    public function my_profit_affiliatees(){
         $Context['profits']       = auth()->user()->affiliates ? auth()->user()->affiliates->profits : null;
         $Context['title_page']    = 'affiliates-profits';
         return view('dashboard.affiliates.profit-affiliate')->with($Context);
    }

    public function order_withdraw_affiliatees(Request $request){
        $this->validate($request,[
           'value' => 'required|lte:'.auth()->user()->affiliates->value_profits()
        ]);

        $withdraw_value = auth()->user()->affiliates->withdraw()->create([
            'withdraw_value' => $request->value,
            'notice_payment' => $request->notice_payment,
            'status'         => 0
        ]);

        if($withdraw_value){
            return redirect()->back()->with('message','تم ارسال الطلب ينجاح');
        }
    }

    public function affiliater_withdraws(Request $request){
        $Context['withdraw_orders'] = auth()->user()->affiliates ? auth()->user()->affiliates->withdraw()->where([
            'withdrawable_type'=> 'App\Affiliate',
            
        ])->get() : null;
        $Context['title_page']      = 'affiliatees-withdraw'; 
        return view('dashboard.affiliates.affiliate-withdraws')->with($Context);
    }
    
    public function send_invitation_email(Request $request){
        $check_if_exist = User::where('email',$request->invitee_email)->exists();
        if(!$check_if_exist){
            try{
                Mail::to($request->invitee_email)
                ->send(new InvitationAffiliateMail());
                return redirect()->back()->with('message','تم ارسال الدعوة بنجاح ');
            }catch(\Exception $e){
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        
        return redirect()->back()->with('message','البريد الالكتروني الذي تقوم بدعوته موجود بالفعل يمكنك ارسال دعوة لاشخاض أخرين');
       
    }
    
    public function send_message_whatsapp_invitation(Request $request){
        $check_if_exist = User::where('mobile',$request->mobile)->exists();
        if(!$check_if_exist){
           $message = __('master.message_whatsapp').'%0A'.url('register?reference_id='.auth()->user()->affiliates->code_affiliate);
           return redirect()->to('https://api.whatsapp.com/send?phone='.$request->mobile.'&text='.$message);
        }
        return redirect()->back()->with('message','رقم الجوال الذى ادخلته بالفعل موجود يمكن دعوة اشخاص أخريين');
       
    }
}
