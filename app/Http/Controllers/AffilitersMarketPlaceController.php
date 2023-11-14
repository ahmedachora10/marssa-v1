<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class AffilitersMarketPlaceController extends Controller
{
    //
    public function create_order_joining($subdomain){
        $store = Store::where('domain',$subdomain)->first();
        $information = $store->information()->first();
        $categories = Category::all();
        $head_data = [
            'title_ar' => 'كن شريكا لنا',
            'title_en' => 'be our partner',
            'title_fr' => 'be our partner',
            'description_ar' => ' شريكا لنا',
            'description_en' => 'be our partner',
            'description_fr' => 'tous les produits',
            'keyword_ar' => ' شريكا لنا',
            'keyword_en' => 'be our partner',
            'keyword_fr' => 'be our partner',
            'icon' => 'stores_assets/site/preview.png',
        ];
        $pages = $store->pages()->get();
        $details   = 'index';
        $Context[] = 'information';
        $Context[] = 'details';
        $Context[] = 'head_data';
        $Context[] = 'store';
        $Context[] = 'categories';
        $Context[] = 'pages';
        return view('Store.be_partner_affiliate_5',compact($Context));
    }
    
    public function store_order_joininig_as_partner_affiliate(Request $request ,$subdomain){
        
        
    //  $this->validate($request,[
    //         'name'  => 'required|string|unique:users,username',
    //         'mobile'=> 'required',
    //         'email' => 'required|unique:users,email',
    //         'password'=>'required'
    //     ]);
        
    //   return $validator;
        
         try {
             
             if(User::where('username',$request->name)->first()) {
                 
                return back()->with('message','اسم المستخدم موجود بالفعل') ;
             }
             
             if(User::where('email',$request->email)->first()) {
                 return back()->with('message','البريد الالكتروني مستخدم بالفعل');
             }
             
             
                $affiliater = new User();
                $affiliater->name       = $request->input('name');
                
                $affiliater->email      = $request->input('email') ?? null;
                $affiliater->mobile     = $request->input('mobile');
                $affiliater->username   = preg_replace('/[^a-zA-Z0-9]/i','',$request->input('name'));
                $affiliater->password   = Hash::make($request->password);
                $affiliater->permission = 11; // affiliter
                $affiliater->own_code = Str::random(8);
                $affiliater->save();
                
                
                
                Auth::Login($affiliater);
                return redirect('/');
                return redirect('https://marssa.shop/dashboard/index');
             } catch(Exception $e) {
             return $e->getMessage();
         }
    //     $store      = Store::where('domain',$subdomain)->first();
    //     $mobile     = $request->input('mobile');
    //     $user_name  = preg_replace('/[^a-zA-Z0-9]/i','',$request->input('name'));
    //     if(!$affiliater = User::where(['mobile'=>$mobile])->orWhere(['email' => $request->input('email')])->orWhere('username',$request->input('name'))->first()){
    //         $password   = preg_replace('/[^a-zA-Z0-9]/i','_',$request->input('name')).'_'.$store->id.'_'.time().'_'.rand(10,10000);
            
    //   }
        
    //     if($affiliater->affiliater_marketplace()->where('phone_whatsapp',$mobile)->exists()){
    //         $joining_order = $affiliater->affiliater_marketplace()->Create([
    //              'store_id'        => $store->id,
    //              'phone_whatsapp'  => $mobile,
    //              'password'        => $password ?? null,
    //              'status'          => 0 // pending
    //         ]);
            
    //         if($joining_order){
    //             return back()->with('message','لقد تم ارسال الطلب الى المتجر و سيتم الرد عليك فى أقرب وقت ممكن');
    //         }
    //     } else{
    //           return back()->with('error','رقم الواتس مستخدم بالفعل من قبل يمكنك تجريب رقم أخر');
    //     }
        
    } 
    
    
    public function create_affiliate(Request $request) {
        
        $errors = [];
        if(User::where('name',$request->username)->first()) {
            array_push($errors,'username is already exist');
        }
        if(User::where('mobile',$request->phone)->first()) {
            array_push($errors,'phone is already exist');
        }
        if(User::where('email',$request->email)->first()) {
            array_push($errors,'email is already exist');
        }
        if(strlen($request->password) < 8) {
            array_push($errors,'passowrd must be more than 8 charcaters');
        }
        
        if(count($errors) == 0) {
            
            $newUser = new User();
            $newUser->name = $request->username;
            $newUser->mobile = $request->phone;
            $newUser->email = $request->email;
            $newUser->password = Hash::make($request->password);
            $newUser->own_code = Str::random(8);
            $newUser->save();
            
        } else {
            return view('auth.affiliater')->with('errors' , $errors);
        }
            
    }
    
    
    
    
    
    
    
    
    
    
    
}
