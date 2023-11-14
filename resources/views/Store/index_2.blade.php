{{--{{dd(app()->getLocale())}}--}}
{{--{{dd(app()->getLocale(),\Session::get('locale'))}}--}}
@extends('Store.master_2')
@section('head')
    <style>
        .background_buy_now_button {
            animation-name: bayButton;
            animation-duration: 1s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes bayButton {
            0% {
                transform: translateX(0%);
            }
            40% {
                transform: translateX(-3%);
            }
            80% {
                transform: translateX(3%);
            }
            100% {
                transform: translateX(0%);
            }
        }

        .discount {
            position: absolute;
            display: inline-block;
            background: burlywood;
            z-index: 1;
            color: #eee;
            padding: 11px;
            right: -11px;
        }

        .discount:before {
            content: '';
            position: absolute;
            height: 0;
            width: 0;
            top: 100%;
            right: 0;
            border-top: 10px solid #000000;
            border-right: 10px solid transparent;
        }
        .discount{
            font-size:1rem !important;
            color:#9A33C7 !important;
        }
    </style>
@endsection
@section('content')

    <style>

        @media only screen and (max-width: 600px) {
            .bane_im {

                width: 300px !important;
            }

        }
    </style>

    <!--@if(!empty($information->head_text))-->

    <!--    <section style="padding-top: 0px !important;padding-bottom: 0px !important;" class="bar__info container-fluid py-4 d-flex flex-column align-items-center justify-content-center">-->
    <!--        <h2 class="mb-0" style="color:black;"> {{ $information->head_text }} </h2>-->
    <!--    </section>-->
    <!--@endif-->
    @if(!$ads)


    @endif



    @if(!empty($information->banner_head))
        <div class="col-lg-12 bg-white shadow-sm">
            <div class="col-lg-3 col-md-6 col-sm-12 my-3 ">
                <img data-src="{{ asset($information->banner_head) }}" class="img-responsive img-fluid lazy"/>
            </div>
        </div>
    @endif


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    @if(!empty($slider))
        <div class="container-fluid mb-3 full-width-banner" style="max-height: 400px;
    overflow: hidden; ">
            <div class="your-class col-lg-12 bg-white shadow-sm">
                @foreach($slider as $slide)
                    <div>
                        <a style="width: inherit;" href="{{ $slide->link}}"><img style="    width: inherit;"
                                                                                 src="{{url('/')}}/{{$slide->image}}"
                                                                                 class="img-responsive"
                                                                                 loading="lazy"></a></div>
                @endforeach
            </div>
        </div>
    @endif
    @if(isset($bestseller) && count($bestseller) > 0)
        <br/>
        <div class="container-fluid max960">
            <div class="row">
                <div class="col-12">
                    <div style="padding: 0pt 12pt 0;">
                        <h2 style="font-size: 28px;color: #4caf50;" class="mt-4 title-section">
                            {{ __('store.best_seller') }}
                        </h2>
                    </div>
                    <div class="container-fluid product-panel">
                        <div class="row mt-4">
                            <div class="col-12">
                            </div>
                            @forelse($bestseller as $index=>$product)
                                <?php
                                $getimg = array();

                                if (isset($product->image)) {
                                    foreach ($product->image as $img) {
                                        $last = last(explode('.', $img));

                                        if (in_array($last, ["jpg", "png", "gif", "jpeg", 'webp'])) {
                                            $getimg[] = $img;
                                        }
                                    }
                                }
                                ?>
                                <div class="col-xs-2 col-6 col-sm-6 col-md-4 col-lg-4   container-prod part{{$index}}">
                                    <div class="panel">

                                        <div class="product-card">
                                           {{--  <span class="discount" >
                                                {{ $product->price }}
                                            $product->getCurrency() 
                                            </span>--}}
                                            <banner class="col-md-6">
                                                <a href="{{ $product->route_details() }}"style="width: 100%;">
                                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                                         class="product-img lazy"
                                                         src="@if(!empty($product->featured_image) )
                                                         {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif"/>

                                                    <div class="overlay"></div>
                                                </a>
                                            </banner>
                                            <content class="col-md-6">
                                                <a href="{{ $product->route_details() }}" class="alink-container-prod">
                                                    <name>{{ $product['name_'.app()->getLocale()] }}</name>
                                                </a>
                                                <hr/>
                                                <div class="flex-row w100 flex-center align-center mt-2 mb-1 pl-1 pr-1">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                    <div class="dummy" style="width: 56pt;">

                                                        <del style='text-decoration:line-through;color:#9A33C7 !important;'>{{ $product->price_before }} </del>
                                                    </div>
                                                    @endif
                                                    @endif
                                                    <div class="price" style="color:#9A33C7 !important;">
                                                        @if($product->get_current_offer() ?? false)
                                                            {{ round($product->get_current_offer()->discount) }} {{-- $product->getCurrency() --}}
                                                            <small>
                                                                <del class="text-secondary" style="color:#9A33C7 !important;">
                                                                    {{ $product->price }}
                                                                </del>
                                                            </small>
                                                        @else
                                                            {{ $product->price }} {{-- $product->getCurrency() --}}
                                                        @endif
                                                    </div>
                                                    <div style="width: 56pt; text-align: right;" hidden>

                                                    </div>
                                                </div>
                                                <div class="flex-row w100 flex-center align-center mt-2 mb-1 pl-1 pr-1">

                                                    <a href="{{ $product->route_details() }}"
                                                       class="btn btn-block btn-theme px-4 py-2 shadow-sm text-nowrap addToCart addToCartHomePage background_buy_now_button">{{ __('store.buy_now') }} </a>
                                                    <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"
                                                          class="btn btn-primary mr-2 rounded background_add_to_cart_button addtoCartButtonBackGround">{{__('master.add_to_cart')}}</span>

                                                </div>
                                            </content>

                                        </div>

                                    </div>
                                </div>
                            @empty
                                <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                            @endforelse


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(isset($recent_pro))
        <br/>
        <div class="container-fluid max960">
            <div class="row">
                <div class="col-12">
                    <div style="padding: 0pt 12pt 0;">
                        <h2 style="font-size: 28px;color: #4caf50;" class="mt-4 title-section">
                            {{ __('store.recent_products') }}
                        </h2>
                    </div>
                    <div class="container-fluid product-panel">
                        <div class="row mt-4">
                            <div class="col-12">
                            </div>
                            @forelse($recent_pro as $index=>$product)
                                <?php
                                $getimg = array();

                                if (isset($product->image)) {
                                    foreach ($product->image as $img) {
                                        $last = last(explode('.', $img));

                                        if (in_array($last, ["jpg", "png", "gif", "jpeg", 'webp'])) {
                                            $getimg[] = $img;
                                        }
                                    }
                                }
                                ?>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4 container-prod part{{$index}}">
                                    <div class="panel">

                                        <div class="product-card">
                                            {{-- <span class="discount">
                                                {{ $product->price }}
                                             $product->getCurrency() 
                                            </span>--}}
                                            <banner class="col-md-6">
                                                <a href="{{ $product->route_details() }}"style="width: 100%;">
                                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                                         class="product-img lazy"
                                                         src="@if(!empty($product->featured_image) )
                                                         {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif"/>

                                                    <div class="overlay"></div>
                                                </a>
                                            </banner>
                                            <content class="col-md-6">
                                                <a href="{{ $product->route_details() }}" class="alink-container-prod">
                                                    <name>{{ $product['name_'.app()->getLocale()] }}</name>
                                                </a>
                                                <hr/>
                                                <div class="flex-row w100 flex-center align-center mt-2 mb-1 pl-1 pr-1">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                    <div class="dummy" style="width: 56pt;">

                                                        <del style='color:red;text-decoration:line-through'>{{ $product->price_before }} </del>
                                                    </div>
                                                    @endif
                                                    @endif
                                                    <div class="price">
                                                        @if($product->get_current_offer() ?? false)
                                                            {{ round($product->get_current_offer()->discount) }} {{-- $product->getCurrency() --}}
                                                            <small>
                                                                <del class="text-secondary">
                                                                    {{ $product->price }}
                                                                </del>
                                                            </small>
                                                        @else
                                                            {{ $product->price }} {{-- $product->getCurrency() --}}
                                                        @endif
                                                    </div>
                                                    <div style="width: 56pt; text-align: right;" hidden>

                                                    </div>
                                                </div>
                                                <div class="flex-row w100 flex-center align-center mt-2 mb-1 pl-1 pr-1">

                                                    <a href="{{ $product->route_details() }}"
                                                       class="btn btn-block btn-theme px-4 py-2 shadow-sm text-nowrap addToCart addToCartHomePage background_buy_now_button">{{ __('store.buy_now') }} </a>
                                                    <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"
                                                          class="btn btn-primary mr-2 rounded background_add_to_cart_button addtoCartButtonBackGround">{{__('master.add_to_cart')}}</span>

                                                </div>
                                            </content>

                                        </div>

                                    </div>
                                </div>
                            @empty
                                <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                            @endforelse


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if(isset($products))
        <br/>
        <div class="container-fluid max960">
            <div class="row">
                <div class="col-12">
                    <div style="padding: 0pt 12pt 0;">

                    </div>
                    <div class="container-fluid product-panel">
                        <div class="row mt-4">
                            <div class="col-12">
                            </div>
                            @forelse($products as $index => $product)
                                <?php
                                $getimg = array();

                                if (isset($product->image)) {
                                    foreach ($product->image as $img) {
                                        $last = last(explode('.', $img));

                                        if (in_array($last, ["jpg", "png", "gif", "jpeg", 'webp'])) {
                                            $getimg[] = $img;
                                        }
                                    }
                                }
                                ?>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4 container-prod part{{$index}}">
                                    <div class="panel">

                                        <div class="product-card">
                                            {{-- <span class="discount">
                                                {{ $product->price }}
                                             $product->getCurrency() 
                                            </span>--}}
                                            <banner class="col-md-6">
                                                <a href="{{ $product->route_details() }}"style="width: 100%;">
                                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                                         class="product-img lazy"
                                                         src="@if(!empty($product->featured_image) ) {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                         @endif"/>

                                                    <div class="overlay"></div>
                                                </a>
                                            </banner>
                                            <content class="col-md-6">
                                                <a href="{{ $product->route_details() }}" class="alink-container-prod">
                                                    <name>{{ $product['name_'.app()->getLocale()] }}</name>
                                                </a>
                                                <hr/>
                                                <div class="flex-row w100 flex-center align-center mt-2 mb-1 pl-1 pr-1">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                    <div class="dummy" style="width: 56pt;">
                                                        <del style='color:#9A33C7 !important;text-decoration:line-through'>{{ $product->price_before }} </del>
                                                    </div>
                                                    @endif
                                                    @endif
                                                    <div class="price" style="color:#9A33C7 !important;">
                                                        @if($product->get_current_offer() ?? false)
                                                            {{ round($product->get_current_offer()->discount) }} {{-- $product->getCurrency() --}}
                                                            <small>
                                                                <del class="text-secondary">
                                                                    {{ $product->price }}
                                                                </del>
                                                            </small>
                                                        @else
                                                            {{ $product->price }} {{-- $product->getCurrency() --}}
                                                        @endif
                                                    </div>
                                                    <div style="width: 56pt; text-align: right;" hidden>

                                                    </div>
                                                </div>

                                                <div class="flex-row w100 flex-center align-center mt-2 mb-1 pl-1 pr-1">
                                                    <a style="cursor: pointer;border: solid 2px red;background: #e6e6e88f;"
                                                       href="{{ $product->route_details() }}"
                                                       class="btn btn-block btn-theme px-4 background_buy_now_button py-2 shadow-sm text-nowrap addToCart addToCartHomePage">{{ __('store.buy_now') }} </a>
                                                    <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"
                                                          class="btn btn-primary mr-2 rounded background_add_to_cart_button addtoCartButtonBackGround">{{__('master.add_to_cart')}}</span>

                                                </div>
                                            </content>

                                        </div>

                                    </div>
                                </div>
                            @empty
                                <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                        @endforelse

                        <!--<div class="text-center">-->
                        <!--    <a  href="{{ url('') }}/category/all">-->
                        <!--                      @if(app()->getLocale() == 'ar')-->
                            <!--                        جميع المنتجات-->
                            <!--                      @else-->
                            <!--                        All Products-->
                            <!--                      @endif-->
                            <!--                    </a>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif



    @if(isset($recent_pro))
        <br/>
        <div class="container-fluid max960">
            <div class="row">
                <div class="col-12">
                    <div style="padding: 0pt 12pt 0;">
                        <h2 style="font-size: 28px;color: #4caf50;" class="mt-4 title-section ">
                            <span>  @if(app()->getLocale() == 'ar') جميع المنتجات  @else   All Products @endif  </span>
                        </h2>
                    </div>
                    <div class="container-fluid product-panel">
                        <div class="row mt-4">
                            <div class="col-12">
                            </div>
                            @forelse($recent_pro->take(3) as $index => $product)
                                <?php
                                $getimg = array();

                                if (isset($product->image)) {
                                    foreach ($product->image as $img) {
                                        $last = last(explode('.', $img));

                                        if (in_array($last, ["jpg", "png", "gif", "jpeg", 'webp'])) {
                                            $getimg[] = $img;
                                        }
                                    }
                                }
                                ?>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4 container-prod part{{$index}}">
                                    <div class="panel">

                                        <div class="product-card">
                                             {{-- <span class="discount">
                                                {{ $product->price }}
                                            $product->getCurrency() 
                                            </span>--}}
                                            <banner class="col-md-6">
                                                <a href="{{ $product->route_details() }}" style="width: 100%;">
                                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                                         class="product-img lazy"
                                                         src="@if(!empty($product->featured_image) ) {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif"/>

                                                    <div class="overlay"></div>
                                                </a>
                                            </banner>
                                            <content class="col-md-6">
                                                <a href="{{ $product->route_details() }}" class="alink-container-prod">
                                                    <name>{{ $product['name_'.app()->getLocale()] }}</name>
                                                </a>
                                                <hr/>
                                                <div class="flex-row w100 flex-center align-center mt-2 mb-1 pl-1 pr-1">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                    <div class="dummy" style="width: 56pt;">

                                                        <del style='color:#9A33C7 !important;text-decoration:line-through'>{{ $product->price_before }} </del>
                                                    </div>
                                                    @endif
                                                    @endif
                                                    <div class="price" style="color:#9A33C7 !important;">
                                                        @if($product->get_current_offer() ?? false)
                                                            {{ round($product->get_current_offer()->discount) }} {{-- $product->getCurrency() --}}
                                                            <small>
                                                                <del class="text-secondary">
                                                                    {{ $product->price }}
                                                                </del>
                                                            </small>
                                                        @else
                                                            {{ $product->price }} {{-- $product->getCurrency() --}}
                                                        @endif
                                                    </div>
                                                    <div style="width: 56pt; text-align: right;" hidden>

                                                    </div>
                                                </div>
                                                <div class="flex-row w100 flex-center align-center mt-2 mb-1 pl-1 pr-1">

                                                    <a style="cursor: pointer;border: solid 2px red;background: #e6e6e88f;"
                                                       href="{{ $product->route_details() }}"
                                                       class="btn btn-block btn-theme px-4 background_buy_now_button py-2 shadow-sm text-nowrap addToCart addToCartHomePage">{{ __('store.buy_now') }} </a>
                                                    <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"
                                                          class="btn btn-primary mr-2 rounded background_add_to_cart_button addtoCartButtonBackGround">{{__('master.add_to_cart')}}</span>

                                                </div>
                                            </content>

                                        </div>

                                    </div>
                                </div>
                            @empty
                                <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                            @endforelse
                            <div style="width: 100%;text-align:center;">
                                @if(count($recent_pro) >= 1)
                                    @if(app()->getLocale() == 'ar' )
                                        <a class="btn btn-link" style="text-decoration:none;"
                                           href="{{ url('') }}/category/all"> <i class="fa fa-eye"></i> رؤية المزيد ؟
                                        </a>
                                    @else
                                        <a class="btn btn-link" style="text-decoration:none;"
                                           href="{{ url('') }}/category/all"> <i class="fa fa-eye"></i> See More
                                            Products </a>
                                    @endif
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div style="display: block; height: 20pt;"></div>


    <!-- about store -->
    <section class="container-fluid bg-white py-5">
        <div class="container mb-3">
            <div class="row d-flex justify-content-center align-items-center flex-column pb-4">
                <h4 class="text-secondary"> {{ __('store.why_us') }} </h4>
                <p class="text-muted"> {{ __('store.store_desc') }} </p>
            </div>
            <div class="row">
                <div class="col-lg-4 p-3">
                    <div class="d-flex flex-column justify-content-center align-items-center ">
                        <div
                                class="badge_info shadow-lg p-3 rounded-pill mb-3 d-flex flex-column align-items-center justify-content-center">
                            <i class="fa fa-truck text-white fa-fw fa-lg"></i>
                        </div>
                        <h4 class="text-secondary"> {{ __('store.ship') }} </h4>
                        <p class="text-muted"> {{ __('store.ship_desc') }} </p>
                    </div>
                </div>
                <div class="col-lg-4 p-3">
                    <div class="d-flex flex-column justify-content-center align-items-center ">
                        <div
                                class="badge_info shadow-lg p-3 rounded-pill mb-3 d-flex flex-column align-items-center justify-content-center">
                            <i class="fa fa-handshake text-white fa-fw fa-lg"></i>
                        </div>
                        <h6 class="text-secondary">{{ __('store.customer') }}</h6>
                        <p class="text-muted">{{ __('store.customer_desc') }} </p>
                    </div>
                </div>
                <div class="col-lg-4 p-3">
                    <div class="d-flex flex-column justify-content-center align-items-center ">
                        <div
                                class="badge_info shadow-lg p-3 rounded-pill mb-3 d-flex flex-column align-items-center justify-content-center">
                            <i class="fa fa-volume-control-phone  fa-phone-volume fa-fw fa-lg"></i>
                        </div>
                        <h6 class="text-secondary">{{ __('store.contect') }}</h6>
                        <p class="text-muted"> {{ __('store.contect_desc') }} </p>
                    </div>
                </div>
            </div>
        </div>
    </section>    <!-- other items -->

@endsection

{{--Developed Saed Z. Sinwar--}}
@section('script')
    <script src="{{ asset('store/theme_4/js/jquery.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
            crossorigin="anonymous"></script>


    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>

    <script type="text/javascript" src="https://kenwheeler.github.io/slick/slick/slick.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.your-class').slick({

                autoplay: true,
                slidesToShow: 1,
                arrows: false,
                pauseOnHover: true,
                dots: false,
                @if (app()->getLocale() =='ar')
                rtl: true,
                @endif
            });
        });
    </script>

    <script>

        /*   $('.addToCart').click(function() {

               if ( $(this).attr('data-target') == 1 ) {
                   var data  = $('#addToCartForm').serialize();
                   data = data + '&ajax=1';
               }
               else{
                   var id  =  $(this).attr('data-id');
                   var data  =  'id='+id+'&quantity=1&ajax=1';
               }
               var clicked = $(this);
               title = clicked.attr('data-title');
               toastTrigger(title," لقد تمت اضافة المنتج بنجاح");
               $.ajax({
                   method: 'POST',
                   url: Routing.generate('cart-add'),
                   data: data
               }).done(function(data){
                   array = JSON.parse(data);
                   //$(".cart__notif").text(array.length);
                   var currentUrl = window.location.hostname;

                   window.location.href = currentUrl + '/checkout';
               });
           });*/

        function toastTrigger(title, text) {
            if (!$("#snackbar").length) {
                var textHtml = '<div id="snackbar" ></div>';
                $("body").prepend(textHtml);
            }
            $('#snackbar').empty();
            var textView = '<i class="fa fa-cart-plus pr-2"></i>' + title + text;
            $('#snackbar').prepend(textView);
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    </script>



@endsection
{{--Developed Saed Z. Sinwar--}}
