@extends('NewLand.master')
@section('head')
<style>
        .copyright {
            text-align: center;
            background: #5f5a56;
            padding: 15px;
            color: #ffffff;
        }

        .copyright__link {
            color: goldenrod !important;
        }
        .background_buy_now_button {
            animation-name: bayButton;
            animation-duration: 2s;
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
            height:auto !important;
        }
    }
    @media (min-width:320px)  { /* smartphones, iPhone, portrait 480x320 phones */ 
        #featured_image{
            width:100% !important;
            height:auto !important;
        }
    .imgs{
        height:500px!important;
    }
    }
@media (min-width:481px)  { /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ 
        #featured_image{
            width:100% !important;
            height:auto !important;
        }
    .imgs{
        height:500px!important;
    }
}
@media (min-width:641px)  { /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ 
        #featured_image{
            width: 100% !important;
            height: 800px !important;
        }
        .imgs{
            height:500px!important;
        }
    }
@media (min-width:757px)  { /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones 
        #featured_image{
            width:100% !important;
            height:850px !important;
        }*/ }
@media (min-width:961px)  { /* tablet, landscape iPad, lo-res laptops ands desktops 
        #featured_image{
            width:100% !important;
            height:850px  !important;
        }*/ }
@media (min-width:1025px) { /* big landscape tablets, laptops, and desktops */ }
@media (min-width:1281px) { /* hi-res laptops and desktops */ }
</style>
@endsection
@section('content')
<div class="container">
    @if($offer->status==1)
    <div class="d-flex justify-content-center my-2" style="top: 2%;position: sticky;z-index: 10;font-size: 21px;">
        <a href="#form" class="btn btn-success btn-block background_buy_now_button mx-2">
            {{$offer->btn_text!='' ? $offer->btn_text : __('master.order_now')}}    
        </a>
    </div>
    @endif
    <div class="row my-3">
        <div class="col-md-6 my-2" >
            <div style="border:3px solid black;height: 100%;border-radius: 12px;">
                <img decoding="async" width="950" id="featured_image" style="height: 800px;width:100%;border-radius: 12px;"
                    height="550" id="" 
                    src="@if(!empty($offer->featured_image) ) {{ asset($offer->featured_image) }}
                                @elseif(!empty($offer->firstImage()))
                                {{asset($offer->firstImage())}}
                             @else https://semantic-ui.com/images/wireframe/image.png @endif" >
            </div>
        </div>
        <div class="col-md-6 my-2" >
            <div id="form" class="row pt-5" style="border:6px dashed   black;border-radius: 12px;height:100%;margin: 0px;">
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
                <h3 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;"class="mb-3">
                        <span style="color: #ff0000;">    <b>
                 {{ $offer->desc }}</b></span>
                </h3>
                @endif
                @endif
                 <div style="text-align: center;" title="5/5"><span
                        style="color: #f5de14;">
                    <i>★</i><i>★</i><i>★</i><i>★</i><i>★</i></span>
                </div>     
                @if($offer->status==1)
            <p style="text-align: center;" data-id="117cecf2"
                data-element_type="widget" data-widget_type="heading.default">
                <span style="text-decoration: underline;"><span
                        style="color: #000000;"><strong>
                        {{__('master.to_order')}}</strong></span></span></p>
            <form method="POST" id="shampoGrayH" class="mt-5" action="{{url('store_order')}}">
                    @csrf
                    @method('post')
                     <input type="hidden" name="method" value="Paiement_when_receiving">
                     <input type="hidden" name="product_offer_id" value="{{$offer->id}}">
                        <div class="row ">
                            <div class="col-md-12">
                            <div
                            class="form-group">
                            <label for="name" class="input-label">
                                {{__('master.full_name')}} ⬇️ </label> 
                                <input size="1" type="text"
                                name="name" id="name" placeholder="{{__('master.full_name')}}"
                                class="form-control"
                                required="required" aria-required="true"></div>
                            <div
                                class="form-group">
                                <label for="mobile" class="input-label">
                                    {{__('master.phone')}} ⬇️ </label> <input size="1" type="tel"
                                    name="mobile" id="mobile" placeholder="{{__('master.phone')}}"
                                    class="form-control"
                                    required="required" aria-required="true"
                                    pattern="[0-9()#&amp;+*-=.]+"
                                    title="Only numbers and phone characters (#, -, *, etc) are accepted.">
                            </div>
                            <div class="form-group">
                                <label for="address"
                                    class="input-label">{{__('master.address')}} ⬇️
                                                            </label> 
                                    <input size="1" type="text"
                                    name="address"
                                    id="address" placeholder="{{__('master.address')}}"
                                    class="form-control"
                                    required="required" aria-required="true">
                            </div>
                            <div class="form-group">
                                <div  style="display:inline-flex;justify-content: space-between;width: 100%;">
                                    <label for="price"
                                        class="input-label"> {{__('master.Choose_the_right_offer_for_you')}} ⬇️
                                    </label> 
                                    <span>{{ $store->getCurrency()}} </span>
                                </div>
                                 <select name="price" id="price"class="form-control custom-select"
                                    required="required" aria-required="true">
                                    @if(!empty($offer) && $offer->count() > 0 )
                                    @if(!empty($offer->price) && !empty($offer->price_notice))
                                    <option value="{{$offer->price}}"> {{ $offer->price .' '}}{{' __ '. $offer->price_notice}} </option>
                                    @endif
                                    @if(!empty($offer->price1) && !empty($offer->price_notice1))
                                    <option value="{{$offer->price1}}"> {{ $offer->price1 .' '}}{{' __ '. $offer->price_notice1}} </option>
                                    @endif
                                    @if(!empty($offer->price2) && !empty($offer->price_notice2))
                                    <option value="{{$offer->price2}}"> {{ $offer->price2 .' '}}{{' __ '. $offer->price_notice2}} </option>
                                    @endif
                                    @if(!empty($offer->price3) && !empty($offer->price_notice3))
                                    <option value="{{$offer->price3}}"> {{ $offer->price3 .' '}}{{' __ '. $offer->price_notice3}} </option>
                                    @endif
                                    @if(!empty($offer->price4) && !empty($offer->price_notice4))
                                    <option value="{{$offer->price4}}"> {{ $offer->price4 .' '}}{{' __ '. $offer->price_notice4}} </option>
                                    @endif
                                @endif
                            </select>
                        </div>
                        <div class="d-flex justify-content-center mb-3">
                            <button type="submit"
                                class="btn btn-success background_buy_now_button btn-block">
                                {{__('master.Complete the order')}}</button>
                        </div></div>
                    </div>
                </form>
                    @if(!empty($offer->notes))
                    <div class="d-flex justify-content-center">
                        <p class=""
                            style="text-align: center;"><strong><span
                                    style="color: #ff0000;">{{$offer->notes}}</span></strong></p>
                    </div>
                    @endif
                @else
                <div style="display:grid;text-align:center; " class="my-3 py-3">
                    <h2>
                        {{__('master.disable_note')}}
                    </h2>
                    <a href="{{'https://'.$store->domain.'.marssa.shop'}}" class="btn btn-success background_buy_now_button my-3">
                        {{__('master.home')}}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
    <div class="row my-3" style="border:3px solid black;border-radius: 12px;margin: 0px;">
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
    <div class="row my-3" style="border:3px solid black;border-radius: 12px;margin: 0px;">
        <div class="col-md-12 px-0">
             <img decoding="async" width="600"
                height="600" src="{{asset($img)}}" style="width:100%;height: auto;"
                data-src="{{asset($img)}}"
                class="attachment-large size-large lazyload " alt=""
                data-srcset="{{asset($img)}} 600w, {{asset($img)}} 300w, {{asset($img)}} 150w"
                sizes="(max-width: 600px) 100vw, 600px">
        </div>
    </div>
    @endforeach
    @endif
</div>
<div class="d-flex justify-content-between mx-5 py-2">
    <div style="display:grid;text-align: center;">
        <span class="fas fa-money-bill-alt" style="font-size: 1.8rem;    color: #61CE70;"></span>
        <span >   {{$offer->pay_text!='' ? $offer->pay_text : __('master.Paiement_when_receiving')}}
        </span>                                             
    </div>
    <div style="display:grid;text-align: center;">
        <span class="fas fa-shipping-fast" style="font-size: 1.8rem;    color: #61CE70;"></span>
        <span >
          {{$offer->delivery_text!='' ? $offer->delivery_text : __('master.delivery_text')}}
        </span>
    </div>
    <div style="display:grid;text-align: center;">
        <span class="fas fa-star" style="font-size: 1.8rem;    color: #61CE70;"></span>
        <span >
           {{$offer->notice_text!='' ? $offer->notice_text : __('master.guaranteed_results')}}
       </span>
    </div>
</div>
    <div class="copyright" style="background-color:{{$background_color ?? ''}}">
        <span class="copyright__text">
           {!!  __("store.Made with ❤ And Mastering By")!!}
        </span>
        <a class="copyright__link" target="_blank" style="color: {{$color ?? 'goldenrod'}}     !important;"
           href="{{config('app.url')}}">{{strtoupper(config('app.name'))}}</a>
</div>

                
@endsection
@section('script')
@endsection