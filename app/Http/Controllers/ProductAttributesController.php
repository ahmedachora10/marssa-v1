<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductAttributes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductAttributesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
         $auth_user = auth()->user();   
        $store=$auth_user->store()->first();
        $attributes=ProductAttributes::where('store_id',$store->id)->latest()->orderBy('id','DESC')->get();

        $context = ['title_page' => 'Products Attributes',
        'attributes'=> $attributes,'store'=>$store];
        return view('dashboard.products_attributes', $context);
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

        $context = ['title_page' => 'Add New Attributes','store'=>$store,'language'=>$language]; 
        return view('dashboard.products_attributes_create', $context);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],  
            'description_fr' => ['nullable', 'string'],            
            'name_ar' => ['nullable', 'string','max:255'],
            'name_en' => ['nullable', 'string','max:255'],
            'name_fr' => ['nullable', 'string','max:255'],
            'status'=>['nullable'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
          $offer=ProductAttributes::create([
              'name_ar'=>$request->name_ar,
              'name_en'=>$request->name_en,
              'name_fr'=>$request->name_fr,
              'description_ar'=>$request->description_ar,
              'description_en'=>$request->description_en,
              'description_fr'=>$request->description_fr,
              'page_num'=>$request->page_num,
              'delivery_text'=>$request->delivery_text,
              'status'=>$request->status ?? false,
              'created_by'=>auth()->user()->id,
              'store_id'=>auth()->user()->store_id
              ]);
        return redirect()->route('dashboard.admin.products.attributes.index');
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
        $attribute=ProductAttributes::where('store_id',$store->id)->find($id);
        if(!$attribute){
            $context = ['title_page' => 'Products Attributes','store'=>$store,'language'=>$language,'message'=>__('master.not_found')]; 
            return redirect()->route('dashboard.admin.products.attributes.index',['context'=>$context]);
        }
        $context = ['title_page' => 'Edit Products Attribute','store'=>$store,'language'=>$language,'attribute'=>$attribute]; 
        return view('dashboard.products_attributes_edit', $context);
    }
    public function update(Request $request,$id){     
        $attribute=ProductAttributes::find($id);
        if(!$attribute){
            $context = ['title_page' => 'Products Attributes','store'=>$store,'language'=>$language,'message'=>__('master.not_found')]; 
            return redirect()->route('dashboard.admin.products.attributes.index',['context'=>$context]);
        }
        $validator = Validator::make($request->all(), [
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],  
            'description_fr' => ['nullable', 'string'],            
            'name_ar' => ['nullable', 'string','max:255'],
            'name_en' => ['nullable', 'string','max:255'],
            'name_fr' => ['nullable', 'string','max:255'],
            'status'=>['nullable'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
          $attribute->update([
              'name_ar'=>$request->name_ar,
              'name_en'=>$request->name_en,
              'name_fr'=>$request->name_fr,
              'description_ar'=>$request->description_ar,
              'description_en'=>$request->description_en,
              'description_fr'=>$request->description_fr,
              'page_num'=>$request->page_num,
              'delivery_text'=>$request->delivery_text,
              'status'=>$request->status ?? false,
              'updated_by'=>auth()->user()->id,
              ]);
        return redirect()->route('dashboard.admin.products.attributes.index');
    }
    public function changeStatus($id){     
        $attribute=ProductAttributes::find($id);
        if(!$attribute){
            $context = ['title_page' => 'Products Attributes','store'=>$store,'language'=>$language,'message'=>__('master.not_found')]; 
            return redirect()->route('dashboard.admin.products.attributes.index',['context'=>$context]);
        }
        if (!$attribute) {
            session()->flash('errors', __('master.Not Found'));
            return redirect()->route('dashboard.admin.products.attributes.index');
        }
        if ($attribute->status == 1) {
            $attribute->update(['status' => 0]);
 
            session()->flash('success', __('master.Disable Success'));
        } elseif ($attribute->status == 0) {
            $attribute->update(['status' => 1]);
            
            session()->flash('success', __('master.Enable Success'));
        }
        return redirect()->route('dashboard.admin.products.attributes.index');
    }
   
}
