<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Store;
use App\AbandonedOrder;
use App\OrderPayment;
use App\OrderRecord;
use App\CustomDomain;
class AbandonedOrdersController extends Controller
{
    //
    
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
    
    public function index(){
        $Context =[
            'title_page' => 'abandoned_orders',
            'orders'     => auth()->user()->store()->first()->abandoned_orders//->where('id','desc')
        ]; 
        
        return view('dashboard.abandoned_orders',$Context);
    }
    
    public function add_to_abandoned_cart(Request $request,$domain = ''){
        $store = $this->Store($request, $domain);
        $json  = [
            'count' => Cart::count(),
            'subTotal' => Cart::subtotal(),
            'Tax' => Cart::tax(),
            'Total' => Cart::total(),
            'Promo' => Cart::getCost('promo'),
            'shipping' => Cart::getCost(\Gloudemans\Shoppingcart\Cart::COST_SHIPPING),
            'item' => Cart::content()
        ];
        $cart_items = serialize($json);
        $insert_or_update = $store->abandoned_orders()->updateOrCreate(
            [
              'mobile'     => $request->input('mobile'),
            ],
            [
              'name'       => $request->input('name'),
              'address'    => $request->input('address'),
              'cart_items' => $cart_items
            ]
        );
        return response()->json($insert_or_update->id ?? null, 200);
    }
    
    public function show(AbandonedOrder $order){
        $cart = unserialize($order->cart_items);
        $Context = [
             'order' => $order,
             'cart'  => $cart,
             'items' => collect($cart['item']),
             'title_page' => 'order_details'
        ];
        return view('dashboard.abandoned_details',$Context);
    }
    public function destroy(AbandonedOrder $order){
        $order1=$order->delete();
        return redirect()->route('dashboard.admin.orders.abandoned_orders');
    }
    
    public function regenerate_cart(AbandonedOrder $order){
        $cart_items = unserialize($order->cart_items);
        $items      = [];
        foreach(collect($cart_items['item']) as $item):
            $items[] = [
                'id'      => $item->id,
                'name'  => $item->name ,'qty'     => $item->qty,
                'price' => $item->price,'options' => collect($item->options)->all()
            ];
        endforeach;
        return redirect()->route('store.checkout',['sub_domain' => $order->store->domain,'items' => $items]);
    }
}
