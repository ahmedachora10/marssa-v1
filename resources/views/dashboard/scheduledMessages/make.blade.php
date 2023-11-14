@extends('dashboard.master')

@section('AdvancedSettings')
    current active
@endsection
@section('about')
    current
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/editor/summernote-lite.css') }}">
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
                                aria-hidden="true">&times;</span></button>
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
        </div>
        @if(isset($model))
            <form class="form-horizontal" method="POST"
                  action="{{ route("dashboard.admin.store_settings.scheduled_messages.update",$model->id) }}"
                  autocomplete="off"
                  enctype="multipart/form-data">
                @method("PATCH")
                @else
                    <form class="form-horizontal" method="POST"
                          action="{{ route("dashboard.admin.store_settings.scheduled_messages.store") }}"
                          autocomplete="off"
                          enctype="multipart/form-data">
                        @endif
                        @csrf
                        <div class="col-lg-12">
                            <div class="box-content card white">
                                <h4 class="box-title">
                                    {{ __("master.$title_page")}}
                                </h4>
                                <div class="card-content">
                                    <div class="col-lg-12 col-xs-12">
                                        <div class="box-content card white">
                                            <div class="card-content">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="switch primary margin-top-30 ">
                                                            <input type="checkbox" name="files" id="files"
                                                                   value="1" @isset($model) {{data_get(json_decode($model->value),'type') == 'file' ? 'checked':''}} @endisset>
                                                            <label for="files">{{ __('master.files') }}</label>
                                                        </div>
                                                        <div class="d-flex">
                                                            <textarea name="message" class="form-control"
                                                                      style="@if(isset($model)) {{data_get(json_decode($model->value),'type') == 'file' ? 'display:none':'display:inline-block'}}  @else display:inline-block; @endif"
                                                                      id="text"
                                                                      placeholder="{{__("master.message")}}">@if(isset($model)) @if(isset(json_decode($model->value)->message)){{json_decode($model->value)->message}} @endif @endif</textarea>
                                                            <div id="file"
                                                                 style="@if(isset($model)){{ data_get(json_decode($model->value),'type') == 'file' ? 'display:block':'display:none'}}  @else display:none; @endif">
                                                                @if(isset($model))
                                                                    @if(isset(json_decode($model->value)->image))
                                                                        <?php
                                                                        $array = [
                                                                            'image' => [
                                                                                json_decode($model->value)->image
                                                                            ]
                                                                        ];
                                                                        ?>
                                                                        @include("dashboard.components.fileUpload",['product'=>(object)$array])
                                                                    @else
                                                                        @include("dashboard.components.fileUpload")
                                                                    @endif
                                                                @else
                                                                    @include("dashboard.components.fileUpload")
                                                                @endif
                                                            </div>
                                                            <div class="col-xs-12 " style="margin-top: 30px;">
                                                                <div>
                                                                    <label>{{__('master.after_second')}}</label>
                                                                    <input
                                                                            type="number" name="second"
                                                                            min="0"
                                                                            max="60"
                                                                            value="{{  data_get(json_decode($model->value??''),'second')?? old('second')}}"
                                                                            class="form-control"
                                                                            placeholder="{{__('master.after_second')}}"
                                                                    >
                                                                </div>
                                                                <div>
                                                                    <label>{{__('master.after_minute')}}</label>
                                                                    <input
                                                                            type="number" name="minute"
                                                                            min="0"
                                                                            max="60"
                                                                            value="{{  data_get(json_decode($model->value??''),'minute')?? old('minute')}}"
                                                                            class="form-control"
                                                                            placeholder="{{__('master.after_minute')}}">

                                                                </div>
                                                                <div>
                                                                    <label>{{__('master.after_hour')}}</label>
                                                                    <input type="number" name="hour"
                                                                           min="0"
                                                                           max="23"
                                                                           value="{{  data_get(json_decode($model->value??''),'hour')?? old('hour')}}"
                                                                           class="form-control"
                                                                           placeholder="{{__('master.after_hour')}}">
                                                                </div>
                                                                <div>
                                                                    <label>{{__('master.after_day')}}</label>
                                                                    <input type="number" name="day"
                                                                           min="0"
                                                                           max=""
                                                                           value="{{  data_get(json_decode($model->value??''),'day')?? old('day')}}"
                                                                           class="form-control"
                                                                           placeholder="{{__('master.after_day')}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-lg btn-block btn-primary waves-effect waves-light">
                                    <i class="ico ico-left fa fa-check"></i>
                                    <span>{{__('master.save_settings')}}</span>
                                </button>
                            </div>

                            <div class="clearfix margin-bottom-50"></div>

                    </form>
    </div>
@endsection


@section('script')
    <script src="{{ asset('dashboard/light/assets/editor/summernote-lite.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/lang/summernote-ar-AR.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/title_image.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#content_ar').summernote({
                imageTitle: {
                    specificAltField: true,
                },
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
                placeholder: 'محتوى الصفحة باللغة العربية',
                lang: 'ar-AR',
                height: 250,
                tabsize: 2
            });
            $('#content_en').summernote({
                imageTitle: {
                    specificAltField: true,
                },
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
                placeholder: 'Content of the page in English',
                height: 250,
                tabsize: 2
            });
            $('#content_fr').summernote({
                imageTitle: {
                    specificAltField: true,
                },
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
                placeholder: '{{__('master.description')}}',
                height: 250,
                tabsize: 2
            });
        });
        $("#files").on("change", function (e) {

            if (e.target.checked) {
                $("#text").hide('slow');
                $("#file").show('slow');
            } else {
                $("#text").show('slow');
                $("#file").hide('slow');
            }

        })
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
