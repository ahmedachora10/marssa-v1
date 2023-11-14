@extends('auth.forms-layout')

@section('content-form')
    <div class="page-container login-container">
        <div class="page-content ">
            <div class="login-testimonials">
                <div class="" style="margin-top:25vh;">
                    <div class="slider-1">
                        @if ($feedback ?? false)
                            @foreach ($feedback as $item)
                                <div class="testimonials-wrapper">
                                    <img src="{{ asset($item->image) }}" alt="{{ $item['name_' . app()->getLocale()] }} icon">
                                    <p>{{ $item['comment_' . app()->getLocale()] }}</p>
                                    <div>{{ $item['name_' . app()->getLocale()] }}</div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="content-wrapper" id="content_box">
                <div class="content">
                    <div class="page-container login-container to-right">

                        @if (session()->has('success_registration'))
                            <p class="text-center alert alert-success">
                                {{ session()->get('success_registration') }}
                            </p>
                        @endif

                        <div class="page-content" @if (app()->getLocale() == 'en') style="direction: ltr;" @endif>
                            <div class="auth-top">
                                <a href="{{ route('site.index') }}">
                                    <img src="{{ asset($information->logo ?? '') }}" class="auth-logo"
                                        alt="{{ $information['title_page_' . app()->getLocale()] ?? '' }}">
                                    <h5 class="auth-title">{{ $information['title_page_' . app()->getLocale()] ?? '' }}</h5>
                                </a>
                            </div>
                            <div class="panel panel-body login-form">

                                @if ($errors->has('login') || $errors->has('email') || $errors->has('password'))
                                    @foreach ($errors->all() as $error)
                                        <div class="alert bg-warning alert-styled-left">
                                            <span class="invalid-feedback">
                                                <strong>{{ $error }}</strong>
                                            </span>
                                        </div>
                                    @endforeach
                                @endif
                                <form id="form" role="form" method="POST" action="{{ route('site.login') }}">
                                    @csrf
                                    @method('post')
                                    <div
                                        class="form-group has-feedback @if (app()->getLocale() == 'en') has-feedback-right @else has-feedback-left @endif">
                                        <input type="text" id="username" class="form-control" name="login"
                                            value="" placeholder="{{ __('site.phone') }}" required>
                                        @error('login')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        @if ($errors->has('login'))
                                            <span class="text-danger">{{ $errors->first('login') }}</span>
                                        @endif
                                        <div class="form-control-feedback"><i class="sicon-user text-muted text-bottom"></i>
                                        </div>
                                    </div>
                                    <div
                                        class="form-group has-feedback @if (app()->getLocale() == 'en') has-feedback-right @else has-feedback-left @endif">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="{{ __('site.password') }}" required>

                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-control-feedback"><i class="sicon-key text-muted text-bottom"></i>
                                        </div>

                                    </div>
                                    <div class="form-group login-options">
                                        <div class="row row-reverse" style="justify-content: space-around">
                                            <div class="col-xs-6 align-right" id="remember_box">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="remember" id="remember" checked="checked"
                                                        class="styled">
                                                    <span> {{ __('site.RememberMe') }}</span>
                                                </label>
                                            </div>
                                            <div class="col-xs-6 align-left">
                                                <a target="_blank"
                                                    href="{{ route('site.reset_password') }}">{{ __('site.ForgotYourPassword') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="submit_btn"
                                            class="btn btn-tiffany btn-block">{{ __('site.login') }}<i
                                                class="@if (app()->getLocale() == 'ar') sicon-caret-left @else sicon-caret-right @endif position-right"></i>
                                        </button>
                                    </div>
                                    <div id="register_box">
                                        <div class="content-divider text-muted form-group">
                                            <span>{{ __('site.do_not_have_account') }}</span>
                                        </div>
                                        <a href="{{ route('site.register') . '?reference_id=' . session('refrence_affiliate_id') }}"
                                            class="btn btn-tiffany btn-block btn-flat content-group">{{ __('site.create_store') . ' ' . __('site.free') }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="footer text-muted to-right">
                        <a
                            href="{{ route('site.index') }}">{{ $information['title_page_' . app()->getLocale()] ?? '' }}</a>
                        &copy; {{ now()->year }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





@section('form-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".styled").uniform({
                radioClass: 'choice'
            });
            $('#submit_btn').click(function() {
                if ($('#username').val() != '' && $('#password').val() != '') {
                    $('#submit_btn').html('{{ __('site.please_wait') }} ..');
                    $('#submit_btn').attr('disabled', true);
                    setTimeout(function() {
                        $('#form').submit();
                    }, 100);
                }
            });
        });
    </script>
    @if (Auth::check())
        <script>
            $(document).ready(function() {
                window.location.href = "{{ url('/') }}/dashboard/index";
            });
        </script>
    @endif
@endsection
