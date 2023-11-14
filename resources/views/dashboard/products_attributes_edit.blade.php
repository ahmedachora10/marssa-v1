@extends('dashboard.master')


@section('products_attributes_index')
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
                <form action="{{route('dashboard.admin.products.attributes.update',$attribute->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="col-xs-12 box-content">
                        
                    <div class="row">
                            @foreach($language as $lang)
                        <div class="@if(count($language) == 3) col-md-4 @endif col-xs-12">
                            <div class="form-group  @error('name__$lang') has-error @enderror">
                                <label for="name_{{$lang}}">{{ __('master.name_'.$lang .'')}}</label>
                                <input required id="name_{{$lang}}" name="name_{{$lang}}" type="text" class="form-control"
                                      value="{{ $attribute["name_$lang"] ?? old('name_$lang')}}" placeholder="{{ __('master.name_' .$lang .'')}}  "/>
                                @error('name_$lang')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div><div class="form-group @error('description_$lang') has-error @enderror">
                                <textarea required type="text" class="form-control "
                                       id="description_{{$lang}}"  name="description_{{$lang}}"
                                        placeholder="{{__('master.description_'.$lang .'')}}" rows="3">{{ $attribute["description_$lang"] ?? old('name_$lang')}}</textarea>
                                @error('description_$lang')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                            @endforeach
                    </div>
                    <div class="row">{{--
                        <div class="col-md-6">
                            <div class="form-group  @error('display_type') has-error @enderror">
                                <label for="display_type">{{ __('master.display_type') }}</label>
                                <select  id="display_type" name="display_type" class="form-control custom-select">
                                    <option value="" selected disabled>{{__('master.choose_display_type')}}</option>
                                    <option value="radioButton" {{ $attribute["display_type"] =='radioButton'  || old('name_$lang') =='radioButton' ? 'selected' : ''}}>
                                        {{__('master.radioButton')}}
                                    </option>
                                    <option value="selectOption" {{ $attribute["display_type"] =='selectOption'  || old('name_$lang') =='selectOption' ? 'selected' : ''}}>
                                        {{__('master.selectOption')}}
                                    </option>
                                    <option value="checkBox" {{ $attribute["display_type"] =='checkBox'  || old('name_$lang') =='checkBox' ? 'selected' : ''}}>
                                        {{__('master.checkBox')}}
                                    </option>
                                </select>
                                @error('display_type')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            
                            <div class="form-group  @error('status') has-error @enderror">
                                <label for="btn_text">{{ __('master.status') }}</label>
                                <div class="switch primary margin-top-3">
                                    <input type="checkbox" name="status" id="status"
                                           value="1"
                                           @if($attribute->status==1)checked @endif>
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
        $('#description_ar').summernote({
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
                placeholder: "{{ __('master.description') }}",
                lang: 'ar-AR',
                height: 350,
                tabsize: 2,
                disableDragAndDrop: true,
            });
        $('#description_fr').summernote({
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
                placeholder: "{{ __('master.description') }}",
                height: 350,
                tabsize: 2,
                disableDragAndDrop: true,
            });
            $('#description_en').summernote({
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
                placeholder: "{{ __('master.description') }}",
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
