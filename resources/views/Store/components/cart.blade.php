@push('head')
    <style>
        .fixed_button {
            display: none;
        }

        @media (max-width: 700px) {
            .fixed_button {
                position: fixed;
                bottom: 0;
                z-index: 2;
                display: block;
                /* width: 100%;*/
            }
        }
        .background_buy_now_button{
            color: #fff!important;
            background-color: #28a745!important;
            border-color: #28a745!important;
        }
        .background_buy_now_button:hover{
            color: #fff !important;
            background-color: #218838 !important;
            border-color: #1e7e34 !important;
        }
        
        @media (max-width: 1124px){
            
        #cart_row {
            display: none !important;
        }
        }
        
        #cart_row {
            display: none;
        }
    </style>
@endpush
<section class="blog-one" id="products">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="table-responsive" id="table">
                <table class="table table-bordered">
                    <thead>
                   
                    </thead>

                    <tbody>

                    @forelse(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
                        <tr id="<?php echo $row->rowId; ?>">
                            <td>
                            <div class="d-flex justify-content-between" style="margin-bottom: 3px;">
                                <div class="d-flex justify-content-start">
                                    <div>
                                        @isset($row->options['image'])
                                        <img class="w-100" style="width: 100px !important;height: 80px;border-radius:50%;" src="{{asset($row->options['image'])}}">
                                        @endisset
                                    </div>
                                    <div style="padding-top: 20px;padding-left: 5px;padding-right: 5px;">
                                        <strong>
                                        <p><span><?php echo $row->name; ?></span></p>
                                        <i >{{$row->options['variant']  != 'single' ? $row->options['variant']  : ' '}}</i>
                                       {{-- <i >{{$row->options['variant_id'] }}</i>--}}
                                        </strong>
                                    </div>
                                </div>
                                <div >
                                <button onclick="CartAction('{{$row->options['delete_url']}}','{{$row->rowId}}','delete')" style="border-radius:50%;"
                                        type="submit" class="btn btn-danger btn-block"><i class="fa fa-times"></i>
                                </button>
                                </div>
                            </div>
                            <!--div class="d-flex justify-content-between">
                                 <div >
                                    {{__('master.product_qty')}}
                                </div>
                                <div>
                                    <p><span><?php echo $row->product_qty; ?></span></p>
                                </div>
                            </div-->
                            <div class="d-flex justify-content-between" style="margin-bottom: 3px;">
                                <div >
                                    {{__('master.qty')}}
                                </div>
                            <div>
                                <div class="input-group" style="width:100px;">
                                    <!--<span class="input-group-btn">-->
                                <!--  <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[<?php echo $row->rowId; ?>]">-->
                                    <!--      <span class="fa fa-minus"></span>-->
                                    <!--  </button>-->
                                    <!--</span>-->

                                    <span class="minus background_buy_now_button" style="border: 1px solid #dc3545  !important;
                                                                padding: 5px;
                                                                color: white !important;
                                                                background-color:#dc3545  !important;font-weight: 700;
                                                                cursor: pointer;">-</span>
                                    <input
                                            onchange="CartAction('{{$row->options['update_url']}}','{{$row->rowId}}')"
                                            id="qty_{{$row->rowId}}" name="quant[<?php echo $row->rowId; ?>]"
                                            class="form-control input-number"
                                            value="<?php echo $row->qty; ?>" min="1" max="10">
                                    <button class="plus background_buy_now_button" style="border: 1px solid #28a745 !important; 
                                                                padding: 5px;
                                                                color: white !important;
                                                                background-color:#28a745 !important;font-weight: 700;
                                                                cursor: pointer;">+
                                    </button>
                                    <!--<span class="input-group-btn">-->
                                <!--  <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[<?php echo $row->rowId; ?>]">-->
                                    <!--      <span class="fa fa-plus"></span>-->
                                    <!--  </button>-->
                                    <!--</span>-->
                                </div>
                            </div>
                            </div>
                            <div class="d-flex justify-content-between" style="margin-bottom: 3px;">
                                <div >
                                    {{__('master.product_price')}}
                                </div>
                            <div><?php echo $row->price; ?> {{$store->getCurrency()}}</td>
                            <div>
                            </div>
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-danger text-center">{{__('master.no_data')}}</div>
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
                </div>
                <div  id="cart_row">
                    <!--div class="d-flex justify-content-between">
                        <strong>{{__('master.product_image')}}</strong>
                        <strong>{{__('master.product_name')}}</strong>
                        <strong>{{__('master.product_quantity')}}</strong>
                        <strong>{{__('master.edit')}}</strong>
                        <strong>{{__('master.product_price')}}</strong>
                        <strong>{{__('master.delete')}}</strong>
                    </div-->
                <table  class="table table-bordered"> 
                    <tbody>
                        
                    @forelse(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
                    <tr  id="<?php echo $row->rowId; ?>">
                        <div class="d-grid justify-content-between " id="<?php echo $row->rowId; ?>" style="border: 1px solid #ccc;border-radius: 10px;padding: 4px;margin-bottom: 5px;">
                    <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                @isset($row->options['image'])
                                <img class="w-100" style="width: 100px !important;height: 100px;border-radius:50%;" src="{{asset($row->options['image'])}}">
                                @endisset
                                
                                <strong style="margin-top: 30px;margin-right: 5px;margin-left: 5px;">
                                    <p><span><?php echo $row->name; ?></span></p>
                                </strong>
                            </div>
                            <div>
                                <button onclick="CartAction('{{$row->options['delete_url']}}','{{$row->rowId}}','delete')" style="border-radius: 50%;"
                                        type="submit" class="btn btn-danger btn-block"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    <div class="d-flex justify-content-between">
                            <div>
                        <strong>{{__('master.product_price')}}</strong>
                            </div>
                            <div>
                            <strong><?php echo $row->price; ?> {{$store->getCurrency()}}</strong>
                            </div>
                        </div>
                    <div class="d-flex justify-content-between">
                        <div ><strong>{{__('master.product_quantity')}}</strong></div>
                        <div>
                            <strong>
                                <div class="input-group" style="width:130px;">
                                    <!--<span class="input-group-btn">-->
                                <!--  <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[<?php echo $row->rowId; ?>]">-->
                                    <!--      <span class="fa fa-minus"></span>-->
                                    <!--  </button>-->
                                    <!--</span>-->

                                    <span class="minus background_buy_now_button" style="border: 1px solid #dc3545  !important;
                                                                padding: 5px;
                                                                color: white !important;
                                                                background-color:#dc3545  !important;font-weight: 700;
                                                                cursor: pointer;">-</span>
                                    <input
                                            onchange="CartAction('{{$row->options['update_url']}}','{{$row->rowId}}')"
                                            id="qty_{{$row->rowId}}" name="quant[<?php echo $row->rowId; ?>]"
                                            class="form-control input-number"
                                            value="<?php echo $row->qty; ?>" min="1" max="10">
                                    <button class="plus background_buy_now_button" style="border: 1px solid #28a745 !important; 
                                                                padding: 5px;
                                                                color: white !important;
                                                                background-color:#28a745 !important;font-weight: 700;
                                                                cursor: pointer;">+
                                    </button>
                                    <!--<span class="input-group-btn">-->
                                <!--  <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[<?php echo $row->rowId; ?>]">-->
                                    <!--      <span class="fa fa-plus"></span>-->
                                    <!--  </button>-->
                                    <!--</span>-->
                                </div>
                            </strong>
                        </div>
                        </div>
                        </div>
                        </tr>
                    @empty
                    <tr>
                        <div class="d-flex justify-content-center">
                            <strong colspan="4">
                                <div class="alert alert-danger text-center">{{__('master.no_data')}}</div>
                            </strong>
                        </div>
                        </tr>
                    @endforelse

                    </tbody>
                </table>

                    </div>
              
                <div class="input-group">

                    <input type="text"
                           id="promo_code" class="form-control background_buy_now_button"
                           style="background-color: #ffffff!important; border: 2px solid; color: black;"
                           value="{{session('promo_code')}}" required>
                    <span class="input-group-btn">
                                <button type="button" {{$empty}} onclick="RemovePromoCode(this)" id="RemovePromoCode"
                                        class="btn btn-danger d-none">
                                  <span class="fa fa-times"></span> {{__('master.remove_promo_code')}}
                                </button>
                                <button type="button" {{$empty}} onclick="ApplyPromoCode(this)" id="ApplyPromoCode"
                                        class="background_buy_now_button btn btn-success d-none"
                                        style="color: white!important;">
                                  <span class="fa fa-plus"></span> {{__('master.add_promo_code')}}
                                </button>
                        </span>

                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="table-responsive">
                <table class="table table-bordered">
                    <tfoot class="text-center">
                    <tr>
                        <td colspan="3">
                            <a class="btn btn-success btn-block background_check_out_buy_now_button BuyNowCartButtonBackGround1  {{$empty}}"
                               href="{{url('/checkout')}}">{{__('master.pay')}}</a>
                        <!-- <a class="btn btn-success btn-block   background_buy_now_button {{$empty}}" href="{{url('/checkout')}}">{{__('master.pay')}}</a>-->
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __('master.Subtotal') }}</td>
                        <td colspan="2"
                            id="subTotal"><?php echo round(\Gloudemans\Shoppingcart\Facades\Cart::subtotal()); ?> {{$store->getCurrency()}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('master.discount') }}</td>
                        <td colspan="2"
                            id="Promo"><?php echo round(\Gloudemans\Shoppingcart\Facades\Cart::getCost('promo')); ?> {{$store->getCurrency()}}</td>
                    </tr>
                    <tr>
                        <td>{{__('master.Shipping_fee')}}</td>
                        <td colspan="2"
                            id="shipping"><?php echo round(Cart::getCost(\Gloudemans\Shoppingcart\Cart::COST_SHIPPING)); ?> {{$store->getCurrency()}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('master.Total') }}</td>
                        <td colspan="2">
                            <span id="Total"><?php echo round(\Gloudemans\Shoppingcart\Facades\Cart::total()); ?> {{$store->getCurrency()}}</span>
                        </td>
                    </tr>

                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
    <tr>
        <td colspan="3">
            <a class="fixed_button btn btn-success btn-block background_check_out_buy_now_button BuyNowCartButtonBackGround1  {{$empty}}"
               href="{{url('/checkout')}}">{{__('master.pay')}}</a>
        <!--   <a style="position:" class="btn btn-success btn-block   background_buy_now_button {{$empty}}" href="{{url('/checkout')}}">{{__('master.pay')}}</a>-->
        </td>
    </tr>
</section>
