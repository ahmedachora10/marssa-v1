@extends('auth.forms-layout')
@push('css')
    <link href="{{ asset('site/css/intlTelInput.css') }}" rel="stylesheet"/>
    <script src="{{ asset('site/js/uniform.min.js') }}" type="text/javascript"></script>
@endpush
@section('content-form')
    <div class="page-container login-container">
        <div class="page-content ">

            <div class="content-wrapper" id="content_box">
                <div class="content">
                    <div class="page-container login-container ">
                        <div class="page-content" @if(app()->getLocale() == 'en') style="direction: ltr;" @endif>
                            <div class="auth-top">
                                <a href="{{ route('site.index') }}">
                                    <img src="{{ asset($information->logo) }}" class="auth-logo"
                                         alt="{{ $information['title_page_'.app()->getLocale()]  ?? '' }}">
                                    <h5 class="auth-title">{{ $information['title_page_'.app()->getLocale()]  ?? '' }}</h5>
                                </a>
                            </div>

                            <div class="panel panel-body login-form">
                                @if(session()->has('success'))
                                    <div class="alert alert-success text-center">
                                        {{__('master.password_reset_send_to_whatsapp_successfully_please_login_hear')}}
                                        <a href="{{url('login')}}">{{__("Login")}}</a>
                                    </div>
                                @endif
                                @if($errors->has('store') || $errors->has('name'))
                                    @foreach ($errors->all() as $error)
                                        <div class="alert bg-warning alert-styled-left">
                                        <span class="invalid-feedback">
                                            <strong>{{$error }}</strong>
                                        </span>
                                        </div>
                                    @endforeach
                                @endif
                                <form id="form" role="form" method="POST" action="{{ route('site.whatsapp_message') }}">
                                    <input type="hidden" name="_country_iso2" id="_country_iso2" value="">
                                    <input type="hidden" name="_country_name" id="_country_name" value="">
                                    <input type="hidden" name="_country_mobile_code_country"
                                           id="_country_mobile_code_country" value="">
                                    @csrf
                                    <div class="form-group @error('mobile') has-error @enderror @error('international_mobile') has-error @enderror ">
                                        <div class="input-group"><span class="input-group-addon icon-mobile"><i
                                                        class="sicon-iphone"></i></span>
                                            <input type="text" class="form-control data-hj-whitelist"
                                                   style="direction: ltr;"
                                                   placeholder="{{ __('master.mobile')}}" id="mobile"
                                                   name="mobile" value="{{ old('mobile') }}"
                                                   onkeyup="parseArabicNumbers('mobile')" readonly
                                                   onfocus="this.removeAttribute('readonly');">
                                        </div>
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
                                    <div class="form-group login-options">
                                        <div class="row row-reverse">

                                            <!--<div class="col-xs-6 align-left">-->
                                        <!--    <a target="_blank" href="https://wa.me/{{-- $information->whatsapp --}}?text=I'm%20forget%20my%20password%20help%20me%20to%20get%20new%20password">{{ __('site.ForgotYourPassword') }}</a>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="submit_btn"
                                                class="btn btn-tiffany btn-block">{{ __('site.reset_password') }}<i
                                                    class="@if(app()->getLocale() == 'ar') sicon-caret-left @else sicon-caret-right @endif position-right"></i>
                                        </button>
                                    </div>
                                    <div id="register_box">
                                        <a href="{{ route('site.login') }}" class="font-14">
                                            <i class="@if(app()->getLocale() == 'en') sicon-caret-left @else sicon-caret-right  @endif position-right text-bottom"></i>
                                            {{ __('site.returnTologin') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="footer text-muted">
                        <a href="{{ route('site.index') }}">{{ $information['title_page_'.app()->getLocale()]  ?? '' }}</a>
                        &copy; {{ now()->year }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





@section('form-script')
    <script src="{{ asset('site/js/uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('site/js/utils.js') }}"></script>
    <script src="{{ asset('site/js/intlTelInput-jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
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
                separateDialCode: true,
                initialCountry: "auto",
                geoIpLookup: function(success, failure) {
                    $.get("https://ipinfo.io/", function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        success(countryCode);
                    });
                },
                //

                // autoPlaceholde
                // r: 'aggressive',
                {{--            utilsScript: "{{ asset('site/js/utils.js') }}"--}}
            });
            var reset = function () {
                mobile.removeClass("error");
                errorMsg.innerHTML = "";
                errorMsg.addClass("hide");
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
                        errorMsg.removeClass("hide").css('color', '#882425');
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
            $(".styled").uniform({
                radioClass: 'choice'
            });
            $('#submit_btn').click(function () {
                $('#submit_btn').html('{{ __("site.please_wait") }} ..');
                $('#submit_btn').attr('disabled', true);
                setTimeout(function () {
                    $('#form').submit();
                }, 100);
            });
        });
    </script>
@endsection
