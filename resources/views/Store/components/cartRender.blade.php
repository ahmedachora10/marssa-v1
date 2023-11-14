
@foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
    <li class=" cart-item" style=""
        id="<?php echo $row->rowId; ?>">

        @isset($row->options['image'])
            <img src="{{asset($row->options['image'])}}" alt="{{$row->name}}"
                 class="item-thumbnail">
        @endisset
        <div class="item-body">
            <div class="item-details">
                <h3>
                    <a href="javascript:void(0)"> <?php echo $row->name; ?> <!----></a>
                </h3>
                <input hidden
                       onchange="CartAction('{{$row->options['update_url']}}','{{$row->rowId}}')"
                       id="qty_{{$row->rowId}}" name="quant[<?php echo $row->rowId; ?>]"
                       class="form-control input-number"
                       value="<?php echo $row->qty; ?>" min="1" max="10">
                <div class="quantity-wrapper">
                    <span class="quantity"> 	الكمية <small><?php echo $row->qty; ?></small></span>
                    <span class="currency-value"><span
                                class="value"><?php echo $row->price; ?> </span>
    					                    <span class="currency">&nbsp; </span>
    					                    </span>
                </div>
            </div>

        </div>
        <div class="item-actions">
            <button onclick="CartAction('{{$row->options['update_url']}}','{{$row->rowId}}','update')"
                    type="button"><i class="yc yc-edit"></i></button>
            <button onclick="CartAction('{{$row->options['delete_url']}}','{{$row->rowId}}','delete')"
                    type="button"><i class="yc yc-trash"></i></button>
        </div>
    </li>
@endforeach
