<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{  $information['title_page_'.app()->getLocale()]  ?? '' }} - {{ __('site.create_store') }}</title>
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
<body class="login-page container">
    
<div class="page-container login-container">
    <div class="page-content">
        <div class="login-testimonials">
            <div class="" style="margin-top:25vh;">
                <div class="slider-1">
                    @if($feedback ?? false)
                        @foreach($feedback as $item)
                            <div class="testimonials-wrapper">
                                <img src="{{ asset($item->image) }}"
                                     alt="{{ $item['name_'.app()->getLocale()] }} icon">
                                <p>{{ $item['comment_'.app()->getLocale()] }}</p>
                                <div>{{ $item['name_'.app()->getLocale()] }}</div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="content-wrapper" id="content_box">
            <div class="content">
                <div class="row to-right">
                    <div class="col-xs-12" @if(app()->getLocale() == 'en') style="direction: ltr;" @endif>
                        <div class="auth-top">
                            <a href="{{ route('site.index') }}">
                                @if(isset($information))
                                    <img src="{{ asset($information['logo'] ?? '') }}" class="auth-logo"
                                         alt="{{ $information['title_page_'.app()->getLocale()]  ?? '' }}">
                                @endif
                                <h5 class="auth-title">{{ $information['title_page_'.app()->getLocale()]  ?? '' }}</h5>
                            </a>
                        </div>
                        <div class="panel registration-form">
                            <div class="panel-body">
                                <div class="text-center">
                                    <h5 class="content-group-lg"> ✨ {{ __('site.welcome_world') }} ✨ </h5>
                                </div>
                                <form id="form" class="stepy-validation" action="{{ route('site.register') }}"
                                      method="post">
                                    @csrf
                                    <input type="hidden" name="_country_iso2" id="_country_iso2" value="">
                                    <input type="hidden" name="_country_name" id="_country_name" value="">
                                    <input type="hidden" name="_country_mobile_code_country"
                                           id="_country_mobile_code_country" value="">
                                    <input type="hidden" name="international_mobile" id="international_mobile"
                                           value="{{ old('international_mobile') }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group @error('store_name') has-error @enderror ">
                                                <div class="input-group  ">
                                                    <span class="input-group-addon"><i class="sicon-store2"></i></span>
                                                    <input type="text" name="store_name"
                                                           class="form-control required data-hj-whitelist"
                                                           maxlength="30" value="{{ old('store_name') }}"
                                                           placeholder="{{ __('master.store_name') }} ...">
                                                </div>
                                                @error('store_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-12">

                                            <!--div class="form-group  @error('store_url') has-error @enderror ">
                                                <label class="text-center">
                                                    ({{__("store.withoutSpace")}})
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="sicon-link"></i></span>
                                                    <input type="text"
                                                           class="form-control text-left-align allow-english-only data-hj-whitelist"
                                                           maxlength="30" placeholder="{{ __('master.store_domain') }}"
                                                           id="store_url"
                                                           name="store_url" value="{{ old('store_url') }}"
                                                           style="direction:ltr">
                                                    <span class="input-group-addon store-link-url text-ltr">{{ env('APP_URL') }}
                                                        /</span>
                                                </div>
                                                @error('store_url')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div-->
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group @error('mobile') has-error @enderror @error('international_mobile') has-error @enderror ">

                                                <div class="input-group">
                                                    <span class="input-group-addon icon-mobile"><i
                                                                class="sicon-iphone"></i></span>
                                                    <input type="text" class="form-control data-hj-whitelist"
                                                           style="direction: ltr;"
                                                           placeholder="{{ __('master.mobile')}}" id="mobile"
                                                           name="mobile" value="{{ old('mobile') }}"
                                                            readonly
                                                           onfocus="this.removeAttribute('readonly');">
                                                </div><!--onkeyup="parseArabicNumbers('mobile')"-->
                                                @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                @error('international_mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                                <span id="error-msg" class="hide"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group @error('password') has-error @enderror ">

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="sicon-key"></i></span>
                                                    <input type="password" name="password" class="form-control required"
                                                           placeholder="{{ __('master.Password')}}">
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <a class="font-14 are_you_inviter">
                                            <i class="@if(app()->getLocale() == 'en') sicon-caret-left @else sicon-caret-right  @endif position-right text-bottom"></i>
                                            {{ __('master.are_you_inviter') }}
                                        </a>
                                        <div class="col-md-12 affiliate-field">
                                            <div class="form-group @error('refrence_affiliate_id') has-error @enderror">

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="sicon-key"></i></span>
                                                    <input type="text" name="refrence_affiliate_id" class="form-control"
                                                           placeholder="كود الدعوة"
                                                           value="{{ request()->has('reference_id') ? request()->query('reference_id') : '' }}"
                                                            {{ !empty(request()->query('reference_id')) ? 'readonly' : '' }}>
                                                </div>
                                                @error('refrence_affiliate_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12  text-center">
                                            <p class="mb-30">{{ __('master.register_i_agree') }}
                                                <a href='{{ route('site.show_page',['page'=>'terms']) }}'>{{ __('site.UsageAgreement') }}</a> {{ __('master.and') }}
                                                <a href='{{ route('site.show_page',['page'=>'privacy']) }}'>{{ __('site.privacy_policy') }}</a>
                                            </p>
                                            <button type="submit" id="submit_btn"
                                                    class="btn btn-tiffany btn-block stepy-finish">{{ __('site.create_store') }}
                                            </button>
                                            <br>
                                            <a href="{{ route('site.login') }}" class="font-14">
                                                <i class="@if(app()->getLocale() == 'en') sicon-caret-left @else sicon-caret-right  @endif position-right text-bottom"></i>
                                                {{ __('site.returnTologin') }}
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer text-muted to-right">
                    <a href="{{ route('site.index') }}">{{ $information['title_page_'.app()->getLocale()]  ?? '' }}</a>
                    &copy; {{ now()->year }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('site/js/utils.js') }}"></script>
<script src="{{ asset('site/js/intlTelInput-jquery.min.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $("#submit_btn").prop("disabled", true);
        @if(old('mobile'))$("#submit_btn").prop("disabled", false);@endif
        var mobile = $("#mobile"),
            errorMsg = $("#error-msg");
        var errorMap = [
            "رقم الجوال لا يتوافق مع الدولة المختارة",
            "رمز الدولة غير صالح",
            "رقم الجوال قصير جداً بالنسبة الدولة المختارة",
            "رقم الجوال طويل جداً بالنسبة الدولة المختارة",
            "رقم الجوال لا يتوافق مع الدولة المختارة",
            "رقم الجوال لا يتوافق مع الدولة المختارة",
        ];
        mobile.intlTelInput({
            preferredCountries: ['sa', 'ae', 'kw', 'bh', 'qa', 'iq', 'om', 'ye', 'eg', 'jo', 'sy', 'ps', 'sd', 'lb', 'dz', 'tn', 'ma', 'ly'],
            formatOnDisplay: false,
            initialCountry: "auto",
            geoIpLookup: function (success, failure) {
                $.get("https://ipinfo.io/", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                });
            },
            separateDialCode: true,
            // autoPlaceholder: 'aggressive',
            {{--            utilsScript: "{{ asset('site/js/utils.js') }}"--}}
        });
        var reset = function () {
            // mobile.removeClass("error");
            // errorMsg.innerHTML = "";
            // errorMsg.addClass("hide");
        };
        mobile.on("change blur focus countrychange", function (e) {
            $("#_country_iso2").val($(this).intlTelInput("getSelectedCountryData").iso2.toUpperCase());
            $("#_country_name").val($(this).intlTelInput("getSelectedCountryData").name);
            $("#_country_mobile_code_country").val($(this).intlTelInput("getSelectedCountryData").dialCode);
            $("#international_mobile").val(mobile.intlTelInput("getNumber"));
        });
        mobile.on("countrychange blur", function () {
            reset();
            if ($.trim($(this).val())) {
                if (!$(this).intlTelInput("isValidNumber")) {
                    var errorCode = $(this).intlTelInput("getValidationError");
                    errorMsg.html(errorMap[errorCode]).fadeIn(1000);
                    $("#submit_btn").prop("disabled", true);
                    // errorMsg.removeClass("hide").css('color', '#882425');
                } else {
                    $("#submit_btn").prop("disabled", false);
                }
            }
        });
        $('.allow-english-only').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z0-9._-]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });

        jQuery('.are_you_inviter').click(function () {
            jQuery('.affiliate-field').slideToggle();
        });
    })
</script>
</body>
</html>
{{--Developed Saed Z. Sinwar--}}
