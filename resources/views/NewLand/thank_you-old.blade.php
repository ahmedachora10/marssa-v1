@extends('NewLand.master')
@section('head')
@endsection
@section('content')
     <div data-elementor-type="wp-page" data-elementor-id="10988" class="elementor elementor-10988">
        <div class="elementor-inner">
            <div class="elementor-section-wrap">
           <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-64f7bf3b elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="64f7bf3b" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-1d78423"
                                data-id="1d78423" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-4494baf7 elementor-widget elementor-widget-image"
                                            data-id="4494baf7" data-element_type="widget"
                                            data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image"> 
                                                <img decoding="async" width="950" style="height: 749px;"
                                                        height="550" src=src="@if(!empty($offer->featured_image) )
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
                                data-id="628e7e07" data-element_type="column">
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
                                                                {{ $offer['name_'.app()->getLocale()]}}
                                                                </b></span>
                                                            </h2>
                                                            <h2 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                <span style="color: #17a617;"><b>
                                                                {{ $offer->desc}}
                                                                </b></span>
                                                            </h2>
                                                            <h2 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                <span style="color: #17a617;"><b>
                                                                {{ $order->order_id}}
                                                                </b></span>
                                                            </h2>
                                                            <h2 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                <span style="color: #17a617;"><b>
                                                                {{ $order->name}}
                                                                </b></span>
                                                            </h2>
                                                            <h2 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                <span style="color: #17a617;"><b>
                                                                {{ $order->mobile}}
                                                                </b></span>
                                                            </h2>
                                                            <h2 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                <span style="color: #17a617;"><b>
                                                                {{ $order->address}}
                                                                </b></span>
                                                            </h2>
                                                            <h2 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                <span style="color: #17a617;"><b>
                                                                {{ $order->price}} {{ $order->currency}}
                                                                </b></span>
                                                            </h2>
                                                            <h2 style="margin-bottom: 1px;margin-top: 1px;padding-top: 1px;padding-bottom: 1px;">
                                                                <span style="color: #17a617;"><b>
                                                                {{ $order->created_at}}
                                                                </b></span>
                                                            </h2>
                                                            
                                                        </div>
                                                    </div>
                                                    
    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-52f61638 elementor-button-align-stretch elementor-widget elementor-widget-form"
                                            data-id="52f61638" data-element_type="widget"
                                            data-settings="{&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;button_width&quot;:&quot;100&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                                            data-widget_type="form.default">
                                            <div class="elementor-widget-container">
                                                
                                            </div>
                                        </div>
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
                                                                        style="color: #ff0000;">{{-- __('master.quantities_are_very_limited') --}}</span></strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>  <section style="z-index:10;"
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
                                                          {{$offer->delivery_text!='' ? $offer->delivery_text : __('master.delivery')}}
                                                      
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
                
               {{--  <section
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
                </section>--}}
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection