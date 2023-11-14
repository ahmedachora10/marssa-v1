<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(app()->getLocale()== 'ar') dir="rtl" @endif>
<head>
    <meta charset="UTF-8" dir="rtl" lang="ar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('auth.VerifyYourEmailAddress') }}</title>
    <link href="{{ asset('site/css/app.css') }}" rel="stylesheet" type="text/css">
    @if(app()->getLocale()== 'en')
        <style>
            body {
                text-align: left;
            }

            html, body {
                direction: ltr !important;
            }

            .row-reverse {
                display: flex;
            }
        </style>
    @endif
</head>
<body class="body @if(app()->getLocale()== 'ar') body--rtl @endif body--bg">
<header id="header" class="header header--404"></header>
<main id="main" class="main main--404">
    <div class="container container--wide">
        <div class="e404-container">
            <div class="landing">
                <h1 class="row-reverse title title--giant title--404" style="margin: 0">
                    <img src="{{ asset($information->logo) }}" alt="logo" style="margin: 0"/>
                </h1>
                <h3 style="color: #f94e4b;">{{ __('auth.VerifyYourEmailAddress') }}</h3>
                <div style="margin-top:60px">
                    <p>
                        {{ __('auth.check_your_email') }}
                        {{ __('auth.not_receive') }},
                    </p>
                    <form class="d-inline" method="POST" action="{{ route('site.verification.resend') }}">
                        @csrf
                        <button type="submit"
                                class="btn btn--large btn--round btn--primary">{{ __('auth.send_another') }}</button>
                    </form>
                    @if (session('resent'))
                        <p class="text-success" role="alert" style="margin-top:20px">
                            {{ __('auth.fresh_verification') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
<footer id="footer" class="footer"></footer>
<script type="text/javascript" src="{{ asset('site/js/jquery.min.js') }}"></script>
</body>
</html>
{{--Developed Saed Z. Sinwar--}}