@extends('dashboard.master')

@section('upsell_index')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.css') }}">
    <!-- FlexDatalist -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/flexdatalist/jquery.flexdatalist.min.css') }}">

    <!-- Popover -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/popover/jquery.popSelect.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/select2/css/select2.min.css') }}">

    <!-- Timepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.css') }}">

    <!-- Touch Spin -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/touchspin/jquery.bootstrap-touchspin.min.css') }}">

    <!-- Colorpicker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/colorpicker/css/bootstrap-colorpicker.min.css') }}">

    <!-- Datepicker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/datepicker/css/bootstrap-datepicker.min.css') }}">

    <!-- DateRangepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/editor/summernote-lite.css') }}">
@endsection

@section('content')
    @if (session('message'))
        <div class="small-spacing">
            <div class="col-xs-12">
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ __('master.'.session('message')) }}</strong>
                </div>
            </div>
        </div>
    @endif
    <div class="col-xs-12">
        <div class="col-md-12 col-xs-12">
            <form method="post" action="{{ $route }}" autocomplete="off"
                  enctype="multipart/form-data">
                <input type="hidden" value="{{ $upsell->id ?? ''}}" name="id">
                @csrf
                <div class="row">
                    <div class="col-xs-12 box-content">

                            <div class="form-group @error('product') has-error @enderror">
                                <label for="input-states-5">{{ __('master.product_name') }}</label>
                                <select name="product_id" class="form-control" id="input-states-5" required>
                                    <option value="" disabled selected> {{ __('master.product_name') }} </option>
                                    @foreach($products as $product)
                                        <option @if($upsell != false) {{$upsell->product_id==$product->id?'selected':''}}   @endif value="{{$product->id}}">
                                            {{ $product['name_'.$product->store->getLang()] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('product') has-error @enderror">
                                <label for="input-states-5">منتج العرض</label>
                                <select name="offer_id" class="form-control" id="input-states-5" required>
                                    <option value="" disabled selected> {{ __('master.product_name') }} </option>
                                    @foreach($products as $product)
                                        <option @if($upsell != false) {{$upsell->offer_id==$product->id?'selected':''}}   @endif  value="{{$product->id}}">
                                            {{ $product['name_'.$product->store->getLang()] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group  @error('status') has-error @enderror">
                                <div class="switch primary margin-top-30 ">
                                    <input type="checkbox" name="status" id="status"  @if($upsell != false){{$upsell->status=='active'?'checked':''}}@endif >
                                    <label for="status">الحالة
                                        <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                              title="{{ __('master.required_data') }}">*</span>
                                    </label>
                                </div>
                                @error('status')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            
                            
                            <div class="form-group  @error('show_product_image') has-error @enderror">
                                <div class="switch primary margin-top-30 ">
                                    <input type="checkbox" name="show_product_image" value="1" id="show_product_image"  @if($upsell != false){{$upsell->show_product_image =='1'?'checked':''}}@endif >
                                    <label for="show_product_image">{{ __('master.show_product_image') }}
                                        <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                              title="{{ __('master.required_data') }}">*</span>
                                    </label>
                                </div>
                                @error('show_product_image')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            @foreach($language as $lang)
                                <div class="@if(count($language) == 3) col-md-4 @endif col-xs-12">
                                    <div class="form-group  @error('name_{{$lang}}') has-error @enderror">
                                        <label for="name_{{$lang}}">{{ __('master.title') . ' (' . __('master.'.$lang ).')'  }}</label>
                                        <input id="name_{{$lang}}" name="title_{{$lang}}" type="text"
                                               class="form-control"
                                               value="{{ $upsell["title_$lang"] ?? old("name_$lang")}}"
                                               placeholder="{{ __('master.title') }}" />


                                    </div>

                                    <textarea  id="desc_{{$lang}}" title="content_{{$lang}}"
                                               name="desc_{{$lang}}">{{ $upsell["desc_$lang"] ?? old("desc_$lang")}}</textarea>

                                    <div class="form-group  @error('accept_{{$lang}}') has-error @enderror">
                                        <label for="button_{{$lang}}">عنوان زر القبول </label>
                                        <input id="accept_{{$lang}}" name="accept_{{$lang}}" type="text"
                                               class="form-control"
                                               value="{{ $upsell["accept_$lang"] ?? old("accept_$lang")}}"
                                               placeholder="{{ __('master.title') }}" />


                                    </div>

                                    <div class="form-group  @error('cancel_{{$lang}}') has-error @enderror">
                                        <label for="button_{{$lang}}">عنوان زر الرفض </label>
                                        <input id="cancel_{{$lang}}" name="cancel_{{$lang}}" type="text"
                                               class="form-control"
                                               value="{{ $upsell["cancel_$lang"] ?? old("cancel_$lang")}}"
                                               placeholder="{{ __('master.title') }}" />


                                    </div>

                                </div>


                            @endforeach

                            <div class="form-group">
                                <label for="">لون زر الرفض </label>
                                <input  name="cancel_color" type="color"
                                       class="form-control"
                                       value="{{ $upsell["cancel_color"] ?? '#f50707'}}"/>


                            </div>



                        <div class="form-group">
                            <label for="">لون زر القبول </label>
                            <input  name="accept_color" type="color"
                                    class="form-control"
                                    value="{{ $upsell["accept_color"] ?? '#46da21'}}"/>


                        </div>
                    </div>

                    <div class="col-xs-12 margin-bottom-30 text-center">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                            @if($title_page !== 'upsell_edit')
                                {{ __('master.add_new') }}
                            @else
                                {{ __('master.update_item') }}
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/moment/moment.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/form.demo.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/summernote-lite.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/lang/summernote-ar-AR.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/title_image.js') }}"></script>
    <script>
    $(document).ready(function(){
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
            placeholder: "{{ __('master.product_description') }}",
            lang: 'ar-AR',
            height: 350,
            tabsize: 2,
            disableDragAndDrop: true,
        });
        $('#desc_ar').summernote({
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
            placeholder: "{{ __('master.more_details') }}",
            lang: 'ar-AR',
            height: 250,
            tabsize: 2,
            disableDragAndDrop: true,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        $('#desc_en').summernote({
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
            placeholder: "{{ __('master.more_details') }}",
            lang: 'en-EN',
            height: 250,
            tabsize: 2,
            disableDragAndDrop: true,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        $('#desc_fr').summernote({
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
            placeholder: "{{ __('master.more_details') }}",
            lang: 'fr-FR',
            height: 250,
            tabsize: 2,
            disableDragAndDrop: true,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ]
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
            placeholder: "{{ __('master.product_description') }}",
            height: 350,
            tabsize: 2,
            disableDragAndDrop: true,
        });
    });
        
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
