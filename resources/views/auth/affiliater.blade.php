<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Be Affiliater !</title>
    <link href="{{  asset('site/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/jquery-confirm.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/intlTelInput.css') }}" rel="stylesheet"/>
    <link href="{{ asset('site/css/slick.css') }}" rel="stylesheet"/>
    <link href="{{ asset('site/css/slick-theme.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('site/css/custom2.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/sweetalert2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('site/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('site/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('site/js/uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('site/js/jquery-confirm.js') }}" type="text/javascript"></script>
    <script src="{{ asset('site/js/slick.min.js') }}" type="text/javascript"></script>
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
    <style type="text/css">
        .login-container .auth-top {
            margin: 0px;
        }

        .login-container .auth-logo {
            height: 35px;
        }

        .login-container .auth-title {
            font-size: 15px;
        }

        .login-container .content-wrapper {
            padding: 0px;
        }

        .panel-body {
            padding: 0px 20px;
        }

        .store-link-url {
            line-height: 3em !important;
        }

        .icon-mobile {
            position: absolute;
            height: 42px;
            z-index: 10000;
        }

        .invalid-feedback {
            display: block !important;
        }

        .hide {
            display: none !important;
        }

        .login-container .form-control {
            border-color: #d7d2d2 !important;
            border-radius: 0px;
        }

        .input-group-addon {
            border-bottom: 1px solid #ced4da;
        }

        .intl-tel-input .country-list {
            overflow-x: hidden !important;
        }

        .iti-mobile .intl-tel-input.iti-container {
            right: 0 !important;
        }

        .country.standard {
            direction: ltr !important;
        }

        .are_you_inviter {
            line-height: 3em;
            color: #982ec6 !important;
        }

        .affiliate-field {
            display: none;
        }

    </style>

</head>
<body class="login-page container pt-4">
<div class="page-container login-container">
    <div class="page-content">
        <div class="container mt-4">
            <div class="row mt-4">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="header text-center">
                        <h4>
                            @if(app()->getLocale() == 'ar')
                                    
                                مرحبا بكـ كمسوق 
                                
                            @else
                                
                                Welcome As Affiliater
                            
                            @endif
                        </h4>
                        <p>
                            @if(app()->getLocale() == 'ar')
                                
                                الان يمكنك ان تصبح مسوق لاكثر من 1000 منتج علي منصتنا بعمولات مميزة و تزيد ارباحك
                                
                            @else
                                Now you can be affiliater for more than 1000 products in our website
                            @endif
                        </p>
                    </div>
                    <div class="form mt-4">
                        @if (isset($errors) && count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form method="post" action="{{ route('submit-affiliate') }}">
                                @csrf
                                <div class="form-group">
                                    <label>
                                        <b>{{ __('site.username') }}</b>
                                    </label>
                                    <input type="text" max="191" required="true" name="username" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>
                                        <b>{{ __('site.phone') }}</b>
                                    </label>
                                    <input type="phone" max="191" required="true" name="phone" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>
                                        <b>{{ __('site.email') }}</b>
                                    </label>
                                    <input type="email" max="191" required="true" name="email" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>
                                        <b>{{ __('site.password') }}</b>
                                    </label>
                                    <input type="password" max="191" required="true" name="password" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">
                                        
                                        @if(app()->getLocale() == 'ar')
                                            تسجيل جديد
                                        @else
                                            Register
                                        @endif
                                        
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        
                </div>
            </div>
        </div>
    </div>
     <div class=" text-muted text-center">
                    <a href="{{ route('site.index') }}">Made By Marssa</a>
                    &copy; {{ now()->year }}
                </div>
</div>
<script src="{{ asset('site/js/utils.js') }}"></script>
<script src="{{ asset('site/js/intlTelInput-jquery.min.js') }}"></script>

</body>
</html>
{{--Developed Saed Z. Sinwar--}}
