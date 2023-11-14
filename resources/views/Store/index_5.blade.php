@extends('Store.master_5')

@section('head')
    <style>
        .background_buy_now_button {
            animation-name: bayButton;
            animation-duration: 1s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
            background-color: {{$css_style['background_buy_now_button']?? ''}} !important;
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

        .product-title a {
            white-space: nowrap;
            overflow: hidden;
        }
        .slick-arrow{
            color: #fff!important;
        }
    </style>
@endsection
@section('content')


    <!-- Toast messages -->
    <flash></flash>
    <!-- App content -->
    <main class="page-wrapper">
        @if(!empty($slider))

            <div id="section-xiYRXmErFPRQ0HUw" class="slider-container show-first-image horizontal medium">
                <div class="slider">
                    @foreach($slider as $slide)
                        <div class="slide">
                            <img class="mobile-image " src="{{url('/')}}/{{$slide->image}}" alt="slider-image"/>
                            <img class="desktop-image " src="{{url('/')}}/{{$slide->image}}" alt="slider-image"/>
                            <span class="slider-caption"> </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(isset($bestseller) && count($bestseller) > 0)
            <section class="section products-list-section section-TACMuZzsZ96cIf3Y">
                <div class="container">
                    <div class="app-heading">
                        <h3 class="heading-primary"> {{ __('store.best_seller') }} </h3>
                        <p class="heading-description"></p>
                    </div>
                    <div class="products-slider">
                        @foreach($bestseller as $product)
                            {{--<?php
                            $getimg = array();

                            if (isset($product->image)) {
                                foreach ($product->image as $img) {
                                    $last = last(explode('.', $img));

                                    if (in_array($last, ["jpg", "png", "gif", "jpeg", "webp"])) {
                                        $getimg[] = $img;
                                    }
                                }
                            }
                            ?>
                            <div class="product-item">
                                <a class="product-thumbnail lazy" href="{{ $product->route_details() }}">
                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                         data-src="@if(!empty($getimg) )
                                         {{ asset($getimg[array_rand($getimg,1)]) }}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
@endif" alt="" class=""style="height:100%;">
                                </a>
                                <div class="product-details">
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a href="{{ $product->route_details() }}"> {{ $product['name_'.app()->getLocale()] }} </a>
                                        </h3>
                                        <div class="product-price">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                <span class="currency-value before">
                                                        <span class="value">  &nbsp; {{ $product->price_before ?? " "  }} &nbsp;  </span>
                                                </span>
                                            @endif
                                            @endif
                                            <span class="currency-value after">
                                                        @if($product->get_current_offer() ?? false)
                                                    {{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}

                                                    {{ $product->price }}
                                                @else
                                                    {{ $product->price }} {{ $product->getCurrency() }}
                                                @endif
                                            <span class="value"></span>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <a class="background_buy_now_button button small-button secondary-button"
                                           href="{{ $product->route_details() }}">
                                            {{ __('master.buy_now') }}
                                        </a>
                                        <button class="background_add_to_cart_button button small-button secondary-button"
                                                onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})">
                                            {{ __('master.add_to_cart') }}
                                        </button>
                                    </div>
                                </div>
                            </div>--}}
                            
                            <div class="product-item">
                                <a class="product-thumbnail lazy" href="{{ $product->route_details() }}">
                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                         data-src="@if(!empty($product->featured_image) )
                                         {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
@endif" alt="" class=""style="height:100%;">
                                </a>
                                <div class="product-details">
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a href="{{ $product->route_details() }}"> {{ $product['name_'.app()->getLocale()] }} </a>
                                        </h3>
                                        <div class="product-price">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                <span class="currency-value before">
                                                        <span class="value">  &nbsp; {{ $product->price_before ?? " "  }} &nbsp;  </span>
                                                </span>
                                            @endif
                                            @endif
                                            <span class="currency-value after">
                                                        @if($product->get_current_offer() ?? false)
                                                    {{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}

                                                    {{ $product->price }}
                                                @else
                                                    {{ $product->price }} {{ $product->getCurrency() }}
                                                @endif
                                            <span class="value"></span>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <a class="background_buy_now_button button small-button secondary-button"
                                           href="{{ $product->route_details() }}">
                                            {{ __('master.buy_now') }}
                                        </a>
                                        <button class="background_add_to_cart_button button small-button secondary-button"
                                                onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})">
                                            {{ __('master.add_to_cart') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        @endif
        @if(isset($recent_pro))
            <section class="section products-list-section recent_products section-TACMuZzsZ96cIf3Y">
                <svg width="2000" height="109" xmlns="http://www.w3.org/2000/svg"
                     style="vector-effect: non-scaling-stroke;" stroke="null">
                    <g stroke="null">
                        <title stroke="null">Layer 1</title>
                        <path stroke="null" id="svg_1" d="m44,104.1l1955.00013,-104.1l0,109l-1999.00013,0l44,-4.9z"
                              fill="#f2f2f2"/>
                    </g>
                </svg>
                <div class="container">
                    <div class="app-heading">
                        <h3 class="heading-primary"> {{ __('store.recent_products') }} </h3>
                        <p class="heading-description"></p>
                    </div>
                    <div class="products-slider">
                        {{--@foreach($recent_pro as $product)
                            <?php
                            $getimg = array();
                            if (isset($product->image)) {
                                foreach ($product->image as $img) {
                                    $last = last(explode('.', $img));
                                    if (in_array($last, ["jpg", "png", "gif", "jpeg", "webp"])) {
                                        $getimg[] = $img;
                                    }
                                }
                            }
                            ?>
                            <div class="product-item">
                                <a class="product-thumbnail lazy" href="{{ $product->route_details() }}">
                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                         data-src="@if(!empty($getimg) )
                                         {{ asset($getimg[array_rand($getimg,1)]) }}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                         @endif
                                                 " alt="" class=""style="height:100%;">
                                </a>
                                <div class="product-details">
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a href="{{ $product->route_details() }}"> {{ $product['name_'.app()->getLocale()] }} </a>
                                        </h3>
                                        <div class="product-price">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                <span class="currency-value before">
                                                        <span class="value">  &nbsp; {{ $product->price_before ?? " "  }} &nbsp;  </span>
                                                </span>
                                            @endif
                                            @endif
                                            <span class="currency-value after">
                                                        @if($product->get_current_offer() ?? false)
                                                    {{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}

                                                    {{ $product->price }}
                                                @else
                                                    {{ $product->price }} {{ $product->getCurrency() }}
                                                @endif
                                            <span class="value"></span>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <a class="background_buy_now_button button small-button secondary-button"
                                           href="{{ $product->route_details() }}">
                                            {{ __('master.buy_now') }}
                                        </a>
                                        <button class="background_add_to_cart_button button small-button secondary-button"
                                                onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})">

                                            {{ __('master.add_to_cart') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach--}}
                        @foreach($recent_pro as $product)
                            <div class="product-item">
                                <a class="product-thumbnail lazy" href="{{ $product->route_details() }}">
                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                         data-src="@if(!empty($product->featured_image) )
                                         {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                         @endif
                                                 " alt="" class=""style="height:100%;">
                                </a>
                                <div class="product-details">
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a href="{{ $product->route_details() }}"> {{ $product['name_'.app()->getLocale()] }} </a>
                                        </h3>
                                        <div class="product-price">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                <span class="currency-value before">
                                                        <span class="value">  &nbsp; {{ $product->price_before ?? " "  }} &nbsp;  </span>
                                                </span>
                                            @endif
                                            @endif
                                            <span class="currency-value after">
                                                        @if($product->get_current_offer() ?? false)
                                                    {{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}

                                                    {{ $product->price }}
                                                @else
                                                    {{ $product->price }} {{ $product->getCurrency() }}
                                                @endif
                                            <span class="value"></span>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <a class="background_buy_now_button button small-button secondary-button"
                                           href="{{ $product->route_details() }}">
                                            {{ __('master.buy_now') }}
                                        </a>
                                        <button class="background_add_to_cart_button button small-button secondary-button"
                                                onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})">

                                            {{ __('master.add_to_cart') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
@endforeach
                    </div>
                </div>
                <svg class="bottom-svg" width="2000" height="109" xmlns="http://www.w3.org/2000/svg"
                     style="vector-effect: non-scaling-stroke;" stroke="null">
                    <g stroke="null">
                        <title stroke="null">Layer 1</title>
                        <path stroke="null" id="svg_1" d="m44,104.1l1955.00013,-104.1l0,109l-1999.00013,0l44,-4.9z"
                              fill="white"/>
                    </g>
                </svg>
            </section>
        @endif


        @if(isset($products))


            <section class="section products-list-section section-TACMuZzsZ96cIf3Y">
                <div class="container">
                    <div class="app-heading">

                        <h2 style="font-size: 28px;color: #f50057;" class="mt-4">
                            <span>  @if(app()->getLocale() == 'ar') جميع المنتجات  @else   All Products @endif  </span>
                        </h2>
                        <p class="heading-description"></p>
                    </div>
                    <div class="products-slider">
                        @foreach($products as $product)
                         {{--   <?php
                            $getimg = array();

                            if (isset($product->image)) {
                                foreach ($product->image as $img) {
                                    $last = last(explode('.', $img));

                                    if (in_array($last, ["jpg", "png", "gif", "jpeg", "webp"])) {
                                        $getimg[] = $img;
                                    }
                                }
                            }
                            ?>
                            <div class="product-item">
                                <a class="product-thumbnail lazy" href="{{ $product->route_details() }}">
                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                         data-src="@if(!empty($getimg) )
                                         {{ asset($getimg[array_rand($getimg,1)]) }}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                             @endif
                                                 " alt="" class=""style="height:100%;">
                                </a>
                                <div class="product-details">
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a href="{{ $product->route_details() }}"> {{ $product['name_'.app()->getLocale()] }} </a>
                                        </h3>
                                        <div class="product-price">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                <span class="currency-value before">
                                                        <span class="value">  &nbsp; {{ $product->price_before ?? " "  }} &nbsp;  </span>
                                                </span>
                                            @endif
                                            @endif
                                            <span class="currency-value after">
                                                        @if($product->get_current_offer() ?? false)
                                                    {{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}
                                                    {{ $product->price }}
                                                @else
                                                    {{ $product->price }} {{ $product->getCurrency() }}
                                                @endif

                                          <span class="value"></span>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <a class="background_buy_now_button button small-button secondary-button"
                                           href="{{ $product->route_details() }}">  {{ __('master.buy_now')}}  </a>
                                        <button class="background_add_to_cart_button button small-button secondary-button"
                                                onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"> {{ __('master.add_to_cart')}}  </button>
                                    </div>
                                </div>
                            </div>
                        --}}
                            <div class="product-item">
                                <a class="product-thumbnail lazy" href="{{ $product->route_details() }}">
                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                         data-src="@if(!empty($product->featured_image) )
                                         {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                             @endif
                                                 " alt="" class="" style="height:100%;">
                                </a>
                                <div class="product-details">
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a href="{{ $product->route_details() }}"> {{ $product['name_'.app()->getLocale()] }} </a>
                                        </h3>
                                        <div class="product-price">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                <span class="currency-value before">
                                                        <span class="value">  &nbsp; {{ $product->price_before ?? " "  }} &nbsp;  </span>
                                                </span>
                                            @endif
                                            @endif
                                            <span class="currency-value after">
                                                        @if($product->get_current_offer() ?? false)
                                                    {{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}
                                                    {{ $product->price }}
                                                @else
                                                    {{ $product->price }} {{ $product->getCurrency() }}
                                                @endif

                                          <span class="value"></span>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <a class="background_buy_now_button button small-button secondary-button"
                                           href="{{ $product->route_details() }}">  {{ __('master.buy_now')}}  </a>
                                        <button class="background_add_to_cart_button button small-button secondary-button"
                                                onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"> {{ __('master.add_to_cart')}}  </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </section>
        @endif

        @if(isset($recent_pro))


            <section class="section products-list-section section-TACMuZzsZ96cIf3Y">
                <div class="container">
                    <div class="app-heading">

                        <h2 style="font-size: 28px;color: #f50057;" class="mt-4">
                            <span>  @if(app()->getLocale() == 'ar') جميع المنتجات  @else   All Products @endif  </span>
                        </h2>
                        <p class="heading-description"></p>
                    </div>
                    <div class="products-slider">
                       @foreach($recent_pro as $product)
                           {{--  <?php
                            $getimg = array();

                            if (isset($product->image)) {
                                foreach ($product->image as $img) {
                                    $last = last(explode('.', $img));

                                    if (in_array($last, ["jpg", "png", "gif", "jpeg", "webp"])) {
                                        $getimg[] = $img;
                                    }
                                }
                            }
                            ?>
                            <div class="product-item">
                                <a class="product-thumbnail lazy" href="{{ $product->route_details() }}">
                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                         data-src="@if(!empty($getimg) )
                                         {{ asset($getimg[array_rand($getimg,1)]) }}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
@endif" alt="" class=""style="height:100%;">
                                </a>
                                <div class="product-details">
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a href="{{ $product->route_details() }}"> {{ $product['name_'.app()->getLocale()] }} </a>
                                        </h3>
                                        <div class="product-price">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                <span class="currency-value before">
                                                        <span class="value">  &nbsp; {{ $product->price_before ?? " "  }} &nbsp;  </span>
                                                </span>
                                            @endif
                                            @endif
                                            <span class="currency-value after">
                                                        @if($product->get_current_offer() ?? false)
                                                    {{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}

                                                    {{ $product->price }}
                                                @else
                                                    {{ $product->price }} {{ $product->getCurrency() }}
                                                @endif

                                          <span class="value"></span>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <a class="background_buy_now_button button small-button secondary-button"
                                           href="{{ $product->route_details() }}"> {{ __('master.buy_now') }} </a>
                                        <button class="background_add_to_cart_button button small-button secondary-button"
                                                onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"> {{ __('master.add_to_cart') }}  </button>
                                    </div>
                                </div>
                            </div>--}}
                            <div class="product-item">
                                <a class="product-thumbnail lazy" href="{{ $product->route_details() }}">
                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                         data-src="@if(!empty($product->featured_image) )
                                         {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
@endif" alt="" class=""style="height:100%;">
                                </a>
                                <div class="product-details">
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a href="{{ $product->route_details() }}"> {{ $product['name_'.app()->getLocale()] }} </a>
                                        </h3>
                                        <div class="product-price">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                <span class="currency-value before">
                                                        <span class="value">  &nbsp; {{ $product->price_before ?? " "  }} &nbsp;  </span>
                                                </span>
                                            @endif
                                            @endif
                                            <span class="currency-value after">
                                                        @if($product->get_current_offer() ?? false)
                                                    {{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}

                                                    {{ $product->price }}
                                                @else
                                                    {{ $product->price }} {{ $product->getCurrency() }}
                                                @endif

                                          <span class="value"></span>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <a class="background_buy_now_button button small-button secondary-button"
                                           href="{{ $product->route_details() }}"> {{ __('master.buy_now') }} </a>
                                        <button class="background_add_to_cart_button button small-button secondary-button"
                                                onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"> {{ __('master.add_to_cart') }}  </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach 

                    </div>

                <!--    <div style="width: 100%; {{ app()->getLocale() == 'ar' ? 'text-align:left' : 'text-align:right' }}">-->
                <!--        @if(count($recent_pro) >= 1) -->
                <!--            @if(app()->getLocale() == 'ar' )-->
                <!--             <a class="btn btn-link" style="text-decoration:none;" href="{{ url('') }}/category/all">  <i class="fa fa-eye" ></i> رؤية المزيد ؟ </a>-->
                    <!--            @else-->
                <!--              <a class="btn btn-link" style="text-decoration:none;" href="{{ url('') }}/category/all"> <i class="fa fa-eye"></i>  See More Products </a>-->
                    <!--            @endif-->
                    <!--        @endif-->
                    <!--</div>-->
                </div>

            </section>
        @endif
        @if($store->information->whatsapp!=null)
            <div style="position: fixed;right: 0px;bottom: 0px;width:70px;margin-right: 2.5rem;margin-bottom: 3rem;">
                <a href="https://api.whatsapp.com/send?phone={{$store->information->whatsapp}}">
                    <img src="{{asset("img/whatsapp.png")}}">
                </a>
            </div>
        @endif

    </main>

@endsection
@section('script')
    <script src="https://static3.youcan.shop/api/languages-cornshop.json?timestamp=1606998924"></script>
    <script src="https://static3.youcan.shop/store-front/js/bootstrap.js?id=cbab8543a95e4c786082"></script>
    <script src="https://static3.youcan.shop/store-front/js/app.js?id=7afa8c14cae20da4adfd"></script>
    <script src="https://static3.youcan.shop/store-front/js/home/app.js?id=69d2536bb486cdd4fd8a"></script>
    <script type="module">
        let sliderId = "section-xiYRXmErFPRQ0HUw",
            direction = "horizontal",
            frequency = "5",
            customHeight = null,
            slideImages = document.querySelectorAll(isMobileView() ? '.desktop-image' : '.mobile-image');

        Array.from(slideImages).forEach(image => {
            image.remove();
        });


        if (!isMobileView() && customHeight !== null) {
            document.getElementById(`${sliderId}`).style.height = `${customHeight}px`;
        }

        let slickOptions = {
            dots: true,
            infinite: false,
            arrows: direction === "horizontal" ? true : false,
            speed: 1000,
            autoplay: true,
            autoplaySpeed: frequency * 1000,
            slidesToShow: 1,
            slidesToScroll: 1,
            vertical: direction !== "horizontal" ? true : false,
            verticalSwiping: direction !== "horizontal" ? true : false,
            rtl: $('html').attr('dir') == 'rtl' && direction === "horizontal" ? true : false
        };

        $(`#${sliderId} .slider`).slick(slickOptions);

        // Document Ready
        document.addEventListener("DOMContentLoaded", () => {
            $(`#${sliderId}`).removeClass('show-first-image');
        });
    </script>
@endsection
