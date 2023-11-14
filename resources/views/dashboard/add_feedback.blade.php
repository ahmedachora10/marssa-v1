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
                        @if($title_page !== 'edit_feedback')
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
                                            <input type="text" name="name_ar" value="{{$data['name_ar'] ?? ''}}"
                                                   class="form-control"
                                                   placeholder="اسم الزبون باللغة العربية">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <textarea name="comment_ar" class="form-control" id="inp-type-2"
                                                  placeholder="تعليق التغذية الراجعة باللغة العربية">{{$data['comment_ar'] ?? ''}}</textarea>
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
                                            <input name="name_en" type="text"
                                                   value="{{$data['name_en'] ?? ''}}"
                                                   class="form-control"
                                                   placeholder="Name of the client in English">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <textarea name="comment_en" class="form-control"
                                                  placeholder="Content of the feedback in English">{{$data['comment_en'] ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12" style="direction: ltr;"></div>
                        <div class="col-lg-6 col-xs-12" style="direction: ltr;">
                            <div class="box-content card white">
                                <h4 class="box-title">French</h4>
                                <div class="card-content">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input name="name_fr" type="text"
                                                   value="{{$data['name_fr'] ?? ''}}"
                                                   class="form-control"
                                                   placeholder="Name of the client in French">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <textarea name="comment_fr" class="form-control"
                                                  placeholder="Content of the feedback in French">{{$data['comment_fr'] ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="box-content">
                                <h4 class="box-title">
                                    <span>{{ __('master.client_image') }}</span>
                                    <span class="hint">100x100</span>
                                </h4>
                                @if($data['image'])
                                    <input type="file" name="image" id="input-file-now"/>
                                @else
                                    <input type="file" name="image" id="input-file-now" class="dropify"/>
                                @endif

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
    <script src="{{ asset('dashboard/light/assets/plugin/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/fileUpload.demo.min.js') }}"></script>
    @if($data['image'])
        <script>
            $("#input-file-now").addClass('dropify');
            $("#input-file-now").attr("data-height", 225);
            $("#input-file-now").attr("data-default-file", "{{ asset($data['image']) }}");
            $('.dropify').dropify();
        </script>
    @endif
@endsection
{{--Developed Saed Z. Sinwar--}}
