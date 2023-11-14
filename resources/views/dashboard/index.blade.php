@extends('dashboard.master')

@section('index')
    current
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/styles/store_settings.css') }}">

    <style>
        tspan {
            font-family: DINN-Medium;
        }

        .store-item__plan {
            background: #fff url("{{ asset('site/images/bg.png') }}") no-repeat top left;
            background-size: 80% auto;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .05);
            transition: transform .2s;
        }

        .plan1 {
            background: url({{ asset('site/images/sparkles.svg') }}) no-repeat
        }

        .plan2 {
            background: url({{ asset('site/images/plan-plus.png') }}) no-repeat
        }

        .plan3 {
            background: url({{ asset('site/images/falling-star.svg') }}) no-repeat
        }

        .plan2_color {
            color: #764aaf !important;
        }

        .plan3_color {
            color: #55ccfc !important;
        }

        .store-setup-item {
            height: auto !important;
        }

        .store-setup-item button {
            background: #e63546;
        }

        .video {
            position: fixed;
            width: 100%;
            height: 100vh;
            z-index: 31;
            margin-top: 30px;
        }

        .close_video {
            z-index: 32;
            background: white;
            color: black;
            position: relative;
            top: 0px;
            left: 0px;
            cursor: pointer;
            width: 30px;
            display: flex;
        }

        .close_video label {
            margin: auto;
        }

        .close_video_band {
            width: 100%;
            height: 30px;
            opacity: 50%;
            background: black;
            z-index: 31;
            position: fixed;
            top: 0px;
            display: flex;
            display: none;
        }

        .icon {
            color: #9A33C7;
            font-size: 80px;
        }

        .store-setup-desc {
            background: #f04c5c;
            color: white;
            border: none;
            padding: 5px;
            box-shadow: 2px 2px 2px grey;
            margin-bottom: 10px;
            width: -webkit-fill-available;
            margin: 5px;

        }

        .quick_set {
            flex: 1;
        }


        .alert2 {
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
            background: #f04c5c;
            color: white;
        }

        .alert2 a {
            color: white;
        }

        .alert2 .close {
            color: black;
        }

        .alert2 i {
            border: 2px solid white;
            border-radius: 50px;
            padding: 7px;
            width: 35px;
            text-align: center;
        }

        @media (max-width: 700px) {
            .col-xs-6 {
                width: 100%;
            }
        }
    </style>

@endsection

@section('content')
    @php
        $store_ = auth()->user()->store;
        $subscribes = $store_->subscribes;
        $subscribe_ = count($subscribes) >= 1 ? $subscribes[count($subscribes)-1] : null;
        $subscribe_deadline_ = false;
        if ($subscribe_ != null) {
            if (\Carbon\Carbon::parse($subscribe_->deadline) < now()) {
                $subscribe_deadline_ = true;
            }
        }
    @endphp

    
    <div class="row small-spacing">
        <div class="col-xs-12">
            @if (session('message'))
                <div class="row">
                    <div class="small-spacing">
                        <div class="col-xs-12">
                            <div
                                    class="alert @if(session('message') == 'payment_failed') alert-error @else alert-success @endif alert-dismissible"
                                    role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ __('master.'.session('message')) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        @if($subscribe_deadline_)
            <div class="col-xs-12">
                @if($subscribe_deadline ?? false or $user_plan == null )
                    <div class="row">
                        <div class="small-spacing">
                            <div class="col-xs-12">
                                
                                <div
                                        class="alert @if($subscribe_deadline ?? false) alert-error @else alert-success @endif alert-dismissible"
                                        role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>
                                        @if($subscribe_deadline ?? false)
                                            {{ __('master.activate_store_again') }}
                                        @else
                                            {{ __('master.activate_store') }}
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="container-fluid margin-bottom-20">
                    <div class="store-heading">
                        <h6 class="">
                            <i class="sicon-shopping-bag2"></i>{{ __('site.choose_package') }}
                        </h6>
                    </div>
                    <div class="row">
                        <div>
                            <h3>
                                @if(app()->getLocale() == 'ar')
                                    الرجاء. اختيار طريقة الاشتراك المناسبة لك ، 

                                @else
                                    Please choose the best way to choose package
                                @endif
                            </h3>
                        </div>
                        <div class="col-md-12">
                            
                            
                            <div class="store-row plans-row text-center">
                               <a href="{{ route('dashboard.choose-dashboard','commissions') }}" class="btn btn-info" style="margin-right:15px;margin-left:15px;"> 
                                    <h4>
                                        @if(app()->getLocale() == 'ar')
                                           باقة العمولات
                                        @else
                                            Commission Packages
                                        @endif
                                    </h4>
                                </a>
                                
                                 <a href="{{ route('dashboard.choose-dashboard','months-packages') }}" class="btn btn-info"> 
                                    <h4>
                                        @if(app()->getLocale() == 'ar')
                                           الباقات الشهرية
                                        @else
                                            Monthly Packages
                                        @endif
                                    </h4>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        @endif
        
        @if(isset($subscribe_max_indebtedness) && $subscribe_max_indebtedness == true )
            <div class="col-xs-12">
                
                 <div class=""
                 style="margin-bottom: 20px;     background-color: #ffffff;         border: 2px solid #e8eeee;">
                      <h4 class="text-danger" style="padding-left:5px;padding-right:5px;padding-top:15px;">
                            <i class="sicon-shopping-bag2"></i>{{ __('site.max_indebtedness_alert') }}
                        </h4>
                        <hr>
                        <p style="padding-left:5px;padding-right:5px;">
                            {{ __('site.your_indebtedness') }} : {{ auth()->user()->store->indebtedness }} (أوقية)  
                        </p>
                        
                        <p style="padding-left:5px;padding-right:5px;">
                             {{ __('site.max_indebtedness') }} : {{ auth()->user()->store->plan->max_indebtedness }}  (أوقية)   
                        </p>
                        
                        <div style="padding-left:5px;padding-right:5px;padding-bottom:10px">
                            @if(auth()->user()->wallet_total  >=  auth()->user()->store->indebtedness)
                                <a href="{{ route('dashboard.admin.pay_commission') }}" class="btn btn-success btn-sm ">
                                    {{ app()->getLocale() =='ar' ? 'إدفع من خلال المحفظة' : 'Pay with wallet' }}
                                </a>
                            @else
                                <p class="text-muted">
                                    @if(app()->getLocale() =='ar') 
                                        قم بشحن رصيد للمحفظة اولا ثم قم بدفع العمولة المستحقة <a href="{{route('dashboard.admin.wallet')}}">من هنا</a>
                                    @else
                                        Recharge your wallet balance first then pay the paybale commission <a href="{{ route('dashboard.admin.wallet') }}"> from here </a>
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
            </div>
        @endif
        
    </div>
    <div class="row">
        <div class="col-lg-8 col-xs-12">
            @if(env('show_credits') == true)
                    <div>
                     <ul style="list-style: none; padding:0;">
                 @if(auth()->user()->store->plan->is_commission == 1 && env('show_credits') == true) 
                    
                    <li class="">
               

                    <a class="" style="color:black !important;font-size:20px" href="{{ route('dashboard.admin.wallet') }}">
                        <i class="fas fa-money-bill-alt" style="font-size: 12px;"></i> 
                        <small>
                            @if(app()->getLocale() == 'ar')
                                 العمولة المستحقة
                            @else
                                Payable Commission
                            @endif
                        </small>
                        (<b class="text-danger ">{{ auth()->user()->store->indebtedness }}</b>)
                        <small>أوقية</small>
                    </a>
                </li>
                
               
                
                
               
                     
                @endif
                
                <li class="">
               

                    <a class="" style="color:black !important;font-size:20px" href="{{ route('dashboard.admin.wallet') }}">
                        <i class="fas fa-money-bill-alt" style="font-size: 12px;"></i> 
                        <small>
                            @if(app()->getLocale() == 'ar')
                                الرصيد
                            @else
                                Balance
                            @endif
                        </small>
                        (<b class="text-success ">
                            {{ auth()->user()->wallet_total }}
                        </b>)
                        <small>أوقية</small>
                    </a>
                </li>
                
            </ul>
                </div>
            @endif
            <div class=""
                 style="margin-bottom: 20px;     background-color: #ffffff;         border: 2px solid #e8eeee;">
    
                <div class="row text-center">
                    <div class=" col-4 col-sm-4 ">
                        <a href="{{route('dashboard.admin.orders.index')}}">
                            <div class="">
                                <h3>{{ __('master.orders') }}</h3>
                                <div class="imag_container">
    
                                    <i class="fas fa-shopping-basket icon"></i>
                                </div>
                                <span>
                                    <strong>{{$counters['orders']}}</strong>
                            </span>
                            </div>
                        </a>
                    </div>
                    @role('User|SubUser')
                    {{--<div class=" col-4 col-sm-4 ">
                        <a href="{{route('dashboard.admin.wallet')}}">
                            <div class="">
                                <h3>{{ __('master.wallet') }}</h3>
                                <div class="imag_container">
                                    <i class="fas fa-wallet icon"></i>
                                </div>
                                <span>
                                    <strong>{{$wallet_total }}</strong>
                            </span>
                            </div>
                        </a>
                    </div>--}}
                    <div class=" col-4 col-sm-4 ">
                        <a href="{{route('dashboard.admin.orders.index')}}">
                            <div class="">
                                <h3>{{ __('master.sales') }}</h3>
                                <div class="imag_container">
                                <!--<img class="img_edit" src="{{asset("images/icon/basket-icon.png")}}" alt="">-->
                                    <i class="fas fa-money-check-alt  icon"></i>
                                </div>
                                <span>
                                    <strong>{{$orders->sum('amount')}}</strong>
                            </span>
                            </div>
                        </a>
                    </div>
                    @endrole
                    <div class=" col-4 col-sm-4 ">
                        <a href="{{route('dashboard.admin.products.index')}}">
    
                            <div class="">
                                <h3>{{ __('master.products') }}</h3>
                                <div class="imag_container">
                                <!--<img src="{{asset("images/icon/Group 25.png")}}" alt="">-->
                                    <i class="fas fa-boxes icon"></i>
                                </div>
                                <span>
                                    <strong>{{$counters['products']}}</strong>
    
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class=" col-4 col-sm-4 ">
                        <a href="{{route('dashboard.admin.clients')}}">
    
                            <div class="">
                                <h3>{{ __('master.clients') }}</h3>
                                <div class="imag_container">
                                <!--<img src="{{asset("images/icon/groupe.png")}}" alt="" style="">-->
                                    <i class="fas fa-users icon"></i>
                                </div>
                                <span>
                                    <strong>{{$counters['clients']}}</strong>
                                </span>
                            </div>
                        </a>
                    </div>
                    @role('User|SubUser')
                    <div class=" col-4 col-sm-4 ">
                        <a href="{{route('dashboard.admin.landing_pages.orders')}}">
                            <div class="">
                                <h3>{{ __('master.landing_pages') . ' '. __('master.sales') }}</h3>
                                <div class="imag_container">
                                <!--<img class="img_edit" src="{{asset("images/icon/basket-icon.png")}}" alt="">-->
                                    <i class="fas fa-money-check-alt  icon"></i>
                                </div>
                                <span>
                                    <strong>{{ $lpo_total}}</strong>
                            </span>
                            </div>
                        </a>
                    </div>
                    <div class=" col-4 col-sm-4 ">
                        <a href="{{route('dashboard.admin.landing_pages.index')}}">
    
                            <div class="">
                                <h3>{{ __('master.landing_pages') .' '. __('master.products') }}</h3>
                                <div class="imag_container">
                                <!--<img src="{{asset("images/icon/Group 25.png")}}" alt="">-->
                                    <i class="fas fa-boxes icon"></i>
                                </div>
                                <span>
                                    <strong>{{\App\ProductOffer::where('store_id',$store_->id)->count()}}</strong>
    
                                </span>
                            </div>
                        </a>
                    </div>
                    @endrole
                </div>
            </div>
    
    
            {{--                    <div class="row">--}}
            {{--                        <div class="col-lg-4 col-md-6 col-xs-12">--}}
            {{--                            <div class="box-content">--}}
            {{--                                <div class="statistics-box ">--}}
            {{--                                    <img class="img_edit float-left" src="{{asset("images/icon/Group 26.png")}}" alt="">--}}
            {{--                                    <h2 class="counter text-success">{{$counters['orders']}} </h2>--}}
            {{--                                    <p class="text">{{ __('master.orders') }}</p>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-4 col-md-6 col-xs-12">--}}
            {{--                            <div class="box-content">--}}
            {{--                                <div class="statistics-box with-icon">--}}
            {{--                                    <i class="ico text-inverse"><i class="icon-online-shop"></i></i>--}}
            {{--                                    <h2 class="counter text-inverse">{{$counters['products']}} </h2>--}}
            {{--                                    <p class="text">{{ __('master.products') }}</p>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-4 col-md-6 col-xs-12">--}}
            {{--                            <div class="box-content">--}}
            {{--                                <div class="statistics-box with-icon">--}}
            {{--                                    <i class="ico text-info"><i class="icon-users"></i></i>--}}
            {{--                                    <h2 class="counter text-info">{{$counters['clients']}} </h2>--}}
            {{--                                    <p class="text">{{ __('master.clients') }}</p>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
    
            <div class="col-xs-12">
                <div class="panel panel-default panel-small-title min-height">
                    <div class="panel-heading ">
                        <h6 class="panel-title">
                            {{ __('master.orders_number') }}
                        </h6>
                    </div>
                    <div>
                        <div id="orders_sum">
                            <table class="table table-striped margin-bottom-10" style="margin-top:40px;">
    
                            <!--  <thead>
                                                        <tr>
                                                            <th class="w-1/5 uppercase font-thin">{{ __('master.today') }}</th>
                                                            <th class="w-1/5 uppercase font-thin">{{ __('master.yesterday') }}</th>
                                                            <th class="uppercase font-thin">{{ __('master.this_week') }}</th>
                                                            <th class="uppercase font-thin">{{ __('master.this_month') }}</th>
                                                            <th class="uppercase font-thin">{{ __('master.this_year') }}</th>
                                                            <th class="uppercase font-thin">{{ __('master.all_time') }}</th>
                                                        </tr>
                                                    </thead>-->
                                <tbody>
                                <tr>
                                    <td style="font-weight: 600; font-size: 16px">{{ __('master.period') }}</td>
                                    <td style="font-weight: 600; font-size: 16px">{{ __('master.orders_number') }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600; font-size: 16px">{{ __('master.today') }}</td>
                                    <td style="color: #9a33c7; font-size: 16px">{{ $today_orders}}</td>
                                </tr>
    
                                <tr>
                                    <td style="font-weight: 600; font-size: 16px">{{ __('master.yesterday') }}</td>
                                    <td style="color: #9a33c7; font-size: 16px">{{ $yesterday_orders}}</td>
                                </tr>
    
                                <tr>
                                    <td style="font-weight: 600; font-size: 16px">{{ __('master.this_week') }}</td>
                                    <td style="color: #9a33c7; font-size: 16px">{{ $this_week_orders}}</td>
                                </tr>
    
                                <tr>
                                    <td style="font-weight: 600; font-size: 16px">{{ __('master.this_month') }}</td>
                                    <td style="color: #9a33c7; font-size: 16px">{{ $this_month_orders}}</td>
                                </tr>
    
                                <tr>
                                    <td style="font-weight: 600; font-size: 16px">{{ __('master.this_year') }}</td>
                                    <td style="color: #9a33c7; font-size: 16px">{{ $this_year_orders}}</td>
                                </tr>
    
                                <tr>
                                    <td style="font-weight: 600; font-size: 16px">{{ __('master.all_time') }}</td>
                                    <td style="color: #9a33c7; font-size: 16px">{{ $all_time_orders}}</td>
                                </tr>
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-xs-12">
                <div class="row">
                    <div class="box-content min-height">
                        <h4 class="box-title">{{ __('master.recently') . ' ' . __('master.orders')}}</h4>
                        <div class="dropdown js__drop_down">
                            <a href="#"
                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('dashboard.admin.orders.index') }}">{{ __('master.more_details')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <table class="table table-striped margin-bottom-10">
                                <thead>
                                <tr>
                                    <th>{{ __('master.client_name')}}</th>
                                    <th class="hidden-xs">{{ __('master.client_address')}}</th>
                                    <th>{{ __('master.order_status')}}</th>
                                    <th>{{ __('master.product_name')}}</th>
                                    <th class="hidden-xs">{{ __('master.order_amount')}}</th>
                                    <th class="hidden-xs">{{ __('master.order_discount')}}</th>
                                    @if(Auth::user()->getRoleNames()[0] != 'User' and Auth::user()->getRoleNames()[0] != 'SubUser')
                                        <th>{{ __('master.store_name') }}</th>
                                    @endif
                                    <th width="5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($orders as $index=>$order)
                                @if($index < 10)
                                @if($order->status==0)
                                    <tr>
                                        <td>{{ $order->client->name }} </td>
                                        <td class="hidden-xs">{{ $order->client->address }}</td>
                                        <td>
                                            @if($order->status == 0)
                                                <span class="notice notice-yellow">{{ __('master.Pending') }}</span>
                                            @elseif($order->status == 1)
                                                <span class="notice notice-blue">{{ __('master.Accept') }}</span>
                                            @elseif($order->status == 2)
                                                <span class="notice notice-blue">{{ __('master.Process') }}</span>
                                            @elseif($order->status == 3)
                                                <span class="notice notice-purple">{{ __('master.Shipping') }}</span>
                                            @elseif($order->status == 4)
                                                <span
                                                        class="notice notice-green">{{ __('master.DeliveryPayment') }}</span>
                                            @elseif($order->status == 5)
                                                <span class="notice notice-danger">{{ __('master.Cancel') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span>{{ $order->product['name_'.app()->getLocale()]??'' }}</span>
                                        </td>
                                        <td class="hidden-xs">
                                            {{ $order->amount }} {{ $order->currency }}
                                        </td>
                                        <td class="hidden-xs">
                                            {{ $order->discount }} {{ $order->currency }}
                                        </td>
                                        @if(Auth::user()->getRoleNames()[0] != 'User' and Auth::user()->getRoleNames()[0] != 'SubUser')
                                            <td>
                                                <span class="notice notice-purple">{{ $order->store->name }}</span>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('dashboard.admin.orders.order_details',['id'=>$order->id]) }}">
                                                <i class="fa fa-info-circle" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="{{ __('master.order_details') }}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                @endif
                                @empty
                                    <tr>
                                        <td colspan="8"><p style="text-align: center">{{ __('master.no_data') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="col-xs-12">
                <div class="row">
                    <div class="box-content">
                        <h4 class="box-title">{{ __('master.activities')}}</h4>
                        <div class="dropdown js__drop_down">
                            <a href="#"
                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('dashboard.visitors') }}">{{ __('master.more_details')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div id="real-time-flot-chart" class="flot-chart" style="height: 320px"></div>
                        {{--                        <div id="visitors_chart"></div>--}}
                    </div>
                </div>
            </div>
            @role('SuperAdmin|Admin')
            <div class="col-xs-12">
                <div class="row">
                    <div class="box-content">
                        <h4 class="box-title">{{ __('master.activities')}}</h4>
                        <div class="dropdown js__drop_down">
                            <a href="#"
                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('dashboard.admin.plans.index') }}">{{ __('master.plan')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div id="plans" class="flot-chart" style="height: 320px"></div>
                    </div>
                </div>
            </div>
            {{--technical_support--}}
            <div class="col-lg-12">
                <div class="row">
                    <div class="box-content min-height">
                        <h4 class="box-title">{{ __('master.technical_support')}}</h4>
                        <div class="dropdown js__drop_down">
                            <a href="#"
                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('dashboard.admin.contacts.index',['status'=> '1']) }}">{{ __('master.more_details')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <table class="table table-striped margin-bottom-10">
                                <thead>
                                <tr>
                                    <th width="25%">{{ __('master.full_name')}}</th>
                                    <th width="20%">{{ __('master.status')}}</th>
                                    <th width="25%">{{ __('master.date')}}</th>
                                    <th width="5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($contacts_us as $index=>$contact)
                                @if($index < 10)
                                    <tr>
                                        <td>{{ $contact->name }}</td>
                                        @if($contact->status == 1)
                                            <td class="text-warning">{{ __('master.Pending') }}</td>
                                        @else
                                            <td class="text-success">{{ __('master.Answered') }}</td>
                                        @endif
                                        <td>{{ Carbon\Carbon::parse($contact->created_at)->toFormattedDateString() }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.admin.contacts.details',['id'=>$contact->id]) }}"><i
                                                        class="fa fa-info-circle" data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="{{ __('master.message_details') }}"></i></a></td>
                                    </tr>
                                @endif
                                @empty
                                    <tr>
                                        <td colspan="4"><p
                                                    style="text-align: center">{{  __('master.no_data') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            {{--PaymentPending--}}
            @role('SuperAdmin|Admin')
            <div class="col-lg-12">
                <div class="row">
                    <div class="box-content min-height">
                        <h4 class="box-title">{{ __('master.PaymentPending') }}</h4>
                        <div class="dropdown js__drop_down">
                            <a href="#"
                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('dashboard.admin.products.index') }}">{{ __('master.more_details')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <table class="table table-striped margin-bottom-10">
                                <thead>
                                <tr>
                                    <th>{{ __('master.store_name')}}</th>
                                    <th>{{ __('master.payment_method')}}</th>
                                    <th>{{ __('master.date')}}</th>
                                    <th width="5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($payments as $payment)
                                    <tr>
                                        <td>
                                                <span
                                                        class="notice notice-yellow">{{ $payment->user()->first()->store()->first()->name }}</span>
                                        </td>
                                        <td>{{ $payment->type }}</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($payment->created_at)->toFormattedDateString() }}
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.admin.invoices.edit',['id'=>$payment->id]) }}">
                                                <i class="fa fa-info-circle" data-toggle="tooltip"
                                                   data-placement="top" title="{{ __('master.more_details') }}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"><p style="text-align: center">{{ __('master.no_data') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('User|SubUser')
            <div class="col-lg-12">
                <div class="row">
                    <div class="box-content min-height">
                        <h4 class="box-title">{{ __('master.OutStock') }}</h4>
                        <div class="dropdown js__drop_down">
                            <a href="#"
                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('dashboard.admin.products.index') }}">{{ __('master.more_details')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <table class="table table-striped margin-bottom-10">
                                <thead>
                                <tr>
                                    <th>{{ __('master.product_name')}}</th>
                                    <th>{{ __('master.product_price')}}</th>
                                    <th>{{ __('master.orders')}}</th>
                                    <th width="5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($OutStock as $product)
                                    <tr>
                                        <td>{{ $product['name_'.app()->getLocale()] }}</td>
                                        <td>
                                            {{ $product->price }} {{ env('currency_symbol') }}
                                        </td>
                                        <td>
                                            <span>{{ count($product->orders) }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.admin.products.edit',['id'=>$product->id]) }}">
                                                <i class="fa fa-info-circle" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="{{ __('master.more_details') }}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"><p style="text-align: center">{{ __('master.no_data') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('SuperAdmin|Admin')
            <div class="col-lg-12">
                <div class="row">
                    <div class="box-content min-height">
                        <h4 class="box-title">{{ __('master.DomainChangeOrders') }}</h4>
                        <div class="dropdown js__drop_down">
                            <a href="#"
                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('dashboard.admin.clients') }}">{{ __('master.more_details')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <table class="table table-striped margin-bottom-10">
                                <thead>
                                <tr>
                                    <th>{{ __('master.store_name')}}</th>
                                    <th>{{ __('master.customdomain')}}</th>
                                    <th width="5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($customDomains as $customDomain)
                                    <tr>
                                        <td>
                                                <span
                                                        class="notice notice-yellow">{{ $customDomain->store()->first()->name }}</span>
                                        </td>
                                        <td>{{ $customDomain->custom }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.admin.domains.change_requests',['id'=>$customDomain->id]) }}">
                                                <i class="fas fa-check" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="{{ __('master.change_request_status') }}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"><p style="text-align: center">{{ __('master.no_data') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('User|SubUser')
            <div class="col-lg-12">
                <div class="row">
                    <div class="box-content min-height">
                        <h4 class="box-title">{{ __('master.clients') }}</h4>
                        <div class="dropdown js__drop_down">
                            <a href="#"
                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('dashboard.admin.clients') }}">{{ __('master.more_details')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <table class="table table-striped margin-bottom-10">
                                <thead>
                                <tr>
                                    <th>{{ __('master.client_name')}}</th>
                                    @if(Auth::user()->getRoleNames()[0] == 'User' or Auth::user()->getRoleNames()[0] == 'SubUser')
                                        <th>{{ __('master.product_name')}}</th>
                                    @else
                                        <th>{{ __('master.store')}}</th>
                                    @endif
    
                                    <th>{{ __('master.total_purchases')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($clients as $index=> $client)
                                       @if($index <10)
                                    <tr>
                                        <td>{{ $client['name'] }}</td>
                                        <td>{{ $client['details'] }}</td>
                                        <td>{{ $client['total_purchases'] }} {{ $client['currency'] }}</td>
                                    </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="6"><p style="text-align: center">{{ __('master.no_data') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
    
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/variable-pie.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/series-label.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/exporting.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/export-data.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/accessibility.js') }}"></script>

    <script>
        // Create the chart
        $(document).ready(function () {
            Highcharts.chart('plans', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '{{ __('master.plans') }}'
                },
                subtitle: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '{{ __('master.plans') }}'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                },

                series: [
                    {
                        name: "Plans",
                        colorByPoint: true,
                        data: [
                                {{--                        @dd($plans)--}}
                                @foreach($plans as $item)
                            {
                                name: "{{$item->name_en}}",
                                y: {{$item->stores->count()}},
                                drilldown: "Chrome"
                            },
                            @endforeach
                        ]
                    }
                ],

            });
            let visitors = JSON.parse("{{ $chart_visitors }}"), current_hour = "{{ $current_hour }}";
            categories = ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'];
            categories = categories.slice(current_hour, 24).concat(categories.slice(0, current_hour));
            Highcharts.chart('visitors_chart', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: '{{ __("master.visitors_around_clock") }}'
                },
                subtitle: {
                    text: 'Source: {{ auth()->user()->get_store_domain() }}'
                },
                xAxis: {
                    categories: categories,
                },
                yAxis: {
                    title: {
                        text: 'Number of Visitors'
                    }
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                    }
                },
                series: [{
                    name: 'visitors',
                    data: visitors
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
            var colors = Highcharts.getOptions().colors;
            Highcharts.chart('vistor', {
                chart: {
                    type: 'spline'
                },

                legend: {
                    symbolWidth: 40
                },

                title: {
                    text: 'Most common desktop screen readers'
                },

                subtitle: {
                    text: 'Source: WebAIM. Click on points to visit official screen reader website'
                },

                yAxis: {
                    title: {
                        text: 'Percentage usage'
                    }
                },

                xAxis: {
                    title: {
                        text: 'Time'
                    },
                    accessibility: {
                        description: 'Time from December 2010 to September 2019'
                    },
                    categories: ['December 2010', 'May 2012', 'January 2014', 'July 2015', 'October 2017', 'September 2019']
                },

                tooltip: {
                    valueSuffix: '%'
                },
                plotOptions: {
                    series: {
                        point: {
                            events: {
                                click: function () {
                                    window.location.href = this.series.options.website;
                                }
                            }
                        },
                        cursor: 'pointer'
                    }
                },
                series: [
                    {
                        name: 'NVDA',
                        data: [34.8, 43.0, 51.2, 41.4, 64.9, 72.4],
                        website: 'https://www.nvaccess.org',
                        color: colors[2],
                        accessibility: {
                            description: 'This is the most used screen reader in 2019'
                        }
                    }, {
                        name: 'JAWS',
                        data: [69.6, 63.7, 63.9, 43.7, 66.0, 61.7],
                        website: 'https://www.freedomscientific.com/Products/Blindness/JAWS',
                        dashStyle: 'ShortDashDot',
                        color: colors[0]
                    }, {
                        name: 'VoiceOver',
                        data: [20.2, 30.7, 36.8, 30.9, 39.6, 47.1],
                        website: 'http://www.apple.com/accessibility/osx/voiceover',
                        dashStyle: 'ShortDot',
                        color: colors[1]
                    }, {
                        name: 'Narrator',
                        data: [null, null, null, null, 21.4, 30.3],
                        website: 'https://support.microsoft.com/en-us/help/22798/windows-10-complete-guide-to-narrator',
                        dashStyle: 'Dash',
                        color: colors[9]
                    }, {
                        name: 'ZoomText/Fusion',
                        data: [6.1, 6.8, 5.3, 27.5, 6.0, 5.5],
                        website: 'http://www.zoomtext.com/products/zoomtext-magnifierreader',
                        dashStyle: 'ShortDot',
                        color: colors[5]
                    }, {
                        name: 'Other',
                        data: [42.6, 51.5, 54.2, 45.8, 20.2, 15.4],
                        website: 'http://www.disabled-world.com/assistivedevices/computer/screen-readers.php',
                        dashStyle: 'ShortDash',
                        color: colors[3]
                    }
                ],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 550
                        },
                        chartOptions: {
                            legend: {
                                itemWidth: 150
                            },
                            xAxis: {
                                categories: ['Dec. 2010', 'May 2012', 'Jan. 2014', 'July 2015', 'Oct. 2017', 'Sep. 2019']
                            },
                            yAxis: {
                                title: {
                                    enabled: false
                                },
                                labels: {
                                    format: '{value}%'
                                }
                            }
                        }
                    }]
                }
            });

        });
        
        $(document).ready(function() {
            $.get('{{route("dashboard.admin.pay_commission_auto")}}',function(){
                
            });
            $.get('https://v6.exchangerate-api.com/v6/0efeb3f7b0d11058beeeb41a/latest/USD',function(response) {
                var convertRate = response['conversion_rates']['MRU'];
                var amountToConverted = '{{ auth()->user()->store->indebtedness }}';
                var amountToConverted2 = '{{ auth()->user()->store->plan->max_indebtedness }}';
                
                $('#firstAmount').html(Math.round(( amountToConverted / convertRate ) * 100) / 100);
                $('#secondAmount').html(Math.round(( amountToConverted2 / convertRate ) * 100) / 100);
                
                $('.specificComission').html(Math.round(( amountToConverted / convertRate ) * 100) / 100);
                
            });
        });

    </script>
@endsection


{{--Developed Saed Z. Sinwar--}}

