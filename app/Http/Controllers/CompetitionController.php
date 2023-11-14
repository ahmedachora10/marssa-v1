<?php

namespace App\Http\Controllers;

use App\Offer;
use App\PromoCode;
use App\ProductAttributes;
use App\ProductAttributesValues;
use App\Category;
use Illuminate\Http\Request;
use App\Product;
use App\Product_options;
use App\Colors;
use App\Competition;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\ProductVariations;
use App\Store;
use App\Order;
use App\CompetitionProduct;
use App\CompetitionLinks;
use App\Competitor;
use App\CompetitionJoin;
class CompetitionController extends Controller
{
    
    public function index(){
        $competitions = Competition::where([
            'store_id' => auth()->user()->store()->first()->id
        ])->orderBy('created_at','desc')->get();
        $context = ['title_page' => 'Competitions' ,'competitions'=>$competitions ]; 
        return view('dashboard.competition.index', $context);
    }
    
    public function create(){
        $products    = auth()->user()->store()->first()->products()->orderBy('id', 'DESC')->get();
        $context = ['title_page' => 'Competitions Create','products' => $products]; 
        return view('dashboard.competition.create' ,$context);
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'unique:competitions,name'
        ]);
        
        //dd($request->all());
        $competition = new Competition();
        $auth_user = auth()->user();
        $competition->user_id        = $auth_user->id;
        $competition->store_id       = $auth_user->store_id;
        $competition->name           = $request->name;
        $competition->description    = $request->description;
        $competition->prize          = $request->prize;
        $competition->start_date     = $request->start_date;
        $competition->end_date       = $request->end_date;
        $competition->condition_type = $request->condition_type;
        $competition->video_url      = $request->video_url;
        $competition->thumbnails     = $request->thumbnails;
        $competition->slug           = str_replace(' ','-',$request->name);
        //$competition->condition      = $request->condition;
        $competition->save();
        
        if(request('products') && ($request->condition_type == 'buy_products') ):
            $products = $request->input('products');
            array_shift($products);
            CompetitionProduct::where('competition_id' , $competition->id)->delete();
            foreach($products as $product):
                CompetitionProduct::updateOrCreate([
                    'competition_id' => $competition->id,
                    'product_id'     => $product
                ]);
            endforeach;
        endif;
        
        $links = $request->input('links');
        if(request('links') && ($request->condition_type == 'visit_link') ):
            CompetitionLinks::where('competition_id' , $competition->id)->delete();
            foreach($links as $link_in):
                CompetitionLinks::updateOrCreate([
                    'link'           => $link_in['link'],
                    'competition_id' => $competition->id
                ],[
                    'count_required' => $link_in['count_required']
                ]);
            endforeach;
        endif;
        
        return redirect()->route('dashboard.merchant.competitions.index')->with('success' , 'Competition Added succefully');
   
    }
     public function edit($id){
        $competition = Competition::with('competition_products','competition_products.product','competition_links')->where([
            'store_id' => auth()->user()->store()->first()->id,
            'id'       => $id
        ])->first();
        $products    = auth()->user()->store()->first()->products()->orderBy('id', 'DESC')->get();
        $context = ['title_page' => 'Competitions','products' => $products ,'competition'=>$competition ];
        return view('dashboard.competition.edit',$context);
    }
    
     public function update(Request $request,$id){
        //dd($request->all());
        //\Artisan::call('make:migration Competition');
        //\Artisan::call("migrate --path='database/migrations/2023_08_08_92555_create_competitions_table.php'");
        //\Artisan::call("migrate --path='database/migrations/2023_08_09_110308_create_competition_links_table.php'");
        $this->validate($request,[
            'name' => 'unique:competitions,name,'.$id
        ]);
        $competition = Competition::findOrFail($id);
        $auth_user = auth()->user();
        $competition->update([
            'user_id'        => $auth_user->id,
            'store_id'       => $auth_user->store_id,
            'name'           => $request->name,
            'description'    => $request->description,
            'prize'          => $request->prize,
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'condition_type' => $request->condition_type,
            'video_url'      => $request->video_url,
            'thumbnails'     => $request->input('thumbnails'),
            'slug'           => str_replace(' ','-',$request->name)
            // 'condition'      => $request->condition
        ]);
        
        if(request('products') && ($request->condition_type == 'buy_products') ):
            $products = $request->input('products');
            array_shift($products);
            //CompetitionProduct::where('competition_id' , $competition->id)->delete();
            $inserted_products = [];
            foreach($products as $product):
                $competiton_product = CompetitionProduct::updateOrCreate([
                    'competition_id' => $competition->id,
                    'product_id'     => $product
                ]);
                $inserted_products []= $competiton_product->id;
            endforeach;
            CompetitionProduct::whereNotIn('id',$inserted_products)->where('competition_id' , $competition->id)->delete();
        endif;
        
        $links = $request->input('links');
        if(request('links') && ($request->condition_type == 'visit_link') ):
            //CompetitionLinks::where('competition_id' , $competition->id)->delete();
            $inserted = [];
            foreach($links as $link_in):
                $competiton = CompetitionLinks::updateOrCreate([
                    'link'           => $link_in['link'],
                    'competition_id' => $competition->id
                ],[
                    'count_required' => $link_in['count_required']
                ]);
                $inserted []= $competiton->id;
            endforeach;
            CompetitionLinks::whereNotIn('id',$inserted)->where('competition_id' , $competition->id)->delete();
        endif;
        return redirect()->route('dashboard.merchant.competitions.index')->with('success' , 'Competition Updated succefully');
   
    }
    
    public function destroy($id)
    {
        $competition = Competition::findOrFail($id);
        $competition->delete();
        return redirect()->route('dashboard.merchant.competitions.index')->with('danger' ,'Car Deleted Succefully');
    }
    
    public function saveMedia(Request $request){
        $image = $request->file('file');
        $auth_user = auth()->user();
        if ($image != ""):
            $new_name = 'competition_' . $auth_user->store()->first()->domain . time() . Str::random(5) . '.' . $image->getClientOriginalExtension();
            $fullPath = public_path('stores_assets/' . $auth_user->store()->first()->domain . '/competition');
            $fullPathWithFile = 'stores_assets/' . $auth_user->store()->first()->domain . '/competition/' . $new_name;
            $image->move($fullPath, $new_name);
            return response()->json([
                'name' => $fullPathWithFile,
                'original_name' => $image->getClientOriginalName(),
            ]);
        endif;
    }
    
    public function removeMedia(Request $request){
        $result = File::delete(public_path($request->input('image_path')));
        return response()->json([
            'name'   => $request->input('image_path'),
            'result' => $result,
        ]);
    }
    
    public function competition_order_attach_customer(Request $request,$order_id){
        $order = Order::find($order_id);
        $competitor = Competitor::updateOrCreate([
            'mobile'         => $order->client->mobile,
            'competition_id' => $request->input('competition_id')
        ],[
            'client_id'      => $order->client->id,
        ]);
        
        
        return back()->with('success' , 'Client Added to Competitor successfully');
    }
    
    public function competitors_show($competition_id){
        $competition = Competition::with('winner','winner_visits_links')->find($competition_id);
        
        if($competition->condition_type == 'buy_products'):
            $competitors = Competitor::with('client','competition')->where([
                'competition_id' => $competition_id
            ])->get();
        else:
            $competitors = CompetitionJoin::with('competition','competition_link_visits','competition_link_visits.link_visits')->withCount('link_visits')->where([
                'competition_id' => $competition_id
            ])->get();
            
        endif;
        
    
        $context['competition']  = $competition;
        $context['competitors']  = $competitors;
        $context['title_page']   = 'Competitions';
        return view('dashboard.competition.competitors',$context);
    }
    
    public function choice_winner(Request $request,$competition_id){
        $competition = Competition::find($competition_id);
        if($competition->condition_type == 'buy_products'):
            $competitor = Competitor::with('client','competition')->where([
                'competition_id' => $competition_id
            ])->inRandomOrder()->take(request('count_winners'))->update([
                'winner' => 1 
            ]);
        else:
            
            $competitor = CompetitionJoin::where([
                'competition_id' => $competition_id
            ])->has('link_visits','>=',$competition->competition_links->sum('count_required'))->inRandomOrder()->take(request('count_winners'))->update([
                'winner' => 1 
            ]);
        endif;
        
        return back()->with('success' , 'Winner choiced  successfully');
    }
    
}

//Developer Muhamed Fawzy 3-12-2023