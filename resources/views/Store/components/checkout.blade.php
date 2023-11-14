@push('head')

    <style>
        .checkout-section .checkout .main, .checkout-section .checkout .sidebar {
            flex: 1 0 auto;
        }
        .checkout-section .all-in-one .sidebar .aside-body {
            padding: 0;
            background-color: transparent;
            border-radius: 0;
        }
        .checkout-section .checkout .sidebar .aside-body .aside-total h4 {
            display: flex;
            align-content: center;
            justify-content: space-between;
            font-size: 16px;
            font-weight: 500;
        }
        
        .sidebar .aside-body .aside-total h4 {
            font-size: 22px !important;
            font-weight: 600 !important;
        }
        .checkout-section .checkout .sidebar .aside-body .aside-products li {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        .sidebar .aside-body .aside-products li {
            display: -webkit-box;
            display: flex;
            -webkit-box-align: start;
            align-items: flex-start;
            -webkit-box-pack: justify;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 0px;
            margin-left: 10px;
            margin-right: 10px;
        }ئ
        .checkout-section .checkout .sidebar {
            width: 100%;
        }
        .checkout-section .checkout .sidebar .aside-body .aside-products li .product-thumbnail {
            display: flex;
            align-content: center;
            justify-content: center;
            position: relative;
            width: 65px;
            height: 65px;
        }
        .checkout-section .checkout .sidebar .aside-body .aside-products li .product-thumbnail .product-quantity {
            position: absolute;
            top: -12px;
            min-width: 24px;
            height: 24px;
            font-size: 12px;
            font-weight: 500;
            line-height: 24px;
            color: #fff;
        }
        .checkout-section .app-heading {
            margin: 0 0 24px;
        }
        .checkout-section {
            padding: 30px 0;
            }
        .checkout-section .app-heading p.heading-primary {
            font-family: Cairo, sans-serif !important;
            text-align: center;
        }
        .checkout-section .app-heading .heading-primary {
            text-align: center;
        }
        .app-heading .heading-primary {
            font-size: 26px;
            line-height: 36px;
        }
        .app-heading .heading-primary {
            font-size: 26px;
            line-height: 36px;
        }
        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }
        .product-quantity {
            border-radius: 50%;
            background-color: #159393;
            text-align: center;
            left: -10px;
            box-shadow: 3px 5px 3px #087621;
        }
        .btn-block {
            display: block;
            width: 100%;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .nav-fill .nav-item {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            text-align: center;
        }.nav-tabs .nav-link{
            
            color: #000;
            width:100%;
        }.nav-tabs .nav-link.show,.nav-item.active ,.nav-item.show{
            background-color: #fff !important;
            border-color: #e8e2d0 !important;
            
        }
        .nav-tabs .nav-link.show {
            color: #000;
            width:100%;
            background-color: #e8e2d0 !important;
            border-color: #e8e2d0 !important;
            border-width: 3px;
            border-bottom: 0px solid white;
            border-radius: 0px;
            margin-bottom: -2px;
        }
        .create-order-form .form-group label {
            font-family: Cairo, sans-serif !important;
            color: #b03760;
        }
        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            color: #fff;
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-group-lg>.btn, .btn-lg {
            padding: 0.5rem 1rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: 0.3rem;
        }
        .background_buy_now_button {
            animation-name: bayButton;
            animation-duration: 1s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }
        .background_buy_now_button {
            cursor: pointer !important;
            border: solid 2px #28a745  !important;
            background: #e6e6e88f;
            background-color: #28a745  !important;
            color: white;
            padding: 8px 10px !important;
        }
        .checkout-section .checkout .sidebar .aside-body .aside-products li .product-info {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            width: calc(100% - 80px);
        }
        .checkout-section .checkout .sidebar .aside-body .aside-products li .product-info .product-title {
            display: block;
            color: inherit;
            font-weight: 500;
        }
        .checkout-section .checkout .sidebar .aside-body .currency-value {
            color: #313131;
            font-weight: 500;
        }
        .currency-value .currency, .currency-value .value, .currency-value small {
            font-size: inherit;
        }
        .checkout-section .checkout .sidebar .aside-body .aside-total-details {
            margin: 15px 0;
            padding: 15px 0;
            border-top: 1px solid #e5e5e5;
            border-bottom: 1px solid #e5e5e5;
        }
        .checkout-section .checkout .sidebar .aside-body .aside-total-details {
            margin: 15px 0;
            padding: 15px 0;
            border-top: 1px solid #e5e5e5;
            border-bottom: 1px solid #e5e5e5;
        }
        .checkout .main .tab-content {
            background-color: #fff;
            padding: 27px;
            border: 4px solid #e8e2d0;
        }
        .btn-info {
            background-color: transparent !important;
            border-color: transparent !important;
            color: black !important;
        }
        .checkout-section .checkout .sidebar .aside-body .aside-total-details li {
            display: flex;
            align-content: center;
            justify-content: space-between;
            margin-left: 10px;
        margin-right: 10px;
        }
        .checkout-section .checkout .sidebar .aside-body .aside-total-details li .title {
            color: #525252;
            font-weight: 500;
            font-family: dinnextltw23,'sans-serif'!important;
        }
        .checkout-section .checkout .sidebar .aside-body .currency-value {
            color: #313131;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }
        .currency-value {
            display: inline-flex;
            align-items: center;
        }
        .all-in-one .all-in-one-step {
            border: 1px solid #e5e5e5;
            border-radius: 5px;
        }
        .checkout-section .checkout {
            display: flex;
            flex-wrap: wrap;
            flex: 1 0 auto;
        }
        .checkout-section .all-in-one .main {
            display: grid;
            grid-gap: 20px;
        }
        .checkout-section .checkout .main, .checkout-section .checkout .sidebar {
            flex: 1 0 auto;
        }
        .checkout-section .all-in-one .all-in-one-step.expanded .all-in-one-header {
            border-radius: 5px 5px 0 0;
            border-bottom: 1px solid #e5e5e5;
        }
        .checkout-section .all-in-one .all-in-one-step .all-in-one-header h5 .step-title {
            font-size: 16px;
            font-weight: 500;
        }
        .checkout-section .all-in-one .all-in-one-step .all-in-one-header h5 .step-number {
            width: 50px;
            height: 50px;
            line-height: 50px;
            font-size: 18px;
            color: #c6c6c6;
        }
        .checkout-section .all-in-one .all-in-one-step .all-in-one-header h5 .step-number {
            text-align: center;
            background-color: #f1f1f1;
        }
        .checkout-section .all-in-one .all-in-one-step .all-in-one-header h5 .step-number {
            border-radius: 0 5px 0 0;
            margin: 0 0 0 15px;
            border-left: 1px solid #e5e5e5;
        }
        .checkout-section .all-in-one .all-in-one-step .all-in-one-header h5 {
            font-size: 22px !important;
            font-weight: 600 !important;
        }
        .checkout-section .all-in-one .all-in-one-step .all-in-one-header h5 {
            display: flex;
            align-items: center;
        }
        .all-in-one-header h5 {
            margin: 0px;
        }
        @media (min-width: 1124px)
        {
            .checkout-section .checkout .sidebar {
                top: 130px;
            }
        }
        @media (min-width: 768px){
            .checkout-section .checkout .sidebar {
                position: sticky;
                width: 40%;
            }
            .checkout-section .checkout {
                align-items: flex-start;
                justify-content: space-between;
            }
            .checkout-section .checkout .main {
                width: 60%;
            }
        }
        #RemovePromoCode, #ApplyPromoCode {
            height: 100%;
            font-size: 18px;
        }

        #promo_code {
            border: 2px solid #a4bda5;
            border-radius: 5px;
        }

        .heading-description {
            font-size: 18px;
            font-weight: 600;
        }

        .all-in-one-body {
            font-size: 18px;
        }

        .sidebar .aside-body .aside-total h4 {
            font-size: 22px !important;
            font-weight: 600 !important;
        }

        .checkout-section .all-in-one .all-in-one-step .all-in-one-header h5 {
            font-size: 22px !important;
            font-weight: 600 !important;

        }

        [dir] button, [dir] input[type=submit] {
            background-color: #17a2b8;
        }

        .show-promo-code {
            margin-top: 12px !important;
            margin-right: 10px !important;
        }

        .fields-promo-code {
            display: none !important;
            padding: 17px;
        }

        .fields-promo-code.show {
            display: flex !important;
        }

        #RemovePromoCode, #ApplyPromoCode {
            font-size: 18px;
            padding: 10px 18px;
            margin: 0px 17px;
        }
    </style>
@endpush

<main class="page-wrapper">
    <section class="section checkout-section">
        <div class="container">
            <div class="app-heading">
                <h1 class="heading-primary">{{__('master.pay')}}</h1>
                <p class="heading-primary">{{__('master.payment_data_msg')}}</p>
                
                    @if (Session::has('errors'))
                        <div class="alert alert-success" role="alert">
                            {{__('master.max_orders_count') }}
                        </div>
                    @endif
            </div>
            <div class="all-in-one">
                <div class="checkout"   >
                    <div class="main" id="pay" tabindex="-1">
                        <div class="col-md-12 col-sm-12">
                            <p class="Select_one_of_payment">
                                <strong class="text-danger"
                                        style="font-size: 20px;">{{__('master.Please_Select_one_of_payment_methods_below')}}</strong>
                            </p>
                            <ul class="nav nav-tabs nav-fill" >
                                @if($store->payment_methods['Paiement_when_receiving']['Paiement_when_receiving_status'] == 1)
                                    <li class="nav-item active show">
                                        <a class="nav-link show btn" id="Paiement_when_receiving-tab" data-toggle="pill"
                                           href="#Paiement_when_receiving" role="tab"
                                           aria-controls="Paiement_when_receiving"
                                           aria-selected="true">
                                            <span class="btn btn-info btn-block" style="font-size: 20px;">{{__('master.Paiement_when_receiving')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if($store->payment_methods['Bank_transfer']['Bank_transfer_status'] == 1)
                                    <li class="nav-item">
                                        <a class="nav-link btn" id="Bank_transfer-tab" data-toggle="pill"
                                           href="#Bank_transfer" role="tab"
                                           aria-controls="Bank_transfer" aria-selected="false">
                                            <span class="btn btn-info btn-block" style="font-size: 20px;">{{__('master.Bank_transfer')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if($store->payment_methods['Bankily']['Bankily_status'] == 1)
                                    <li class="nav-item">
                                        <a class="nav-link btn" id="Bankily-tab" data-toggle="pill" href="#Bankily"
                                           role="tab"
                                           aria-controls="Bankily" aria-selected="false">
                                            <span class="btn  btn-block" style="font-size: 20px;">{{__('master.Bankily')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if($store->payment_methods['paypal']['paypal_status'] == 1)
                                    <li class="nav-item">
                                        <a class="nav-link btn" id="PayPal-tab" data-toggle="pill" href="#PayPal"
                                           role="tab"
                                           aria-controls="PayPal" aria-selected="false">
                                            <span class="btn btn-info btn-block">{{__('master.PayPal')}}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                @if($store->payment_methods['Paiement_when_receiving']['Paiement_when_receiving_status'] == 1)
                                    <div class="tab-pane fade active show" id="Paiement_when_receiving" role="tabpanel"
                                         aria-labelledby="Paiement_when_receiving-tab">
                                        <br>
                                        @include('Store.components.Paiement_when_receiving',['bg_color'=>$bg_color ,'color'=>'#fff'])
                                        <br>
                                    </div>
                                @endif
                                @if($store->payment_methods['Bank_transfer']['Bank_transfer_status'] == 1)
                                    <div class="tab-pane fade" id="Bank_transfer" role="tabpanel"
                                         aria-labelledby="Bank_transfer-tab">
                                        <br>
                                        @include('Store.components.Bank_transfer',['bg_color'=>$bg_color,'color'=>'#fff'])
                                        <br>
                                    </div>
                                @endif
                                @if($store->payment_methods['Bankily']['Bankily_status'] == 1)
                                    <div class="tab-pane fade " id="Bankily" role="tabpanel"
                                         aria-labelledby="Bankily-tab">
                                        <br>
                                        @include('Store.components.Bankily',['bg_color'=>$bg_color,'color'=>'#fff'])
                                        <br>
                                    </div>
                                @endif
                                @if($store->payment_methods['paypal']['paypal_status'] == 1)
                                    <div class="tab-pane fade" id="PayPal" role="tabpanel" aria-labelledby="PayPal-tab">
                                        <br>
                                        @include('Store.components.paypal',['bg_color'=>$bg_color,'color'=>'#fff'])
                                        <br>
                                    </div>
                                @endif
                            </div>

                        </div>

                    </div>
                    <div class="sidebar">
                        <div class="all-in-one-step expanded">
                            @if (isset($store->paymentNote->value))
                                <div class="all-in-one-header">
                                    <div class="input-group">
                                        <div class="form-control background_check_out_buy_now_button"
                                             style="background-color: #ffffff!important;  color: black">
                                            {{ $store->paymentNote->value }}
                                        </div>
                                        <i class="fas fa-hand-point-right " style="color: {{$bg_color ?? '#17a2b8'}}; font-size: 35px;"></i>
                                    </div>
                                </div>
                            @endif
                            <div class="all-in-one-header">
                                <p href="#"
                                   class="btn btn-info show-promo-code" style="margin: 10px;">
                                    {{ __('site.have_promo_code_?') }}</p>
                                <div class="input-group fields-promo-code">
                                    <input type="text"
                                           id="promo_code" class="form-control background_check_out_buy_now_button"
                                           style="background-color: #ffffff!important;  color: black"
                                           value="{{session('promo_code')}}"
                                           required>
                                    <span class="input-group-btn">
                                        <button type="button" onclick="RemovePromoCode(this)" id="RemovePromoCode"
                                                class="btn btn-danger d-none " style="background-color: #dc3545">
                                        <span class="fa fa-times"></span> {{__('master.remove_promo_code')}}
                                        </button>
                                        <button type="button" onclick="ApplyPromoCode(this)" id="ApplyPromoCode"
                                                class="background_buy_now_button btn btn-success d-none">
                                        <span class="fa fa-plus"></span> {{__('master.add_promo_code')}}
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="all-in-one-header"><h5><span class="step-number">{{$number}}</span><span
                                            class="step-title">{{__('master.order_summery')}}</span></h5></div>
                            <div class="all-in-one-body">
                                <aside class="sidebar" style="width: 100%;"><!---->
                                    <div class="aside-body active"><!---->

                                        <ul class="list-unstyled aside-products">
                                            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)

                                                <li style="margin: 10px;">
                                                    <div class="product-thumbnail">
                                                        @isset($row->options['image'])
                                                            <img src="{{asset($row->options['image'])}}" style=""
                                                                 alt="">
                                                        @endisset
                                                        <span class="background_buy_now_button product-quantity "><?php echo $row->qty; ?></span>
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="" class="product-title">
                                                       <div style="display:grid;">
                                                            <p style="margin-bottom: 1px;"><?php echo $row->name; ?></p>
                                                            <p style="margin-bottom: 1px;">
                                                                @if(!empty($row->options['variant']) && !empty($row->options['variant_id'] ))
                                                            
                                                            @if($row->options['variant'] !='single' )
                                                            {{$row->options['variant'] }}
                                                            
                                                            @endif
                                                            @endif</p>
                                                       </div>
                                                        <!---->  </a>
                                                        <span class="product-price currency-value">
                                                        <span class="value"><?php echo $row->price; ?></span>
                                                        <span class="currency">&nbsp;{{$store->getCurrency()}} </span>
                                                    </span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <ul class="list-unstyled aside-total-details">
                                            <li>
                                                <span class="title">{{ __('master.Subtotal') }} </span>
                                                <span class="currency-value">
                                                    <span id="subTotal"
                                                          class="value"><?php echo round(\Gloudemans\Shoppingcart\Facades\Cart::subtotal()); ?> {{$store->getCurrency()}}</span>
                                                    <span class="currency">&nbsp;</span>
                                                </span>
                                            </li> <!---->
                                            <li>
                                                <span class="title">{{ __('master.discount') }} </span>
                                                <span class="currency-value">
                                                    <span id="Promo"
                                                          class="value"><?php echo round(\Gloudemans\Shoppingcart\Facades\Cart::getCost('promo')); ?> {{$store->getCurrency()}}</span>
                                                    <span class="currency">&nbsp; </span>
                                                </span>
                                            </li> <!---->
                                            <li>
                                                <span class="title">{{__('master.Shipping_fee')}} </span>
                                                <span class="currency-value">
                                                    <span id="shipping"
                                                          class="value"><?php echo round(Cart::getCost(\Gloudemans\Shoppingcart\Cart::COST_SHIPPING)); ?> {{$store->getCurrency()}}</span>
                                                    <span class="currency">&nbsp; </span>
                                                </span>
                                            </li> <!---->
                                        </ul>
                                        <div class="aside-total" style="margin: 10px;">
                                            <h4><span class="title">{{ __('master.Total') }} </span>
                                                <span id="Total" class="currency-value"><span
                                                            class="value"><?php echo round(\Gloudemans\Shoppingcart\Facades\Cart::total()); ?></span>
                                            <span class="currency">&nbsp;{{$store->getCurrency()}} </span></span></h4>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@push('script')
 {{--<form method="POST" action="{{ url('abandoned_cart') }}">
     @csrf
     <button class="btn btn-success" type="submit">test</button>
 </form>--}}
 <script>
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery(document).ready(function(){
        let data = [];
        jQuery('form.create-order-form input').blur(function(){
            jQuery('form.create-order-form').serializeArray().forEach(function(field,key){
                 if(field.value == ''){
                     return;
                 }
                 
                 if(field.name == '_token'){
                     return;
                 }
                 
                 if(field.name == '_method'){
                     return;
                 }
                 
                 data[field.name] = field.value;
            });
            
            if(data.mobile != null){
                jQuery.ajax({
                    beforeSend: function (xhr) {
            			xhr.setRequestHeader("Accept", "application/json");
            	    },
                    headers: {
                       'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
                       'Accept'      : 'application/json'
                    },
                    url:"{{ url('abandoned_cart') }}",
                    type:'POST',
                    dataType: 'json',
                    data : {
                        "_token"   :"{{ csrf_token() }}",
                        "name"     : data.name || null,
                        "mobile"   : data.mobile || null,
                        "address"  : data.address || null,
                    },
                    cache: false,
                    crossDomain: false,
                    success:function(data){
                      jQuery('input[name="abandoned_order"]').val(data);
                    },
                    error:function(jqXHR, textStatus, errorThrown){
                      console.log(errorThrown);
                    }
                });
            }
        });
    });
 </script>
@endpush
