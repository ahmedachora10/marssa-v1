@extends('dashboard.master')

@section('store_settings')
    current active
@endsection

@section('head_tag')
    <style>
    .col-xs-6 {
    width: 50%;
    z-index: 9999999999999999999 !important;
}
        .col img {
            height: 100px;
            width: 100%;
            cursor: pointer;
            transition: transform 1s;
            object-fit: cover;
        }

        .col label {
            overflow: hidden;
            position: relative;
        }

        .imgbgchk:checked + label > .tick_container {
            opacity: 1;
        }

        .imgbgchk:checked + label > img {
            opacity: 0.3;
        }

        input.imgbgchk {
            display: contents;
        }

        .tick_container {
            transition: .5s ease;
            opacity: 0;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            cursor: pointer;
            text-align: center;
        }

        .tick {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            padding: 8px 12px;
            height: 40px;
            width: 40px;
            border-radius: 100%;
            display: block;
        }

        .title_design {
            padding: 15px 10px;
            font-weight: bold;
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="col-xs-12">

        <div class="container">
            <div class="alert alert-warning">
                {{__("master.We advise the merchant to stick to the default colors of the template unless they are designed and optimized for color selection")}}
            </div>
            <form method="post"
                  action="{{ route('dashboard.admin.store_settings.design_chosen') }}" enctype="multipart/form-data">
                <div class="row">
                    <div class="panel panel-default panel-small-title margin-bottom-20">
                        <div class="panel-heading">
                            <div class="d-flex justify-content-between" style="display: inline-flex;justify-content: space-between;width: 100%;">
                                <div style="width:fit-content;">
                                    <h6 class="panel-title padding-10">{{ __('master.custom_design') }}</h6>
                                </div>
                            <div style="width:fit-content;">
                                   <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light ">
                                        {{ __('master.update_data') }}
                                    </button>
                            </div>
                        </div>
                        </div>

                        <div class="panel-body margin-bottom-20">
                                @csrf
                                <div class="row">
                                    @forelse($valid_design as $design)
                                        <div class="col-md-4 col-xs-6 click">
                                            <div class='text-center'>
                                                <input type="radio" name="design" id="img{{ $loop->index }}"
                                                       class="d-none imgbgchk" value="{{$design->id}}"
                                                       @if($design->check_store($store->id) == 1) checked @endif>
                                                <label for="img{{ $loop->index }}">
                                                        <span class="title_design">
                                                            {{$design->name}}
                                                        </span>
                                                    <img src="{{ asset($design->image) }}"
                                                         alt="design {{ $loop->index }}" width="200">
                                                    <span class="tick_container">
                                                            <span class="tick"><i class="fa fa-check"></i></span>
                                                        </span>
                                                </label>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-md-8 col-md-offset-2 col-xs-12 text-center margin-top-30"
                                             style="float: left">
                                            <p>{{ __('master.package_cannot') }}</p>
                                            <p class="margin-top-30">
                                                <a href="{{ route('dashboard.admin.store_settings.upgrade_plan') }}" class="btn btn-primary btn-sm waves-effect waves-light">
                                                    {{ __('master.upgrade_plan') }}
                                                </a>
                                            </p>
                                        </div>
                                    @endforelse
                                    @if(count($valid_design) > 0)
                                        <?php
                                            $user = auth()->user()->store()->get()->first();
                                            ?>
                                        <div class="col-md-12">
                                            <hr>
                                            <div class="form-group">
                                                <label for="header_background">{{__('master.header_background')}}</label>
                                                <input class="form-control" name="css_style[header_background]" value="{{($user->css_style['header_background'])??'#000000'}}" id="header_background" type="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="header_text_color">{{__('master.header_text_color')}}</label>
                                                <input class="form-control" name="css_style[header_text_color]" value="{{($user->css_style['header_text_color'])??'#ffffff'}}" id="header_text_color" type="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="footer_background">{{__('master.footer_background')}}</label>
                                                <input class="form-control" name="css_style[footer_background]" value="{{($user->css_style['footer_background'])??'#000000'}}" id="footer_background" type="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="footer_text_color">{{__('master.footer_text_color')}}</label>
                                                <input class="form-control" name="css_style[footer_text_color]" value="{{($user->css_style['footer_text_color'])??'#ffffff'}}" id="footer_text_color" type="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="background_image">{{__('master.background_image')}}</label>
                                                <input type="hidden" name="old_background_image" value="{{($user->css_style['background_image'] ?? '' )}}">
                                                <input class="form-control" name="css_style[background_image]" id="background_image" type="file">
                                            </div>

                                            <div class="form-group">
                                                <label for="font_add_to_cart_button">{{__('master.font_add_to_cart_button')}}</label>
                                                <input class="form-control" name="css_style[font_add_to_cart_button]" value="{{($user->css_style['font_add_to_cart_button'])??'#007bff'}}" id="font_add_to_cart_button" type="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="background_add_to_cart_button">{{__('master.background_add_to_cart_button')}}</label>
                                                <input class="form-control" name="css_style[background_add_to_cart_button]" value="{{($user->css_style['background_add_to_cart_button'])??'#007bff'}}" id="background_add_to_cart_button" type="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="font_buy_now_button">{{__('master.font_buy_now_button')}}</label>
                                                <input class="form-control" name="css_style[font_buy_now_button]" value="{{($user->css_style['font_buy_now_button'])??'#28a745'}}" id="font_buy_now_button" type="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="background_buy_now_button">{{__('master.background_buy_now_button')}}</label>
                                                <input class="form-control" name="css_style[background_buy_now_button]" value="{{($user->css_style['background_buy_now_button'])??'#28a745'}}" id="background_buy_now_button" type="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="background_check_out_buy_now_button">{{__('master.background_check_out_buy_now_button')}}</label>
                                                <input class="form-control" name="css_style[background_check_out_buy_now_button]" value="{{($user->css_style['background_check_out_buy_now_button'])??'#ffc107'}}" id="background_check_out_buy_now_button" type="color">
                                            </div>
                                            <?php
                                                $default = $user->css_style['default']??'';
                                                if (is_null($default)) {
                                                    $option = 1;
                                                } else {
                                                    if ($default === 'false') {
                                                        $option = 0;
                                                    } else {
                                                        $option = 1;
                                                    }
                                                }
                                            ?>
                                            <div class="form-group">
                                                <label for="default">{{__('master.css_default')}}</label>
                                                <select class="form-control" name="css_style[default]" id="default">
                                                    <option value="true" {{($option === 1) ? 'selected' : ''}}>{{__('master.yes')}}</option>
                                                    <option value="false" {{($option === 0) ? 'selected' : ''}}>{{__('master.no')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 margin-top-30 text-center">
                                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light btn-block">
                                                {{ __('master.update_data') }}
                                            </button>
                                        </div>
                                    @endif
                                </div>
                        </div>
                    </div>
                    @if(count($designs) != count($valid_design))
                        <!-- <div class="panel panel-default panel-small-title margin-bottom-20">
                            <div class="panel-heading">
                                <h6 class="panel-title padding-10">{{ __('master.available_design') }}</h6>
                            </div>
                            <div class="panel-body margin-bottom-20">
                                @forelse($designs as $design)
                                    <div class="col-md-4 col-xs-6">
                                        <div class='text-center'>
                                            <label>
                                        <span class="title_design">
                                            {{$design->name}}
                                        </span>
                                                <img src="{{ asset($design->image) }}"
                                                     alt="design {{ $loop->index }}" width="200">
                                                <span class="tick_container">
                                            <span class="tick"><i class="fa fa-check"></i></span>
                                        </span>
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <p></p>
                                @endforelse
                            </div>
                        </div>-->
                    @endif
                </div>
            </form>
        </div>


@endsection
{{--Developed Saed Z. Sinwar--}}

