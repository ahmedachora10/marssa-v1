@extends('NewLand.master')
@section('head')
<style>
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
</style>
@endsection
@section('content')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0"
        focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-dark-grayscale">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                    values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 ">
                </feColorMatrix>
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0 0.49803921568627"></feFuncR>
                    <feFuncG type="table" tableValues="0 0.49803921568627"></feFuncG>
                    <feFuncB type="table" tableValues="0 0.49803921568627"></feFuncB>
                    <feFuncA type="table" tableValues="1 1"></feFuncA>
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in"></feComposite>
            </filter>
        </defs>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
        style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-grayscale">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                    values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 ">
                </feColorMatrix>
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0 1"></feFuncR>
                    <feFuncG type="table" tableValues="0 1"></feFuncG>
                    <feFuncB type="table" tableValues="0 1"></feFuncB>
                    <feFuncA type="table" tableValues="1 1"></feFuncA>
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in"></feComposite>
            </filter>
        </defs>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
        style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-purple-yellow">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                    values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 ">
                </feColorMatrix>
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0.54901960784314 0.98823529411765"></feFuncR>
                    <feFuncG type="table" tableValues="0 1"></feFuncG>
                    <feFuncB type="table" tableValues="0.71764705882353 0.25490196078431"></feFuncB>
                    <feFuncA type="table" tableValues="1 1"></feFuncA>
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in"></feComposite>
            </filter>
        </defs>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
        style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-blue-red">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                    values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 ">
                </feColorMatrix>
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0 1"></feFuncR>
                    <feFuncG type="table" tableValues="0 0.27843137254902"></feFuncG>
                    <feFuncB type="table" tableValues="0.5921568627451 0.27843137254902"></feFuncB>
                    <feFuncA type="table" tableValues="1 1"></feFuncA>
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in"></feComposite>
            </filter>
        </defs>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
        style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-midnight">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                    values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 ">
                </feColorMatrix>
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0 0"></feFuncR>
                    <feFuncG type="table" tableValues="0 0.64705882352941"></feFuncG>
                    <feFuncB type="table" tableValues="0 1"></feFuncB>
                    <feFuncA type="table" tableValues="1 1"></feFuncA>
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in"></feComposite>
            </filter>
        </defs>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
        style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-magenta-yellow">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                    values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 ">
                </feColorMatrix>
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0.78039215686275 1"></feFuncR>
                    <feFuncG type="table" tableValues="0 0.94901960784314"></feFuncG>
                    <feFuncB type="table" tableValues="0.35294117647059 0.47058823529412"></feFuncB>
                    <feFuncA type="table" tableValues="1 1"></feFuncA>
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in"></feComposite>
            </filter>
        </defs>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
        style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-purple-green">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                    values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 ">
                </feColorMatrix>
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0.65098039215686 0.40392156862745"></feFuncR>
                    <feFuncG type="table" tableValues="0 1"></feFuncG>
                    <feFuncB type="table" tableValues="0.44705882352941 0.4"></feFuncB>
                    <feFuncA type="table" tableValues="1 1"></feFuncA>
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in"></feComposite>
            </filter>
        </defs>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
        style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-blue-orange">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                    values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 ">
                </feColorMatrix>
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0.098039215686275 1"></feFuncR>
                    <feFuncG type="table" tableValues="0 0.66274509803922"></feFuncG>
                    <feFuncB type="table" tableValues="0.84705882352941 0.41960784313725"></feFuncB>
                    <feFuncA type="table" tableValues="1 1"></feFuncA>
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in"></feComposite>
            </filter>
        </defs>
    </svg>
    <div data-elementor-type="wp-page" data-elementor-id="10988" class="elementor elementor-10988">
        <div class="elementor-inner">
            <div class="elementor-section-wrap">
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-5451e9b1 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="5451e9b1" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-7f619a9c"
                                data-id="7f619a9c" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-56fa5f33 elementor-align-justify elementor-mobile-align-justify elementor-widget elementor-widget-button elementor-sticky animated fadeInDown"
                                            data-id="56fa5f33" data-element_type="widget"
                                            data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;,&quot;sticky&quot;:&quot;top&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_offset&quot;:0,&quot;sticky_effects_offset&quot;:0}"
                                            data-widget_type="button.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-button-wrapper"> <a href="#form"
                                                        class="elementor-button-link elementor-button elementor-size-sm"
                                                        role="button"> <span class="elementor-button-content-wrapper">
                                                            <span class="elementor-button-text">
                                                            {{$offer->btn_text!='' ? $offer->btn_text : __('master.order_now')}}    
                                                            </span> </span> </a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-64f7bf3b elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="64f7bf3b" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-1d78423"
                                data-id="1d78423" data-element_type="column" style="margin-top: 10px;">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap" style="margin: -10px 0px;">
                                        <div class="elementor-element elementor-element-4494baf7 elementor-widget elementor-widget-image"
                                            data-id="4494baf7" data-element_type="widget"
                                            data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image"> 
                                                <img decoding="async" width="950" style="height: 820px;max-height: 900px;"
                                                        height="550" id="featured_image" src=src="@if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif" data-src="{{asset('newLand/img/1.jpg')}}"
                                                        class="attachment-full size-full lazyloaded" alt=""
                                                        data-srcset="@if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif 950w, @if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif 300w,@if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif 768w"
                                                        sizes="(max-width: 950px) 100vw, 950px"
                                                        srcset="@if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif 950w, @if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif 300w,@if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif 768w"><noscript><img
                                                            decoding="async" width="950" height="550"
                                                            src="@if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif"
                                                            class="attachment-full size-full lazyload" alt=""
                                                            srcset="@if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif 950w, @if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif 300w,@if(!empty($offer->featured_image) )
                                                         {{ asset($offer->featured_image) }}
                                                @elseif(!empty($offer->firstImage()))
                                                {{asset($offer->firstImage())}}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif 768w"
                                                            sizes="(max-width: 950px) 100vw, 950px" /></noscript></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-628e7e07"
                                data-id="628e7e07" data-element_type="column" style="margin-top: 10px;">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-5ba41869 elementor-widget elementor-widget-menu-anchor"
                                            data-id="5ba41869" data-element_type="widget"
                                            data-widget_type="menu-anchor.default">
                                            <div class="elementor-widget-container">
                                                <div id="form" class="elementor-menu-anchor"></div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-2a812a92 elementor-widget elementor-widget-text-editor"
                                            data-id="2a812a92" data-element_type="widget"
                                            data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-text-editor elementor-clearfix">
                                                    <div data-id="4e26735a" data-element_type="widget"
                                                        data-widget_type="heading.default">
                                                        <h4 style="text-align: center;">&nbsp;</h4>
                                                    </div>
                                                    <div style="text-align: center;" data-id="72bb94b1"
                                                        data-element_type="widget" data-widget_type="heading.default">
                                                        <div>
                                                            <h2 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                <span style="color: #17a617;"><b>
                                                                {{app()->getLocale()=='ar' ? $offer->name_ar : $offer->name_en }}
                                                                </b></span>
                                                            </h2>
                                                            
                                                            @if(!empty($offer) && $offer->count() > 0)
                                                            @if(!empty($offer->desc))
                                                            <h3 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                    <span style="color: #ff0000;">    <b>
                                                             {{ $offer->desc }}</b></span>
                                                            </h3>
                                                            @endif
                                                            @endif
                                                         {{--   <h5 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                    <span style="color: #17a617;"><b>
                                                            {{ __('master.offer_price') }}</b></span>
                                                            </h5>
                                                                @if($offer->price )
                                                                <h5 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                    <span style="color: #17a617;"><b>
                                                                 {{ $offer->price_notice }}    {{ $offer->price }}</b></span>
                                                                    </h5>
                                                                @endif
                                                                @if($offer->price1 )
                                                                <h5 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                    <span style="color: #17a617;"><b>
                                                                 {{ $offer->price_notice1 }}    {{ $offer->price1 }} </b></span>
                                                                    </h5>
                                                                @endif
                                                                @if($offer->price2 )
                                                                <h5 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                    <span style="color: #17a617;"><b>
                                                                 {{ $offer->price_notice2 }}    {{ $offer->price2 }}</b></span>
                                                                    </h5>
                                                                @endif
                                                                @if($offer->price3 )
                                                                <h5 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                    <span style="color: #17a617;"><b>
                                                                 {{ $offer->price_notice3 }}    {{ $offer->price3 }}</b></span>
                                                                    </h2>
                                                                @endif
                                                                @if($offer->price4 )
                                                                <h5 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                    <span style="color: #17a617;"><b>
                                                                 {{ $offer->price_notice4 }}    {{ $offer->price4 }}</b></span>
                                                                    </h5>
                                                                @endif
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                    <div data-id="131bb3be" data-element_type="widget"
                                                        data-widget_type="star-rating.default">
                                                        <div>
                                                            <div>
                                                                <div style="text-align: center;" title="5/5"><span
                                                                        style="color: #f5de14;">
                                                                    <i>★</i><i>★</i><i>★</i><i>★</i><i>★</i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p style="text-align: center;" data-id="117cecf2"
                                                        data-element_type="widget" data-widget_type="heading.default">
                                                        <span style="text-decoration: underline;"><span
                                                                style="color: #000000;"><strong>
                                                                {{__('master.to_order')}}</strong></span></span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-52f61638 elementor-button-align-stretch elementor-widget elementor-widget-form"
                                            data-id="52f61638" data-element_type="widget"
                                            data-settings="{&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;button_width&quot;:&quot;100&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                                            data-widget_type="form.default">
                                            <div class="elementor-widget-container">
                                                <form class="elementor-form" method="POST" id="shampoGrayH" 
                                                action="{{url('store_order')}}">
                                                    @csrf
                                                    @method('post')
                                                     <input type="hidden" name="method" value="Paiement_when_receiving">
                                                     <input type="hidden" name="product_offer_id" value="{{$offer->id}}">
                                                     
                                                    <div class="elementor-form-fields-wrapper elementor-labels-above">
                                                        <div
                                                            class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-name elementor-col-100 elementor-field-required elementor-mark-required">
                                                            <label for="form-field-name" class="elementor-field-label">
                                                                {{__('master.full_name')}} ⬇️ </label> <input size="1" type="text"
                                                                name="name" id="name" placeholder="{{__('master.full_name')}}"
                                                                class="elementor-field elementor-size-sm  elementor-field-textual"
                                                                required="required" aria-required="true"></div>
                                                        <div
                                                            class="elementor-field-type-tel elementor-field-group elementor-column elementor-field-group-email elementor-col-100 elementor-field-required elementor-mark-required">
                                                            <label for="form-field-email" class="elementor-field-label">
                                                                {{__('master.phone')}} ⬇️ </label> <input size="1" type="tel"
                                                                name="mobile" id="mobile" placeholder="{{__('master.phone')}}"
                                                                class="elementor-field elementor-size-sm  elementor-field-textual"
                                                                required="required" aria-required="true"
                                                                pattern="[0-9()#&amp;+*-=.]+"
                                                                title="Only numbers and phone characters (#, -, *, etc) are accepted.">
                                                        </div>
                                                        <div
                                                            class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-field_fefae62 elementor-col-100 elementor-field-required elementor-mark-required">
                                                            <label for="form-field-field_fefae62"
                                                                class="elementor-field-label">{{__('master.address')}} ⬇️
                                                            </label> <input size="1" type="text"
                                                                name="address"
                                                                id="address" placeholder="{{__('master.address')}}"
                                                                class="elementor-field elementor-size-sm  elementor-field-textual"
                                                                required="required" aria-required="true"></div>
                                                        <div
                                                            class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-field_81d535e elementor-col-100 elementor-field-required elementor-mark-required">
                                                            <div for="form-field-field_81d535e" style="display:inline-flex;justify-content: space-between;width: 100%;">
                                                                <label for="form-field-field_81d535e"
                                                                    class="elementor-field-label"> {{__('master.Choose_the_right_offer_for_you')}} ⬇️
                                                                </label> 
                                                                <span>{{ $store->getCurrency()}} </span>
                                                            </div>
                                                            <div class="elementor-field elementor-select-wrapper ">
                                                                <select name="price"
                                                                    id="form-field-field_81d535e"
                                                                    class="elementor-field-textual elementor-size-sm"
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
                                                                </select></div>
                                                        </div>
                                                        <div
                                                            class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                                                            <button type="submit"
                                                                class="elementor-button elementor-size-sm elementor-animation-push">
                                                                <span> <span class=" elementor-button-icon"> </span>
                                                                    <span class="elementor-button-text">{{__('master.Complete the order')}}</span> </span> </button></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @if(!empty($offer->notes))
                                        <div class="elementor-element elementor-element-7e814701 elementor-widget elementor-widget-text-editor"
                                            data-id="7e814701" data-element_type="widget"
                                            data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-text-editor elementor-clearfix">
                                                    <div class="elementor-element elementor-element-fc73cef elementor-widget elementor-widget-heading"
                                                        data-id="fc73cef" data-element_type="widget"
                                                        data-widget_type="heading.default">
                                                        <div class="elementor-widget-container">
                                                            <p class="elementor-heading-title elementor-size-default"
                                                                style="text-align: center;"><strong><span
                                                                        style="color: #ff0000;">{{$offer->notes}}</span></strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-37e08409 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="37e08409" data-element_type="section"
                    data-settings="{&quot;animation_mobile&quot;:&quot;fadeInRight&quot;}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row"></div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-c20ed04 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="c20ed04" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-6af0cf88"
                                data-id="6af0cf88" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-3d0c4ff1 elementor-widget elementor-widget-image"
                                            data-id="3d0c4ff1" data-element_type="widget"
                                            data-widget_type="image.default">
                                            
                                            <div class="elementor-widget-container">
                                                 <div class="row">
                <div class="col-12 text-center p-3">
                    <h3 class="text-secondary"> {{__('master.product_details')}} </h3>
                </div>
                <div class="col-12 p-3 description">
                    <p>{{ $offer['name_'.app()->getLocale()] }}<br></p>
                    <p>{!! $offer['content_'.app()->getLocale()] !!}</p>
                </div>
                <hr style="width: -webkit-fill-available;">

            </div>
                                                {{--<div class="elementor-image"> <img decoding="async" width="600"
                                                        height="600" src="{{asset('newLand/img/2.jpeg')}}" data-src="{{asset('newLand/img/2.jpeg')}}"
                                                        class="attachment-large size-large lazyloaded" alt=""
                                                        data-srcset="{{asset('newLand/img/2.jpeg')}} 600w, {{asset('newLand/img/2.jpeg')}} 300w, {{asset('newLand/img/2.jpeg')}} 150w"
                                                        sizes="(max-width: 600px) 100vw, 600px"
                                                        srcset="{{asset('newLand/img/2.jpeg')}} 600w, {{asset('newLand/img/2.jpeg')}} 300w, {{asset('newLand/img/2.jpeg')}} 150w"><noscript><img
                                                            decoding="async" width="600" height="600"
                                                            src="{{asset('newLand/img/2.jpeg')}}"
                                                            class="attachment-large size-large lazyload" alt=""
                                                            srcset="{{asset('newLand/img/2.jpeg')}} 600w, {{asset('newLand/img/2.jpeg')}} 300w, {{asset('newLand/img/2.jpeg')}} 150w"
                                                            sizes="(max-width: 600px) 100vw, 600px" /></noscript></div>--}}
                                            </div>
                                        </div>
                                        @if(!empty($offer->image))
                                        @foreach(json_decode($offer->image,true) ?? [] as $img)
                                        <div class="elementor-element elementor-element-131f4be3 elementor-widget elementor-widget-image"
                                            data-id="131f4be3" data-element_type="widget"
                                            data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image"> <img decoding="async" width="600"
                                                        height="600" src="{{asset($img)}}" style="width:100%;height: 600px;"
                                                        data-src="{{asset($img)}}"
                                                        class="attachment-large size-large lazyload" alt=""
                                                        data-srcset="{{asset($img)}} 600w, {{asset($img)}} 300w, {{asset($img)}} 150w"
                                                        sizes="(max-width: 600px) 100vw, 600px"><noscript><img
                                                            decoding="async" width="600" height="600"
                                                            src="{{asset($img)}}"
                                                            class="attachment-large size-large lazyload" alt=""
                                                            srcset="{{asset($img)}} 600w, {{asset($img)}} 300w, {{asset($img)}} 150w"
                                                            sizes="(max-width: 600px) 100vw, 600px" /></noscript></div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
              {{--  <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-3acef21f elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="3acef21f" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3d494263"
                                data-id="3d494263" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-4714994c elementor-widget elementor-widget-image"
                                            data-id="4714994c" data-element_type="widget"
                                            data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image"> <img decoding="async" width="700"
                                                        height="875"
                                                        src="{{asset('newLand/img/0yn0Yzf5K2kKMWq0bGlJ17jZX6YcxLvLxsVQQI9N.png')}}"
                                                        data-src="{{asset('newLand/img/0yn0Yzf5K2kKMWq0bGlJ17jZX6YcxLvLxsVQQI9N.png')}}"
                                                        class="attachment-large size-large lazyload" alt=""
                                                        data-srcset="{{asset('newLand/img/0yn0Yzf5K2kKMWq0bGlJ17jZX6YcxLvLxsVQQI9N.png')}} 700w, {{asset('newLand/img/0yn0Yzf5K2kKMWq0bGlJ17jZX6YcxLvLxsVQQI9N-240x300.png')}} 240w"
                                                        sizes="(max-width: 700px) 100vw, 700px"><noscript><img
                                                            decoding="async" width="700" height="875"
                                                            src="{{asset('newLand/img/0yn0Yzf5K2kKMWq0bGlJ17jZX6YcxLvLxsVQQI9N.png')}}"
                                                            class="attachment-large size-large lazyload" alt=""
                                                            srcset="{{asset('newLand/img/0yn0Yzf5K2kKMWq0bGlJ17jZX6YcxLvLxsVQQI9N.png')}} 700w, {{asset('newLand/img/0yn0Yzf5K2kKMWq0bGlJ17jZX6YcxLvLxsVQQI9N-240x300.png')}} 240w"
                                                            sizes="(max-width: 700px) 100vw, 700px" /></noscript></div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-4c152afa elementor-widget elementor-widget-image"
                                            data-id="4c152afa" data-element_type="widget"
                                            data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image"> <img decoding="async" width="752"
                                                        height="435"
                                                        src="{{asset('newLand/img/image1.jpg')}}"
                                                        data-src="{{asset('newLand/img/image1.jpg')}}"
                                                        class="attachment-large size-large lazyload" alt=""
                                                        data-srcset="{{asset('newLand/img/image1.jpg')}} 950w, {{asset('newLand/img/image1-300x174.jpg')}} 300w, {{asset('newLand/img/image1-768x445.jpg')}} 768w"
                                                        sizes="(max-width: 752px) 100vw, 752px"><noscript><img
                                                            decoding="async" width="752" height="435"
                                                            src="{{asset('newLand/img/image1.jpg')}}"
                                                            class="attachment-large size-large lazyload" alt=""
                                                            srcset="{{asset('newLand/img/image1.jpg')}} 950w, {{asset('newLand/img/image1-300x174.jpg')}} 300w, {{asset('newLand/img/image1-768x445.jpg')}} 768w"
                                                            sizes="(max-width: 752px) 100vw, 752px" /></noscript></div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-48542653 elementor-widget elementor-widget-image"
                                            data-id="48542653" data-element_type="widget"
                                            data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image"> <img decoding="async" width="752"
                                                        height="435"
                                                        src="{{asset('newLand/img/8vCtUa8OZbYfRKAzlZVNlEqU9b41ohjAh3TG5I5B.jpeg')}}"
                                                        data-src="{{asset('newLand/img/8vCtUa8OZbYfRKAzlZVNlEqU9b41ohjAh3TG5I5B.jpeg')}}"
                                                        class="attachment-large size-large lazyload" alt=""
                                                        data-srcset="{{asset('newLand/img/8vCtUa8OZbYfRKAzlZVNlEqU9b41ohjAh3TG5I5B.jpeg')}} 950w, {{asset('newLand/img/8vCtUa8OZbYfRKAzlZVNlEqU9b41ohjAh3TG5I5B-300x174.jpeg')}} 300w, {{asset('newLand/img/8vCtUa8OZbYfRKAzlZVNlEqU9b41ohjAh3TG5I5B-768x445.jpeg')}} 768w"
                                                        sizes="(max-width: 752px) 100vw, 752px"><noscript><img
                                                            decoding="async" width="752" height="435"
                                                            src="{{asset('newLand/img/8vCtUa8OZbYfRKAzlZVNlEqU9b41ohjAh3TG5I5B.jpeg')}}"
                                                            class="attachment-large size-large lazyload" alt=""
                                                            srcset="{{asset('newLand/img/8vCtUa8OZbYfRKAzlZVNlEqU9b41ohjAh3TG5I5B.jpeg')}} 950w, {{asset('newLand/img/8vCtUa8OZbYfRKAzlZVNlEqU9b41ohjAh3TG5I5B-300x174.jpeg')}} 300w, {{asset('newLand/img/8vCtUa8OZbYfRKAzlZVNlEqU9b41ohjAh3TG5I5B-768x445.jpeg')}} 768w"
                                                            sizes="(max-width: 752px) 100vw, 752px" /></noscript></div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-6fd3309d elementor-widget elementor-widget-text-editor"
                                            data-id="6fd3309d" data-element_type="widget"
                                            data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-text-editor elementor-clearfix">
                                                    <p>كيف يستخدم؟</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-fecabf elementor-widget elementor-widget-image"
                                            data-id="fecabf" data-element_type="widget"
                                            data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image"> <img decoding="async" width="950"
                                                        height="550" src="{{asset('newLand/img/image2.jpeg')}}"
                                                        data-src="{{asset('newLand/img/image2.jpeg')}}"
                                                        class="attachment-full size-full lazyload" alt=""
                                                        data-srcset="{{asset('newLand/img/image2.jpeg')}} 950w, {{asset('newLand/img/image2-300x174.jpeg')}} 300w, {{asset('newLand/img/image2.jpeg')}} 768w"
                                                        sizes="(max-width: 950px) 100vw, 950px"><noscript><img
                                                            decoding="async" width="950" height="550"
                                                            src="{{asset('newLand/img/image2.jpeg')}}"
                                                            class="attachment-full size-full lazyload" alt=""
                                                            srcset="{{asset('newLand/img/image2.jpeg')}} 950w, {{asset('newLand/img/image2-300x174.jpeg')}} 300w, {{asset('newLand/img/image2.jpeg')}} 768w"
                                                            sizes="(max-width: 950px) 100vw, 950px" /></noscript></div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-7b0687e7 elementor-widget elementor-widget-image"
                                            data-id="7b0687e7" data-element_type="widget"
                                            data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image"> <img decoding="async" width="752"
                                                        height="752"
                                                        src="{{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM.png')}}"
                                                        data-src="{{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM.png')}}"
                                                        class="attachment-large size-large lazyload" alt=""
                                                        data-srcset="{{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM.png')}} 1024w, {{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM-300x300.png')}} 300w, {{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM.png')}} 150w, {{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM-768x768.png')}} 768w, {{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM-1536x1536.png')}} 1536w, {{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM.png')}} 1600w"
                                                        sizes="(max-width: 752px) 100vw, 752px"><noscript><img
                                                            decoding="async" width="752" height="752"
                                                            src="{{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM.png')}}"
                                                            class="attachment-large size-large lazyload" alt=""
                                                            srcset="{{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM.png')}} 1024w, {{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM-300x300.png')}} 300w, {{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM.png')}} 150w, {{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM-768x768.png')}} 768w, {{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM-1536x1536.png')}} 1536w, {{asset('newLand/img/CTJLdCkJo2ehStEaPWpp96OCcbBsmbcUTTDQ37bM.png')}} 1600w"
                                                            sizes="(max-width: 752px) 100vw, 752px" /></noscript></div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-60029ed1 elementor-widget elementor-widget-image"
                                            data-id="60029ed1" data-element_type="widget"
                                            data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image"> <img decoding="async" width="460"
                                                        height="798"
                                                        src="{{asset('newLand/img/YF1UXCXa754cFcorJbh4EWw5TsimwgyEKz9KEJe0.png')}}"
                                                        data-src="{{asset('newLand/img/YF1UXCXa754cFcorJbh4EWw5TsimwgyEKz9KEJe0.png')}}"
                                                        class="attachment-full size-full lazyload" alt=""
                                                        data-srcset="{{asset('newLand/img/YF1UXCXa754cFcorJbh4EWw5TsimwgyEKz9KEJe0.png')}} 460w, {{asset('newLand/img/YF1UXCXa754cFcorJbh4EWw5TsimwgyEKz9KEJe0-173x300.png')}} 173w"
                                                        sizes="(max-width: 460px) 100vw, 460px"><noscript><img
                                                            decoding="async" width="460" height="798"
                                                            src="{{asset('newLand/img/YF1UXCXa754cFcorJbh4EWw5TsimwgyEKz9KEJe0.png')}}"
                                                            class="attachment-full size-full lazyload" alt=""
                                                            srcset="{{asset('newLand/img/YF1UXCXa754cFcorJbh4EWw5TsimwgyEKz9KEJe0.png')}} 460w, {{asset('newLand/img/YF1UXCXa754cFcorJbh4EWw5TsimwgyEKz9KEJe0-173x300.png')}} 173w"
                                                            sizes="(max-width: 460px) 100vw, 460px" /></noscript></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-3bea8914 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="3bea8914" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-7758f5e6"
                                data-id="7758f5e6" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap e-swiper-container">
                                        <div class="elementor-element elementor-element-a08abd0 elementor-arrows-position-inside elementor-pagination-position-outside elementor-widget elementor-widget-image-carousel e-widget-swiper"
                                            data-id="a08abd0" data-element_type="widget"
                                            data-settings="{&quot;navigation&quot;:&quot;both&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;infinite&quot;:&quot;yes&quot;,&quot;speed&quot;:500}"
                                            data-widget_type="image-carousel.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image-carousel-wrapper swiper-container swiper-container-initialized swiper-container-horizontal"
                                                    dir="ltr">
                                                    <div class="elementor-image-carousel swiper-wrapper"
                                                        style="transform: translate3d(-1120px, 0px, 0px); transition-duration: 0ms;">
                                                        <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev"
                                                            data-swiper-slide-index="0" style="width: 373.333px;">
                                                            <figure class="swiper-slide-inner"><img decoding="async"
                                                                    class="swiper-slide-image lazyload"
                                                                    src="{{asset('newLand/img/278996533_1425999071183163_795578961694040370_n-1.jpeg')}}"
                                                                    data-src="{{asset('newLand/img/EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg-1.jpeg')}}"
                                                                    alt="278996533_1425999071183163_795578961694040370_n-1.jpeg')}}"><noscript><img
                                                                        decoding="async"
                                                                        class="swiper-slide-image lazyload"
                                                                        src="{{asset('newLand/img/278996533_1425999071183163_795578961694040370_n-1.jpeg')}}"
                                                                        alt="278996533_1425999071183163_795578961694040370_n-1.jpeg')}}" /></noscript>
                                                            </figure>
                                                        </div>
                                                        <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active"
                                                            data-swiper-slide-index="1" style="width: 373.333px;">
                                                            <figure class="swiper-slide-inner"><img decoding="async"
                                                                    class="swiper-slide-image lazyload"
                                                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                                    data-src="{{asset('newLand/img/EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}"
                                                                    alt="EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}"><noscript><img
                                                                        decoding="async"
                                                                        class="swiper-slide-image lazyload"
                                                                        src="{{asset('newLand/img/EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}"
                                                                        alt="EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}" /></noscript>
                                                            </figure>
                                                        </div>
                                                        <div class="swiper-slide swiper-slide-prev swiper-slide-duplicate-next"
                                                            data-swiper-slide-index="0" style="width: 373.333px;">
                                                            <figure class="swiper-slide-inner"><img decoding="async"
                                                                    class="swiper-slide-image lazyload"
                                                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                                    data-src="{{asset('newLand/img/278996533_1425999071183163_795578961694040370_n-1.jpeg')}}"
                                                                    alt="278996533_1425999071183163_795578961694040370_n-1.jpeg')}}"><noscript><img
                                                                        decoding="async"
                                                                        class="swiper-slide-image lazyload"
                                                                        src="{{asset('newLand/img/278996533_1425999071183163_795578961694040370_n-1.jpeg')}}"
                                                                        alt="278996533_1425999071183163_795578961694040370_n-1.jpeg')}}" /></noscript>
                                                            </figure>
                                                        </div>
                                                        <div class="swiper-slide swiper-slide-active"
                                                            data-swiper-slide-index="1" style="width: 373.333px;">
                                                            <figure class="swiper-slide-inner"><img decoding="async"
                                                                    class="swiper-slide-image lazyload"
                                                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                                    data-src="{{asset('newLand/img/EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}"
                                                                    alt="EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}"><noscript><img
                                                                        decoding="async"
                                                                        class="swiper-slide-image lazyload"
                                                                        src="{{asset('newLand/img/EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}"
                                                                        alt="EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}" /></noscript>
                                                            </figure>
                                                        </div>
                                                        <div class="swiper-slide swiper-slide-duplicate swiper-slide-next swiper-slide-duplicate-prev"
                                                            data-swiper-slide-index="0" style="width: 373.333px;">
                                                            <figure class="swiper-slide-inner"><img decoding="async"
                                                                    class="swiper-slide-image lazyload"
                                                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                                    data-src="{{asset('newLand/img/278996533_1425999071183163_795578961694040370_n-1.jpeg')}}"
                                                                    alt="278996533_1425999071183163_795578961694040370_n-1.jpeg')}}"><noscript><img
                                                                        decoding="async"
                                                                        class="swiper-slide-image lazyload"
                                                                        src="{{asset('newLand/img/278996533_1425999071183163_795578961694040370_n-1.jpeg')}}"
                                                                        alt="278996533_1425999071183163_795578961694040370_n-1.jpeg')}}" /></noscript>
                                                            </figure>
                                                        </div>
                                                        <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active"
                                                            data-swiper-slide-index="1" style="width: 373.333px;">
                                                            <figure class="swiper-slide-inner"><img decoding="async"
                                                                    class="swiper-slide-image lazyload"
                                                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                                    data-src="{{asset('newLand/img/EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}"
                                                                    alt="EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}"><noscript><img
                                                                        decoding="async"
                                                                        class="swiper-slide-image lazyload"
                                                                        src="{{asset('newLand/img/EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}"
                                                                        alt="EGsgM8zIr9zG7onWNqVxh9zyzCGmET7s8WlBgeau_lg.jpeg')}}" /></noscript>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
                                                        <span class="swiper-pagination-bullet" tabindex="0"
                                                            role="button" aria-label="Go to slide 1"></span><span
                                                            class="swiper-pagination-bullet swiper-pagination-bullet-active"
                                                            tabindex="0" role="button"
                                                            aria-label="Go to slide 2"></span></div>
                                                    <div class="elementor-swiper-button elementor-swiper-button-prev"
                                                        tabindex="0" role="button" aria-label="Previous slide"> <i
                                                            aria-hidden="true" class="eicon-chevron-left"></i> <span
                                                            class="elementor-screen-only">السابق</span></div>
                                                    <div class="elementor-swiper-button elementor-swiper-button-next"
                                                        tabindex="0" role="button" aria-label="Next slide"> <i
                                                            aria-hidden="true" class="eicon-chevron-right"></i> <span
                                                            class="elementor-screen-only">التالي</span></div><span
                                                        class="swiper-notification" aria-live="assertive"
                                                        aria-atomic="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-61e5a35e elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="61e5a35e" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row"></div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-107c9780 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="107c9780" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-6c1812e3"
                                data-id="6c1812e3" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-2b83a01f elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="2b83a01f" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5ce6c063"
                                data-id="5ce6c063" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-741ca6e0 elementor-widget elementor-widget-spacer"
                                            data-id="741ca6e0" data-element_type="widget"
                                            data-widget_type="spacer.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-spacer">
                                                    <div class="elementor-spacer-inner"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>--}}
                <section style="z-index:10;"
                    class="elementor-section elementor-top-section elementor-element elementor-element-7bb5c22c elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-sticky elementor-sticky--effects elementor-sticky--active elementor-section--handles-inside"
                    data-id="7bb5c22c" data-element_type="section"
                    data-settings="{&quot;sticky&quot;:&quot;bottom&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_offset&quot;:0,&quot;sticky_effects_offset&quot;:0}"
                    style="position: fixed; width: 1333px; margin-top: 0px; margin-bottom: 0px; bottom: 0px;">
                    <div class="elementor-background-overlay"></div>
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-16 elementor-top-column elementor-element elementor-element-728e0543"
                                data-id="728e0543" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-6ce0a858 elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
                                            data-id="6ce0a858" data-element_type="widget"
                                            data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-icon-box-wrapper">
                                                    <div class="elementor-icon-box-icon"> <span
                                                            class="elementor-icon elementor-animation-"> <i
                                                                aria-hidden="true" class="far fa-money-bill-alt"></i>
                                                        </span></div>
                                                    <div class="elementor-icon-box-content">
                                                        <h3 class="elementor-icon-box-title"> <span>
                                                          {{$offer->pay_text!='' ? $offer->pay_text : __('master.Paiement_when_receiving')}}
                                                            </span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-66 elementor-top-column elementor-element elementor-element-30cd86ae"
                                data-id="30cd86ae" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-507ff8c8 elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
                                            data-id="507ff8c8" data-element_type="widget"
                                            data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-icon-box-wrapper">
                                                    <div class="elementor-icon-box-icon"> <span
                                                            class="elementor-icon elementor-animation-"> <i
                                                                aria-hidden="true" class="fas fa-shipping-fast"></i>
                                                        </span></div>
                                                    <div class="elementor-icon-box-content">
                                                        <h3 class="elementor-icon-box-title"> <span> 
                                                          {{$offer->delivery_text!='' ? $offer->delivery_text : __('master.delivery_text')}}
                                                      
                                                         </span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-16 elementor-top-column elementor-element elementor-element-5004838e"
                                data-id="5004838e" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-49759fb1 elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
                                            data-id="49759fb1" data-element_type="widget"
                                            data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-icon-box-wrapper">
                                                    <div class="elementor-icon-box-icon"> <span
                                                            class="elementor-icon elementor-animation-"> <i
                                                                aria-hidden="true" class="fas fa-star"></i> </span>
                                                    </div>
                                                    <div class="elementor-icon-box-content">
                                                        <h3 class="elementor-icon-box-title"> <span>
                                                               {{$offer->notice_text!='' ? $offer->notice_text : __('master.guaranteed_results')}}
                                                       
                                                            </span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-5451e9b1 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="5451e9b1" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-7f619a9c"
                                data-id="7f619a9c" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-56fa5f33 elementor-align-justify elementor-mobile-align-justify elementor-widget elementor-widget-button elementor-sticky animated fadeInDown"
                                            data-id="56fa5f33" data-element_type="widget"
                                            data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;,&quot;sticky&quot;:&quot;top&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_offset&quot;:0,&quot;sticky_effects_offset&quot;:0}"
                                            data-widget_type="button.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-button-wrapper"> <a href="#form"
                                                        class="elementor-button-link elementor-button elementor-size-sm"
                                                        role="button"> <span class="elementor-button-content-wrapper">
                                                            <span class="elementor-button-text">
                                                            {{$offer->btn_text!='' ? $offer->btn_text : __('master.order_now')}}    
                                                            </span> </span> </a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
              {{--  <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-7bb5c22c elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-sticky elementor-sticky__spacer"
                    data-id="7bb5c22c" data-element_type="section"
                    data-settings="{&quot;sticky&quot;:&quot;bottom&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_offset&quot;:0,&quot;sticky_effects_offset&quot;:0}"
                    style="visibility: hidden; transition: none 0s ease 0s; animation: 0s ease 0s 1 normal none running none;">
                    <div class="elementor-background-overlay"></div>
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-16 elementor-top-column elementor-element elementor-element-728e0543"
                                data-id="728e0543" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-6ce0a858 elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
                                            data-id="6ce0a858" data-element_type="widget"
                                            data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-icon-box-wrapper">
                                                    <div class="elementor-icon-box-icon"> <span
                                                            class="elementor-icon elementor-animation-"> <i
                                                                aria-hidden="true" class="far fa-money-bill-alt"></i>
                                                        </span></div>
                                                    <div class="elementor-icon-box-content">
                                                        <h3 class="elementor-icon-box-title"> <span> 
                                                        {{$offer->pay_text .' '.$offer->delivery_text.' '.$offer->notice_text}} {{$offer->pay_text!='' ? $offer->pay_text : __('master.Paiement_when_receiving')}}
                                                            </span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-66 elementor-top-column elementor-element elementor-element-30cd86ae"
                                data-id="30cd86ae" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-507ff8c8 elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
                                            data-id="507ff8c8" data-element_type="widget"
                                            data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-icon-box-wrapper">
                                                    <div class="elementor-icon-box-icon"> <span
                                                            class="elementor-icon elementor-animation-"> <i
                                                                aria-hidden="true" class="fas fa-shipping-fast"></i>
                                                        </span></div>
                                                    <div class="elementor-icon-box-content">
                                                        <h3 class="elementor-icon-box-title"> <span>
                                                            {{$offer->delivery_text!='' ? $offer->delivery_text : __('master.delivery')}} </span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-16 elementor-top-column elementor-element elementor-element-5004838e"
                                data-id="5004838e" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-49759fb1 elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
                                            data-id="49759fb1" data-element_type="widget"
                                            data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-icon-box-wrapper">
                                                    <div class="elementor-icon-box-icon"> <span
                                                            class="elementor-icon elementor-animation-"> <i
                                                                aria-hidden="true" class="fas fa-star"></i> </span>
                                                    </div>
                                                    <div class="elementor-icon-box-content">
                                                        <h3 class="elementor-icon-box-title"> <span> 
                                                        
                                                        {{$offer->pay_text!='' ? $offer->pay_text : __('master.guaranteed_results')}}
                                                            </span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-2031826c elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="2031826c" data-element_type="section">
                    <div class="elementor-background-overlay"></div>
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4ad11cf"
                                data-id="4ad11cf" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-1208c937 elementor-widget elementor-widget-heading"
                                            data-id="1208c937" data-element_type="widget"
                                            data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">
                                                   {{__('master.copyright')}}
                                                
                                                    Marssa ©{{ now()->year }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection