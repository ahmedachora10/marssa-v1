<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductAttributes;
use App\ProductAttributesValues;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductAttributesValuesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
         $auth_user = auth()->user();   
        $store=$auth_user->store()->first();
        $attrs=ProductAttributes::where('store_id',$store->id)->select('id')->get();
        $attributes_values=ProductAttributesValues::whereIn('attribute_id',$attrs)->latest()->orderBy('id','DESC')->get();

        $context = ['title_page' => 'Products Attributes Values',
        'attributes_values'=> $attributes_values,'store'=>$store];
        return view('dashboard.products_attributes_values', $context);
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

        $attributes=ProductAttributes::where('store_id',$store->id)->latest()->orderBy('id','DESC')->get();
        $context = ['title_page' => 'Add New Attributes','store'=>$store,'language'=>$language,'attributes'=>$attributes]; 
        return view('dashboard.products_attributes_values_create', $context);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'value' => ['required', 'string'],
            'attribute_id' => ['required', 'string','exists:product_attributes,id']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        $offer=ProductAttributesValues::create([
              'value'=>$request->value,
              'attribute_id'=>$request->attribute_id
              ]);
        return redirect()->route('dashboard.admin.products.attributes.values.index');
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
        $attributes_values=ProductAttributesValues::find($id);
        
        $attributes=ProductAttributes::where('store_id',$store->id)->latest()->orderBy('id','DESC')->get();
        if(!$attributes_values){
            $context = ['title_page' => 'Products Attributes','store'=>$store,'language'=>$language,'message'=>__('master.not_found')]; 
            return redirect()->route('dashboard.admin.products.attributes.values.index',['context'=>$context]);
        }
        $context = ['title_page' => 'Edit Products Attribute Value','store'=>$store,'language'=>$language,'attributes'=>$attributes,'value'=>$attributes_values]; 
        return view('dashboard.products_attributes_values_edit', $context);
    }
    public function update(Request $request,$id){     
        $attribute=ProductAttributesValues::find($id);
        if(!$attribute){
            $context = ['title_page' => 'Products Attributes','store'=>$store,'language'=>$language,'message'=>__('master.not_found')]; 
            return redirect()->route('dashboard.admin.products.attributes.values.index',['context'=>$context]);
        }
        $validator = Validator::make($request->all(), [
            'attribute_id' => ['required', 'string','exists:product_attributes,id'],
            'value' => ['required', 'string'],  
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
          $attribute->update([
              'attribute_id'=>$request->attribute_id,
              'value'=>$request->value,
          ]);
        return redirect()->route('dashboard.admin.products.attributes.values.index');
    }
   
}
