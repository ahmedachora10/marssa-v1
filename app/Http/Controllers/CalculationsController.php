<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CalculationsController extends Controller
{
    public function merchant_tools(){
        $context = [
          'title_page' => 'calculations',
        ];
        return view('dashboard.merchant_tools',$context);
    } 
    
    public function cost_estimation(){
        $context = [
          'title_page' => 'cost_estimation',
        ];
        return view('dashboard.cost_estimation',$context);
    }
    
    public function growth_rate(){
        $context = [
          'title_page' => 'growth_rate',
        ];
        return view('dashboard.growth_rate',$context);
    }
    
    public function result_cost_estimation(Request $request){
        $sales = $this->handle_serialize_data($request->all(),'data_cal_sales');
        $total_sales       = $this->calculata_cost_estimation($sales,'sales');
        $total_up_sell     = $this->calculata_cost_estimation($sales,'up_sell_to');
        
        
       return response()->json([
        'status'             =>number_format($this->total($total_sales,$total_up_sell)) . env('currency_symbol') ,
        'calculate_traffic'  =>$this->calculate_traffic($total_sales,$total_up_sell).' '.__('master.sales'),
        'total_traffic'      =>$this->total_traffic($total_sales,$total_up_sell) . env('currency_symbol'),
        'total_products_cost'=>number_format($this->total_products_cost($total_sales,$total_up_sell)) .env('currency_symbol') 
        ]);        
    }
    
    public function result_growth_rate(Request $request){
        $growth = $this->handle_serialize_data($request->all(),'data_cal_growth');
        $period = 1;
        $cal_profit_value_per_one_period = $growth['growth_capital'];
        if($growth['growth_type_of_calculate'] == 1){
           $growth['growth_count_of_months_years'] = $growth['growth_count_of_months_years'] * 12;   
        }
        while($period <= $growth['growth_count_of_months_years'] ){
            $cal_profit_value_per_one_period += ( $cal_profit_value_per_one_period *  $growth['growth_profit_per_period'] ) / 100; 
            $period++;
        }
        
        return response()->json([
           'status'=>number_format(round($cal_profit_value_per_one_period,2)) . env('currency_symbol') ,
        ]);  
    }
    
    public function handle_serialize_data($data,$field_name){
        $names  = array_map(function($value){
            return $value['name'];
        },$data[$field_name]);
        
        $values = array_map(function($value){
            return $value['value'];
        },$data[$field_name]);
        
        $sales = array_combine($names,$values);
        
        return $sales;
    }
    
    public function calculata_cost_estimation($sales,$prefix){
        if( $sales[$prefix.'_product_price'] == null ){
            return ['total'=>0,'calculate_sales'=>0,'calculate_traffic'=>0,'total_traffic'=>0];
        } 
        $calculate_sales   = ( $sales[$prefix.'_product_price'] - $sales[$prefix.'_product_cost'] );
        $calculate_traffic = ( ( $sales[$prefix.'_conversion_rate'] * $sales['traffic_count']) / 100 );
        if( $sales['traffic_price_visitor_or_group'] == 0 ):
            $total_traffic     = $sales['traffic_count'] * $sales['traffic_cpc'];   
        else:
            $total_traffic     = $sales['traffic_cpc'];
        endif;
        $total_products_cost   = $sales[$prefix.'_product_cost'] * $calculate_traffic;
        $total =  ($calculate_sales * $calculate_traffic ) - ( $total_traffic ); 
        if(!empty($sales['shipping_percentage'])):
           $total = ($total * $sales['shipping_percentage']) / 100;
        endif;
        return ['total'=>$total,'calculate_sales'=>$calculate_sales,'calculate_traffic'=>$calculate_traffic,'total_traffic'=>$total_traffic,'total_products_cost'=>$total_products_cost];
    }
    
    public function total($total_sale,$total_up_sell){
        $total  = $total_sale['total'] + $total_up_sell['total'];
        return $total;
    }
    
    public function calculate_traffic($total_sale,$total_up_sell){
        $calculate_traffic = $total_sale['calculate_traffic'] + $total_up_sell['calculate_traffic'];
        return $calculate_traffic;
    }
    
    public function total_traffic($total_sale,$total_up_sell){
        $total_traffic     = $total_sale['total_traffic'] + $total_up_sell['total_traffic']; 
        return $total_traffic ;
    }
    
    public function total_products_cost($total_sale,$total_up_sell){
        $total_products_cost     = $total_sale['total_products_cost'] + ( $total_up_sell['total_products_cost'] ?? 0); 
        return $total_products_cost ;
    }
    
    
}
