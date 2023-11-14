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
            <div class="row" style="padding: 1px;margin: 0px;">
                <div class="col-md-4 col-xs-12" >
                    <div class="box-content bordered primary min-height_card">
                        <input type="hidden" value="{{$order->id}}" id="order_id">
                        <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.order') }} #{{ $order->id }}</h4>
                        <table class="table table-hover no-margin">
                            <tbody>
                            <tr>
                                <td>{{ __('master.name') }}</td>
                                <td>
                                    <span>{{ (!empty($order->name)) ? $order->name : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.mobile') }}</td>
                                <td>
                                    <span>{{ (!empty($order->mobile )) ? $order->mobile  : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.address') }} </td>
                                <td>
                                    <span>{{ (!empty($order->address )) ? $order->address  : '-' }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
    
                <div class="col-md-8 col-xs-12">
                    <div class="box-content bordered primary min-height_card">
                        <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.order_details') }}</h4>
                        @if($cart['count'] != 0)
                            <h3 class="nowrap-overlay">
                                <strong>
                                    {{ $order->payment->data->cart->promo_code->code ?? ''}}
                                </strong>
                            </h3>
                            <table class="table table-hover no-margin" >
                                <tbody>
                                    <tr>
                                        <td>{{ __('master.count') }}</td>
                                        <td>{{ $cart['count'] ?? 0 }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>{{ __('master.subTotal') }}</td>
                                        <td>{{ $cart['subTotal'] ?? 0 }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>{{ __('master.Total') }}</td>
                                        <td>{{ $cart['Total'] ?? 0 }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>{{ __('master.Promo') }}</td>
                                        <td>{{ $cart['Promo'] ?? 0 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-hover no-margin" style="background-color: #eee;">
                                <tbody>
                                    @foreach($items as $item)
                                        <tr style="background-color: #9a33c7;color: white;">
                                            <td>{{ $loop->index + 1 }} - {{ __('master.name') }}</td>
                                            <td>{{ $item->name }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>{{ __('master.qty') }}</td>
                                            <td>{{ $item->qty }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>{{ __('master.price') }}</td>
                                            <td>{{ $item->price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                
                <div class="d-flex justify-content-center text-center">
                    <a href="{{route('dashboard.admin.orders.abandoned_orders')}}" class="btn btn-primary">
                        {{ __('master.back') }}
                   </a>
                </div>
            
            </div>
        </div>
       
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous"></script>
@endsection
