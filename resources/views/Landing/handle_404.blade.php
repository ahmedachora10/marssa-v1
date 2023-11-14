<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(app()->getLocale()== 'ar') dir="rtl" @endif>
<head>
    <meta charset="UTF-8" dir="rtl" lang="ar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('store.sorry') }}@if($error == 'store'){{ __('store.store_title') }} @else {{ __('store.page_title') }} @endif</title>
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
                <h1 class="row-reverse title title--giant title--404">
                    <img src="{{ asset($information->logo) }}" alt="logo"/>
                    <span>&nbsp;404</span>
                </h1>
                <h3>{{ __('store.sorry') }}@if($error == 'store') {{ __('store.store_title') }} @else {{ __('store.page_title') }} @endif</h3>
                <p>
                    <span>@if($error == 'store') {{ __('store.store_title') }} @else {{ __('store.page_title') }} @endif</span><br>
                    <span>{{ __('store.try_again') }}</span>
                </p>
                <button id="btn-feedback"
                        class="btn btn--large btn--round btn--primary">{{ __('store.tell_us') }}</button>
                <a href="{{ env('APP_URL') }}">{{ __('store.goHome') }}</a>
            </div>
            <div class="msg">
                <form class="feedback-error row" id="contact_form" method="post">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" required type="text" name="name" value=""
                                   placeholder="{{ __('site.name') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" required type="email" name="email" value=""
                                   placeholder="{{ __('site.email') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" required name="content"
                                  placeholder="{{ __('site.details') }}"></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="controls">
                            <button id="btn-return" class="btn btn--circular btn--return">
                                <svg enable-background="new 0 0 20 20" height="20px" version="1.1" viewBox="0 0 32 32"
                                     width="20px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd"
                                          d="M32,16.009c0-0.267-0.11-0.522-0.293-0.714  l-9.899-9.999c-0.391-0.395-1.024-0.394-1.414,0c-0.391,0.394-0.391,1.034,0,1.428l8.193,8.275H1c-0.552,0-1,0.452-1,1.01  s0.448,1.01,1,1.01h27.586l-8.192,8.275c-0.391,0.394-0.39,1.034,0,1.428c0.391,0.394,1.024,0.394,1.414,0l9.899-9.999  C31.894,16.534,31.997,16.274,32,16.009z"
                                          fill="#fff" fill-rule="evenodd" id="Arrow_Forward"/>
                                   </svg>
                            </button>
                            <button id="btn-send"
                                    class="btn btn--large btn--round btn--primary">{{ __('site.send') }}</button>
                        </div>
                    </div>
                    <div class="col-md-12 output" style="margin-top: 20px"></div>
                </form>
            </div>
        </div>
        <div class="form-group msg-container">
        </div>
    </div>
</main>

<footer id="footer" class="footer"></footer>
<script type="text/javascript" src="{{ asset('site/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        function toggle(e) {
            $(".landing").toggleClass("conceal");
            $(".msg").toggleClass("reveal");
            setTimeout(function () {
                $(".msg").find(".form-control").focus()
            }, 500);
            e.preventDefault()
        }

        $("#btn-feedback").on("click", toggle);
        $("#btn-return").on("click", toggle);
        $(document).on("submit", "form.feedback-error", function (e) {
            let output_html = $(".output");
            e.preventDefault();
            $.ajax({
                url: "{{ route('send_contact_us') }}",
                type: "POST",
                data: $('#contact_form').serialize(),
                cache: false,
                success: function (result) {
                    output_html.html("<div class='text-success text-center'>" + result + "</div><br>").fadeIn().delay(5000).fadeOut();
                }
            });
        })
    });
</script>
</body>
</html>
{{--Developed Saed Z. Sinwar--}}