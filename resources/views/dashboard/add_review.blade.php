@extends('dashboard.master')
@section('Reviews_index')
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
                    <strong>jkhkk{{ __('master.'.session('message')) }}</strong>
                </div>
            </div>
        </div>
    @endif
    <div class="col-xs-12">
        <div class="col-md-12 col-xs-12">
            <form method="post" action="{{ $route }}" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 box-content">
                        <div class="form-group col-md-12">
                            <label>{{__('master.rate')}}</label>
                            <div dir="ltr">
                                <input class="kv-ltr-theme-uni-star rating-loading submit_review" name="rate"
                                       value="{{ $review->rate ?? old('rate')}}" data-size="lg" required>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group  @error('product_id') has-error @enderror col-md-6">
                            <label>{{__('master.product_name')}}</label>
                            <select name="product_id" class="form-control" required>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}" {{(($review->product_id ?? 0) == $product->id) ? 'selected' : ''}}>{{$product['name_'.app()->getLocale()]}}</option>
                                @endforeach
                            </select>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('status') has-error @enderror col-md-6">
                            <label>{{__('master.status')}}</label>
                            <select name="status" class="form-control" required>
                                <option
                                    value="1" {{( ($review->status ?? 2) == 1) ? 'selected' : ''}}>{{__('master.Active')}}</option>
                                <option
                                    value="0" {{(($review->status ?? 2) == 0) ? 'selected' : ''}}>{{__('master.Inactive')}}</option>
                            </select>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('full_name') has-error @enderror col-md-6 ">
                            <label>{{__('master.full_name')}}</label>
                            <input type="text" class="form-control" value="{{ $review->full_name ?? old('full_name')}}"
                                   name="full_name" required>
                            @error('full_name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('phone') has-error @enderror col-md-6">
                            <label>{{__('master.phone')}}</label>
                            <input type="text" class="form-control" value="{{ $review->phone ?? old('phone')}}"
                                   name="phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group  @error('email') has-error @enderror col-md-12">
                            <label>{{__('master.email')}}</label>
                            <input type="email" class="form-control" value="{{ $review->email ?? old('email')}}"
                                   name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('content') has-error @enderror col-md-12">
                            <label>{{__('master.description')}}</label>
                            <textarea required id="content" class="form-control"
                                      name="content">{{ $review->content ?? old('content')}}</textarea>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-xs-12 margin-top-30 text-center">
                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light btn-block">
                                @if($title_page !== 'product_edit')
                                    {{ __('master.add_new') }}
                                @else
                                    {{ __('master.update_item') }}
                                @endif
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
    <script>
        $("#submit_review").submit(function (e) {
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
    title: 'Posted successfully',
    animation: false,
    position: 'bottom',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
                    }
                    $("#submit_review")[0].reset();
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
        });
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
