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
<link rel="stylesheet" href="{{ asset('store/theme_3/css/bootstrap.min.css') }}">

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


     <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_4/css/custom.css') }}">
      <link rel="stylesheet" href="{{ asset('store/theme_3/css/templatemo-sixteen.css') }}">

       <link rel="stylesheet" href="{{ asset('store/theme_3/css/owl.css') }}">
       <!-- Hotjar Tracking Code for https://marssa.shop/dashboard -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:2533375,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>

    @if($option === 0)
        <style>
        .btn__cart {
            background-color: rgb(0, 90, 60) !important;
}
.btn__cart:hover {
    background-color: rgb(0, 70, 46)  !important;
}
            .navbar {
                background-image: none;
                background-color: {{$css_style['header_background']}} !important;
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
            .banner-item{
                background-image: url('{{asset($css_style['background_image'])}}');

                background-size: cover;
                background-repeat: no-repeat;
                background-position: center center;
            }
            .nav-link {
                color: {{$css_style['header_text_color']}}!important;
            }
            .site-footer {
                background-image: none;
                background-color: {{$css_style['footer_background']}};
            }
            .footer-widget__title ,.site-footer__copytext{
                color: {{$css_style['footer_text_color']}}!important;
            }
            .site-footer:before {
                border-color: {{$css_style['footer_background']}};
            }
            .background_add_to_cart_button {
                background-color: {{$css_style['background_add_to_cart_button']}}!important;
                border-color: {{$css_style['background_add_to_cart_button']}}!important;
            }
            .background_buy_now_button {
                background-color: {{$css_style['background_buy_now_button']}}!important;
                border-color: {{$css_style['background_buy_now_button']}}!important;
            }
            .background_check_out_buy_now_button {
                background-color: {{$css_style['background_check_out_buy_now_button']}}!important;
                border-color: {{$css_style['background_check_out_buy_now_button']}}!important;
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
    @endif

    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_2/css/style-rtl.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('store/theme_2/css/responsive-rtl.css') }}">
    @endif



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

<body>

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

<div class="page-wrapper">
    @if(!$ads)
        @if(!request()->is('make_order'))

            <!--        <header class="site-header header-one ">-->
<!--            <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky">-->
<!--                <div class="container clearfix">-->
<!--                    <div class="logo-box clearfix">-->
<!--                        <a class="navbar-brand" href="{{ url("") }}">-->
<!--                            <img src="{{ asset($information->logo) }}" class="main-logo" width="100" alt="website logo"/>-->
<!--                        </a>-->

<!--                        <button class="menu-toggler" data-target=".main-navigation">-->
<!--                            <span class="fa fa-bars"></span>-->
<!--                        </button>-->
<!--                    </div>-->

<!--                    <div class="text-center d-lg-none d-sm-block">-->
<!--                        @if($store->language == 2)-->
<!--                            <select class="thm-btn header__cta-btn" onChange="document.location = this.value">-->
<!--                                <option value="" disabled selected>{{__('master.Select_lang')}}</option>-->
<!--                                @foreach(['ar','en','fr'] as $value)-->
<!--                                    @if($value !== app()->getLocale())-->
<!--                                        <option value="{{ route('locale',['locale' => $value]) }}">{{__('master.'.$value)}}</option>-->
<!--                                    @endif-->
<!--                                @endforeach-->
<!--                            </select>-->
<!--                        @endif-->

<!--                        <a href="{{url('cart')}}" class="thm-btn header__cta-btn cartCount">-->
<!--                            <i class="fa fa-shopping-cart"></i> {{\Gloudemans\Shoppingcart\Facades\Cart::count()}}-->
<!--                        </a>-->
<!--                    </div>-->
<!--                    <div class="main-navigation">-->
<!--                        <ul class=" navigation-box one-page-scroll-menu ">-->
<!--                            <li class="current ">-->
<!--                                <a href="{{ url("") }}">{{ __('store.home') }}</a>-->
<!--                            </li>-->
<!--                            <li class="">-->
<!--                                <a href="{{ url("") }}#products">{{ __('store.products') }}</a>-->
<!--                            </li>-->
<!--{{--                            @if($categories)--}}-->
<!--{{--                                <li><a href="#">{{ __('site.Categories') }}</a>--}}-->
<!--{{--                                    <ul class="sub-menu">--}}-->
<!--{{--                                        @foreach($categories as $category)--}}-->
<!--{{--                                            <li>--}}-->
<!--{{--                                                <a href="{{ url("") }}/category/{{$category->id}}">--}}-->
<!--{{--                                                    {{ $category['name_'.app()->getLocale()] }}--}}-->
<!--{{--                                                </a>--}}-->
<!--{{--                                            </li>--}}-->
<!--{{--                                        @endforeach--}}-->
<!--{{--                                    </ul>--}}-->
<!--{{--                                </li>--}}-->
<!--{{--                            @endif--}}-->

<!--                            @if($categories)-->

<!--                                @foreach($categories as $category)-->
<!--                                    <li>-->
<!--                                        <a href="{{ url("") }}/category/{{$category->id}}">   {{ $category['name_'.app()->getLocale()] }}</a>-->
<!--                                    </li>-->
<!--                                @endforeach-->
<!--                            @endif-->

<!--                            <li class="">-->
<!--                                <a href="{{ url("") }}#footer">{{ __('store.call-us') }}</a>-->
<!--                            </li>-->

<!--                        </ul>-->
<!--                    </div>-->

<!--                    <div class="right-side-box d-none d-xl-block ">-->
<!--                        @if($store->language == 2)-->
<!--                            <select class="thm-btn header__cta-btn" onChange="document.location = this.value">-->
<!--                                <option value="" disabled selected>{{__('master.Select_lang')}}</option>-->
<!--                                @foreach(['ar','en','fr'] as $value)-->
<!--                                    @if($value !== app()->getLocale())-->
<!--                                        <option value="{{ route('locale',['locale' => $value]) }}">{{__('master.'.$value)}}</option>-->
<!--                                    @endif-->
<!--                                @endforeach-->
<!--                            </select>-->
<!--                        @endif-->

<!--                        <a href="{{url('cart')}}" class="thm-btn header__cta-btn cartCount">-->
<!--                            <i class="fa fa-shopping-cart"></i> {{\Gloudemans\Shoppingcart\Facades\Cart::count()}}-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </nav>-->
<!--        </header>-->
@endif
@endif
 <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>ز
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" @if(app()->getLocale() == 'ar') style="position: absolute;left: 170px;"  @endif href="index.html"><em>{{ $head_data['title_'.app()->getLocale()]  ?? '' }}</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                 <li class="nav-item" style="padding-top:10px;">
                     @foreach(['sa' => 'ar', 'us' =>'en','fr'=>'fr'] as $key => $lang)
                        @if($lang !== app()->getLocale())
                        <a class="custom_a text-inverse" href="{{ route('locale',['locale' => $lang]) }}">
                                    <img style="width: 30px" data-toggle="tooltip"
                                         data-placement="bottom" title="{{__('master.'.$lang)}}" src="https://lipis.github.io/flag-icon-css/flags/4x3/{{$key}}.svg">

                                </a>
                    @endif
                    @endforeach

              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{ url("") }}"> {{ __('store.home') }}
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                   <a class="nav-link" href="{{ url("") }}#products">{{ __('store.products') }}</a>
              </li>

            </ul>

          </div>
        </div>
      </nav>
    </header>
{{--
    @endif--}}


    @yield('content')

    @if(!$ads)

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
<script src="{{ asset('store/theme_1/js/theme.js') }}"></script>



<script src="{{ asset('store/theme_3/js/accordions.js') }}"></script>
<script src="{{ asset('store/theme_3/js/custom.js') }}"></script>
<script src="{{ asset('store/theme_3/js/isotope.js') }}"></script>
<script src="{{ asset('store/theme_3/js/owl.js') }}"></script>
@yield('script')
@stack('script')
@include('Store.components.footerscript')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<script>
    $("#pay").focus()
</script>
</body>
</html>
