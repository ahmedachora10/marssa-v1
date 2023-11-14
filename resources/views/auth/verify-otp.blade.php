@extends('auth.forms-layout')

@section('content-form')
<style type="text/css">
.testimonials-wrapper img {
    border-radius:0px;
    width: 60%;
}
.mobile-number
{
    background: #eee !important;
    width: auto;
    display: inline-block;
}
.otp_desc{
    text-align: center;
    line-height:2em;
    font-size:14px;
}
.getcode_class
{
    width: auto;
    display: inline-block;
    height: 45px;
    margin-top: -4px;
}
html[dir="rtl"] #alert-status
{
    padding: 10px;
    text-align: right;
}
html[dir="ltr"] #alert-status
{
    padding: 10px;
    text-align: left;
}
</style>
    <div id="recaptcha-container"></div>
    <div class="page-container login-container">
        <div class="page-content ">
            <div class="login-testimonials">
                <div class="" style="margin-top:25vh;">
                    <div class="slider-1">
                        <div class="testimonials-wrapper">
                            <img src="https://cdn.myoperator.com/img/otp/website-banners.svg"
                                    alt="otp-verify icon">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper" id="content_box">
                <div class="content">
                    <div class="page-container login-container to-right">

                        @if(session()->has('success_registration'))
                            <p class="text-center alert alert-success">
                            {{ session()->get('success_registration') }}
                            </p>
                        @endif

                        <div class="page-content" @if(app()->getLocale() == 'en') style="direction: ltr;" @endif>
                            <div class="auth-top">
                                <a href="{{ route('site.index') }}">
                                    <img src="{{ asset($information->logo) }}" class="auth-logo"
                                        alt="{{ $information['title_page_'.app()->getLocale()]  ?? '' }}">
                                    <h5 class="auth-title">{{ $information['title_page_'.app()->getLocale()]  ?? '' }}</h5>
                                </a>
                            </div>
                            <div class="panel panel-body login-form">
                                <div id="alert-status"></div>
                                <p class="otp_desc">{{ __('site.code_otp_desc') }}</p>
                                @if($errors->has('username') || $errors->has('email') || $errors->has('password'))
                                    @foreach ($errors->all() as $error)
                                        <div class="alert bg-warning alert-styled-left">
                                            <span class="invalid-feedback">
                                                <strong>{{$error }}</strong>
                                            </span>
                                        </div>
                                    @endforeach
                                @endif
                                    <div class="form-group has-feedback @if(app()->getLocale() == 'en') has-feedback-right @else has-feedback-left @endif">
                                        <input type="tel" value="{{ auth()->user()->mobile }}" class="form-control mobile-number" name="password"
                                            placeholder="{{ __('site.mobile') }}" disabled readonly>
                                        <button type="button" id="getcode"
                                                class="btn btn-tiffany btn-block getcode_class">{{ __('site.send_code') }}<i
                                                    class="@if(app()->getLocale() == 'ar') sicon-caret-left @else sicon-caret-right @endif position-right"></i>
                                        </button>
                                    </div>

                                    <div class="form-group has-feedback @if(app()->getLocale() == 'en') has-feedback-right @else has-feedback-left @endif">
                                        <input type="text" class="form-control code-opt " id="codeToVerify" name="password"
                                            placeholder="{{ __('site.code_opt') }}">
                                    </div>

                                    <div class="form-group">
                                        <button type="button" id="verifPhNum"
                                                class="btn btn-tiffany btn-block">{{ __('site.confirm') }}<i
                                                    class="@if(app()->getLocale() == 'ar') sicon-caret-left @else sicon-caret-right @endif position-right"></i>
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <a class="btn btn-warning" style="opacity: .7;color: gray;font-size: 12px;" href="{{ route('site.logout') }}"
                                            onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                            {{ __('master.logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('site.logout') }}" method="POST"
                                                style="display: none;">
                                            @csrf
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
@endsection

@section('form-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>
    <script>
        jQuery(document).ready(function() {

            // For Firebase JS SDK v7.20.0 and later, measurementId is optional
            const firebaseConfig = {
                apiKey: "AIzaSyClMa8wNAFlfI8sCkxXOJnzor9xFdLGrxU",
                authDomain: "sms-marssa.firebaseapp.com",
                projectId: "sms-marssa",
                storageBucket: "sms-marssa.appspot.com",
                messagingSenderId: "313491444432",
                appId: "1:313491444432:web:1da70bdeb7b7ad0b2844d5",
                measurementId: "G-0RXTZGRZHW"
            };


            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);

            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                'size': 'invisible',
                'callback': function(response) {
                    // reCAPTCHA solved, allow signInWithPhoneNumber.
                    console.log('recaptcha resolved');
                }
            });
            onSignInSubmit();
        });



        function onSignInSubmit() {
            jQuery('#verifPhNum').on('click', function() {
                
                var code = jQuery('#codeToVerify').val();
                if(typeof confirmationResult === 'undefined'){
                    jQuery('#alert-status').addClass('alert-danger');
                    jQuery('#alert-status').html("{{ __('site.error_otp') }}");
                    jQuery('#codeToVerify').val("");
                    console.log('s');
                    return;
                }
                if(!code ){
                    jQuery('#alert-status').addClass('alert-danger');
                    jQuery('#alert-status').html("{{ __('site.error_otp') }}");
                    jQuery('#codeToVerify').val("");
                    return;
                }
                
                let phoneNo = '';
                console.log(code);
                $(this).attr('disabled', 'disabled');
                $(this).text("{{ __('site.Processing') }}");
                confirmationResult.confirm(code).then(function(result) {
                    console.log('Succecss');
                    jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: "{{ url('verified/otp-mobile') }}",
                        method: 'GET',
                        data: {
                            type:'ajax',
                        },
                        success: function(result){
                            if(result.status == 'error'){
                                jQuery('#alert-status').addClass('alert-danger');
                                jQuery('#alert-status').html("{{ __('site.error_otp') }}");
                                jQuery('#codeToVerify').val("");
                            }else{
                                jQuery('#alert-status').addClass('alert-success');
                                jQuery('#alert-status').html("{{ __('site.success_otp') }}");
                                jQuery('#codeToVerify').val("");
                                setTimeout(() => {
                                    window.location.href="{{ url('dashboard/index') }}";
                                }, 2000);
                            }
                        }
                    });
                }.bind($(this))).catch(function(error) {
                    jQuery(this).removeAttr('disabled');
                    jQuery(this).text('Invalid Code');
                    jQuery('#alert-status').addClass('alert-danger');
                    jQuery('#alert-status').html("{{ __('site.error_otp') }}");
                    jQuery('#codeToVerify').val("");
                    setTimeout(() => {
                        jQuery(this).text("{{ __('site.confirm') }}");
                    }, 2000);
                }.bind($(this)));

            });


            jQuery('#getcode').on('click', function() {
                jQuery(this).attr('disabled', 'disabled');
                jQuery(this).text('send..');
                var phoneNo = "{{auth()->user()->mobile}}";
                console.log(phoneNo);
                // getCode(phoneNo);
                var appVerifier = window.recaptchaVerifier;
                firebase.auth().signInWithPhoneNumber(phoneNo, appVerifier)
                    .then(function(confirmationResult) {
                        window.confirmationResult = confirmationResult;
                        coderesult = confirmationResult;
                        jQuery("#getcode").attr('disabled',false);
                        jQuery("#getcode").text("{{ __('site.send_code') }}");
                        jQuery('#codeToVerify').val("");
                    }).catch(function(error) {
                        jQuery('#alert-status').addClass('alert-danger');
                        jQuery('#alert-status').html("{{ __('site.error_otp') }}");
                        jQuery("#getcode").attr('disabled', false);
                        jQuery("#getcode").text("{{ __('site.send_code') }}");
                        jQuery('#codeToVerify').val("");

                    });
            });

        }
    </script>
@endsection
