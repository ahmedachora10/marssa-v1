@extends('dashboard.master')

@section('orders_index')
    current active
@endsection
@section('head_tag')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" />
@endsection

@section('content')
    @if (session('message'))
        <div class="small-spacing">
            <div class="col-xs-12">
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ __('master.'.session('message')) }}</strong>
                </div>
            </div>
        </div>
    @endif
    <style>
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
    </style>
    <div id="order_div">
        <div class="col-xs-12"style="padding: 1px;margin: 0px;">
            <div class="d-flex justify-content-center text-center">
                <a href="{{route('dashboard.admin.landing_pages.orders')}}" class="btn btn-primary">
                    {{ __('master.back') }}
               </a>
            </div>
            <div class="row" style="padding: 1px;margin: 0px;">
    
        <div class="col-md-8 col-xs-12" style="padding: 0px;margin: 0px;padding-left: 3px;padding-right: 3px;">
            <div class="box-content bordered primary min-height table-responsive" style="padding: 10px;">
                <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.client') }} </h4>

                    <table class="table table-hover no-margin">
                            <tbody>
                            <tr>
                                <td>{{ __('master.name') }}</td>
                                <td>
                                    <span>{{ (!empty($order->name)) ? $order->name : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.address') }} </td>
                                <td>
                                    <span>{{ (!empty($order->address )) ? $order->address  : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.phone') }}</td>
                                <td>
                                    <span>{{ $order->mobile }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.orders') }}</td>
                                <td>
                                    {{ \App\ProductOfferOrder::where('mobile',$order->mobile)->count() }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                         <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.order_details') }} </h4>
                              <table class="table table-hover no-margin">
                        <tbody>
                             
                            <tr><td>{{ __('master.product_name') }}</td>
                                <td>{{ $order->product['name_'.app()->getLocale()] ?? '' }}{{--<a href="{{route('dashboard.admin.products.edit',$singleOrder->product ? $singleOrder->product->id : '')}}" style="white-space: normal;">
                                 --}}   {{--</a>--}}</td>
                            </tr>
                             
                            <tr><td>{{ __('master.amount') }}</td>
                                <td>{{ $order->amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                            <hr/>
                        <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.Total') }} </h4>
                        
                    <table class="table table-hover no-margin">
                        <tbody>
                            <tr><td><strong>{{__('master.Subtotal')}}</strong></td>
                                <td><strong>{{$order->amount}} {{ $order->currency }}</strong></td>
                            </tr>
                            {{--
                            <tr><td><strong>{{__('master.Shipping_fee')}}</strong></td>
                                <td><strong>{{$order->payment->data->cart->shipping}} {{ $order->currency }}</strong></td>
                            </tr>
                              @if(!empty($order->payment->data->cart->promo_code) && $order->payment->data->cart->promo_code->status)
                      
                            <tr><td><strong>{{__('master.promo_code')}}</strong></td>
                                <td><strong>{{$order->payment->data->cart->promo_code->discount}} {{ $order->currency }}</strong></td>
                            </tr>
                            @endif--}}
                            <tr><td><strong>{{__('master.total_price')}}</strong></td>
                                <td><strong>{{$order->amount}} {{ $order->currency }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                
                <table class="table table-condensed hidden">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>{{ __('master.product_name') }}</td>
                        <td class="text-center">{{ __('master.product_price') }}</td>
                        <td class="text-center">{{ __('master.order_quantity') }}</td>
                        <td class="text-center">{{ __('master.discount_offers') }}</td>
                        <td class="text-right">{{ __('master.Subtotal') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>
                                {{--<a href="{{route('dashboard.admin.products.edit',$singleOrder->product ? $singleOrder->product->id : '')}}">--}}
                                    {{ $order->product['name_'.app()->getLocale()] ?? '' }}{{--</a>--}}
                            </td>
                            <td class="text-center d-grid">
                                {{ $order->product->price ? $order->product->price : '' }} {{ $order->currency }}
                                {{ $order->product->price1 ? $order->product->price1 : '' }} {{ $order->currency }}
                                {{ $order->product->price2 ? $order->product->price2 : '' }} {{ $order->currency }}
                            </td>
                        </tr>
                    <tr>
                        <td class="thick-line"></td>
                        <td class="thick-line"></td>
                        <td class="thick-line"></td>
                        <td class="thick-line"></td>
                        <td class="thick-line text-center"><strong>{{__('master.Subtotal')}}</strong></td>
                        <td class="thick-line text-right">{{$order->amount}} {{ $order->currency }}</td>
                    </tr>
                    <tr>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        {{--<td class="no-line text-center"><strong>{{__('master.Shipping_fee')}}</strong></td>
                        <td class="no-line text-right">{{$order->payment->data->cart->shipping}} {{ $order->currency }}</td>--}}
                    </tr>
                     
                    <tr class="text-success">
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line text-center"><strong>{{__('master.total_price')}}</strong></td>
                        <td class="no-line text-right">{{$order->amount}} {{ $order->currency }}</td>
                    </tr>
                    </tbody>
                </table>
                {{--    <a class="btn btn-success btn-block" onclick="event.stopPropagation();"
                     target="_blank"
                       href="https://api.whatsapp.com/send?text={{ __('master.product_name') }} : *{{ $order->product['name_'.app()->getLocale()]  }}*  %0A{{ __('master.product_price') }} :  *{{ $order->amount }} {{$order->currency}}*  %0A 
                        %0A{{ __('master.client') }} : *{{ $order->name ?? 0 }} *
                        %0A{{ __('master.mobile') }} : *{{ $order->mobile }}*
                        %0A{{ __('master.address') }} : *{{ $order->address }}*
                       @if(!empty( $order->product->store->name)) %0A{{ __('master.store_name') }} : 
                       *{{ $order->product->store->name ?? '' }}* @endif
                        %0A{{ __('master.order_amount') }} : *{{ $order->payment->data->cart->total }} {{ $order->currency }}*
                        "><i class="fab fa-whatsapp"></i>
                    </a> --}}
            </div>
                                   
        </div>
            </div>
        </div>
        <div class="col-xs-12"style="padding: 0px;margin: 0px;padding-left: 3px;padding-right: 3px;">
            <div class="row" style="margin: 0px;padding: 0px;">
                @role('User|SubUser')
                <div class="col-md-6 col-xs-12" style="padding: 0px;margin: 0px;padding-left: 3px;padding-right: 3px;">
                    <div class="box-content bordered primary "style="padding: 10px;">
                        <form method="post" action="{{ route('dashboard.admin.landing_pages.orders.changeStatus',['id'=> $order->id]) }}">
                            @csrf
                            @method('put')
                            <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.order_status') }} #{{ $order->id }}</h4>
                            <ul class="list-inline text-center">
                                <li>
                                    <div class="radio warning">
                                        <input type="radio" name="status" id="radio-1" value="pend"
                                               @if($order->status == 'pend') checked @endif>
                                        <label for="radio-1">{{ __('master.Pending') }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio primary">
                                        <input type="radio" name="status" id="radio-2" value="accept"
                                               @if($order->status == 'accept') checked @endif>
                                        <label for="radio-2">{{ __('master.Accept') }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio success">
                                        <input type="radio" name="status" id="radio-3" value="process"
                                               @if($order->status == 'process') checked @endif>
                                        <label for="radio-3">{{ __('master.Process') }}</label>
                                    </div>
                                </li>
                            </ul>
                            <ul class="list-inline text-center">
                                {{--<li>
                                    <div class="radio info">
                                        <input type="radio" name="status" id="radio-4" value="3"
                                               @if($order->status == 3) checked @endif>
                                        <label for="radio-4">{{ __('master.Shipping') }}</label>
                                    </div>
                                </li>--}}
                                <li>
                                    <div class="radio ">
                                        <input type="radio" name="status" id="radio-5" value="deliverypayment"
                                               @if($order->status == 'deliverypayment') checked @endif>
                                        <label for="radio-5">{{ __('master.DeliveryPayment') }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio danger">
                                        <input type="radio" name="status" id="radio-6" value="cancel"
                                               @if($order->status == 'cancel') checked @endif>
                                        <label for="radio-6">{{ __('master.Cancel') }}</label>
                                    </div>
                                </li>
                            </ul>
                            <div class="form-group  @error('notes') has-error @enderror">
                            <textarea class="form-control" id="notes" rows="3" name="notes"
                                      placeholder="{{ __('master.order_records_notes_add') }}">{{$order->notes ?? old('notes') }}</textarea>
                                @error('notes')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
    
                            </div>
                            <div class="col-xs-12 margin-top-2 text-center">
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                                    {{ __('master.update_data') }}
                                </button>
                                <a class="btn btn-success btn-sm mx-1 px-3 text-white" onclick="DomImage();"title="{{__('master.export_img')}}">
                                        {{__('master.img')}}
                                    </a>
                            </div>
    
                        </form>
                    </div>
                </div>
                @endrole
                {{--
                <div style="padding: 0px;margin: 0px;padding-left: 3px;padding-right: 3px;"
                    class="@if(Auth::user()->getRoleNames()[0] == 'User' or Auth::user()->getRoleNames()[0] == 'SubUser') col-md-6 @else  @endif col-xs-12">
                    <div class="box-content bordered primary "style="padding: 10px;">
                        <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.order_records') }} #{{ $order->id }}</h4>
                        <table class="table table-hover table-sm no-margin">
                            <thead>
                            <tr>
                                <th>{{ __('master.order_status') }}</th>
                                <th width="70%">{{ __('master.notes') }}</th>
                                <th>{{ __('master.date') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_records as $item)
                                <tr>
                                    <td>
                                        @if($item->status == 0)
                                            <span class="notice notice-yellow">{{ __('master.Pending') }}</span>
                                        @elseif($item->status == 1)
                                            <span class="notice notice-blue">{{ __('master.Accept') }}</span>
                                        @elseif($item->status == 2)
                                            <span class="notice notice-blue">{{ __('master.Process') }}</span>
                                        @elseif($item->status == 3)
                                            <span class="notice notice-purple">{{ __('master.Shipping') }}</span>
                                        @elseif($item->status == 4)
                                            <span class="notice notice-green">{{ __('master.DeliveryPayment') }}</span>
                                        @elseif($item->status == 5)
                                            <span class="notice notice-danger">{{ __('master.Cancel') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <p>{{ $item->notes }}</p>
                                    </td>
                                    <td>
                                <span data-toggle="tooltip"
                                      data-placement="right"
                                      title="{{ Carbon\Carbon::parse($item->created_at)->toDateTimeString() }}">
                                    {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                --}}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"
    integrity="sha512-01CJ9/g7e8cUmY0DFTMcUw/ikS799FHiOA0eyHsUWfOetgbx/t6oV4otQ5zXKQyIrQGTHSmRVPIgrgLcZi/WMA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
        
function downloadURI(uri, name) {
        var link = document.createElement("a");
        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        //clearDynamicLink(link);
}
function DomImage(){
    var node = document.getElementById('order_div');
    //node.style.paddingLeft ='1rem';
     const filterNode = node => {
        if (node instanceof Text) {
            return true;
        }
        return !['img'].includes(node.tagName.toLowerCase()) || /^h[123456]$/i.test(node.tagName);
    };
    const scale = 2;
    this.shot_loading = true;
    /*     /* domtoimage.toJpeg(node, { quality: 0.95 }){ quality: 0.95 , filter: filterNode}bgcolor: 'white',
            ,filter: filterNode
    */
    domtoimage.toPng(node ,{ quality: 1 , filter: filterNode})
    .then(function (dataUrl) {
        downloadURI(dataUrl, `Order Number - ${$('#order_id').val()}.png` );
    })
    .catch(error => {
      console.log('there was an error', error);
    });
}
    </script>
@endsection
