@extends('dashboard.master')

@section('AdvancedSettings')
    current active
@endsection
@section('information')
    current
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/dropify/css/dropify.min.css') }}">
@endsection

@section('content')
    <div class="row small-spacing">
        <div class="col-xs-12">
            @if (count($errors) > 0)
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
        </div>
        <form class="form-horizontal" method="POST" action="{{ route('dashboard.admin.information.store') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12">
                <div class="box-content card white">
                    <h4 class="box-title">{{ __('master.information') }}</h4>
                    <div class="card-content">
                        <div class="col-lg-6 col-xs-12"
                             style="direction: {{ app()->getLocale() == 'en' ? 'rtl' : '' }};">
                            <div class="box-content card white">
                                <h4 class="box-title">العربية</h4>
                                <div class="card-content">
                                    <div class="form-group">
                                        <label for="inp-type-1" class="col-sm-3 control-label">العنوان</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title_page_ar"
                                                   value="{{ $information->title_page_ar  ?? '' }}"
                                                   class="form-control" id="inp-type-1"
                                                   placeholder="ترويسة القسم باللغة العربية">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-type-2" class="col-sm-3 control-label">الوصف</label>
                                        <div class="col-sm-9">
                                        <textarea name="description_ar" class="form-control" id="inp-type-2"
                                                  placeholder="وصف القسم باللغة العربية">{{ $information->description_ar ?? ''  }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-type-13" class="col-sm-3 control-label">الكلمات الدلالية</label>
                                        <div class="col-sm-9">
                                        <textarea name="keyword_ar" class="form-control" id="inp-type-13"
                                                  placeholder="الكلمات الدلالية باللغة العربية">{{ $information->keyword_ar ?? ''  }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12"
                             style="direction: {{ app()->getLocale() == 'ar' ? 'ltr' : '' }};">
                            <div class="box-content card white">
                                <h4 class="box-title">English</h4>
                                <div class="card-content">
                                    <div class="form-group">
                                        <div class="col-sm-9">
                                            <input name="title_page_en" type="text"
                                                   value="{{ $information->title_page_en  ?? '' }}"
                                                   class="form-control" id="inp-type-3"
                                                   placeholder="Title of the section in English">
                                        </div>
                                        <label for="inp-type-3" class="col-sm-3 control-label"
                                               style="text-align: left;">Title</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-9">
                                        <textarea name="description_en" class="form-control" id="inp-type-4"
                                                  placeholder="Description of the website in English">{{ $information->description_en ?? ''  }}</textarea>
                                        </div>
                                        <label for="inp-type-4" class="col-sm-3 control-label"
                                               style="text-align: left;">Description</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-9">
                                        <textarea name="keyword_en" class="form-control" id="inp-type-14"
                                                  placeholder="Keyword of the website in English">{{ $information->keyword_en ?? ''  }}</textarea>
                                        </div>
                                        <label for="inp-type-14" class="col-sm-3 control-label"
                                               style="text-align: left;">Keyword</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box-content card white">
                    <h4 class="box-title">{{ __('master.communication_data')}}</h4>
                    <div class="card-content">
                        <div class="form-group">
                            <label for="inp-type-10" class="col-sm-3 control-label">{{ __('master.co_address')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" value="{{ $information->address  ?? '' }}"
                                       class="form-control" id="inp-type-10">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inp-type-11" class="col-sm-3 control-label">{{ __('master.co_phone')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" value="{{ $information->phone  ?? '' }}"
                                       class="form-control" id="inp-type-11">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inp-type-12"
                                   class="col-sm-3 control-label">{{ __('master.email_address')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" value="{{ $information->email  ?? '' }}"
                                       class="form-control" id="inp-type-12">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box-content card white">
                    <h4 class="box-title">ربط الخدمات</h4>
                    <div class="card-content">
                        <div class="form-group">
                            <label for="inp-type-10" class="col-sm-3 control-label">Facebook Pixel</label>
                            <div class="col-sm-9">
                                <input type="text" name="facebook_pixel" value=""
                                       class="form-control" id="inp-type-10">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inp-type-11" class="col-sm-3 control-label">Google Tag Manger</label>
                            <div class="col-sm-9">
                                <input type="text" name="google_tag_manger" value=""
                                       class="form-control" id="inp-type-11">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box-content card white">
                    <h4 class="box-title">{{ __('master.social_media') }}</h4>
                    <div class="card-content">
                        <div class="form-group">
                            <label for="inp-type-5" class="col-sm-3 control-label">{{ __('master.facebook')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="facebook" value="{{ $information->facebook  ?? ''  }}"
                                       class="form-control" id="inp-type-5">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inp-type-6" class="col-sm-3 control-label">{{ __('master.twitter')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="twitter" value="{{ $information->twitter ?? ''  }}"
                                       class="form-control" id="inp-type-6">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inp-type-7" class="col-sm-3 control-label">{{ __('master.whatsapp')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="whatsapp" value="{{ $information->whatsapp ?? ''  }}"
                                       class="form-control" id="inp-type-7">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inp-type-8" class="col-sm-3 control-label">{{ __('master.instagram')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="instagram" value="{{ $information->instagram ?? ''  }}"
                                       class="form-control" id="inp-type-8">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inp-type-9" class="col-sm-3 control-label">{{ __('master.youtube')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="youtube" value="{{ $information->youtube ?? ''  }}"
                                       class="form-control" id="inp-type-9">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box-content card white">
                    <div class="card-content">
                        <div class="col-lg-4 col-xs-12">
                            <div class="box-content card white">
                                <h4 class="box-title"><span>{{ __('master.co_icon')}}</span>
                                    <span class="hint">80x80</span></h4>
                                <div class="card-content">
                                    @if($information['icon'])
                                        <input type="file" name="icon" id="input-file-icon"/>
                                    @else
                                        <input type="file" name="icon" id="input-file-icon" class="dropify"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <div class="box-content card white">
                                <h4 class="box-title"><span>{{ __('master.co_logo')}}</span>
                                    <span class="hint">200x72</span></h4>
                                <div class="card-content">
                                    @if($information['logo'])
                                        <input type="file" name="logo" id="input-file-logo"/>
                                    @else
                                        <input type="file" name="logo" id="input-file-logo" class="dropify"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <div class="box-content card white">
                                <h4 class="box-title"><span>{{ __('master.co_preview')}}</span>
                                    <span class="hint"> 300x300</span></h4>
                                <div class="card-content">
                                    @if($information['preview'])
                                        <input type="file" name="preview" id="input-file-preview"/>
                                    @else
                                        <input type="file" name="preview" id="input-file-preview" class="dropify"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary waves-effect waves-light">
                        <i class="ico ico-left fa fa-check"></i>
                        <span>{{ __('master.save_settings')}}</span>
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection


@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/fileUpload.demo.min.js') }}"></script>

    @if($information['icon'])
        <script>
            $("#input-file-icon").addClass('dropify');
            $("#input-file-icon").attr("data-height", 225);
            $("#input-file-icon").attr("data-default-file", "{{ asset('site/images'.$information['icon'])}}");
            $("#input-file-icon").dropify();
        </script>
    @endif
    @if($information['logo'])
        <script>
            $("#input-file-logo").addClass('dropify');
            $("#input-file-logo").attr("data-height", 225);
            $("#input-file-logo").attr("data-default-file", "{{ asset('site/images'.$information['logo'])}}");
            $("#input-file-logo").dropify();
        </script>
    @endif
    @if($information['preview'])
        <script>
            $("#input-file-preview").addClass('dropify');
            $("#input-file-preview").attr("data-height", 225);
            $("#input-file-preview").attr("data-default-file", "{{ asset('site/images'.$information['preview'])}}");
            $("#input-file-preview").dropify();
        </script>
    @endif
@endsection
{{--Developed Saed Z. Sinwar--}}