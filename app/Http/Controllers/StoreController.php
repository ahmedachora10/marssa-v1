<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Store;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function check_7th_days($store_id) {
        $store = Store::wherer('disable_time','!=','Null')->findOrFail($store_id);
        // if store has reached max indebneses
        $store->update(['status'=>0]);
        return true;
    }
    public function index()
    {
        $stores = Store::where('domain', '<>', env('MainDomain'))->get();
        $title_page = 'stores';
        return view('dashboard.stores', ['title_page' => $title_page, 'stores' => $stores]);
    }

    public function reset_password_participants(Request $request,$participant_id){
       
      $new_password = $this->generateRandomString(8);//bcrypt();
      User::where('id',$participant_id)->update(['password'=>bcrypt($new_password)]);
      $name    = DB::table('users')->where('id',$participant_id)->pluck('name')->toArray();
    //  dd($name);
     // return back()->with(['new_password'=>$new_password,'name'=> $name[0] ?? '' ]);
        $title_page = 'Stores' ;
        return view('dashboard.stores_new_password', ['title_page' => $title_page, 'new_password'=>$new_password,'name'=> $name[0] ?? '' ]);
    }

    function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@$#%&';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function add_target(){
       $Context = [
          'title_page' => 'Target',
       ];
       return view('dashboard.target')->with($Context);
    }
    
    function getStoresInd(){
        $stores=Store::where('indebtedness','>','19999')->orWhere('indebtedness','>',0)->paginate(10);
        
        $title_page = 'indebtedness';
        return view('dashboard.indebtedness',['stores'=>$stores,'title_page'=>$title_page]);
    }
    function updateIndView($id) {
        return view('dashboard.update_store')->with(['store'=>store::findOrFail($id), 'title_page'=>'stores']);
    }
    
    function updateStoresInd (Request $request) {
        $request->validate([
            'indebtedness' => 'required',
            'indebtedness_percent' => 'required',
            'max_indebtedness' =>'required',
            ]);
            
        $store = store::findOrFail($request->store_id);
        $store->indebtedness = $request->indebtedness;
        $store->max_indebtedness = $request->max_indebtedness;
        $store->indebtedness_percent = $request->indebtedness_percent;
        if($request->indebtedness ==0){
            $store->status=1;
        }
        
        $store->save();
        return back()->with('success','Saved Successfully');
    }

    function re_target(Request $request){
        $store = auth()->user()->store()->first();
        if($store->target){
           $store->target()->update([
               'value' => $request->value,
           ]);
        }else{
            $store->target()->create([
               'value'   => $request->value,
            ]);
        }

        return back()->with('message','success');
    }

}
//Developed Saed Z. Sinwar
