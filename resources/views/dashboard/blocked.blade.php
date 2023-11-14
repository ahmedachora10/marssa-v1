<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(app()->getLocale()== 'ar') dir="rtl" @endif>
<head>
    <meta charset="UTF-8" dir="rtl" lang="ar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('master.UserBlockedTitle') }}</title>
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
                <h3 style="color: #f94e4b;margin-top:30px">{{ __('master.UserBlockedTitle') }}</h3>
                <div style="margin-top:100px">
                    <p>
                        {{ __('master.UserBlockedDescription') }}
                    </p>
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