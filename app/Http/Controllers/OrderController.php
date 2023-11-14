<?php

namespace App\Http\Controllers;


use App\Client;
use App\OrderPayment;
use App\PromoCode;
use Illuminate\Http\Request;
use App\Order;
use App\Competition;
use App\OrderRecord;
use App\Competitor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $context = ['title_page' => 'orders'];
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User') {
           // $orders = $auth_user->store()->first()->orders()->paginate(12);
            $store  = $auth_user->store()->first();
            $orders = Order::where('store_id',$store->id)->groupBy('order_id')->havingRaw('count("order_id") >= 1')->latest()->orderBy('id', 'DESC')->get();
        }elseif($auth_user->getRoleNames()[0] == 'SubUser'){
            $store  = $auth_user->store()->first();
            $orders = Order::where('store_id',$store->id)->whereHas('payment',function(Builder $query) use($auth_user){
                   $query->where('branch_id',$auth_user->branch_id);
            })->groupBy('order_id')->havingRaw('count("order_id") >= 1')->latest()->orderBy('id', 'DESC')->get();
        } else {
            $orders = Order::get();
        }
        $ords=[];
        foreach($orders as $order)
        {
             $order['order_records']=Order::where('order_id',$order->order_id)->get();
             array_push($ords,$order);
        }

        $products = $auth_user->store()->first()->products()->orderBy('id', 'DESC')->get();
        $context['orders'] = $ords;
        $context['products'] = $products;
        $context['route'] = route('store.product_order', ['sub_domain' => $auth_user->store()->first()->domain, 'id' => 0]);
        return view('dashboard.orders', $context);
    }
    
    
    public function canceledOrders($store_id)
    {

        $context = ['title_page' => 'Canceled Orders'];
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User') {
           // $orders = $auth_user->store()->first()->orders()->paginate(12);
            $store  = $auth_user->store()->first();
            $orders = Order::where('store_id',$store->id)->groupBy('order_id')->havingRaw('count("order_id") >= 1')->latest()->orderBy('id', 'DESC')->get();
        }elseif($auth_user->getRoleNames()[0] == 'SubUser'){
            $store  = $auth_user->store()->first();
            $orders = Order::where('store_id',$store->id)->whereHas('payment',function(Builder $query) use($auth_user){
                   $query->where('branch_id',$auth_user->branch_id);
            })->groupBy('order_id')->havingRaw('count("order_id") >= 1')->latest()->orderBy('id', 'DESC')->get();
        } else {
            $orders = Order::where('store_id',$store_id)->where('status',5)->get();
        }
        $ords=[];
        foreach($orders as $order)
        {
             $order['order_records']=Order::where('order_id',$order->order_id)->get();
             array_push($ords,$order);
        }

        $products = $auth_user->store()->first()->products()->orderBy('id', 'DESC')->get();
        $context['orders'] = $ords;
        $context['products'] = $products;
        $context['route'] = route('store.product_order', ['sub_domain' => $auth_user->store()->first()->domain, 'id' => 0]);
        return view('dashboard.orders', $context);
    }
    
    
    public function order_details($id)
    {

//        $json = '{"status":1,"type":"bankly","cart":{"subtotal":100,"tax":100,"shipping":100,"promo_code":[{"status":true,"discount":50,"code":"EG2"}],"total":250}}';
//        $json = [
//            'status' => 1,
//            'type'=>'bankly',
//            'cart'=>[
//                'subtotal'=>100,
//                'tax'=>100,
//                'shipping'=>100,
//                'promo_code'=>[
//                    'status'=>true,
//                    'discount'=>50,
//                    'code'=>"EG2"
//                ],
//                'total'=>250
//            ]
//        ];
//        return response()->json($json);
        $order = Order::whereId($id)->first();
        if ($order) {
            $product_ids  = $order->product()->pluck('id');
            $competitions = Competition::whereHas('competition_products',function($query) use($product_ids){
                return $query->whereIn('competition_products.product_id',$product_ids);
            })->get();
    
            $competitior_competitions = Competitor::where([
                'client_id' => $order->client->id,
                'mobile'    => $order->client->mobile
            ])->pluck('competition_id')->toArray();
            
            
            $order->update(['viewed'=>1]);
            $order_details = $order->order_records()->get()->reverse();
            $orders = Order::where('order_id',$order->order_id)->get();
            //dd($orders);
            $coupon=null;
            if(!empty($order->payment->data->cart->promo_code->code)){
                $coupon = PromoCode::whereCode($order->payment->data->cart->promo_code->code)->first();
            }
            $context = [
                'title_page' => 'order_details',
                'order' => $order,
                'orders'    => $orders,
                'coupon'    => $coupon,
                'competitions' => $competitions,
                'order_records' => $order_details,
                'competitior_competitions' => $competitior_competitions
            ];
            return view('dashboard.order_details', $context);
        }
        return redirect()->back();
    }

    public function order_update($id, Request $request)
    {
        $data = $request->all();
        $auth_user = auth()->user();
        $validator = Validator::make($data, [
            'status' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $order = $auth_user->store()->first()->orders()->whereId($id)->first();
        if (!$order or $data['status'] < $order->status) {
            return redirect(route('dashboard.admin.orders.index'));
        }
        if ($data['status'] == 1 and $order->product->quantity < $order->quantity) {
            return back()->with('message', 'not_sufficient_fulfill');
        }
        if ($data['status'] == 1 and $order->status == 1) {
            return back()->with('message', 'order_already_accepted');
        }
        if ($data['status'] == 1) {
            $order->product->decrement('quantity', $order->quantity);
        }
        if ($order->status == 0 and $data['status'] != 1 and $data['status'] != 0 and $data['status'] != 5) {
            $order->product->decrement('quantity', $order->quantity);
        }
        if ($order->status != 5 and $data['status'] == 5) {
            
            $order->product->increment('quantity', $order->quantity);
             
            $order_amount = $order->payment->data->cart->total;
            $store = $auth_user->store;
            if($order->client->mobile != $store->information->phone){// && $request->mobile != $store->user->mobile){
            $store_percent = $store->indebtedness_percent;
            }
          //  $store->indebtedness = $store->indebtedness - ( $order_amount * ($store_percent / 100) );
            $store->save();
            
        }
        $order->update([
            'status' => $data['status'],
        ]);
        Order::where('order_id',$order->order_id)->update([
            'status' => $data['status'],
        ]);

        
        
        
        if ($data['notes']) {
            $record = new OrderRecord();
            $record['notes'] = $data['notes'];
            $record['status'] = $data['status'];
            $record->order()->associate($order);
            $record->store()->associate($auth_user->store()->first());
            $record->save();
        }
        return redirect(route('dashboard.admin.orders.order_details', ['id' => $id]));
    }

}

//Developed Saed Z. Sinwar
