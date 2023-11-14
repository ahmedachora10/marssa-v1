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
    <div class="row small-spacing">
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
                        @if($packageName == 'commissions')
                        <div class="col-md-12">
                            <h4>
                                @if(app()->getLocale() == 'ar')
                                   باقة العمولات
                                @else
                                    Commission Packages
                                @endif
                            </h4>
                            
                            <div class="store-row plans-row text-center">
                                @foreach($plans->where('is_commission',1) as $plan)
                                    <div class="store-item-wrapper col-md-4 col-xs-12" style="height:400px">
                                        <a href="{{ route('dashboard.admin.package',['id'=>$plan->id]) }}"
                                           style="display: block;@if($plan->is_commission == 1)border: #FFC619;border-style: solid;@endif"
                                           class="store-item__plan store-item__plan-basic store-item__plan-1 align-center">
                                            <div class="plan-top plan{{$plan->id}}">
                                                <h6 class="plan-title plan{{$plan->id}}_color">
                                                    <strong>{{ $plan['name_'.app()->getLocale()] }}</strong>
                                                </h6>
                                            </div>
                                            <div class="plan-bottom">
                                                @if($plan->price == 0)
                                                @if($plan->is_commission == 1)
                                                    <p>
                                                        <?php 
                                                            $desc = 'description_'.app()->getLocale();
                                                        ?>
                                                        {{ $plan->$desc }}
                                                    </p>
                                                @endif
                                                    <span
                                                            class="plan-price plan{{$plan->id}}_color">{{ __('site.free') }}</span>
                                                @else
                                                
                                                    <span class="plan-price plan{{$plan->id}}_color">{{ round($plan->price) }}</span>
                                                    <span
                                                            class="plan-currency plan{{$plan->id}}_color">{{ env('currency_symbol') }}</span>
                                                @endif
                                                <span class="clearfix"></span>
                                                <button class="order-btn btn btn-tiffany btn-rounded btn-xs">
                                                    @if($user_plan ? $user_plan->id != $plan->id : true )
                                                        {{ __('site.choose_package') }}
                                                    @else
                                                        {{ __('master.renew_current_package') }}
                                                    @endif
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="col-md-12">
                            <h4>
                                @if(app()->getLocale() == 'ar')
                                   الباقات الشهرية
                                @else
                                    Monthly Packages
                                @endif
                            </h4>
                            <div class="store-row plans-row text-center">
                                @foreach($plans->where('is_commission',0)->where('price', '!=', 0) as $plan)
                                    <div class="store-item-wrapper col-md-4 col-xs-12" style="height:400px">
                                        <a href="{{ route('dashboard.admin.package',['id'=>$plan->id]) }}"
                                           style="display: block;@if($plan->is_commission == 1)border: #FFC619;border-style: solid;@endif"
                                           class="store-item__plan store-item__plan-basic store-item__plan-1 align-center">
                                            <div class="plan-top plan{{$plan->id}}">
                                                <h6 class="plan-title plan{{$plan->id}}_color">
                                                    <strong>{{ $plan['name_'.app()->getLocale()] }}</strong>
                                                </h6>
                                            </div>
                                            <div class="plan-bottom">
                                                @if($plan->price == 0)
                                                @if($plan->is_commission == 1)
                                                    <p>
                                                        <?php 
                                                            $desc = 'description_'.app()->getLocale();
                                                        ?>
                                                        {{ $plan->$desc }}
                                                    </p>
                                                @endif
                                                    <span
                                                            class="plan-price plan{{$plan->id}}_color">{{ __('site.free') }}</span>
                                                @else
                                                
                                                    <span class="plan-price plan{{$plan->id}}_color">{{ round($plan->price) }}</span>
                                                    <span
                                                            class="plan-currency plan{{$plan->id}}_color">{{ env('currency_symbol') }}</span>
                                                @endif
                                                <span class="clearfix"></span>
                                                <button class="order-btn btn btn-tiffany btn-rounded btn-xs">
                                                    @if($user_plan ? $user_plan->id != $plan->id : true )
                                                        {{ __('site.choose_package') }}
                                                    @else
                                                        {{ __('master.renew_current_package') }}
                                                    @endif
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
    </div>
   
    
@endsection



{{--Developed Saed Z. Sinwar--}}

