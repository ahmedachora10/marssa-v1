<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{  $information['title_page_'.app()->getLocale()]  ?? '' }} - {{ __('site.login') }}</title>
    <link href="{{  asset('site/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/jquery-confirm.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/slick.css') }}" rel="stylesheet"/>
    <link href="{{ asset('site/css/slick-theme.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('site/css/custom2.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/sweetalert2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('site/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('site/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('site/js/uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('site/js/jquery-confirm.js') }}" type="text/javascript"></script>
    <script src="{{ asset('site/js/slick.min.js') }}" type="text/javascript"></script>
    @stack('css')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.slider-1').slick({
                rtl: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                fade: true,
                autoplay: true,
                autoplaySpeed: 3000
            });
        });
    </script>
    @if(app()->getLocale() == 'en')
        <style>
            .row-reverse {
                display: flex;
            }

            .align-right {
                text-align: left !important;
            }

            .alert.bg-warning[class*=alert-styled-]:after {
                left: -30px;
            }
        </style>
    @endif
</head>
<body class="login-page">
@yield('content-form')
@yield('form-script')
</body>
</html>
{{--Developed Saed Z. Sinwar--}}