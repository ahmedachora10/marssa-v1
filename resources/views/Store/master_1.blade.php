<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <title>{{ $head_data['title_' . app()->getLocale()] ?? '' }}</title>
    @if ($information['icon'])
        <link rel="shortcut icon" href="{{ asset($information?->icon) }}" type="image/x-icon" />
        <link rel="icon" href="{{ asset($information?->icon) }}" type="image/x-icon" />
        <link rel="apple-touch-icon" href=”{{ asset($information?->icon) }}" />
    @endif
    <meta name="robots" content="index,follow">
    <meta name="robots" content="ALL">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $head_data['title_' . app()->getLocale()] ?? '' }}" />
    <meta property="og:description" content="{!! $details != 'index'
        ? substr($product['description_' . app()->getLocale()], 0, 300)
        : substr($head_data['description_' . app()->getLocale()], 0, 300) !!}" />
    <meta property="og:image" content="{{ asset($head_data['icon']) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ $head_data['title_' . app()->getLocale()] ?? '' }}" />
    <meta property="article:author" content="{{ $information?->facebook ?? '' }}" />
    <meta property="article:publisher" content="{{ $information?->facebook ?? '' }}" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:domain" content="{{ url('/') }}">
    <meta name="twitter:site" content="{{ $head_data['title_' . app()->getLocale()] ?? '' }}">
    <meta name="twitter:creator" content="{{ $head_data['title_' . app()->getLocale()] ?? '' }}">
    <meta name="twitter:image:src" content="{{ asset($head_data['icon']) }}">
    <meta name="twitter:description" content="{!! $details != 'index'
        ? substr($product['description_' . app()->getLocale()], 0, 300)
        : substr($head_data['description_' . app()->getLocale()], 0, 300) !!}" />
    <meta name="twitter:title" content="{{ $head_data['title_' . app()->getLocale()] ?? '' }}">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="keywords" content="{{ $head_data['keyword_' . app()->getLocale()] ?? '' }}">
    <meta name="description" content="{!! $details != 'index'
        ? substr($product['description_' . app()->getLocale()], 0, 300)
        : substr($head_data['description_' . app()->getLocale()], 0, 300) !!}" />
    <meta name="author" content="{{ $head_data['title_' . app()->getLocale()] ?? '' }}">
    <meta name="rating" content="General">
    <meta name="revisit-after" content="1 days">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset($information?->icon) }}">
    <meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css?family=Barlow:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('store/theme_1/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('store/theme_1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('store/theme_1/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('store/theme_1/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('store/theme_1/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('store/theme_1/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('store/theme_1/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('store/theme_1/plugins/gimpo-icons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('store/theme_1/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('store/theme_1/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_1/css/custom.css') }}">
    <!-- Hotjar Tracking Code for https://marssa.shop/dashboard -->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 2533375,
                hjsv: 6
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    <style>
        .footer__bg p,
        .footer__bg h3,
        .footer__bg p {
            color: #fff !important;
        }

        .btn__cart {
            background-color: rgb(0, 90, 60) !important;
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

        .btn__cart:hover {
            background-color: rgb(0, 70, 46) !important;
        }

        .copyright {
            text-align: center;
            background: #3774f1;
            padding: 15px;
            color: #ffffff;
        }

        .copyright__link {
            color: #ffc107 !important;
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
    @if ($option === 0)
        <style>
            .spikes {
                position: relative;
                background: {{ $css_style['header_background'] }};
                height: 30vh;

                @if (isset($css_style['background_image']))
                    background-image: url('{{ asset($css_style['background_image']) }}');
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;
                @endif













            }

            .inner-banner__title,
            .header-navigation ul.navigation-box>li>a {
                color: {{ $css_style['header_text_color'] }} !important;
            }

            .spikes::after {
                content: '';
                position: absolute;
                right: 0;
                left: -12%;
                top: 100%;
                z-index: 10;
                display: block;
                height: 47px;
                background-size: 40px 100%;
                background-image: linear-gradient(135deg, {{ $css_style['header_background'] }} 25%, transparent 25%), linear-gradient(225deg, {{ $css_style['header_background'] }} 25%, transparent 25%);
                background-position: 0 0;
            }

            .site-footer {
                background-image: none;
                background-color: {{ $css_style['footer_background'] }};
            }

            .footer-widget__title,
            .site-footer__copy {

                color: {{ $css_style['footer_text_color'] }} !important;
            }

            .addtoCartButtonBackGround {
                background-color: {{ $css_style['background_add_to_cart_button'] }} !important;
                border-color: {{ $css_style['background_add_to_cart_button'] }} !important;
            }

            .BuyNowHomeButtonBackGround {
                background-color: {{ $css_style['background_buy_now_button'] }} !important;
                border-color: {{ $css_style['background_buy_now_button'] }} !important;
            }

            .BuyNowCartButtonBackGround {
                background-color: {{ $css_style['background_check_out_buy_now_button'] }} !important;
                border-color: {{ $css_style['background_check_out_buy_now_button'] }} !important;
            }
        </style>
    @endif
    <style>
        .pagination {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-top: 40px;
        }

        .title-section {
            text-align: center !important;
            font-size: 30px;
            color: #333;
            font-weight: bold;
        }

        .title-section span {
            border-bottom: 3px solid #ffc515;
            padding-bottom: 17px;
        }

        .image_center {
            height: 300px !important;
            vertical-align: middle !important;
            display: flex !important;
        }
    </style>
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_2/css/style-rtl.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_2/css/responsive-rtl.css') }}">
    @endif

    @if ($information['google_tag_manager'] ?? false)
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', "{{ $information['google_tag_manager'] }}");
        </script>
    @endif
    @yield('head')
    @stack('head')
</head>
<style>
    .site-footer {
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

    .navigation-box {
        text-align: start;
    }
</style>

<body>


    <div class="loadding"
        style="background-color: #0000007d;
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 999999;
display: none">
    </div>
    @if ($information['google_tag_manager'] ?? false)
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ $information['google_tag_manager'] }}"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

    @if ($information['facebook_pixel_id'] ?? false)
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
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
                src="https://www.facebook.com/tr?id={{ $information['facebook_pixel_id'] }}&ev=PageView&noscript=1" />
        </noscript>
    @endif
    {{-- <div class="preloader"><span></span></div> --}}

    <div class="page-wrapper">
        @if (!$ads)
            @if (!in_array(request()->path(), ['checkout', 'make_order']))
                <header class="site-header__header-one site-header__header-one ">
                    <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky">
                        <div class="container clearfix">
                            <div class="logo-box clearfix">
                                <a class="navbar-brand" href="{{ url('') }}">
                                    <img src="{{ asset($information?->logo) }}" class="main-logo" width="100"
                                        alt="logo store" />
                                </a>
                                @if (!in_array(request()->path(), ['checkout', 'make_order']))
                                    <div class="text-center d-lg-none d-sm-block">

                                        <a href="{{ url('cart') }}"
                                            class="thm-btn header__cta-btn cartCount text-dark">
                                            <i class="fa fa-shopping-cart"></i>
                                            {{ \Gloudemans\Shoppingcart\Facades\Cart::count() }}
                                        </a>
                                    </div>
                                    <button class="menu-toggler" data-target="#main-navigation" id="menu-toggler">
                                        <span class="fa fa-bars"></span>
                                    </button>
                                @endif
                            </div>

                            @if (!in_array(request()->path(), ['checkout', 'make_order']))
                                <div class="main-navigation" id="main-navigation">
                                    <ul class="one-page-scroll-menu navigation-box">
                                        <li style="padding-left: 15px !important;padding-right: 15px !important;">
                                            <a href="{{ url('') }}" class="current">{{ __('store.home') }}</a>
                                        </li>
                                        <li style="padding-left: 15px !important;padding-right: 15px !important;">
                                            <a href="{{ url('') }}#products">{{ __('store.products') }}</a>
                                        </li>
                                        {{--                            @if ($categories) --}}
                                        {{--                                <li><a href="#">{{ __('site.Categories') }}</a> --}}
                                        {{--                                    <ul class="sub-menu"> --}}
                                        {{--                                        @foreach ($categories as $category) --}}
                                        {{--                                            <li> --}}
                                        {{--                                                <a href="{{ url("") }}/category/{{$category->id}}"> --}}
                                        {{--                                                    {{ $category['name_'.app()->getLocale()] }} --}}
                                        {{--                                                </a> --}}
                                        {{--                                            </li> --}}
                                        {{--                                        @endforeach --}}
                                        {{--                                    </ul> --}}
                                        {{--                                </li> --}}
                                        {{--                            @endif --}}
                                        @if ($categories)

                                            @foreach ($categories as $category)
                                                <li class="nav-item"
                                                    style="padding-left: 15px !important;padding-right: 15px !important;">
                                                    <a href="{{ url('') }}/category/{{ $category->id }}">
                                                        {{ $category['name_' . app()->getLocale()] }}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                        <li class="nav-item"
                                            style="padding-left: 15px !important;padding-right: 15px !important;">
                                            <a href="{{ url('') }}#footer"
                                                class="nav-link">{{ __('store.call-us') }}</a>
                                        </li>
                                        @if ($store->language > 1)
                                            <li class="nav-item dropdown"
                                                style="padding-left: 15px !important;padding-right: 15px !important;">
                                                <a class="nav-link2 dropdown-toggle" href="#"
                                                    id="navbarDropdown" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    {{ __('master.Select_lang') }}
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    @if ($store->language == 2)
                                                        @foreach (['ar', 'en', 'fr'] as $value)
                                                            @if ($value !== app()->getLocale())
                                                                <a class="dropdown-item"
                                                                    href="{{ route('locale', ['locale' => $value]) }}">{{ __('master.' . $value) }}</a>
                                                            @endif
                                                        @endforeach
                                                    @elseif($store->language == 4)
                                                        @foreach (['ar', 'fr'] as $value)
                                                            @if ($value !== app()->getLocale())
                                                                <a class="dropdown-item"
                                                                    href="{{ route('locale', ['locale' => $value]) }}">{{ __('master.' . $value) }}</a>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="right-side-box d-none d-xl-block ">


                                    <a href="{{ url('cart') }}" class="thm-btn header__cta-btn cartCount">
                                        <i class="fa fa-shopping-cart"></i>
                                        {{ \Gloudemans\Shoppingcart\Facades\Cart::count() }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </nav>
                </header>
            @endif
            @if (in_array(request()->path(), ['checkout', 'make_order']))
                <nav class="navbar navbar-expand-lg navbar-light bg-light "
                    style="background-color: #299ff3 !important;">
                    <div class="container"
                        @if (in_array(request()->path(), ['checkout', 'make_order'])) style="justify-content: center;display: inline-grid;" @endif>

                        <div class="navbar-header d-flex">

                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ asset($information?->logo) }}" width="90" height="90"
                                    class="d-inline-block align-top" alt="">
                            </a>
                        </div>
                    </div>
                </nav>
            @endif
        @endif

        @if (!in_array(request()->path(), ['checkout', 'make_order']))
            <section class="spikes inner-banner mb-50" id="home">
                <div class="container">
                </div>
            </section>
        @endif

        @yield('content')

        @if (!$ads)

            @if (!in_array(request()->path(), ['checkout', 'make_order']))
                @if (!request()->is('make_order'))
                    <footer class="site-footer" id="footer">
                        @if ($option === 1)
                            <div class="site-footer__bubble-1"></div>
                            <div class="site-footer__line"></div>
                            <div class="site-footer__bubble-2"></div>
                        @endif
                        <div class="site-footer__upper">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 d-flex justify-content-between footer-widget__links-wrap">
                                        <div class="footer-widget footer-widget__about">
                                            <p>
                                                <a href="{{ url('') }}" class="footer-widget__logo">
                                                    <img src="{{ asset($information?->logo) }}" width="100"
                                                        alt="website logo" />
                                                </a>
                                            </p>
                                            <h3 class="footer-widget__title">
                                                {{ $head_data['title_' . app()->getLocale()] }}</h3>
                                            <p>{!! $details != 'index'
                                                ? substr($product['description_' . app()->getLocale()], 0, 300)
                                                : substr($head_data['description_' . app()->getLocale()], 0, 300) !!}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex justify-content-between footer-widget__links-wrap">
                                        <div class="footer-widget">
                                            <h3 class="footer-widget__title">{{ __('store.about_us') }}</h3>
                                            @foreach ($pages as $page)
                                                <p class="footer-widget__contact">
                                                    <a
                                                        href="{{ $page->route_page() }}">{{ $page['title_' . app()->getLocale()] }}</a>
                                                </p>
                                            @endforeach
                                            <h3 class="footer-widget__title" style="margin-top: 40px;">
                                                {{ __('store.call-us') }}</h3>
                                            <p class="footer-widget__contact">
                                                <a
                                                    href="tel:{{ $information?->phone }}">{{ $information?->phone }}</a>
                                            </p>
                                            <p class="footer-widget__contact">
                                                <a
                                                    href="mailto:{{ $information?->email }}">{{ $information?->email }}</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex justify-content-between footer-widget__links-wrap">
                                        <div class="footer-widget">
                                            @if (isset($information?->footer_payments_image))
                                                <div style="display: flex;margin-bottom: 20px;">
                                                    @forelse(json_decode($information?->footer_payments_image ?? '') ?? [] as $item)
                                                        <img style="height: 70px;width: 70px ;margin: 0 10px"
                                                            src="{{ asset($item) }}">
                                                    @empty
                                                        <img
                                                            src="{{ asset('store/theme_2/catalog/partner-logos/payment/cashondelivery.png') }}">
                                                        <img style="height: 70px;"
                                                            src="{{ asset('store/theme_2/catalog/partner-logos/payment/paypal.png') }}">

                                                        <img style="height: 70px;"
                                                            src="{{ asset('store/theme_2/catalog/partner-logos/payment/bankily_png.png') }}">

                                                        <img style="height: 70px; "
                                                            src="{{ asset('img/msrafi.jpeg') }}">
                                                    @endforelse
                                                </div>

                                            @endif
                                            <h3 class="footer-widget__title">{{ __('store.our_address') }}</h3>
                                            <p>{{ $information?->address }}</p>
                                            <h3 class="footer-widget__title" style="margin-top: 40px;">
                                                {{ __('store.social_media') }}</h3>
                                            <div class="site-footer__social">
                                                @if ($information?->facebook)
                                                    <a href="{{ $information?->facebook }}"
                                                        class="fa fa-facebook-square"></a>
                                                @endif
                                                @if ($information?->twitter)
                                                    <a href="{{ $information?->twitter }}" class="fa fa-twitter"></a>
                                                @endif
                                                @if ($information?->instagram)
                                                    <a href="{{ $information?->instagram }}"
                                                        class="fa fa-instagram"></a>
                                                @endif
                                                @if ($information?->whatsapp)
                                                    <a href="https://api.whatsapp.com/send?phone={{ $information?->whatsapp }}"
                                                        class="fa fa-whatsapp"></a>
                                                @endif
                                                @if ($information?->youtube)
                                                    <a href="{{ $information?->youtube }}" class="fa fa-youtube"></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                    @if (!request()->is('checkout'))
                        <div style="direction: ltr!important;">
                            @include('Store.components.copyright')
                        </div>
                    @endif
                @endif
            @endif
        @endif
    </div>


    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


    <script src="{{ asset('store/theme_1/js/jquery.min.js') }}"></script>
    <script src="{{ asset('store/theme_1/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('store/theme_1/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('store/theme_1/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('store/theme_1/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('store/theme_1/js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('store/theme_1/js/wow.js') }}"></script>
    <script src="{{ asset('store/theme_1/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('store/theme_1/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('store/theme_1/js/swiper.min.js') }}"></script>
    <script src="{{ asset('store/theme_1/js/jquery.easing.min.js') }}"></script>
    <!--<script src="{{ asset('store/theme_1/js/theme.js') }}"></script>-->
    @yield('script')
    @stack('script')
    @include('Store.components.footerscript')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <script>
        $(document).ready(function() {
            $('.menu-toggler').on('click', function() {

                var x = document.getElementById("main-navigation");
                if (x.style.display === "block") {
                    x.style.display = "none";
                } else {
                    x.style.display = "block";
                }
            });
            $("#pay").focus();
        });
    </script>
</body>

</html>
