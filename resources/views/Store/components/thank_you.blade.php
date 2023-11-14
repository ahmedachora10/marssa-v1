<section class="blog-one" id="products">
    <div class="container">
        <div class="row">
            <div class="col-md-12 jumbotron" style="padding: 1rem 2rem;">
                <div class="text-center">
                    <h1 class="display-3" style="font-size: 2.5rem;"><i class="fa fa-check-circle text-success"></i>
                    </h1>
                    <p class="lead"
                       style="line-height: 125%;">{{__('master.thank_you')}} {{__('master.We have successfully received your order, thank you again')}}</p>
                    <br>
                    <p class="lead" style="line-height: 5%;">{{__('master.Order Number')}}
                        <code>#{{__($orders[0]->order_id)}}</code></p>
                    <hr>
                    @if (isset($store->thanksNote->value))
                        <p class="lead" style="line-height: 5%;"><code> {{  $store->thanksNote->value  }}</code></p>
                        <hr>
                    @endif
                    <div class="row">

                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{__('master.product_image')}}</th>
                                    <th>{{__('master.product_name')}}</th>
                                    <th>{{__('master.product_quantity')}}</th>
                                    <th>{{__('master.product_price')}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>
                                            @isset($order->product->image[0])
                                                <img style="width: 50px" src="{{$order->product->image[0]}}">
                                            @endisset
                                        <td>{{$order->product['name_'.app()->getLocale()]}}  {{$order->variant !='single' ? ' - '. $order->variant  : ''}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>@if($order->product->type =="single")
                                        {{$order->product->price }}
                                        {{$order->currency}} 
                                        @else
                                        @if(!empty($order->variant_id))
                                            {{\App\ProductVariations::select('price')->find($order->variant_id) -> price}} {{$order->currency}}
                                        @else
                                            {{$order->product->price }}
                                        {{$order->currency}} 
                                        @endif                                        
                                        @endif</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-danger text-center">{{__('master.no_data')}}</div>
                                        </td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-bordered">
                                <tfoot class="text-center">
                                <tr>
                                    <td>{{ __('master.Subtotal') }}</td>
                                    <td colspan="2"
                                        id="subTotal">{{$orders[0]->payment->data->cart->subtotal}} {{$orders[0]->payment->data->cart->currency}}</td>
                                </tr>
                                @if(!empty($orders[0]->payment->data->cart->promo_code->discount))
                                <tr>
                                    <td>{{ __('master.discount') }}</td>
                                    <td colspan="2"
                                        id="Promo">{{$orders[0]->payment->data->cart->promo_code->discount}} {{$orders[0]->payment->data->cart->currency}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>{{__('master.Shipping_fee')}}</td>
                                    <td colspan="2"
                                        id="shipping">{{$orders[0]->payment->data->cart->shipping}} {{$orders[0]->payment->data->cart->currency}}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('master.Total') }}</td>
                                    <td colspan="2">
                                        <span id="Total">{{$orders[0]->payment->data->cart->total}} {{$orders[0]->payment->data->cart->currency}}</span>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <section class="container-fluid bg-light py-5">
                            <div class="container mb-3">
                                <div class="row">
                                    <div class="col-lg-12 bg-white shadow-sm">
                                        <div class="row m-0 py-4">
                                            @forelse($pro as $product)
                                                <?php
                                                $getimg = array();

                                                if (isset($product->image)) {
                                                    foreach ($product->image as $img) {
                                                        $last = last(explode('.', $img));
                                                        if (in_array($last, ["jpg", "png", "gif"])) {
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
                                                                     src="{{ asset($getimg[array_rand($getimg,1)]) }}"
                                                                     alt="product {{ $product->id }} image">
                                                            @endif
                                                        </a>
                                                        <a class="text-decoration-none text-secondary"
                                                           href="{{ $product->route_details() }}">
                                                            <h6 class="py-2 mb-0">  {{ $product['name_'.app()->getLocale()] }} </h6>
                                                        </a>
                                                        <div class="text-light">
                                                            <h5 class="text-danger font-weight-bold">
                                                                {{$product->price}} {{ $product->getCurrency() }}
                                                             {{--   @if($product->type =='single') 
                                                                @else 
                                                                    @foreach($product->variations as $index=>$vari)
                                                                    <span >  {{$vari->price}} {{ $product->getCurrency() }}</span>
                                                                    @endforeach
                                                                @endif  
                                                                --}}
                                                                <small>
                                                                    <del class="text-secondary">
                                                                        @if($product->get_current_offer() ?? false)
                                                                            {{ $product->get_current_offer()->discount }} {{ $product->getCurrency() }}
                                                                        @endif
                                                                    </del>
                                                                </small>
                                                            </h5>
                                                        </div>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="{{ $product->route_details() }}"
                                                               class="background_buy_now_button btn btn-success mr-2 rounded  text-success">{{__('master.buy_now')}}</a>
                                                            <span onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"
                                                                  class="btn btn-primary mr-2 rounded background_add_to_cart_button"><i
                                                                        class="fa fa-shopping-basket"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="lead"
                                                   style="text-align: center"> {{ __('master.no_data') }}</p>
                                            @endforelse

                                        </div>
                                        <div class="row m-0 justify-content-center pb-4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="lead">
                                <a class="btn btn-primary btn-sm" href="{{url('/')}}"
                                   role="button">{{__('store.goHome')}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
