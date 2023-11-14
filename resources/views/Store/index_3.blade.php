@extends('Store.master_3')
<style>
    .product-item .down-content p{
        font-weight:bold;
        margin-bottom:0px !important;
        color:#989797;
    }


.lead {
    font-size: 1.25rem;
    font-weight: 300;
    color:red;
    margin: 50px;
    margin-bottom:0px;
    margin-top:0px;
}
  .title-section{
      margin-top:50px;
  }

</style>
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
    </style>
@endsection
@section('content')

    @if(!empty($information->head_text))

        <section class="bar__info container-fluid py-4 d-flex flex-column align-items-center justify-content-center">
            <h2 class="mb-0" style="color:black;"> {{ $information->head_text }} </h2>
        </section>
    @endif

    @if(!$ads)


    @endif



    @if(!empty($information->banner_head))
        <div class="col-lg-12 bg-white shadow-sm">
            <div class="col-lg-3 col-md-6 col-sm-12 my-3 ">
                <img src="{{ asset($information->banner_head) }}" class="img-responsive img-fluid" />
            </div>
        </div>
    @endif


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
         <div class="banner header-text" style="height:500px;">

                <div class="banner-item" style="height:100%">
                 <div class="text-content" style="height:100%;background-color:rgba(0,0,0,0.7)">
                  </div>
                </div>

            </div>


    @if(isset($bestseller))
      @if(count($bestseller) >= 1)
        <section class="blog-one blog-one__blog-page" id="products" style="padding-top:50px;padding-bottom:50px;">
            <div class="container">
                <div class="mb-5">
                    <h3 class="title-section">
                        <span>{{ __('store.best_seller') }}</span>
                    </h3>
                </div>
                <div class="row high-gutters">
                    @forelse($bestseller as $product)
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
                        <div class="col-lg-4 col-xs-12">
                            <div class="product-item">
                                <a href="{{ $product->route_details() }}">
                                    {{-- @if(!empty($getimg))
                                        <img src="{{ asset($getimg[array_rand($getimg,1)]) }}" alt="product {{ $product->id }} image">
                                        @endif --}}
                                        <img src="@if(!empty($product->featured_image) )
                                                {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                        @endif" alt="product {{ $product->id }} image">
                                    </a>
                                <div class="down-content">
                                <h4>
                                    <a href="{{ $product->route_details() }}" style="font-size: 17px;color: #208dcc;">
                                    {{ $product['name_'.app()->getLocale()] }}
                                </a>

                                </h4>
                                <h6>
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                <a href="{{ $product->route_details() }}" class="blog-one__meta-link">
                                    <del style="color: red;margin-{{app()->getLocale()=='ar'?'left':'right'}}: 20px;">{{ $product->price_before }} </del>
                                </a>
                                @endif
                                @endif
                              @if($product->get_current_offer() ?? false)
                                        <span>
                                        <a href="{{ $product->route_details() }}" class="blog-one__meta-link">
                                            <del style="color: grey">{{ $product->price }} {{ $product->getCurrency() }}</del>
                                        </a>
                                    </span>
                                        <span style="padding: 0 10px">
                                        <a href="{{ $product->route_details() }}" class="blog-one__meta-link">
                                            <span>{{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}</span>
                                        </a>
                                    </span>
                                    @else
                                        <a href="{{ $product->route_details() }}"
                                           class="blog-one__meta-link">{{ $product->price }} {{ $product->getCurrency() }}</a>
                                    @endif
                                </h6>
                                <p>{{ $product['content_'.app()->getLocale()] }}</p>
                              </div>
                              <div class="btn-group btn-block">
                                    <a href="{{ $product->route_details() }}"
                                       class="btn btn-success mr-2 rounded background_buy_now_button">{{__('master.buy_now')}}</a>
                                    <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})" class="btn btn-primary mr-2 rounded background_add_to_cart_button">{{__('master.add_to_cart')}}</span>
                                </div>
                                </div>

                              </div>
                              </div>

                    @empty
                        <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                    @endforelse
                    <!--<div class="text-center">-->
                    <!--            <a  href="{{ url('') }}/category/all">-->
                    <!--                              @if(app()->getLocale() == 'ar')-->
                    <!--                                جميع المنتجات-->
                    <!--                              @else-->
                    <!--                                All Products-->
                    <!--                              @endif-->
                    <!--                            </a>-->
                    <!--        </div>-->
                </div>
                <div class="blog-post-pagination text-center" style="width: 100%">

                </div>
            </div>
        </section>
      @endif
    @endif
    @if(isset($recent_pro))
        <section class="blog-one blog-one__blog-page" id="products">
            <div class="container">
                <div class="mb-5">
                    <h3 class="title-section">
                        <span>{{ __('store.recent_products') }}</span>
                    </h3>
                </div>
                <div class="row high-gutters">
                    @forelse($recent_pro as $product)
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
                        <div class="col-lg-4 col-xs-12">
                            <div class="product-item">
                                <a href="{{ $product->route_details() }}">
                                    {{-- @if(!empty($getimg))
                                        <img src="{{ asset($getimg[array_rand($getimg,1)]) }}" alt="product {{ $product->id }} image">
                                        @endif --}}
                                        <img src="@if(!empty($product->featured_image) )
                                                {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                        @endif" alt="product {{ $product->id }} image">
                                    </a>
                                <div class="down-content">
                                <h4>
                                    <a href="{{ $product->route_details() }}" style="font-size: 17px;color: #208dcc;">
                                    {{ $product['name_'.app()->getLocale()] }}
                                </a>

                                </h4>

                                <h6 style="left: 30px !important;right:auto !important;font-size:15px !important;color:#121212 !important;">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                <a href="{{ $product->route_details() }}" class="blog-one__meta-link" style="font-size:15px !important;color:#121212 !important;">
                                    <del style="color: red;margin-{{app()->getLocale()=='ar'?'left':'right'}}: 20px;">{{ $product->price_before }} </del>
                                </a>
                                @endif
                                @endif
                              @if($product->get_current_offer() ?? false)
                                        <span>
                                        <a href="{{ $product->route_details() }}" class="blog-one__meta-link" style="font-size:15px !important;color:#121212 !important;">
                                            <del style="color: grey">{{ $product->price }} {{ $product->getCurrency() }}</del>
                                        </a>
                                    </span>
                                        <span style="padding: 0 10px">
                                        <a href="{{ $product->route_details() }}" class="blog-one__meta-link" style="font-size:15px !important;color:#121212 !important;">
                                            <span>{{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}</span>
                                        </a>
                                    </span>
                                    @else
                                        <a href="{{ $product->route_details() }}"
                                           class="blog-one__meta-link" style="font-size:15px !important;color:#121212 !important;">{{ $product->price }} {{ $product->getCurrency() }}</a>
                                    @endif
                                </h6>
                                <p>{!! $product['content_'.app()->getLocale()] !!}</p>
                              </div>
                              <div class="btn-group btn-block">
                                    <a href="{{ $product->route_details() }}"
                                       class="btn btn-success mr-2 rounded background_buy_now_button">{{__('master.buy_now')}}</a>
                                    <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})" class="btn btn-primary mr-2 rounded background_add_to_cart_button">{{__('master.add_to_cart')}}</span>
                                </div>
                                </div>

                              </div>
                    @empty
                        <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                    @endforelse
                </div>
                <div class="blog-post-pagination text-center" style="width: 100%">

                </div>
            </div>
        </section>
    @endif
    @if(isset($products))
    <section class="blog-one blog-one__blog-page" id="products">
        <div class="container">
            <div class="row high-gutters">
                @forelse($products as $product)
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
                    <div class="col-lg-4 col-xs-12">
                            <div class="product-item">
                                <a href="{{ $product->route_details() }}">
                                    {{-- @if(!empty($getimg))  @endif --}}
                                        <img src="@if(!empty($product->featured_image) )
                                                {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                        @endif" alt="product {{ $product->id }} image">
                                      
                                    </a>
                                <div class="down-content">
                                <h4>
                                    <a href="{{ $product->route_details() }}" style="font-size: 17px;color: #208dcc;">
                                    {{ $product['name_'.app()->getLocale()] }}
                                </a>

                                </h4>
                                <h6 style="left: 30px !important;right:auto !important;">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                <a href="{{ $product->route_details() }}" class="blog-one__meta-link">
                                    <del style="color: red;margin-{{app()->getLocale()=='ar'?'left':'right'}}: 20px;">{{ $product->price_before }} </del>
                                </a>
                                @endif
                                @endif
                              @if($product->get_current_offer() ?? false)
                                        <span>
                                        <a href="{{ $product->route_details() }}" class="blog-one__meta-link">
                                            <del style="color: grey">{{ $product->price }} {{ $product->getCurrency() }}</del>
                                        </a>
                                    </span>
                                        <span style="padding: 0 10px">
                                        <a href="{{ $product->route_details() }}" class="blog-one__meta-link">
                                            <span>{{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}</span>
                                        </a>
                                    </span>
                                    @else
                                        <a href="{{ $product->route_details() }}"
                                           class="blog-one__meta-link">{{ $product->price }} {{ $product->getCurrency() }}</a>
                                    @endif
                                </h6>
                                <p>{!! $product['content_'.app()->getLocale()] !!}</p>
                              </div>
                             <div class="btn-group btn-block">
                                    <a href="{{ $product->route_details() }}"
                                       class="btn btn-success mr-2 rounded background_buy_now_button">{{__('master.buy_now')}}</a>
                                    <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})" class="btn btn-primary mr-2 rounded background_add_to_cart_button">{{__('master.add_to_cart')}}</span>
                                </div>
                                </div>

                              </div>
                @empty
                    <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                @endforelse
            </div>
            <div class="blog-post-pagination text-center" style="width: 100%">
                {{ $products->links() }}
            </div>
        </div>
    </section>
    @endif

    @if(isset($recent_pro))
        <section class="blog-one blog-one__blog-page" id="products">
            <div class="container">
                <div class="mb-5">
                    <h3 class="title-section">
                        <span>  @if(app()->getLocale() == 'ar') جميع المنتجات  @else   All Products @endif  </span>
                    </h3>
                </div>
                <div class="row high-gutters">
                    @forelse($recent_pro->take(3) as $product)
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
                       <div class="col-lg-4 col-xs-12">
                            <div class="product-item">
                                <a href="{{ $product->route_details() }}">
                                    {{-- @if(!empty($getimg))
                                        <img src="{{ asset($getimg[array_rand($getimg,1)]) }}" alt="product {{ $product->id }} image">
                                        @endif --}}
                                        <img src="@if(!empty($product->featured_image) )
                                                {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                        @endif" alt="product {{ $product->id }} image">
                                    </a>
                                <div class="down-content">
                                <h4>
                                    <a href="{{ $product->route_details() }}" style="font-size: 17px;color: #208dcc;">
                                    {{ $product['name_'.app()->getLocale()] }}
                                </a>

                                </h4>
                                <h6 style="left: 30px !important;right:auto !important;">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                <a href="{{ $product->route_details() }}" class="blog-one__meta-link">
                                    <del style="color: red;margin-{{app()->getLocale()=='ar'?'left':'right'}}: 20px;">{{ $product->price_before }} </del>
                                </a>
                                @endif
                                @endif
                              @if($product->get_current_offer() ?? false)
                                        <span>
                                        <a href="{{ $product->route_details() }}" class="blog-one__meta-link">
                                            <del style="color: grey">{{ $product->price }} {{ $product->getCurrency() }}</del>
                                        </a>
                                    </span>
                                        <span style="padding: 0 10px">
                                        <a href="{{ $product->route_details() }}" class="blog-one__meta-link">
                                            <span>{{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}</span>
                                        </a>
                                    </span>
                                    @else
                                        <a href="{{ $product->route_details() }}"
                                           class="blog-one__meta-link">{{ $product->price }} {{ $product->getCurrency() }}</a>
                                    @endif
                                </h6>
                                <p>{!! $product['content_'.app()->getLocale()] !!}</p>
                              </div>
                             <div class="btn-group btn-block">
                                    <a href="{{ $product->route_details() }}"
                                       class="btn btn-success mr-2 rounded background_buy_now_button">{{__('master.buy_now')}}</a>
                                    <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})" class="btn btn-primary mr-2 rounded background_add_to_cart_button">{{__('master.add_to_cart')}}</span>
                                </div>
                                </div>

                              </div>
                    @empty
                        <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                    @endforelse
                </div>
                <div style="width: 100%; {{ app()->getLocale() == 'ar' ? 'text-align:left' : 'text-align:right' }}">
                        @if(count($recent_pro) >= 1)
                            @if(app()->getLocale() == 'ar' )
                             <a class="btn btn-link" style="text-decoration:none;" href="{{ url('') }}/category/all">  <i class="fa fa-eye" ></i> رؤية المزيد ؟ </a>
                            @else
                              <a class="btn btn-link" style="text-decoration:none;" href="{{ url('') }}/category/all"> <i class="fa fa-eye"></i>  See More Products </a>
                            @endif
                        @endif
                </div>
            </div>
        </section>
    @endif



    <!-- about store -->
    <section class="container-fluid bg-white py-5">
        <div class="container mb-3">
            <div class="row d-flex justify-content-center align-items-center flex-column pb-4">
                <h4 class="text-secondary"> {{ __('store.why_us') }} </h4>
                <p class="text-muted" > {{ __('store.store_desc') }} </p>
            </div>
            <div class="row">
                <div class="col-lg-4 p-3">
                    <div class="d-flex flex-column justify-content-center align-items-center ">
                        <div
                                class="badge_info shadow-lg p-3 rounded-pill mb-3 d-flex flex-column align-items-center justify-content-center">
                            <i class="fa fa-truck text-white fa-fw fa-lg"></i>
                        </div>
                        <h4 class="text-secondary"> {{ __('store.ship') }} </h4>
                        <p class="text-muted" > {{ __('store.ship_desc') }} </p>
                    </div>
                </div>
                <div class="col-lg-4 p-3">
                    <div class="d-flex flex-column justify-content-center align-items-center ">
                        <div
                                class="badge_info shadow-lg p-3 rounded-pill mb-3 d-flex flex-column align-items-center justify-content-center">
                            <i class="fa fa-handshake-o text-white fa-fw fa-lg"></i>
                        </div>
                        <h6 class="text-secondary">{{ __('store.customer') }}</h6>
                        <p class="text-muted">{{ __('store.customer_desc') }} </p>
                    </div>
                </div>
                <div class="col-lg-4 p-3">
                    <div class="d-flex flex-column justify-content-center align-items-center ">
                        <div
                                class="badge_info shadow-lg p-3 rounded-pill mb-3 d-flex flex-column align-items-center justify-content-center">
                            <i class="fa fa-volume-control-phone text-white fa-fw fa-lg"></i>
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

    <script type="text/javascript" src="https://kenwheeler.github.io/slick/slick/slick.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.your-class').slick({

                autoplay:true,
                slidesToShow: 1,
                arrows: false,
                pauseOnHover:true,
                dots:false,
                @if (app()->getLocale() =='ar')
                rtl: true ,
                @endif
            });
        });
    </script>

@endsection
{{--Developed Saed Z. Sinwar--}}
