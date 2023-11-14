<!DOCTYPE HTML>{{--
<html lang="{{ app()->getLocale() }} "> dir="@if( app()->getLocale()=='ar') rtl @else ltr @endif" --}}

<html dir="rtl" lang="ar" crosspilot="">
<head>
    <meta charset="UTF-8">
    <title>{{ $head_data['title_'.app()->getLocale()]  ?? '' }}</title>
    @if($information['icon'])
        <link rel="shortcut icon" href="{{ asset($information->icon) }}" type="image/x-icon"/>
        <link rel="icon" href="{{ asset($information->icon) }}" type="image/x-icon"/>
        <link rel="apple-touch-icon" href="{{ asset($information->icon) }}"/>
    @endif
    
            <meta name="robots" content="index,follow">
            <meta name="robots" content="ALL">
            <meta property="og:type" content="website"/>
            <meta property="og:title" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}"/>
            <meta property="og:description"
                  content="{!! substr($head_data['description_'.app()->getLocale()], 0, 300) !!}"/>
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
                  content="{!!  substr($head_data['description_'.app()->getLocale()], 0, 300) !!}"/>
            <meta name="twitter:title" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}">
            <meta name="twitter:url" content="{{url()->current()}}">
            <meta name="keywords" content="{{ $head_data['keyword_'.app()->getLocale()] ?? '' }}">
            <meta name="description"
                  content="{!!  substr($head_data['description_'.app()->getLocale()], 0, 300) !!}"/>
            <meta name="author" content="{{ $head_data['title_'.app()->getLocale()]  ?? '' }}">
            <meta name="rating" content="General">
            <meta name="revisit-after" content="1 days">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
            <meta name="msapplication-TileColor" content="#ffffff">
            <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
            <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    @if(app()->getLocale()=='ar')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@600&display=swap" rel="stylesheet">
    <style>
        body,h1,h2,h3,h4,h5,h6,input,select,button,a,span,b{
            font-family: 'Noto Sans Arabic', sans-serif;
            
        }
    </style>
    @else
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    <style> 
        body,h1,h2,h3,h4,h5,h6,input,select,button,a,span,b{
                font-family: 'Cairo', sans-serif;
            }
    </style>
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" integrity="sha512-giQeaPns4lQTBMRpOOHsYnGw1tGVzbAIHUyHRgn7+6FmiEgGGjaG0T2LZJmAPMzRCl+Cug0ItQ2xDZpTmEc+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
       
        .form-group{
            text-align:start;
        }
        
                @keyframes  bayButton {
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
    @yield('head')
</head>

<body >
    
            @yield('content')
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.rtlcss.com/bootstrap/v4.3.1/js/bootstrap.min.js" integrity="sha384-2NsOVs5JcOR/wf4f2u5VYxUT+23fCbG29ajnpPYiyCZWF0dT4Ik3Qewqmf+pwm/d" crossorigin="anonymous"></script>
        @yield('script')
</body>
</html>