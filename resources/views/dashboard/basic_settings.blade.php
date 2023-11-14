@extends('dashboard.master')


@section('store_settings')
    current active
@endsection




@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/dropify/css/dropify.min.css') }}">
    <style>
        .dropify-wrapper {
            border: none !important;
        }
    </style>
@endsection



@section('content')
    @if (session('message'))
        <div class="small-spacing">
            <div class="col-xs-12">
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ __('master.'.session('message')) }}</strong>
                </div>
            </div>
        </div>
    @endif
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <form method="POST" action="{{ route('dashboard.admin.information.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="panel panel-default panel-small-title margin-bottom-20">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.store_information') }}</h6>
                        </div>
                        <div class="panel-body margin-bottom-20">


                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="card-content text-center margin-bottom-10">
                                                <div class="card-content margin-bottom-10">
                                                    @if($information['logo'])
                                                        <input type="file" name="logo" id="input-file-logo"/>
                                                    @else
                                                        <input type="file" name="logo" id="input-file-logo"
                                                               class="dropify"/>
                                                    @endif
                                                </div>
                                                <p class="box-title"><span>{{ __('master.co_logo')}}<span class="hint"> 250x250</span></span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="card-content text-center margin-bottom-10">
                                                <div class="card-content margin-bottom-10">
                                                    @if($information['icon'])
                                                        <input type="file" name="icon" id="input-file-icon"/>
                                                    @else
                                                        <input type="file" name="icon" id="input-file-icon"
                                                               class="dropify"/>
                                                    @endif
                                                </div>
                                                <p class="box-title"><span>{{ __('master.co_icon')}}<span class="hint"> 80x80</span></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        @foreach($language as $lang)
                                            <div class="card-content">
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="ig-{{ $loop->index }}" class="btn btn-default">
                                                            <i class="fa fa-store"></i></label>
                                                    </div>
                                                    <input id="ig-{{ $loop->index }}" type="text" class="form-control"
                                                           name="title_page_{{$lang}}"
                                                           value='{{ $information["title_page_$lang"] }}'
                                                           placeholder="{{ __('master.store_name') . ' (' . __("master.$lang") . ')'  }}">
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="card-content">
                                            <div class="input-group margin-bottom-20">
                                                <div class="input-group-btn">
                                                    <label for="ig-3" class="btn btn-default">
                                                        <i class="fa fa-map-marked-alt"></i></label>
                                                </div>
                                                <input id="ig-3" type="text" class="form-control" name="address"
                                                       value='{{ $information["address"] }}'
                                                       placeholder="{{ __('master.co_address')  }}">
                                            </div>
                                        </div>


                                        <div class="card-content margin-bottom-10">
                                            <div class="input-group margin-bottom-20">
                                                <div class="input-group-btn">
                                                    <label for="ig-33" class="btn btn-default">
                                                        <i class="fa fa-window-restore"></i></label>
                                                </div>
                                                <input id="ig-33" type="text" class="form-control"
                                                       value="{{$information['head_text']}}" name="head_text"
                                                       placeholder="وصف الهيدر ">
                                            </div>
                                        </div>


                                        <div class="card-content margin-bottom-10">
                                            <div class="input-group margin-bottom-20">
                                                <div class="input-group-btn">
                                                    <label for="ig-33" class="btn btn-default">
                                                        <i class="fab fa-youtube"></i></label>
                                                </div>
                                                <input id="ig-33" type="text" class="form-control"
                                                       value="{{$information['video_url']}}" name="video_url"
                                                       placeholder="رابط الفيديو">
                                            </div>
                                        </div>

                                        <div class="card-content margin-bottom-10">
                                            <div class=" margin-bottom-20">
                                                <div class="row ">
                                                    <div class="col-md-4 text-center">
                                                        <input type="radio" name="header_type"
                                                               {{ $information['header_type'] == '1' ? 'checked' : ''  }} value="1"> @if(app()->getLocale() == 'ar' )
                                                            فيديو @else Video @endif

                                                    </div>
                                                    <div class="col-md-4 text-center">
                                                        <input type="radio" name="header_type"
                                                               {{ $information['header_type'] == '2' ? 'checked' : ''  }} value="2"> @if(app()->getLocale() == 'ar' )
                                                            صورة @else Image @endif
                                                    </div>
                                                    <div class="col-md-4 text-center">
                                                        <input type="radio" name="header_type"
                                                               {{ $information['header_type'] == '3' ? 'checked' : ''  }} value="3"> @if(app()->getLocale() == 'ar' )
                                                            كلمات @else Words @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-content margin-bottom-10">
                                            <p class="box-title"><span>بنر الهيدر<span class="hint">720x90</span></span>
                                            </p>
                                            @if($information['banner_head'])
                                                <input type="file" name="banner_head" id="input-file-banner_head"/>
                                            @else
                                                <input type="file" name="banner_head" id="input-file-banner_head"
                                                       class="dropify"/>
                                            @endif
                                        </div>
                   
                                        <p class="box-title"><span>بنر الفوتر <span class="hint">720x90</span></span>
                                        </p>
                                        <div class="card-content margin-bottom-10">
                                            @if($information['banner_footer'])
                                                <input type="file" name="banner_footer" id="input-file-banner_footer"/>
                                            @else
                                                <input type="file" name="banner_footer" id="input-file-banner_footer"
                                                       class="dropify"/>
                                            @endif
                                        </div>


                                        @role('SuperAdmin|Admin')
                                        <div class="card-content margin-bottom-10">
                                            @if($information['home_image'])
                                                <img src="{{asset($information['home_image'])}}">
                                                <input type="file" name="home_image" id="input-file-home_image"/>
                                            @else
                                                <input type="file" name="home_image" id="input-file-home_image"
                                                       class="dropify"/>
                                            @endif
                                        </div>
                                        <p class="box-title"><span>الصورة الرئيسية <span
                                                        class="hint">1356x1017</span></span>
                                        </p>

                                        <div class="card-content margin-bottom-10">
                                            @if($information['home_im2'])
                                                <img src="{{asset($information['home_im2'])}}">
                                                <input type="file" name="home_im2" id="input-file-home_im2"/>
                                            @else
                                                <input type="file" name="home_im2" id="input-file-home_im2"
                                                       class="dropify"/>
                                            @endif
                                        </div>
                                        <p class="box-title"><span>الصورة الفرعية <span
                                                        class="hint">230x900</span></span>
                                        </p>
                                        @endrole


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @role('User')
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.store_language') }}</h6>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <ul class="list-inline text-center">
                                            <li>
                                                <div class="radio primary">
                                                    <input type="radio" name="language" id="radio-1" value="0"
                                                           @if($store->language == 0) checked @endif>
                                                    <label for="radio-1">{{ __('master.arabic') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio info">
                                                    <input type="radio" name="language" id="radio-2" value="1"
                                                           @if($store->language == 1) checked @endif>
                                                    <label for="radio-2">{{ __('master.english') }}</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio info">
                                                    <input type="radio" name="language" id="radio-4" value="3"
                                                           @if($store->language == 3) checked @endif>
                                                    <label for="radio-4">{{ __('master.french') }}</label>
                                                </div>
                                            </li>
                                            @if($plan and $plan->language)
                                                <li>
                                                    <div class="radio success">
                                                        <input type="radio" name="language" id="radio-3" value="2"
                                                               @if($store->language == 2) checked @endif>
                                                        <label for="radio-3">{{ __('master.arabic') . __('master.and') . __('master.english'). __('master.and') . __('master.french')}}</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="radio info">
                                                        <input type="radio" name="language" id="radio-5" value="4"
                                                               @if($store->language == 4) checked @endif>
                                                        <label for="radio-5">{{ __('master.arabic'). __('master.and') . __('master.french') }}</label>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.currencies') }}</h6>
                           
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="card-content">
                                            <div class="form-group @error('currency') has-error @enderror col-xs-12">
                                                <select name="currency" id="select_currency" class="form-control">
                                                    <!--
                                                    <option value="MRO">أوقية موريتانية قديمة( MRO )</option>-->
                                                    <option value="MRU" {{auth()->user()->getCurrency() == 'MRU' ? 'selected' : ''}}>MRU</option>
                                                    <option value="MRO" {{auth()->user()->getCurrency() == 'MRO' ? 'selected' : ''}}>MRO</option>
                                                    <option  {{auth()->user()->getCurrency() == 'أوقية جديدة' ? 'selected' : ''}} value="أوقية جديدة"> أوقية جديدة</option>
                                                    <option  {{auth()->user()->getCurrency() == 'أوقية قديمة' ? 'selected' : ''}} value="أوقية قديمة"> أوقية قديمة</option>
                                                    <option value="SAR"  {{auth()->user()->getCurrency() == 'SAR' ? 'selected' : ''}}>ريال سعودي ( ر.س )</option>
                                                    <option value="AED" {{auth()->user()->getCurrency() == 'AED' ? 'selected' : ''}}>درهم اماراتي ( د.إ )</option>
                                                    <option value="KWD" {{auth()->user()->getCurrency() == 'SWD' ? 'selected' : ''}}>دينار كويتي ( د.ك )</option>
                                                    <option value="QAR" {{auth()->user()->getCurrency() == 'QAR' ? 'selected' : ''}}>ريال قطري ( ر.ق )</option>
                                                    <option value="BHD" {{auth()->user()->getCurrency() == 'BHD' ? 'selected' : ''}}>دينار بحريني ( د.ب )</option>
                                                    <option value="IQD" {{auth()->user()->getCurrency() == 'IQD' ? 'selected' : ''}}>دينار عراقي ( د.ع )</option>
                                                    <option value="OMR" {{auth()->user()->getCurrency() == 'OMR' ? 'selected' : ''}}>ريال عماني ( ر.ع )</option>
                                                    <option value="EGP" {{auth()->user()->getCurrency() == 'EGP' ? 'selected' : ''}}>جنيه مصري ( ج.م )</option>
                                                    <option value="SDG" {{auth()->user()->getCurrency() == 'EGP' ? 'selected' : ''}}>جنيه سوداني ( SDG )</option>
                                                    <option value="LYD" {{auth()->user()->getCurrency() == 'LYD' ? 'selected' : ''}}>دينار ليبي ( LD )</option>
                                                    <option value="DZD" {{auth()->user()->getCurrency() == 'DZD' ? 'selected' : ''}}>دينار جزائري ( دج )</option>
                                                    <option value="TND" {{auth()->user()->getCurrency() == 'TND' ? 'selected' : ''}}>دينار تونسي ( د.ت )</option>
                                                    <option value="MAD" {{auth()->user()->getCurrency() == 'MAD' ? 'selected' : ''}}>درهم مغربي ( د.م. )</option>
                                                    <option value="SYP" {{auth()->user()->getCurrency() == 'SYP' ? 'selected' : ''}}>ليرة سورية ( SYP )</option>
                                                    <option value="LBP" {{auth()->user()->getCurrency() == 'LBP' ? 'selected' : ''}}>ليرة لبنانية ( ل.ل )</option>
                                                    <option value="AUD" {{auth()->user()->getCurrency() == 'AUD' ? 'selected' : ''}}>دولار استرالي ( $ )</option>
                                                    <option value="EUR" {{auth()->user()->getCurrency() == 'EUR' ? 'selected' : ''}}>يورو ( € )</option>
                                                    <option value="IDR" {{auth()->user()->getCurrency() == 'IDR' ? 'selected' : ''}}>روبية إندونيسية ( Rp )</option>
                                                    <option value="JOD" {{auth()->user()->getCurrency() == 'JOD' ? 'selected' : ''}}>دينار أردني ( JOD )</option>
                                                    <option value="USD" {{auth()->user()->getCurrency() == 'USD' ? 'selected' : ''}}>دولار أمريكي ( $ )</option>
                                                    <option value="SEK" {{auth()->user()->getCurrency() == 'SEK' ? 'selected' : ''}}>كرونة سويدية ( kr )</option>
                                                    <option value="CFA" {{auth()->user()->getCurrency() == 'CFA' ? 'selected' : ''}}>الفرنك الافريقي ( CFA )</option>
                                                    <option value="CNY" {{auth()->user()->getCurrency() == 'CNY' ? 'selected' : ''}}>رنمينبي ( ¥ )</option>
                                                    <option value="GBP" {{auth()->user()->getCurrency() == 'GBP' ? 'selected' : ''}}>جنيه استرليني ( £ )</option>
                                                    <option value="INR" {{auth()->user()->getCurrency() == 'INR' ? 'selected' : ''}}>روبية هندية ( Rp )</option>
                                                    <option value="JPY" {{auth()->user()->getCurrency() == 'JPY' ? 'selected' : ''}}>ين ياباني ( ¥ )</option>
                                                    <option value="PKR" {{auth()->user()->getCurrency() == 'PKR' ? 'selected' : ''}}>روبية باكستانية ( Rs. )</option>
                                                    <option value="TRY" {{auth()->user()->getCurrency() == 'TRY' ? 'selected' : ''}}> ليرة تركية ( ₺ )</option>
                                                    <option value="CAD" {{auth()->user()->getCurrency() == 'CAD' ? 'selected' : ''}}> دولار كندي ( $ )</option>
                                                    <option value="MYR" {{auth()->user()->getCurrency() == 'MYR' ? 'selected' : ''}}> رينغيت ماليزي ( RM )</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endrole
                    @role('SuperAdmin')
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.commission') }}</h6>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="card-content">
                                            <div class="form-group @error('currency') has-error @enderror col-xs-12">
                                                <label class=""> {{ __('master.commission') }} </label>
                                                <input name="commission" value="{{ env('commission',0) }}"
                                                       class="form-control"/>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.affiliate_rate') }}</h6>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="card-content">
                                            <div class="form-group @error('currency') has-error @enderror col-xs-12">
                                                <label class=""> {{ __('master.affiliate_rate') }} </label>
                                                <input name="affiliate_rate" value="{{ env('affiliate_rate',0) }}"
                                                       class="form-control"/>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $site = \App\site::select(['video_tutorial', 'header_message'])->first(); ?>
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.header_message') }}</h6>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="card-content">
                                            <div class="form-group @error('currency') has-error @enderror col-xs-12">
                                                <label class=""> {{ __('master.header_message') }} </label>
                                                <input name="header_message" value="{{ $site->header_message }}"
                                                       class="form-control"/>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endrole


                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.technical_support') }}</h6>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="card-content">
                                            <div class="input-group margin-bottom-20">
                                                <div class="input-group-btn">
                                                    <label for="ig-4" class="btn btn-default">
                                                        <i class="fa fa-phone"></i></label>
                                                </div>
                                                <input id="ig-4" type="text" class="form-control" name="phone"
                                                       value='{{ $information["phone"] }}'
                                                       placeholder="{{ __('master.co_phone')  }}">
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="input-group margin-bottom-20">
                                                <div class="input-group-btn">
                                                    <label for="ig-5" class="btn btn-default">
                                                        <i class="fa fa-envelope"></i></label>
                                                </div>
                                                <input id="ig-5" type="text" class="form-control" name="email"
                                                       value='{{ $information["email"] }}'
                                                       placeholder="{{ __('master.email_address')  }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.social_media') }}</h6>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="card-content">
                                            <div class="input-group margin-bottom-20">
                                                <div class="input-group-btn">
                                                    <label for="ig-6" class="btn btn-default">
                                                        <i class="fab fa-facebook"></i></label>
                                                </div>
                                                <input id="ig-6" type="text" class="form-control" name="facebook"
                                                       value='{{ $information["facebook"] }}'
                                                       placeholder="{{ __('master.facebook')  }}">
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="input-group margin-bottom-20">
                                                <div class="input-group-btn">
                                                    <label for="ig-7" class="btn btn-default">
                                                        <i class="fab fa-twitter"></i></label>
                                                </div>
                                                <input id="ig-7" type="text" class="form-control" name="twitter"
                                                       value='{{ $information["twitter"] }}'
                                                       placeholder="{{ __('master.twitter')  }}">
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="input-group margin-bottom-20">
                                                <div class="input-group-btn">
                                                    <label for="ig-8" class="btn btn-default">
                                                        <i class="fab fa-whatsapp"></i></label>
                                                </div>
                                                <input id="ig-8" type="text" class="form-control" name="whatsapp"
                                                       value='{{ $information["whatsapp"] }}'
                                                       placeholder="{{ __('master.whatsapp')  }}">
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="input-group margin-bottom-20">
                                                <div class="input-group-btn">
                                                    <label for="ig-9" class="btn btn-default">
                                                        <i class="fab fa-instagram"></i></label>
                                                </div>
                                                <input id="ig-9" type="text" class="form-control" name="instagram"
                                                       value='{{ $information["instagram"] }}'
                                                       placeholder="{{ __('master.instagram')  }}">
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="input-group margin-bottom-20">
                                                <div class="input-group-btn">
                                                    <label for="ig-10" class="btn btn-default">
                                                        <i class="fab fa-youtube"></i></label>
                                                </div>
                                                <input id="ig-10" type="text" class="form-control" name="youtube"
                                                       value='{{ $information["youtube"] }}'
                                                       placeholder="{{ __('master.youtube')  }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    @role('SuperAdmin')
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('site.common_questions') }}</h6>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-4  col-xs-12" style="float: left">
                                    <h4>
                                        الاسئلة الشائعة باللغة العربية
                                    </h4>
                                    <?php
                                    $ar = json_decode($information['questions_ar']);
                                    $en = json_decode($information['questions_en']);
                                    $fr = json_decode($information['questions_fr']);
                                    ?>
                                    <div class="row">
                                        @for($i = 0 ; $i < 4 ; $i++)
                                            <div class="col-xs-12">
                                                <div class="card-content form-group">
                                                    <label>
                                                        السؤال #{{$i+1}}
                                                    </label>
                                                    <input id="ig-6" type="text" value="{{$ar[$i]->question}}"
                                                           class="form-control" name="question_ar[]"

                                                    >
                                                </div>


                                                <div class="card-content form-group">
                                                    <label>
                                                        إجابة لسؤال رقم #{{$i+1}}
                                                    </label>
                                                    <input id="ig-6" value="{{$ar[$i]->answer}}" type="text"
                                                           class="form-control" name="answer_ar[]"

                                                    >
                                                </div>

                                                <hr>
                                            </div>
                                        @endfor

                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12" style="float: left">
                                    <h4>
                                        الاسئلة الشائعة باللغة الانجليزية
                                    </h4>
                                    <div class="row">
                                        @for($i = 0 ; $i < 4 ; $i++)
                                            <div class="col-xs-12">
                                                <div class="card-content form-group">
                                                    <label>
                                                        السؤال #{{$i+1}}
                                                    </label>
                                                    <input id="ig-6" type="text" value="{{$en[$i]->question}}"
                                                           class="form-control" name="question_en[]"

                                                    >
                                                </div>


                                                <div class="card-content form-group">
                                                    <label>
                                                        إجابة لسؤال رقم #{{$i+1}}
                                                    </label>
                                                    <input id="ig-6" type="text" value="{{$en[$i]->answer}}"
                                                           class="form-control" name="answer_en[]"

                                                    >
                                                </div>

                                                <hr>
                                            </div>
                                        @endfor

                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12" style="float: left">
                                    <h4>
                                        الاسئلة الشائعة باللغة الفرنسية
                                    </h4>
                                    <div class="row">
                                        @for($i = 0 ; $i < 4 ; $i++)
                                            <div class="col-xs-12">
                                                <div class="card-content form-group">
                                                    <label>
                                                        السؤال #{{$i+1}}
                                                    </label>
                                                    <input id="ig-6" type="text" value="{{$fr[$i]->question}}"
                                                           class="form-control" name="question_fr[]"

                                                    >
                                                </div>


                                                <div class="card-content form-group">
                                                    <label>
                                                        إجابة لسؤال رقم #{{$i+1}}
                                                    </label>
                                                    <input id="ig-6" type="text" value="{{$fr[$i]->answer}}"
                                                           class="form-control" name="answer_fr[]"

                                                    >
                                                </div>

                                                <hr>
                                            </div>
                                        @endfor

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="panel panel-default panel-small-title margin-bottom-20">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('site.videos_word') }}</h6>
                        </div>
                        <div class="panel-body margin-bottom-20">


                            <div class="row">
                                <?php $site = \App\site::first();  ?>
                                <div class="col-md-12">
                                    <h4>
                                        {{ __('site.welcome_video_label') }}
                                    </h4>
                                    <hr>
                                </div>
                                <div class="col-md-6">

                                    <label>
                                        {{ __('site.upload_video_label') }}
                                    </label>
                                    <input type="file" class="form-control" name="video_upload">
                                </div>
                                <div class="col-md-6" style="margin-bottom:30px">
                                    <label>
                                        {{ __('site.url_video_label') }}
                                    </label>
                                    <input type="text" class="form-control" value="{{$site->video_link}}"
                                           name="video_link">
                                </div>

                                <div class="col-md-12">
                                    <h4>
                                        {{ __('site.warning_video_label') }}
                                    </h4>
                                    <hr>
                                </div>
                                <div class="col-md-6">

                                    <label>
                                        {{ __('site.upload_video_label') }}
                                    </label>
                                    <input type="file" class="form-control" name="warning_video_upload">
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        {{ __('site.url_video_label') }}
                                    </label>
                                    <input type="text" class="form-control" value="{{$site->video_warning_link}}"
                                           name="video_warning_link">
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="panel panel-default panel-small-title margin-bottom-20">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('site.videos_word') }} 2</h6>
                        </div>
                        <div class="panel-body margin-bottom-20">


                            <div class="row">
                                <?php $site = \App\site::first();  ?>
                                <div class="col-md-12">
                                    <h4>
                                        {{ __('site.welcome_video_label') }} 2
                                    </h4>
                                    <hr>
                                </div>
                                <div class="col-md-6">

                                    <label>
                                        {{ __('site.upload_video_label') }} 2
                                    </label>
                                    <input type="file" class="form-control" name="welcome_video_upload">
                                </div>
                                <div class="col-md-6" style="margin-bottom:30px">
                                    <label>
                                        {{ __('site.url_video_label') }} 2
                                    </label>
                                    <input type="text" class="form-control" value="{{$site->welcome_video_link}}"
                                           name="welcome_video_link">
                                </div>

                                <div class="col-md-12">
                                    <h4>
                                        {{ __('site.warning_video_label') }} 2
                                    </h4>
                                    <hr>
                                </div>
                                <div class="col-md-6">

                                    <label>
                                        {{ __('site.upload_video_label') }} 2
                                    </label>
                                    <input type="file" class="form-control" name="warning_2_video_upload">
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        {{ __('site.url_video_label') }} 2
                                    </label>
                                    <input type="text" class="form-control" value="{{$site->warning_2_video_link}}"
                                           name="warning_2_video_link">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                        {{ __('master.add_tutorial') }}
                                    </h4>
                                    <hr>
                                </div>
                                <?php $site = \App\site::first();  ?>

                                <div class="col-md-6">
                                    <label>
                                        {{ __('site.url_video_label') }}
                                    </label>
                                    <input type="text" class="form-control" value="{{$site->video_tutorial}}"
                                           name="tutorial_video_link">
                                </div>
                            </div>

                        </div>
                    </div>
                    @endrole

                    <div class="text-center">
                        <button type="submit"
                                class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light"
                                style="margin-bottom:35px">
                            {{ __('master.save') }}
                        </button>
                        <br>
                    </div>


                </form>


            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/fileUpload.demo.min.js') }}"></script>

    @if($information['logo'])
        <script>
            $("#input-file-logo").addClass('dropify');
            $("#input-file-logo").attr("data-height", 225);
            $("#input-file-logo").attr("data-default-file", "{{ asset($information['logo'])}}");
            $("#input-file-logo").dropify();
        </script>
    @endif
    @if($information['icon'])
        <script>
            $("#input-file-icon").addClass('dropify');
            $("#input-file-icon").attr("data-height", 225);
            $("#input-file-icon").attr("data-default-file", "{{ asset($information['icon'])}}");
            $("#input-file-icon").dropify();
        </script>
    @endif

    <script>
        $("#input-file-banner_head").addClass('dropify');
        $("#input-file-banner_head").attr("storeid", <?=$store->id?>);
        $("#input-file-banner_head").attr("data-height", 225);
        $("#input-file-banner_head").attr("data-default-file", "{{ asset($information['banner_head'])}}");
        var banner = $("#input-file-banner_head").dropify();
        banner.on('dropify.beforeClear', function (event, element) {
            //console.log(event);
            var store_id = (element.input[0].attributes.storeid.value);
            $.post("{{ route('dashboard.admin.information.remove') }}", {
                _token: $('meta[name=csrf-token]').attr('content'),
                _method: 'POST',
                storeid: store_id,
                banner: 'banner_head'
            }, function (response) {

                if (response != '') {
                    console.log(response);
                }


            });


        });
    </script>
    <script>
        $("#input-file-banner_footer").addClass('dropify');
        $("#input-file-banner_footer").attr("storeid", <?=$store->id?>);
        $("#input-file-banner_footer").attr("data-height", 225);
        $("#input-file-banner_footer").attr("data-default-file", "{{ asset($information['banner_footer'])}}");
        $("#input-file-banner_footer").dropify();
        var bfooter = $("#input-file-banner_footer").dropify();
        bfooter.on('dropify.beforeClear', function (event, element) {
            //console.log(event);
            var store_id = (element.input[0].attributes.storeid.value);
            $.post("{{ route('dashboard.admin.information.remove') }}", {
                _token: $('meta[name=csrf-token]').attr('content'),
                _method: 'POST',
                storeid: store_id,
                banner: 'banner_footer'
            }, function (response) {

                if (response != '') {
                    console.log(response);
                }


            });


        });

    </script>

    <script>
        $('#select_currency option[value={{$information['currency']}}]').attr('selected', 'selected');
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
