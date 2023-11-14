@extends('NewLand.master')
@section('head')
<style>
        .background_buy_now_button {
            animation-name: bayButton;
            animation-duration: 1s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }
        .btn-success{
            color: #fff;
            background-color: #3CB91E;
            border-radius: 65px 65px 65px 65px;
            box-shadow: 0px 0px 10px 0px #23a455;
        }
        .btn-success:hover {
            color: #fff;
            background-color: red;
            border-color: red;
            font-weight: 700;
        }
 @media (min-width:200px)  { /* smartphones, iPhone, portrait 480x320 phones */ 
        #featured_image{
            width:100% !important;
            height:200px !important;
        }
    }
    @media (min-width:320px)  { /* smartphones, iPhone, portrait 480x320 phones */ 
        #featured_image{
            width:100% !important;
            height:250px !important;
        }
    }
@media (min-width:481px)  { /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ 
        #featured_image{
            width:100% !important;
            height:300px !important;
        }}
@media (min-width:641px)  { /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ 
        #featured_image{
            width:100% !important;
            height:400px !important;
        }}
@media (min-width:757px)  { /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ 
        #featured_image{
            width:100% !important;
            height:850px !important;
        }}
@media (min-width:961px)  { /* tablet, landscape iPad, lo-res laptops ands desktops */ 
        #featured_image{
            width:100% !important;
            height:850px  !important;
        }}
@media (min-width:1025px) { /* big landscape tablets, laptops, and desktops */ }
@media (min-width:1281px) { /* hi-res laptops and desktops */ }
h4{
        line-height: 1.7;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row my-3" style="display: flex;justify-content: center;">
        {{--
        <div class="col-md-6 my-2" >
            <div style="border:3px solid black;height: 100%;border-radius: 12px;">
                <img decoding="async" width="950" style="height: 100%;width:100%;border-radius: 12px;"
                    height="550" id="" 
                    src="@if(!empty($offer->featured_image) ) {{ asset($offer->featured_image) }}
                                @elseif(!empty($offer->firstImage()))
                                {{asset($offer->firstImage())}}
                             @else https://semantic-ui.com/images/wireframe/image.png @endif" >
            </div>
        </div>--}}
        <div class="col-md-8 my-2" >
            <div id="form" class="row pt-5" style="border:6px dashed   black;border-radius: 12px;    margin: 0px;">
                <div class="col-md-12 text-center mt-5">
                 <h2 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;" class="mb-3">
                    <span style="color: #17a617;"><b>
                    @if(app()->getLocale()=='ar') {{ $offer->name_ar}} 
                    @elseif(app()->getLocale()=='en'){{ $offer->name_en }}
                    @elseif(app()->getLocale()=='fr'){{ $offer->name_fr }}
                    @endif
                    </b></span>
                </h2>
                
                @if(!empty($offer) && $offer->count() > 0)
                @if(!empty($offer->desc))
                <h3 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;"  class="mb-3">
                        <span style="color: #ff0000;">    <b>
                 {{ $offer->desc }}</b></span>
                </h3>
                @endif
                @endif
                 <div style="text-align: center;" title="5/5"><span
                        style="color: #f5de14;">
                    <i>★</i><i>★</i><i>★</i><i>★</i><i>★</i></span>
                </div>                
            <div class="my-5">                     
           
            <h4 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;text-align:start;">
                <span >{{__('master.order_id') .' : '}}</span>  
                <span style="color: #17a617;"><b>{{ $order->order_id}}</b></span>
                </h4>
                <h4 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;text-align:start;">
                    <span >{{__('master.client') . ' : '}}</span>  
                    <span style="color: #17a617;"><b>
                    {{ $order->name}}
                    </b></span>
                </h4>
                <h4 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;text-align:start;">
                    <span >{{__('master.phone') . ' : '}}</span>  
                    <span style="color: #17a617;"><b>
                        {{ $order->mobile}}
                        </b></span>
                </h4>
                <h4 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;text-align:start;">
                    <span >{{__('master.address') . ' : '}}</span>  
                    <span style="color: #17a617;"><b>
                    {{ $order->address}}
                    </b></span></h4>
                    <h4 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;text-align:start;">
                    <span >{{__('master.offer_price') . ' : '}}</span>  
                        <span style="color: #17a617;"><b>
                        {{ $order->price}} {{ $order->currency}}
                        </b></span>
                    </h4>
                    <h4 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;text-align:start;">
                    <span >{{__('master.date') . ' : '}}</span>  
                        <span style="color: #17a617;"><b>
                        {{ $order->created_at}}
                        </b></span>
                        </h4>               
                    <h4 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;text-align:start;">
                    <span >{{__('master.status') . ' : '}}</span>  
                        <span style="color: #17a617;"><b>
                        @if($order->status=='pend')
                               {{__('master.Pending')}}
                               @elseif($order->status=='accept')
                               {{__('master.Accept')}}
                               @elseif($order->status=='accept')
                               {{__('master.Accept')}}
                               @elseif($order->status=='process')
                               {{__('master.Process')}}
                               @elseif($order->status=='deliverypayment')
                               {{__('master.DeliveryPayment')}}
                               @elseif($order->status=='cancel')
                               {{__('master.Cancel')}}
                               @endif
                        </b></span>
                        </h4>                                                                                                                    </div>
            </div>
        </div>
    </div>
</div>
{{--
    <div class="row my-3" style="border:3px solid black;border-radius: 12px;    margin: 0px;">
           <div class="col-12 text-center p-3">
                <h3 class="text-secondary"> {{__('master.offer_desc')}} </h3>
            </div>
            <div class="col-12 p-3 " style="text-align:start;">
                <p>{{ $offer['name_'.app()->getLocale()] }}<br></p>
                <p>{!! $offer['content_'.app()->getLocale()] !!}</p>
            </div>
    </div>
    
    @if(!empty($offer->image))
    @foreach(json_decode($offer->image,true) ?? [] as $img)
    <div class="row my-3" style="border:3px solid black;border-radius: 12px;    margin: 0px;">
        <div class="col-md-12 px-0">
             <img decoding="async" width="600"
                height="600" src="{{asset($img)}}" style="width:100%;height: 600px;"
                data-src="{{asset($img)}}"
                class="attachment-large size-large lazyload" alt=""
                data-srcset="{{asset($img)}} 600w, {{asset($img)}} 300w, {{asset($img)}} 150w"
                sizes="(max-width: 600px) 100vw, 600px">
        </div>
    </div>
    @endforeach
    @endif
</div>
    <div class="py-3 " style="position: sticky;bottom: 0%;    background-color: #FFFFFF;
    opacity: 0.67;">
        <div class="container">
            <div class="row">
                <div class="col-md-4" style="    display: grid;    text-align: center;">
                    <span class="far fa-money-bill-alt " style="color:#61ce70;"></span>
                    <h5>
                      {{$offer->pay_text!='' ? $offer->pay_text : __('master.Paiement_when_receiving')}} </h5>
                                                                    
                </div>
                <div class="col-md-4" style="    display: grid;    text-align: center;">
                    <span class="fas fa-shipping-fast " style="color:#61ce70;"></span>
                    <h5>  {{$offer->delivery_text!='' ? $offer->delivery_text : __('master.delivery')}} </h5>
                                                                    
                </div>
                <div class="col-md-4" style="    display: grid;    text-align: center;">
                    <span class="fas fa-star " style="color:#61ce70;"></span>
                    <h5>
                      {{$offer->notice_text!='' ? $offer->pay_text : __('master.notice_text')}} </h5>
                                                                    
                </div>
            </div>
        </div>
    </div>
--}}
@endsection
@section('script')
@endsection