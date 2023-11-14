<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order;
use App\Store;
use App\Visitors;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class AdminAnalyze extends Controller
{

    public $path = 'dashboard.analyze';

    public function index()
    {

        $data = [
            'title_page' => __('analyze')
        ];

        return view("$this->path.index", $data);
    }

    public function analyzeStores(): array
    {
        $array = [];
        $array['today'] = Store::whereDate('created_at', '>=', now()->toDateString())->count();
        $array['yesterday'] = Store::whereDate('created_at', '=', \Carbon\Carbon::yesterday())->count();
        $array['week'] = Store::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $array['month'] = Store::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $array['threeMonth'] = Store::whereBetween('created_at', [now()->subMonths(3), now()])->count();
        $array['all'] = Store::count();
        return $array;

    }

    public function analyzeOrders(): array
    {
        $array = [];

        $array['today'] = Order::whereDate('created_at', '>=', now()->toDateString())->count();
        $array['yesterday'] = Order::whereDate('created_at', '=', \Carbon\Carbon::yesterday())->count();
        $array['week'] = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $array['month'] = Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $array['threeMonth'] = Order::whereBetween('created_at', [now()->subMonths(3), now()])->count();
        $array['all'] = Order::count();
        return $array;
    }

    public function analyzeVisitors(): array
    {
        $array = [];

        $array['today'] = Visitors::whereDate('created_at', '>=', now()->toDateString())->count();
        $array['yesterday'] = Visitors::whereDate('created_at', '=', \Carbon\Carbon::yesterday())->count();
        $array['week'] = Visitors::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $array['month'] = Visitors::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $array['threeMonth'] = Visitors::whereBetween('created_at', [now()->subMonths(3), now()])->count();
        $array['all'] = Visitors::count();
        return $array;
    }

    public function analyzeProfit(): array
    {
        $array = [];

        $array['today'] = Order::whereDate('created_at', '>=', now()->toDateString())->sum('amount');
        $array['yesterday'] = Order::whereDate('created_at', '=', \Carbon\Carbon::yesterday())->sum('amount');
        $array['week'] = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('amount');
        $array['month'] = Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount');
        $array['threeMonth'] = Order::whereBetween('created_at', [now()->subMonths(3), now()])->sum('amount');
        $array['all'] = Order::sum('amount');
        return $array;
    }

    public function analyzeMostWanted()
    {
        $array = [];
        $name = 'name_' . app()->getLocale();
        $best_charts = Order::groupBy('product_id')->join('products', 'orders.product_id', 'products.id');
        $array['all'] = $best_charts->select(DB::raw('count(*) as y'), "products.$name as name")->get();
        $best_charts = Order::groupBy('product_id')->join('products', 'orders.product_id', 'products.id');
        $array['today'] = $best_charts->select(DB::raw('count(*) as y'), "products.$name as name")->whereDate('orders.created_at', '>=', now()->toDateString())->get();
        $best_charts = Order::groupBy('product_id')->join('products', 'orders.product_id', 'products.id');
        $array['yesterday'] = $best_charts->select(DB::raw('count(*) as y'), "products.$name as name")->whereDate('orders.created_at', '=', \Carbon\Carbon::yesterday())->get();
        $best_charts = Order::groupBy('product_id')->join('products', 'orders.product_id', 'products.id');
        $array['week'] = $best_charts->select(DB::raw('count(*) as y'), "products.$name as name")->whereBetween('orders.created_at', [now()->startOfWeek(), now()->endOfWeek()])->get();
        $best_charts = Order::groupBy('product_id')->join('products', 'orders.product_id', 'products.id');
        $array['month'] = $best_charts->select(DB::raw('count(*) as y'), "products.$name as name")->whereBetween('orders.created_at', [now()->startOfMonth(), now()->endOfMonth()])->get();
        $best_charts = Order::groupBy('product_id')->join('products', 'orders.product_id', 'products.id');
        $array['threeMonth'] = $best_charts->select(DB::raw('count(*) as y'), "products.$name as name")->whereBetween('orders.created_at', [now()->subMonths(3), now()])->get();
        return $array;

    }


    public function bestStoreOrderingByProducts()
    {

        $array['today'] = Order::whereDate('created_at', '>=', now()->toDateString())->with('store')
            ->select('id', 'store_id', DB::raw('COUNT(id) as count'), 'created_at')
            ->groupBy('store_id')
            ->orderBy('count', 'desc')
            ->take(10)->get();
        $array['yesterday'] = Order::whereDate('created_at', '=', \Carbon\Carbon::yesterday())->with('store')
            ->select('id', 'store_id', DB::raw('COUNT(id) as count'), 'created_at')
            ->groupBy('store_id')
            ->orderBy('count', 'desc')
            ->take(10)->get();
        $array['week'] = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->with('store')
            ->select('id', 'store_id', DB::raw('COUNT(id) as count'), 'created_at')
            ->groupBy('store_id')
            ->orderBy('count', 'desc')
            ->take(10)->get();
        $array['month'] = Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->with('store')
            ->select('id', 'store_id', DB::raw('COUNT(id) as count'), 'created_at')
            ->groupBy('store_id')
            ->orderBy('count', 'desc')
            ->take(10)->get();
        $array['threeMonth'] = Order::whereBetween('created_at', [now()->subMonths(3), now()])->with('store')
            ->select('id', 'store_id', DB::raw('COUNT(id) as count'), 'created_at')
            ->groupBy('store_id')
            ->orderBy('count', 'desc')
            ->take(10)->get();
        $array['all'] = Order::with('store')
            ->select('id', 'store_id', DB::raw('COUNT(id) as count'), 'created_at')
            ->groupBy('store_id')
            ->orderBy('count', 'desc')
            ->take(10)->get();
        foreach ($array as &$item) {
            $item = $this->orderingDataOrderInStores($item);
        }
        return $array;
    }

    public function analyzeAverage(): array
    {
        $array = [];
        $array['today'] = Store::whereDate('created_at', '>=', now()->toDateString())->count() != 0 ? (Order::whereDate('created_at', '>=', now()->toDateString())->sum('amount') / Store::whereDate('created_at', '>=', now()->toDateString())->count()) : 0;
        $array['yesterday'] = Store::whereDate('created_at', '=', \Carbon\Carbon::yesterday())->count() != 0 ? (Order::whereDate('created_at', '=', \Carbon\Carbon::yesterday())->sum('amount') / Store::whereDate('created_at', '=', \Carbon\Carbon::yesterday())->count()) : 0;
        $array['week'] = Store::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count() != 0 ? (Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('amount') / Store::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count()) : 0;
        $array['month'] = Store::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count() != 0 ? (Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount') / Store::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count()) : 0;
        $array['threeMonth'] = Store::whereBetween('created_at', [now()->subMonths(3), now()])->count() != 0 ? (Order::whereBetween('created_at', [now()->subMonths(3), now()])->sum('amount') / Store::whereBetween('created_at', [now()->subMonths(3), now()])->count()) : 0;
        $array['all'] = Store::count() != 0 ? (Order::sum('amount') / Store::count()) : 0;

        return $array;
    }

    public function StoreThatHasPaiedSubscribe()
    {
        $stores = Store::whereHas('plan', function ($query) {
            return $query->where('id', '<>', 4);
        })->select('id', 'plan_id')->get()->groupBy('plan_id');

        $planNamesWithCount = [];
        foreach ($stores as $index => $item) {
            $plan = \App\Plan::find($index);
            $planNamesWithCount[$plan->{"name_" . l()}] = count($item);
        }
        return $planNamesWithCount;
    }

    public function orderingDataOrderInStores($order)
    {

        $array = [];
        foreach ($order as $items) {
            $array[$items->id]['name'] = $items->store->name;
            $array[$items->id]['countProduct'] = $items->count;
        }
        return $array;
    }

    public function stores()
    {

        $this->StoresThatHaveBigNumber();
        $data = [
            'title_page' => __('analyze'),
            'stores' => $this->analyzeStores(),
            'orders' => $this->analyzeOrders(),
            'planNamesWithCount' => $this->StoreThatHasPaiedSubscribe(),
            'profit' => $this->analyzeProfit(),
            'visitors' => $this->analyzeVisitors(),
            'most_wanted' => $this->analyzeMostWanted(),
            'stores_order_by_products' => $this->bestStoreOrderingByProducts(),
            'stores_average_sale' => $this->analyzeAverage(),
        ];
        return view("$this->path.stores", $data);
    }

    public function StoresThatHaveBigNumber()
    {
//        $stores = Store::withCount('orders',function ($query){
//            return $query->whereMonth('created_at',now()->month);
//        })->get();
    }

    public function platform()
    {

        $data = [
            'title_page' => __('analyze'),
            'renewStore' => $this->analyzeRenewStore(),
            'averagePlatformGrowth' => $this->averagePlatformGrowth(),
        ];
        return view("$this->path.platform", $data);
    }

    public function analyzeRenewStore()
    {
        $array = [];
        $active = Store::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->where('status', '=', '1')->count();
        $all = Store::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $array['month'] = $active != 0 && $all != 0 ? ($active / $all) * 100 : 0;
        $active = Store::whereBetween('created_at', [now()->subMonths(3), now()])->where('status', '=', '1')->count();
        $all = Store::whereBetween('created_at', [now()->subMonths(3), now()])->count();
        $array['threeMonth'] = $active != 0 && $all != 0 ? ($active / $all) * 100 : 0;
        $active = Store::whereBetween('created_at', [now()->subMonths(6), now()])->where('status', '=', '1')->count();
        $all = Store::whereBetween('created_at', [now()->subMonths(6), now()])->count();
        $array['sixMonth'] = $active != 0 && $all != 0 ? ($active / $all) * 100 : 0;
        $active = Store::where('status', '=', '1')->count();
        $all = Store::count();
        $array['all'] = $active != 0 && $all != 0 ? ($active / $all) * 100 : 0;
        return $array;
    }

    public function averagePlatformGrowth(): array
    {

        $array = [];
        $all = Store::count();
        $part = Store::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $array['month'] = $all != 0 && $part != 0 ? ($part / $all) * 100 : 0;
        $part = Store::whereBetween('created_at', [now()->subMonths(3), now()])->count();
        $array['threeMonth'] = $all != 0 && $part != 0 ? ($part / $all) * 100 : 0;
        $part = Store::whereBetween('created_at', [now()->subMonths(6), now()])->count();
        $array['sixMonth'] = $all != 0 && $part != 0 ? ($part / $all) * 100 : 0;
        $part = Store::whereBetween('created_at', [now()->subYear(), now()])->count();
        $array['year'] = $all != 0 && $part != 0 ? ($part / $all) * 100 : 0;
        return $array;
    }


}
