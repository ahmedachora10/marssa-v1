@extends('Store.master_1')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
          crossorigin="anonymous"/>
@endsection
@section('content')
    <style>
        .owl-carousel .owl-stage-outer{
            height:250px !important;
        }
        .tab-content.col-xs-12{
            height:300px !important;
        }
        .checkout-form th, .checkout-form td {
            font-family: dinnextltw23, 'sans-serif' !important;
            font-weight: normal;
            color: black;
        }
        .checkout-form .order-confirm-sheet .order-review {
            border: 1px solid #e5e5e5;
            padding: 50px 40px;
        }
        .checkout-form .order-confirm-sheet .order-review .product-review {
            width: 100%;
        }
        .theme-btn {
            background-color: #fff;
            border-radius: 40px;
            bottom: 10px;
            color: #fff;
            display: table;
            height: 70px;
            left: 20px;
            min-width: 70px;
            position: fixed;
            text-align: center;
            z-index: 9999
        }
        .theme-btn i {
            font-size: 30px;
            line-height: 70px
        }
        .theme-btn.bt-support-now {
            background: #1ebbf0;
            background: -moz-linear-gradient(45deg, #1ebbf0 8%, #39dfaa 100%);
            background: -webkit-linear-gradient(45deg, #1ebbf0 8%, #39dfaa 100%);
            background: linear-gradient(45deg, #1ebbf0 8%, #39dfaa 100%);
            bottom: 70px
        }
        .theme-btn.bt-buy-now {
            background: #1fdf61;
            background: -moz-linear-gradient(top, #a3d179 0, #88ba46 100%);
            background: -webkit-linear-gradient(top, #a3d179 0, #88ba46 100%);
            background: linear-gradient(to bottom, #a3d179 0, #88ba46 100%)
        }
        .theme-btn:hover {
            color: #fff;
            padding: 0 20px
        }
        .theme-btn span {
            display: table-cell;
            vertical-align: middle;
            font-size: 16px;
            letter-spacing: -15px;
            opacity: 0;
            line-height: 50px;
            transition: all .5s;
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            text-transform: uppercase
        }
        .theme-btn:hover span {
            opacity: 1;
            letter-spacing: 1px;
            padding-left: 10px
        }
        #big .item {  padding: 0px 0px; margin:2px; color: #FFF; border-radius: 3px; text-align: center; }
        #thumbs .item { height:70px; line-height:70px; padding: 0px; margin:2px; color: #FFF; border-radius: 3px; text-align: center; cursor: pointer; }
        #thumbs .item h1 { font-size: 18px; }
        .owl-theme .owl-nav [class*='owl-'] { -webkit-transition: all .3s ease; transition: all .3s ease; }
        #big.owl-theme { position: relative; }
        #big.owl-theme .owl-next, #big.owl-theme .owl-prev { background:#333; width: 22px; line-height:40px; height: 40px; margin-top: -20px; position: absolute; text-align:center; top: 50%; }
        #big.owl-theme .owl-prev { left: 10px; }
        #big.owl-theme .owl-next { right: 10px; }
        #thumbs.owl-theme .owl-next, #thumbs.owl-theme .owl-prev { background:#333; }
        .minus, .plus{
      width:20px;
      background:#f2f2f2;
      border-radius:4px;
      border:1px solid #ddd;
      display: inline-block;
      vertical-align: middle;
      text-align: center;
      cursor:pointer;
    }
   .quantity_counter {
      height:34px;
      width: 100px;
      text-align: center;
      font-size: 26px;
      border:1px solid #ddd;
      border-radius:4px;
      display: inline-block;
      vertical-align: middle;}
      .owl-carousel .owl-item img{
      height:100%;
      }
    </style>
    @if($offer ?? false)
        <script>
            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;
            let countDown = new Date("{{ Carbon\Carbon::parse($offer->end)->format('F d, Y H:i:s') }}").getTime(),
                x = setInterval(function () {
                    let now = new Date().getTime(),
                        distance = countDown - now;
                    document.getElementById('days').innerText = Math.floor(distance / (day));
                    document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour));
                    document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute));
                    document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
                }, second)
        </script>
        <div class="promo-code-section margin-top-100">
            <p>
                <span>{{ __('store.quickly_buy') }}</span>
                <span>
                    {{ round($product->price - $offer->discount) }}
                    {{ $offer->getCurrency() }}@if(app()->getLocale() == "en") {{ __('store.discount') }}@endif
                </span>
            </p>
            <div class="countdown">
                <ul>
                    <li><span id="days"></span>{{ __('store.days') }}</li>
                    <li><span id="hours"></span>{{ __('store.Hours') }}</li>
                    <li><span id="minutes"></span>{{ __('store.Minutes') }}</li>
                    <li><span id="seconds"></span>{{ __('store.Seconds') }}</li>
                </ul>
            </div>
        </div>
    @endif



    <button onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}},'checkout')" class="theme-btn bg-danger"><i class="fa fa-cart-plus"></i><span> {{__('master.Complete the order')}} </span></button>

    <section class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" >
                    <div class="blog-one__single">
                        <div class="tab-content col-xs-12">
                            <h3 class="blog-one__title">
                                {{ $product['name_'.app()->getLocale()] }}
                            </h3>
                            <ul class="rating">
                                @if(count($product->orders()->get()) > 0)
                                    <li>{{ count($product->orders()->get()) .' '. __('store.sold') }}</li>
                                @endif
                            </ul>
                            <div id="big" class="owl-carousel owl-theme">
                                @foreach($product->image as $img)
                                    <?php
                                    $getlast = last(explode('.', $img));
                                    ?>
                                    @if(in_array($getlast,['jpg','jpeg','svg','png','gif','webp']))
                                        <div class="item"><img src="{{asset($img)}}"></div>
                                    @else
                                        <div class="item-video" data-merge="2">
                                            <video controls style="width: 100%">
                                                <source src="{{asset($img)}}">
                                            </video>
                                        </div>

                                    @endif

                                @endforeach
                            </div>
                            <div id="thumbs" class="owl-carousel owl-theme">
                                @foreach($product->image as $img)
                                    <?php
                                    $getlast = last(explode('.', $img));
                                    ?>
                                    @if(in_array($getlast,['jpg','png','gif','webp']))
                                        <div class="item"><img src="{{asset($img)}}"></div>
                                    @else
                                        <div class="item-video" data-merge="2">
                                            <video controls style="width: 100%">
                                                <source src="{{asset($img)}}">
                                            </video>
                                        </div>

                                    @endif

                                @endforeach
                            </div>
                        </div>
                        <div class="blog-one__content">


                            <p><span>{{ $product->quantity }}</span> {{ __('store.product_available') }}</p>
                        </div>
                    </div>
                    <div class="pt-50">
                        {!!  $product['content_'.app()->getLocale()] !!}
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="sidebar">
                        <div>
                        @if($offer ?? false)
                            <del class="prev-price">{{ $product->price }} {{ $product->getCurrency() }}</del>
                            <strong class="price"> {{ round($offer->discount) }} {{ $product->getCurrency() }}</strong>
                        @else
                        
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                            <del class="prev-price" style="color: red;">{{ $product->price_before }} </del>
                            @endif
                            @endif
                            <strong class="price">{{ $product->price }} {{ $product->getCurrency() }}</strong>
                        @endif

                        @if($product->negotiation == 1)
                            <h3 class="badge badge-success" style="color:black">
                                {{ __('master.product_negotiation') }}
                            </h3>
                        @endif
                        </div>
                            <br/>
                        <hr>
                        <div class="row p-2 align-items-center">
                           <div class="">
                              <span class="text-muted px-2" > </span>
                              <div class="quantity d-flex flex-nowarp align-items-center" >
                                 <span id="quantity1" class="count quantity-count mx-2">
                                  {{ $product->quantity }} {{ __('store.product_available') }}
                                 </span>
                              </div>
                           </div>
                        </div>
                          <div class="form-group">
                                      <span class="minus">-</span>
                                      <input class="quantity_counter" id="quantity" name="quantity" type="text" value="1"/>
                                      <span class="plus">+</span>
                                    </div>

                        <a onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}},'checkout')" class="btn btn-danger btn-block btn-lg BuyNowHomeButtonBackGround" >
                            <h4 class="text-white">{{__('master.Complete the order')}}</h4>
                        </a>
                        <a class="btn  btn-outline-success btn-block"
                           target="_blank"
                           href="https://wa.me/send?text={{ route('store.product_details_ads',['sub_domain'=> $product->store->domain,'id'=>$product->id]) }}"><i
                                    class="fa fa-whatsapp"></i>
                        </a>

                    </div>
                </div>
                <div class="col-lg-12">
                    <hr>
                    @include('Store.components.Rate')

                </div>
            </div>
            <div class="row">
                <div class="clearfix"></div>
                @forelse($simlier as $product)
                    <?php
                    $getimg = [];
                    if (isset($product->image)) {
                        foreach ($product->image as $img) {
                            $last = last(explode('.',$img));
                            if (in_array($last,["jpg", "png", "gif"])) {
                                $getimg[] = $img;
                            }
                        }
                    }
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="blog-one__single">
                            <div class="blog-one__image">
                                <a href="{{ $product->route_details() }}" class="image_center">
                                        <img src="{{ asset($product->firstImage()) }}" alt="product {{ $product->id }} image">
                                </a>
                                <a class="blog-one__more-link" href="{{ $product->route_details() }}">
                                    <i class="fa fa-cart-plus fa-4x"></i>
                                </a>
                            </div>
                            <div class="blog-one__content">
                                <a href="{{ $product->route_details() }}" style="display: block;padding-bottom: 0">
                                    <ul class="list-unstyled blog-one__meta">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                            <li>
                                                <span><del class="prev-price" style="color: red;">{{ $product->price_before }} </del></span>
                                            </li>
                                        @endif
                                        @endif
                                        @if($product->get_current_offer() ?? false)
                                            <li>
                                                <span><del class="prev-price">{{ $product->price }} {{ $product->getCurrency() }}</del></span>
                                                <span class="price">{{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}</span>
                                            </li>
                                        @else
                                            <li>
                                                <span class="price">{{ $product->price }} {{ $product->getCurrency() }}</span>
                                            </li>
                                        @endif
                                    </ul>

                                    <h6>
                                        <strong>
                                            @if($product->negotiation == 1)
                                                {{ __('master.product_negotiation') }}
                                            @endif
                                        </strong>
                                    </h6>

                                    <h4 class="blog-one__title">
                                        {{ $product['name_'.app()->getLocale()] }}
                                    </h4>

                                </a>

                            </div>
                            <div class="btn-group btn-block">
                                <a href="{{ $product->route_details() }}"
                                   class="btn btn-success mr-2 rounded background_buy_now_button BuyNowHomeButtonBackGround">{{__('master.buy_now')}}</a>
                                <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})" class="btn btn-primary mr-2 rounded background_add_to_cart_button addtoCartButtonBackGround">{{__('master.add_to_cart')}}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
            crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
      $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
      });
      $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
      });
    });
    </script>

    <script>
        $(document).ready(function() {
            var bigimage = $("#big");
            var thumbs = $("#thumbs");
            //var totalslides = 10;
            var syncedSecondary = true;

            bigimage
                .owlCarousel({
                    items: 1,
                    autoHeight: true,
                    slideSpeed: 3000,
                    nav: true,
                    rtl:true,
                    autoplay: true,
                    dots: false,
                    loop: false,
                    responsiveRefreshRate: 200,
                    navText: [
                        '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                        '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
                    ]
                })
                .on("changed.owl.carousel", syncPosition);

            thumbs
                .on("initialized.owl.carousel", function() {
                    thumbs
                        .find(".owl-item")
                        .eq(0)
                        .addClass("current");
                })
                .owlCarousel({
                    items: 4,
                    autoHeight: true,
                    dots: true,
                    rtl:true,
                    nav: false,
                    navText: [
                        '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                        '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
                    ],
                    slideBy: 4,
                    responsiveRefreshRate: 100
                })
                .on("changed.owl.carousel", syncPosition2);

            function syncPosition(el) {
                //if loop is set to false, then you have to uncomment the next line
                //var current = el.item.index;

                //to disable loop, comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
                //to this
                thumbs
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = thumbs.find(".owl-item.active").length - 1;
                var start = thumbs
                    .find(".owl-item.active")
                    .first()
                    .index();
                var end = thumbs
                    .find(".owl-item.active")
                    .last()
                    .index();

                if (current > end) {
                    thumbs.data("owl.carousel").to(current, 100, true);
                }
                if (current < start) {
                    thumbs.data("owl.carousel").to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    bigimage.data("owl.carousel").to(number, 100, true);
                }
            }

            thumbs.on("click", ".owl-item", function(e) {
                e.preventDefault();
                var number = $(this).index();
                bigimage.data("owl.carousel").to(number, 300, true);
            });
        });
        //
        // $('.owl-carousel').owlCarousel({
        //     items: 1,
        //     loop: true,
        //     rtl: true,
        //     autoHeight: true,
        //     videoHeight: 300,
        //     dots:false,
        //     videoWidth: 600,
        //     center: true,
        //     margin : 30,
        //     nav    : true,
        //     smartSpeed :900,
        //     navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
        // })
    </script>
@endsection
