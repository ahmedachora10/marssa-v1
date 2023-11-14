<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order;
use App\Category;
use App\Models;
use App\Page;
use App\Product;
use App\ProductReview;
use App\Store;
use App\Slider;
use App\CustomDomain;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use IP2LocationLaravel;
use Jenssegers\Agent\Agent;
use App\Visitors;
use App\Product_options;
use App\Colors;
use App\ProductVariations;

class LandingStore extends Controller
{
    public function getVariants(Request $request ){
    //   if ($request->ajax()) {
           $product=null;
            $variants=ProductVariations::where('product_id',$request->product_id)->where(function($query) use($request){
                $query->where('name',$request->name)->orWhere('name',$request->name1);
            })->get()->take(1);
            $product=Product::find($request->product_id);
            $currency=Store::find($product->store_id)->getCurrency();
            return view('Store.components.attributesVals', compact('variants','product','currency'))->render();
    //   }
           // return response()->json(['variants'=>$variants,'product'=>$product,'currency'=>$currency]);

    }
    public function index(Request $request, $domain = '')
    {
        if (empty($domain)) {
            $host = parse_url($request->url())['host'];
            $host = preg_replace('/^www\./', '', $host);
            if (strpos($host, env('MAIN_DOMAIN')) === false) {
                $custom = CustomDomain::whereCustom($host)->whereStatus(true)->first();
                if ($custom) {
                    $store = $custom->store()->first();
                    $domain = $store->domain;
                }
            }
        }
        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
        $this->create_log('/', $store);

        if($store->indebtedness >= $store->plan->max_indebtedness && $store->disable_time !=null &&   date("Y/m/d H:i:s", strtotime($store->disable_time )) >= date(now()))
        {
            $store->update(['status'=>0]);
        }
        $design = $store->design ? $store->design : 2;
        $information = $store->information()->first();
        $products = $store->products()->where('status', '<>', '0');
        if($design == 5) {
             $recent_pro = $store->products()->where('status', '<>', '0')->OrderBy('created_at','desc')->get();
        } else {
           $recent_pro = $store->products()->where('status', '<>', '0')->OrderBy('created_at','desc')->take('8')->get();
        }

        $order_id=$store->orders()->select('product_id')->get();
        $bestseller=Product::whereIn('id',$order_id)->where('status', '<>', '0')->take(10)->get();
        //dd($bestseller);
        $head_data = [
            'title_ar' => $information['title_page_ar'],
            'title_en' => $information['title_page_en'],
            'title_fr' => $information['title_page_fr'],
            'description_ar' => $information['description_ar'],
            'description_en' => $information['description_en'],
            'description_fr' => $information['description_fr'],
            'keyword_ar' => $information['keyword_ar'],
            'keyword_en' => $information['keyword_en'],
            'keyword_fr' => $information['keyword_fr'],
            'icon' => $information['preview'],
        ];
        $page = 9;
        $slider = Slider::where('store_id',$store->id)->get();

        // dd($head_data);

        $context = [
            'store' => $store,
            'bestseller' => $bestseller,
            'recent_pro' => $recent_pro,
            'slider'=>$slider,
            'pages' => $store->pages()->get(),
            'head_data' => $head_data,
            'information' => $information,
            'count_products' => ceil(count($products->get()) / $page),
            //'products' => $products->get(),
            'categories' => $store->categories()->where('status',1)->get(),
            'offers' => $store->offers()->get()->shuffle()->take(5),
            'details' => 'index',
            'ads' => false,
            'css_style'=>$store->css_style,
            'empty' => (Cart::count() == 0) ? 'disabled' : '',
            'number' => Cart::count()
        ];

        dd($design, $context);

        //1
        //dd($recent_pro);
        return view('Store.index_'.$design, $context);
    }

    public function product_details(Request $request, $domain = '', $id = '')
    {
        if (empty($id) and !empty($domain)) {
            $id = $domain;
            $domain = '';
        }
        if (empty($domain)) {
            $host = parse_url($request->url())['host'];
            $host = preg_replace('/^www\./', '', $host);
            if (strpos($host, env('MAIN_DOMAIN')) === false) {
                $custom = CustomDomain::whereCustom($host)->whereStatus(true)->first();
                if ($custom) {
                    $store = $custom->store()->first();
                    $domain = $store->domain;
                }
            }
        }
        $ads = false;
        $url = 'product/details/' . $id;
        if ($this->endsWith($request->fullUrl(), 'product/details/' . $id . '/ads')) {
            $ads = true;
            $url = 'product/details/' . $id . '/ads';
        }
        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
        if($store->indebtedness >= $store->plan->max_indebtedness && $store->disable_time !=null &&   date("Y/m/d H:i:s", strtotime($store->disable_time )) >= date(now()))
        {
            $store->update(['status'=>0]);
        }
        $this->create_log($url, $store);
        $information = $store->information()->first();
        $products = $store->products()->where('status', '<>', '0')->get();

        $product = $store->products()->whereId($id)->where('status', '<>', '0')->first();
        if (!$product) {
            return redirect(route('store.index', ['sub_domain' => $store->domain]));
        }

        $product->offers()->where('end', '<=', now())->update(['status' => false]);
        $product->promo_codes()->where('end', '<=', now())->update(['status' => false]);

        $offer = $product->offers()->whereStatus(1)->where('end', '>', now())->where('start', '<=', now())->first();
        $getimg = ['dashboard/light/assets/images/sativa.png'];
        if (isset($product['image'])) {
            foreach ($product['image'] as $img) {
                $last = last(explode('.',$img));
                if (in_array($last,["jpg", "png", "gif"])) {
                    $getimg[] = $img;
                }
            }
        }
        $head_data = [
            'title_ar' => $product->name_ar,
            'title_en' => $product->name_en,
            'title_fr' => $product->name_fr,
            'description_ar' => $information['description_ar'],
            'description_en' => $information['description_ar'],
            'description_fr' => $information['description_fr'],
            'keyword_ar' => $information['keyword_ar'],
            'keyword_en' => $information['keyword_en'],
            'keyword_fr' => $information['keyword_fr'],
            'icon' => $getimg[array_rand($getimg,1)],
        ];
        $ProductReview = ProductReview::where('store_id',$store->id)->whereProductId($product->id)->whereStatus(1)->orderByDesc('id');
        $rates = $ProductReview->paginate(9);
        $rate_avg = round($ProductReview->avg('rate'),2);

        $product_options = Product_options::where('product_id',$id)->get();
        $colors    = Colors::all();


        $simlier=Product::where('status', '<>', '0')->where('id','!=',$product->id)->where(['store_id'=>$store->id,'category_id'=>$product->category_id])->where('category_id','!=',null)->take(4)->get();

        $context = [
            'store' => $store,
            'simlier' => $simlier,
            'pages' => $store->pages()->get(),
            'head_data' => $head_data,
            'empty' => (Cart::count() == 0) ? 'disabled' : '',
                'number' => Cart::count(),
            'information' => $information,
            'products' => $products->where('id', '<>', $id)->shuffle()->take(8),
            'product' => $product,
            'offer' => $offer,
            'categories' => $store->categories()->where('status',1)->get(),
            'offers' => $store->offers()->get()->shuffle()->take(5),
            'details' => 'details',
            'ads' => $ads,
            'css_style'=>$store->css_style,
            'rate_avg'=>($rate_avg) ?? 0,
            'rates'=>$rates,
            'product_options' => $product_options,
            'colors'          => $colors,
        ];

         $design = $store->design ? $store->design : 2;
        return view('Store.details_' . $design, $context);
    }

    public function show_category(Request $request, $domain = '', $category_id = '')
    {

        if (empty($category_id) and !empty($domain)) {
            $category_id = $domain;
            $domain = '';
        }
        if (empty($domain)) {
            $host = parse_url($request->url())['host'];
            $host = preg_replace('/^www\./', '', $host);
            if (strpos($host, env('MAIN_DOMAIN')) === false) {
                $custom = CustomDomain::whereCustom($host)->whereStatus(true)->first();
                if ($custom) {
                    $store = $custom->store()->first();
                    $domain = $store->domain;
                }
            }
        }
        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
        if($category_id == 'all') {
             $category = Category::first();
        if ($category) {
            $information = $store->information()->first();
            $head_data = [
                'title_ar' => 'جميع المنتجات',
                'title_en' => 'All Products',
                'title_fr' => 'tous les produits',
                'description_ar' => 'جميع المنتجات',
                'description_en' => 'All Products',
                'description_fr' => 'tous les produits',
                'keyword_ar' => 'جميع المنتجات',
                'keyword_en' => 'All Products',
                'keyword_fr' => 'tous les produits',
                'icon' => 'stores_assets/site/preview.png',
            ];

            $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
            $url = 'category/all';
            $products = \App\Product::where(['store_id'=>$store->id , 'status' => 1 ])->get();
             $page = 9;
            // return $products;
            $this->create_log($url, $store);
            $context = [
                'store' => $store,
                'pages' => $store->pages()->get(),
                'head_data' => $head_data,
                'information' => $information,
                'count_products' => ceil(count($products) / $page),
                'products' => $products,
                'categories' => $store->categories()->where('status',1)->get(),
                'offers' => $store->offers()->get()->shuffle()->take(5),
                'details' => 'index',
                'ads' => false,
                'css_style'=>$store->css_style,
                'empty' => (Cart::count() == 0) ? 'disabled' : '',
                'number' => Cart::count()
            ];


            $design = $store->design ? $store->design : 2;
            return view('Store.index_' . $design, $context);
        } else {
            return redirect(route('store.index', ['sub_domain' => $store->domain]));
        }
        } else {
             $category = Category::whereId($category_id)->first();
        if ($category) {
            $information = $store->information()->first();
            $head_data = [
                'title_ar' => $category['name_ar'],
                'title_en' => $category['name_en'],
                'title_fr' => $category['name_fr'],
                'description_ar' => $information['description_ar'],
                'description_en' => $information['description_en'],
                'description_fr' => $information['description_fr'],
                'keyword_ar' => $information['keyword_ar'],
                'keyword_en' => $information['keyword_en'],
                'keyword_fr' => $information['keyword_fr'],
                'icon' => $information['preview'],
            ];

            $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
            $url = 'category/' . $category_id;
            $products = $category->products()->where('status', '<>', '0');
            $page = 9;
            $this->create_log($url, $store);
            $context = [
                'store' => $store,
                'pages' => $store->pages()->get(),
                'head_data' => $head_data,
                'empty' => (Cart::count() == 0) ? 'disabled' : '',
                'number' => Cart::count(),
                'information' => $information,
                'count_products' => ceil(count($products->get()) / $page),
                'products' => $products->paginate($page),
                'categories' => $store->categories()->where('status',1)->get(),
                'offers' => $store->offers()->get()->shuffle()->take(5),
                'details' => 'index',
                'ads' => false,
                'css_style'=>$store->css_style
            ];
            $design = $store->design ? $store->design : 2;
            return view('Store.index_' . $design, $context);
        } else {
            return redirect(route('store.index', ['sub_domain' => $store->domain]));
        }
        }

    }

    public function show_page(Request $request, $domain = '', $show_page = '')
    {

        if (empty($show_page) and !empty($domain)) {
            $show_page = $domain;
            $domain = '';
        }
        if (empty($domain)) {
            $host = parse_url($request->url())['host'];
            $host = preg_replace('/^www\./', '', $host);
            if (strpos($host, env('MAIN_DOMAIN')) === false) {
                $custom = CustomDomain::whereCustom($host)->whereStatus(true)->first();
                if ($custom) {
                    $store = $custom->store()->first();
                    $domain = $store->domain;
                }
            }
        }
        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
        $page = Page::whereLink($show_page)->first();
        if ($page) {
            $information = $store->information()->first();
            $head_data = [
                'title_ar' => $page['title_ar'],
                'title_en' => $page['title_en'],
                'title_fr' => $page['title_fr'],
                'description_ar' => $page['description_ar'],
                'description_en' => $page['description_en'],
                'description_fr' => $page['description_fr'],
                'keyword_ar' => $information['keyword_ar'],
                'keyword_en' => $information['keyword_en'],
                'keyword_fr' => $information['keyword_fr'],
                'icon' => $information['preview'],
            ];
            $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
            $url = 'show/' . $show_page;

            $this->create_log($url, $store);
            $context = [
                'store' => $store,
                'pages' => $store->pages()->get(),
                'page' => $page,
                'head_data' => $head_data,
                'information' => $information,
                'details' => 'index',
                'ads' => false,
                'css_style'=>$store->css_style,
                'categories' => $store->categories()->where('status',1)->get(),
            'empty' => (Cart::count() == 0) ? 'disabled' : '',
            'number' => Cart::count()
            ];
            $design = $store->design ? $store->design : 2;
            return view('Store.page_' . $design, $context);
        } else {
            return redirect(route('store.index', ['sub_domain' => $store->domain]));
        }
    }


    public function product_order(Request $request, $domain = '', $id = '')
    {
        if (empty($id) and !empty($domain)) {
            $id = $domain;
            $domain = '';
        }
        if (empty($domain)) {
            $host = parse_url($request->url())['host'];
            $host = preg_replace('/^www\./', '', $host);
            if (strpos($host, env('MAIN_DOMAIN')) === false) {
                $custom = CustomDomain::whereCustom($host)->whereStatus(true)->first();
                if ($custom) {
                    $store = $custom->store()->first();
                    $domain = $store->domain;
                }
            }
        }
        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();

        $this->create_log('product/order/' . $id, $store);
        $data = $request->all();

        $validator = Validator::make($data, [
            'quantity' => ['nullable', 'string'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'mobile' => ['required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $product = $store->products()->whereId($id)->where('status', '<>', '0')->first();

        if (!$product) {
            return route('store.index', ['sub_domain' => $store->domain]);
        }
        $offer = $product->offers()->whereStatus(1)->where('end', '>', now())->where('start', '<=', now())->first();

        if ($data['promo_code']) {
            $promo_code = $product->promo_codes()->whereStatus(1)->whereCode($data['promo_code'])->where('end', '>', now())->where('start', '<=', now())->first();
        } else {
            $promo_code = false;
        }
        $price = $product->price;
        $quantity = (int)abs($data['quantity'] ?? 1);
        $order = new Order();
        $discount = 0;
        if ($offer) {
            $discount += (($price - $offer->discount) * $quantity);
            $price = $offer->discount;
            $order->offer()->associate($offer);
        }
        if ($promo_code) {
            $discount += $promo_code->discount;
            $price -= $promo_code->discount;
            $order->promo_code()->associate($promo_code);
        }

        $client = new Client();
        $client->name = $data['name'];
        $client->email = $data['email'];
        $client->address = $data['address'];
        $client->mobile = $data['mobile'];
        $client->store()->associate($store);
        $client->save();

        if ($price < 0) $price = 0;
        $order['amount'] = $price * $quantity;
        $order['quantity'] = $quantity;
        $order['discount'] = $discount;
        $order['currency'] = $store->getCurrency();
        $order['order_id'] = Str::random(10);
        $order->client()->associate($client);
        $order->store()->associate($store);
        $order->product()->associate($product);

        if ($order->save()) {
            $context = [
                'result' => 'Successfully',
                'product_name' => $product['name_' . app()->getLocale()],
                'order_quantity' => $quantity,
                'order_discount' => $discount . ' ' . $store->getCurrency(),
                'order_amount' => $price * $quantity . ' ' . $store->getCurrency(),
                'product_price' => $product->price . ' ' . $store->getCurrency(),
                'discount_offers' => $offer ? $offer->discount . ' ' . $store->getCurrency() : '0 ' . $store->getCurrency(),
                'discount_coupons' => $promo_code ? $promo_code->discount . ' ' . $store->getCurrency() : '0 ' . $store->getCurrency(),
            ];
        } else {
            $context = [
                'result' => 'Fail',
            ];
        }
        return response()->json($context);
    }

    static function create_log($url, $store)
    {
        $ips = \Request::ip();
        $position = IP2LocationLaravel::get($ips);
        $agent = new Agent();

        $device = $agent->device();
        if ($device == "Bot") {
            return;
        }
        $robot = $agent->robot();
        if (!$robot) {
            $platform = $agent->platform();
            $browser = $agent->browser();
            $browser_version = $agent->version($browser);
            $platform_version = $agent->version($platform);
            $ipAddress = $position['ipAddress'];
            $ipNumber = $position['ipNumber'];
            $ipVersion = $position['ipVersion'];
            $latitude = $position['latitude'];
            $longitude = $position['longitude'];
            $countryName = $position['countryName'];
            $countryCode = $position['countryCode'];
            $timeZone = $position['timeZone'];
            $zipCode = $position['zipCode'];
            $cityName = $position['cityName'];
            $regionName = $position['regionName'];
            $data = new Visitors;
            $data['url'] = $url;
            $data['device'] = $device;
            $data['platform'] = $platform;
            $data['browser'] = $browser;
            $data['robot'] = $robot;
            $data['browser_version'] = $browser_version;
            $data['platform_version'] = $platform_version;
            $data['ipAddress'] = $ipAddress;
            $data['ipNumber'] = $ipNumber;
            $data['latitude'] = $latitude;
            $data['longitude'] = $longitude;
            $data['ipVersion'] = $ipVersion;
            $data['countryName'] = $countryName;
            $data['countryCode'] = $countryCode;
            $data['timeZone'] = $timeZone;
            $data['zipCode'] = $zipCode;
            $data['cityName'] = $cityName;
            $data['regionName'] = $regionName;

            $data->store()->associate($store);
            $data->save();
        }
    }

    function endsWith($str, $lastString)
    {
        $count = strlen($lastString);
        if ($count == 0) {
            return true;
        }
        return (substr($str, -$count) === $lastString);
    }

    public function submit_review(Request $request, $domain = '',$product_id ='')
    {

        if (empty($domain)) {
            $host = parse_url($request->url())['host'];
            $host = preg_replace('/^www\./', '', $host);
            if (strpos($host, env('MAIN_DOMAIN')) === false) {
                $custom = CustomDomain::whereCustom($host)->whereStatus(true)->first();
                if ($custom) {
                    $store = $custom->store()->first();
                    $domain = $store->domain;
                }
            }
        }
        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();

        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), [
            'rate'=>'required|in:0,1,2,3,4,5',
            'full_name'=>'required|string',
            'phone'=>'sometimes',
            'email'=>'sometimes',
            'content'=>'required'
        ]);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }else{
            $ProductReview = ProductReview::create([
                'store_id' => $store->id,
                'product_id' => $product_id,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'content' => $request->content,
                'rate' => $request->rate,
            ]);
            $response['response'] = __('master.review has been submitted successfully , we will review it and publish it soon');
            $response['success'] = true;
        }
        return $response;
    }

    public function get_product_option($product_id,$color_id){

       $product_options = Product_options::where('product_id',$product_id)
                                         ->where('color_id',$color_id)
                                         ->get();

        return response()->json(['data' => $product_options]);

    }



}