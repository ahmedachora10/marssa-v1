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
                <div class="panel panel-default panel-small-title margin-bottom-20">
                    <div class="panel-heading">
                        <h6 class="panel-title padding-10">{{ __('master.co_preview') }}</h6>
                    </div>
                    <div class="panel-body margin-bottom-20">
                        <form method="POST" action="{{ route('dashboard.admin.information.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="text-center margin-top-20 margin-bottom-30">
                                        <p>
                                            {!! __('master.note_seo_view') !!}
                                        </p>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="card-content text-center margin-bottom-10">
                                            <div class="card-content margin-bottom-10">
                                                @if($information['preview'])
                                                    <input type="file" name="preview" id="input-file-preview"/>
                                                @else
                                                    <input type="file" name="preview" id="input-file-preview"
                                                           class="dropify"/>
                                                @endif
                                            </div>
                                            <p class="box-title"><span>{{ __('master.co_preview')}}</span><span
                                                        class="hint"> 300x300</span></p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                                class="margin-top-20 btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                            {{ __('master.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default panel-small-title">
                    <div class="panel-heading">
                        <h6 class="panel-title padding-10">{{ __('master.store_description') }}</h6>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('dashboard.admin.information.store') }}">
                            @csrf
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="text-center margin-top-20 margin-bottom-30">
                                        <p>
                                            {!! __('master.note_seo_des') !!}
                                        </p>
                                    </div>
                                    <div class="col-xs-12">
                                        @if(count($language) == 1)
                                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                                @endif
                                                @foreach($language as $lang)
                                                    <div class="@if($loop->count == 1)col-md-12 @else col-md-6 @endif col-xs-12">
                                                        <div class="card-content">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fab fa-stack-exchange fa-lg"
                                                               aria-hidden="true"></i>
                                                        </span>
                                                                    <textarea class="form-control" maxlength="320"
                                                                              id="description-{{ $loop->index }}"
                                                                              placeholder="{{ __('master.store_description') . ' (' . __("master.$lang") . ')'  }}"
                                                                              name="description_{{$lang}}">{{ $information["description_$lang"] }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if(count($language) == 1)
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                                class="margin-top-20 btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                            {{ __('master.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default panel-small-title">
                    <div class="panel-heading">
                        <h6 class="panel-title padding-10">{{ __('master.keywords') }}</h6>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('dashboard.admin.information.store') }}">
                            @csrf
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="text-center margin-top-20 margin-bottom-30">
                                        <p>
                                            {!! __('master.note_seo_key') !!}
                                        </p>
                                    </div>
                                    <div class="col-xs-12">
                                        @if(count($language) == 1)
                                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                                @endif
                                                @foreach($language as $lang)
                                                    <div class="@if($loop->count == 1)col-md-12 @else col-md-6 @endif col-xs-12">
                                                        <div class="card-content">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-tags fa-lg" aria-hidden="true"></i>
                                                        </span>
                                                                    <textarea class="form-control" maxlength="320"
                                                                              placeholder="{{ __('master.keywords') . ' (' . __("master.$lang") . ')'  }}"
                                                                              name="keyword_{{$lang}}">{{ $information["keyword_$lang"] }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if(count($language) == 1)
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                                class="margin-top-20 btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                            {{ __('master.save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/fileUpload.demo.min.js') }}"></script>
    @if($information['preview'])
        <script>
            $("#input-file-preview").addClass('dropify');
            $("#input-file-preview").attr("data-height", 225);
            $("#input-file-preview").attr("data-default-file", "{{ asset($information['preview'])}}");
            $("#input-file-preview").dropify();
        </script>
    @endif
@endsection
{{--Developed Saed Z. Sinwar--}}