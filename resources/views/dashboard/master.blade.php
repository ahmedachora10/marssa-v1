<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if (app()->getLocale() == 'ar') dir="rtl" @else dir="ltr"
      @endif
      @if(auth()->user()->steps == 'start')
      class="menu-active"
        @endif
>
<head>
    <meta name='robots' content='noindex,follow'/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="manifest" href="{{asset("manifest.json")}}">
    <meta name="author" content="">
    <title>{{ __('master.dashboard') }} - {{ __('master.' . $title_page)}}</title>
    <link rel="shortcut icon" href="{{asset('site/images/logo_browser.png')}}"/>
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo:400,700"/>
    @else
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,700"/>
    @endif
    <link rel="apple-touch-icon" href="/img/icon-192x192.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/icon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/icon-192x192.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/img/icon-192x192.png">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/styles/style_2.css') }}">
    @role('User|SubUser')
    <!-- Hotjar Tracking Code for https://marssa.shop/dashboard/index -->
    <script>
        (function (h, o, t, j, a, r) {
            h.hj = h.hj || function () {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {hjid: 2533375, hjsv: 6};
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    @endrole
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/fonts/material-design/css/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/fonts/fontello/fontello.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/fonts/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}"/>
    <style src="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"></style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/autofill/2.3.5/css/autoFill.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.bootstrap.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.0.0/css/font-awesome.min.css"
          integrity="sha512-88YM0a2suhl7CXiBkrltShr4/SOnraIDbB23mo1PT4XXksvf7MlKLdcxSoHlx/kfHdVQkYbzh2rNkHwfxfiqAA=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/waves/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/sweet-alert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/chart/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/fullcalendar/fullcalendar.print.css') }}">
    <link rel="shortcut icon" href="{{ asset('fav.ico') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/styles/style-dark.min.css') }}">

    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('dashboard/light/assets/styles/style-rtl.min.css') }}">
    @endif

    <link rel="stylesheet" type="text/css" href="{{ url('/dashboard/light/assets/styles/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.20.5/video-js.min.css"/>

    @yield('head_tag')
    <style>
        .input-group-btn > .btn span, .glyphicon {
            color: white;
        }

        .store-setup-item {
            height: 0;
        }

        i.watch_video {
            position: absolute;
            z-index: 1000;
            top: 24px;
            cursor: pointer;
            color: #515353;
        }

        i.watch_video:hover,
        i.watch_video:active,
        i.watch_video:focus {
            color: white;
        }

        i.custom-icon-explanations {
            position: relative;
            z-index: 1000;
            cursor: pointer;
            color: #596025;
            font-size: 22px !important;
        }

        .explanations_page {
            padding: 2px 11px;
            color: white !important;
        }

        .navigation .menu > li {
            position: relative !important;
        }

        html[dir='rtl'] i.watch_video {
            left: 8px;
        }

        html[dir='ltr'] i.watch_video {
            right: 8px;
        }

        .icon {
            font-size: 40px !important;
            margin: 10px 0px !important;
        }

        .visit_site {
            color: #ffffff !important;
            background: #2d2b2f;
        }

        .visit_site a {
            color: #ffffff !important;
            background: #2d2b2f;
        }

        .introjs-tooltip {
            border: 1px solid #fbbc05 !important;
            opacity: 1 !important;;
            color: #fff !important;;
            background: #9a33c7 !important;
        }

        .introjs-skipbutton {
            color: #fff !important;
        }

        .introjs-nextbutton {
            background: #fbbc05 !important;
            color: #fff !important;
        }

        .introjs-helperNumberLayer {
            color: #fff !important;
            direction: ltr !important;
        }

        .introjs-progressbar {
            background-color: #fbbc05 !important;

        }

        .custom-alert {
            position: fixed;
            z-index: 100000;
            width: 300px;
            top: 20px;
            background: #fbbc05 !important;
            right: 30px;
            color: #fff !important;
            border: #9a33c7 !important;
        }

        .flex-with-around {
            display: flex;
            justify-content: space-around;
        }
        .menu.menu_marketing_and_other_things{
            background-color: #343333;
        }
        .menu .menu_marketing_and_other_things{
            padding: 0px 18px 0px;
            background-color: #2d2b2f;
        }
        .menu .menu_marketing_and_other_things .collapse{
            padding: 0px 22px 0px 0px;
        }
        .menu .menu_marketing_and_other_things .menu-icon i
        {
            font-size: 15px;
        }
        .navigation .menu .menu_marketing_and_other_things  li  a{
            padding-left: 5px !important;
        }
        
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/css/fileinput.min.css"
          integrity="sha512-iPac4HfczXMa0qW1F34D91WysfdyjgbvopGdZcW0IlTwxgfLrFmxnQFThIASKs72aAHm5WVODsZZMrx+tgE+iw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/css/fileinput-rtl.min.css"
          integrity="sha512-kdJDdt18RUqBTXRiEZBzpz3qsgjp9SD/GkCb2Irh9RMNcTQop0K0iN1IdGnwKSHiKFaepCScjkMWBV6NOEdZhQ=="
          crossorigin="anonymous"/>
    {{--    @if(auth()->user()->steps == 'start')--}}
    @if(l() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/intro.css') }}">
        <link rel="stylesheet" href="{{ asset('css/inrto.ar.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/intro.css') }}">
        {{--        @endif--}}
    @endif
    <style>
        .me_su {
            color: #ffa424;
        }
        .navigation .menu > li > a{
            padding: 10px 30px 10px 40px;
        }
        .navigation .menu:first-child > li{
            padding-top: 25px;
        }
        .navigation ul li i {
            font-size: 15px;
            margin-left: 2px;
        }
        .visit_site a{
            padding: 10px 17px;
        }
        @media(max-width:900px){
            .navigation .menu > li > a {
                padding: 5px 30px 6px 18px;
            }
            .navigation ul li i{
                font-size: 15px;
            }
           .navigation .menu > li > a span{
               font-size: 15px;
               font-size: 15px;
                margin-left: 25px;
                top: 5px;
                position: relative;
           }
            
        }
    </style>
    @stack('css')
</head>
<script>

</script>
<body data-intro="{{__("master.Welcome to your store, lets get to know the screens now")}}">


@php $store = auth()->user()->store()->first() @endphp
<?php $information = auth()->user()->store()->first()->information()->first(); ?>
@if($information['first_time'] != 1)
    <div class="main-menu" style="padding-top: 65px;">
        <header class="header">
            <a style="font-size: 17px;line-height: 30px;" href="{{ route('dashboard.index') }}"
               class="logo">{{ __('site.APP_NAME') }}</a>
            <button type="button" class="button-close fa fa-times js__menu_close"></button>
            <div class="user" style="top: 0px;">
            <span class="avatar">
                <img style="width: 40px; height: 40px"
                     src="{{ asset(Auth::user()->image ?? 'dashboard/light/assets/images/sativa.png') }}"
                     style="width: 70px; height: 70px" alt="image user">
                <span class="status online"></span>
            </span>
                <h5 class="name" style="color:#9A33C7"><span>{{ Auth::user()->name }}</span></h5>
                <h5 class="position" style="color:#9A33C7">{{ Auth::user()->getRoleNames()[0] }}</h5>
                <div class="control-wrap js__drop_down">
                    <i class="fa fa-caret-down js__drop_down_button"></i>
                    <div class="control-list">
                        <div class="control-item"><a href="{{ route('dashboard.profile') }}">
                                <i class="fa fa-user"></i>{{ __('master.profile') }}</a>
                        </div>
                        <div class="control-item">
                            <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                        class="fa fa-sign-in-alt"></i>{{ __('master.logout') }}</a></div>
                        <form id="logout-form" action="{{ route('site.logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="content">
            <div class="navigation">

                @role('SuperAdmin|Admin')
                <ul class="menu " id="collapseSettings">

                    @role('SuperAdmin')

                    <li style="margin-top:30px" class="@yield('store_settings')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.store_settings.index') }}">
                            <i class="menu-icon mdi mdi-settings"></i>
                            <strong><span>{{ __('master.store_settings')}}</span></strong>
                        </a>
                    </li>
                    
                    @endrole

                    @role('SuperAdmin|Admin')
                    
                    <li style="margin-top:30px" class="@yield('store_settings')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.max_indebtedness') }}">
                            <i class="menu-icon fas fa-money-bill-alt"></i>
                            <strong><span>{{ __('master.max_indebtedness')}}</span></strong>
                        </a>
                    </li>
                    <li class="@yield('plan_index')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.plans.index') }}">
                            <i class="menu-icon"><i class="fas fa-award"></i></i>
                            <strong><span>{{ __('master.packages')}}</span></strong>
                        </a>
                    </li>
                    <li class="@yield('participants_index')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.participants.index') }}">
                            <i class="menu-icon"><i class="fas fa-hand-sparkles"></i></i>
                            <strong><span>{{ __('master.participants')}}</span></strong>
                        </a>
                    </li>
                    
                    <li class="@yield('links_current')">
                        <a class="waves-effect" href="{{ route('dashboard.links') }}">
                            <i class="menu-icon"><i class="fa fa-link"></i></i>
                            <strong><span>
                                
                                 @if(app()->getLocale() == 'ar')
                                    
                                        مواقع مهمة
                                    @else
                                     
                                      important websites
                                    
                                    @endif
                                
                            </span></strong>
                        </a>
                    </li>
                    @endrole


                    @role('SuperAdmin')
                    <li class="{{active('analyze')}}">
                        <a class="waves-effect" href="{{ route('dashboard.admin.analyze') }}">
                            <i class="menu-icon"><i class="fas fa-star"></i></i>
                            <strong><span>{{ __('master.analyze')}}</span></strong>
                        </a>
                    </li>
                    @endrole
                </ul>
                @endrole

                <ul class="menu">
                    <li class="@yield('index')">
                        <a data-intro="{{__("master.Here is a summary of all the store shown to you in the main interface 👋")}}"
                           class="waves-effect"
                           href="{{ route('dashboard.index') }}"><i
                                    class="menu-icon mdi mdi-view-dashboard">
                           </i><span><strong>{{ __('master.home')}}</strong></span>
                        </a>
                    </li>
                </ul>
                
                @role('User')
                    <ul class="menu">
                        <li class="me_su @yield('products_add')">
                            <a class="waves-effect" href="{{ route('dashboard.admin.products.add') }}">
                                <i class="menu-icon"><i class="fas fa-plus"></i></i>
                                <span class="me_su">{{ __('master.add_new_product')}}</span>
                            </a>
                        </li>
                        
                    </ul>
                @endrole
                
                @role('User|SubUser')
                <ul class="menu">
                    <li data-toggle="collapse" href="#collapseOrders" role="button" aria-expanded="false" aria-controls="collapseOrders">
                        <a class="waves-effect">
                            <i class="menu-icon"><i class="fas fa-box"></i></i>
                            <span><strong>{{ __('master.orders')}}</strong></span>
                            <span class="badge badge-danger" style="float:{{ app()->getLocale() == 'ar' ? 'left' : 'right' }};margin-top: 7px;padding-top: 0px;"><small>
    
                                @if (auth()->user()->getRoleNames()[0] == 'User' or auth()->user()->getRoleNames()[0] == 'SubUser')
                                  <?php
                                    $store = auth()->user()->store()->first();
                                    echo  \App\Order::where(['store_id'=>$store->id,'status'=>0])->distinct('order_id')->count();
                                  ?>
                               @endif
    
                            </small></span>
                        </a>
                        <i class="fas fa-play-circle watch_video"
                            data-video-id="orders"
                            data-backdrop="static"
                            data-keyboard="false"
                            data-toggle="modal"
                            ></i>
                    </li>
                </ul>
                <ul class="menu collapse" id="collapseOrders">

                    <li class="me_su @yield('products_add')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.orders.index') }}">
                            <i class="menu-icon"><i class="fas fa-box"></i></i>
                            <span class="me_su">{{ __('master.orders')}}</span>
                        </a>
                    </li>
                    
                    <li class="@yield('Reviews_index')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.orders.abandoned_orders') }}">
                            <i class="menu-icon"><i class="fas fa-star"></i></i>
                            <span class="me_su">{{ __('master.abandoned_orders')}}</span>
                        </a>
                    </li>
                    
                </ul>
                @endrole

                @role('User')
                    <ul class="menu">
                        <li>
                          <a href="{{ route('dashboard.admin.products.products_index') }}" class="waves-effect">
                            <i class="menu-icon"><i class="fas fa-tshirt"></i></i>
                            <span><strong>{{ __('master.products')}}</strong></span></a>
                            <i class="fas fa-play-circle watch_video"
                                data-video-id="products"
                                data-backdrop="static"
                                data-keyboard="false"
                                data-toggle="modal"
                                ></i>
                        </li>
                    </ul>
                    
                    
                    
                @endrole
                    
                @role('User|SubUser')
                <ul class="menu">
                    <li class="@yield('reports')">
                        <a data-intro="{{__("master.Here you see all sales, all orders, most sold products, the number of visitors to your store and the percentage of purchase")}}"
                           class="waves-effect" href="{{route('dashboard.merchant.competitions.index')}}">
                            <i class="menu-icon"><i class="fas fa-trophy"></i></i>
                            <span><strong>{{ __('Competition')}}</strong></span>
                        </a>
                    </li>
                </ul>
                <ul class="menu">
                    <li href="#" role="button" aria-expanded="false">
                        <a href="{{ route('dashboard.admin.upsell') }}" data-intro="{{__("master.Add New Product - Manage Customer Reviews - Add Store Sections")}}"
                           class="waves-effect">
                            <i class="menu-icon"><i class="fas fa-bullhorn"></i></i>
                            <span><strong>UPsell</strong></span>
                            <i class="fas fa-play-circle watch_video"
                                   data-video-id="marketing"
                                   data-backdrop="static"
                                   data-keyboard="false"
                                   data-toggle="modal"
                                ></i>
                        </a>
                    </li>
                </ul>
                
                
                
                <ul class="menu">
                    <li class="@yield('promo_codes_index')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.promo_codes') }}">
                            <i class="menu-icon"><i class="fas fa-cut"></i></i>
                            <span><strong>{{ __('master.promo_codes')}}</strong></span>
                            <i class="fas fa-play-circle watch_video"
                                   data-video-id="marketing"
                                   data-backdrop="static"
                                   data-keyboard="false"
                                   data-toggle="modal"
                                ></i>
                        </a>
                    </li>
                </ul>
               
                
                <ul class="menu">
                    <li href="#" role="button" aria-expanded="false">
                        <a href="{{ route('dashboard.admin.offers') }}" data-intro="{{__("master.Add New Product - Manage Customer Reviews - Add Store Sections")}}"
                           class="waves-effect">
                            <i class="menu-icon"><i class="fas fa-bullhorn"></i></i>
                            <span><strong>{{ __('master.offers')}}</strong></span>
                            <i class="fas fa-play-circle watch_video"
                                   data-video-id="marketing"
                                   data-backdrop="static"
                                   data-keyboard="false"
                                   data-toggle="modal"
                                ></i>
                        </a>
                    </li>
                </ul>
                
                
                
                <ul class="menu">
                    <li class="@yield('reports')">
                        <a data-intro="{{__("master.Here you see all sales, all orders, most sold products, the number of visitors to your store and the percentage of purchase")}}"
                           class="waves-effect" href="{{ route('dashboard.admin.reports') }}">
                            <i class="menu-icon"><i class="fas fa-chart-pie"></i></i>
                            <span><strong>{{ __('master.reports')}}</strong></span>
                        </a>
                    </li>
                </ul>
                
                <ul class="menu">
                    <li data-toggle="collapse" href="#collapseLP" role="button" aria-expanded="false" aria-controls="collapseOrders">
                        <a class="waves-effect">
                            <i class="menu-icon"><i class="fa fa-box"></i></i>
                            <span><strong>{{ __('master.landing_pages')}}</strong></span>
                            {{-- <span class="badge badge-danger" style="float:{{ app()->getLocale() == 'ar' ? 'left' : 'right' }};margin-top: 7px;padding-top: 0px;"><small>
                               @if (auth()->user()->getRoleNames()[0] == 'User' or auth()->user()->getRoleNames()[0] == 'SubUser')
                                  <?php
                                    $store = auth()->user()->store()->first();
                                    echo  \App\Order::where(['store_id'=>$store->id,'status'=>0])->distinct('order_id')->count();
                                  ?>
                               @endif
                            </small></span>
    --}}
                        </a>
                        <i class="fas fa-play-circle watch_video"
                            data-video-id="lp"
                            data-backdrop="static"
                            data-keyboard="false"
                            data-toggle="modal"
                            ></i>
                    </li>
                </ul>
                <ul class="menu collapse" id="collapseLP">
                    <li class="@yield('landing_pages')">
                        <a data-intro="{{__("master.pages")}}"
                           class="waves-effect  {{ request()->routeIs('dashboard.admin.landing_pages.index')  ? 'active' : '' }}"
                           href="{{ route('dashboard.admin.landing_pages.index') }}">
                            <i class="menu-icon"><i class="fas fa-tshirt"></i></i>
                            <span><strong>{{ __('master.pages')}}</strong></span>
                            <span class="badge badge-danger" style="float:{{ app()->getLocale() == 'ar' ? 'left' : 'right' }};margin-top: 7px;padding-top: 0px;"><small>
                                @if (auth()->user()->getRoleNames()[0] == 'User' or auth()->user()->getRoleNames()[0] == 'SubUser')
                                  <?php
                                    $store = auth()->user()->store()->first();
                                    echo  \App\ProductOffer::where(['store_id'=>$store->id])->count();
                                  ?>
                               @endif
    
                            </small></span>
                        </a>
                    </li>
                    <li class="@yield('langing_pages_orders')">
                        <a data-intro="{{__("master.orders")}}"
                           class="waves-effect  {{ request()->routeIs('dashboard.admin.landing_pages.orders')  ? 'active' : '' }}"
                           href="{{ route('dashboard.admin.landing_pages.orders') }}">
                            <i class="menu-icon"><i class="fas fa-box"></i></i>
                            <span><strong>{{ __('master.orders')}}</strong></span>
                            <span class="badge badge-danger" style="float:{{ app()->getLocale() == 'ar' ? 'left' : 'right' }};margin-top: 7px;padding-top: 0px;"><small>
    
                                @if (auth()->user()->getRoleNames()[0] == 'User' or auth()->user()->getRoleNames()[0] == 'SubUser')
                                  <?php
                                    $store = auth()->user()->store()->first();
                                    echo  \App\ProductOfferOrder::where(['store_id'=>$store->id,'status'=>'pend'])->distinct('order_id')->count();
                                  ?>
                               @endif
    
                            </small></span>
                        </a>
                    </li>
                    
                </ul>
                
                <br/>

                <ul class="menu collapse" id="collapseProducts">

                    <li class="me_su @yield('products_add')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.products.add') }}">
                            <i class="menu-icon"><i class="fas fa-plus"></i></i>
                            <span class="me_su">{{ __('master.add_new_product')}}</span>
                        </a>
                    </li>
                    <li class="@yield('products_index')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.products.index') }}">
                            <i class="menu-icon"><i class="fas fa-tshirt"></i></i>
                            <span class="me_su">{{ __('master.all_products')}}</span>
                        </a>
                    </li>
                    <li class="@yield('Reviews_index')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.Reviews') }}">
                            <i class="menu-icon"><i class="fas fa-star"></i></i>
                            <span class="me_su">{{ __('master.Reviews')}}</span>
                        </a>
                    </li>
                    <li class="@yield('categorize')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.categorize.index') }}">
                            <i class="menu-icon"><i class="fas fa-cart-plus"></i></i>
                            <span class="me_su">{{__('master.categorize')}}</span>
                        </a>
                    </li>
                    <li class="@yield('category_add')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.categorize.add') }}">
                            <i class="menu-icon"><i class="fas fa-plus"></i></i>
                            <span class="me_su">{{__('master.add_category')}}</span>
                        </a>
                    </li>
                </ul>
                @endrole
                <ul class="menu">
                    <li class="@yield('clients_index')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.clients') }}">
                            <i class="menu-icon"><i class="fas fa-users"></i></i>
                            <span><strong>{{ __('master.clients')}}</strong></span>
                        </a>
                    </li>
                </ul>
                @role('User')
                
                    <ul class="menu">
                        <li >
                            <a href="{{ route('dashboard.admin.merchant-tools') }}" data-intro="{{__("master.We have provided you with very useful tools for your business to know before you start - expected costs and profits - your capital growth")}}"
                               class="waves-effect">
                                <i class="menu-icon"><i class="fas fa-calculator"></i></i>
                                <span><strong>{{ __('master.calculations')}}</strong></span></a>
                            <i class="fas fa-play-circle watch_video"
                               data-video-id="calculations"
                               data-backdrop="static"
                               data-keyboard="false"
                               data-toggle="modal"
                            ></i>
                        </li>
                    </ul>

                @endrole
                
                @role('SuperAdmin')
                
                @endrole
                @role('User')
                <ul class="menu">
                    <li >
                        <a href="{{ route('dashboard.admin.affiliate_index') }}" data-intro="{{__("master.Here you can do great things to help you increase your profit - discount code - temporary offers - upsell")}}"
                           class="waves-effect">
                            <i class="menu-icon"><i class="fa fa-align-right" aria-hidden="true"></i></i>
                            <span><strong>{{ __('master.affiliate')}}</strong></span>
                        </a>
                        
                    </li>
                    <!--  -->
                    <li class="menu_marketing_and_other_things collapse"  id="collapseMarketingOthersMenu" role="button" aria-expanded="false" aria-controls="collapseMarketingOthersMenu">
                        
                @endrole


                
                @role('SuperAdmin')
                <ul class="menu">
                    <li class="@yield('affiliates_create')" data-toggle="collapse" href="#collapseAffiliate" role="button" aria-expanded="false"
                        aria-controls="collapseAffiliate">
                        <a data-intro="{{__("master.Here you see all sales, all orders, most sold products, the number of visitors to your store and the percentage of purchase")}}"
                           class="waves-effect">
                            <i class="menu-icon"><i class="fas fa-chart-pie"></i></i>
                            <span><strong>{{ __('master.affiliate')}}</strong></span>
                        </a>
                    </li>
                </ul>


                <ul class="menu collapse" id="collapseAffiliate">
                    <li class="@yield('affiliaters')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.affiliaters') }}">
                            <i class="menu-icon"><i class="fas fa-chart-pie"></i></i>
                            <span class="me_su">{{ __('master.affiliaters')}}</span>
                        </a>
                    </li>
                    <li class="@yield('affiliates_profites')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.affiliates-profites') }}">
                            <i class="menu-icon"><i class="fas fa-chart-pie"></i></i>
                            <span class="me_su">{{ __('master.affiliaters-profites')}}</span>
                        </a>
                    </li>
                    <li class="@yield('affiliates_withdraw_profites')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.affiliates-withdraw-profites') }}">
                            <i class="menu-icon"><i class="fas fa-chart-pie"></i></i>
                            <span class="me_su">{{ __('master.withdraw-profites')}}</span>
                        </a>
                    </li>

                </ul>
                @endrole

                @role('SuperAdmin')
                <ul class="menu">
                    <li style="margin-top:30px" class="@yield('color')">
                        <a class="waves-effect" href="{{ route('dashboard.admin.color.index') }}">
                            <i class="menu-icon"><i class="menu-icon mdi mdi-settings"></i></i>
                            <span><strong>{{ __('master.color')}}</strong></span>
                        </a>
                    </li>
                </ul>
                @endrole

                @role('User')
                    </li>
                </ul>
                @endrole
                
                @role('User')
                    @if(env('show_credits') == true)
                        <ul class="menu">
                            <li class="@yield('Wallet')">
                                <a data-intro="{{__("master.Recharge your balance to activate your store with a gift of 20% over any amount you put in your balance")}}"
                                   class="waves-effect" href="{{ route('dashboard.admin.wallet') }}">
                                    <i class="menu-icon"><i class="fas fa-wallet"></i></i>
                                    <span><strong>{{ __('master.Wallet')}}</strong></span>
                                </a>
                                <i class="fas fa-play-circle watch_video"
                                   data-video-id="Wallet"
                                   data-backdrop="static"
                                   data-keyboard="false"
                                   data-toggle="modal"
                                ></i>
                            </li>
                        </ul>
                    @endif
                @endrole
                
                
                @role('AffiliaterForMarketPlace')
                    
                    <ul class="menu">
                        <li class="@yield('affiliates_create')" data-toggle="collapse" href="#collapseAffiliatemarketplace" role="button" aria-expanded="false"
                            aria-controls="collapseAffiliate">
                            <a data-intro="{{__("master.Here you see all sales, all orders, most sold products, the number of visitors to your store and the percentage of purchase")}}"
                               class="waves-effect">
                                <i class="menu-icon"><i class="fas fa-chart-pie"></i></i>
                                <span><strong>{{ __('master.affiliate')}}</strong></span>
                            </a>
                        </li>
                    </ul>


                    <ul class="menu collapse" id="collapseAffiliatemarketplace">
                        <li class="@yield('affiliates_create')">
                            <a class="waves-effect" href="{{ route('dashboard.admin.affiliates-create') }}">
                                <i class="menu-icon"><i class="fas fa-chart-pie"></i></i>
                                <span class="me_su">{{ __('master.create-affiliate')}}</span>
                            </a>
                        </li>
                        <li class="@yield('affiliatees_show')">
                            <a class="waves-effect" href="{{ route('dashboard.admin.affiliatees-show') }}">
                                <i class="menu-icon"><i class="fas fa-chart-pie"></i></i>
                                <span class="me_su">{{ __('master.show-affiliate')}}</span>
                            </a>
                        </li>
                        <li class="@yield('affiliatees_my_profits')">
                            <a class="waves-effect" href="{{ route('dashboard.admin.affiliatees-my-profits') }}">
                                <i class="menu-icon"><i class="fas fa-chart-pie"></i></i>
                                <span class="me_su">{{ __('master.affiliates-profits')}}</span>
                            </a>
                        </li>
                        <li class="@yield('affiliatees_withdraw')">
                            <a class="waves-effect" href="{{ route('dashboard.admin.affiliatees-withdraw') }}">
                                <i class="menu-icon"><i class="fas fa-chart-pie"></i></i>
                                <span class="me_su">{{ __('master.affiliatees-withdraw')}}</span>
                            </a>
                        </li>
    
                    </ul>
                
                @endrole
                @role('User')
                    <ul class="menu">
                        <li style="margin-top:30px" class="@yield('store_settings')">
                            <a data-intro="{{__("master.Here you control all the settings for your store: store information - design - payment methods - delivery - employees - slides - private domain")}}"
                               class="waves-effect" href="{{ route('dashboard.admin.store_settings.index') }}">
                                <i class="menu-icon mdi mdi-settings"></i>
                                <span><strong>{{ __('master.store_settings')}}</strong></span>
                            </a>
                            <i class="fas fa-play-circle watch_video"
                               data-video-id="store_settings"
                               data-backdrop="static"
                               data-keyboard="false"
                               data-toggle="modal"
                            ></i>
                        </li>
                    </ul>
                 @endrole

                
                <h5 class="visit_site ">
                    <a href="javascript:void(0)" onclick="copyUrl()" id="copy"
                       data-url="{{ auth()->user()->get_store_domain() }}">
                        <i class="far fa-copy" style="padding: 5px;"></i>
                        <span style="color:#ffffff">{{ __('master.copy_store_url') }}</span>
                        <span style="@if(app()->getLocale() == 'ar') float:left @else float:right @endif ; color:#ffffff">
                </span>

                    </a>
                    <p class="flex-with-around">
                        <a target="_blank" href="https://wa.me?text={{ auth()->user()->get_store_domain() }}">
                            <i class="fab fa-whatsapp" style="padding: 5px;"></i>
                        </a>
                        <a target="_blank"
                           href="https://www.facebook.com/sharer/sharer.php?u={{ auth()->user()->get_store_domain() }}">
                            <i class="fab fa-facebook" style="padding: 5px;"></i>
                        </a>
                    </p>
                </h5>


            </div>
        </div>

    </div>

    <style>
        .custom_a {
            color: #2d2d2f !important;
            display: inline-block;
            margin: 0;
            font-size: 18px;
            line-height: 75px;
            font-weight: 500;
        }

        .custom_a:active, .custom_a:focus, .custom_a:hover {
            color: #fff !important;
        }

        .fixed-navbar {
            background: #ffffff;
            border-bottom: 3px solid #f5f7fa;
        }

        .trophy-png {
            width: 20%;
            margin-top: 0%;
            color: white;
            border-radius: 63%;
        }

        .trophy-a {
            width: 140px;
            text-align: left;
            direction: ltr;
            color: white !important;
        }

        .trophy-a label {
            color: #533e08;
        }

        @media (max-width: 800px) {
            .fixed-navbar .pull-left {
                width: 20%;
            }

            .fixed-navbar .pull-right {
                /*width: 55%;*/
            }

            .page-title {
                font-size: 12px;
            }

            .title-trophy {
                width: 16px;
            }

            .title-trophy .trophy-a {
                width: 37px !important;
            }

            .title-trophy .trophy-a img {
                width: 51%;
            }

            .title-trophy .trophy-a label {
                width: 20%;
                font-size: 10px;
            }
            .title-trophy .trophy-a {
                width: 60px !important;
            }
            
        }
    </style>
    <div class="fixed-navbar">
        <div class="pull-left">
            <button type="button"
                    class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
            <h1 class="page-title">{{ __('master.'.$title_page)}}</h1>
           
        </div>
        <div class="pull-right">
            <ul style="list-style: none;">
                @role('User|SubUser')
                <li class="page-title title-trophy" style="width:auto">
                    
                    <a target="_blank" class="custom_a text-inverse trophy-a" href="{{ auth()->user()->get_store_domain() }} ">
                        <i class="fas fa-store-alt" style="padding: 5px;color: #7b1fa2;"></i>
                        <label class="label-trophy"><strong>{{__('master.my_store')}} </strong> </label>
                    </a>
                </li>
                <li class="page-title">
                    
    
                        <a data-intro="{{__("master.Here you can watch all the videos that explain everything to you on the platform in an easy and clear way, as this sign appears next to each screen")}}"
                           class=" explanations_page" href="{{ route('dashboard.admin.explanations-index') }}">
                            <i class="fas fa-play-circle  custom-icon-explanations"></i>
                        </a>
                    </li>
                
                
                @endrole
                
                
               
                
                
                @foreach(['ar' => 'ar', 'en' =>'en','fr'=>'fr'] as $key => $lang)
                    @if($lang !== app()->getLocale())
                        <li class="page-title">
                            <a class="custom_a text-inverse" href="{{ route('locale',['locale' => $lang]) }}">
                                <img style="width: 30px" data-toggle="tooltip"
                                     data-placement="bottom" title="{{__('master.'.$lang)}}"
                                     src="{{asset("img/$key.png")}}">
                            </a>
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
    </div>
    <div id="wrapper">

        <div class="main-content" style="display: flex; flex-direction: column;">
            @role('User')

            <?php $site = \App\site::select(['video_tutorial', 'header_message'])->first(); ?>
            <div>
                <div style="background: black;">
                    <i class="fas fa-times closevideo" style="color: white; margin-right: 10px; display:none;"></i>
                </div>
            <!--<iframe id="tutorial"  src="https://www.youtube.com/embed/{{$site->video_tutorial}}" style="width:100%;height:420px; display:none;"></iframe>-->
                <iframe id="tutorial" src="{{$site->video_tutorial}}"
                        style="width:100%;height:420px; display:none;"></iframe>
            </div>
            @if (($site->header_message != NULL) || ($site->header_message != ''))   <h1 class="page-title"
                                                                                         style="margin: auto;box-shadow: 2px 2px 15px #9a33c7;width: 100%;text-align: center;margin-bottom: 20px;border-radius: 15px;">{{$site->header_message}}</h1>   @endif
            @endrole
            <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
            @if($information['first_time'] == 1)
                1
            @else
                
                @yield('content')
            @endif
        </div>
    </div>

@else

    <div class="text-center" style="padding-top:60px">
        <h4>
            {{ __('site.welcome_message') }}
        </h4>
        <p class="text-danger">
            {{ __('site.welcome_message_second') }}
        </p>
        <p>
            <small>
                <a href="{{ url()->current() }}">
                    {{ __('site.skip_video') }}
                </a>
                <?php
                $update = auth()->user()->store()->first()->information()->first();
                $update->first_time = 0;
                $update->save();
                ?>
            </small>
        </p>
        <?php $site = \App\site::select(['video_upload', 'video_link'])->first(); ?>

        @if($site)
            @if($site->video_upload)
                <iframe src="{{url('/')}}/videos/{{$site->video_upload}}" style="width:90%;height:420px;"></iframe>
            @else
                <iframe src="{{$site->video_link}}" style="width:90%;height:420px;"></iframe>
            @endif
        @endif

        <br>

        <?php $site2 = \App\site::select(['welcome_video_upload', 'welcome_video_link'])->first(); ?>

        @if($site)
            @if($site->video_upload)
                <iframe src="{{url('/')}}/videos/{{$site2->welcome_video_upload}}"
                        style="width:90%;height:420px;"></iframe>
            @else
                <iframe src="{{$site2->welcome_video_link}}" style="width:90%;height:420px;"></iframe>
            @endif
        @endif
    </div>
@endif

<!-- Modal -->
<div class="modal fade" id="languageAndCurrency" tabindex="-1" role="dialog" aria-labelledby="languageAndCurrencyTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('dashboard.admin.information.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="languageAndCurrencyTitle">
                        {{__("Change Language And Currency ")}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.store_language') }}</h6>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <ul class="list-inline text-center">
                                            <li>
                                                <div class="radio primary">
                                                    <input type="radio" name="language" id="radio-1" value="0"
                                                           @if($store->language == 0) checked @endif>
                                                    <label for="radio-1">{{ __('master.arabic') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio info">
                                                    <input type="radio" name="language" id="radio-2" value="1"
                                                           @if($store->language == 1) checked @endif>
                                                    <label for="radio-2">{{ __('master.english') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio info">
                                                    <input type="radio" name="language" id="radio-4" value="3"
                                                           @if($store->language == 3) checked @endif>
                                                    <label for="radio-4">{{ __('master.french') }}</label>
                                                </div>
                                            </li>
                                            @if(auth()->user()->store->plan and auth()->user()->store->plan->language )
                                                <li>
                                                    <div class="radio success">
                                                        <input type="radio" name="language" id="radio-3" value="2"
                                                               @if($store->language == 2) checked @endif>
                                                        <label for="radio-3">{{ __('master.arabic') . __('master.and') . __('master.english'). __('master.and') . __('master.french')}}</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="radio info">
                                                        <input type="radio" name="language" id="radio-5" value="4"
                                                               @if($store->language == 4) checked @endif>
                                                        <label for="radio-5">{{ __('master.arabic'). __('master.and') . __('master.french') }}</label>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                @role('User')--}}
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.currencies') }}</h6>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="card-content">
                                            <div class="form-group @error('currency') has-error @enderror col-xs-12">
                                                <select name="currency" id="select_currency" class="form-control">
                                                    <!--
                                                    <option value="MRO">أوقية موريتانية قديمة( MRO )</option>-->
                                                    <option value="MRU">MRU</option>
                                                    <option value="MRO">MRO</option>
                                                    <option value="أوقية جديدة"> أوقية جديدة</option>
                                                    <option value="أوقية قديمة"> أوقية قديمة</option>
                                                    <option value="SAR">ريال سعودي ( ر.س )</option>
                                                    <option value="AED">درهم اماراتي ( د.إ )</option>
                                                    <option value="KWD">دينار كويتي ( د.ك )</option>
                                                    <option value="QAR">ريال قطري ( ر.ق )</option>
                                                    <option value="BHD">دينار بحريني ( د.ب )</option>
                                                    <option value="IQD">دينار عراقي ( د.ع )</option>
                                                    <option value="OMR">ريال عماني ( ر.ع )</option>
                                                    <option value="EGP">جنيه مصري ( ج.م )</option>
                                                    <option value="SDG">جنيه سوداني ( SDG )</option>
                                                    <option value="LYD">دينار ليبي ( LD )</option>
                                                    <option value="DZD">دينار جزائري ( دج )</option>
                                                    <option value="TND">دينار تونسي ( د.ت )</option>
                                                    <option value="MAD">درهم مغربي ( د.م. )</option>
                                                    <option value="SYP">ليرة سورية ( SYP )</option>
                                                    <option value="LBP">ليرة لبنانية ( ل.ل )</option>
                                                    <option value="AUD">دولار استرالي ( $ )</option>
                                                    <option value="EUR">يورو ( € )</option>
                                                    <option value="IDR">روبية إندونيسية ( Rp )</option>
                                                    <option value="JOD">دينار أردني ( JOD )</option>
                                                    <option value="USD">دولار أمريكي ( $ )</option>
                                                    <option value="SEK">كرونة سويدية ( kr )</option>
                                                    <option value="CFA">الفرنك الافريقي ( CFA )</option>
                                                    <option value="CNY">رنمينبي ( ¥ )</option>
                                                    <option value="GBP">جنيه استرليني ( £ )</option>
                                                    <option value="INR">روبية هندية ( Rp )</option>
                                                    <option value="JPY">ين ياباني ( ¥ )</option>
                                                    <option value="PKR">روبية باكستانية ( Rs. )</option>
                                                    <option value="TRY"> ليرة تركية ( ₺ )</option>
                                                    <option value="CAD"> دولار كندي ( $ )</option>
                                                    <option value="MYR"> رينغيت ماليزي ( RM )</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--                @endrole--}}
                    <div class="text-center">
                        <button class="btn btn-primary">{{__("master.save")}}</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("Close")}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--[if lt IE 9]>
<script src="{{ asset('dashboard/light/assets/script/html5shiv.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/script/respond.min.js') }}"></script>
<![endif]-->
<!--<script src="{{ asset('dashboard/light/assets/scripts/jquery.min.js') }}"></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('dashboard/light/assets/scripts/modernizr.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/plugin/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/plugin/nprogress/nprogress.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/plugin/sweet-alert/sweetalert.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/plugin/waves/waves.min.js') }}"></script>

<script>
    $('.menu-merketing-sider').click(function(e){
         e.preventDefault();
        // jQuery('.menu_marketing_and_other_things').toggleClass('in'); 
    });
    $(document).ready(function () {

        var element = 0;
        var counter = setInterval(function () {
            if (element < 30) {
                element = element + 1;
                $("#progressBar").html(element)

            } else {
                if (element == 30) {
                    $('.close').css("display", "block");
                }
            }
        }, 1000);

    });
    $(document).ready(function () {
        const ua = navigator.userAgent;
        if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
            //return "tablet";
            $('#play_store').show();
        }
        //if (/Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test( ua)) {
        if (/Mobile|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(ua)) {
            //return "mobile";
            $('#play_store').show();

        }
        //return "desktop";

    });


</script>
@role('User|SubUser')

<script>
    $(document).ready(function () {

        $('.showvideo').click(function () {
            $('#tutorial').show();
            $('.closevideo').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ route('dashboard.video_watched') }}",
                dataType: "json",
                data: {id: "{{auth()->id()}}"},
                success: function (msg) {
                    alert(1);
                },
                error: function (res) {
                    console.log(res);
                }
            })
        });
        $('.closevideo').click(function () {
            $('#tutorial').hide();
            $('.closevideo').hide();
        })
    });

</script>
@endrole

<script src="{{ asset('dashboard/light/assets/plugin/RWD-table-pattern/js/rwd-table.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/scripts/rwd.demo.min.js') }}"></script>

@section('MorrisChart')
    <script src="{{ asset('dashboard/light/assets/plugin/chart/morris/morris.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/chart/morris/raphael-min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/chart.morris.init.min.js') }}"></script>
@endsection

<script src="{{ asset('dashboard/light/assets/plugin/chart/plot/jquery.flot.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/plugin/chart/plot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/plugin/chart/plot/jquery.flot.categories.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/plugin/chart/plot/jquery.flot.pie.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/plugin/chart/plot/jquery.flot.stack.min.js') }}"></script>
<script src="{{ asset('dashboard/light/assets/scripts/chart.flot.init.min.js') }}"></script>

@section('Sparkline Chart')
    <script src="{{ asset('dashboard/light/assets/plugin/chart/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/chart.sparkline.init.min.js') }}"></script>
@endsection

@section('FullCalendar')
    <script src="{{ asset('dashboard/light/assets/plugin/moment/moment.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/fullcalendar.init.js') }}"></script>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/js/fileinput.min.js"
        integrity="sha512-yLD+PqEyjv+TMfhD9sJ2c7hEp10omIrUgEJm+m68/ryVFZJtcQubBNClRmBHqAfiYQfciHQQEAWyTLy5NnrRVw=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/js/locales/ar.min.js"
        integrity="sha512-3MKrBzDXkokqxL+TCAr95A5efNobsn0sSlLygHHNfI5hj7724BF2J+BCQ6114B3vAG6rusfAUUQiKz/bnAdl4g=="
        crossorigin="anonymous"></script>
@yield('script')

<script>
    function copyUrl() {
        const el = document.createElement('textarea');
        el.value = $("#copy").attr('data-url');
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        alert("Done");
    }
</script>

<script src="{{ asset('dashboard/light/assets/scripts/main.min.js') }}"></script>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@include('dashboard.explanations.model-video')
<script>

</script>
@if(auth()->user()->steps == 'start')
    <script src="{{asset("js/intro.js")}}"></script>
    <script>

        $(document).ready(function () {

            $("body").off('click');
            introJs().onbeforeexit(function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "{{ route('dashboard.steps') }}",
                    dataType: "json",
                    data: {id: "{{auth()->id()}}"},
                    success: function (msg) {
                        location.reload();
                    },
                    error: function (res) {
                        console.log(res);
                    }
                })
            }).onchange(function (targetElement) {
                var el = this;
                if (el._currentStep == 8) {
                    $('html').removeClass('menu-active')
                }
            }).setOptions({
                showStepNumbers: true,
                showProgress: true
            }).start()
        });


    </script>

@endif

@if(session()->has('modal-change-lang'))
    <script>
        $('#languageAndCurrency').modal();
        
       

    </script>
@endif
@stack('js')

<script>
     $(document).ready(function() {
            
            $.get('https://v6.exchangerate-api.com/v6/0efeb3f7b0d11058beeeb41a/latest/USD',function(response) {
                
                var convertRate = response['conversion_rates']['MRU'];
                var amountToConverted = '{{ auth()->user()->store->indebtedness }}';
                var amountToConverted2 = '{{ auth()->user()->store->plan->max_indebtedness }}';
                
                
                
                $('#specificComission').html(Math.round(( amountToConverted / convertRate ) * 100) / 100);
                
            });
        });
</script>
</body>
</html>
{{--Developed Saed Z. Sinwar--}}

