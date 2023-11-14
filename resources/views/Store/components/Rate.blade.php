@push('head')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css"
          integrity="sha512-FSTTKRd8SsGZotWnqwZ9VPZbYy8WJ1bzETf32UY3ZsyU/UUG37RGy6vXTUa8X0kYAG3k9+FC/Gx0Y47MQuGe/g=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-uni/theme.min.css"
          integrity="sha512-tDjct9+QQwJMTiEPip7Zehb94GkGLG+ekDZgjFcd/CTea1c7iPpSBzITSN02mtt38WSv1POlAAUfb/1SUr13jQ=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/editor/summernote-lite.css') }}">
    <style>
    .nav-tabs .nav-link.show,.nav-tabs .nav-link.active {
        color: #495057;
        background-color: #e8e2d0 !important;
        border-color: #e8e2d0 !important;
    }
    @media screen and (min-device-width: 81px) and (max-device-width: 768px) { 
    /* STYLES HERE */
     .res img{
            max-width: -webkit-fill-available !important;
            max-width: fill-available !important;
            width: 300px !important;
        }
}
       
    </style>
@endpush
<div class="col-lg-12">
    <ul class="nav nav-tabs nav-fill" style="flex-wrap: nowrap">
        <li class="nav-item">
            <a class="nav-link btn active" id="Users_Review-tab" data-toggle="pill"
               href="#Users_Review" role="tab" aria-controls="Users_Review"
               aria-selected="true">
                <span >{{__('master.Users Reviews')}}</span>
            </a>
        </li>
        <li class="nav-item" style="flex-wrap: nowrap">
            <a class="nav-link btn" id="Leave_Review-tab" data-toggle="pill"
               href="#Leave_Review" role="tab" aria-controls="Leave_Review"
               aria-selected="true">
                <span >{{__('master.Write Review')}}</span>
            </a>
        </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="Users_Review" role="tabpanel"
             aria-labelledby="Users_Review-tab">
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="rating-block">
                        <h4>{{__('master.Average users rating')}}</h4>
                        <h2 class="bold padding-bottom-7">{{$rate_avg}} <small>/ 5</small></h2>
                        <div dir="ltr">
                            <input class="kv-ltr-theme-uni-star rating-loading star_disabled" value="{{$rate_avg}}" data-size="md">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <hr/>
                    <div class="review-block">
                        @forelse($rates as $index=>$rate)
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="https://icon-library.com/images/no-user-image-icon/no-user-image-icon-14.jpg" class="img-rounded">
                                    <div class="review-block-name">{{$rate->full_name}}</div>
                                    <div class="review-block-date">{{\Illuminate\Support\Carbon::parse($rate->created_at)->diffForHumans()}}</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="review-block-rate">
                                        <div dir="ltr">
                                            <input class="kv-ltr-theme-uni-star rating-loading star_disabled" value="{{$rate->rate}}" data-size="sm">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <br>
                                    <div dd class="review-block-description res">
                                        {!! $rate->content !!}
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            @empty
                                <div class="col-sm-12">
                                    <div class="text-center alert alert-secondary" style="background-color:#e8e2d0 !important;">
                                        {{__('master.no_data')}}
                                    </div>
                                </div>
                            @endforelse
                    </div>
                    {{$rates->render()}}
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Leave_Review" role="tabpanel"
             aria-labelledby="Leave_Review-tab">
            <br>
            <form id="submit_review" method="post" action="{{url('/submit_review/'.$product->id)}}" style="text-align: right;">
                @csrf
                @method('post')
                <div class="form-group">
                    <label>{{__('master.What is your Rate')}}</label>
                    <div dir="ltr">
                        <input class="kv-ltr-theme-uni-star rating-loading submit_review" name="rate" value="5" data-size="md">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{__('master.full_name')}}</label>
                        <input type="text" class="form-control" name="full_name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{__('master.phone')}} @if( app()->getLocale() == 'ar' )  ( غير إجباري )  @else ( Not required )  @endif</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <!--<div class="form-group col-md-12">-->
                    <!--    <label>{{__('master.email')}}</label>-->
                    <!--    <input type="email" class="form-control" name="email">-->
                    <!--</div>-->
                    <div class="form-group col-md-12">
                        <label>{{__('master.description')}}</label>
                        <textarea id="content" class="form-control" name="content"></textarea>
                    </div>
                    <button class="background_buy_now_button btn btn-success btn-secondary" type="submit">@if( app()->getLocale() == 'ar' )  إرسال  @else Submit  @endif</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"
            integrity="sha512-4kpSNboTxdWYwnZCaqnuwO3gGFaZTAhBT6ygWNdpeNrpGnw/rjweaxQ2C9OgwERR5RBWlIQ+Yh9lLce5+jNpVA=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-uni/theme.min.js"
            integrity="sha512-gKhUOikEITx8bym+96IpTS8Fgy3a2g0FVeAb/OrmI09da7lYqZSwNciZCmWi5FzQWGkRHM2JcmQUG50XGKt0EA=="
            crossorigin="anonymous"></script>
    <script>
        $("#submit_review").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data)
                {
                    if (data.success) {
                        Swal.fire({
                            title: data.response,
                            icon: 'success',
                            // toast:false,
                            // position: 'top-end',
                            timerProgressBar:true,
                            timer:5000,
                            showConfirmButton: false
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
                disabled:true,
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
@endpush
