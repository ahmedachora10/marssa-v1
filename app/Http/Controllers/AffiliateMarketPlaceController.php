<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MarketPlaceAffiliate;
use App\AffiliaterMarketplace;
class AffiliateMarketPlaceController extends Controller
{
    //
    
    public function marketplace_affiliates_create(){
        $title_page = 'affiliate_for_your_maket';
        $Context[]  = 'title_page';
        return view('dashboard.marketplace-affiliates.affiliates.create',compact($Context));
    }
    
    public function marketplace_affiliates_store(Request $request){
        // dd(auth()->user()->store->market_place_affilites);
        $create_order = auth()->user()->store->market_place_affilites()->create([
          'status' => 0
        ]);
        
        if($create_order){
            return redirect()->back()->with(['message' => __('master.order_join_affiliate_sent')]);
        }
            
    }
    
    public function marketplace_affiliaters_show(){
        $affiliters = auth()->user()->store->market_place_affiliaters()->select('*')->latest()->get();
        $Context = [
             'affiliters' => $affiliters,
             'title_page' => 'affiliaters'
        ];
        
        
        return view('dashboard.marketplace-affiliates.affiliates.affiliaters-show')->with($Context);
    }
    
    public function marketplace_affiliate_order_status($affiliate_id,$status){
        $affiliate = AffiliaterMarketplace::find($affiliate_id);
        $affiliate->update([
            'status'         => $status,
            'code_affiliate' => $affiliate->id.$affiliate->store_id.$affiliate->user_id
        ]);
        
        if($status == 1){
            $affiliate->user->assignRole('AffiliaterForMarketPlace');
            $message = 'تم قبول طلب المسوق بالعمولة الرجاء ارسال الى المسوق باقي تفاصيل الطلب';
        }
        elseif($status == 1){
            $message = 'تم رفض طلب الانضمام الى التسويق بالعمولة ';
        }
        return back()->with('message',$message);
    }
    
}
