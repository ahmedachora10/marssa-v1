<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ $head_data['title_'.app()->getLocale()]  ?? '' }}</title>
    @if($information['icon'])
        <link rel="shortcut icon" href="{{ asset($information->icon) }}" type="image/x-icon"/>
        <link rel="icon" href="{{ asset($information->icon) }}" type="image/x-icon"/>
        <link rel="apple-touch-icon" href=”{{ asset($information->icon) }}"/>
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

    <link rel="stylesheet" href="{{ asset('store/theme_4/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('store/theme_4/css/responsive.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('store/theme_4/style.css') }}">
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
            .navbar-nav .nav-link {
                color: #005a3c !important;
            }

            .main-logo {
                width: 50px !important;
            }

            .form-search {
                display: none !important;
            }

            .show-mobile {
                display: block !important;
            }
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
            background: #f7c324;
            padding: 15px;
            color: #ffffff;
        }

        .copyright__link {
            color: rgb(0, 90, 60) !important;
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
            .scroll-to-top, .blog-one__image {
                background-image: none;
                background-color: {{$css_style['header_background']}};
            }

            .inner-banner {
                background-image: none;
                background-color: {{$css_style['header_background']}};
                @if(isset($css_style['background_image']))
                   background-image: url('{{asset($css_style['background_image'])}}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            @endif






            }

            .header-navigation ul.navigation-box > li.current > a, .header-navigation ul.navigation-box > li:hover > a, .inner-banner__title, .blog-one__image {
                color: {{$css_style['header_text_color']}}      !important;
            }

            .site-footer {
                background-image: none;
                background-color: {{$css_style['footer_background']}};
            }

            .footer-widget__title, .site-footer__copytext {
                color: {{$css_style['footer_text_color']}}      !important;
            }

            .site-footer:before {
                border-color: {{$css_style['footer_background']}};
            }

            .background_add_to_cart_button {
                background-color: {{$css_style['background_add_to_cart_button']}}      !important;
                border-color: {{$css_style['background_add_to_cart_button']}}      !important;
            }

            .background_buy_now_button {
                background-color: {{$css_style['background_buy_now_button']}}      !important;
                border-color: {{$css_style['background_buy_now_button']}}      !important;
            }

            .background_check_out_buy_now_button {
                background-color: {{$css_style['background_check_out_buy_now_button']}}      !important;
                border-color: {{$css_style['background_check_out_buy_now_button']}}      !important;
            }
        </style>

    @endif
    <style>
        .image_center {
            height: 300px !important;
            vertical-align: middle !important;
            display: flex !important;
        }
    </style>
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_2/css/style-rtl.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_2/css/responsive-rtl.css') }}">
    @endif

    <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_4/css/custom.css') }}">
<style>
    .nav-tabs .nav-link.show, .nav-item.active, .nav-item.show{
        background-color:transparent !important;
    }
</style>
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
</head>
<style>
    .footer__bg {
        background: rgb(251 251 251 / 78%);
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
</style>
<body style="overflow-x: hidden;">

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
<div class="preloader">
    <img class="preloader__icon" src="{{ asset('store/theme_4/images/preloader.png')}}" alt="website preloader"/>
</div>

<div class="loadding" style="background-color: #0000007d;
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 999999;
display: none"></div>

<header class="d-flex flex-column shadow">
    <!-- top bar contact -->
<!-- <div class="container-fluid top__bar p-2">
        <div class="container d-flex justify-content-start">
            <a href="#" class="text-light"><i class="fa fa-whatsapp"></i> {{ $information->whatsapp}} </a>
        </div>
    </div> -->
    <!-- search logo cart -->
    <div class="container-fluid search__cart pt-md-4 pt-2">
        <div class="container">
            <div class="row m-0 w-100 align-items-center align-content-center @if(request()->is('checkout')) justify-content-center  @endif"  >

                <div class="col-lg-3 col-12 mb-3 w-100 text-center d-md-block d-none">

                    <a class="text-white mb-0 e" href="{{ url('') }}">
                        <img src="{{ asset($information->logo) }}" class="main-logo" width="100" alt="website logo"/>
                    </a>

                </div>
                
            @if( !request()->is('checkout'))
                <div class="col-lg-6 col-12 mb-3 w-100">
                    <form action="{{ url('') }}?search" class="px-2 w-100 rm-search">
                        <div class="d-flex flex-nowrap align-items-center form-global shadow-sm rounded">
                            <button type="submit"
                                    class="btn btn-link text-decoration-none text-secondary p-2 d-flex justify-content-center">
                                <i class="fa fa-search text-secondary"></i>
                            </button>
                            <input type="text" name="q" class="form-control-search w-100 h-100 rounded"
                                   placeholder="{{ __('store.search') }} ...">
                        </div>
                    </form>
                </div>


                <div class="col-lg-3 col-12 mb-3 w-100 d-flex justify-content-center">
                    <a href="{{url('cart')}}"
                       class="btn btn__cart px-4 py-2 text-white d-flex flex-nowrap align-items-center rounded shadow-sm">
                        <span class="badge text-dark rounded px-2 cart__notif">{{\Gloudemans\Shoppingcart\Facades\Cart::count()}}</span>
                        <span class="px-2">{{ __('store.cart') }}</span>
                        <i class="fa fa-shopping-cart text-white"></i>
                    </a>
                </div>
                <div class="fixed__cart d-none" id="fixed__cart">
                    <a href="{{url('cart')}}" class=" btn btn__cart px-2 py-2 text-white d-flex flex-nowrap rounded
                       shadow">
                    <i class="fa fa-shopping-cart text-white px-2"></i>
                    <span class="badge text-dark rounded px-2 cart__notif">{{\Gloudemans\Shoppingcart\Facades\Cart::count()}}</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- nav bar  -->
            @if( !request()->is('checkout'))
    <nav class="navbar navbar__bg navbar-expand-md navbar-dark" id="sticky_header">

        <a class="navbar-brand d-block d-md-none" href="{{ url('') }}">
            <img src="{{ asset($information->logo) }}" class="main-logo" width="100" alt="website logo"/>
        </a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsTheme"
                aria-controls="navbarsTheme" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsTheme">

            <ul class="navbar-nav mx-auto p-0">
                <li class="nav-item px-2 ">
                    <a class="nav-link" href="{{ url('') }}"> {{ __('store.home') }}</a>
                </li>

                @foreach($categories as $category)
                    <li class="nav-item px-2 ">
                        <a class="nav-link" href="{{ url("") }}/category/{{$category->id}}">
                            {{ $category['name_'.app()->getLocale()] }}
                        </a>
                    </li>
                @endforeach

                @if($store->language > 1)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{__('master.Select_lang')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
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
    </nav>
    @endif
</header>

<main role="main" class="container-fluid p-0">

    @yield('content')



    @if(url()->current() != url('checkout'))
        @if(!empty($information->banner_footer))
            <div class="col-lg-12 bg-white shadow-sm">
                <div class="col-lg-3 col-md-6 col-sm-12 my-3 ">
                    <img src="{{ asset($information->banner_footer) }}" class="img-responsive"/>
                </div>
            </div>
        @endif
        @if(!$ads)
            @if(!request()->is('make_order'))
                <footer class="site-footer footer__bg" id="footer">
                    <div class="site-footer__upper">
                        <div class="container">
                            <div class="site-footer__5-col-wrap">
                                <div class="col-lg-4 footer-widget footer-widget__about">
                                    <p>
                                        <a href="{{ url("") }}" class="footer-widget__logo">
                                            <img src="{{ asset($information->logo) }}" width="100" alt="website logo"/>
                                        </a>
                                    </p>
                                    <h3 class="footer-widget__title">{{ $head_data['title_'.app()->getLocale()] }}</h3>
                                    <p>{!! $details != 'index' ? substr($product['description_'.app()->getLocale()], 0, 300) : substr($head_data['description_'.app()->getLocale()], 0, 300) !!}</p>
                                </div>
                                <div class="col-lg-4 footer-widget">
                                    <h3 class="footer-widget__title">{{ __('store.about_us') }}</h3>
                                    @foreach($pages as $page)
                                        <p class="footer-widget__contact">
                                            <a href="{{ $page->route_page() }}">{{ $page['title_'.app()->getLocale()] }}</a>
                                        </p>
                                    @endforeach
                                    <h3 class="footer-widget__title"
                                        style="margin-top: 40px;">{{ __('store.call-us') }}</h3>
                                    <p class="footer-widget__contact">
                                        <a href="tel:{{ $information->phone }}">{{ $information->phone }}</a>
                                    </p>
                                    <p class="footer-widget__contact">
                                        <a href="mailto:{{ $information->email }}">{{ $information->email }}</a>
                                    </p>
                                </div>
                                <div class="col-lg-4  footer-widget">
                                    <div style="display: flex;margin-bottom: 20px;">
                                        @if(isset($information->footer_payments_image))
                                            @forelse(json_decode($information->footer_payments_image ?? '') ?? [] as $item)
                                                <img style="height: 70px;width: 70px ;margin: 0 10px"
                                                     src="{{ asset($item)}}">
                                            @empty
                                                <img src="{{ asset('store/theme_2/catalog/partner-logos/payment/cashondelivery.png')}}">
                                                <img style="height: 70px;"
                                                     src="{{ asset('store/theme_2/catalog/partner-logos/payment/paypal.png')}}">
                                                <img style="height: 70px;"
                                                     src="{{ asset('img/msrafi.jpeg')}}">
                                                <img style="height: 70px; "
                                                     src="{{ asset('store/theme_2/catalog/partner-logos/payment/bankily_png.png')}}">
                                            @endforelse
                                        @endif
                                    </div>
                                    <h3 class="footer-widget__title">{{ __('store.our_address') }}</h3>
                                    <p>{{ $information->address  }}</p>
                                    <h3 class="footer-widget__title"
                                        style="margin-top: 40px;">{{ __('store.social_media') }}</h3>
                                    <div class="site-footer__social">
                                        @if($information->facebook)
                                            <a href="{{ $information->facebook }}"><i class="fa fa-facebook-square"></i></a>
                                        @endif
                                        @if($information->twitter)
                                            <a href="{{ $information->twitter }}"><i class="fa fa-twitter"></i></a>
                                        @endif
                                        @if($information->instagram)
                                            <a href="{{ $information->instagram }}"><i class="fa fa-instagram"></i></a>
                                        @endif
                                        @if($information->whatsapp)
                                            <a href="https://api.whatsapp.com/send?phone={{ $information->whatsapp}}">
                                                <i class="fa fa-whatsapp"></i>
                                            </a>
                                        @endif
                                        @if($information->youtube)
                                            <a href="{{ $information->youtube }}"><i class="fa fa-youtube"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                @if( !request()->is('checkout'))
                    <div style="direction: ltr!important;">
                        @include("Store.components.copyright")
                    </div>
                @endif
            @endif
        @endif
    @endif

</main>


<div class="fixed__cart" id="fixed__cart">
    <a href="{{url('cart')}}" class="btn btn-dark btn__cart px-2 py-2 text-white d-flex flex-nowrap rounded shadow">
        <i class="fa fa-shopping-cart text-white px-2"></i>
        <span class="badge text-dark rounded px-2 cart__notif">{{\Gloudemans\Shoppingcart\Facades\Cart::count()}}</span>
    </a>
</div>
<script src="{{ asset('store/theme_4/js/jquery.js')}}"></script>
<script src="{{ asset('store/theme_4/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('store/theme_4/js/jquery.easing.min.js')}}"></script>
<script src="{{ asset('store/theme_4/js/theme.js')}}"></script>
@yield('script')
@stack('script')
@include('Store.components.footerscript')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<script>
    $("#pay").focus()
</script>
</body>
</html>
