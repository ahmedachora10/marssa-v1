<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


use App\User;
use App\Plan;
use DB;
use App\Order;
use App\Product;
use App\Store;
use App\Slider;
use App\Counter;
use App\Contact;
use App\Client;
use App\Payment;
use App\CustomDomain;
use Carbon\Carbon;


    

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function slider(Request $request)
    {
        $auth_user = auth()->user();
        $context = ['title_page' => 'slider'];
        $store = $auth_user->store()->first();
        $slider = \App\Slider::where('store_id',$store->id)->get();
         // var_dump($slider); 
        $context['slider'] = $slider; 
        return view('dashboard.slider.slider', $context);
    }
    public function add(Request $request)
    {
        $auth_user = auth()->user();
        $context = ['title_page' => 'slider'];
        $store = $auth_user->store()->first();
       
        return view('dashboard.slider.add', $context);
    }
    public function edit(Request $request)
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();

        $slider =  DB::table('slider')->where('id', $request->id)->first();
        
        if(empty($slider) or $auth_user->id != $slider->user_id){
            return redirect()->route('dashboard.admin.slider.index');
        };
        $context = ['title_page' => 'slider'];
        $context['slider'] = $slider;
     
       
        return view('dashboard.slider.edit', $context);
    }
    public function update(Request $request)
    {
        $auth_user = auth()->user();
        $slider = DB::table('slider')->where('id', $request->id)->first();

        if(empty($slider) or $auth_user->id != $slider->user_id){
            return redirect()->route('dashboard.admin.slider.index');
        };

        $image = $request->file('image');
        $imgNames = $slider->image;
       if (!empty($image)) {
        
            $new_name = 'slider_' . time().Str::random(5) .'.' . $image->getClientOriginalExtension();
            $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/slider/');
            $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/slider/' . $new_name;
            $image->move($fullPath, $new_name);
            $imgNames = $fullPathWithFile;
          
        }
        $slider->link = $request->link;
        $slider->image = $imgNames;
        $slider->store_id = $auth_user->store()->first()->id;
        $slider->user_id = $auth_user->id;
        $slider->save();
        toast(__('master.Successfully'),'success');
        return redirect()->route('dashboard.admin.slider.index');
        //return redirect()->route('dashboard.admin.slider.index')->with('success', 'Successfully');;
    }

    public function delete(Request $request)
    {       
        DB::table('slider')->where('id', $request->id)->delete();
        toast(__('master.Successfully'),'success');
        return redirect()->route('dashboard.admin.slider.index');
        //return redirect()->route('dashboard.admin.slider.index')->with('success', 'Successfully');;

    }

    public function save_image(Request $request)
    {
        $slider = new Slider;
        $auth_user = auth()->user();
        $image = $request->file('image');
       if (!empty($image)) {
        
            $new_name = 'slider_' . time().Str::random(5) .'.' . $image->getClientOriginalExtension();
            $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/slider/');
            $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/slider/' . $new_name;
            $image->move($fullPath, $new_name);
            $imgNames = $fullPathWithFile;
            $slider->link = $request->link;
            $slider->image = $imgNames;
            $slider->store_id = $auth_user->store()->first()->id;
            $slider->user_id = $auth_user->id;
            $slider->save();
      
            toast(__('master.Successfully'),'success');
            return redirect()->route('dashboard.admin.slider.index');
            //return redirect()->route('dashboard.admin.slider.index')->with('success', 'Successfully');;
        }
        return back()->with('error', 'empty image');
       //echo $imgNames;
    }
    
    

    //
}
