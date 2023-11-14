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
                                aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
        </div>
        <form class="form-horizontal" method="POST" action="{{ $route }}" autocomplete="off"
              enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12">
                <div class="box-content card white">
                    <h4 class="box-title">
                        @if($title_page !== 'page_edit')
                            {{ __('master.add_new') }}
                        @else
                            {{ __('master.update_item') }}
                        @endif
                    </h4>
                    <div class="card-content">
                        <div class="col-lg-12 col-xs-12">
                            <div class="box-content card white">
                                <h4 class="box-title">العربية</h4>
                                <div class="card-content">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input type="text" name="title_ar"
                                                   value="{{ $data['title_ar']?? old('title_ar')}}"
                                                   class="form-control"
                                                   placeholder="عنوان الصفحة  باللغة العربية">
                                        </div>
                                    </div>
                                    <textarea id="content_ar" title="content_ar"
                                              name="content_ar">{{ $data['content_ar'] ?? old('content_ar')}}</textarea>
                                    <textarea class="form-control" id="description_ar" rows="3"
                                              name="description_ar"
                                              placeholder="وصف الصفحة لمحركات البحث">{{ $data['description_ar'] ?? old('description_ar')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12" style="direction: ltr;">
                            <div class="box-content card white">
                                <h4 class="box-title">English</h4>
                                <div class="card-content">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input name="title_en" type="text"
                                                   value="{{$data['title_en'] ?? old('title_en')}}"
                                                   class="form-control"
                                                   placeholder="Title of the page in English">
                                        </div>
                                    </div>
                                    <textarea id="content_en" title="content_en"
                                              name="content_en">{{$data['content_en'] ?? old('content_en')}}</textarea>
                                    <textarea class="form-control" id="description_en" rows="3"
                                              name="description_en"
                                              placeholder="Page description of the search engines">{{ $data['description_en'] ?? old('description_en')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12" style="direction: ltr;">
                            <div class="box-content card white">
                                <h4 class="box-title">{{__('master.french')}}</h4>
                                <div class="card-content">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input name="title_fr" type="text"
                                                   value="{{$data['title_fr'] ?? old('title_fr')}}"
                                                   class="form-control"
                                                   placeholder="Title of the page in English">
                                        </div>
                                    </div>
                                    <textarea id="content_fr" title="content_fr"
                                              name="content_fr">{{$data['content_fr'] ?? old('content_fr')}}</textarea>
                                    <textarea class="form-control" id="description_fr" rows="3"
                                              name="description_fr"
                                              placeholder="Page description of the search engines">{{ $data['description_fr'] ?? old('description_fr')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box-content card white">
                    <h4 class="box-title">{{ __('master.page_link') }}</h4>
                    <div class="card-content">
                        <div class="col-xs-12 margin-bottom-10">
                            <input type="text" name="link"
                                   value="{{ $data['link']?? old('link')}}"
                                   class="form-control"
                                   placeholder="{{ __('master.page_link') }}">
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

    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
