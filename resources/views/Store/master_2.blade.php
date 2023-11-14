@if( app()->getLocale()=='fr')
    <html lang="ar">
    @else
        <html lang="{{ app()->getLocale() }}">
        @endif
        <html lang="@if( app()->getLocale()=='fr')en @else{{ app()->getLocale() }} @endif">
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
            <meta name="rating" content="General">
            <meta name="revisit-after" content="1 days">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
            <meta name="msapplication-TileColor" content="#ffffff">
            <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
            <meta name="theme-color" content="#ffffff">

            <link rel="stylesheet" href="{{ asset('store/theme_2/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('store/theme_2/css/all.css')}}">
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=DM+Sans:500&amp;display=swap" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('store/theme_2/css/utilities.css')}}">
            <link rel="stylesheet" href="{{ asset('store/theme_2/css/base.css')}}">
            <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_2/css/custom.css') }}">
            <style type="text/css">
                * {
                    direction: rtl;
                }

                body {
                    text-align: right;
                }

                #main-content {
                    overflow-x: hidden !important;
                }

                .styleIcon {
                    opacity: 0;
                }

            </style>
            <title>اسم المتجر</title>
            <link rel="stylesheet" href="{{ asset('store/theme_2/css/fragments/topbar.css') }}">
            <link rel="stylesheet" href="{{ asset('store/theme_2/css/fragments/cart-floater.css')}}">
            <link rel="stylesheet" href="{{ asset('store/theme_2/css/fragments/product-panel.css')}}">
            <!-- Hotjar Tracking Code for https://marssa.shop/dashboard -->
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


            <style>

                .footer__bg p, .footer__bg h3, .footer__bg p {
                    color: #fff !important;
                }

                .btn__cart {
                    background-color: rgb(0, 90, 60) !important;
                }

                .btn__cart:hover {
                    background-color: rgb(0, 70, 46) !important;
                }

                .bg_newsletter {
                    background-color: rgb(1, 182, 121) !important;
                }

                .title_newsletter {
                    color: #fff !important;
                }

                .subtitle_newsletter {
                    color: rgb(235, 235, 235) !important;
                }

                .input_group_icon_newsletter {
                    position: relative;
                }

                .input_group_icon_newsletter .icon_letter {
                    position: absolute;
                    left: 16px;
                    top: 0;
                    line-height: 40px;
                    z-index: 3;
                }

                .copyright {
                    text-align: center;
                    background: #159393;
                    padding: 15px;
                    color: #ffffff;
                }

                .copyright__link {
                    color: #ffc107 !important;
                }

                .input_group_icon_newsletter .icon_letter i {
                    color: rgb(121, 121, 121);
                }

                .input_group_icon_newsletter .single_input_newsletter {
                    padding-left: 45px;
                }

                .single_input_newsletter {
                    display: block;
                    width: 100%;
                    line-height: 40px;
                    border: none;
                    outline: none;
                    background: rgb(249, 249, 255);
                    padding: 0 20px;
                    border-radius: .25rem !important;
                }

                .btn_newsletter {
                    background: rgb(255, 255, 255);
                    color: rgb(0, 23, 31);
                    border-radius: .25rem !important;
                    outline: none;
                    box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
                    font-weight: 500;
                }

                .show-mobile {
                    display: none !important;
                }

                @media screen and (min-device-width: 81px) and (max-device-width: 768px) {
                    /* STYLES HERE */
                    /*.navbar-nav .nav-link {*/
                    /*    color: #005a3c !important;*/
                    /*}*/
                    .main-logo {
                        width: 50px !important;
                    }

                    .form-search {
                        display: none !important;
                    }

                    .show-mobile {
                        display: block !important;
                    }

                    .xs-hidden {
                        display: none !important;
                    }

                    .cart {
                        display: none !important;

                    }

                    .navbar-nav {
                        padding-top: 10px;
                        padding-right: 15px;
                        line-height: 100%;
                    }

                    .nav-link {

                        font-weight: bold;
                        font-size: 17px;
                    }

                    .dropdown-divider {
                        height: 0;
                        margin: .5rem 0;
                        overflow: hidden;
                        border-top: 1px solid #b5b5b5;
                    }

                    .styleIcon {
                        float: left;
                        margin-top: 10px;
                        font-size: 15px;
                        opacity: 1;
                    }
                }

            </style>
            <style>

                @media only screen and (max-width: 600px) {
                    .bane_im {

                        width: 300px !important;
                    }

                }

                .addToCart {
                    cursor: pointer;
                    border: solid 2px red;
                    background: #e6e6e88f;
                }
            </style>

            <?php
            $default = $css_style['default'];

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
                        background-color: {{$css_style['header_background']}}          !important;
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

                    @endif
                    }
                    .nav-link, .header-navigation ul.navigation-box > li.current > a, .header-navigation ul.navigation-box > li:hover > a, .inner-banner__title, .blog-one__image, .top-level-item {
                        color: {{$css_style['header_text_color']}}         !important;
                    }
                    .footer {
                        background-image: none;
                        background-color: {{$css_style['footer_background']}};
                    }

                    .footer .title, .footer .company-links a, .social-icon {
                        color: {{$css_style['footer_text_color']}}         !important;
                    }

                    .site-footer:before {
                        border-color: {{$css_style['footer_background']}};
                    }

                    .background_add_to_cart_button {
                        background-color: {{$css_style['background_add_to_cart_button']}}         !important;
                        color: {{$css_style['font_add_to_cart_button']}}         !important;
                        border-color: {{$css_style['background_add_to_cart_button']}}         !important;
                    }

                    .background_buy_now_button {
                        background-color: {{$css_style['background_buy_now_button']}}         !important;
                        color: {{$css_style['font_buy_now_button']}}         !important;
                        border-color: {{$css_style['background_buy_now_button']}}         !important;
                        cursor: pointer;
                    }

                    .BuyNowCartButtonBackGround1 {
                        background-color: {{$css_style['background_check_out_buy_now_button']}}         !important;
                        border-color: {{$css_style['background_check_out_buy_now_button']}}         !important;
                    }

                    .btn-theme {
                        background-color: {{$css_style['background_add_to_cart_button']}}         !important;
                        border-color: {{$css_style['background_add_to_cart_button']}}         !important;
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
                        background-color: {{$css_style['background_buy_now_button']}}         !important;
                        border-color: {{$css_style['background_buy_now_button']}}         !important;
                    }
                </style>

            @endif
            <style>
                .image_center {
                    height: 300px !important;
                    vertical-align: middle !important;
                    display: flex !important;
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
            </style>

            <style type="text/css">
                .paginate {
                    text-align: center;
                    padding: 0 35%;
                }

                body {
                    padding-top: 0px;
                }

                .paginate .pagination li {
                    color: black;
                    float: left;
                    padding: 8px 16px;
                    text-decoration: none;
                    transition: background-color .3s;
                    border: 1px solid #ddd;
                    margin: 0 4px;
                }

                .paginate .pagination li.active {
                    color: white;
                    border: 1px solid #4CAF50;
                }

                @media screen and (min-device-width: 81px) and (max-device-width: 768px) {
                    .hidden-xs {
                        display: none !important;
                    }

                }

                .paginate .pagination li:hover:not(.active) {
                    background-color: #ddd;
                }

                .site-footer a {
                    color: #000;
                }

                .site-footer li {
                    color: #000;
                }

                .site-footer h3 {
                    color: #000 !important
                }

                .site-footer p {
                    color: #000 !important
                }

                .cart_2 {
                    background-color: #159393;
                    color: white;
                    padding: 20px;
                    border: 2px solid #ced3d7e;
                    border-radius: 30px;
                    position: fixed;
                    left: 20px;
                    bottom: 50px;
                    box-shadow: 5px 5px 5px #bebebe;
                    z-index: 2;
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
            </style>


            <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_4/css/custom.css') }}">

            @if($information['google_tag_manager'] ?? false)
                <script>(function (w, d, s, l, i) {
                        w[l] = w[l] || [];
                        w[l].push({
                            'gtm.start':
                                new Date().getTime(), event: 'gtm.js'
                        });
                        var f = d.getElementsByTagName(s)[0],
                            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                        j.async = true;
                        j.src =
                            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                        f.parentNode.insertBefore(j, f);
                    })(window, document, 'script', 'dataLayer', "{{ $information['google_tag_manager'] }}");</script>
            @endif
            @yield('head')
            @stack('head')
            <style>
                .dismiss {    
                    width: 35px;height: 35px;margin-left: 25px;margin-right: 25px;transition: all .3s;
                    color: #fff;background: #cc5bfd;border-radius: 4px;text-align: center;line-height: 35px;cursor: pointer;
                }
                 .footer .footer-body,  .footer .footer-brand,  .footer .footer-social{
                    padding: 30px 0;
                } .footer .footer-brand a{
                    margin:auto;
                }
                .footer .footer-brand{
                    justify-content: center;
                    display: flex;
                }
                .footer .footer-brand a img {
                    max-height: 100%;
                    height:100px;
                }
                .footer .footer-item h3 {
                    font-size: 15px;
                    font-weight: 600;
                }
                .list-unstyled {
                    margin: 0;
                    padding: 0;
                }
                .footer .footer-item h3:after {
                    background-color: #9a33c7;
                    margin: 8px 0 0;
                }
                .footer .footer-item h3:after {
                    content: "";
                    display: block;
                    width: 25px;
                    height: 1px;
                }
                .social-items{
                    padding:13px;
                }
                .social-items h4 {
                    text-align: center !important;
                    padding: 15px;
                    margin-left: 30px;
                    margin-right: 30px;
                }
                .social-items .footer-list {
                    display: flex;
                    justify-content: center !important;
                }
                .footer .social-icon{
                    text-decoration: none!important;
                }
                @media (max-width: 768px){
                     .footer .footer-item {
                        text-align: center;
                    }}
                    @media (max-width: 768px)
                    { .footer .footer-item h3:after {
                        margin: 8px auto 0;
                    }}
                .category-lists-navbar {
                    background-color: #9A33C7 !important; 
                    box-shadow: 1px 4px 8px 2px lightgrey;
                }
                .navbar.navbar-expand-lg,
                .navbar-expand-lg .navbar-nav,.navbar-expand-lg .navbar-collapse{
                    background-color: #9A33C7 !important; 
                }.navbar-light .navbar-brand, .navbar-light .navbar-brand,.navbar-light .navbar-nav .nav-link,
                .navbar-light .navbar-nav .active>.nav-link, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .show>.nav-link{
                    color:#fff !important;
                }.navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover,.navbar-light .navbar-nav .nav-link .active{
                    background-color: #b973d8 !important;
                    color:#fff !important;
                }
                @media (max-width: 1124px){
                    .notice-bar.desktop-notice-bar {
                        display: none !important;
                    }
                    .notice-bar.mobile-notice-bar {
                        display: block  !important;
                    }
                    .navbar-header.d-flex{
                        justify-content: space-between;
                        width: 100% ;
                    }
                }
                .notice-bar.mobile-notice-bar {
                    display: none;
                }
                .dropdown-item:focus, .dropdown-item:hover {
                    color: #9a33c7 !important;
                }
            </style>
        </head>

        <body onscroll="onscrollPage()">

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
        <div class="preloader"></div>
        
                        @if( !in_array(request()->path(),['checkout','make_order']))
             @if(!empty($information->head_text))
                    <div class=" notice-bar desktop-notice-bar"
                         style="margin-bottom: 0.7rem;margin-top: 0.7rem;color: #9a33c7;  background-color:#fff !important; ">
                        <div class="container">
                            <div class="fr-view">
                                <p style="text-align: center;"><strong><span
                                                style="font-size: 25px;">{{ $information->head_text }} </span></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($information->head_text))
                    <div
                            class=" notice-bar mobile-notice-bar"
                            style="margin-bottom: 0.7rem;margin-top: 0.7rem;color: #9a33c7;  background-color:#fff !important; ">
                        <div class="container">
                            <div class="fr-view">
                                <p style="text-align: center;"><strong><span
                                                style="font-size: 15px;">{{ $information->head_text }}  </span></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                @endif
        <div id="main-content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light " 
            style="@isset($css_style['header_background']) background-color: {{$css_style['header_background']}} !important; @endisset @isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset">
                <div class="container" 
                        @if( in_array(request()->path(),['checkout','make_order']))
                        style="justify-content: center;display: inline-grid;"
                        @endif>
                    
                  <div class="navbar-header d-flex">
                      
                    <a class="navbar-brand" href="{{ url('/') }}" style="@isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset">
                        <img src="{{ asset($information->logo) }}" width="30" height="30"
                             class="d-inline-block align-top"
                             alt="">
                             
                        @if( !in_array(request()->path(),['checkout','make_order']))
                        {{  $information['title_page_'.app()->getLocale()] }}
                        @endif
                    </a>

                    <button class="navbar-toggler" style="@isset($css_style['header_background']) background-color: {{$css_style['header_background']}} !important; @endisset ">
                        <span class="navbar-toggler-icon" style="@isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset"></span>
                    </button>
                    <a href="{{url('cart')}}" class="background_buy_now_button cart_2" style="@isset($css_style['font_add_to_cart_button']) color: {{$css_style['font_add_to_cart_button']}} !important; @endisset 
                    @isset($css_style['background_add_to_cart_button']) background-color: {{$css_style['background_add_to_cart_button']}} !important; border-color:{{$css_style['background_add_to_cart_button']}} !important; @endisset">
                        <i class="fa fa-shopping-cart"></i><span
                                class="badge"> {{\Gloudemans\Shoppingcart\Facades\Cart::count()}} </span>
                    </a>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarNav"style="@isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset @isset($css_style['header_background']) background-color: {{$css_style['header_background']}} !important; @endisset">
                        @if( !in_array(request()->path(),['checkout','make_order']))
                            <ul class="navbar-nav" style="@isset($css_style['header_background']) background-color: {{$css_style['header_background']}} !important; @endisset @isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('/') }}" style="@isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset   @isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset">  {{ __('store.homepage') }} <i
                                                class="fa fa-caret-left styleIcon"></i> <span
                                                class="sr-only">(current)</span></a>
                                </li>
                                
                            @foreach($categories as $category)
                                @if($loop->index < 10)
                                    <li class="nav-item" style="@isset($css_style['header_background']) background-color: {{$css_style['header_background']}} !important; @endisset @isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset">
                                        <a class="nav-link" style="@isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important;   @endisset @isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset"
                                           href="{{ url('') }}/category/{{$category->id}}">
                                            {{ $category['name_'.app()->getLocale()] }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle other_category" href="#"
                                   id="navbarDropdown" role="button" data-toggle="dropdown" 
                                   style="@isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important;   @endisset @isset($css_style['header_background']) background-color: {{$css_style['header_background']}} !important; @endisset"
                                   aria-haspopup="true" aria-expanded="false">
                                    {{__('site.Other_Category')}}
                                </a>
                                <div class="dropdown-menu other_category "
                                     aria-labelledby="navbarDropdown">
                                    @foreach($categories as $category)
                                        @if($loop->index >= 5)
                                            <a class="dropdown-item" style="@isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important;   @endisset @isset($css_style['header_text_color']) background-color: {{$css_style['header_text_color']}} !important; @endisset"
                                               href="{{ url('') }}/category/{{$category->id}}"> {{ $category['name_'.app()->getLocale()] }} </a>
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                                <div class="dropdown-divider"></div>


                                @if($store->language > 1)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" style="@isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__('master.Select_lang')}}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @if($store->language == 2)
                                                @foreach(['ar','en','fr'] as $value)
                                                    @if($value !== app()->getLocale())

                                            <a class="dropdown-item" 
                                            style="text-align-last: start;@isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset
                                                           href="{{ route('locale',['locale' => $value]) }}">{{__('master.'.$value)}}</a>

                                                    @endif
                                                @endforeach
                                            @elseif($store->language == 4)
                                                @foreach(['ar','fr'] as $value)
                                                    @if($value !== app()->getLocale())

                                                        <a class="dropdown-item" 
                                                        style="text-align-last: start; @isset($css_style['header_text_color']) color: {{$css_style['header_text_color']}} !important; @endisset"
                                                           href="{{ route('locale',['locale' => $value]) }}">{{__('master.'.$value)}}</a>

                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </li>
                                @endif


                            </ul>
                        @endif
                    </div>
                </div>
            </nav>
         {{--   @if( !in_array(request()->path(),['checkout','make_order']))

                <div class="category-lists-navbar">
                    <div class="container">

                        <ul class="navbar-nav">

                            @foreach($categories as $category)
                                @if($loop->index < 10)
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{ url('') }}/category/{{$category->id}}">
                                            {{ $category['name_'.app()->getLocale()] }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach

                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle other_category" href="#"
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
                        </ul>
                    </div>
                </div>
            @endif 
            --}}
            <div class="sidebar-mobile-menu mb-4" style="@isset($css_style['header_background']) background-color: {{$css_style['header_background']}} !important; @endisset">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/') }}">  {{ __('store.homepage') }} <i
                                    class="fa fa-caret-left styleIcon"></i> <span
                                    class="sr-only">(current)</span></a>
                    </li>

                    @if($store->language > 1)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{__('master.Select_lang')}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if($store->language == 2)
                                    @foreach(['ar','en','fr'] as $value)
                                        @if($value !== app()->getLocale())

                                            <a class="dropdown-item" style="text-align-last: start;color: #fff;"
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
                    <div class="dropdown-divider"></div>
                    @foreach($categories as $category)

                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ url('') }}/category/{{$category->id}}">
                                {{ $category['name_'.app()->getLocale()] }}
                            </a>
                        </li>

                    @endforeach
                    <li class="nav-item" style="width: 100%;display: flex;justify-content: end;">
        				<!-- close sidebar menu -->
        				<div class="dismiss" style="z-index: 1;margin-top: 15px;margin: 15px;padding: 10px;@isset($css_style['header_background']) color: {{$css_style['header_background']}} !important;   @endisset @isset($css_style['header_text_color']) background-color: {{$css_style['header_text_color']}} !important; @endisset" >
        					<i class="fas @if(app()->getLocale()=='ar') fa-arrow-right @else fa-arrow-left @endif"></i>
        				</div>
                    </li>
                </ul>
            </div>
            @yield('content')

            @if(url()->current() != url('checkout'))
                @if(!empty($information->banner_footer))
                    <div class="col-lg-12 bg-white shadow-sm">
                        <div class="col-lg-3 col-md-6 col-sm-12 my-3 ">
                            <img data-src="{{ asset($information->banner_footer) }}" style="width: 1350px;"
                                 class="img-responsive bane_im lazy"/>
                        </div>
                    </div>
                @endif
            @endif

            @if(!$ads)
                @if( !in_array(request()->path(),['checkout','make_order']))
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
                  {{--  <div class="footer" style="position:relative;bottom: 0;">
                        <div class="container-fluid pad-sides max960">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <h5 class="title">{{ $head_data['title_'.app()->getLocale()] }} </h5>
                                    <p class="title">  {{ $information->email }}</p>
                                    <p>
                                    <p>{!! $details != 'index' ? substr($product['description_'.app()->getLocale()], 0, 300) : substr($head_data['description_'.app()->getLocale()], 0, 300) !!} </p>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-2 company-links">
                                    <h5 class="title">{{ __('store.about_us') }}</h5>


                                    @foreach($pages as $page)

                                        <a class="mb-1"
                                           href="{{ $page->route_page() }}">{{ $page['title_'.app()->getLocale()] }}</a>

                                    @endforeach
                                    <p class="footer-widget__contact">
                                        <a href="tel:{{ $information->phone }}">{{ $information->phone }}</a>
                                    </p>
                                    <p class="footer-widget__contact">
                                        <a href="mailto:{{ $information->email }}">{{ $information->email }}</a>
                                    </p>

                                </div>
                                <div class="col-12 col-lg-4">
                                    <h5 class="title">{{__('master.payment_methods')}}</h5>
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
                                </div>


                            </div>
                        </div>
                        <div class="col-12 col-lg-2 social-links">


                            <h5 class="title"> {{ __('store.social_media') }}</h5>

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
                            @if($information->whatsapp)
                                <a class="social-icon" target="_blank"
                                   href="https://api.whatsapp.com/send?phone={{ $information->whatsapp}}">
                                    <i class="fa fa-whatsapp"></i>
                                </a>
                            @endif
                        </div>
                    </div>--}}
                    @if( !request()->is('checkout'))
                       {{-- <div style="direction: ltr!important;">
                            @include("Store.components.copyright",['color'=>'#fff','background_color'=>"#c541ff"])
                        </div> --}}
                @include("Store.components.copyright",['color'=>'','background_color'=>"#9a33c7"])
                    @endif
                @endif
            @endif
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.3/mousetrap.min.js"></script>

        <script src="{{ asset('store/theme_2/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('store/theme_2/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('store/theme_2/js/global.js')}}"></script>
        <script src="{{ asset('store/theme_2/js/cart.js')}}"></script>
        <script src="{{ asset('store/theme_2/js/validation-rule-templates.js')}}"></script>
        <script src="{{ asset('store/theme_2/js/validator2.js')}}"></script>
        <script src="{{ asset('store/theme_2/js/debouncer.js')}}"></script>
        <script src="{{ asset('store/theme_2/js/money.js')}}"></script>


        <script type="text/javascript">
            const arabic = true;
            const lang = "ar";
            const STORE_CURRENCY = "USD";
            const menu_v2 = JSON.parse("[{\u0022children\u0022: [{\u0022children\u0022: [{\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/trending\u002Dwomen\u0022, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0623\u005Cu0643\u005Cu062b\u005Cu0631 \u005Cu0631\u005Cu0648\u005Cu0627\u005Cu062c\u005Cu0627\u005Cu064b\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Trending\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/discounted\u002Dwomen\u0022, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0639\u005Cu0631\u005Cu0648\u005Cu0636 \u005Cu0627\u005Cu0644\u005Cu062e\u005Cu0627\u005Cu0635\u005Cu0629\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Discounted\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/new\u002Dreleases\u002Dwomen\u0022, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0625\u005Cu0635\u005Cu062f\u005Cu0627\u005Cu0631\u005Cu0627\u005Cu062a \u005Cu0627\u005Cu0644\u005Cu062c\u005Cu062f\u005Cu064a\u005Cu062f\u005Cu0629\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022New Releases\u0022}], \u0022url\u0022: null, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0623\u005Cu0643\u005Cu062b\u005Cu0631 \u005Cu0637\u005Cu0644\u005Cu0628\u005Cu0627\u005Cu064b\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Recommended\u0022}, {\u0022children\u0022: [{\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/dresses\u0022, \u0022title_ar\u0022: \u0022\u005Cu0641\u005Cu0633\u005Cu0627\u005Cu062a\u005Cu064a\u005Cu0646\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Dresses\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/shoes\u0022, \u0022title_ar\u0022: \u0022\u005Cu0623\u005Cu062d\u005Cu0630\u005Cu064a\u005Cu0629\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Shoes\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/bags\u0022, \u0022title_ar\u0022: \u0022\u005Cu062d\u005Cu0642\u005Cu0627\u005Cu0626\u005Cu0628\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Bags\u0022}], \u0022url\u0022: null, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0641\u005Cu0626\u005Cu0627\u005Cu062a\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Apparel\u0022}, {\u0022children\u0022: [{\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/formal\u002Dwomen\u0022, \u0022title_ar\u0022: \u0022\u005Cu0631\u005Cu0633\u005Cu0645\u005Cu064a\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Formal\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/casual\u002Dwomen\u0022, \u0022title_ar\u0022: \u0022\u005Cu063a\u005Cu064a\u005Cu0631 \u005Cu0631\u005Cu0633\u005Cu0645\u005Cu064a\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Casual\u0022}], \u0022url\u0022: null, \u0022title_ar\u0022: \u0022\u005Cu062a\u005Cu0634\u005Cu0643\u005Cu064a\u005Cu0644\u005Cu0627\u005Cu062a\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Styles\u0022}], \u0022url\u0022: \u0022/ar/collections/women\u0022, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0646\u005Cu0633\u005Cu0627\u005Cu0621\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Women\u0022}, {\u0022children\u0022: [{\u0022children\u0022: [{\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/jeans\u0022, \u0022title_ar\u0022: \u0022\u005Cu062c\u005Cu064a\u005Cu0646\u005Cu0632\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Jeans\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/shirts\u0022, \u0022title_ar\u0022: \u0022\u005Cu0642\u005Cu0645\u005Cu0635\u005Cu0627\u005Cu0646\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Shirts\u0022}], \u0022url\u0022: null, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0641\u005Cu0626\u005Cu0627\u005Cu062a\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Apparel\u0022}, {\u0022children\u0022: [{\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/light\u002Dmen\u0022, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0641\u005Cu0627\u005Cu062a\u005Cu062d\u005Cu0629\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Light\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/dark\u002Dmen\u0022, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu063a\u005Cu0627\u005Cu0645\u005Cu0642\u005Cu0629\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Dark\u0022}], \u0022url\u0022: null, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0623\u005Cu0644\u005Cu0648\u005Cu0627\u005Cu0646\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Colors\u0022}], \u0022url\u0022: \u0022/ar/collections/men\u0022, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0631\u005Cu062c\u005Cu0627\u005Cu0644\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Men\u0022}, {\u0022children\u0022: [{\u0022children\u0022: [{\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/dresses\u0022, \u0022title_ar\u0022: \u0022\u005Cu0641\u005Cu0633\u005Cu0627\u005Cu062a\u005Cu064a\u005Cu0646\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Dresses\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/shoes\u0022, \u0022title_ar\u0022: \u0022\u005Cu0623\u005Cu062d\u005Cu0630\u005Cu064a\u005Cu0629\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Shoes\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/bags\u0022, \u0022title_ar\u0022: \u0022\u005Cu062d\u005Cu0642\u005Cu0627\u005Cu0626\u005Cu0628\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Bags\u0022}], \u0022url\u0022: \u0022/ar/collections/women\u0022, \u0022title_ar\u0022: \u0022\u005Cu0627\u005Cu0644\u005Cu0646\u005Cu0633\u005Cu0627\u005Cu0621\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Women\u0022}], \u0022url\u0022: \u0022/ar/collections/summer\u0022, \u0022title_ar\u0022: \u0022\u005Cu0635\u005Cu064a\u005Cu0641\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Summer\u0022}, {\u0022children\u0022: [{\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/prada\u0022, \u0022title_ar\u0022: \u0022\u005Cu0628\u005Cu0631\u005Cu0627\u005Cu062f\u005Cu0627\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Prada\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/collections/armani\u0022, \u0022title_ar\u0022: \u0022\u005Cu0623\u005Cu0631\u005Cu0645\u005Cu0627\u005Cu0646\u005Cu064a\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Armani\u0022}], \u0022url\u0022: \u0022/ar/collections/brands\u0022, \u0022title_ar\u0022: \u0022\u005Cu0645\u005Cu0627\u005Cu0631\u005Cu0643\u005Cu0627\u005Cu062a\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Brands\u0022}, {\u0022children\u0022: [{\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/pages/customer\u002Dsupport\u0022, \u0022title_ar\u0022: \u0022\u005Cu062e\u005Cu062f\u005Cu0645\u005Cu0629 \u005Cu0627\u005Cu0644\u005Cu0639\u005Cu0645\u005Cu0644\u005Cu0627\u005Cu0621\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Customer Support\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022/ar/pages/refund\u002Dpolicy\u0022, \u0022title_ar\u0022: \u0022\u005Cu0633\u005Cu064a\u005Cu0627\u005Cu0633\u005Cu0629 \u005Cu0627\u005Cu0644\u005Cu0627\u005Cu0633\u005Cu062a\u005Cu0631\u005Cu062c\u005Cu0627\u005Cu0639\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Refund Policy\u0022}, {\u0022children\u0022: [], \u0022url\u0022: \u0022https://shopgo.me\u0022, \u0022title_ar\u0022: \u0022\u005Cu0639\u005Cu0646 \u005Cu0634\u005Cu0648\u005Cu0628 \u005Cu062c\u005Cu0648\u0022, \u0022new_tab\u0022: true, \u0022title_en\u0022: \u0022About ShopGo\u0022}], \u0022url\u0022: null, \u0022title_ar\u0022: \u0022\u005Cu0645\u005Cu0633\u005Cu0627\u005Cu0639\u005Cu062f\u005Cu0629\u0022, \u0022new_tab\u0022: false, \u0022title_en\u0022: \u0022Help\u0022}]");

        </script>


        <script type="text/javascript">
            function onSwipe(element, direction, handler) {

                let touchstartX = 0;
                let touchstartY = 0;
                let touchendX = 0;
                let touchendY = 0;
                const threshold = 50;

                // enabled (flag): asserted on touchStart and de-asserted when handler
                // is called, used to avoid repeated handler calls during the same swipe
                // motion.

                let enabled = false;

                function touchStart(event) {
                    touchstartX = event.changedTouches[0].screenX;
                    touchstartY = event.changedTouches[0].screenY;
                    enabled = true;
                }

                function touchMove(event) {

                    if (!enabled)
                        return false;

                    touchendX = event.changedTouches[0].screenX;
                    touchendY = event.changedTouches[0].screenY;

                    handleGesture();
                }

                function handleGesture() {

                    const swipedLeft = touchendX < touchstartX - threshold;
                    const swipedRight = touchendX > touchstartX + threshold;

                    const runHandler =
                        (swipedLeft && direction == "left")
                        || (swipedRight && direction == "right");

                    if (runHandler) {
                        handler();
                        enabled = false;
                    }

                }

                element.addEventListener('touchstart', touchStart, false);
                element.addEventListener('touchmove', touchMove, false);

            }

            const swipeDirection = arabic ? "right" : "left";

            onSwipe(window, swipeDirection, function () {
                document.querySelector('#menu-opener').checked = false; // close menu
            });

        </script>
        <script src="{{ asset('store/theme_2/js/topbar.js')}}"></script>
        <script src="{{ asset('store/theme_2/js/desktop-menu.js')}}"></script>

        <script type="text/javascript">
            Mousetrap.bind('alt+a', function (e) {

                window.location.href = "#";

            });
            Mousetrap.bind('alt+h', function (e) {
                window.location.href = arabic ? "/ar" : "/";
            });
            Mousetrap.bind('alt+x', function (e) {
                document.querySelector("body").classList.toggle("debug");
            });
        </script>
        <script type="text/javascript">
            // Dispatch custom "jsload" event, to trigger operations after all
            // JS libs have been loaded.
            window.dispatchEvent(new CustomEvent("jsload"));
        </script>
        <script type="text/javascript"
                src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
        <script type="text/javascript"
                src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('.lazy').Lazy();

                }, 1200)

                $(".toTop").click(function () {

                    document.body.scrollTop = document.documentElement.scrollTop = 0;

                });
            });

        </script>
        <script src="{{ asset('store/theme_4/js/jquery.js')}}"></script>
        <script src="{{ asset('store/theme_4/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('store/theme_4/js/jquery.easing.min.js')}}"></script>
        <script src="{{ asset('store/theme_4/js/theme.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
                integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
                crossorigin="anonymous"></script>

        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"
                integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ=="
                crossorigin="anonymous"></script>

        @yield('script')
        <script>
            jQuery(document).ready(function () {
                jQuery('.navbar-toggler , .dismiss').click(function () {
                    jQuery('.sidebar-mobile-menu').toggleClass('show-navbar-menu');
                });
            });
            $(document).ready(function () {
                $('#main-content').scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        jQuery('.navbar').addClass('navbar-fixed-top');
                    } else {
                        jQuery('.navbar').removeClass('navbar-fixed-top');
                    }
                })
            });
            $(document).ready(function () {
                $('#main-content').scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        jQuery('.category-lists-navbar').addClass('fixed-top-nav');
                    } else {
                        jQuery('.category-lists-navbar').removeClass('fixed-top-nav');
                    }
                })
            });
        </script>
        @stack('script')
        @include('Store.components.footerscript')
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
        <script>
            $("#pay").focus()
        </script>
        </body>
        </html>
