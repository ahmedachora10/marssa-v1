<!DOCTYPE html>
@if( app()->getLocale()=='fr')
    <html dir="ltr" lang="fr">
    @else
        <html dir="rtl" lang="{{ app()->getLocale() }}">
        @endif
        <html dir="rtl" lang="@if( app()->getLocale()=='fr')en @else{{ app()->getLocale() }} @endif">

        <head>
            <meta charset="utf-8">
            <title>{{ $head_data['title_'.app()->getLocale()]  ?? '' }}</title>
            @if($information['icon'])
                <link rel="shortcut icon" href="{{ asset($information->icon) }}" type="image/x-icon"/>
                <link rel="icon" href="{{ asset($information->icon) }}" type="image/x-icon"/>
                <link rel="apple-touch-icon" href="{{ asset($information->icon) }}"/>
            @endif
            <meta name="robots" content="index,follow">
            <meta name="robots" content="ALL">
            <meta property="og:type" content="website"/>
            <meta property="og:title" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}"/>
            <meta property="og:description"
                  content="{!! $details != 'index' ? substr($product['description_'.app()->getLocale()], 0, 300) : substr($head_data['description_'.app()->getLocale()], 0, 300) !!}"/>
            <meta property="og:image" content="{{ asset($head_data['icon']) }}"/>
            <meta property="og:url" content="{{url()->current()}}"/>
            <meta property="og:site_name" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}"/>
            <meta property="article:author" content="{{ $information->facebook  ?? ''}}"/>
            <meta property="article:publisher" content="{{ $information->facebook  ?? ''}}"/>
            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:domain" content="{{ url('/') }}">
            <meta name="twitter:site" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}">
            <meta name="twitter:creator" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}">
            <meta name="twitter:image:src" content="{{ asset($head_data['icon']) }}">
            <meta name="twitter:description"
                  content="{!! $details != 'index' ? substr($product['description_'.app()->getLocale()], 0, 300) : substr($head_data['description_'.app()->getLocale()], 0, 300) !!}"/>
            <meta name="twitter:title" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}">
            <meta name="twitter:url" content="{{url()->current()}}">
            <meta name="keywords" content="{{ $head_data['keyword_'.app()->getLocale()] ?? '' }}">
            <meta name="description"
                  content="{!! $details != 'index' ? substr($product['description_'.app()->getLocale()], 0, 300) : substr($head_data['description_'.app()->getLocale()], 0, 300) !!}"/>
            <meta name="author" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}">
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1"/>
            <meta name="theme-color" content="#FFF"/>
            <meta name="msapplication-navbutton-color" content="#FFF"/>
            <meta name="apple-mobile-web-app-capable" content="yes"/>
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
            <meta name="format-detection" content="telephone=no"/>
            <meta name="csrf-token" content="DOGrckYSTY0cEtrPz7yoYktYAAbAQLsdNY1plAEd">
            <link rel="stylesheet" href="{{ asset('store/theme_5/css/marssa-css-6.css') }}"/>

            <style>
                :root {
                    --primary-color: #EAB72A;
                    --light-primary-color: #EAB72A;
                    --dark-primary-color: #D0021B;
                    --secondary-color: #DEC435;
                    --body-background-color: #FFFFFF;
                    --success-color: #00C853;
                    --info-color: #40C4FF;
                    --warning-color: #FFAB00;
                    --danger-color: #F44336;
                }

                .background_buy_now_button {
                    animation-name: bayButton;
                    animation-duration: 1s;
                    animation-iteration-count: infinite;
                    animation-timing-function: linear;
                }

                @keyframes bayButton {
                    0% {
                        transform: translateX(0%);
                    }
                    40% {
                        transform: translateX(-3%);
                    }
                    80% {
                        transform: translateX(3%);
                    }
                    100% {
                        transform: translateX(0%);
                    }
                }

                .copyright {
                    text-align: center;
                    background: #5f5a56;
                    padding: 15px;
                    color: #ffffff;
                }

                .copyright__link {
                    color: #ffc107 !important;
                }
            </style>
            <link href="https://static3.youcan.shop/store-front/css/app.css?id=fe1a983726b2d082aff6" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('store/theme_5/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('store/theme_5/css/all.css')}}">
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=DM+Sans:500&amp;display=swap" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('store/theme_5/css/utilities.css')}}">
            <link rel="stylesheet" href="{{ asset('store/theme_5/css/base.css')}}">
            <link rel="stylesheet" href="{{ asset('store/theme_5/css/fragments/cart-floater.css')}}">
            <link rel="stylesheet" href="{{ asset('store/theme_5/css/fragments/product-panel.css')}}">
            <!-- Custom CSS Code -->
            <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_1/css/custom.css') }}">
            <?php
            $default = $css_style['default'] ?? '';

            if (is_null($default)) {
                $option = 1;
            } else {
                if ($default === 'false') {
                    $option = 0;
                } else {
                    $option = 1;
                }
            }
            ?>

            @if($option === 0)

                <style>
                    .scroll-to-top, .blog-one__image, .navbar {
                        background-image: none;
                        background-color: {{$css_style['header_background']}}             !important;
                    }

                    .inner-banner {
                        background-image: none;
                        background-color: {{$css_style["header_background"]}};
                        @if(isset($css_style['background_image']))

             background-image: url('{{asset($css_style["background_image"])}}');
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        height: 300px;
                        padding-top: 110px;
                    }

                    .footer {
                        background-color: {{$css_style['footer_background']}}  !important;
                    }

                    @endif












                    }

                    .nav-link2, .header-navigation ul.navigation-box > li.current > a, .header-navigation ul.navigation-box > li:hover > a, .inner-banner__title, .blog-one__image, .top-level-item {
                        color: {{$css_style['header_text_color']}}            !important;
                    }

                    .footer {
                        background-image: none;
                        background-color: {{$css_style['footer_background']}};

                    }

                    .footer .title, .footer .company-links a, .social-icon {
                        color: {{$css_style['footer_text_color']}}            !important;
                    }

                    .site-footer:before {
                        border-color: {{$css_style['footer_background']}};
                    }

                    .background_add_to_cart_button {
                        background-color: {{$css_style['background_add_to_cart_button']}}            !important;
                        color: {{$css_style['font_add_to_cart_button']}}            !important;
                        border-color: {{$css_style['background_add_to_cart_button']}}            !important;
                    }

                    .background_buy_now_button {
                        background-color: {{$css_style['background_buy_now_button'] ?? ''}}            !important;
                        color: {{$css_style['font_buy_now_button']}}            !important;
                        border-color: {{$css_style['background_buy_now_button']}}            !important;
                        cursor: pointer;
                    }

                    .BuyNowCartButtonBackGround1 {
                        background-color: {{$css_style['background_check_out_buy_now_button']}}            !important;
                        border-color: {{$css_style['background_check_out_buy_now_button']}}            !important;
                    }

                    .btn-theme {
                        background-color: {{$css_style['background_add_to_cart_button']}}            !important;
                        border-color: {{$css_style['background_add_to_cart_button']}}            !important;
                    }

                    .fa-handshake:before {
                        color: #556767 !important;
                    }

                    .fa-volume-control-phone:before {
                        color: #556767 !important;
                    }

                    .fa-truck:before {
                        color: #556767 !important;
                    }

                    .topbar i {
                        color: #607d8b;
                    }

                    .addToCartHomePage {
                        background-color: {{$css_style['background_buy_now_button']}}            !important;
                        border-color: {{$css_style['background_buy_now_button']}}            !important;
                    }

                </style>

            @endif

            @yield('head')
            @stack('head')
            <style>
                .background_buy_now_button {
                    background: {{$css_style['background_buy_now_button'] ?? ''}}    !important;
                }
            </style>

            @if($information['google_tag_manager'] ?? false)
            <!-- Google Tag Manager (noscript) -->
                <noscript>
                    <iframe src="https://www.googletagmanager.com/ns.html?id={{ $information['google_tag_manager'] }}"
                            height="0" width="0" style="display:none;visibility:hidden"></iframe>
                </noscript>
                <!-- End Google Tag Manager (noscript) -->
            @endif

            @if($information['facebook_pixel_id'] ?? false)
                <script>
                    !function (f, b, e, v, n, t, s) {
                        if (f.fbq) return;
                        n = f.fbq = function () {
                            n.callMethod ?
                                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                        };
                        if (!f._fbq) f._fbq = n;
                        n.push = n;
                        n.loaded = !0;
                        n.version = '2.0';
                        n.queue = [];
                        t = b.createElement(e);
                        t.async = !0;
                        t.src = v;
                        s = b.getElementsByTagName(e)[0];
                        s.parentNode.insertBefore(t, s)
                    }(window, document, 'script',
                        'https://connect.facebook.net/en_US/fbevents.js');
                    fbq('init', "{{ $information['facebook_pixel_id'] }}");
                    fbq('track', 'PageView');
                </script>
                <noscript>
                    <img height="1" width="1" style="display:none"
                         src="https://www.facebook.com/tr?id={{ $information['facebook_pixel_id'] }}&ev=PageView&noscript=1"/>
                </noscript>
            @endif
            <style>
                .dismiss {    
                    width: 35px;height: 35px;margin-left: 25px;margin-right: 25px;transition: all .3s;
                    color: #fff;background: #ffd45c;border-radius: 4px;text-align: center;line-height: 35px;cursor: pointer;
                }
            </style>
            <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
            <style>
                body {
                    font-family: 'Tajawal', sans-serif !important;
                }
            </style>
            
        </head>

        <body>

        <div id="app" style="text-align: justify;">

            <div class="side-cart-summary active" style="display: none;">
                <div class="cart-header"><h3><small>1 عناصر</small></h3> <i class="yc yc-x-circle close-cart"></i></div>
                <main class="cart-body">
                    <div class="cart-list">
                        <form action="/">
                            <ul class="list-unstyled">
                                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
                                    <li class=" cart-item" style=""
                                        id="<?php echo $row->rowId; ?>">

                                        @isset($row->options['image'])
                                            <img src="{{asset($row->options['image'])}}" alt="{{$row->name}}"
                                                 class="item-thumbnail">
                                        @endisset
                                        <div class="item-body">
                                            <div class="item-details">
                                                <h3>
                                                    <a href="javascript:void(0)"> <?php echo $row->name; ?>
                                                      @if(!empty($row->options['variant']) && !empty($row->options['variant_id'] ))
                                                            
                                                            @if($row->options['variant'] !='single' )
                                                            {{$row->options['variant'] }}
                                                            
                                                            @endif
                                                            @endif
                                                    <!----></a>
                                                </h3>
                                                <input hidden
                                                       onchange="CartAction('{{$row->options['update_url']}}','{{$row->rowId}}')"
                                                       id="qty_{{$row->rowId}}" name="quant[<?php echo $row->rowId; ?>]"
                                                       class="form-control input-number"
                                                       value="<?php echo $row->qty; ?>" min="1" max="10">
                                                <div class="quantity-wrapper">
                                                    <span class="quantity"> 	الكمية <small><?php echo $row->qty; ?></small></span>
                                                    <span class="currency-value"><span
                                                                class="value"><?php echo $row->price; ?> </span>
    					                    <span class="currency">&nbsp;{{$store->getCurrency()}} </span>
    					                    </span>
                                                </div>
                                            </div>

                                        </div>
                                            <div class="item-actions">
                                                <button onclick="CartAction('{{$row->options['update_url']}}','{{$row->rowId}}','update')"
                                                        type="button"><i class="yc yc-edit"></i></button>
                                                <button onclick="CartAction('{{$row->options['delete_url']}}','{{$row->rowId}}','delete')"
                                                        type="button"><i class="yc yc-trash"></i></button>
                                            </div>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div> <!---->
                </main>
                <footer class="cart-footer">
                    <h4>

                        {{ __('master.total_carts') }}

                        <span class="currency-value"><span class="value">
    		         <?php echo round(\Gloudemans\Shoppingcart\Facades\Cart::subtotal()); ?></span>
    		         <span class="currency">&nbsp; {{$store->getCurrency()}}</span></span>
                    </h4>
                    <div class="cart-actions"><a href="{{url('/checkout')}}"
                                                 class=" background_buy_now_button button primary-button">شراء الآن</a>
                        <a class="button default-button">

                            {{ __('master.continue_shopping') }}

                        </a></div>
                </footer>
            </div>


            <!-- App header -->
            
            
            <div id="header-wrapper container"
                 class="header-wrapper" {{ (!empty($disable_header) && ( $disable_header == true ) ) ? 'style=display:none':'no' }} >
                @if(!empty($information->head_text))
                    <div class=" notice-bar desktop-notice-bar"
                         style="color: #000000; @isset($css_style['header_background']) background-color: {{$css_style['header_background']?? ''}}!important; @endisset">
                        <div class="container">
                            <div class="fr-view">
                                <p style="text-align: center;"><strong><span
                                                style="font-size: 18px;">{{ $information->head_text }} </span></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($information->head_text))
                    <div
                            class=" notice-bar mobile-notice-bar"
                            style="color: #000000;@isset($css_style['header_background']) background-color: {{$css_style['header_background']}}!important;@endisset">
                        <div class="container">
                            <div class="fr-view">
                                <p style="text-align: center;"><strong><span
                                                style="font-size: 12px;">{{ $information->head_text }}  </span></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="header-container">
                    <header
                            class="app-header"
                            :class="{'search-active': showSearch, 'navigation-active': showNavigation}"
                            id="app-header">
                        <div class="main-bar desktop-bar navbar"
                             style="background-color: #ffffff;border-bottom: 1px solid #f0f0f0;">
                            <div class="container">
                                <div class="header-left">
                                    <div class="header-element">
                                        <a class="header-brand" href="{{ url('/') }}">
                                            <img src="{{ asset($information->logo) }}" alt=""/>
                                        </a>
                                    </div>
                                </div>
                                <div class="header-center">
                                    <div class="header-element">
                                        <ul class="list-unstyled header-list">
                                            <li>
                                                <a class="nav-link2"
                                                   href="{{ url('show-competitions') }}">
                                                    المسابقات
                                                </a>
                                            </li>
                                            @foreach($categories as $category)
                                                @if($loop->index < 5)
                                                    <li>
                                                        <a class="nav-link2"
                                                           href="{{ url('') }}/category/{{$category->id}}">
                                                            {{ $category['name_'.app()->getLocale()] }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                             

                                            <li class="nav-item dropdown ">
                                                <a class="nav-link2 dropdown-toggle other_category" href="#"
                                                   id="navbarDropdown" role="button" data-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    {{__('site.Other_Category')}}
                                                </a>
                                                <div class="dropdown-menu other_category "
                                                     aria-labelledby="navbarDropdown">
                                                    @foreach($categories as $category)
                                                        @if($loop->index >= 5)
                                                            <a class="dropdown-item"
                                                               href="{{ url('') }}/category/{{$category->id}}"> {{ $category['name_'.app()->getLocale()] }} </a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </li>


                                            @if($store->language > 1)
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link2 dropdown-toggle" href="#" id="navbarDropdown"
                                                       role="button" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        {{__('master.Select_lang')}}
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        @if($store->language == 2)
                                                            @foreach(['ar','en','fr'] as $value)
                                                                @if($value !== app()->getLocale())

                                                                    <a class="dropdown-item"
                                                                       href="{{ route('locale',['locale' => $value]) }}">{{__('master.'.$value)}}</a>

                                                                @endif
                                                            @endforeach
                                                        @elseif($store->language == 4)
                                                            @foreach(['ar','fr'] as $value)
                                                                @if($value !== app()->getLocale())

                                                                    <a class="dropdown-item"
                                                                       href="{{ route('locale',['locale' => $value]) }}">{{__('master.'.$value)}}</a>

                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>

                                </div>

                                <div class="header-right">
                                    <div class="header-element">
                                        <a class="header-switcher" href="javascript:void(0)" role="button"
                                           @click="toggleSearch()">
                                            <i class="yc yc-search"></i>
                                        </a>
                                    </div>
                                    <div class="header-element">
                                        <div class="cart-switcher nav-link2" >
                                            <div class="cart-icon"><i class="yc yc-shopping-cart"></i></div>
                                            <div class="currency-value"><span
                                                        class="value"><?php echo round(\Gloudemans\Shoppingcart\Facades\Cart::subtotal()); ?></span><span
                                                        class="currency">&nbsp;{{$store->getCurrency()}} </span></div>
                                            <span class="background_buy_now_button cart-count"
                                                  style=""> {{ $number ?? '' }} </span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-bar mobile-bar"
                             style="background-color: #ffffff;border-bottom: 1px solid #f0f0f0;">
                            <div class="container">
                                <div class="header-left"style="z-index: 1;">
                                    <div class="header-element">
                                    </div>
                                    <div class="header-element">
                                        <div class="cart-switcher nav-link2">
                                            <div class="cart-icon"><i class="yc yc-shopping-cart"></i></div>
                                            <div class="currency-value"><span
                                                        class="value"><?php echo round(\Gloudemans\Shoppingcart\Facades\Cart::subtotal()); ?></span><span
                                                        class="currency">&nbsp;{{$store->getCurrency()}} </span></div>
                                            <span class="background_buy_now_button cart-count"
                                                  style=""> {{ $number ?? '' }} </span></div>
                                    </div>

                                    <div class="header-element">
                                        <a class="header-switcher" href="javascript:void(0)" role="button"
                                           @click="toggleSearch()">
                                            <i class="yc yc-search"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="header-center">
                                    <div class="header-element">
                                        <a class="header-brand" href="{{ url('/') }}">
                                            <img src="{{ asset($information->logo) }}" alt=" "/>
                                        </a>
                                    </div>
                                </div>
                                <div class="header-right"style="z-index: 1;">
                                    <div class="header-element">
                                        <a class="header-switcher" href="javascript:void(0)" role="button"
                                           @click="toggleNavigation()">
                                            <i class="yc yc-menu"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="showNavigation" class="overlay" @click="toggleNavigation()"></div>
                        <nav class="side-navigation">
                            <a class="navigation-brand" href="{{ url('/') }}">
                                <img src="{{ asset($information->logo) }}" alt=" "/>
                            </a>
                            <div style="width: 100%;position: absolute;
                                    top: 10px;display: flex;justify-content: end;">
            				<!-- close sidebar menu -->
            				<div class="dismiss" style="z-index: 1;" @click="toggleNavigation()">
            					<i class="fas @if(app()->getLocale()=='ar') fa-arrow-right @else fa-arrow-left @endif"></i>
            				</div>
            				</div>
                            <form class="navigation-search" action="https://rimcorner.shop/search">
                                <div class="search-input">
                                    <input type="search" required name="query">
                                    <button type="submit">
                                        <i class="yc yc-search"></i>
                                    </button>
                                </div>
                            </form>
                            <ul class="list-unstyled navigation-list">
                                <li>
                                    <a 
                                       href="{{ url('show-competitions') }}">
                                        المسابقات
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ url('') }}/category/{{$category->id}}">{{ $category['name_'.app()->getLocale()] }} </a>
                                    </li>

                                @endforeach

                                @if($store->language > 1)

                                    @if($store->language == 2)
                                        @foreach(['ar','en','fr'] as $value)
                                            @if($value !== app()->getLocale())


                                                <li>
                                                    <a href="{{ route('locale',['locale' => $value]) }}">{{__('master.'.$value)}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @elseif($store->language == 4)
                                        @foreach(['ar','fr'] as $value)
                                            @if($value !== app()->getLocale())
                                                <li>
                                                    <a href="{{ route('locale',['locale' => $value]) }}">{{__('master.'.$value)}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif

                                @endif
                            </ul>
                        </nav>
                        <form class="search-form" method="GET" action="https://rimcorner.shop/search">
                            <div class="container">
                                <div class="search-select">

                                </div>
                                <div class="search-input">
                                    <input type="hidden" name="limit" value="12">
                                    <input type="search" required name="q" value="">
                                    <button class="search-submit" type="submit">
                                        <i class="yc yc-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </header>
                </div>
            </div>
            
        @yield('content')


        <!-- App footer -->
            @if(!request()->is('make_order')|| !request()->is('/checkout'))
                <footer class="footer "
                        style="border-top: 1px solid #f0f0f0;">
                    <div class="container">
                        <div class="footer-brand">
                            <a class="" href="{{ url('/') }}">
                                <img src="{{ asset($information->logo) }}" alt=" "/>
                            </a>
                        </div>
                        <div class="footer-body">
                            <div class="row">
                                
                               <div class="col-lg-4 mb-2 mt-2">
                                  <div class="footer-item">
                                        <h3 >{{ __('store.call-us') }}</h3>
                                <p class="footer-widget__contact">
                                    <a href="tel:{{ $information->phone }}">{{ $information->phone }}</a>
                                </p>
                                <p class="footer-widget__contact">
                                    <a href="mailto:{{ $information->email }}">{{ $information->email }}</a>
                                </p>
                                  </div>
                                   
                               </div>
                                <div class="col-lg-4 mb-2 mt-2">
                                    
                                    <div class="footer-item">
                                        <h3>{{__('master.terms_and_policies')}}</h3>
                                        <ul class="list-unstyled footer-list">
                                            @foreach($pages as $page)
                                                <li>
                                                    <a href="{{ $page->route_page() }}" style="color: #000000;">
                                                        {{ $page['title_'.app()->getLocale()] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                            <li>
                                                <a style="color: #000000;" href="{{ url('/marketplace/work-as-affiliter-for-marketplace') }}" target="_blank">
                                                    كن مسوق لنا
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
    
                                </div>
                                
                                <div class="col-lg-4 mb-2 mt-2">
                                    <div class="footer-item">
                                    <h3>{{__('master.payment_methods')}} </h3>
                                    <ul class="list-unstyled footer-list">
                                        <div class="row partner-logo-container">
                                            @if(isset($information->footer_payments_image))
                                                @forelse(json_decode($information->footer_payments_image ?? '') ?? [] as $item)
                                                    <div class="flex-col col-4 partner-logo-frame">
                                                        <img style="height: 70px;width: 70px ;margin: 0 10px"
                                                             src="{{ asset($item)}}">
                                                    </div>
                                                @empty
                                                    <div class="flex-col col-3 partner-logo-frame">
                                                        <img src="{{ asset('store/theme_2/catalog/partner-logos/payment/cashondelivery.png')}}">
                                                    </div>
                                                    <div class="flex-col col-3 partner-logo-frame">
                                                        <img style="height: 70px;"
                                                             src="{{ asset('store/theme_2/catalog/partner-logos/payment/paypal.png')}}">
                                                    </div>
                                                    <div class="flex-col col-3 partner-logo-frame">
                                                        <img style="height: 70px; "
                                                             src="{{ asset('store/theme_2/catalog/partner-logos/payment/bankily_png.png')}}">
                                                    </div>
                                                    <div class="flex-col col-3 partner-logo-frame">
                                                        <img style="height: 70px; "
                                                             src="{{ asset('img/msrafi.jpeg')}}">
                                                    </div>
                                                @endforelse
                                            @endif
                                            
                                        </div>
                                    </ul>
                                </div>
                                </div>

                            </div>
                            <div class="footer-item social-items">
                                <h4>{{ __('store.social_media') }} </h4>
                                <ul class="list-unstyled footer-list"
                                    style="display:flex; justify-content:space-around;">
                                    <a class="social-icon" href="{{ $information->facebook }}" target="_blank">
                                        <img width="36"
                                             src="{{ asset('store/theme_2/catalog/social-icons/facebook.png')}}"
                                             alt="Facebook">
                                    </a>
                                    <a class="social-icon" href="{{ $information->twitter }}" target="_blank">
                                        <img width="36"
                                             src="{{ asset('store/theme_2/catalog/social-icons/twitter.png')}}"
                                             alt="Twitter">
                                    </a>

                                    <a class="social-icon" href="{{ $information->youtube }}" target="_blank">
                                        <img width="36"
                                             src="{{ asset('store/theme_2/catalog/social-icons/youtube.png')}}"
                                             alt="Youtube">
                                    </a>
                                    
                                    

                                    @if($information->whatsapp!=null)
                                        <a class="social-icon" target="_blank"
                                           href="https://api.whatsapp.com/send?phone={{ $information->whatsapp}}">
                                            <i class="fa fa-whatsapp"></i>
                                        </a>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            @if( !request()->is('checkout'))
                @include("Store.components.copyright")
            @endif
        @endif
        <!-- Hookables -->
            <!--<cookie-consent message="بتصفحك للمتجر، فأنت توافق على &lt;a href=&quot;/pages/terms-and-conditions&quot;&gt;الشروط والسياسات&lt;/a&gt; الخاصة بنا"></cookie-consent>-->
        </div>

    
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
           {{--     <script
                        src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
                        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
                        crossorigin="anonymous"></script>--}}
        <script type="text/javascript"
                src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
        <script type="text/javascript"
                src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
        <script>
            // Here we set the whole Dotshop object
            window.Dotshop = {
                env: "production",
                assetsDomain: "https://static3.youcan.shop",
                store: {
                    "name": "\u0643\u0648\u0631\u0646 \u0634\u0648\u0628",
                    "country_code": null,
                    "online_settings": {
                        "analytics": null,
                        "fb_pixel": {
                            "ids": ["399282560523412", "1010959186106748"],
                            "deliverability_rate": 53,
                            "conversion_type": 1
                        },
                        "snap_pixel": {"ids": [], "deliverability_rate": 100, "conversion_type": 1},
                        "tiktok_pixel": {"ids": [], "conversion_type": 1, "deliverability_rate": 100},
                        "google_analytics": {
                            "ids": ["UA-187900486-1"],
                            "deliverability_rate": 100,
                            "conversion_type": 1
                        },
                        "footer": "<div style=\"position: fixed;right: 0px;bottom: 0px;width:70px;margin-right: 2.5rem;margin-bottom: 3rem;\">\n    <a href=\"https:\/\/api.whatsapp.com\/send?phone={{$store->information()->first()->phone}}\">\n        <img src=\"https:\/\/image.flaticon.com\/icons\/svg\/1383\/1383269.svg\">\n    <\/a>\n<\/div>",
                        "header": "<!-- Global site tag (gtag.js) - Google Ads: 441149805 -->\n<script async src=\"https:\/\/www.googletagmanager.com\/gtag\/js?id=AW-441149805\"><\/script>\n<script>\n  window.dataLayer = window.dataLayer || [];\n  function gtag(){dataLayer.push(arguments);}\n  gtag('js', new Date());\n\n  gtag('config', 'AW-441149805');\n<\/script>",
                        "notifications": true
                    },
                    "multicurrency_settings": {"isMulticurrencyActive": false, "usePrecision": true},
                    "domain": {"name": "rimcorner.shop"},
                    "currencyPrecision": false
                },
                customer: false,
                csrfToken: "DOGrckYSTY0cEtrPz7yoYktYAAbAQLsdNY1plAEd",
                locale: "ar_SA",
                currency: {"code": "XOF", "symbol": "\u0623\u0648\u0642\u064a\u0629 \u062c\u062f\u064a\u062f\u0629"},
                customerCurrency: {
                    "code": "XOF",
                    "symbol": "\u0623\u0648\u0642\u064a\u0629 \u062c\u062f\u064a\u062f\u0629"
                },
                font: {
                    "menu": {"text": "Cairo", "value": "Cairo", "category": "sans-serif"},
                    "body": {"text": "Cairo", "value": "Cairo", "category": "sans-serif"}
                },
                features: null,
            }
        </script>


        @yield('script')
        @stack('script')
        <!-- Custom JavaScript code -->


        <script src="{{ asset('store/theme_5/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('store/theme_5/js/global.js')}}"></script>
        <script src="{{ asset('store/theme_5/js/cart.js')}}"></script>
        <script src="{{ asset('store/theme_5/js/validation-rule-templates.js')}}"></script>
        <script src="{{ asset('store/theme_5/js/validator2.js')}}"></script>
        <script src="{{ asset('store/theme_5/js/debouncer.js')}}"></script>
        <script src="{{ asset('store/theme_5/js/money.js')}}"></script>
        <script src="{{ asset('store/theme_5/js/topbar.js')}}"></script>
        <script src="{{ asset('store/theme_5/js/desktop-menu.js')}}"></script>


        @include('Store.components.footerscript_5')

        <script>
            $(document).ready(function () {
                document.getElementById("pay").focus();
            })
        </script>
        <!-- Google Analytics code -->

        </body>
        </html>
