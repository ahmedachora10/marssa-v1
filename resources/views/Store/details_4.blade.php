@extends('Store.master_4')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
          crossorigin="anonymous"/>
@endsection
@section('content')

     <style>
        .owl-carousel .owl-stage-outer{ height: 300px !important;background-color: #fff;}
        .owl-carousel .owl-item img{
            height:100% !important;
        }
        .owl-carousel .owl-theme .owl-rtl .owl-loaded .owl-drag{
            
            height:250px !important;
        }
     .show-mobile{
         display:none !important;
     }
@media screen and (min-device-width: 81px) and (max-device-width: 768px) {
    /* STYLES HERE */
     .xs-hidden{
         display:none !important;
     }
     .checkoutbtn{
             position: fixed;
    bottom: 0px;
    z-index: 9999;
    width: 100%;
    box-shadow: -1px -5px 9px #23222226;
     }
     .toTop{
           display:none !important;
     }
     .show-mobile{
         display:block !important;
     }
     .pt-5, .py-5 {
    padding-top:0px !important;
}
.main-logo{
    max-width: 43%;
}
  .top-mobile{
         margin-top:-60px !important;
     }
}



                 .custpm .rating-md .caption {
                                font-size: 12px !important;
                            }
                            .theme-krajee-uni .star {font-size: 20px !important;}
                            .theme-krajee-uni .clear-rating {font-size: 10px !important;;}

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
    </style>

    <?php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
 <style>
                .select-custom {
                    display: inline-block;
                    cursor: pointer;
                    outline: none;
                    border-radius: .25rem!important;
                    width: 100%;
                    height: calc(1.5em + .75rem + 2px);
                    padding: .375rem 1.75rem .375rem .75rem;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: rgb(73, 80, 87);
                    vertical-align: middle;
                    background-color: rgb(255, 255, 255);
                    border: 1px solid rgb(206, 212, 218);
                }
                .select-custom:hover{
                    border:  1px solid rgb(186, 192, 197) !important;
                }
                .select-custom:focus{
                    border: 1px solid rgb(0, 180, 120) !important;
                    box-shadow: 0 0.313rem 0.719rem rgba(0, 105, 70, 0.1), 0 0.156rem 0.125rem rgba(0, 0, 0, 0.06) !important;
                }
                @media screen and (-webkit-min-device-pixel-ratio: 0) {
                    .select-custom {
                    background: #ffffff;
                    }
                }
            </style>

         <button onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})" class="theme-btn bg-danger xs-hidden"><i class="fa fa-cart-plus "></i><span> {{__('master.add_to_cart')}} </span></button>

<section class="container-fluid bg-light py-5 p-0">

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
                    {{ $product->price - $offer->discount }} {{ $offer->getCurrency() }}@if(app()->getLocale() == "en") {{ __('store.discount') }}@endif
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
            <div class="container mb-3 bg-white shadow-sm">
               <style>
                  .select-custom {
                  display: inline-block;
                  cursor: pointer;
                  outline: none;
                  border-radius: .25rem!important;
                  width: 100%;
                  height: calc(1.5em + .75rem + 2px);
                  padding: .375rem 1.75rem .375rem .75rem;
                  font-size: 1rem;
                  font-weight: 400;
                  line-height: 1.5;
                  color: rgb(73, 80, 87);
                  vertical-align: middle;
                  background-color: rgb(255, 255, 255);
                  border: 1px solid rgb(206, 212, 218);
                  }
                  .select-custom:hover{
                  border:  1px solid rgb(186, 192, 197) !important;
                  }
                  .select-custom:focus{
                  border: 1px solid rgb(0, 180, 120) !important;
                  box-shadow: 0 0.313rem 0.719rem rgba(0, 105, 70, 0.1), 0 0.156rem 0.125rem rgba(0, 0, 0, 0.06) !important;
                  }
                  @media screen and (-webkit-min-device-pixel-ratio: 0) {
                  .select-custom {
                  background: #ffffff;
                  }
                  }
               </style>
               <div class="row" id="app">
                  <!-- preview products -->
                  <div class="col-lg-5 py-2" >
                        <h3 class="text-secondary show-mobile mb-3 mb-3 text-center text-secondary" >{{ $product['name_'.app()->getLocale()] }} </h3>
                     <div class="container bg-light rounded" style="overflow-y: hidden;height: 400px;">
                     <div id="big" class="owl-carousel owl-theme">
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
                  </div>
                  <div class="col-lg-7 pt-5 pb-lg-5 pb-2">
                     <div class="container">
                        <h3 class="text-secondary mb-3" >{{ $product['name_'.app()->getLocale()] }} </h3>
                        <p class="text-muted" > <ul class="rating">
                                @if(count($product->orders()->get()) > 0)
                                    <li>{{ count($product->orders()->get()) .' '. __('store.sold') }}</li>
                                @endif
                            </ul> </p>

                         <p class="row custpm">

                          <input class="kv-ltr-theme-uni-star rating-loading star_disabled" value="{{$rate_avg}}" data-size="md">
                         </p>
                        <div class="d-flex flex-nowrap p-2" >
                           <div class="text-white  btn-lg bg-light px-3" >

                              <h3 class="mb-0 btn" >
                                  @if($offer ?? false)
                                      <del class="px-2 text-secondary " style="font-size: 1rem" >
                                {{ $product->price }} {{ $product->getCurrency() }}
                           </del>
                                  @else
                                      {{ $product->price }} {{ $product->getCurrency() }}
                                   @endif

                              </h3>
                           </div>
                           @if($offer ?? false)
                           <span class="px-2 text-secondary " style="font-size: 1rem" >
                           {{ round($offer->discount) }} {{ $product->getCurrency() }}
                           </span>
                           @endif

                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                            <del class="px-2 text-secondary " style="font-size: 1rem;color: red !important;margin-top: 15px;" >
                                {{ $product->price_before }}
                            </del>
                            @endif
                            @endif

                            @if($product->negotiation == 1)
                            <h3 class="badge badge-success" style="color:black">
                                {{ __('master.product_negotiation') }}
                            </h3>
                            @endif

                        </div>
                        <div class="py-2 px-md-5 px-1 m-auto" style="width: 100%" >


                        </div>
                        <hr>
                        <div class="row p-2 align-items-center">
                           <div class="col-lg-5 col-12 d-flex flex-nowrap p-2 align-items-center px-1 w-100">
                              <span class="text-muted px-2" >{{ $product->quantity }} </span>
                              <div class="quantity d-flex flex-nowarp align-items-center" >
                                 <span id="quantity1" class="count quantity-count mx-2">
                                 {{ __('store.product_available') }}
                                 </span>
                              </div>
                           </div>
                        </div>

                          <div class="form-group">
                                      <span class="minus">-</span>
                                      <input class="quantity_counter" id="quantity" name="quantity" type="text" value="1"/>
                                      <span class="plus">+</span>
                                    </div>
                              <a onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}},'checkout')"  class="btn btn-danger btn-block btn-lg background_buy_now_button " >
                                    <h4 class="text-white ">{{__('master.Complete the order')}}</h4>
                                </a>
                              <div class="col-lg-12 col-12 px-1 w-100 mb-2" >
                                 <button type="button" data-target="1"  onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})" class="btn xs-hidden btn-block btn-theme px-4 py-2 shadow-sm text-nowrap addToCart">اضف الى السلة  <i class="fa fa-shopping-cart" style="color: #005a3c;"></i></button>
                              </div>
                           </div>

                        <div class="row p-2 align-items-center justify-content-center">
                           <div class="flex-w flex-m p-t-40 justify-content-center">
                              <a target="_blank" href="https://www.facebook.com/sharer.php?u={{ $actual_link }}" data-tooltip="Facebook" class="btn btn-light py-1 px-lg-5 px-2 mb-3"><i style="color: #455fad" class="fa fa-facebook"></i></a>

                              <a target="_blank" href="https://wa.me/?text=La%20valise_{{ $actual_link }}" data-tooltip="Whatsapp" class="btn btn-light py-1 px-lg-5 px-2 mb-3"><i style="color: #38bd35" class="fa fa-whatsapp"></i></a>

                              <div class="clear-fix"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                                   <!-- <img class="top-mobile img-responsive" style="margin:0px auto;margin-top: -90px;" src="{{asset('public/products.jpg')}}">-->

               </div>
            </div>
             <a onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}},'checkout')"  class="btn btn-danger btn-block btn-lg background_buy_now_button show-mobile checkoutbtn" >
                                    <h4 class="text-white ">{{__('master.Complete the order')}}</h4>
                                </a>
            <!-- desc  -->
            <div class="container mb-3 bg-white shadow-sm">
               <div class="row">
                  <div class="col-12 text-center p-3" >
                     <h3 class="text-secondary" > تفاصيل المنتج </h3>
                  </div>
                  <div class="col-12 p-3" >
                     <p>{{ $product['name_'.app()->getLocale()] }}<br></p>
                     <p>{!! $product['content_'.app()->getLocale()] !!}<br></p>


                  </div><hr>
                  <div class="col-12 p-3" >
                  @include('Store.components.Rate')
                  </div>
               </div>
            </div>


            <!-- reviews -->
         </section>
     <div class="row">
         <div class="col-lg-12 bg-white shadow-sm">
             <div class="row m-0 py-4" >
                 @forelse($simlier as $product)
                     <?php
                     $getimg = array();

                     if (isset($product->image)) {
                         foreach ($product->image as $img) {
                             $last = last(explode('.',$img));
                             if (in_array($last,["jpg", "png", "gif"])) {
                                 $getimg[] = $img;
                             }
                         }
                     }
                     ?>
                     <div class="col-lg-3 col-md-6 col-sm-12 my-3 ">
                         <div class="d-flex flex-column">
                             <a href="{{ $product->route_details() }}" class="m-auto ">
                                 @if(!empty($getimg))
                                     <img class="img__item rounded w-100" height="250"
                                          src="{{ asset($getimg[array_rand($getimg,1)]) }}" alt="product {{ $product->id }} image">
                                 @endif
                             </a>
                             <a class="text-decoration-none text-secondary" href="{{ $product->route_details() }}">
                                 <h6 class="py-2 mb-0">  {{ $product['name_'.app()->getLocale()] }}</h6>
                             </a>
                             <div class="text-light">
                                 <h5 class="text-danger font-weight-bold">
                                     {{ $product->price }} {{ $product->getCurrency() }}

                                     <small style="float: {{app()->getLocale()=='ar'?'left':'right'}};">
                                         <del class="text-secondary" style="color: red !important;">
                                             @if($product->get_current_offer() ?? false)
                                                 {{ round($product->get_current_offer()->discount) }}
                                             @endif
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                 {{ $product->price_before }}
                                             @endif
                                             @endif
                                         </del>

                                     </small>
                                 </h5>
                             </div>
                             <div class="btn-group" role="group" aria-label="Basic example">
                                 <a href="{{ $product->route_details() }}"
                                    class="btn btn-success mr-2 rounded background_buy_now_button">{{__('master.buy_now')}}</a>
                                 <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})" class="btn btn-primary mr-2 rounded background_add_to_cart_button"><i class="fa fa-shopping-basket"></i></span>
                             </div>
                         </div>
                     </div>
                 @empty
                     <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                 @endforelse

             </div>
             <div class="row m-0 justify-content-center pb-4">

             </div>
         </div>
     </div>
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


      <!-- whatsapp -->
      <script>
         $(document).ready(function(){
             $('#whatsapp_message').fadeIn();
             $('#messagebtn').fadeIn();
         });
      </script>
      <script type="text/javascript">
         function loadLivechat(){
             $('body').prepend('<div id="messagebtn" style="display:none" class="messagebtn d-flex flex-columns align-items-center justify-content-center " data-toggle="modal" data-target="#livechat"><span id="messagenumber">0</span><i class="fa fa-comments"></i></div><div id="chatloader"></div>');
             $('#chatloader').load(Routing.generate('popupchat'));
         }
         //loadLivechat();
      </script>
      <!-- Popup notif -->
      <script type="text/javascript">
         var typeTime = 's';
         if ( typeTime == 's' ) {
             var time = '6' * 1000;
         }else if( typeTime == 'm' ) {
             var time = '6' * 60000;
         }else if( typeTime == 'h' ) {
             var time = '6' * 360000;
         }
         function loadPopUp(){

             $('#popuploader').load(Routing.generate('popupNoti'),function(){
                 console.log('popup tr');
                 $(".notifPop").fadeIn("slow");
                 $(".custom-close-pop").click(function()
                 {
                     $(".notifPop").fadeOut("slow")
                 });

                 setTimeout(() => {
                 $(".notifPop").fadeOut("slow")
             }, 8000);
             });

         }

         setInterval(() => {
         loadPopUp();
         }, time);
      </script>
      <script>
         function getRandomizer(bottom, top) {
             return Math.floor( Math.random() * ( 1 + top - bottom ) ) + bottom;
         }

         function setCookie(cname, cvalue, seconds) {
             var d = new Date();
             d.setTime(d.getTime() + (seconds * 1000));
             var expires = "expires="+d.toUTCString();
             document.cookie = cname + "=" + cvalue + "; " + expires;
         }

         function getCookie(cname) {
             var name = cname + "=";
             var ca = document.cookie.split(';');
             for(var i=0; i<ca.length; i++) {
                 var c = ca[i];
                 while (c.charAt(0)==' ') c = c.substring(1);
                 if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
             }
             return "";
         }
         /*
         countdowntitle
         countdownnum
         countdownquantity
         countdowntimer
         countdowndate
         countdownmessage
         countdownshowtitle
         countdownshowbar
         */
         var product_timer_top_text_enable = 1;
         var product_progressbar_enable = 1;
         if(!progressbar_message) var progressbar_message = " لم يتبقى سوى [num] لإنتهاء العرض";
         var percentage=30;
         var totalStock=100;
         var prevStock = 0;

         var rollDie = parseInt(getCookie("random_6"));
         if(!rollDie) rollDie = getRandomizer(0,totalStock);

         function showStock() {

           if(rollDie >= 6) rollDie = rollDie-(0.0005*(rollDie-4)*(rollDie-4));

           var intRollDie = parseInt(rollDie);

           if (prevStock != intRollDie) {

             setCookie("random_6", intRollDie, 24*60*60);

             var percentagetoshow = parseInt(intRollDie/totalStock*100);
               var html = '';
               if(product_timer_top_text_enable) html += '<p class="limited_edt"><span>'+ progressbar_message.replace('[num]', '<span class="num">'+intRollDie+'</span>') +'</span></p>';
               if(product_progressbar_enable) html += '<div class="meter red"><div class="inside" style="width: '+percentagetoshow+'%"></div></div>';
               $('.progressbar').html(html);
                 if (prevStock > 0) {
                   $('.progressbar span.num').addClass('flash');
                   setTimeout(function () {
                       $('.progressbar span.num').removeClass('flash');
                   }, 1500);
                 }
                 prevStock = intRollDie;
           }
         }

         showStock();
         setInterval(showStock, 1000);
                 var time_left = parseInt("73260");
           var target_date = parseInt(getCookie("timer_6")) || new Date().getTime()/1000 + time_left;

           setCookie("timer_6", target_date, 24*60*60);

         setInterval(function () {
           var days, hours, minutes, seconds;

           var current_time = new Date().getTime()/1000;
           var seconds_left = target_date - current_time;
           if(seconds_left <= 0){
             target_date = new Date().getTime()/1000 + time_left;
             seconds_left = target_date - current_time;


               setCookie("timer_6", target_date, 24*60*60);

           }
             days = parseInt(seconds_left / 86400);
             seconds_left = seconds_left % 86400;
             hours = parseInt(seconds_left / 3600);
             seconds_left = seconds_left % 3600;

             minutes = parseInt(seconds_left / 60);
             seconds = parseInt(seconds_left % 60);

             $('#countdown').html('<div class="counting">'+days+'<span>أيام</span></div><div class="counting">'+hours+'<span>ساعات</span></div><div class="counting">'+minutes+'<span>دقائق</span></div><div class="counting">'+seconds+'<span>ثواني</span></div>');
           }, 1000);
      </script>
      <!------------------- End Countdown Timer ------------------->
      <script src="../../storeinocdn.com/dev/templates/flate/assets/js/theme.js"></script>
      <script>

         $('.addToCart').click(function() {

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
         });

         function toastTrigger(title,text) {
             if ( !$("#snackbar").length ) {
                 var textHtml = '<div id="snackbar" ></div>';
                 $("body").prepend(textHtml);
             }
             $('#snackbar').empty();
             var textView = '<i class="fa fa-cart-plus pr-2"></i>'+title+text;
             $('#snackbar').prepend(textView);
             var x = document.getElementById("snackbar");
             x.className = "show";
             setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
         }
      </script>
@endsection
