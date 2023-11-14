@extends('dashboard.master')
@section('add_category')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css"
          integrity="sha512-FSTTKRd8SsGZotWnqwZ9VPZbYy8WJ1bzETf32UY3ZsyU/UUG37RGy6vXTUa8X0kYAG3k9+FC/Gx0Y47MQuGe/g=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-uni/theme.min.css"
          integrity="sha512-tDjct9+QQwJMTiEPip7Zehb94GkGLG+ekDZgjFcd/CTea1c7iPpSBzITSN02mtt38WSv1POlAAUfb/1SUr13jQ=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/editor/summernote-lite.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"
     integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
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
    
    div#price_before {
    display: none;
}


        .dropify-wrapper {
            height: 150px;
        }

        .tag-editor {
            line-height: 24px;
            padding: 7px 14px;
            min-height: 45px;
            border-color: #ccd1d9;
            box-shadow: none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            border-radius: 2px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
        }

        .disable {
            display: none;
        }

        #files-area {
            width: 30%;
            margin: 0 auto;
        }

        .file-block {
            border-radius: 10px;
            background-color: rgba(144, 163, 203, 0.2);
            margin: 5px;
            color: initial;
            display: inline-flex;

        &
        > span.name {
            padding-right: 10px;
            width: max-content;
            display: inline-flex;
        }

        }
        .file-delete {
            display: flex;
            width: 24px;
            color: initial;
            background-color: #6eb4ff00;
            font-size: large;
            justify-content: center;
            margin-right: 3px;
            cursor: pointer;

        &
        :hover {
            background-color: rgba(144, 163, 203, 0.2);
            border-radius: 10px;
        }

        &
        > span {
            transform: rotate(45deg);
        }

        }
        .loader {
            position: absolute;
            background: #fff;
            height: 100%;
            width: 100%;
            top: 0;
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
            align-content: center;
        }

        .spinner-border {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: text-bottom;
            border: .25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: spinner-border .75s linear infinite;
            animation: spinner-border .75s linear infinite;
        }

        @keyframes spinner-border {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
        
        /* *********** */
        .table tr td img{
            width: 80px;
            height: 80px;
            border-radius: 34px;
            padding: 0px;
            border: 6px solid #eee;
        }
        
        .first-typical{
            display:none !important;
        }
        .first-typical-link{
            display:none !important;
        }
        
    </style>
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
        <div class="row">
            <form method="post" action="{{route('dashboard.merchant.competitions.update',$competition->id)}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                <div class="col-md-8 col-xs-12">
                    <div class="row">
                            <div class="col-xs-12 box-content">
                                <div class="clearfix"></div>
                                <div class="form-group col-md-6">
                                    <label>Comp. Name</label>
                                    <input type="text" class="form-control" value="{{ $competition->name }}" name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Condition Type</label>
                                    <select class="form-select form-control condition_type" name="condition_type">
                                      <option value="buy_products" {{ $competition->condition_type == 'buy_products' ? 'selected' : '' }} >{{ __('master.buy_products') }}</option>
                                      <option value="visit_link"   {{ $competition->condition_type == 'visit_link'   ? 'selected' : '' }} >{{ __('master.visits_links') }}</option>
                                    </select>
                                    @error('condition')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- ------------------------------------------------------------------------- -->
                                <!-- ------------------------------------------------------------------------- -->
                                <!-- ------------------------------------------------------------------------- -->
                                <!-- ------------------------------------------------------------------------- -->
                                <!-- ------------------------------------------------------------------------- -->
                                <div class="form-group col-md-12" id="buy_products" @if(($competition->condition_type != 'buy_products') || !$competition->condition_type) style="display:none" @endif>
                                    @php $thumbnail_url = "https://media.istockphoto.com/id/1222357475/vector/image-preview-icon-picture-placeholder-for-website-or-ui-ux-design-vector-illustration.jpg?s=170667a&w=0&k=20&c=IyNlM1yfvw2UAitPPF7hIBBsr4IZjZJUDS1C5YgmiwA=" @endphp
                                    <table class="table table-striped show-products">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    Products
                                                </th>
                                                <th>
                                                    <button type="button" class="btn btn-success btn-sm generate_products_list">
                                                        add new Product
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="first-typical">
                                                <td>
                                                    <img src="{{ asset($competition->product ? ($competition->product->image ? $product->image[0] : $thumbnail_url) : $thumbnail_url) }}">
                                                </td>
                                                <td>
                                                    <select name="products[]"  class="form-control select_product">
                                                        <option value="">select product</option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}" data-src="{{ $product->image ? env('APP_URL').'/'.$product->image[0] : '' }}">{{ $product->name_ar }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                
                                                <td>
                                                    <i class='fas fa-trash remove_item'></i>
                                                </td>
                                            </tr>
                                            @foreach($competition->competition_products as $product_comp)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset($product_comp ? ($product_comp->product->image ? $product_comp->product->image[0] : $thumbnail_url) : $thumbnail_url) }}">
                                                    </td>
                                                    <td>
                                                        <select name="products[]"  class="form-control">
                                                            @foreach($products as $product)
                                                                <option value="{{ $product->id }}" data-src="{{ $product->image ? $product->image[0] : '' }}" @if($product->id == $product_comp->product_id) selected @endif>{{ $product->name_ar }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    
                                                    <td>
                                                        <i class='fas fa-trash remove_item'></i>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- ------------------------------------------------------------------------- -->
                                <!-- ------------------------------------------------------------------------- -->
                                <!-- ------------------------------------------------------------------------- -->
                                <!-- ------------------------------------------------------------------------- -->
                                <!-- ------------------------------------------------------------------------- -->
                                <!-- ------------------------------------------------------------------------- -->
                                <div class="form-group col-md-12" id="visit_link" @if($competition->condition_type != 'visit_link') style="display:none" @endif>
                                    <table class="table table-striped show-links">
                                        <thead>
                                            <tr class="">
                                                <th colspan="2">
                                                    روابط الزيارات
                                                </th>
                                                <th colspan="1">
                                                    عدد الزيارات
                                                </th>
                                                <th>
                                                    <button type="button" class="btn btn-success btn-sm generate_links_list">
                                                        add new Link
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="first-typical-link">
                                                <td colspan="2">
                                                    <input type="url" name="links[0][link]" value="" class="form-control link" />
                                                </td>
                                                <td>
                                                    <input type="number" name="links[0][count_required]" value="10"  min="1" class="form-control count_required" />
                                                </td>
                                                <td>
                                                    <i class='fas fa-trash remove_item'></i>
                                                </td>
                                            </tr>
                                            @foreach($competition->competition_links as $key => $link_comp)
                                                <tr>
                                                    <td colspan="2">
                                                        <input type="url" name="links[{{ $key }}][link]" value="{{ $link_comp->link }}" class="form-control" />
                                                    </td>
                                                    <td>
                                                        <input type="number" name="links[{{ $key }}][count_required]" value="{{ $link_comp->count_required ?: 10 }}"  min="1" class="form-control" />
                                                    </td>
                                                    <td>
                                                        <i class='fas fa-trash remove_item'></i>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Comp. Prize</label>
                                    <textarea type="text" class="form-control" value="{{old('prize')}}" name="prize">{{ $competition->prize }}</textarea>
                                    @error('prize')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" value="{{ $competition->start_date }}" name="start_date">
                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" value="{{ $competition->end_date }}" name="end_date">
                                    @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                
                                <div class="form-group col-md-12">
                                    <label>Comp. Description</label>
                                    <textarea id="content" name="description" class="form-control">{{ $competition->description }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="col-xs-12 box-content">
                    
                        <div class="form-group @error('image') has-error @enderror">
                            <label class="box-title">
                                <span>{{ __('master.competition_image')}}</span>
                                <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                      title="{{ __('master.required_data') }}">*</span>
                                <span class="hint"> 700x800</span>
                            </label>
                            <div class="card-content">
                                @include("dashboard.components.fileUploadDzone")
                            </div>
                            @error('image')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        @if(isset($competition) && $competition->thumbnails)
                            <input type="hidden" name="thumbnails[]" value="{{ $competition->thumbnails ? $competition->thumbnails[0] :null}}">
                        @endif
                    
                    <div class="form-group">
                        <label> {{ __('master.video_url') }}</label>
                        <input type="text" class="form-control" value="{{ $competition->video_url }}" name="video_url">
                        @error('video_url')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="col-xs-12 margin-top-30 text-center">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light btn-block">
                                Submit
                        </button>
                    </div>
                                
                </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" 
    integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"
            integrity="sha512-4kpSNboTxdWYwnZCaqnuwO3gGFaZTAhBT6ygWNdpeNrpGnw/rjweaxQ2C9OgwERR5RBWlIQ+Yh9lLce5+jNpVA=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-uni/theme.min.js"
            integrity="sha512-gKhUOikEITx8bym+96IpTS8Fgy3a2g0FVeAb/OrmI09da7lYqZSwNciZCmWi5FzQWGkRHM2JcmQUG50XGKt0EA=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/locales/ar.js"
            integrity="sha512-j9dWyLBFRier7ykZJL8CLGyb1WW6xVkkrV3lHFQxRRTtXHt7UbWnrcOWKHvxWAydyEtjIF1Fs/Xao0AaBLWrmA=="
            crossorigin="anonymous"></script>
    <script src="{{ asset('dashboard/light/assets/editor/summernote-lite.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/lang/summernote-ar-AR.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/title_image.js') }}"></script>
    <script>
    
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
        url: "{{ route('dashboard.merchant.competition_saveMedia') }}", // Set the url
        success: function(file, response) {
            console.log(response);
            $('form').append('<input type="hidden" name="thumbnails[]" value="' + response.name + '">')
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
            
            /* remove image form server */
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ route('dashboard.merchant.remove_competition_media') }}",
                data: {
                    image_path:name
                },
                success: function (data) {
                    console.log(data);
                    $('form').find('input[name="thumbnails[]"][value="' + name + '"]').remove()
                }
            });
            /* remove image from server */
            
            
        },
        // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
        init: function() {
            @if (isset($competition) && $competition->thumbnails)
                var files =
                {!! json_encode($competition->thumbnails) !!}
                for (var i in files) {
                    var path = files[i];
                    console.log(path);
                    var file = new File(["{{ env('APP_URL').'/' }}"+path],path)
                    file['status'] = "queued";
                    file['status'] = "queued";
                    file['previewElement'] = "div.dz-preview.dz-image-preview";
                    file['previewTemplate'] = "div.dz-preview.dz-image-preview";
                    file['_removeLink'] = "a.dz-remove";
                    file['webkitRelativePath'] = "";
                    file['width'] = 500;
                    file['height'] = 800;
                    file['accepted'] = true;
                    file['dataURL'] = path;
                    this.emit("addedfile", file ,path);
                    this.emit("thumbnail", file , "{{ env('APP_URL').'/' }}" + path);
                    this.files.push(file);
                }
            @endif
        }
    }
        $("#add_catelgory").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function (data) {
                    if (data.success) {
                        Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: data.response,
                        animation: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })
                    }
                    form[0].reset();
                    $('#content').summernote('reset');
                }
            });
        });
        $(document).ready(function () {
            $('.star_disabled').rating({
                hoverOnClear: false,
                disabled: true,
                rtl: true,
                theme: 'krajee-uni',
                language: 'ar',
                step: 1,
            });
            $('.submit_review').rating({
                hoverOnClear: false,
                rtl: true,
                theme: 'krajee-uni',
                language: 'ar',
                step: 1,
            });
            $('#content').summernote({
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
        
        
        jQuery(document).ready(function(){
            // jQuery('#visit_link').hide();
            jQuery('.condition_type').change(function(){
                let ClassName = jQuery(this).val(); 
                if(ClassName == 'buy_products'){
                    jQuery('#buy_products').show();
                    jQuery('#visit_link').hide();
                } else {
                    jQuery('#visit_link').show();
                    jQuery('#buy_products').hide();
                }
                
            });
            
            jQuery('.generate_products_list').on('click',function(){
                let tr_copy = jQuery('.first-typical').html(); 
                jQuery('table.show-products tbody').append("<tr>"+tr_copy+"</tr>");
            });
            
            jQuery('.generate_links_list').on('click',function(){
                let count_tr = jQuery('table.show-links tbody tr').length + 1;
                jQuery('.first-typical-link input.link').attr('name',`links[${count_tr}][link]`);
                jQuery('.first-typical-link input.count_required').attr('name',`links[${count_tr}][count_required]`);
                let tr_copy = jQuery('.first-typical-link').html(); 
                jQuery('table.show-links tbody').append("<tr>"+tr_copy+"</tr>");
            });
            
            
            
            jQuery('table.show-products').on('change','.select_product',function(){
                let src_image = jQuery(this).find('option:selected').attr('data-src');
                jQuery(this).parents('tr').find('img').attr('src',src_image);
            });
            
            jQuery('table.show-products').on('click','.remove_item',function(){
                jQuery(this).parents('tr').remove();
            });
            
            jQuery('table.show-links').on('click','.remove_item',function(){
                jQuery(this).parents('tr').remove();
            });
        });
    </script>
@endsection


