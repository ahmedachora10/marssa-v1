<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Affiliate;
use App\ProfitAffiliate;
use App\BalanceWithdraw;
class affiliatersController extends Controller
{
    //
    public function show_affiliaters() {
        $affiliters = Affiliate::select('*')->latest()->get();
        $Context = [
             'affiliters' => $affiliters,
             'title_page' => 'affiliaters'
        ];
        
        
        return view('dashboard.affiliaters.affiliaters-show')->with($Context);
    }

    public function profites_affiliaters() {
        $profits = ProfitAffiliate::select('*')->latest()->get();
        $Context = [
             'profits'    => $profits,
             'title_page' => 'affiliaters'
        ];
        return view('dashboard.affiliaters.profits-show')->with($Context);
    }
    
   

    public function show_affiliater_details(User $user){
        $affiliatees = $user->affiliates ? $user->affiliates->affiliatees()->latest()->get() : collect();
        $Context = [
             'affiliatees'    => $affiliatees,
             'title_page'     => 'inviters',
             'user'           => $user
        ];
        return view('dashboard.affiliaters.show-details')->with($Context);
    }
    
     public function update_status_affiliate_rate(Request $request,User $user){
        $user->affiliates->update([
           'status_affiliate_rate' => $request->status_affiliate_rate    
        ]);
        $affiliatees = $user->affiliates ? $user->affiliates->affiliatees()->latest()->get() : collect();
        $Context = [
             'affiliatees'    => $affiliatees,
             'title_page'     => 'inviters',
             'user'           => $user
        ];
        return redirect()->back()->with($Context);
    }
    

    public function affiliaters_withdraw_profits(){
        $withdraw_orders  = BalanceWithdraw::select('*')->where([
            'withdrawable_type'=> 'App\Affiliate',
        ])->get();
        $Context = [
             'withdraw_orders'    => $withdraw_orders,
             'title_page'         => 'withdraw-profites'
        ];
        
        return view('dashboard.affiliaters.withdrow-profits')->with($Context);
    }
    
    public function show_withdraw_order(BalanceWithdraw $order){
        $Context = [
             'order'       => $order,
             'title_page'  => 'withdraw_order_affiliate'
        ];
        
        return view('dashboard.affiliaters.show-withdrow-order')->with($Context);
    }

    public function change_status(Request $request , $order_id){
        $update_status = BalanceWithdraw::where('id',$order_id)->update(['status' => $request->status]);
        if($update_status){
            return redirect()->back()->with('message','تم تحديث حالة الطلب بنجاح');
        }
    }
    
    public function change_affiliter_position(Request $request,Affiliate $affiliate){
        $update_status = $affiliate->update(['employee' => $request->input('position')]);
        if($update_status){
            return redirect()->back()->with('message','تم تحديث حالة الطلب بنجاح');
        }
    }
    
    public function add_salary_employee(Request $request,Affiliate $affiliate){
        $create_salary = $affiliate->profits()->create([
            'value' => $request->input('value'),
            'salary'=>1
        ]);
        if($create_salary){
            return redirect()->back()->with('message','تم اضافة المرتب بنجاح الى المسوق');
        }
    }
    
    public function delete_salary_employee($id){
        $delete_salary = ProfitAffiliate::destroy($id);
        if($delete_salary){
            return redirect()->back()->with('message','تم حذف المرتب بنجاح');
        }
    }
    
    
    
    
}
