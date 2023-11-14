@extends('dashboard.master')


@section('offers_index')
    current active
@endsection

@section('head_tag')

    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/editor/summernote-lite.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"
     integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.css') }}">
    <!-- FlexDatalist -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/flexdatalist/jquery.flexdatalist.min.css') }}">
    <!-- Popover -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/popover/jquery.popSelect.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/select2/css/select2.min.css') }}">
    <!-- Timepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.css') }}"
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
    <style>

    .dropzone {
        border: 2px dashed #dedede;
        border-radius: 5px;
        background: #f5f5f5;
    }

    .dropzone i{
        font-size: 5rem;
    }

    .dropzone .dz-message {
        color: rgba(0,0,0,.54);
        font-weight: 500;
        font-size: initial;
        text-transform: uppercase;
    }
    .dropzone .dz-message:before{
        content:"" !important;
    }
    
    </style>
@endsection

@section('content')

    <div class="row small-spacing">
        <div class="col-xs-12">
            <div class="box-content bordered primary ">
                <form action="{{route('dashboard.admin.landing_pages.store')}}" method="POST">
                    @method('post')
                    @csrf
                    <div class="col-xs-12 box-content">
                        
                    <div class="row">
                            @foreach($language as $lang)
                        <div class="@if(count($language) == 3) col-md-4 @endif col-xs-12">
                            <div class="form-group  @error('name__$lang') has-error @enderror">
                                <label for="name_{{$lang}}">{{ __('master.offer_name')    . ' (' . __('master.'.$lang ).')' }}</label>
                                <input required id="name_{{$lang}}" name="name_{{$lang}}" type="text" class="form-control"
                                       value="{{  old('name_$lang')}}" placeholder="{{ __('master.offer_name') . ' (' . __('master.'.$lang ).')'}}  "/>
                                @error('name_$lang')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div><div class="form-group @error('content_$lang') has-error @enderror">
                                <textarea required type="text" class="form-control "
                                       id="content_{{$lang}}"  name="content_{{$lang}}"
                                        placeholder="{{__('master.offer_desc')  . ' (' . __('master.'.$lang ).')'}}" rows="3">{{  old('content_$lang')}}</textarea>
                                @error('content_$lang')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                            @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  @error('price') has-error @enderror">
                                <label for="price">{{ __('master.offer_price') }}1</label>
                                <input required id="price" name="price" type="text" class="form-control"
                                       value="{{  old('price')}}" placeholder="{{ __('master.offer_price') }}1"/>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                    <div class="col-md-6">
                        <div class="form-group  @error('price_notice') has-error @enderror">
                            <label for="price_notice">{{ __('master.price_notice') }} 1</label>
                            <input required id="price_notice" name="price_notice" type="text" class="form-control"
                                   value="{{  old('price_notice')}}" placeholder="{{ __('master.price_notice') }} 1"/>
                            @error('price_notice')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        </div>
                        </div>
                        
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  @error('price1') has-error @enderror">
                            <label for="price1">{{ __('master.offer_price') }} 2</label>
                            <input  id="price1" name="price1" type="text" class="form-control"
                                   value="{{  old('price1')}}" placeholder="{{ __('master.offer_price') }} 2"/>
                            @error('price1')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        </div>
                    <div class="col-md-6">
                        <div class="form-group  @error('price_notice1') has-error @enderror">
                            <label for="price_notice1">{{ __('master.price_notice') }} 2</label>
                            <input  id="price_notice1" name="price_notice1" type="text" class="form-control"
                                   value="{{  old('price_notice1')}}" placeholder="{{ __('master.price_notice') }} 2"/>
                            @error('price_notice1')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        </div>
                        </div>
                        
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group  @error('price2') has-error @enderror">
                            <label for="price2">{{ __('master.offer_price') }} 3</label>
                            <input  id="price2" name="price2" type="text" class="form-control"
                                   value="{{  old('price2')}}" placeholder="{{ __('master.offer_price') }} 3"/>
                            @error('price2')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        </div>
                        
                        <div class="col-md-6">
                        <div class="form-group  @error('price_notice2') has-error @enderror">
                            <label for="price_notice2">{{ __('master.price_notice') }} 3</label>
                            <input  id="price_notice2" name="price_notice2" type="text" class="form-control"
                                   value="{{  old('price_notice2')}}" placeholder="{{ __('master.price_notice') }} 3"/>
                            @error('price_notice2')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        </div>
                        </div>
                    <!--div class="row">
                    <div class="col-md-6">
                        <div class="form-group  @error('price3') has-error @enderror">
                            <label for="price3">{{ __('master.offer_price') }} 4</label>
                            <input  id="price3" name="price3" type="text" class="form-control"
                                   value="{{  old('price3')}}" placeholder="{{ __('master.offer_price') }} 4"/>
                            @error('price3')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        </div>
                    <div class="col-md-6">
                        <div class="form-group  @error('price_notice3') has-error @enderror">
                            <label for="price_notice3">{{ __('master.price_notice') }} 4</label>
                            <input  id="price_notice3" name="price_notice3" type="text" class="form-control"
                                   value="{{  old('price_notice3')}}" placeholder="{{ __('master.price_notice') }} 4"/>
                            @error('price_notice3')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        </div>
                        </div>
                        
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  @error('price4') has-error @enderror">
                            <label for="price4">{{ __('master.offer_price') }} 5</label>
                            <input  id="price4" name="price4" type="text" class="form-control" placeholder="{{ __('master.offer_price') }} 5"
                                   value="{{  old('price4')}}"/>
                            @error('price4')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        </div>
                    <div class="col-md-6">
                        <div class="form-group  @error('price_notice4') has-error @enderror">
                            <label for="price_notice4">{{ __('master.price_notice') }} 5</label>
                            <input  id="price_notice4" name="price_notice4" type="text" class="form-control"
                                   value="{{  old('price_notice4')}}" placeholder="{{ __('master.price_notice') }} 5"/>
                            @error('price_notice4')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        </div>
                        </div-->
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group  @error('desc') has-error @enderror">
                                    <label for="desc">{{ __('master.desc') }} </label>
                                    <textarea  id="desc" name="desc"  class="form-control" 
                                    placeholder="{{ __('master.desc') }}">{{  old('desc')}}</textarea>
                                    @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group  @error('notes') has-error @enderror">
                                    <label for="notes">{{ __('master.offer_notes') }} </label>
                                    <textarea  id="notes" name="notes"  class="form-control" 
                                    placeholder="{{ __('master.offer_notes') }}">{{  old('notes')}}</textarea>
                                    @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                            <div class="form-group  @error('status') has-error @enderror">
                                <label for="btn_text">{{ __('master.status') }}</label>
                                <div class="switch primary margin-top-3">
                                    <input type="checkbox" name="status" id="status"
                                           value="1"
                                           checked>
                                    <label for="status" >
                                       <span id="status_text">{{ __('master.Active') }}</span> 
                                        <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                              title="{{ __('master.required_data') }}">*</span>
                                    </label>
                                </div>
                                @error('status')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  @error('btn_text') has-error @enderror">
                                <label for="btn_text">{{ __('master.btn_text') }}</label>
                                <input  id="btn_text" name="btn_text" type="text" class="form-control"
                                       value="{{  old('btn_text')}}" placeholder="{{ __('master.btn_text') }}"/>
                                @error('btn_text')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label class="box-title">
                                        <span>{{__('master.footer_texts')}}</span>
                                    </label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  @error('pay_text') has-error @enderror">
                                <label for="pay_text">{{ __('master.pay_text') }}</label>
                                <input  id="pay_text" name="pay_text" type="text" class="form-control"
                                       value="{{  old('pay_text')}}" placeholder="{{ __('master.pay_text') }}"/>
                                @error('pay_text')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  @error('delivery_text') has-error @enderror">
                                <label for="delivery_text">{{ __('master.delivery_text') }}</label>
                                <input  id="delivery_text" name="delivery_text" type="text" class="form-control"
                                       value="{{  old('delivery_text')}}" placeholder="{{ __('master.delivery_text') }}"/>
                                @error('delivery_text')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  @error('notice_text') has-error @enderror">
                                <label for="notice_text">{{ __('master.notice_text') }}</label>
                                <input  id="notice_text" name="notice_text" type="text" class="form-control"
                                       value="{{  old('notice_text')}}" placeholder="{{ __('master.notice_text') }}"/>
                                @error('notice_text')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                            <div class="row">

                                <div class="form-group @error('image') has-error @enderror">
                                    <label class="box-title">
                                        <span>{{ __('master.images')}}</span>
                                        <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                              title="{{ __('master.required_data') }}">*</span>
                                        <span class="hint"> 700x800</span>
                                    </label>
                                    <div class="card-content">
                                        @include("dashboard.components.fileUploadDzone",['product'=>$product?? []])
                                        <!--@include("dashboard.components.fileUpload0",['product'=>$product?? []])
                                         @include("dashboard.components.fileUpload",['product'=>$product?? []]) -->

                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

{{--
                                @foreach($language as $lang)

                                    <div class="@if(count($language) == 3) col-md-4 @endif col-xs-12">
                                        <div class="form-group  @error('name_{{$lang}}') has-error @enderror">
                                            <label for="name_{{$lang}}">{{ __('master.product_name') . ' (' . __('master.'.$lang ).')'  }}</label>
                                            <input id="name_{{$lang}}" name="name_{{$lang}}" type="text"
                                                   class="form-control"
                                                   value="{{ $product["name_$lang"] ?? old("name_$lang")}}"
                                                   placeholder="{{ __('master.product_name_'.$lang.'_placeholder') }}"
                                                   required/>
                                            @error('name_{{$lang}}')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <textarea id="content_{{$lang}}" title="content_{{$lang}}"
                                                  name="content_{{$lang}}">{{ $product["content_$lang"] ?? old("content_$lang")}}</textarea>

                                    </div>
                                @endforeach --}}
                            </div>
                    <div class="d-flex justify-content-center text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="ico ico-left fa fa-plus"></i>
                            {{ __('master.add_new') }}
                        </button>
                    </div>
                    </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" 
    integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/moment/moment.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/form.demo.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/summernote-lite.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/lang/summernote-ar-AR.min.js') }}"></script>
    <script>
    $("#status").on('change', function() {
  if ($("#status").is(':checked'))
  //  alert("checked");
    $("#status_text").text("{{__('master.Active')}}");
  else {
  //  alert("unchecked");
    $("#status_text").text("{{__('master.Inactive')}}");
  }});
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
                placeholder: "{{ __('master.offer_desc') }}",
                lang: 'ar-AR',
                height: 350,
                tabsize: 2,
                disableDragAndDrop: true,
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
                placeholder: "{{ __('master.offer_desc') }}",
                height: 350,
                tabsize: 2,
                disableDragAndDrop: true,
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
                placeholder: "{{ __('master.offer_desc') }}",
                height: 350,
                tabsize: 2,
                disableDragAndDrop: true,
            });
            
    var uploadedDocumentMap = {}
    Dropzone.options.dpzMultipleFiles = {
        paramName: "file", // The name that will be used to transfer the file
        //autoProcessQueue: false,
        maxFilesize: 5, // MB
        clickable: true,
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
        dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
        dictCancelUpload: "الغاء الرفع ",
        dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
        dictRemoveFile: "حذف الصوره",
        dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هذا ",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        url: "{{ route('dashboard.admin.landing_pages.saveFile') }}", // Set the url
        success: function(file, response) {
            console.log(response);
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name;
        $('#file').val(response.name);
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
        init: function() {
            @if (isset($event) && $event->document)
                var files =
                {!! json_encode($event->document) !!}
                for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                }
            @endif
        }
    }
    </script>
@endsection
{{--Developed By Moayad Hassan--}}
