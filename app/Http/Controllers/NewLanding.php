<?php

namespace App\Http\Controllers;

use App\ProductOffer;
use App\ProductOfferOrder;
use App\Store;
use App\Slider;
use App\CustomDomain;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use IP2LocationLaravel;
use Jenssegers\Agent\Agent;
use App\Visitors;
class NewLanding extends Controller
{
    public function show_product(Request $request, $domain = '',$id = '')
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
        $url = 'offer/' . $id;

        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
        if(!empty($store->indebtedness) && $store->indebtedness >= $store->plan->max_indebtedness && $store->disable_time !=null &&   date("Y/m/d H:i:s", strtotime($store->disable_time )) >= date(now()))
        {
            $store->update(['status'=>0]);
        }
        LandingStore::create_log($url, $store);
        $information = $store->information()->first();
        //$products = $store->products()->where('status', '<>', '0')->get();

        $land_offer=ProductOffer::find($id);
        if (!$land_offer) {
            return redirect()->route('store.index', ['sub_domain' => $store->domain]);
        }
        $getimg = ['dashboard/light/assets/images/sativa.png'];
        if (isset($land_offer['image'])) {
            foreach (json_decode($land_offer->image,true) as $img) {
                $last = last(explode('.',$img));
                if (in_array($last,["jpg", "png", "gif"])) {
                    $getimg[] = $img;
                }
            }
        }
        $head_data = [
            'title_ar' => $land_offer->name_ar,
            'title_en' => $land_offer->name_en,
            'description_ar' => $information['description_ar'].' , '.$land_offer->name_ar,
            'description_en' => $information['description_en'].' , '.$land_offer->name_en,
            'description_fr' => $information['description_fr'].' , '.$land_offer->name_en,
            'keyword_ar' => $information['keyword_ar'].' , '.$land_offer->name_ar,
            'keyword_en' => $information['keyword_en'].' , '.$land_offer->name_en,
            'keyword_fr' => $information['keyword_fr'].' , '.$land_offer->name_en,
            'icon' => $getimg[array_rand($getimg,1)],
        ];
        
        $context = [
            'store' => $store,
            'domain'=>$domain,
            'pages' => $store->pages()->get(),
            'head_data' => $head_data,
            'information' => $information,
            'offer'=>$land_offer,
            'details' => 'details',
            'css_style'=>$store->css_style,
        ];
        return view('NewLand.index', $context);
    }
  /*  public function show_order(Request $request, $domain = '',$id = '')
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
        $url = 'order/' . $id;
        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
        if(!empty($store->indebtedness) && $store->indebtedness >= $store->plan->max_indebtedness && $store->disable_time !=null &&   date("Y/m/d H:i:s", strtotime($store->disable_time )) >= date(now()))
        {
            $store->update(['status'=>0]);
        }
        LandingStore::create_log($url, $store);
        $information = $store->information()->first();
        $order = ProductOfferOrder::whereId($id)->first();
        if (!$order) {
            return redirect()->route('store.index', ['sub_domain' => $store->domain]);
        }
            $order_details = $order->order_records()->get()->reverse();
            $orders = Order::where('order_id',$order->order_id)->get();
            //dd($orders);
            $product=ProductOfferOrder::find($order->product_id);
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
        $context = [
                'title_page' => 'order_details',
                'orders'    => $orders,
                'order_records' => $order_details,
                'product'=>$product,
            'store' => $store,
            'pages' => $store->pages()->get(),
            'details' => 'details',
            'head_data' => $head_data,

            'information' => $information,
            'order' => $order,
            'css_style'=>$store->css_style,
        ];
        return view('NewLand.order', $context);
    }
    */
    public function thank_you(Request $request, $domain = '',$id = '')
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
        $url = 'orders/thank_you/' . $id;
        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
        if(!empty($store->indebtedness) && $store->indebtedness >= $store->plan->max_indebtedness && $store->disable_time !=null &&   date("Y/m/d H:i:s", strtotime($store->disable_time )) >= date(now()))
        {
            $store->update(['status'=>0]);
        }
        LandingStore::create_log($url, $store);
        $information = $store->information()->first();
        $order = ProductOfferOrder::where('order_id',$id)->first();
        if (!$order) {
            return redirect()->route('store.index', ['sub_domain' => $store->domain]);
        }
            $offer=ProductOffer::find($order->product_offer_id);
            $getimg = ['dashboard/light/assets/images/sativa.png'];
        if (isset($offer['image'])) {
            foreach (json_decode($offer['image'],true) as $img) {
                $last = last(explode('.',$img));
                if (in_array($last,["jpg", "png", "gif"])) {
                    $getimg[] = $img;
                }
            }
        }
        $head_data = [
            'title_ar' => $offer->name_ar,
            'title_en' => $offer->name_en,
            'title_fr' => $offer->name_fr,
            'description_ar' => $information['description_ar'],
            'description_en' => $information['description_ar'],
            'description_fr' => $information['description_fr'],
            'keyword_ar' => $information['keyword_ar'],
            'keyword_en' => $information['keyword_en'],
            'keyword_fr' => $information['keyword_fr'],
            'icon' => $getimg[array_rand($getimg,1)],
        ];
        $context = [
            'title_page' => 'order_details',
            'order'    => $order,
            'offer'=>$offer,
            'store' => $store,
            'pages' => $store->pages()->get(),
            'details' => 'details',
            'head_data' => $head_data,
            'information' => $information,
            'css_style'=>$store->css_style,
        ];
        return view('NewLand.thank_you', $context);
        
    }
    //  store_order
    public function store_order(Request $request, $domain = '')
    {
        $request->validate([
                'product_offer_id' => ['required', 'exists:product_offers,id'],
                'price' => ['required', 'string'],            
                'name' => ['required', 'string'],
                'mobile' => ['required', 'string'],
                'address' => ['required', 'string'],
            ]);
        $orders_count=ProductOfferOrder::where('ip_address',$request->ip())->count();
        /*if($orders_count >= 5){
            session()->flash('errors', __('master.max_orders_count'));
            return redirect()->route('checkout');
        }*/
        if (empty($id) and !empty($domain)) {
            $id = $domain;
            $domain = ($domain) ?? '';
        }
        $store = $this->Store($request, $domain);
        LandingStore::create_log('offer/' . $id, $store);
        $int = rand(132330, 1033330);
        $request->request->add(['transaction_number' => $int]);
        $data = $request->validate([
                'product_offer_id' => ['required', 'exists:product_offers,id'],
                'price' => ['required', 'string'],     
                'name' => 'required',
                'mobile' => 'required',
                'address' => 'nullable',
                'method' => [
                'required',
                Rule::in([
                    'Paiement_when_receiving',
                    'Bank_transfer',
                    'Bankily',
                    'paypal'
                ]),
            ]
                ]);
        $order_id = Str::random(10);
        if ($data['method'] == 'Paiement_when_receiving') {
            $order_payment_data['type'] = 'Paiement_when_receiving';
            $order_payment_type = 0;
        } elseif ($data['method'] == 'Bank_transfer') {
            $order_payment_data['type'] = 'Bank_transfer';
            $order_payment_type = 3;
        } elseif ($data['method'] == 'Bankily') {
            $order_payment_data['type'] = 'Bankily';
            $order_payment_type = 1;
        } elseif($data['method'] == 'paypal') {
            $order_payment_data['type'] = 'paypal';
            $order_payment_type = 2;
        }
        else {
            $order_payment_data = [];
            $order_payment_type = 0;
        }

            $product = ProductOffer::whereId($request->product_offer_id)->where('status', '<>', '0')->first();
            if (!$product) {
                return route('store.index', ['sub_domain' => $store->domain]);
            }
            $price = $request->price;
            $order = new ProductOfferOrder();
            $order['product_offer_id'] = $product->id ;
            $order['store_id'] = $store->id ;
            $order['amount'] = $price ;
            $order['currency'] = $store->getCurrency();
            $order['order_id'] = $order_id;
            $order['name'] = $data['name'];
            $order['mobile'] = $data['mobile'];
            $order['address'] = $data['address'];
            $order['payment_method'] = json_encode(["order_payment_type"=>$order_payment_type,"order_payment_data"=>$order_payment_data],true) ;
            
            $order->ip_address=$request->ip();
            $order->save();
            

     //  dd($request);
        $store = $this->Store($request, $domain);

        //$this->ShippingAndDiscount($store);
        LandingStore::create_log('/', $store);
        $information = $store->information()->first();
        //$products = $store->products()->where('status', '<>', '0');
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
        $context = [
            'store' => $store,
            'pages' => $store->pages()->get(),
            'head_data' => $head_data,
            'information' => $information,
            'details' => 'index',
            'ads' => false,
            'css_style' => $store->css_style,
            'number' => 1
        ];
        $design = $store->design ? $store->design : 2;
        //if store signed with comission plan
        
        if($store->plan->is_commission == 1) {
          //  $cartTotal = $order->payment->data->cart->total - $order->payment->data->cart->shipping;
            $marssa_comission = ($request->price) * ( $store->indebtedness_percent / 100);
            $store->indebtedness += $marssa_comission;
            if($store->indebtedness >= $store->plan->max_indebtedness && $store->disable_time ==null)
            {
                $ctime = "+10 days";
                $store->disable_time=date("Y/m/d H:i:s", strtotime(now() . $ctime));
            }
            $store->save();
        }
            
        return redirect(url('/orders/thank_you/' . $order_id));
    }

    public function Store(Request $request, $domain = '')
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
        return Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
    }
    

    
   
    
}
