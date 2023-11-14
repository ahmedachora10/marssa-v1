{{--{{dd(app()->getLocale())}}--}}
{{--{{dd(app()->getLocale(),\Session::get('locale'))}}--}}
@extends('Store.master_1')
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

    <section class="blog-one" id="products">
        <div class="container">
            <div class="mb-5">
                <h3 class="title-section">
                    <span>{{ __('master.products') }}</span>
                </h3>
            </div>
            <div class="row">
                <div class="clearfix"></div>
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
                    <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="blog-one__single">
                            <div class="blog-one__image">
                                <a href="{{ $product->route_details() }}" class="image_center">
                                 {{--<img src="{{ asset($getimg[array_rand($getimg,1)]) }}" alt="product {{ $product->id }} image">--}}
                                    <img src="@if(!empty($product->featured_image) )
                                                {{ asset($product->featured_image) }}
                                                @elseif(!empty($product->firstImage()))
                                                {{asset($product->firstImage())}}
                                         @else
                                                 https://semantic-ui.com/images/wireframe/image.png
                                        @endif" alt="product {{ $product->id }} image">
                                </a>
                                <a class="blog-one__more-link" href="{{ $product->route_details() }}">
                                    <i class="fa fa-cart-plus fa-4x"></i>
                                </a>
                            </div>
                            <div class="blog-one__content">
                                <a href="{{ $product->route_details() }}" style="display: block;padding-bottom: 0">
                                    <ul class="list-unstyled blog-one__meta">
                                        @if($product->get_current_offer() ?? false)
                                            <li>
                                                <span><del class="prev-price">{{ $product->price }} {{ $product->getCurrency() }}</del></span>
                                                <span class="price">{{ $product->get_current_offer()->discount }} {{ $product->getCurrency() }}</span>
                                            </li>
                                        @else
                                            <li>
                                                <span class="price">{{ $product->price }} {{ $product->getCurrency() }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                    <h3 class="blog-one__title">
                                        {{ $product['name_'.app()->getLocale()] }}
                                    </h3>

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
            <div class="pagination" style="margin-bottom: 20px">
                {{ $products->links() }}
            </div>
        </div>
    </section>
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
