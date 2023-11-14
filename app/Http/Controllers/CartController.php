<?php

namespace App\Http\Controllers;

use App\Client;
use App\CustomDomain;
use App\Order;
use App\OrderPayment;
use App\Payment;
use App\Product;
use App\PromoCode;
use App\Store;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use App\AbandonedOrder;
use App\Events\OrderPlaced;
class CartController extends Controller
{
//  Important

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

    public function returnSuccess($store = null)
    {
        if (\Session::has('promo_discount')) {
            if (Cart::total() + (\Session::get('promo_discount')) < 1) {
                \Session::remove('promo_discount');
                \Session::remove('promo_code');
            }
        }
        $json = [
            'status' => 'success',
            'count' => Cart::count(),
            'subTotal' => Cart::subtotal() . ' ' . $store->getCurrency(),
            'Tax' => Cart::tax() . ' ' . $store->getCurrency(),
            'Total' => Cart::total() . ' ' . $store->getCurrency(),
            'Promo' => Cart::getCost('promo') . ' ' . $store->getCurrency(),
            'shipping' => Cart::getCost(\Gloudemans\Shoppingcart\Cart::COST_SHIPPING) . ' ' . $store->getCurrency(),
            'item' => Cart::content()
        ];
        return response()->json($json);
    }

    public function returnError($store = null)
    {
        if (\Session::has('promo_discount')) {
            if (\Session::get('promo_discount') >= Cart::total()) {
                \Session::remove('promo_discount');
                \Session::remove('promo_code');
            }
        }
        return response()->json([
            'status' => 'faild',
            'count' => Cart::count(),
            'subTotal' => Cart::subtotal() . ' ' . $store->getCurrency(),
            'Tax' => Cart::tax() . ' ' . $store->getCurrency(),
            'Total' => Cart::total() . ' ' . $store->getCurrency(),
            'Promo' => Cart::getCost('promo') . ' ' . $store->getCurrency(),
            'shipping' => Cart::getCost(\Gloudemans\Shoppingcart\Cart::COST_SHIPPING) . ' ' . $store->getCurrency(),
            'item' => Cart::content()
        ]);
    }

    public function ShippingAndDiscount($store)
    {
        if (!is_null($store->shipping)) {
            Cart::addCost(\Gloudemans\Shoppingcart\Cart::COST_SHIPPING, $store->shipping);
        }

        if (\Session::has('promo_discount')) {
            Cart::addCost('promo', \Session::get('promo_discount'));
        }
    }

    static function getAmount($currency, $amount = '')
    {
        $pair = $currency;
        if ($currency !== 'USD') {
//            $api = Http::get('https://www.freeforexapi.com/api/live?pairs='.$pair);
            $api = Http::get('http://api.currencylayer.com/live?access_key=' . env('CURRENCYLAYER') . '&currencies=' . $pair . '&format=1');
            $data = $api->json();
            if ($data['success']) {
                $amount = str_replace(',', '', $amount);
                return round(((int)$amount / $data['quotes']['USD' . $currency]), 2);
            }
        }
        return $amount;
    }

//  ///////////////////////////////////////////////
//  Shoping Cart

    public function index(Request $request, $domain = '')
    {

        $store = $this->Store($request, $domain);
        $this->ShippingAndDiscount($store);
        LandingStore::create_log('/', $store);
        $information = $store->information()->first();
        $products = $store->products()->where('status', '<>', '0');
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
            'count_products' => ceil(count($products->get()) / $page),
            'products' => $products->paginate($page),
            'categories' => $store->categories()->get(),
            'offers' => $store->offers()->get()->shuffle()->take(5),
            'details' => 'index',
            'ads' => false,
            'css_style' => $store->css_style,
            'empty' => (Cart::count() == 0) ? 'disabled' : ''
        ];
        $design = $store->design ? $store->design : 2;

        return view('Store.cart_' . $design, $context);
    }
    public function new_cart(Request $request, $domain = '')
    {
        $store = $this->Store($request, $domain);
        $this->ShippingAndDiscount($store);
        LandingStore::create_log('/', $store);
        $information = $store->information()->first();
        $products = $store->products()->where('status', '<>', '0');
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
            'count_products' => ceil(count($products->get()) / $page),
            'products' => $products->paginate($page),
            'categories' => $store->categories()->get(),
            'offers' => $store->offers()->get()->shuffle()->take(5),
            'details' => 'index',
            'ads' => false,
            'css_style' => $store->css_style,
            'empty' => (Cart::count() == 0) ? 'disabled' : ''
        ];
        $design = $store->design ? $store->design : 2;

        return view('Store.new_cart', $context);
    
        }
    public function Add(Request $request, $domain = '')
    {
        $validation = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        $store = $this->Store($request, $domain);
        $this->ShippingAndDiscount($store);
        $product = $store->products()->where('id', $request->id)->firstOrFail();
        $price =0;
        if(!empty($request->variant) && !empty($request->variant_id)){
            $vari=\App\ProductVariations::select('price')->find($request->variant_id) ;
            $price = (int)($vari->price ?? $product->get_current_offer()->discount  );
        }
        else{
            $price = (int)($product->price ?? $product->get_current_offer()->discount  );
        }
        
        $variant= $request->variant;
        $variant_id= $request->variant_id;
        if ($validation->fails()) {
            return $this->returnError();
        } else {
            //$qua=$request->qua;
            if ($request->qua == null) {
                $qua = 1;
            } else {

                $qua = $request->qua;
            }
            $cart = Cart::add([
                'id' => $request->id,
                'name' => $product['name_' . app()->getLocale()] ,
                'qty' => $qua,
                'price' => $price,
                'options' => [
                    'delete_url' => $store->EgMakeRoute('cart_delete'),
                    'update_url' => $store->EgMakeRoute('cart_update'),
                    'image' => $product->firstImage(),
                    'variant'=>$variant ?? 'single',
                    'variant_id'=>$variant_id ?? 0,
                ]
            ]);
            return $this->returnSuccess($store);
        }
    }

    public function add_offer(Request $request, $domain = '')
    {
        $store = $this->Store($request, $domain);
        $pro = Product::find($request->pro_id);

        $order = Order::where('order_id', $request->order_id)->first();
        //$main=Payment::find($order->payment->id);
        $main = $order->payment;
        // dd($order,$main);

        //dd($order,$main);

        $order_payment_data = [
            'status' => (boolean)true,
            'cart' => [
                'currency' => $store->getCurrency(),
                'subtotal' => $order->amount + $pro->price,
                'tax' => (int)0,
                'shipping' => $order->payment->data->cart->shipping,
                'promo_code' => $order->payment->data->cart->promo_code,
                'total' => $order->amount + $pro->price + $order->payment->data->cart->shipping,
            ],
            'note' => null,
            //'img'=> $image,
            'transaction_number' => @$order->payment->data->transaction_number,
        ];
        $order_payment_data['type'] = $order->payment->data->type;

        $main->data = $order_payment_data;
        $main->save();

        $new = new Order();
        $new->order_id = $request->order_id;
        $new->amount = $pro->price;
        $new->discount = 0;
        $new->quantity = 1;
        $new->currency = $store->getCurrency();
        $new->status = 0;
        $new->client_id = $order->client_id;
        $new->store_id = $order->store_id;
        $new->product_id = $pro->id;
        $new->order_payments_id = $order->order_payments_id;
        $new->save();
        if($store->plan->is_commission == 1) {
            $cartTotal = $new->payment->data->cart->total - $new->payment->data->cart->shipping;
            $marssa_comission = ($cartTotal) * ( $store->indebtedness_percent / 100);
            $store->indebtedness += $marssa_comission;
            
            $store->save();
        }
        return redirect(url('/thank_you?orderId=' . $request->order_id));

    }

    public function Remove(Request $request, $domain = '')
    {
        $validation = Validator::make($request->all(), [
            'rowId' => 'required',
        ]);
        $store = $this->Store($request, $domain);
        $this->ShippingAndDiscount($store);
        if ($validation->fails()) {
            return $this->returnError($store);
        } else {
            Cart::remove($request->rowId);
            return $this->returnSuccess($store);
        }
    }

    public function Update(Request $request, $domain = '')
    {
        $validation = Validator::make($request->all(), [
            'rowId' => 'required',
            'qty' => 'required',
        ]);
        $store = $this->Store($request, $domain);
        $this->ShippingAndDiscount($store);
        if ($validation->fails()) {
            return $this->returnError($store);
        } else {
            Cart::update($request->rowId, $request->qty);
            return $this->returnSuccess($store);
        }
    }

//  ///////////////////////////////////////////////
//  Promo

    public function ApplyPromo(Request $request, $domain = '')
    {
        $validation = Validator::make($request->all(), [
            'promo_code' => 'required'
        ]);
        $store = $this->Store($request, $domain);
        if ($validation->fails()) {
            return $this->returnError($store);
        } else {
            $this->ShippingAndDiscount($store);
            if ($this->CheckPromoCode($request->promo_code, $store->id)) {
                return $this->returnSuccess($store);
            } else {
                return $this->returnError($store);
            }
        }
    }

    public function RemovePromo(Request $request, $domain = '')
    {

        $store = $this->Store($request, $domain);
        if (\Session::has('promo_discount')) {
            \Session::remove('promo_discount');
            \Session::remove('promo_code');
            $this->ShippingAndDiscount($store);
            return $this->returnSuccess($store);
        }
        return $this->returnError($store);
    }

    public function CheckPromoCode($coupon, $storeId)
    {
        $promo = PromoCode::where([
            'code' => $coupon,
            'status' => 1,
            'store_id' => $storeId
        ])->where('end', '>', now())->where('start', '<=', now())->first();

        if (($promo->count != null) && ($promo->count <= $promo->count_used)) {
            return false;
        }


        if ($promo) {
            if (Cart::total() > $promo->discount) {
                if ($promo->type_discount == 0) { // calculate with value
                    $discount = -(int)$promo->discount;
                } elseif ($promo->type_discount == 1) { // calculate with percent
                    $discount = -(Cart::subtotal() * (int)$promo->discount) / 100;
                }

                Cart::addCost('promo', $discount);
                \Session::put('promo_discount', $discount);
                \Session::put('promo_code', $coupon);
                \Session::put('promo_code_id' . $storeId, $promo->id);
                return $discount;
            }
        } else {
            return false;
        }
        return false;
    }

//  ///////////////////////////////////////////////
//  CheckOut

    public function checkout(Request $request, $domain = '')
    {
        if($request->has('items')):
            Cart::destroy();
            Cart::add($request->query('items'));
        endif;
        
        if (Cart::count() == 0) {
            //Alert::error(__('master.Fail'));
            toast(__('master.Fail'), 'error');
            return redirect(url('/'));
        }
        $store = $this->Store($request, $domain);
        
        if($store->indebtedness >= $store->plan->max_indebtedness && $store->disable_time !=null &&   date("Y/m/d H:i:s", strtotime($store->disable_time )) >= date(now()))
        {
            $store->update(['status'=>0]);
        }
        $this->ShippingAndDiscount($store);
        LandingStore::create_log('/', $store);
        $information = $store->information()->first();
        $products = $store->products()->where('status', '<>', '0');
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
            'empty' => (Cart::count() == 0) ? 'disabled' : '',
            'number' => Cart::count(),
            'information' => $information,
            'count_products' => ceil(count($products->get()) / $page),
            'products' => $products->paginate($page),
            'categories' => $store->categories()->get(),
            'offers' => $store->offers()->get()->shuffle()->take(5),
            'details' => 'index',
            'ads' => false,
            'css_style' => $store->css_style
        ];
        $design = $store->design ? $store->design : 2;


        return view('Store.checkout_' . $design, $context);
    }

    public function final_checkout(Request $request, $domain = '')
    {

        if (Cart::count() == 0) {
            toast(__('master.Fail'), 'error');
            //Alert::error(__('master.Fail'));
            return redirect(url('/'));
        }
        $store = $this->Store($request, $domain);
        $this->ShippingAndDiscount($store);
        LandingStore::create_log('/', $store);
        $information = $store->information()->first();
        $products = $store->products()->where('status', '<>', '0');
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
            'count_products' => ceil(count($products->get()) / $page),
            'products' => $products->paginate($page),
            'categories' => $store->categories()->get(),
            'offers' => $store->offers()->get()->shuffle()->take(5),
            'details' => 'index',
            'ads' => false,
            'css_style' => $store->css_style,
            'number' => Cart::count()
        ];
        $design = $store->design ? $store->design : 2;

        foreach (\Gloudemans\Shoppingcart\Facades\Cart::content() as $car) {

            $pro = Product::find($car->id);

            // dd(\Gloudemans\Shoppingcart\Facades\Cart::content());

            if ($pro->upsell_statue == 'on' && !empty($pro->upsell)) {

                $getimg = ['dashboard/light/assets/images/sativa.png'];
                if (isset($pro->upsell->prod['image'])) {
                    foreach ($pro->upsell->prod['image'] as $img) {
                        $last = last(explode('.', $img));
                        if (in_array($last, ["jpg", "png", "gif"])) {
                            $getimg[] = $img;
                        }
                    }
                }

                $product = Product::find($pro->upsell->product_id);
                $product_image = $product_image->image;
                return view('Store.upsell.upsell_' . $design, $context, compact('pro', 'getimg', 'product_image'));
            }


        }

        return view('Store.checkout_' . $design, $context);

    }

//  ///////////////////////////////////////////////
//  make_order
    public function make_order(Request $request, $domain = '', $id = '')
    {
        
        $request->validate([
            
                'name' => 'required',
                'mobile' => 'required',
                'address' => 'nullable',
                
            ]);
        $orders_count=Order::groupBy('order_id')->where('ip_address',$request->ip())->count();
        $orders_count1=Order::groupBy('order_id')->where('ip_address',$request->ip())->get();
        \Log::info($orders_count);
        \Log::info($orders_count1);
        if($orders_count1->count() >= 5){
            session()->flash('errors', __('master.max_orders_count'));
            return redirect()->route('checkout');
        }
        if (empty($id) and !empty($domain)) {
            $id = $domain;
            $domain = ($domain) ?? '';
        }
        $store = $this->Store($request, $domain);
        //  if($store->plan->is_commission == 1) {
             
        //         $cartTotal = (double)Cart::total();
        //         $marssa_comission = ($cartTotal * $store->plan->commission_precent) / 100;
                
        //         $store->indebtedness = $store->indebtedness + $marssa_comission;
                
        //         $store->save();
                
        //     }

        LandingStore::create_log('product/order/' . $id, $store);
        $this->ShippingAndDiscount($store);
        $int = rand(132330, 1033330);
        $request->request->add(['transaction_number' => $int]);
        $data = $request->validate([
            'email' => ['nullable', 'sometimes', 'string', 'email', 'max:255'],
            'name' => ['sometimes', 'string', 'max:255'],
            'more_details' => ['sometimes', 'string'],
            'address' => ['sometimes', 'sometimes', 'string','nullable'],
            'mobile' => ['required', 'string', 'min:8'],
            'transaction_number' => ['required', 'numeric'],
            'img' => ['sometimes', 'required', 'file'],
            'method' => [
                'required',
                Rule::in([
                    'Paiement_when_receiving',
                    'Bank_transfer',
                    'Bankily',
                    'paypal'
                ]),
            ]
        ], [
            'in' => __('master.Fail')
        ]);
       
        $cartItem = Cart::content();
        $order_id = Str::random(10);
        $image = $request->file('img');
        if ($image) {
            $new_name = Str::random(10) . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('stores_assets/' . $store->domain . '/orders'), $new_name);
            $image = 'stores_assets/' . $store->domain . '/orders/' . $new_name;
        }
        $order_payment_data = [
            'status' => (boolean)true,
            'cart' => [
                'currency' => $store->getCurrency(),
                'subtotal' => (int)Cart::subtotal(),
                'tax' => (int)0,
                'shipping' => (int)Cart::getCost(\Gloudemans\Shoppingcart\Cart::COST_SHIPPING),
                'promo_code' => [
                    'status' => (Cart::getCost('promo') == "0.00") ? false : true,
                    'discount' => (int)Cart::getCost('promo'),
                    'code' => (Session::has('promo_code')) ? Session::get('promo_code') : false
                ],
                'total' => (int)Cart::total()
            ],
            'note' => ($data['more_details']) ?? null,
            'img' => $image,
            'transaction_number' => ($data['transaction_number']) ?? null,
        ];
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

        $order_payment = new OrderPayment();
        $order_payment->status = 0;
        $order_payment->data = $order_payment_data;
        $order_payment->type = $order_payment_type;
        $order_payment->save();

        if (!empty($request->branch_id)) {
            $order_payment->branch()->associate($request->branch_id)->save();
        }

        foreach ($cartItem as $item) {
            $product = $store->products()->whereId($item->id)->where('status', '<>', '0')->first();
            if (!$product) {
                return route('store.index', ['sub_domain' => $store->domain]);
            }
            $variant=$item->options['variant'];
            $variant_id=$item->options['variant_id'];
            $price =0 ;
            if(!empty($variant_id)){
                $price =\App\ProductVariations::select('price')->find($variant_id) ->price;
            }
            else{
                $price = $product->price;
            }
            $offer = $product->offers()->whereStatus(1)->where('end', '>', now())->where('start', '<=', now())->first();
            $quantity = (int)abs($item->qty ?? 1);
            $order = new Order();
            $discount = 0;
            if ($offer) {
                $discount += (($price - $offer->discount) * $quantity);
                $price = $offer->discount;
                $order->offer()->associate($offer);
            }
            $client = Client::updateOrCreate([
                'mobile' => $data['mobile'],
                'store_id' => $store->id
            ], [
                'mobile' => $data['mobile'],
                'name' => ($data['name']) ?? '',
                'email' => ($data['email']) ?? '',
                'address' => ($data['address']) ?? '',

            ]);

            if ($price < 0) $price = 0;
            $order['amount'] = $price * $quantity;
            $order['quantity'] = $quantity;
            $order['discount'] = $discount;
            $order['currency'] = $store->getCurrency();
            $order['order_id'] = $order_id;
            $order['variant_id']=$variant_id;
            $order['variant']=$variant;
            $order->client()->associate($client);
            $order->store()->associate($store);
            $order->product()->associate($product);
            $order->payment()->associate($order_payment);
            $order->ip_address=$request->ip();
            $order->save();
            if ($order) {
                $promo_code_id = \Session::get('promo_code_id' . $store->id);
                $promo_count_update = PromoCode::where('id', $promo_code_id)->increment('count_used');
            }
        }

        $store = $this->Store($request, $domain);

        $this->ShippingAndDiscount($store);
        LandingStore::create_log('/', $store);
        $information = $store->information()->first();
        $products = $store->products()->where('status', '<>', '0');
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
            'count_products' => ceil(count($products->get()) / $page),
            'products' => $products->paginate($page),
            'categories' => $store->categories()->get(),
            'offers' => $store->offers()->get()->shuffle()->take(5),
            'details' => 'index',
            'ads' => false,
            'css_style' => $store->css_style,
            'number' => Cart::count()
        ];
        $design = $store->design ? $store->design : 2;
        foreach (\Gloudemans\Shoppingcart\Facades\Cart::content() as $car) {

            $pro = Product::find($car->id);

            // dd($pro);
            if (!empty($pro->upsell)) {
                // dd($pro->upsell);
                $getimg = ['dashboard/light/assets/images/sativa.png'];
                if (isset($pro->upsell->prod['image'])) {
                    foreach ($pro->upsell->prod['image'] as $img) {
                        $last = last(explode('.', $img));
                        if (in_array($last, ["jpg", "png", "gif"])) {
                            $getimg[] = $img;
                        }
                    }
                }
                $order_id = $order->order_id;
                Cart::destroy();
                $disable_header = true;
                return view('Store.upsell.upsell_' . $design, $context, compact('pro', 'getimg', 'order_id', 'disable_header'));
            }


        }
        Cart::destroy();
        $request->session()->forget('request_data');
        if (\Session::has('promo_discount')) {
            \Session::remove('promo_discount');
            \Session::remove('promo_code');
        }
        //Wael
        //if store signed with comission plan
        
        if($store->plan->is_commission == 1) {
            $cartTotal = $order->payment->data->cart->total - $order->payment->data->cart->shipping;
            $marssa_comission = ($cartTotal) * ( $store->indebtedness_percent / 100);
           // if($request->mobile != $store->information->phone ){//&& 
            //Str::contains($store->user->mobile, $request->mobile)){
            $store->indebtedness += $marssa_comission;
            if($store->indebtedness >= $store->plan->max_indebtedness && $store->disable_time ==null)
            {
                $ctime = "+10 days";
                $store->disable_time=date("Y/m/d H:i:s", strtotime(now() . $ctime));
            }//}
            $store->save();
        }
        if($request->has('abandoned_order') && !empty($request->input('abandoned_order'))){
            $abandoned_order = AbandonedOrder::find($request->input('abandoned_order'));
            event(new OrderPlaced($abandoned_order));    
        }
            
        //EndWael
        return redirect(url('/thank_you?orderId=' . $order_id));
    }

    public function thank_you(Request $request, $domain = '')
    {
        // dd('dd');
        $data = Validator::make($request->all(), [
            'orderId' => 'required'
        ]);
        if ($data->fails()) {
            return redirect(url('/'));
        }
        $store = $this->Store($request, $domain);
        $order = Order::with(['product'])->whereOrderId($request->orderId)->get();
        if ($order->isEmpty()) {
            return redirect(url('/'));
        }
        $this->ShippingAndDiscount($store);
        LandingStore::create_log('/', $store);
        $information = $store->information()->first();
        $products = $store->products()->where('status', '<>', '0');
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
        $id = $order->first();
        $pro = Product::where('store_id', $store->id)->where('id', '!=', $id->product_id)->take(4)->get();
        $context = [
            'store' => $store,
            'pages' => $store->pages()->get(),
            'head_data' => $head_data,
            'information' => $information,
            'count_products' => ceil(count($products->get()) / $page),
            'products' => $products->paginate($page),
            'categories' => $store->categories()->get(),
            'offers' => $store->offers()->get()->shuffle()->take(5),
            'details' => 'index',
            'orders' => $order,
            'pro' => $pro,
            'ads' => false,
            'css_style' => $store->css_style,
            'empty' => (Cart::count() == 0) ? 'disabled' : ''
        ];
        $design = $store->design ? $store->design : 2;
        return view('Store.thank_you_' . $design, $context);
    }
}
