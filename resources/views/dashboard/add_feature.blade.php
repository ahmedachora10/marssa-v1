@extends('dashboard.master')

@section('store_settings')
    current active
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
        <form class="form-horizontal" method="POST"
              action="{{ $route }}" autocomplete="off"
              enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12">
                <div class="box-content card white">
                    <h4 class="box-title">
                        @if($title_page !== 'feature_edit')
                            {{ __('master.add_new') }}
                        @else
                            {{ __('master.update_item') }}
                        @endif
                    </h4>
                    <div class="card-content">

                        <div class="col-lg-6 col-xs-12">
                            <div class="box-content card white">
                                <h4 class="box-title">العربية</h4>
                                <div class="card-content">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input type="text" name="title_ar" value="{{$data['title_ar'] ?? ''}}"
                                                   class="form-control"
                                                   placeholder="عنوان الميزة باللغة العربية">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <textarea name="description_ar" class="form-control" id="inp-type-2"
                                                  placeholder="وصف الميزة باللغة العربية">{{$data['description_ar'] ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12" style="direction: ltr;">
                            <div class="box-content card white">
                                <h4 class="box-title">English</h4>
                                <div class="card-content">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input name="title_en" type="text"
                                                   value="{{$data['title_en'] ?? ''}}"
                                                   class="form-control"
                                                   placeholder="Title of the feature in English">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <textarea name="description_en" class="form-control"
                                                  placeholder="Description of the feature in English">{{$data['description_en'] ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12" style="direction: ltr;">
                        </div>

                         <div class="col-lg-6 col-xs-12" style="direction: ltr;">
                            <div class="box-content card white">
                                <h4 class="box-title">French</h4>
                                <div class="card-content">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input name="title_fr" type="text"
                                                   value="{{$data['title_fr'] ?? ''}}"
                                                   class="form-control"
                                                   placeholder="Title of the feature in French">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <textarea name="description_fr" class="form-control"
                                                  placeholder="Description of the feature in French">{{$data['description_fr'] ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="box-content">
                                <h4 class="box-title">{{ __('master.feature_icon') }}</h4>
                                <div class="card-content">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input name="icon" type="text"
                                                   value="{{$data['icon'] ?? ''}}"
                                                   class="form-control"
                                                   placeholder="{{ __('master.feature_icon') }}">
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
{{--Developed Saed Z. Sinwar--}}