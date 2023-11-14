<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">
    <title>{{ $head_data['title_'.app()->getLocale()]  ?? '' }} </title>

    @if($information['icon'])
        <link rel="shortcut icon" href="{{ asset($information->icon) }}" type="image/x-icon"/>
        <link rel="icon" href="{{ asset($information->icon) }}" type="image/x-icon"/>
        <link rel="apple-touch-icon" href=”{{ asset($information->icon) }}"/>
    @endif
    <meta name="robots" content="index,follow">
    <meta name="robots" content="ALL">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}"/>
    <meta property="og:description" content="{!! substr($head_data['description_'.app()->getLocale()], 0, 300) !!}"/>
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
    <meta name="twitter:description" content="{!! substr($head_data['description_'.app()->getLocale()], 0, 300) !!}">
    <meta name="twitter:title" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}">
    <meta name="twitter:url" content="{{url()->current()}}">
    <meta name="keywords" content="{{ $head_data['keyword_'.app()->getLocale()] ?? '' }}">
    <meta name="description" content="{!! substr($head_data['description_'.app()->getLocale()], 0, 300) !!}">
    <meta name="author" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}">
    <meta name="rating" content="General">
    <meta name="revisit-after" content="1 days">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<!--<link rel="stylesheet" href="{{ asset('site/css/site.css') }}">-->

    <!-- New STYLE THEME -->
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="{{ asset('site/css/fontawesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('site/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/flaticon.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('site/css/animate.min.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css') }}">
    <!-- Light Case -->
    <link rel="stylesheet" href="{{ asset('site/css/lightcase.min.css') }}" type="text/css">
    <!-- Template style -->
    <link rel="stylesheet" href="{{ asset('site/css/styleThemeUpdated1.css') }}">
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
        .language-list {
            display: none;
        }

        @media (max-width: 650px) {
            .language-list {
                display: inherit;
            }
        }

        @media (max-width: 500px) {
            .language-list.left {
                left: 90px !important;
            }

            .language-list.right {
                right: 90px !important;
            }
        }
    </style>
    <!-- EndStyle -->

    @if( app()->getLocale() != 'ar' )
        <style>
            .feature-content, #pricing, #contact, footer, #how-it-work {
                direction: ltr !important;
                text-align: left !important;
            }
        </style>
    @endif

    @yield('head')

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
    <style>
        
.sidebar {
	width: 200px; height: 100vh; position: fixed; top: 0; left: -255px; z-index: 999; 
	background: #fff; color: #000; transition: all .3s; box-shadow: 3px 3px 3px rgba(51, 51, 51, 0.5);
	text-align: left;
}

.sidebar.active { left: 0; }

.dismiss {
	width: 35px; height: 35px; position: absolute; top: 10px; right: 10px; transition: all .3s;  color:#fff;
	background: #6745b6; border-radius: 4px; text-align: center; line-height: 35px; cursor: pointer;
}

.dismiss:hover, .dismiss:focus { background: #6745b6; color: #fff; }

.sidebar .logo {    margin-top: 10px; padding: 40px 20px; border-bottom: 1px solid #6745b6; transition: all .3s; }

.sidebar .logo a {
	display: inline-block;
	width: 150px;
	background: url(../img/logo.png) left top no-repeat;
	border: 0;
	text-indent: -999999px;
}

.sidebar ul.menu-elements { padding: 10px 0; border-bottom: 1px solid #444; transition: all .3s; }

.sidebar ul li a {
	display: block; padding: 10px 20px;
	border: 0; color: #6745b6;
}
.sidebar ul li a:hover,
.sidebar ul li a:focus,
.sidebar ul li.active > a:hover,
.sidebar ul li.active > a:focus { outline: 0; background: #6745b6; color: #fff; }

.sidebar ul li a i { margin-right: 5px; }

.sidebar ul li.active > a, a[aria-expanded="true"] {
	background: #6745b6;
	color: #fff;
}

.sidebar ul ul a { background: #fff; padding-left: 30px; font-size: 14px; }

.sidebar ul ul li.active > a { background: #6745b6; }

.sidebar a[data-toggle="collapse"] {
    position: relative;
}

.sidebar .dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

.sidebar .to-top { padding: 20px; text-align: center; }

.sidebar .dark-light-buttons { padding: 10px 20px 30px 20px; text-align: center; }


/***** Dark overlay *****/

.overlay {
    display: none; position: fixed; width: 100vw; height: 100vh; 
    background: rgba(51, 51, 51, 0.7); z-index: 998; opacity: 0; transition: all .5s ease-in-out;
}

.overlay.active { display: block; opacity: 1; }


/***** Content *****/

.content { width: 100%; transition: all 0.3s; }

.open-menu { position: fixed; top: 20px; left: 10px; z-index: 997; box-shadow: 3px 3px 3px rgba(51, 51, 51, 0.2); }

.open-menu.btn-customized,
.open-menu.btn-customized:hover, 
.open-menu.btn-customized:active, 
.open-menu.btn-customized:focus, 
.open-menu.btn-customized:active:focus, 
.open-menu.btn-customized.active:focus,
.open-menu.btn-customized.btn.btn-primary:not(:disabled):not(.disabled):active,
.open-menu.btn-customized.btn.btn-primary:not(:disabled):not(.disabled):active:focus {
    box-shadow: none;
}


/***** Buttons 4px 4px 4px rgb(72 15 95) *****/

a.btn-customized {
	margin-left: 5px; margin-right: 5px; padding: .75rem 1.5rem; 
	background: #fff; border: 0; border-radius: 25px; 
	font-size: 16px; font-weight: 300; color: #6745b6; box-shadow: none;
}

a.btn-customized:hover, 
a.btn-customized:active, 
a.btn-customized:focus, 
a.btn-customized:active:focus, 
a.btn-customized.active:focus,
a.btn-customized.btn.btn-primary:not(:disabled):not(.disabled):active,
a.btn-customized.btn.btn-primary:not(:disabled):not(.disabled):active:focus {
	outline: 0; background: rgb(72 15 95 / 51%); border: 0; color: #fff; box-shadow: none;
}

a.btn-customized-2 {
	margin-left: 5px; margin-right: 5px; padding: .75rem 1.5rem; 
	background: #fff; border: 0; border-radius: 4px; 
	font-size: 16px; font-weight: 300; color: #555; box-shadow: none;
}

a.btn-customized-2:hover, 
a.btn-customized-2:active, 
a.btn-customized-2:focus, 
a.btn-customized-2:active:focus, 
a.btn-customized-2.active:focus,
a.btn-customized-2.btn.btn-primary:not(:disabled):not(.disabled):active,
a.btn-customized-2.btn.btn-primary:not(:disabled):not(.disabled):active:focus {
	outline: 0; background: #ccc; background: rgba(255, 255, 255, 0.5); border: 0; color: #555; box-shadow: none;
}

a.btn-customized-3 {
	display: inline-block; width: 100%; margin: 0; padding: .75rem 1.5rem; 
	background: #444; border: 0; border-radius: 4px; 
	font-size: 16px; font-weight: 300; color: #fff; box-shadow: none;
}

a.btn-customized-3:hover, 
a.btn-customized-3:active, 
a.btn-customized-3:focus, 
a.btn-customized-3:active:focus, 
a.btn-customized-3.active:focus,
a.btn-customized-3.btn.btn-primary:not(:disabled):not(.disabled):active,
a.btn-customized-3.btn.btn-primary:not(:disabled):not(.disabled):active:focus {
	outline: 0; background: #555; border: 0; color: #fff; box-shadow: none;
}

a.btn-customized i, 
a.btn-customized-2 i,
a.btn-customized-3 i { margin-right: 5px; }


a.btn-customized-4 {
	display: inline-block; width: 28px; height: 28px; margin: 0 3px; padding: 0; 
	background: #444; border: 0; border-radius: 50%; 
	font-size: 16px; font-weight: 300; color: #fff; box-shadow: none; text-indent: -999999px;
}

a.btn-customized-4.btn-customized-dark { background: #222; }
a.btn-customized-4.btn-customized-light { background: #fff; }

a.btn-customized-4.btn-customized-dark:hover, 
a.btn-customized-4.btn-customized-dark:active, 
a.btn-customized-4.btn-customized-dark:focus, 
a.btn-customized-4.btn-customized-dark:active:focus, 
a.btn-customized-4.btn-customized-dark.active:focus,
a.btn-customized-4.btn-customized-dark.btn.btn-primary:not(:disabled):not(.disabled):active,
a.btn-customized-4.btn-customized-dark.btn.btn-primary:not(:disabled):not(.disabled):active:focus {
	outline: 0; background: #555; border: 0; color: #fff; box-shadow: none;
}

a.btn-customized-4.btn-customized-light:hover, 
a.btn-customized-4.btn-customized-light:active, 
a.btn-customized-4.btn-customized-light:focus, 
a.btn-customized-4.btn-customized-light:active:focus, 
a.btn-customized-4.btn-customized-light.active:focus,
a.btn-customized-4.btn-customized-light.btn.btn-primary:not(:disabled):not(.disabled):active,
a.btn-customized-4.btn-customized-light.btn.btn-primary:not(:disabled):not(.disabled):active:focus {
	outline: 0; background: #555; border: 0; color: #fff; box-shadow: none;
}

            .open-menu{
                display:none !important;
            }
        @media (max-width: 750px) {
            .navbar_2{
                display:none !important;
            }
            .open-menu{
                display:block !important;
            }
        }
    </style>
</head>
<body style="oveflow-x:hidden">
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
        <img height="1" width="1" style="display:none" alt="noscript"
             src="https://www.facebook.com/tr?id={{ $information['facebook_pixel_id'] }}&ev=PageView&noscript=1"/>
    </noscript>
@endif


<!-- preloader -->
<div id="preloader">
    <div id="preloader-circle">
        <span></span>
        <span></span>
    </div>
</div>
<!-- /preloader -->
<!--Start Header Area-->
<header class="header-area" id="header-area">
   
    <nav class="navbar navbar-expand-md fixed-top navbar_2" >
        <div class="container">
            <div class="site-logo">
                <a class="navbar-brand" href="{{ url('/') }}">

                    <img src="{{ asset($information->logo) }}" class="img-fluid" alt="Img"/>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon " style="line-height:35px;color: #a447cb;"><i class="ti-menu"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav" style="@if(app()->getLocale()=='ar') text-align: start;direction: rtl; @else
                text-align: start;direction: ltr;
                @endif">

                    <li class="nav-item"><a
                                title="{{ __('site.main') }}" href="{{ route('site.index') }}"
                                data-wpel-link="external"

                                rel="nofollow external noopener noreferrer">{{ __('site.main') }}</a></li>
                   {{-- <li class="nav-item @yield('pricing_page')">
                        <a title="{{ __('site.pricing') }}" href="{{ route('site.pricing') }}"
                           data-wpel-link="internal">{{ __('site.pricing') }}</a>
--}}

                    @if(app()->getLocale() == 'en')
                        <li class="nav-item"><a
                                    title="عربي" href="{{ route('locale',['locale' => 'ar']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">عربي</a></li>
                        <li class="nav-item"><a
                                    title="French" href="{{ route('locale',['locale' => 'fr']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">French</a></li>
                    @elseif(app()->getLocale() == 'fr')
                        <li class="nav-item"><a
                                    title="English" href="{{ route('locale',['locale' => 'en']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">English</a></li>
                        <li class="nav-item"><a
                                    title="عربي" href="{{ route('locale',['locale' => 'ar']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">عربي</a></li>
                    @else
                        <li class="nav-item"><a
                                    title="French" href="{{ route('locale',['locale' => 'fr']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">French</a></li>
                        <li class="nav-item"><a
                                    title="English" href="{{ route('locale',['locale' => 'en']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">English</a></li>
                    @endif
                    @guest
                        <li class="nav-item"><a
                                    title="{{ __('site.login') }}" href="{{ route('site.login') }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">{{ __('site.login') }}
                            </a></li>
                    @endguest


                </ul>
            </div>
        </div>
    </nav>
    
			<!-- Sidebar -->
	 		<nav class="sidebar">
				
				<!-- close sidebar menu -->
				<div class="dismiss" style="z-index: 1;">
					<i class="fas fa-arrow-left"></i>
				</div>
				
				<div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset($information->logo) }}" class="img-fluid" alt="Img"/>
                </a>
				</div>
				
				<ul class="list-unstyled menu-elements">
					<li @if(request()->routeIs('site.index') ) class="active" @endif>
						<a class="scroll-link"
                                title="{{ __('site.main') }}" href="{{ route('site.index') }}"
                                data-wpel-link="external"

                                rel="nofollow external noopener noreferrer">{{ __('site.main') }}</a>
					</li>@if(app()->getLocale() == 'en')
                        <li >
                            <a class="scroll-link"
                                    title="عربي" href="{{ route('locale',['locale' => 'ar']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">عربي</a></li>
                        <li ><a class="scroll-link"
                                    title="French" href="{{ route('locale',['locale' => 'fr']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">French</a></li>
                    @elseif(app()->getLocale() == 'fr')
                        <li ><a class="scroll-link"
                                    title="English" href="{{ route('locale',['locale' => 'en']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">English</a></li>
                        <li ><a class="scroll-link"
                                    title="عربي" href="{{ route('locale',['locale' => 'ar']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">عربي</a></li>
                    @else
                        <li ><a class="scroll-link"
                                    title="French" href="{{ route('locale',['locale' => 'fr']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">French</a></li>
                        <li ><a class="scroll-link"
                                    title="English" href="{{ route('locale',['locale' => 'en']) }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">English</a></li>
                    @endif
                    @guest
                        <li >
                            <a  class="scroll-link"
                                    title="{{ __('site.login') }}" href="{{ route('site.login') }}"
                                    data-wpel-link="external"
                                    rel="nofollow external noopener noreferrer">{{ __('site.login') }}
                            </a></li>
                    @endguest

					</li>
				</ul>
			
			</nav>
			<!-- End sidebar -->
</header>
<div class="overlay"></div>

	<!-- open sidebar menu -->
	<a class="btn btn-primary btn-customized open-menu" href="#" role="button" style="background:#6745b6;color:#fff;">
        <i class="fas fa-align-left"></i> <span>{{ __('site.menu') }}</span>
    </a>
@yield('content')
<div class="btn-group language-list p-2" style="position: fixed;top: 20px;right: 107px;z-index: 1000000000;right: 15px !important;">

    <button type="button" class="btn btn-dark dropdown-toggle border-0" style="background: #6745b6"
            data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
        {{getLanguageName(app()->getLocale())}}
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="{{ route('locale',['locale' => 'ar']) }}" class="dropdown-item"
           type="button">{{getLanguageName('ar')}}</a>
        <a href="{{ route('locale',['locale' => 'en']) }}" class="dropdown-item"
           type="button">{{getLanguageName('en')}}</a>
        <a href="{{ route('locale',['locale' => 'fr']) }}" class="dropdown-item"
           type="button">{{getLanguageName('fr')}}</a>
    </div>

</div>
<div class="language-list" style="width: fit-content;position: fixed;top: 69px;left: 102px;z-index: 1000000000;right: 25px !important;">
    <a class="btn btn-dark border-0" style="background: #6745b6" href="{{url('/login')}}">{{__("site.login")}}</a>
</div>
<footer>
    <div class="shape-top"></div>
    <div class="container">
        <!-- End Footer Top  Area -->
        <div class="top-footer">
            <div class="row">
                <!-- Start Column 1 -->
                <div class="col-md-4">
                    <div class="footer-logo">
                        <img src="{{ asset($information->logo) }}" class="img-fluid" alt="marssa.shop"/>
                    </div>
                    <div class="footer-social-links">


                        <a href="https://api.whatsapp.com/send?phone={{ $information->whatsapp  ?? ''}}"
                           data-wpel-link="external" target="_blank" rel="nofollow external noopener noreferrer">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                        <a href="{{$information->instagram  ?? ''}}" data-wpel-link="external" target="_blank"
                           rel="nofollow external noopener noreferrer">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="{{$information->facebook  ?? ''}}" data-wpel-link="external" target="_blank"
                           rel="nofollow external noopener noreferrer">
                            <i class="fab fa-facebook"></i>
                        </a>

                        <a href="{{$information->youtube  ?? ''}}" data-wpel-link="external" target="_blank"
                           rel="nofollow external noopener noreferrer">
                            <i class="fab fa-youtube"></i>
                        </a>

                    </div>
                </div>
                <!-- End Column 1 -->
                <!-- Start Column 2 -->
                <div class="col-md-4">
                    <h4 class="footer-title">روابط مهمه</h4>
                    <ul class="footer-links">
                        @foreach($pages as $page)
                            <li>
                                <a href="{{ route('site.show_page',['page'=>$page->link]) }}"> {{ $page['title_'.app()->getLocale()] }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <!-- End Column 2 -->
            </div>
        </div>
        <!-- End Footer Top  Area -->
        <!-- Start Copyrights Area -->
        <div class="copyrights">
        <!-- <p style="padding:0px;margin-top:0px;border:none;">
                    <img src="{{ asset('site/images/new_theme/cod.png') }}" style="width:auto;height:75px" />
                    <img src="{{ asset('site/images/new_theme/paypal.png') }}" style="width:auto;height:145px" />
                    <img src="{{ asset('site/images/new_theme/bankily.png') }}" style="width:auto;height:65px" />
                </p>-->
            <p><i class="flaticon-like-2"></i> <a
                        href="{{ url('/') }}"> {{ __('site.all_rights_save') }} {{$information['title_page_'.app()->getLocale()]  ?? ''}}
                    © {{ now()->year }}</a></p>
        </div>
        <!-- End Copyrights Area -->
    </div>
</footer>

<!-- End Footer Area -->
<!-- Start To Top Button -->
<div id="back-to-top">
    <a class="top" id="top" href="#header-area"> <i class="ti-angle-up"></i> </a>
</div>

<!-- End To Top Button -->
<!-- Start JS FILES -->
<!-- JQuery -->
<script src="{{ asset('site/js/new_theme/jquery.min.js') }}"></script>
<script src="{{ asset('site/js/new_theme/popper.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('site/js/new_theme/bootstrap.min.js') }}"></script>

<script>
    $(document).ready(function() {

	$('.dismiss, .overlay').on('click', function() {
        $('.sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('.open-menu').on('click', function(e) {
    	e.preventDefault();
        $('.sidebar').addClass('active');
        $('.overlay').addClass('active');
        // close opened sub-menus
        $('.collapse.show').toggleClass('show');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
    });
</script>
<!-- Wow Animation -->
<script src="{{ asset('site/js/new_theme/wow.min.js') }}"></script>
<!-- Owl Coursel -->
<script src="{{ asset('site/js/new_theme/owl.carousel.min.js') }}"></script>
<!-- Images LightCase -->
<script src="{{ asset('site/js/new_theme/lightcase.min.js') }}"></script>
<!-- scrollIt -->
<script src="{{ asset('site/js/new_theme/scrollIt.min.js') }}"></script>
<!-- Main Script -->
<script src="{{ asset('site/js/new_theme/script.js') }}"></script>


@yield('script')
</body>
</html>
