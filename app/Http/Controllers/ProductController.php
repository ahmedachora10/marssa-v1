<?php

namespace App\Http\Controllers;

use App\Offer;
use App\PromoCode;
use App\ProductAttributes;
use App\ProductAttributesValues;
use App\ProductVariantAttribute;
use App\ProductAttrs;
use App\Category;
use Illuminate\Http\Request;
use App\Product;
use App\Product_options;
use App\Colors;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\ProductVariations;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function products_index(){
        $context = ['title_page' => 'products']; 
        return view('dashboard.products_index', $context);
    }

    public function index()
    {
        $context = ['title_page' => 'products'];
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User' or $auth_user->getRoleNames()[0] == 'SubUser') {
            $products = $auth_user->store()->first()->products()->orderBy('id', 'DESC')->get();
            $OutStock = $auth_user->store()->first()->products()->whereQuantity(0)->get()->reverse()->take(11);
        } else {
            $products = Product::orderBy('id', 'DESC')->paginate(12);
            $OutStock = Product::whereQuantity(0)->get()->reverse()->take(10);
        }
        $context['products'] = $products;
        $context['OutStock'] = $OutStock;
        $context['route'] = route('dashboard.admin.products.add');

        return view('dashboard.products', $context);
    }

    public function get_colors()
    {

        $colors = Colors::all();
        return response()->json(['data' => $colors]);

    }
    public function getValues(Request  $request){
         /*  $product=null;
           if($request->get('product_id')){
               $product=Product::find($request->product_id);
           }
           $values=ProductAttributes::whereIn('id',$request->get('attributes'))->with('values')->get() ?? null;
           $pvalues =$product->attributes ?? null;
           $type=$request->get('type');
           dd($product,$values,$pvalues,$type);
           */
       if ($request->ajax()) {
           
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
           $product=null;
           if($request->get('product_id')){
               $product=Product::find($request->product_id);
           }
           $values=ProductAttributes::where('status','=','1')->where('store_id',$store->id)->whereIn('id',$request->get('attributes'))->with('values')->orderBy('id','ASC')->get() ?? null;
           $pvalues =$product->attributes ?? null;
           $type=$request->get('type');
            return view('dashboard.attrValues', compact('values','product','pvalues','type'))->render();
        }
    }
    public function add()
    {
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

        $colors = Colors::all();

        $prod = Product::where('store_id', $store->id)->get();


        $attributes=ProductAttributes::where('store_id',$store->id)->where('status','=','1')->with(['values','store'])->orderBy('id','ASC')->get();
        $context = [
            'language' => $language,
            'title_page' => 'add_new',
            'categories' => $store->categories()->get(),
            'offer' => false,
            'promo_code' => false,
            'route' => route('dashboard.admin.products.add'),
            'colors' => $colors,
            'prod' => $prod,
            'attributes'=>$attributes,
        ];
        return view('dashboard.product_details', $context);
    }

    public function getVariants(Request $request ){  
    if ($request->ajax()) {
            $variants=ProductVariations::where('name',$request->name)->get();
            return view('store.components.attributesVals', compact('variants'))->render();
        }
    }
    public function product_add(Request $request)
    {
        $data = $request->all();
        //dd($request);
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $prods = Product::where('store_id', $store->id)->count();
        if ($store->plan_id == 1) {
            if ($prods >= 100) {
                return back()->with('error', 'You must choose a new plan for your store');
            }
        }
        if ($store->plan_id == 2) {
            if ($prods >= 500) {
                return back()->with('error', 'You must choose a new plan for your store');
            }
        }
        if ($store->plan_id == 3) {
            if ($prods >= 500) {
                return back()->with('error', 'You must choose a new plan for your store');
            }
        }
        $validator = Validator::make($data, [
            'price' => ['nullable', 'numeric'],
            'prices'=>['nullable','array'],
            'ids'=>['nullable','array'],
            'display_types'=>['nullable','array'],
            'quantity' => ['required', 'integer'],
            'category' => ['nullable', 'string', 'exists:categories,id'],
            'new_category_ar' => ['nullable', 'string'],
            'new_category_en' => ['nullable', 'string'],
            'image' => ['nullable', 'array'],
            'image.*' => ['file', 'max:9048' ,'mimes:jpg,jpeg,png,gif,mp4,webp,avif,heic,miaf,hevc,heif,avci,avif'],
            'featured_image' => ['nullable'],
            'featured_image' => ['file', 'max:9048' ,'mimes:jpg,jpeg,png,gif,mp4,webp,avif,heic,miaf,hevc,heif,avci,avif'],
            //'negotiation' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }

        $product = new Product();
        if (array_key_exists("name_ar", $data)) $product['name_ar'] = $data['name_ar'];
        if (array_key_exists("name_en", $data)) $product['name_en'] = $data['name_en'];
        if (array_key_exists("name_fr", $data)) $product['name_fr'] = $data['name_fr'];
        if (array_key_exists("content_ar", $data)) $product['content_ar'] = $data['content_ar'];
        if (array_key_exists("content_en", $data)) $product['content_en'] = $data['content_en'];
        if (array_key_exists("content_fr", $data)) $product['content_fr'] = $data['content_fr'];
          $product['price'] = $data['price'] ?? 0;
            $product['price_before'] = $data['price_before'] ?? 0; 
        if($request->has('variant') && $request->variant=='single'){
           
        }
        else{
        }
        $product['status'] = $data['status'] ?? false;
        $product['type'] = $data['variant'] ?? 'single';
        $product['status1'] = $data['status1'] ?? false;
        $product['quantity'] = $data['quantity'];
        $product['negotiation'] = 0; //not used


        if (!array_key_exists("category", $data)) $data['category'] = '';
        if (!array_key_exists("new_category_ar", $data)) $data['new_category_ar'] = '';
        if (!array_key_exists("new_category_en", $data)) $data['new_category_en'] = '';
        if (!array_key_exists("new_category_fr", $data)) $data['new_category_fr'] = '';


        if ($data['category'] != "") {
            $category = Category::whereId($data['category'])->first();
            $product->category()->associate($category);
        } elseif ($data['new_category_ar'] != "" || $data['new_category_en'] != "" || $data['new_category_fr'] != "") {
            $category = new Category();
            $category['name_ar'] = $data['new_category_ar'] ?? '';
            $category['name_en'] = $data['new_category_en'] ?? '';
            $category['name_fr'] = $data['new_category_fr'] ?? '';
            $category->store()->associate($auth_user->store()->first());
            $category->save();
            $product->category()->associate($category);
        }

        $product->store()->associate($auth_user->store()->first());

//        $fo = 0;
//        $fp = 0;

//        if ($data['offer_start'] or $data['offer_end'] or $data['discount_offer']) {
//            $validator = Validator::make($data, [
//                'offer_start' => ['required', 'date'],
//                'offer_end' => ['required', 'date', 'after:offer_start'],
//                'discount_offer' => ['required', 'numeric', 'lt:price'],
//            ]);
//            if ($validator->fails()) {
//                return redirect()->back()->withInput($data)->withErrors($validator->errors());
//            }
//            $offer = new Offer();
//            $offer['start'] = date('Y/m/d', strtotime($data['offer_start']));
//            $offer['end'] = date('Y/m/d', strtotime($data['offer_end']));
//            $offer['discount'] = $data['discount_offer'];
//            $offer->store()->associate($auth_user->store()->first());
//            $fo = 1;
//        }
//
//        if ($data['code'] or $data['promo_code_start'] or $data['promo_code_end'] or $data['discount_promo']) {
//            $validator = Validator::make($data, [
//                'code' => ['required', 'string', 'unique:promo_codes,code'],
//                'promo_code_start' => ['required', 'date'],
//                'promo_code_end' => ['required', 'date', 'after:promo_code_start'],
//                'discount_promo' => ['required', 'numeric', 'lt:price'],
//            ]);
//            if ($validator->fails()) {
//                return redirect()->back()->withInput($data)->withErrors($validator->errors());
//            }
//            $promo_code = new PromoCode();
//            $promo_code['start'] = date('Y/m/d', strtotime($data['promo_code_start']));
//            $promo_code['end'] = date('Y/m/d', strtotime($data['promo_code_end']));
//            $promo_code['discount'] = $data['discount_promo'];
//            $promo_code['code'] = $data['code'];
//            $promo_code->store()->associate($auth_user->store()->first());
//            $fp = 1;
//        }
        $product->save();

        $variations=[];
        //dd($request->ids);
        /*if($request->has('ids') && !empty($request->ids))
        {
            foreach($request->ids as $r=>$id){
                $value=ProductAttributesValues::where('value',$request->values[$r])->get()->first();
                $vari=(object)[
                    'product_id'            =>  $product->id,
                    'price'                 =>  $request->prices[$r],
                    'attribute_id'          =>  $request->ids[$r],
                    'display_type'          =>  $request->display_types[$r],   
                    'attribute_value_id'    =>  $value->id,
                    ];
                    array_push($variations,$vari);
                $variant=ProductVariations::create([
                    'product_id'            =>  $product->id,
                    'price'                 =>  $request->prices[$r],
                    'attribute_id'          =>  $request->ids[$r],
                    'display_type'          =>  $request->display_types[$r],   
                    'attribute_value_id'    =>  $value->id,
                    ]);
            }
        }*/
        if($request->has('names') && $request->has('attributes') && $request->has('values')  && $request->has('prices') ){
            foreach($request->get('names') as $index=>$name){
                $variant=ProductVariations::create([
                    'product_id'        =>      $product->id,
                    'name'              =>  $name,
                    'sku'             =>  $request->get('sku')[$index],
                    'price'             =>  $request->get('prices')[$index]
            ]);
       foreach($request->get('attributes') as $ind=>$attr){
            $attribute=ProductAttributes::find($attr);
            $vals=ProductAttributesValues::select('value')->where('attribute_id',$attribute->id)->get();
           
            $attrValue=[];
             foreach($request->get('values') as $val){
            $vals=ProductAttributesValues::where('value',$val)->where('attribute_id',$attribute->id)->get();
             foreach($vals as $val1){
                  if($vals && $val1->value==$val){
                        array_push($attrValue,$val);
                  }
             }
            }  
        if($attrValue){
            if(ProductVariantAttribute::where('attribute_id',$attribute->id)->where('product_variant_id',$variant->id)->count()==0){
                $variantAttr=ProductVariantAttribute::create([
                    'product_variant_id'        =>      $variant->id,
                    'value'             =>  json_encode($attrValue,true),
                    'attribute_id'             =>  $attribute->id 
                ]);
            }  
        Log::info($attribute->id. ' - '.$product->id. ' -'.json_encode($request->get('display_type'))[$ind].' _ '.json_encode($request->get('display_type')));
        if(ProductAttrs::
        where('attribute_id',$attribute->id)->
        where('product_id',$product->id)->count()==0){
            $attrs=ProductAttrs::create([
                'product_id'        =>  $product->id,
                'attribute_id'      =>  $attribute->id,
                'vals'              =>  json_encode($attrValue,true),
                'display_type'      =>  array_reverse( $request->get('display_type'))[$ind]
            ]);
          //  dd($attrs,json_encode($attrValue,true) );
        }   
            
        }
        } 
        }
        }
       // dd($product);
        $image = $request->file('image');
        if ($image != "") {
            $imgNames = [];
            foreach ($image as $img) {
                $new_name = 'product_' . $data['id'] . time() . Str::random(5) . '.' . $img->getClientOriginalExtension();
                $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/product');
                $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/product/' . $new_name;
                $img->move($fullPath, $new_name);
                $imgNames[] = $fullPathWithFile;
            }
            $product->update(['image' => $imgNames]);
        }
        if ($request->has('document') && count($request->document) > 0) {
                  $product->update([
                        'image' => $request->document,
                    ]);
            }
        if($request->file('featured_image')){
        $featured_image = $request->file('featured_image');
        if ($featured_image != "") {
                $new_name = 'product_' . $data['id'] . time() . Str::random(5) . '.' . $featured_image->getClientOriginalExtension();
                $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/product');
                $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/product/' . $new_name;
                $featured_image->move($fullPath, $new_name);
                $imgName = $fullPathWithFile;
            $product->update(['featured_image' => $imgName]);
        }
        }
        else{
            if(!empty($product->image[0])){
                $product->update(['featured_image'=>$product->image[0]]);
            }
        }
        return redirect()->route('dashboard.admin.products.index');


    }

    public function product_delete($id)
    {
        $auth_user = auth()->user();
        $product = $auth_user->store()->first()->products()->whereId($id)->first();

        if (!$product) {
            return back()->with('error', 'The Request Failed To Execute');
        }
        if (isset($product['image'])) {
            foreach ($product['image'] as $img) {
                $last = last(explode('.', $img));
                if (in_array($last, ["jpg", "png", "gif"])) {
                    $getimg[] = $img;
                    @unlink($img);
                }
            }
        }

        $product->delete();
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
        //return back()->with('success', 'Successfully');
    }

    public function product_option_delete($id)
    {
        $product_option = Product_options::whereId($id)->first();
        if (!$product_option) {
            return back()->with('error', 'The Request Failed To Execute');
        }
        $product_option->delete();
        return back();
    }

    public function product_edit($id)
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $colors = Colors::all();
        if ($store->language == 0){
            $language = ['ar'];
        }
        elseif ($store->language == 1){
            $language = ['en'];
        }
        elseif ($store->language == 3){
            $language = ['fr'];
        }
        else{
            $language = ['ar', 'en', 'fr'];
        }
        $product = $auth_user->store()->first()->products()->whereId($id)->first();
        $attrs=ProductAttrs::where('product_id',$product->id)->with('attribute')->get();
        $product['attributes']=$attrs;
        if ($product) {
            $title_page = 'product_edit';
            $route = route('dashboard.admin.products.update', ['id' => $id]);
            $imgData = [];
            foreach ($product->image ?? [] as $img) {
                $gettype = last(explode('.', $img));
                if ($gettype == 'mp4') {
                    $imgData[] = '<video class="kv-preview-data file-preview-video" controls="" style="width: 213px; height: 160px;">
  <source src="' . url($img) . '" type="video/mp4">
</video>';
                } else {
                    $imgData[] = '<img class="file-preview-image kv-preview-data" src="' . url($img) . '">';
                }
            }

            $product_option = Product_options::where('product_id', $id)->get();

            $prod = Product::where('store_id', $store->id)->get();
        $attributes=ProductAttributes::where('status','=','1')->where('store_id', $store->id)->with(['values','store'])->orderBy('id','ASC')->get();
            $context = [
                'language' => $language,
                'title_page' => $title_page,
                'categories' => $store->categories()->get(),
                'product' => $product,
                'offer' => $product->getCureentOffer() ?? false,
                'promo_code' => $product->getCureentPromoCode() ?? false,
                'route' => $route,
                'imgData' => $imgData,
                'product_option' => $product_option,
                'colors' => $colors,
                'prod' => $prod,
                'attributes'=>$attributes
            ];
            return view('dashboard.product_details', $context);
        }
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
        //return redirect()->back()->with('success', 'Successfully');
    }
    public function product_featured_image(Request $request){
         $product = auth()->user()->store()->first()->products()->whereId($request->id)->first();
        $product->update(['featured_image'=>$request->featured_image]);
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
    }
    public function product_remove_image(Request $request){
         $product = auth()->user()->store()->first()->products()->whereId($request->id)->first();
         $imgNames=[];
            foreach ($product->image ?? [] as $img) {
                if($img !=$request->featured_image){
                    @unlink($img);
                }
            }
            $product->update(['featured_image' => $request->featured_image]);
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
    }
    public function saveFile(Request $request){
        $auth_user = auth()->user();
        if ($request->file('file')) {
            $file = $request->file('file');
            $new_name = 'product_' .  time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/product');
            $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/product/' . $new_name;
            $file->move($fullPath, $new_name);
        return response()->json([
            'name' => $fullPathWithFile,
            'original_name' => $file->getClientOriginalName(),
            
        ]);
        }
    }
    public function product_update(Request $request)
    {
        $data = $request->all();
        $auth_user = auth()->user();
        $validator = Validator::make($data, [
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'integer'],
            'category' => ['nullable', 'string', 'exists:categories,id'],
            'new_category_ar' => ['nullable', 'string'],
            'new_category_en' => ['nullable', 'string'],
            'image' => ['nullable', 'array'],
            'image.*' => ['file', 'max:2048' ,'mimes:jpg,jpeg,png,gif,mp4,webp,avif,heic,miaf,hevc,heif,avci,avif'],
            'featured_image' => ['nullable'],
            'featured_image' => ['file', 'max:9048' ,'mimes:jpg,jpeg,png,gif,mp4,webp,avif,heic,miaf,hevc,heif,avci,avif'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $product = $auth_user->store()->first()->products()->whereId($data['id'])->first();

        if (array_key_exists("name_ar", $data)) $product->update(['name_ar' => $data['name_ar']]);
        if (array_key_exists("name_en", $data)) $product->update(['name_en' => $data['name_en']]);
        if (array_key_exists("name_fr", $data)) $product->update(['name_fr' => $data['name_fr']]);
        if (array_key_exists("content_ar", $data)) $product->update(['content_ar' => $data['content_ar']]);
        if (array_key_exists("content_en", $data)) $product->update(['content_en' => $data['content_en']]);
        if (array_key_exists("content_fr", $data)) $product->update(['content_fr' => $data['content_fr']]);
        if (!array_key_exists("category", $data)) $data['category'] = '';
        if (!array_key_exists("new_category_ar", $data)) $data['new_category_ar'] = '';
        if (!array_key_exists("new_category_en", $data)) $data['new_category_en'] = '';
        if (!array_key_exists("new_category_fr", $data)) $data['new_category_fr'] = '';


        $update_category_id = null;
        if ($data['category'] != "") {
            $category = Category::whereId($data['category'])->first();
            $update_category_id = $category->id;
        } elseif ($data['new_category_ar'] != "" || $data['new_category_en'] != "" || $data['new_category_fr'] != "") {
            $category = new Category();
            $category['name_ar'] = $data['new_category_ar'] ?? '';
            $category['name_en'] = $data['new_category_en'] ?? '';
            $category['name_fr'] = $data['new_category_fr'] ?? '';
            $category->store()->associate($auth_user->store()->first());
            $category->save();
            $update_category_id = $category->id;
        }

        $product->update([
            'type'  =>  $data['variant'],
            'price' => $data['price'],
            'price_before' => $data['price_before'],
            'status' => $data['status'] ?? false,
            'status1' => $data['status1'] ?? false,
            'quantity' => $data['quantity'],
            //'negotiation' => $data['negotiation'],
            'category_id' => $update_category_id,

        ]);
        if($request->has('names') && $request->has('attributes') && $request->has('values')  && $request->has('prices') ){
            
            foreach($request->get('names') as $index=>$name){
                 $pvars=ProductVariations::where('product_id','=',$product->id)->get();
               
            foreach($pvars as $index1=>$pvar){
                if(!in_array($pvar->name,$request->get('names'))){
                  //dd($pvar->name,$request->get('names'));
                    
                    $pvar->delete();
                }
            }
                $vari=ProductVariations::where('name' ,'=',$name)->where('product_id',$product->id)->get()->first();
                if(!$vari){
                    $vari=ProductVariations::create([
                        'product_id'        =>      $product->id,
                        'name'              =>  $name,
                        'sku'             =>  $request->get('sku')[$index],
                        'price'             =>  $request->get('prices')[$index]
                    ]);
                }
                else{
                    $vari->update([
                        'sku'             =>  $request->get('sku')[$index],
                        'price'             =>  $request->get('prices')[$index]
                        ]);
                }
                foreach($request->get('attributes') as $ind=>$attr){
                    $attribute=ProductAttributes::find($attr);
                    $vals=ProductAttributesValues::select('value')->where('attribute_id',$attribute->id)->get();
                    $attrValue=[];
                    foreach($request->get('values') as $val){
                        $vals=ProductAttributesValues::where('value',$val)->where('attribute_id',$attribute->id)->get();
                        foreach($vals as $val1){
                          if($vals && $val1->value==$val){
                                array_push($attrValue,$val);
                          }
                        }
                    }  
                if($attrValue){
                        $pvattr=ProductVariantAttribute::where('attribute_id',$attribute->id)->where('product_variant_id',$vari->id)->get()->first();
                        if(!$pvattr){
                            $variantAttr=ProductVariantAttribute::create([
                                'product_variant_id'        =>      $vari->id,
                                'value'             =>  json_encode($attrValue,true),
                                'attribute_id'             =>  $attribute->id 
                            ]);
                        }  
                        else{
                            //dd($pvattr);
                            $pvattr->update([
                                'product_variant_id'        =>      $vari->id,
                                'value'             =>  json_encode($attrValue,true),
                                'attribute_id'             =>  $attribute->id 
                                ]);
                        }
                        Log::info($attribute->id. ' - '.$product->id. ' -'.json_encode($request->get('display_type'))[$ind].' _ '.json_encode($request->get('display_type')));
                        $pattr=ProductAttrs::
                        where('attribute_id',$attribute->id)->
                        where('product_id',$product->id)->get()->first();
                        if(!$pattr){
                            $attrs=ProductAttrs::create([
                                'product_id'        =>  $product->id,
                                'attribute_id'      =>  $attribute->id,
                                'vals'              =>  json_encode($attrValue,true),
                                'display_type'      =>  array_reverse( $request->get('display_type'))[$ind]
                            ]);
                        }   
                        else{
                           // dd($pattr, array_reverse( $request->get('display_type'))[$ind]);
                            $pattr->update([
                                'vals'              =>  json_encode($attrValue,true),
                                'display_type'      =>   $request->get('display_type')[$ind]
                                ]);
                        }
            
        }
                } 
                
            }
        
        }
        //dd($product);
    
        $image = $request->file('image');
        if ($image != "") {
            $imgNames = [];
            foreach ($image as $img) {
                $new_name = 'product_' . $data['id'] . time() . Str::random(5) . '.' . $img->getClientOriginalExtension();
                $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/product');
                $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/product/' . $new_name;
                $img->move($fullPath, $new_name);
                $imgNames[] = $fullPathWithFile;
            }
            
            foreach ($product->image ?? [] as $img) {
                array_push($imgNames,$img);
            }
            $product->update(['image' => $imgNames]);
        }
if ($request->has('document') && count($request->document) > 0) {
    
            $imgNames = [];
            foreach ($request->document ?? [] as $img) {
                $imgNames[] = $img;
            }
            foreach ($product->image ?? [] as $img) {
                array_push($imgNames,$img);
            }
                  $product->update([
                        'image' => $imgNames,
                    ]);
            }
        if($request->file('featured_image')){
        $featured_image = $request->file('featured_image');
        if ($featured_image != "") {
                $new_name = 'product_' . $data['id'] . time() . Str::random(5) . '.' . $featured_image->getClientOriginalExtension();
                $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/product');
                $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/product/' . $new_name;
                $featured_image->move($fullPath, $new_name);
                $imgName = $fullPathWithFile;
                @unlink($product->featured_image);
            $product->update(['featured_image' => $imgName]);
        }
        }

        return redirect(route('dashboard.admin.products.index'));
    }
}
//Developed Saed Z. Sinwar
