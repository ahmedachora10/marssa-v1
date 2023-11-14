<?php

namespace App\Http\Controllers;

use App\User;
use App\Plan;
use DB;
use App\Order;
use App\Product;
use App\Counter;
use App\Contact;
use App\Client;
use App\Payment;
use App\ProductOfferOrder;
use App\CustomDomain;
use Carbon\Carbon;
use \Datetime;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $auth_user = auth()->user();

        $this_month = now()->format('Y-m-1');
        $this_year = now()->format('Y-1-1');
        $today = now()->format('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 days'));
        $this_week = date('Y-m-d', strtotime('-7 days'));
        $context['subscribe_max_indebtedness'] = false;
        if ($auth_user->getRoleNames()[0] == 'User') {

            $all_time_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->get()->count();
            $this_month_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->where('created_at', '>=', $this_month)->get()->count();
            $this_year_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->where('created_at', '>=', $this_year)->get()->count();
            $this_week_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->where('created_at', '>=', $this_week)->get()->count();
            $today_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->where('created_at', '>=', $today)->get()->count();
            $yesterday_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->where('created_at', '>=', $yesterday)->get()->count();
        } elseif ($auth_user->getRoleNames()[0] == 'SubUser') {

            $all_time_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->get()->count();
            $this_month_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->where('created_at', '>=', $this_month)->get()->count();
            $this_year_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->where('created_at', '>=', $this_year)->get()->count();
            $this_week_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->where('created_at', '>=', $this_week)->get()->count();
            $today_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->where('created_at', '>=', $today)->get()->count();
            $yesterday_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->where('created_at', '>=', $yesterday)->get()->count();
        } else {

            $all_time_orders = Order::get()->count();
            $this_month_orders = Order::where('created_at', '>=', $this_month)->get()->count();
            $this_year_orders = Order::where('created_at', '>=', $this_year)->get()->count();
            $this_week_orders = Order::where('created_at', '>=', $this_week)->get()->count();
            $today_orders = Order::where('created_at', '>=', $today)->get()->count();
            $yesterday_orders = Order::where('orders.status', '!=', 5)->where('created_at', '>=', $yesterday)->get()->count();
        }
        $context = ['title_page' => 'home'];
        $all_charts = $auth_user->store()->first()->visitors()->select('id', 'created_at');
        $visitors = $all_charts->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('H');
        });
        $hourVisitors = [];
        $yearVisitors = [];
        foreach ($visitors as $key => $visitor) {
            $hourVisitors[(int)$key] = count($visitor);
        }

        $current_hour = (int)now()->format('H');
        for ($i = $current_hour + 1; $i <= 23; $i++) {
            if (!empty($hourVisitors[$i])) {
                array_push($yearVisitors, $hourVisitors[$i]);
            } else {
                array_push($yearVisitors, 0);
            }
        }
        for ($i = 0; $i <= $current_hour; $i++) {
            if (!empty($hourVisitors[$i])) {
                array_push($yearVisitors, $hourVisitors[$i]);
            } else {
                array_push($yearVisitors, 0);
            }
        }

        $context['current_hour'] = $current_hour + 1;
        $context['chart_visitors'] = json_encode($yearVisitors);
        if ($auth_user->getRoleNames()[0] == 'User' or $auth_user->getRoleNames()[0] == 'SubUser') {
            $store = $auth_user->store()->first();
            $orders = Order::where('store_id', $store->id)->groupBy('order_id')->havingRaw('count("order_id") >= 1')->where('status', '!=', '5')->get();//take(10);

            $OutStock = $store->products()->whereQuantity(0)->get()->reverse()->take(10);
            $context['orders'] = $orders ?? [];
            $context['OutStock'] = $OutStock;
            $clients = array();
            $order_clients = $store->orders()->groupBy('client_id')->select('currency', 'client_id', DB::raw('count(*) as total'))->get();//take(10);
            foreach ($order_clients as $order) {
                $orders_client = Order::where('client_id', $order->client->id)->where('store_id', $store->id);
                $item = [
                    'name' => $order->client->name,
                    'currency' => $order->currency,
                    'total_purchases' => $orders_client->sum('amount'),
                    'details' => $orders_client->first()->product()->first()['name_' . app()->getLocale()]?? '',
                ];
                array_push($clients, $item);
            }
            $context['clients'] = $clients;
            $counters = [
                'orders' => count($store->orders()->where('status', '!=', '5')->get()),
                'products' => count($store->products()->get()),
                'clients' => count($store->orders()->select('client_id', DB::raw('count(*) as total'))->groupBy('client_id')->get()),
            ];
            $context['counters'] = $counters;

            #check free subscribe
            $free = $store->subscribes()->where('plan_id', 4)->first();
            #check deadline Subscribe
            $subscribe = $store->subscribes()->whereStatus(1)->first();
            if ($subscribe) {
                $choose_package = Carbon::parse($subscribe->deadline) < now();
                $context['subscribe_deadline'] = true;
            } else {
                $choose_package = true;
            }
            if($store->plan->is_commission == 1) {
                    if($store->max_indebtedness <= $store->indebtedness) {
                       $choose_package = false;
                       $context['subscribe_max_indebtedness'] = true;
                    }
                }
            
            $context['choose_package'] = $choose_package;
            if (!$free) $context['plans'] = Plan::all(); else $context['plans'] = Plan::where('id', '<>', 4)->get();

            $context['user_plan'] = $store->plan()->first();
            $context['wallet_total'] = auth()->user()->wallet_total;
            $context['lpo_total'] = ProductOfferOrder::where('store_id',$store->id)->sum('amount');
            $context['mobile'] = $store->information()->first()->phone;
            $context['shipping'] = $store->shipping;
            $context['video_watched'] = $auth_user->video_watched;
            $context['orders'] = $orders;
            $context['id'] = $store->id;
            $context['design'] = $store->design;

            $context['all_time_orders'] = $all_time_orders;
            $context['this_year_orders'] = $this_year_orders;
            $context['this_month_orders'] = $this_month_orders;
            $context['this_week_orders'] = $this_week_orders;
            $context['yesterday_orders'] = $yesterday_orders;
            $context['today_orders'] = $today_orders;

            return view('dashboard.index', $context);
        }

        $counters = Counter::all();
        $contacts_us = Contact::all()->reverse()->take(10);
        $orders = Order::where('status', '!==', '5')->get()->reverse()->take(10);//take(10);

        $OutStock = Product::whereQuantity(0)->get()->reverse();//take(10);
        $context['counters'] = $counters;
        $context['OutStock'] = $OutStock;
        $counters = [
            'orders' => count(Order::all()),
            'products' => count(Product::all()),
            'clients' => count(Client::all()),
        ];
        $clients = array();
        $orders_clients = Order::select('client_id', DB::raw('count(*) as total'))->groupBy('client_id')->get();
        foreach ($orders_clients as $order) {
            $orders_client = Order::where('client_id', $order->client->id);
            $item = [
                'details' => $orders_client->first()->store()->first()->name,
                'name' => $order->client->name,
                'total_purchases' => $orders_client->sum('amount'),
            ];
            array_push($clients, $item);
        }
        $context['clients'] = $clients;
        $context['counters'] = $counters;
        $context['payments'] = Payment::whereStatus(0)->get();
        $context['customDomains'] = CustomDomain::whereStatus(0)->get();
        $context['contacts_us'] = $contacts_us;
        $context['orders'] = $orders;
        $context['choose_package'] = false;
        $context['plans'] = Plan::all();

        $context['all_time_orders'] = $all_time_orders;
        $context['this_year_orders'] = $this_year_orders;
        $context['this_month_orders'] = $this_month_orders;
        $context['this_week_orders'] = $this_week_orders;
        $context['yesterday_orders'] = $yesterday_orders;
        $context['today_orders'] = $today_orders;
        return view('dashboard.index', $context);
    }

    public function blocked()
    {
        if (auth()->user()->status) {
            return redirect()->route('dashboard.index');
        }
        $information = User::role('SuperAdmin')->first()->store()->first()->information()->first();
        $context = [
            'information' => $information,
        ];
        return view('dashboard.blocked', $context);
    }


    public function participants()
    {

        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User') {
            $current = $auth_user->getCurrentSubscriptions();
            if ($current) {
                $deadline = $current->deadline;
            } else {
                $deadline = false;
            }

            return view('dashboard.participants', ['title_page' => 'subscription', 'deadline' => $deadline]);
        } else {
            return view('dashboard.participants', ['title_page' => 'participants']);
        }
    }
    
     public function links_index () {
        if(auth()->user()->getRoleNames()[0] != 'SuperAdmin') {
            $links = \App\links::orderBy('id','desc')->get();
            $title_page = 'links';
            return view('dashboard.link')->with([
                    'links' => $links,
                    'title_page' => $title_page,
                ]);
        } else {
            $links = \App\links::orderBy('id','desc')->get();
            $title_page = 'links';
            return view('dashboard.link')->with([
                    'links' => $links,
                    'title_page' => $title_page,
                ]);
            
        }
        
    }
    
    public function links_add(Request $request) {
        
        $new_link = new \App\links($request->all());
        $new_link->save();
        
        return back()->with('success','Saved'); 
    }
    
    public function links_update(Request $request,$id) {
        $link = \App\links::where('id',$id)->first();
        $link->update($request->all());
        //return 
    }
    
    public function links_destroy($id) {
        \App\links::findOrFail($id)->delete();
        return back()->with('success','Deleted');  
    }
}
//Developed Saed Z. Sinwar
