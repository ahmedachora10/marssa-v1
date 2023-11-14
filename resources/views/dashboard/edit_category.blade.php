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
            <form id="edit_category" method="post" action="{{ $route }}" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 box-content">
                        <div class="clearfix"></div>
                        <div class="form-group  @error('name_ar') has-error @enderror col-md-6">
                            <label>{{__('master.name_ar')}}</label>
                            <input type="text" class="form-control" value="{{ $category->name_ar}}"
                                   name="name_ar">
                            @error('name_ar')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group  @error('name_en') has-error @enderror col-md-6">
                            <label>{{__('master.name_en')}}</label>
                            <input type="text" class="form-control" value="{{ $category->name_en}}"
                                   name="name_en">
                            @error('name_en')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('name_fr') has-error @enderror col-md-6">
                            <label>{{__('master.name_fr')}}</label>
                            <input type="text" class="form-control" value="{{ $category->name_fr}}"
                                   name="name_fr">
                            @error('name_fr')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('status') has-error @enderror">
                                <div class="switch primary margin-top-30 ">
                                    <input type="checkbox" name="status" id="status"
                                           value="1"
                                          @if($category->status == 1)
                                          checked
                                          @endif
                                    >
                                    <label for="status">{{ __('master.category_status') }}
                                        <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                              title="{{ __('master.required_data') }}">*</span>
                                    </label>
                                </div>
                                @error('status')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        
                        <div class="col-xs-12 margin-top-30 text-center">
                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light btn-block">
                                {{ __('master.update_item') }}
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
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
    <script>/*
        $("#edit_category").submit(function (e) {
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
                        position: 'top-left',
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
                    $('#name_ar').summernote('reset');
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
            $('#name_ar').summernote({
                toolbar: [
                    ['insert', ['picture']],
                ],
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
                height: 'auto',
                tabsize: 2
            });
        });*/
    </script>
@endsection

