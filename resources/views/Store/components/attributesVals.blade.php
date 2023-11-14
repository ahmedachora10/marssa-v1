@if(count($variants))
    @foreach ($variants as $ind=>$variant).
        @isset($variant)
            <div class="d-flex justify-content-between">
                <div style="display:grid;width: 100%;">
                   {{$variant->name}}
                     <input type="hidden" id="selectedVarinat" name="selectedVarinat" value="{{$variant->name}}" class="form-control">
                     <input type="hidden" id="selectedVarinatId" name="selectedVarinatId" value="{{$variant->id}}" class="form-control">
                   <div>
                        {{__('master.price')}}
                        <span id="selling_price">
                            <input type="hidden" id="selectedPrice" name="selectedPrice" value="{{$variant->price}}" class="form-control">
                           <span class="text-danger" >{{$variant->price}}</span>  {{$currency}}
                        </span>
                    </div>
                    <div >
                        <span id="total"></span> 
                    </div>
                </div>
            </div>
        @endisset
    @endforeach

    <hr/>
    <div style="display:inline-flex;justify-content:space-between;width:100%;">
        <div class="row p-2 align-items-center">
            <div class=" d-flex flex-nowrap p-2 align-items-center px-1 w-100">
                <span class="text-muted px-2">{{ $variant?->sku }} </span>
                <div class="quantity d-flex flex-nowarp align-items-center">
                 <span id="quantity1" class="count quantity-count mx-2">
                 {{ __('store.product_available') }}
                 </span>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="{{$variant?->product_id }}" id="product">
        <div class="product-section add-to-cart-section">
            <div class="form-group quantity "style="color:black">
                <span class="minus quantity-handler quantity-handler-left">-</span>
                <input class="quantity_counter single-quantity" id="quantity" name="quantity" min="1" max="{{ $variant?->sku }}" type="number" value="1"/>
                <span class=" quantity-handler quantity-handler-right plus">+</span>
            </div>
        </div>
    </div>  

@endif