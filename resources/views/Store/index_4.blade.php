@extends('Store.master_4')
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
        <h2 class="mb-0" style="color:#fff"> {{ $information->head_text }} </h2>
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

@if(!empty($slider))
<div class="container mb-3" style="max-height: 400px;
    overflow: hidden; ">
  <div class="your-class col-lg-12 bg-white shadow-sm">
    @foreach($slider as $slide)
        <div>
        <a style="width: inherit;" href="{{ $slide->link}}"><img style="    width: inherit;" src="{{url('/')}}/{{$slide->image}}"
        class="img-responsive"
        loading="lazy" ></a></div>
    @endforeach
  </div>
 </div>
@endif

  @if(isset($bestseller))
  <section class="container-fluid bg-light py-5" >
      <div class="container mb-3">
          <div class="row">
              <div class="col-6 mb-4">
                  <h3 class="text_primary mb-0"> {{ __('store.best_seller') }}</h3>
              </div>
              <!-- <div class="col-6"> </div> -->
          </div>
          <div class="row">
              <div class="col-lg-12 bg-white shadow-sm">
                  <div class="row m-0 py-4" >
                      @forelse($bestseller as $product)
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
                                    {{--  @if(!empty($getimg))
                                      <img class="img__item rounded w-100" height="250"
                                           src="{{ asset($getimg[array_rand($getimg,1)]) }}" alt="product {{ $product->id }} image">
                                          @endif --}}
                                          <img class="img__item rounded w-100" height="250"
                                           src="@if(!empty($product->featured_image) )
                                                {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                        @endif" alt="product {{ $product->id }} image">
                                       
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
      </div>
  </section>
  @endif
  @if(isset($recent_pro))
  <section class="container-fluid bg-light py-5" >
      <div class="container mb-3">
          <div class="row">
              <div class="col-6 mb-4">
                  <h3 class="text_primary mb-0"> {{ __('store.recent_products') }}</h3>
              </div>
              <!-- <div class="col-6"> </div> -->
          </div>
          <div class="row">
              <div class="col-lg-12 bg-white shadow-sm">
                  <div class="row m-0 py-4" >
                      @forelse($recent_pro as $product)
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
                                     {{-- @if(!empty($getimg))
                                      <img class="img__item rounded w-100" height="250"
                                           src="{{ asset($getimg[array_rand($getimg,1)]) }}" alt="product {{ $product->id }} image">
                                       @endif --}}
                                          <img class="img__item rounded w-100" height="250"
                                           src="@if(!empty($product->featured_image) )
                                                {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                        @endif" alt="product {{ $product->id }} image">
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
      </div>
  </section>
  @endif
  @if(isset($products))
<!-- last product -->
 <section class="container-fluid bg-light py-5" >
   <div class="container mb-3">
      <div class="row">
         <div class="col-6 mb-4">
            <h3 class="text_primary mb-0"> {{ __('store.latest_products') }}</h3>
         </div>
         <!-- <div class="col-6"> </div> -->
      </div>
      <div class="row">
         <div class="col-lg-12 bg-white shadow-sm">
            <div class="row m-0 py-4" >
            @forelse($products as $product)
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
                        {{-- @if(!empty($getimg))
                     <img class="img__item rounded w-100" height="250"
                     src="{{ asset($getimg[array_rand($getimg,1)]) }}" alt="product {{ $product->id }} image">
                         @endif --}}
                                          <img class="img__item rounded w-100" height="250"
                                           src="@if(!empty($product->featured_image) )
                                                {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                        @endif" alt="product {{ $product->id }} image">
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
                <!--<div class="text-center">-->
                <!--                <a  href="{{ url('') }}/category/all">-->
                <!--                                  @if(app()->getLocale() == 'ar')-->
                <!--                                    جميع المنتجات-->
                <!--                                  @else-->
                <!--                                    All Products-->
                <!--                                  @endif-->
                <!--                                </a>-->
                <!--            </div>-->
            </div>
            <div class="row m-0 justify-content-center pb-4">
            {{-- $products->links() --}}
            </div>
         </div>
      </div>
   </div>
</section>
<!-- about store -->
 @endif



 @if(isset($recent_pro))
  <section class="container-fluid bg-light py-5" >
      <div class="container mb-3">
          <div class="row">
              <div class="col-6 mb-4">
                  <h3 class="text_primary mb-0">  <span>  @if(app()->getLocale() == 'ar') جميع المنتجات  @else   All Products @endif  </span></h3>
              </div>
              <!-- <div class="col-6"> </div> -->
          </div>
          <div class="row">
              <div class="col-lg-12 bg-white shadow-sm">
                  <div class="row m-0 py-4" >
                      @forelse($recent_pro->take(3) as $product)
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
                                    {{--  @if(!empty($getimg))
                                      <img class="img__item rounded w-100" height="250"
                                           src="{{ asset($getimg[array_rand($getimg,1)]) }}" alt="product {{ $product->id }} image">
                                       @endif --}}
                                          <img class="img__item rounded w-100" height="250"
                                           src="@if(!empty($product->featured_image) )
                                                {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                        @endif" alt="product {{ $product->id }} image">
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
