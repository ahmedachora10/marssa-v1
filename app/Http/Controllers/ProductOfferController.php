<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Category;
use Illuminate\Http\Request;
use App\Product;
use App\ProductOffer;
use App\ProductOfferOrder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ProductOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function orders(){
        $auth_user = auth()->user();   
        $store=$auth_user->store()->first();
        $orders=ProductOfferOrder::with('product')->where('store_id',$store->id)->latest()->get();

        $context = ['title_page' => 'Landing Pages Orders',
        'orders'=> $orders,'store'=>$store];
        return view('dashboard.newLand.orders', $context);
    }
    public function order_changeStatus(Request $request ,$id){
        $request->validate(['status'=>'string|required','notes'=>'string|nullable']);
        $order=ProductOfferOrder::find($id);
        if(!$order){
            return redirect()->route('dashboard.admin.landing_pages.orders');
        }
        $order->update(['status'=>$request->status,'notes'=>$request->notes]);
        return redirect()->route('dashboard.admin.landing_pages.orders');
    }
    public function show_order(Request $request ,$id){
        
       $auth_user = auth()->user();   
        $store=$auth_user->store()->first();
        $order=ProductOfferOrder::with('product')->where('store_id',$store->id)->find($id);
        if(!$order){
            return redirect()->route('dashboard.admin.landing_pages.orders');
        }$order->update(['viewed'=>1]);
        $context = ['title_page' => 'Landing Pages Orders',
        'order'=> $order,'store'=>$store];
        return view('dashboard.newLand.show_order', $context);
    }
    public function index(){
        $auth_user = auth()->user();   
        $store=$auth_user->store()->first();
        $offers=ProductOffer::where('store_id',$store->id)->latest()->get();

        $context = ['title_page' => 'Products Offers',
        'offers'=> $offers,'store'=>$store];
        return view('dashboard.newLand.offers', $context);
    }
    public function create(){
     
        $auth_user = auth()->user();   
        $store = $auth_user->store()->first();
         if ($store->language == 0)
            $language = ['ar'];
        elseif ($store->language == 1)
            $language = ['en'];
        elseif ($store->language == 3)
            $language = ['fr'];
        elseif ($store->language == 4) {
            $language = ['ar', 'fr'];
        } else
            $language = ['ar', 'en', 'fr'];

        $context = ['title_page' => 'Add New Offer','store'=>$store,'language'=>$language]; 
        return view('dashboard.newLand.create', $context);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'content_ar' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],  
            'content_fr' => ['nullable', 'string'],            
            'name_ar' => ['nullable', 'string','max:255'],
            'name_en' => ['nullable', 'string','max:255'],
            'name_fr' => ['nullable', 'string','max:255'],
            'delivery_text'=>['nullable','string','max:255'],
            'pay_text'=>['nullable','string','max:255'],
            'notice_text'=>['nullable','string','max:255'],
            'price' => ['required'],
            'price_notice' => ['required', 'string','max:255'],
            'btn_text'=>['nullable','string','max:255'],
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'max:9048' ,'mimes:jpg,jpeg,png,gif,mp4,webp,avif,heic,miaf,hevc,heif,avci,avif'],
            'featured_image' => ['nullable'],
            'featured_image' => ['file', 'max:9048' ,'mimes:jpg,jpeg,png,gif,mp4,webp,avif,heic,miaf,hevc,heif,avci,avif'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
          $offer=ProductOffer::create([
              'name_ar'=>$request->name_ar,
              'name_en'=>$request->name_en,
              'name_fr'=>$request->name_fr,
              'content_ar'=>$request->content_ar,
              'content_en'=>$request->content_en,
              'content_fr'=>$request->content_fr,
              'price'=>$request->price,
              'price_notice'=>$request->price_notice,
              'price1'=>$request->price1,
              'price_notice1'=>$request->price_notice1,
              'price2'=>$request->price2,
              'price_notice2'=>$request->price_notice2,
              'price3'=>$request->price3,
              'price_notice3'=>$request->price_notice3,
              'price4'=>$request->price4,
              'price_notice4'=>$request->price_notice4,
              'desc'=>$request->desc,
              'notes'=>$request->notes,
              'page_num'=>$request->page_num,
              'delivery_text'=>$request->delivery_text,
              'status'=>$request->status ?? false,
              'pay_text'=>$request->pay_text,
              'notice_text'=>$request->notice_text,
              'btn_text'=>$request->btn_text,
              'store_id'=>auth()->user()->store_id
              ]);
        $images = $request->file('images');
              if ($images != "") {
            $imgNames = [];
            foreach ($images as $img) {
                $new_name = 'offer_' . $data['id'] . time() . Str::random(5) . '.' . $img->getClientOriginalExtension();
                $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/product/landing_offers');
                $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/product/landing_offers/' . $new_name;
                $img->move($fullPath, $new_name);
                $imgNames[] = $fullPathWithFile;
            }
            $offer->update(['image' => $imgNames]);
        }
        if ($request->has('document') && count($request->document) > 0) {
                  $offer->update([
                        'image' => $request->document,
                    ]);
            }/*
        if($request->file('featured_image')){
        $featured_image = $request->file('featured_image');
        if ($featured_image != "") {
                $new_name = 'product_' . $data['id'] . time() . Str::random(5) . '.' . $featured_image->getClientOriginalExtension();
                $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/product/landing_offers/featured_images');
                $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/product/landing_offers/featured_images/' . $new_name;
                $featured_image->move($fullPath, $new_name);
                $imgName = $fullPathWithFile;
            $offer->update(['featured_image' => $imgName]);
        }
        }
        else{
            if(!empty($offer->image[0])){
                $offer->update(['featured_image'=>$offer->image[0]]);
            }
        }*/
        if( !empty($offer->image[0])){
                $offer->update(['featured_image' => $offer->image[0]]);
            }
        return redirect()->route('dashboard.admin.landing_pages.index');
    }
    
    public function saveFile(Request $request){
        $auth_user = auth()->user();
        if ($request->file('file')) {
            $file = $request->file('file');
            $new_name = 'offer_' .  time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/product/landing_offers');
            $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/product/landing_offers/' . $new_name;
            $file->move($fullPath, $new_name);
        return response()->json([
            'name' => $fullPathWithFile,
            'original_name' => $file->getClientOriginalName(),
            
        ]);
        }
    }
    public function remove_image(Request $request){
         $offer = ProductOffer::whereId($request->id)->first();
   
         $imgNames=json_decode($offer->image,true);
            foreach (json_decode($offer->image,true) ?? [] as $key =>$img) {
                if($img ==$request->image){
                    @unlink($img);
                   unset($imgNames[$key]);
                   //      dd($imgNames[$key],$img);
                }
            }
            $offer->update(['image' => $imgNames]);
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
    }
    
     public function edit($id){
     
        $auth_user = auth()->user();   
        $store = $auth_user->store()->first();
         if ($store->language == 0)
            $language = ['ar'];
        elseif ($store->language == 1)
            $language = ['en'];
        elseif ($store->language == 3)
            $language = ['fr'];
        elseif ($store->language == 4) {
            $language = ['ar', 'fr'];
        } else{
            $language = ['ar', 'en', 'fr'];
        }
        $offer=ProductOffer::find($id);
        $context = ['title_page' => 'Edit Offer','store'=>$store,'language'=>$language,'offer'=>$offer]; 
        return view('dashboard.newLand.edit', $context);
    }
    public function update(Request $request,$id){
         $offer=ProductOffer::find($id);
         $validator = Validator::make($request->all(), [
            'content_ar' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'content_fr' => ['nullable', 'string'],
            'name_ar' => ['nullable', 'string','max:255'],
            'name_en' => ['nullable', 'string','max:255'],
            'name_fr' => ['nullable', 'string','max:255'],
            'delivery_text'=>['nullable','string','max:255'],
            'pay_text'=>['nullable','string','max:255'],
            'notice_text'=>['nullable','string','max:255'],
            'price' => ['required'],
            'price_notice' => ['required', 'string'],
            'btn_text'=>['nullable','string','max:255'],
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'max:9048' ,'mimes:jpg,jpeg,png,gif,mp4,webp,avif,heic,miaf,hevc,heif,avci,avif'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
       $offer->update(
        [
              'name_ar'=>$request->name_ar,
              'name_fr'=>$request->name_fr,
              'name_en'=>$request->name_en,
              'content_ar'=>$request->content_ar,
              'content_fr'=>$request->content_fr,
              'content_en'=>$request->content_en,
              'price'=>$request->price,
              'price_notice'=>$request->price_notice,
              'price1'=>$request->price1,
              'price_notice1'=>$request->price_notice1,
              'price2'=>$request->price2,
              'price_notice2'=>$request->price_notice2,
              'price3'=>$request->price3,
              'price_notice3'=>$request->price_notice3,
              'price4'=>$request->price4,
              'price_notice4'=>$request->price_notice4,
              'desc'=>$request->desc,
              'notes'=>$request->notes,
              'page_num'=>$request->page_num,
                'status'=>$request->status ?? false,
              'delivery_text'=>$request->delivery_text,
              'pay_text'=>$request->pay_text,
              'notice_text'=>$request->notice_text,
              'btn_text'=>$request->btn_text,
              ]);
              $image = $request->file('image');
        if ($image != "") {
            $imgNames = [];
            foreach ($image as $img) {
                $new_name = 'offer_' . $data['id'] . time() . Str::random(5) . '.' . $img->getClientOriginalExtension();
                $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/product/landing_offers');
                $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/product/landing_offers/' . $new_name;
                $img->move($fullPath, $new_name);
                $imgNames[] = $fullPathWithFile;
            }
            
            foreach (json_decode($offer->image,true) ?? [] as $img) {
                array_push($imgNames,$img);
            }
            $offer->update(['image' => $imgNames]);
        }
        if ($request->has('document') && count($request->document) > 0) {
            $imgNames = [];
            foreach ($request->document ?? [] as $img) {
                $imgNames[] = $img;
            }
            foreach (json_decode($offer->image,true) ?? [] as $img) {
                array_push($imgNames,$img);
            }
                  $offer->update([
                        'image' => $imgNames,
                    ]);
            }
        if($request->file('featured_image')){
        $featured_image = $request->file('featured_image');
        if ($featured_image != "") {
                $new_name = 'product_' . $data['id'] . time() . Str::random(5) . '.' . $featured_image->getClientOriginalExtension();
                $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/product/landing_offers/featured_image');
                $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/product//landing_offers/featured_image/' . $new_name;
                $featured_image->move($fullPath, $new_name);
                $imgName = $fullPathWithFile;
                @unlink($offer->featured_image);
            $offer->update(['featured_image' => $imgName]);
        }
        }
        else
        {
            if(empty($offer->featured_image) && !empty($offer->image[0])){
                $offer->update(['featured_image' => $offer->image[0]]);
            }
        }
        return redirect()->route('dashboard.admin.landing_pages.index');
              
    }
    public function destroy($id){
        
         $offer=ProductOffer::find($id);
        $orders=ProductOfferOrder::where('product_offer_id',$offer->id)->delete();
            foreach (json_decode($offer->image,true) ?? [] as $key =>$img) {
                    @unlink($img);
           }
       $offer->delete();
        return redirect()->route('dashboard.admin.landing_pages.index');
              
    }
    public function featured_image(Request $request){
         $offer = ProductOffer::find($request->id);
        $offer->update(['featured_image'=>$request->featured_image]);
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
    }
    public function remove_featured_image(Request $request){
         $offer = ProductOffer::find($request->id);
         $imgNames=[];
            foreach (json_decode($offer->image) ?? [] as $img) {
                if($img !=$request->featured_image){
                    @unlink($img);
                }
            }
            $offer->update(['featured_image' => $request->featured_image]);
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
    }
    
}