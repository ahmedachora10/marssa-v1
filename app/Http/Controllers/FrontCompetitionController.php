<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order;
use App\Models;
use App\Category;
use App\Product;
use App\ProductReview;
use App\Store;
use App\Slider;
use App\Counter;
use App\Section;
use App\Features;
use App\Plan;
use App\Page;
use App\Feedback;
use App\Contact;
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
use App\CompetitionProduct;
use App\Competition;
use App\Competitor;
use App\CompetitionLinks;
use App\User;
use App\CompetitionJoin;
use App\CompetitionVisitCount;
class FrontCompetitionController extends Controller{
    public function index(Request $request, $domain = ''){
        
        $models = Models::all();
        $plans = Plan::all();
        $features = Features::all();
        $pages = Page::whereStoreId('1')->get();
        $feedback = Feedback::all()->shuffle()->take(4);
        $counters = Counter::all();
        $information = User::role('SuperAdmin')->first()->store()->first()->information()->first();

        $section = [
            'models_stores' => Section::whereType('models_stores')->first()->status ?? 0,
            'features_platform' => Section::whereType('features_platform')->first()->status ?? 0,
            'feedback' => Section::whereType('feedback')->first()->status ?? 0,
        ];
        $head_data = [
            'title_ar' => $information['title_page_ar'] . ' - ' . __('site.main_menu'),
            'title_en' => $information['title_page_en'] . ' - ' . __('site.main_menu'),
            'title_fr' => $information['title_page_fr'] . ' - ' . __('site.main_menu'),
            'description_ar' => $information['description_ar'],
            'description_en' => $information['description_en'],
            'description_fr' => $information['description_fr'],
            'keyword_ar' => $information['keyword_ar'],
            'keyword_en' => $information['keyword_en'],
            'keyword_fr' => $information['keyword_fr'],
            'icon' => $information['preview'],
        ];
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
        $competitons = Competition::withCount('competitors','competition_joiners')->where('store_id',$store->id)->orderBy('created_at','desc')->paginate(10);
        $context = [
            'store' => $store,
            'head_data' => $head_data,
            'models' => $models,
            'plans' => $plans,
            'feedback' => $feedback,
            'pages' => $pages,
            'section' => $section,
            'details' => 'index',
            'css_style'=>$store->css_style,
            'features' => $features,
            'categories' => $store->categories()->where('status',1)->get(),
            'ads' => false,
            'competitons' => $competitons,
            'counters' => $counters,
            'information' => $information,
        ];
        
        return view('Store.competitons.index_1',$context);
    }
    
    public function details_competition($domain,$slug){
        // \Artisan::call('make:middleware CompetitionVisitsLink');
        $models = Models::all();
        $plans = Plan::all();
        $features = Features::all();
        $pages = Page::whereStoreId('1')->get();
        $feedback = Feedback::all()->shuffle()->take(4);
        $counters = Counter::all();
        $information = User::role('SuperAdmin')->first()->store()->first()->information()->first();

        $section = [
            'models_stores' => Section::whereType('models_stores')->first()->status ?? 0,
            'features_platform' => Section::whereType('features_platform')->first()->status ?? 0,
            'feedback' => Section::whereType('feedback')->first()->status ?? 0,
        ];
        $head_data = [
            'title_ar' => $information['title_page_ar'] . ' - ' . __('site.main_menu'),
            'title_en' => $information['title_page_en'] . ' - ' . __('site.main_menu'),
            'title_fr' => $information['title_page_fr'] . ' - ' . __('site.main_menu'),
            'description_ar' => $information['description_ar'],
            'description_en' => $information['description_en'],
            'description_fr' => $information['description_fr'],
            'keyword_ar' => $information['keyword_ar'],
            'keyword_en' => $information['keyword_en'],
            'keyword_fr' => $information['keyword_fr'],
            'icon' => $information['preview'],
        ];
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
        $competiton = Competition::with('competition_products','competition_products.product','competition_links','winner','winner_visits_links')->withCount('competitors','competition_joiners')->where('slug',$slug)->first();
        //dd($competiton);
        $context = [
            'store' => $store,
            'head_data' => $head_data,
            'models' => $models,
            'plans' => $plans,
            'feedback' => $feedback,
            'pages' => $pages,
            'section' => $section,
            'details' => 'index',
            'css_style'=>$store->css_style,
            'features' => $features,
            'categories' => $store->categories()->where('status',1)->get(),
            'ads' => false,
            'competiton' => $competiton,
            'counters' => $counters,
            'information' => $information,
        ];
        
        
        return view('Store.competitons.details_1',$context);
    }
    
    public function search_on_competitiors(Request $request,$domain = ''){
        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
        $competiton = Competition::where([
            'store_id' => $store->id,
            'slug'     => $request->input('competition_slug')
        ])->first();
        
        if($competiton){
            $competitor_exist = Competitor::with('client')->where([
                'competition_id' => $competiton->id,
                'mobile'         => $request->input('mobile')
            ]); 

            $competitor = null;
            if($exist = $competitor_exist->exists()){
                $competitor = $competitor_exist->first();
            }
            
            return response()->json([
                'success'      => $exist,
                'competitor'  => $competitor
            ]);
        }
        
        return response()->json([
            'success' => false
        ]);
        
    }
    
    public function join_competition(Request $request,$domain = ''){
        $store = Store::whereDomain($domain)->where('domain', '<>', env('MainDomain'))->first();
        $competiton = Competition::where([
            'store_id' => $store->id,
            'slug'     => $request->input('competition_slug')
        ])->first();
        
        if($competiton){
            $competitor_join = CompetitionJoin::where([
                'competition_id' => $competiton->id,
                'mobile'         => $request->input('mobile')
            ])->first();
            
            if(!$competitor_join){
                $competitor_join = CompetitionJoin::create([
                    'competition_id' => $competiton->id,
                    'mobile'         => $request->input('mobile'),
                    'code' => Str::random(10)
                ]);
            }
           

            $competitor = null;
            if($competitor_join){
                foreach($competiton->competition_links as $link):
                    $competitor_join->competition_link_visits()->updateOrCreate([
                        'competition_link_id' => $link->id,
                        'competition_join_id' => $competitor_join->id
                    ]);
                endforeach;
            }
            
            return response()->json([
                'success'      => true,
                'competition_link_visits'  => CompetitionVisitCount::where([
                    'competition_join_id'  => $competitor_join->id
                ])->with('competition_link')->withCount('link_visits')->get(),
                'reference'                => $competitor_join->code
            ]);
        }
        
        return response()->json([
            'success' => false
        ]);
    }
}