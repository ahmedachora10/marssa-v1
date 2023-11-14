<?php

namespace App\Http\Controllers;

use App\Store;
use App\Visitors;
use Faker\Provider\Payment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\ClientExport;
use App\Exports\ProductExport;
use App\Exports\OrderExport;
use App\Exports\StoreExport;
use App\Exports\ContactExport;
use App\Exports\InfomationExport;
use App\Exports\OrderRecordExport;
use App\Exports\OfferExport;
use App\Exports\PromoCodeExport;
use App\Exports\SubscribeExport;
use App\Exports\PaymentExport;
use App\Exports\VisitorsExport;
use  App\Order;
use  App\User;
use App\Branch;
use \Datetime;
use  DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ExportDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function reports()
    {
        $auth_user = auth()->user();
        $name = 'name_' . app()->getLocale();
        $this_month = now()->format('Y-m-1');
        $this_year = now()->format('Y-1-1');
        $today = now()->format('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 days'));
        $this_week = date('Y-m-d', strtotime('-7 days'));
        if ($auth_user->getRoleNames()[0] == 'User') {
            $all_charts = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->select('id', 'created_at', 'quantity', 'amount');
            $sales_amount = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->get()->sum('amount');
            $all_sales = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->get()->count('id');
            $all_time_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->get()->count();
            $this_month_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->where('created_at', '>=', $this_month)->get()->count();
            $this_year_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->where('created_at', '>=', $this_year)->get()->count();
             $this_week_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->where('created_at', '>=', $this_week)->get()->count();
            $this_month_orders_land=\App\ProductOfferOrder::where('store_id',$auth_user->store_id)->where('created_at', '>=', $this_month)->get()->count();
           $this_year_orders_land = \App\ProductOfferOrder::where('store_id',$auth_user->store_id)->where('created_at', '>=', $this_year)->get()->count();
            $this_week_orders_land = \App\ProductOfferOrder::where('store_id',$auth_user->store_id)->where('created_at', '>=', $this_week)->get()->count();
            $today_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->where('created_at', '>=', $today)->get()->count();
            
            $today_orders_land=\App\ProductOfferOrder::where('store_id',$auth_user->store_id)->where('created_at', '>=', $today)->get()->count();
            
            $yesterday_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->where('created_at', '>=', $yesterday)->get()->count();
            $yesterday_orders_land = \App\ProductOfferOrder::where('store_id',$auth_user->store_id)->where('created_at', '>=', $yesterday)->get()->count();
            $best_charts = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->groupBy('product_id')->join('products', 'orders.product_id','=','products.id');
            $best_charts1 = $auth_user->store()->first()->products()->groupBy('product_id')->join('orders', 'orders.product_id','=','products.id')->where('orders.status', '!=', 5);
            
            $all_visitors = $auth_user->store()->first()->visitors()->get()->groupBy('ipAddress')->count();
            $today_visitors = $auth_user->store()->first()->visitors()->where('created_at', '>=', $today)->get()->groupBy('ipAddress')->count();
            $all_visits = $auth_user->store()->first()->visitors()->get()->count();
            $visitors_countryCode = $auth_user->store()->first()->visitors()->where('countryCode','MR')->get()->groupBy('cityName');//countryCode
            $visitors_Platform = $auth_user->store()->first()->visitors()->get()->groupBy('platform');
        } elseif ($auth_user->getRoleNames()[0] == 'SubUser') {
            $all_charts = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->select('id', 'created_at', 'quantity', 'amount');
            $sales_amount = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->get()->sum('amount');

            $all_sales = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->get()->count();
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
            $today_orders_land=\App\ProductOfferOrder::where('store_id',$auth_user->store_id)->where('created_at', '>=', $today)->get()->count();
             $this_month_orders_land=\App\ProductOfferOrder::where('store_id',$auth_user->store_id)->where('created_at', '>=', $this_month)->get()->count();
           $this_year_orders_land = \App\ProductOfferOrder::where('store_id',$auth_user->store_id)->where('created_at', '>=', $this_year)->get()->count();
            $this_week_orders_land = \App\ProductOfferOrder::where('store_id',$auth_user->store_id)->where('created_at', '>=', $this_week)->get()->count();
           
            $yesterday_orders = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->where('created_at', '>=', $yesterday)->get()->count();
            $yesterday_orders_land = \App\ProductOfferOrder::where('store_id',$auth_user->store_id)->where('created_at', '>=', $yesterday)->get()->count();
            $best_charts = $auth_user->store()->first()->orders()->where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            })->groupBy('product_id')->join('products', 'orders.product_id','=', 'products.id');
            $best_charts1 = $auth_user->store()->first()->products()->groupBy('product_id')->join('orders', 'orders.product_id','=', 'products.id')->
            where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($auth_user) {
                $query->where('branch_id', $auth_user->branch_id);
            });

            $all_visitors = $auth_user->store()->whereHas('branches', function (Builder $query) use ($auth_user) {
                $query->where('id', $auth_user->branch_id);
            })->first()->visitors()->get()->groupBy('ipAddress')->count();
            $today_visitors = $auth_user->store()->first()->visitors()->where('created_at', '>=', $today)->whereHas('branches', function (Builder $query) use ($auth_user) {
                $query->where('id', $auth_user->branch_id);
            })->first()->visitors()->get()->groupBy('ipAddress')->count();

            $all_visits = $auth_user->store()->whereHas('branches', function (Builder $query) use ($auth_user) {
                $query->where('id', $auth_user->branch_id);
            })->first()->visitors()->get()->count();


            $visitors_countryCode = $auth_user->store()->where('countryCode','MR')->whereHas('branches', function (Builder $query) use ($auth_user) {
                $query->where('id', $auth_user->branch_id);
            })->first()->visitors()->get()->groupBy('cityName');//countryCode

            $visitors_Platform = $auth_user->store()->whereHas('branches', function (Builder $query) use ($auth_user) {
                $query->where('id', $auth_user->branch_id);
            })->first()->visitors()->get()->groupBy('platform');

        } else {
            $all_charts = Order::select('id', 'created_at', 'quantity', 'amount');
            $all_sales = Order::get()->where('orders.status', '!=', 5)->count();
            $all_time_orders = Order::get()->count();
            $this_month_orders = Order::where('created_at', '>=', $this_month)->get()->count();
            $this_year_orders = Order::where('created_at', '>=', $this_year)->get()->count();
            $this_week_orders = Order::where('created_at', '>=', $this_week)->get()->count();
            $today_orders = Order::where('created_at', '>=', $today)->get()->count();
            $today_orders_land = \App\ProductOfferOrder::where('created_at', '>=', $today)->get()->count();
            $yesterday_orders = Order::where('orders.status', '!=', 5)->where('created_at', '>=', $yesterday)->get()->count();
            $yesterday_orders_land = \App\ProductOfferOrder::where('created_at', '>=', $yesterday)->get()->count();
             $this_month_orders_land=\App\ProductOfferOrder::where('created_at', '>=', $this_month)->get()->count();
           $this_year_orders_land = \App\ProductOfferOrder::where('created_at', '>=', $this_year)->get()->count();
            $this_week_orders_land = \App\ProductOfferOrder::where('created_at', '>=', $this_week)->get()->count();
           
            $best_charts = Order::groupBy('product_id')->join('products', 'orders.product_id','=', 'products.id');
            $best_charts1 = Product::groupBy('id')->join('orders', 'orders.product_id','=', 'products.id');
            $all_visitors = Visitors::get()->groupBy('ipAddress')->count();
            $today_visitors = Visitors::where('created_at', '>=', $today)->get()->groupBy('ipAddress')->count();
            $all_visits = Visitors::get()->count();
            $visitors_countryCode = Visitors::get()->where('countryCode','MR')->groupBy('cityName');//countryCode
            $visitors_Platform = Visitors::get()->groupBy('platform');
        }

        $most_wanted = $best_charts1->groupBy('product_id')->select(DB::raw('count(*) as y'), "products.$name as name","orders.status","orders.created_at","orders.id as order_id","product_id")->get();
        $best_selling = $best_charts1->groupBy('product_id')->select(DB::raw('sum(orders.quantity) as y'), "products.$name as name","orders.status","orders.created_at","product_id")->get();


        $orders = $all_charts->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        $visitors_country = [];
        $visitors_platform = [];
        $monthOrders = [];
        $monthSales = [];
        $yearOrders = [];
        $yearSales = [];
        $total_sales = 0;
        $amount_sales = 0;
        foreach ($visitors_Platform as $key => $country) {
            if ($key != "0") {
                $arr = [
                    'y' => count($country),
                    'name' => $key
                ];
                array_push($visitors_platform, $arr);
            }
        }
        foreach ($visitors_countryCode as $key => $country) {
            $arr = [
                'y' => count($country),
                'x' => $country->first()->cityName,
                'name' => $key
            ];
            array_push($visitors_country, $arr);
        }
        foreach ($orders as $key => $objects) {
            $count_sales = 0;
            foreach ($objects as $obj) {
                $count_sales += (int)$obj->quantity;
                $amount_sales += (int)$obj->amount;
            }
            $total_sales += $count_sales;
            $monthSales[(int)$key] = $count_sales;
            $monthOrders[(int)$key] = count($objects);
        }
        $current_month = (int)now()->format('m');

        for ($i = $current_month + 1; $i <= 12; $i++) {
            if (!empty($monthOrders[$i])) {
                array_push($yearOrders, $monthOrders[$i]);
            } else {
                array_push($yearOrders, 0);
            }
            if (!empty($monthSales[$i])) {
                array_push($yearSales, $monthSales[$i]);
            } else {
                array_push($yearSales, 1);
            }
        }
        for ($i = 1; $i <= $current_month; $i++) {
            if (!empty($monthOrders[$i])) {
                array_push($yearOrders, $monthOrders[$i]);
            } else {
                array_push($yearOrders, 0);
            }
            if (!empty($monthSales[$i])) {
                array_push($yearSales, $monthSales[$i]);
            } else {
                array_push($yearSales, 2);
            }
        }
        foreach ($best_selling as $best) {
            $best['y'] = (int)$best['y'];
        }
        foreach ($most_wanted as $most) {
            $most['y'] = (int)$most['y'];
        }

        if ($all_sales > 0) {
            $cart_average = (int)ceil($sales_amount / $all_sales );
        } else {
            $cart_average = 0;
        }

        if ($today_visitors > 0) {
            //$percent = round(($today_orders * 100) / $today_visitors, 2);
            $percent = round(($all_time_orders * 100) / $all_visitors, 2);
            //$all_time_orders
        } else {
            $percent = 0;
        }

        $landOfferSalesCount=\App\ProductOfferOrder::where('store_id',$auth_user->store->id)->count();
        
        $landOfferSales=\App\ProductOfferOrder::where('store_id',$auth_user->store->id)->sum('amount');
       //   $sales_amount = $auth_user->store()->first()->orders()->where('orders.status', '=', 4)->get()->sum('amount');
           
        $landOfferSalesCountAll=\App\ProductOfferOrder::count();
        
        $landOfferSalesAll=\App\ProductOfferOrder::sum('amount');
        $context = [
            'landOfferSalesCountAll'=>$landOfferSalesCountAll,
            'landOfferSalesAll'=>$landOfferSalesAll,
            'landOfferSalesCount'=>$landOfferSalesCount,
            'landOfferSales'=>$landOfferSales,
            'title_page' => 'reports',
            'total_orders' => count($orders)+$landOfferSalesCountAll,
            'orders' => json_encode($yearOrders),
            'total_sales' => $total_sales +$landOfferSalesAll,
            'amount_sales' => $amount_sales +$landOfferSales,
            'sales' => json_encode($yearSales),
            'best_selling' => $best_selling->toJson(),
            'most_wanted' => $most_wanted->toJson(),
            'current_month' => $current_month,
            'visitors_country' => json_encode($visitors_country),
            'visitors_platform' => json_encode($visitors_platform),
            'all_sales' => $all_sales+$landOfferSalesAll,
            'all_time_orders' => $all_time_orders +$landOfferSalesCount,
            'this_year_orders' => $this_year_orders+$this_year_orders_land,
            'this_month_orders' => $this_month_orders+$this_month_orders_land,
            'this_week_orders' => $this_week_orders+$this_week_orders_land,
            'yesterday_orders' => $yesterday_orders+$yesterday_orders_land,
            'today_orders' => $today_orders + $today_orders_land,
            'percent' => $percent,
            'cart_average' => $cart_average,
            'all_visits' => $all_visits,
            'all_visitors' => $all_visitors,
            'sales_amount' => $sales_amount ?? '',
            'currency' => $auth_user->store()->first()->information()->first()->currency,
        ];
        return view('dashboard.reports', $context);
    }


    public function reportsStores(Request $request)
    {
        $stores = [];
        if ($request->has('type')) {
            $type = $request->type;
            if ($type == 'all') {
                $stores = Store::all();
            } elseif ($type == 'plan_stander') {
                $stores = Store::where('plan_id', 1)->get();
            } elseif ($type == 'plan_start_up') {
                $stores = Store::where('plan_id', 2)->get();
            } elseif ($type == 'plan_super') {
                $stores = Store::where('plan_id', 3)->get();
            } elseif ($type == 'plan_free') {
                $stores = Store::where('plan_id', 4)->get();
            } elseif ($type == 'stores_active_without_products') {
                $stores = Store::where('status', '1')->withCount('products')->having('products_count', '=', '0')->get();
            } elseif ($type == 'stores_disable_without_products') {
                $stores = Store::where('status', 0)->withCount('products')->having('products_count', '=', 0)->get();
            } elseif ($type == 'stores_7_day_left_to_end') {
                $stores = Store::withCount(
                    [
                        'subscribe_last' => function ($q) {
                            $q->whereBetween('deadline', [now(), now()->addDays(7)])->where('status', '1');
                        }
                    ]
                )->where('status', 1)->having('subscribe_last_count', '>', 0)->get();
            } elseif ($type == 'stores_active_and_have_product') {
                $stores = Store::where('status', '1')->
                withCount('products')->having('products_count', '>', 0)->get();
            } elseif ($type == 'stores_not_work_but_has_products') {
                $stores = Store::withCount(['products'])
                    ->where('status', 0)
                    ->having('products_count', '>', 1)
                    ->get();
            }
        }
        return view("dashboard.reports.stores", ['stores' => $stores, 'title_page' => 'stores']);
    }

    public function export_data($table, $branch_id = null)
    {
        if ($table == 'users')
            return Excel::download(new UsersExport($branch_id), 'users.xlsx');
        elseif ($table == 'clients')
            return Excel::download(new ClientExport($branch_id), 'clients.xlsx');
        elseif ($table == 'products')
            return Excel::download(new ProductExport($branch_id), 'products.xlsx');
        elseif ($table == 'orders')
            return Excel::download(new OrderExport($branch_id), 'orders.xlsx');
        elseif ($table == 'stores')
            return Excel::download(new StoreExport($branch_id), 'stores.xlsx');
        elseif ($table == 'contacts')
            return Excel::download(new ContactExport($branch_id), 'contacts.xlsx');
        elseif ($table == 'information')
            return Excel::download(new InfomationExport($branch_id), 'informations.xlsx');
        elseif ($table == 'order_record')
            return Excel::download(new OrderRecordExport($branch_id), 'order_record.xlsx');
        elseif ($table == 'offers')
            return Excel::download(new OfferExport($branch_id), 'offers.xlsx');
        elseif ($table == 'promo_code')
            return Excel::download(new PromoCodeExport($branch_id), 'promo_code.xlsx');
        elseif ($table == 'visitors')
            return Excel::download(new VisitorsExport($branch_id), 'visitors.xlsx');
        elseif ($table == 'subscribers')
            return Excel::download(new SubscribeExport($branch_id), 'subscribers.xlsx');
        elseif ($table == 'invoices')
            return Excel::download(new PaymentExport($branch_id), 'invoices.xlsx');
        return;
    }

    public function branch_report($branch_id)
    {
        $branch = Branch::find($branch_id);
        $auth_user = auth()->user();
        $name = 'name_' . app()->getLocale();
        if ($auth_user->getRoleNames()[0] == 'User') {
            $all_charts = Order::where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            })->select('id', 'created_at', 'quantity', 'amount');
            $best_charts = Order::where('orders.status', '!=', 5)->whereHas('payment', function (Builder $query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            })->groupBy('product_id')->join('products', 'orders.product_id', 'products.id');
            $visitors_countryCode = $auth_user->store()->first()->visitors()->where('countryCode','MR')->get()->groupBy('cityName');//countryCode
            $visitors_Platform = $auth_user->store()->first()->visitors()->get()->groupBy('platform');
        }

        $most_wanted = $best_charts->select(DB::raw('count(*) as y'), "products.$name as name")->get();
        $best_selling = $best_charts->select(DB::raw('sum(orders.quantity) as y'), "products.$name as name ")->groupBy('id')->get();
//        dd($best_selling);
        $orders = $all_charts->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        $visitors_country = [];
        $visitors_platform = [];
        $monthOrders = [];
        $monthSales = [];
        $yearOrders = [];
        $yearSales = [];
        $total_sales = 0;
        $amount_sales = 0;
        foreach ($visitors_Platform as $key => $country) {
            if ($key != "0") {
                $arr = [
                    'y' => count($country),
                    'name' => $key
                ];
                array_push($visitors_platform, $arr);
            }
        }
        foreach ($visitors_countryCode as $key => $country) {
            $arr = [
                'y' => count($country),
                'x' => $country->first()->cityName,
                'name' => $key
            ];
            array_push($visitors_country, $arr);
        }
        
        foreach ($orders as $key => $objects) {
            $count_sales = 0;
            foreach ($objects as $obj) {
                $count_sales += (int)$obj->quantity;
                $amount_sales += (int)$obj->amount ;
            }
            $total_sales += $count_sales;
            $monthSales[(int)$key] = $count_sales;
            $monthOrders[(int)$key] = count($objects);
        }
        $current_month = (int)now()->format('m');
        for ($i = $current_month + 1; $i <= 12; $i++) {
            if (!empty($monthOrders[$i])) {
                array_push($yearOrders, $monthOrders[$i]);
            } else {
                array_push($yearOrders, 0);
            }
            if (!empty($monthSales[$i])) {
                array_push($yearSales, $monthSales[$i]);
            } else {
                array_push($yearSales, 1);
            }
        }
        for ($i = 1; $i <= $current_month; $i++) {
            if (!empty($monthOrders[$i])) {
                array_push($yearOrders, $monthOrders[$i]);
            } else {
                array_push($yearOrders, 0);
            }
            if (!empty($monthSales[$i])) {
                array_push($yearSales, $monthSales[$i]);
            } else {
                array_push($yearSales, 2);
            }
        }
        foreach ($best_selling as $best) {
            $best['y'] = (int)$best['y'];
        }
        foreach ($most_wanted as $most) {
            $most['y'] = (int)$most['y'];
        }
        $context = [
            'title_page' => 'branch-reports',
            'Branch' => $branch,
            'total_orders' => count($orders),
            'orders' => json_encode($yearOrders),
            'total_sales' => $total_sales,
            'amount_sales' => $amount_sales,
            'sales' => json_encode($yearSales),
            'best_selling' => $best_selling->toJson(),
            'most_wanted' => $most_wanted->toJson(),
            'current_month' => $current_month,
            'visitors_country' => json_encode($visitors_country),
            'visitors_platform' => json_encode($visitors_platform),
        ];
        return view('dashboard.branches.report', $context);
    }
}
//Developed Saed Z. Sinwar
