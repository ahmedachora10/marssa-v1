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
                <a href="{{route('dashboard.admin.orders.index')}}" class="btn btn-primary">
                    {{ __('master.back') }}
               </a>
            </div>
            <div class="row" style="padding: 1px;margin: 0px;">
                <div class="col-md-3 col-xs-12 hidden" >
                    <div class="box-content bordered primary min-height_card">
                        <input type="hidden" value="{{$order->id}}" id="order_id">
                        <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.client') }} #{{ $order->client->id }}</h4>
                       {{-- <div class="profile-avatar">
                            <h3 class="nowrap-overlay" style="margin: 5px;">
                                <strong>{{ (!empty($order->client->name)) ? $order->client->name : '-' }}</strong>
                            </h3>
                        </div> --}}
                        <table class="table table-hover no-margin">
                            <tbody>
                            <tr>
                                <td>{{ __('master.name') }}</td>
                                <td>
                                    <span>{{ (!empty($order->client->name)) ? $order->client->name : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.email') }}</td>
                                <td>
                                    <span>{{ (!empty($order->client->email )) ? $order->client->email  : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.address') }} </td>
                                <td>
                                    <span>{{ (!empty($order->client->address )) ? $order->client->address  : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.phone') }}</td>
                                <td>
                                    <span>{{ $order->client->mobile }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.orders') }}</td>
                                <td>
                                    {{ count($order->client->orders) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        @if($order->payment->data->note)
                            <hr>
                            {{ __('master.more_details') }}
                            <textarea class="form-control" readonly>{{ $order->payment->data->note }}</textarea>
                        @endif
                    </div>
                </div>
    
                <div class="col-md-4 col-xs-12 hidden">
                    <div class="box-content bordered primary min-height_card">
                        <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.promo_code') }}</h4>
                        @if(!empty($order->payment->data->cart->promo_code) && $order->payment->data->cart->promo_code->status)
                            <h3 class="nowrap-overlay">
                                <strong>
                                    {{ $order->payment->data->cart->promo_code->code ?? ''}}
                                </strong>
                            </h3>
                            <table class="table table-hover no-margin" >
                                <tbody>
                                <tr>
                                    <td>{{ __('master.discount') }}</td>
                                    <td>
                                    <span>
                                        {{ $order->payment->data->cart->promo_code->discount}} {{ $order->currency }}
                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('master.offer_start') }}</td>
                                    <td>{{ Carbon\Carbon::parse($coupon->start)->toDateTimeString() }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('master.offer_end') }}</td>
                                    <td>{{ Carbon\Carbon::parse($coupon->end)->toDateTimeString() }}</td>
                                </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="text-center">
                                <p><i class="fas fa-cut fa-5x empty margin-top-40 margin-bottom-30"></i></p>
                                <p>
                                    @if(app()->getLocale() == 'ar') {{ __('master.not_use')  }} @endif
                                    {{ __('master.promo_code') }}
                                    @if(app()->getLocale() == 'en') {{ __('master.not_use')  }} @endif
                                </p>
                            </div>
                        @endif
    
                    </div>
                </div>
        <div class="col-md-8 col-xs-12" style="padding: 0px;margin: 0px;padding-left: 3px;padding-right: 3px;">
            <div class="box-content bordered primary min-height table-responsive" style="padding: 10px;">
                <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.order_details') }} {{--#{{ $order->client->id }}--}}</h4>
                       {{-- <div class="profile-avatar">
                            <h3 class="nowrap-overlay">
                                <strong>{{ (!empty($order->client->name)) ? $order->client->name : '-' }}</strong>
                            </h3>
                        </div>--}}
                        <table class="table table-hover no-margin">
                            <tbody>
                            <tr>
                                <td>{{ __('master.name') }}</td>
                                <td>
                                    <span>{{ (!empty($order->client->name)) ? $order->client->name : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.email') }}</td>
                                <td>
                                    <span>{{ (!empty($order->client->email )) ? $order->client->email  : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.address') }} </td>
                                <td>
                                    <span>{{ (!empty($order->client->address )) ? $order->client->address  : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.phone') }}</td>
                                <td> <span>{{ $order->client->mobile }}</span>
                            </tr>
                            <tr id="order_confirm_via_whatsapp">
                                <td>{{__('master.order_confirm_via_whatsapp')}}</td>
                                <td>
                    <a class="btn btn-success btn-sm" onclick="event.stopPropagation();"
                     target="_blank"
                       href="https://wa.me/{{$order->client->mobile}}"><i class="fab fa-whatsapp"></i></a></td>
                            </tr>
                                
                            <tr>
                                <td>{{ __('master.orders') }}</td>
                                <td>
                                    {{ count($order->client->orders) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        @if($order->payment->data->note)
                            <hr>
                            {{ __('master.more_details') }}
                            <textarea class="form-control" readonly>{{ $order->payment->data->note }}</textarea>
                        @endif
                        <hr/>
                        <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.products') }} </h4>
                    @foreach($orders as $singleOrder)
                    <table class="table table-hover no-margin">
                        <tbody>
                             {{--@if($orders->count()==1)
                            <tr><td>#</td>
                                <td>{{$singleOrder->id}}</td>
                            </tr>
                            @endif--}}
                            <tr><td>{{ __('master.product_name') }}</td>
                                <td><a href="{{route('dashboard.admin.products.edit',$singleOrder->product ? $singleOrder->product->id : '')}}" style="white-space: normal;">
                                    {{ $singleOrder->product['name_'.app()->getLocale()] ?? '' }} 
                                    @if(!empty($singleOrder->variant) && $singleOrder->variant!='single'){{' - '}} {{$singleOrder->variant}} @endif
                                    </a></td>
                            </tr>
                            <tr><td>{{ __('master.product_price') }}</td>
                                <td>@if($singleOrder->product)
                                
                                @if( $singleOrder->product->type=='single')
                                {{$singleOrder->product->price   }} {{$singleOrder->currency}}
                                @else 
                                @if(!empty($singleOrder->variant_id))
                                {{\App\ProductVariations::select('price')->find($singleOrder->variant_id) ->price}} {{$singleOrder->currency}}</td>
                                @else
                                
                                {{$singleOrder->product->price   }} {{$singleOrder->currency}}
                                
                                @endif
                                @endif
                                @endif
                            </tr>
                             @if($orders->count()==1)
                            @endif
                            <tr><td>{{ __('master.order_quantity') }}</td>
                                <td>{{ $singleOrder->quantity }}</td>
                            </tr>
                             @if($orders->count()==1)
                            <tr><td>{{ __('master.discount_offers') }}</td>
                                <td>@if($singleOrder->offer ?? false)
                                    <a href="{{route('dashboard.admin.offers.edit',$singleOrder->offer->id)}}">{{ $singleOrder->offer->discount }} {{ $singleOrder->currency }}</a>
                                @else
                                    <span>0 {{ $singleOrder->currency }}</span>
                                @endif</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    
                @endforeach
                @if($orders->count()>0)
                  @if(!empty($order->payment->data->cart->promo_code) && $order->payment->data->cart->promo_code->status)
                      
                <hr/>
                <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.promo_code') }}</h4>
                            <h3 class="nowrap-overlay">
                                <strong>
                                    {{ $order->payment->data->cart->promo_code->code ?? ''}}
                                </strong>
                            </h3>
                            <table class="table table-hover no-margin" >
                                <tbody>
                                <tr>
                                    <td>{{ __('master.discount') }}</td>
                                    <td>
                                    <span>
                                        {{ $order->payment->data->cart->promo_code->discount}} {{ $order->currency }}
                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('master.offer_start') }}</td>
                                    <td>{{ Carbon\Carbon::parse($coupon->start)->toDateTimeString() }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('master.offer_end') }}</td>
                                    <td>{{ Carbon\Carbon::parse($coupon->end)->toDateTimeString() }}</td>
                                </tr>
                                </tbody>
                            </table>
                        {{--@else
                            <div class="text-center">
                                {{--<p><i class="fas fa-cut fa-5x empty margin-top-40 margin-bottom-30"></i></p>--}}
                                <p>
                                    @if(app()->getLocale() == 'ar') {{ __('master.not_use')  }} @endif
                                    {{ __('master.promo_code') }}
                                    @if(app()->getLocale() == 'en') {{ __('master.not_use')  }} @endif
                                </p>
                            </div>--}}
                        @endif
                        
                            <hr/>
                        <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.Total') }} </h4>
                        
                    <table class="table table-hover no-margin">
                        <tbody>
                            <tr><td><strong>{{__('master.Subtotal')}}</strong></td>
                                <td><strong>{{$order->payment->data->cart->subtotal}} {{ $order->currency }}</strong></td>
                            </tr>
                            <tr><td><strong>{{__('master.Shipping_fee')}}</strong></td>
                                <td><strong>{{$order->payment->data->cart->shipping}} {{ $order->currency }}</strong></td>
                            </tr>
                              @if(!empty($order->payment->data->cart->promo_code) && $order->payment->data->cart->promo_code->status)
                      
                            <tr><td><strong>{{__('master.promo_code')}}</strong></td>
                                <td><strong>{{$order->payment->data->cart->promo_code->discount}} {{ $order->currency }}</strong></td>
                            </tr>
                            @endif
                            <tr><td><strong>{{__('master.total_price')}}</strong></td>
                                <td><strong>{{$order->payment->data->cart->total}} {{ $order->currency }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                
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
                    @foreach($orders as $singleOrder)
                        <tr>
                            <td>{{$singleOrder->id}}</td>
                            <td>
                                <a href="{{route('dashboard.admin.products.edit',$singleOrder->product ? $singleOrder->product->id : '')}}">{{ $singleOrder->product['name_'.app()->getLocale()] ?? '' }}</a>
                            </td>
                            <td class="text-center">
                                {{ $singleOrder->product ? $singleOrder->product->price : '' }} {{ $singleOrder->currency }}
                            </td>
                            <td class="text-center">
                                {{ $singleOrder->quantity }}
                            </td>
                            <td class="text-center">
                                @if($singleOrder->offer ?? false)
                                    <a href="{{route('dashboard.admin.offers.edit',$singleOrder->offer->id)}}">{{ $singleOrder->offer->discount }} {{ $singleOrder->currency }}</a>
                                @else
                                    <span>0 {{ $singleOrder->currency }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                @if($singleOrder->offer ?? false)
                                    <span>{{ ($singleOrder->offer->discount *  $singleOrder->quantity) }} {{ $singleOrder->currency }}</span>
                                @else
                                    <span>{{ ( ($singleOrder->product ? $singleOrder->product->price : 0) *  $singleOrder->quantity) }} {{ $singleOrder->currency }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="thick-line"></td>
                        <td class="thick-line"></td>
                        <td class="thick-line"></td>
                        <td class="thick-line"></td>
                        <td class="thick-line text-center"><strong>{{__('master.Subtotal')}}</strong></td>
                        <td class="thick-line text-right">{{$order->payment->data->cart->subtotal}} {{ $order->currency }}</td>
                    </tr>
                    <tr>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line text-center"><strong>{{__('master.Shipping_fee')}}</strong></td>
                        <td class="no-line text-right">{{$order->payment->data->cart->shipping}} {{ $order->currency }}</td>
                    </tr>
                      @if(!empty($order->payment->data->cart->promo_code) && $order->payment->data->cart->promo_code->status)
                          <tr class="text-danger">
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td class="no-line text-center">
                                <strong>{{__('master.discount')}} {{__('master.promo_code')}}</strong></td>
                            <td class="no-line text-right">{{$order->payment->data->cart->promo_code->discount}} {{ $order->currency }}</td>
                        </tr>
                    @endif
                    <tr class="text-success">
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line text-center"><strong>{{__('master.total_price')}}</strong></td>
                        <td class="no-line text-right">{{$order->payment->data->cart->total}} {{ $order->currency }}</td>
                    </tr>
                    </tbody>
                </table>
                    <a class="btn btn-success btn-block" onclick="event.stopPropagation();"
                     target="_blank"
                       href="https://api.whatsapp.com/send?text= @foreach($orders as $order1) {{ __('master.product_name') }} : @if(!empty($order1->product['name_'.app()->getLocale()])) *{{ $order1->product['name_'.app()->getLocale()]  }}* @endif
                        %0A{{ __('master.order_quantity') }} : *{{ $order1->quantity }}*
                      @if(!empty($order->product->price))  %0A{{ __('master.product_price') }} : *{{ $order1->product->price }} $* @endif %0A @endforeach
                        %0A{{ __('master.order_discount') }} : *{{ $order->discount ?? 0 }} {{ $order->currency }}*
                        %0A{{ __('master.mobile') }} : *{{ $order->client->mobile }}*
                        %0A{{ __('master.address') }} : *{{ $order->client->address }}*
                       @if(!empty( $order->product->store->name)) %0A{{ __('master.store_name') }} : *{{ $order->product->store->name ?? '' }}* @endif
                        %0A{{ __('master.order_amount') }} : *{{ $order->payment->data->cart->total }} {{ $order->currency }}*
                        "><i class="fab fa-whatsapp"></i>
                    </a>
            </div>
                                   
        </div>
                <div class="col-md-4 col-xs-12"style="padding: 0px;margin: 0px;padding-left: 3px;padding-right: 3px;">
                    <div class="box-content bordered primary min-height_card" style="padding: 10px;">
                        {{--<h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.client') }} #{{ $order->client->id }}</h4>
                        <div class="profile-avatar">
                            <h3 class="nowrap-overlay">
                                <strong>{{ (!empty($order->client->name)) ? $order->client->name : '-' }}</strong>
                            </h3>
                        </div>
                        <table class="table table-hover no-margin">
                            <tbody>
                            <tr>
                                <td>{{ __('master.name') }}</td>
                                <td>
                                    <span>{{ (!empty($order->client->name)) ? $order->client->name : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.email') }}</td>
                                <td>
                                    <span>{{ (!empty($order->client->email )) ? $order->client->email  : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.address') }} </td>
                                <td>
                                    <span>{{ (!empty($order->client->address )) ? $order->client->address  : '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.phone') }}</td>
                                <td>
                                    <span>{{ $order->client->mobile }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.orders') }}</td>
                                <td>
                                    {{ count($order->client->orders) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        @if($order->payment->data->note)
                            <hr>
                            {{ __('master.more_details') }}
                            <textarea class="form-control" readonly>{{ $order->payment->data->note }}</textarea>
                        @endif
                            <hr/>--}}
                        <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.payments') }} #{{$order->payment->id}}</h4>
                        <table class="table table-hover no-margin">
                            <tbody>
                            <tr>
                                <td>{{ __('master.payment_method') }}</td>
                                <td>
                                    <span>
                                        {{__('master.'.@$order->payment->data->type)}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.payment_status') }}</td>
                                <td><span
                                        class="badge badge-{{ payment_status($order->payment->status,true) }}">{{ payment_status($order->payment->status) }}</span>
                                </td>
                            </tr>
    
                            <tr>
                                <td>{{ __('master.branch') }}</td>
                                <td><span >{{ $order->payment->branch->name ?? '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.Total') }}</td>
                                <td><span>{{ $order->payment->data->cart->total }} {{$order->payment->data->cart->currency}}</span>
                                </td>
                            </tr>
                            @if($order->payment->data->type == 'Bankily')
                                <tr>
                                    <td>
    
                                        @if(app()->getLocale() == 'ar')
                                            رقم التحويل
                                        @else
                                            Transaction Number
                                        @endif
    
                                    </td>
                                    <td><span> {{ $order->payment->data->transaction_number }} </span>
                                    </td>
                                </tr>
                            @endif
    
    
    
                            <tr>
                                <td>{{ __('master.payment_date') }}</td>
                                <td>{{ Carbon\Carbon::parse($order->payment->created_at)->toDateTimeString() }}</td>
                            </tr>
                            </tbody>
                        </table>
                        @if(isset($order->payment->data->img))
                            <hr>
                                <a class="btn btn-danger btn-block" href="{{asset($order->payment->data->img)}}" data-lightbox="roadtrip">{{__('master.preview')}} {{__('master.transfer_proof')}}</a>
                        @endif
                        @if(isset($order->payment->data->paypal_details))
                            <hr>
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                {{__('master.paypal_payment_details')}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <table class="table table-hover no-margin">
                                                <tbody>
                                                <tr>
                                                    <td>Payment ID</td>
                                                    <td>
                                                        <span>
                                                            {{$order->payment->data->paypal_details->pay_id}}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Token</td>
                                                    <td>
                                                        <span>
                                                            {{$order->payment->data->paypal_details->token}}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Payer ID</td>
                                                    <td>
                                                        <span>
                                                            {{$order->payment->data->paypal_details->PayerID}}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>{{__('master.total_in_usd')}}</td>
                                                    <td>
                                                        <span>
                                                            {{$order->payment->data->paypal_details->amount_total}}
                                                        </span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <form method="post" action="{{route('dashboard.admin.update_order_status',$order->payment->id)}}">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="status">حالة عملية الدفع</label>
                                <select id="status" name="status" class="form-control">
                                    @foreach(payment_status() as $key => $status)
                                        <option
                                            value="{{$key}}" {{($key == $order->payment->status) ? 'selected' : ''}}>{{payment_status($key)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning btn-block">تغير حالة العملية</button>
                        </form>
                    </div>
                    <div class="box-content bordered primary min-height_card" style="padding: 10px;">
                        <form method="post" action="{{route('dashboard.merchant.competition_order_attach_customer',$order->id)}}">
                            @csrf
                            @method('post')
                            <p class="alert alert-info">
                                قم باضافة الزبون الى المسابقة  
                            </p>
                            <div class="form-group">
                                <label for="status">المسابقات</label>
                                <select id="status" name="competition_id" class="form-control" required>
                                    <option value="">لم يحدد</option>
                                    @foreach($competitions as $competition)
                                        <option value="{{ $competition->id }}" @if(count($competitior_competitions) > 0 ) @if(in_array($competition->id,$competitior_competitions)) selected @endif @endisset>{{ $competition->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info btn-block">
                                اضافة الزبون للمسابقة
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12"style="padding: 0px;margin: 0px;padding-left: 3px;padding-right: 3px;">
            <div class="row" style="margin: 0px;padding: 0px;">
                @role('User|SubUser')
                <div class="col-md-6 col-xs-12" style="padding: 0px;margin: 0px;padding-left: 3px;padding-right: 3px;">
                    <div class="box-content bordered primary "style="padding: 10px;">
                        <form method="post" action="{{ route('dashboard.admin.orders.order_update',['id'=> $order->id]) }}">
                            @csrf
                            <h4 class="box-title" style="margin-bottom: 10px;">{{ __('master.order_status') }} #{{ $order->id }}</h4>
                            <ul class="list-inline text-center">
                                <li>
                                    <div class="radio warning">
                                        <input type="radio" name="status" id="radio-1" value="0"
                                               @if($order->status > 0) disabled @endif
                                               @if($order->status == 0) checked @endif>
                                        <label for="radio-1">{{ __('master.Pending') }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio primary">
                                        <input type="radio" name="status" id="radio-2" value="1"
                                               @if($order->status > 1) disabled @endif
                                               @if($order->status == 1) checked @endif>
                                        <label for="radio-2">{{ __('master.Accept') }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio success">
                                        <input type="radio" name="status" id="radio-3" value="2"
                                               @if($order->status > 2) disabled @endif
                                               @if($order->status == 2) checked @endif>
                                        <label for="radio-3">{{ __('master.Process') }}</label>
                                    </div>
                                </li>
                            </ul>
                            <ul class="list-inline text-center">
                                <li>
                                    <div class="radio info">
                                        <input type="radio" name="status" id="radio-4" value="3"
                                               @if($order->status > 3) disabled @endif
                                               @if($order->status == 3) checked @endif>
                                        <label for="radio-4">{{ __('master.Shipping') }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio ">
                                        <input type="radio" name="status" id="radio-5" value="4"
                                               @if($order->status > 4) disabled @endif
                                               @if($order->status == 4) checked @endif>
                                        <label for="radio-5">{{ __('master.DeliveryPayment') }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio danger">
                                        <input type="radio" name="status" id="radio-6" value="5"
                                               @if($order->status == 5) checked @endif>
                                        <label for="radio-6">{{ __('master.Cancel') }}</label>
                                    </div>
                                </li>
                            </ul>
                            <div class="form-group  @error('notes') has-error @enderror">
                            <textarea class="form-control" id="notes" rows="3" name="notes"
                                      placeholder="{{ __('master.order_records_notes_add') }}">{{ old('notes') }}</textarea>
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
    $('#order_confirm_via_whatsapp').addClass('hidden');
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
    $('#order_confirm_via_whatsapp').removeClass('hidden');
        
    })
    .catch(error => {
      console.log('there was an error', error);
    });
    
}
    </script>
@endsection
