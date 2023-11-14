@extends('Store.master_5')
@section('head')
        <style>
.round_checkbox {
  display: inline-block;
  position: relative;
  margin: 0;
  align-items: center;
  width: 35px;
  height: 35px;
}
.round_checkbox h5 {
  font-size: 14px;
  font-weight: 500;
  font-family: "Circular Std Book";
  color: var(--text_color);
  margin-bottom: 0;
}.round_checkbox .label_name {
  font-size: 14px;
  font-weight: 500;
  font-family: "Circular Std Book";
  color: #656565;
  margin-bottom: 0;
}
.round_checkbox.white_checkbox .checkmark:after {
  border-color: #fff;
}.round_checkbox .checkmark {
    border: 1px solid #ccc !important;
  position: relative;
  width: 35px;
  height: 35px;
  top: 0;
  left: 0;
  display: block;
  cursor: pointer;
  line-height: 18px;
  flex: 35px 0 0;
  border-radius: 50%;
  border: 1px solid var(--border_color);
}

/* line 313, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox input {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  visibility: hidden;
}

/* line 323, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox input:checked ~ .checkmark {
  border-color: var(--base_color);
}

/* line 326, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox .checkmark::before {
  content: "";
  position: absolute;
  width: 25px;
  height: 25px;
  background: var(--base_color);
  border-radius: 50%;
  left: 4px;
  top: 4px;
}

/* line 336, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox input:checked ~ .checkmark::after {
  border-color: var(--base_color);
}

/* line 339, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox .checkmark:after {
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  content: "";
  width: 35px;
  height: 35px;
  background: transparent;
  border-radius: 50%;
  transition: 0.3s;
  transform: scale(1);
}

/* line 353, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.black_check input:checked ~ .checkmark {
  border-color: #000000;
}

/* line 356, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.black_check .checkmark::before {
  background: #000;
}

/* line 361, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.blue_check input:checked ~ .checkmark {
  border-color: #1f73be;
}

/* line 364, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.blue_check .checkmark::before {
  background: #1f73be;
}

/* line 369, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.gray_check input:checked ~ .checkmark {
  border-color: #d6d6d6;
}

/* line 372, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.gray_check .checkmark::before {
  background: #d6d6d6;
}

/* line 377, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.paste_check input:checked ~ .checkmark {
  border-color: #81d742;
}

/* line 380, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.paste_check .checkmark::before {
  background: #81d742;
}

/* line 385, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.brouwn_check input:checked ~ .checkmark {
  border-color: #dd9a32;
}

/* line 388, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.brouwn_check .checkmark::before {
  background: #dd9a32;
}

/* line 393, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.violate_check input:checked ~ .checkmark {
  border-color: #8224e2;
}

/* line 396, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.violate_check .checkmark::before {
  background: #8224e2;
}

/* line 401, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.red_check input:checked ~ .checkmark {
  border-color: #ef3736;
}

/* line 404, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.red_check .checkmark::before {
  background: #ef3736;
}

/* line 409, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.yellow_check input:checked ~ .checkmark {
  border-color: #eeee22;
}

/* line 412, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox.yellow_check .checkmark::before {
  background: #eeee22;
}

/* line 418, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox2 {
  display: inline-block;
  position: relative;
  margin: 0;
  align-items: center;
  width: 35px;
  height: 35px;
}

/* line 425, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox2 h5 {
  font-size: 14px;
  font-weight: 500;
  font-family: "Circular Std Book";
  color: var(--text_color);
  margin-bottom: 0;
}

/* line 432, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox2 .label_name {
  font-size: 14px;
  font-weight: 500;
  font-family: "Circular Std Book";
  color: #656565;
  margin-bottom: 0;
}

/* line 440, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox2.white_checkbox .checkmark:after {
  border-color: #fff;
}

/* line 444, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox2 .checkmark {
  position: relative;
  width: 35px;
  height: 35px;
  top: 0;
  left: 0;
  display: block;
  cursor: pointer;
  line-height: 18px;
  flex: 35px 0 0;
  border-radius: 50%;
  border: 1px solid var(--border_color);
}

/* line 457, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox2 input {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  visibility: hidden;
}

/* line 467, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox2 .check_bg_color {
  position: absolute;
  width: 25px;
  height: 25px;
  background: var(--base_color);
  border-radius: 50%;
  left: 4px;
  top: 4px;
}

/* line 476, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.round_checkbox2 input:checked ~ .checkmark {
  border-color: var(--base_color);
}

/* line 481, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox {
  display: inline-block;
  position: relative;
  margin: 0;
  align-items: center;
  width: 24px;
  height: 24px;
}

/* line 488, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox h5 {
  font-size: 14px;
  font-weight: 500;
  font-family: "Circular Std Book";
  color: var(--text_color);
  margin-bottom: 0;
}

/* line 495, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox .label_name {
  font-size: 14px;
  font-weight: 500;
  font-family: "Circular Std Book";
  color: #656565;
  margin-bottom: 0;
}

/* line 503, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.white_checkbox .checkmark:after {
  border-color: #fff;
}

/* line 507, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox .checkmark {
  position: relative;
  width: 24px;
  height: 24px;
  top: 0;
  left: 0;
  display: block;
  cursor: pointer;
  line-height: 18px;
  flex: 24px 0 0;
  border-radius: 50%;
}

/* line 519, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox input {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  visibility: hidden;
}

/* line 529, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox input:checked ~ .checkmark {
  border-color: var(--base_color);
}

/* line 532, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox .checkmark::before {
  content: "";
  position: absolute;
  width: 18px;
  height: 18px;
  background: var(--base_color);
  border-radius: 50%;
  left: 3px;
  top: 3px;
}

/* line 542, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox input:checked ~ .checkmark::after {
  border-color: transparent;
  transform: scale(0);
}

/* line 546, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox input:checked ~ .checkmark::before {
  width: 24px;
  height: 24px;
  left: 0;
  top: 0;
}

/* line 552, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox .checkmark:after {
  position: absolute;
  display: block;
  top: -1;
  left: -1;
  content: "";
  width: 24px;
  height: 24px;
  background: transparent;
  border-radius: 50%;
  transition: 0.3s;
  transform: scale(1);
  border: 1px solid #c3c6ce;
}


/* line 115, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_extra_style.scss */
.round_checkbox input:checked ~ .checkmark {
  border-color: transparent;
}
/* line 119, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_extra_style.scss */
.round_checkbox .checkmark::before {
  width: 31px;
  height: 31px;
  background: none;
  left: 1px;
  top: 1px;
}

/* line 127, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_extra_style.scss */
.round_checkbox input:checked ~ .checkmark::before {
  box-shadow: inset 0px 0px 0px 4px #f4f4f4;
}

/* line 131, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_extra_style.scss */
.color_List .size_btn {
  display: inline-block;
  border: 1px solid #e5dede;
  padding: 6px 19px;
  text-transform: uppercase;
  color: var(--text_color);
  margin-bottom: 10px;
  font-weight: 300;
  background-color: #fff;
  cursor: pointer;
}

/* line 143, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_extra_style.scss */
.selected_btn {
  border-color: var(--base_color) !important;
}
/* line 567, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.black_check input:checked ~ .checkmark {
  border-color: #000000;
}

/* line 570, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.black_check .checkmark::before {
  background: #000;
}

/* line 575, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.blue_check input:checked ~ .checkmark {
  border-color: #1f73be;
}

/* line 578, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.blue_check .checkmark::before {
  background: #1f73be;
}

/* line 583, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.gray_check input:checked ~ .checkmark {
  border-color: #d6d6d6;
}

/* line 586, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.gray_check .checkmark::before {
  background: #d6d6d6;
}

/* line 591, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.paste_check input:checked ~ .checkmark {
  border-color: #81d742;
}

/* line 594, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.paste_check .checkmark::before {
  background: #81d742;
}

/* line 599, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.brouwn_check input:checked ~ .checkmark {
  border-color: #dd9a32;
}

/* line 602, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.brouwn_check .checkmark::before {
  background: #dd9a32;
}

/* line 607, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.violate_check input:checked ~ .checkmark {
  border-color: #8224e2;
}

/* line 610, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.violate_check .checkmark::before {
  background: #8224e2;
}

/* line 615, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.red_check input:checked ~ .checkmark {
  border-color: #ef3736;
}

/* line 618, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.red_check .checkmark::before {
  background: #ef3736;
}

/* line 623, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.yellow_check input:checked ~ .checkmark {
  border-color: #eeee22;
}

/* line 626, ../../../../Note/SPONDON-IT/laragon/www/365-amazcart-ecommerce/public/frontend/amazy/scss/_predefine.scss */
.smallRound_checkbox.yellow_check .checkmark::before {
  background: #eeee22;
}
</style>
  
    <style>
        thumbnail{
            height:300px;
        }
        .slider-container{
            height:300px;
            
        }
        body, input, button, select, textarea {
            font-family: Cairo, sans-serif !important;
        }

        .navbar > *, .header > *, .footer > * {
            font-family: Cairo, sans-serif !important;
        }

        .single-product .single-submit {
            color: #ffffff;
            background-color: #EAB72A;
            border-color: transparent;
        }

        .single-product .single-visitors, .single-product .single-description, .single-product .single-quantity {
            color: #000000;
        }

        @media (max-width: 425px) {
            .slider-container .desktop-image {
                display: block !important;
                width: 40% !important;
            }
        }

        .single-description li {
            text-align: right;
        }

        .slick-arrow {
            color: #000000 !important;
        }

        .vue-star-rating-star[data-v-34cbeed1] {
            display: inline-block
        }

        .vue-star-rating-pointer[data-v-34cbeed1] {
            cursor: pointer
        }

        .vue-star-rating[data-v-34cbeed1] {
            display: flex;
            align-items: center
        }

        .vue-star-rating-inline[data-v-34cbeed1] {
            display: inline-flex
        }

        .vue-star-rating-rating-text[data-v-34cbeed1] {
            margin-top: 7px;
            margin-left: 7px
        }

        .vue-star-rating-rtl[data-v-34cbeed1] {
            direction: rtl
        }

        .vue-star-rating-rtl .vue-star-rating-rating-text[data-v-34cbeed1] {
            margin-right: 10px;
            direction: rtl
        }

        .vue-star-rating-star[data-v-21f5376e] {
            overflow: visible !important
        }


    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
          crossorigin="anonymous"/>
@endsection
@section('content')
    @if($offer ?? false)
        <script>
            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;
            let countDown = new Date("{{ Carbon\Carbon::parse($offer->end)->format('F d, Y H:i:s') }}").getTime(),
                x = setInterval(function () {
                    let now = new Date().getTime(),
                        distance = countDown - now;
                    document.getElementById('days').innerText = Math.floor(distance / (day));
                    document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour));
                    document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute));
                    document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
                }, second)
        </script>
        <div class="promo-code-section margin-top-100">
            <p>
                <span>{{ __('store.quickly_buy') }}</span>
                <span>
                    {{ round($product->price - $offer->discount) }} {{ $offer->getCurrency() }}@if(app()->getLocale() == "en") {{ __('store.discount') }}@endif
                </span>
            </p>
            <div class="countdown">
                <ul>
                    <li><span id="days"></span>{{ __('store.days') }}</li>
                    <li><span id="hours"></span>{{ __('store.Hours') }}</li>
                    <li><span id="minutes"></span>{{ __('store.Minutes') }}</li>
                    <li><span id="seconds"></span>{{ __('store.Seconds') }}</li>
                </ul>
            </div>
        </div>
    @endif
    <!-- Toast messages -->
    <flash></flash>
    <!-- App content -->

    <!--<main class="page-wrapper">-->

    <div class="container">
        <div class="row">
            <div class="single-product">
                <div>
                    <div class="container">
                        <div class="product-wrapper">
                            <div class="product-preview">
                                <div class="product-section preview-wrapper">
                                    <div class="thumbnail">
                                        <div id="section-xiYRXmErFPRQ0HUw"
                                             class="slider-container show-first-image horizontal medium">
                                            <div class="slider">
                                                @foreach($product->image??[] as $img)
                                                    <div class="slide">

                                                        <img class="mobile-image" src="{{asset($img)}}"
                                                             alt="slider-image"/>
                                                        <img class="desktop-image" src="{{asset($img)}}"
                                                             alt="slider-image"/>
                                                        <span class="slider-caption"> </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="product-section">
                                    <h1 class="single-title">  {{ $product['name_'.app()->getLocale()] }} </h1>
                                </div>
                                <div class="product-section preview-wrapper">
                                    <div class="thumbnail">
                                        <div id="section-xiYRXmErFPRQ0HUm"
                                             class="slider-container show-first-image horizontal medium">
                                            <div class="slider">
                                                @foreach($product->image ?? [] as $img)
                                                    <div class="slide">

                                                        <img class="mobile-image" src="{{asset($img)}}"
                                                             alt="slider-image"/>
                                                        <img class="desktop-image" src="{{asset($img)}}"
                                                             alt="slider-image"/>
                                                        <span class="slider-caption"> </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-section price-section">
                                    <h3 class="single-price">
                                        <span class="after currency-value"><span class="value">
                                            @if($offer ?? false)
                                                    <del class="px-2 text-secondary " style="font-size: 1rem">
                                                  {{ $product->price }}</del>
                                                @else
                                                    {{ $product->price }} {{ $product->getCurrency() }}
                                                @endif</span></span>
                                                
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                        <span class="before currency-value "
                                                                  ><span
                                                    class="value">{{ $product->price_before }}  </span></span> @endif
                                                    @endif
                                    </h3>
                            <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">
@if($product->type=='single' )
                                <div class="text-white btn-price  btn-lg bg-light px-3">
                                    
                                  <h3 class="mb-0 product-price-value" style="color:black">
                                       {{ $product->price }}  
                                                <span class="discount">
                                                {{ $product->price }}
                                            </span>
                                    </h3>
                                </div>
                                            @else
                                            
                                            @if($product->variations->count() > 0)
                                            <div style="display:grid">
                                    @foreach ($product->attributes as $attr )
                                    @if($attr)
                                                    
                                               @if($attr->display_type=='radio')
                                              
                                               <h5 clas="text-danger" style="margin-bottom: 2px;margin-top: 12px;">
                                                     {{$attr->attribute['name_'.app()->getLocale()]}}</h5>
                                                    <div class="d-flex">
                                                        @foreach (json_decode($attr->vals,true) as  $index=>$val)
                                                            <div class=""> 
                                                                    <div class="form-group mx-1" style="margin-bottom: 1px;">
                                                                        <input type="radio" name="attrval" id="attrval_{{$index}}" class="attrval" value="{{$val}}">
                                                                        <label for="attrval">{{$val}}</label>
                                                                    </div>
                                                                </div>
                                                        @endforeach 
                                                    </div>
                                                    @endif
                                                     
                                                    @if($attr->display_type=='color')
                                               <h5 clas="text-danger" style="margin-bottom: 2px;margin-top: 12px;">
                                                               {{$attr->attribute['name_'.app()->getLocale()]}}</h5>
                                                                <span id="colorName" class="colorName" style="color:black;"></span>
                                                                    <div class="color_List d-flex gap_5 flex-wrap ">
                                                                        @foreach (json_decode($attr->vals,true) as  $index=>$val)
                                                                          <label class="round_checkbox mx-1">
                                                                                <input id="radio-{{$index}}" name="color_filt"  style="margin-bottom: 1px;" class="attr_val_name" type="radio" color="{{$val}}" data-value="{{$val}}"
                                                                                 data-name="Color" data-value-key="{{$val}}" value="{{$val}}">
                                                                                <span class="checkmark colors_0 class_color_#6aa84f" style="background-color:{{$val}};">
                                                                                    <div class="check_bg_color"></div>
                                                                                </span>
                                                                            </label>
                                                                    @endforeach
                                                                </div>
                                                                
                                                    @endif
                                                    @if($attr->display_type=='select')
                                              
                                               <h5 clas="text-danger" style="margin-bottom: 2px;margin-top: 12px;">
                                                     {{$attr->attribute['name_'.app()->getLocale()]}}</h5>
                                                    <div class="form-group">
                                                       
                                                     <select class="form-control custom-select selectAttr" 
                                                     style="border: 1px solid #000;border-radius: 8px;" id="attrval" name="selectAttr">
                                                                        <option value="" selected disabled>{{__('master.choose_one')}}</option>
                                                                        
                                                                    @foreach (json_decode($attr->vals,true) as  $index=>$val)
                                                                        <option value="{{$val}}">{{$val}}</option>
                                                                    @endforeach
                                                                        
                                                                    </select>
                                                    </div>
                                                    @endif
                                            @endif
                                    @endforeach 
                                    </div>
                                            @endif
                                            @endif
                                </div><!---->
                                
                        @if($product->type =='variant' && $product->variations->count() > 0)
                        <div class="d-flex flex-col flex-nowrap px-2 pt-1">
                           {{-- @if($product->variations )
                                    {{$product->variations[0]}}
                                @endif
                                --}}
                                
                                {{--\App\ProductVariations::where('product_id',$product->id)->where('name',json_decode($product->attributes[1]->vals,true)[0] .'_'.json_decode($product->attributes[0]->vals,true)[0] )->get()->first()--}}
                            <div id="div_1" style="width: 100%;min-height=50">
                                <!--@if($product->attributes->count() == 1)-->
                                <!-- @if(\App\ProductVariations::where('product_id',$product->id)->where('name',json_decode($product->attributes[0]->vals,true)[0]  )->count() > 0)-->
                                <!--@include('Store.components.attributesVals',['variants'=>[\App\ProductVariations::where('product_id',$product->id)->where('name',json_decode($product->attributes[0]->vals,true)[0]  )->get()->first()] ?? null,'currency'=>$product->getCurrency() ?? null])</div>-->
                                <!--@endif-->
                                <!--@elseif($product->attributes->count() >1)-->
                                <!--@if(\App\ProductVariations::where('product_id',$product->id)->where('name',json_decode($product->attributes[1]->vals,true)[0] .'_'.json_decode($product->attributes[0]->vals,true)[0] )->count() > 0)-->
                                <!--@include('Store.components.attributesVals',['variants'=>[\App\ProductVariations::where('product_id',$product->id)->where('name',json_decode($product->attributes[1]->vals,true)[0] .'_'.json_decode($product->attributes[0]->vals,true)[0] )->get()->first()] ?? null,'currency'=>$product->getCurrency() ?? null])</div>-->
                                <!--@endif-->
                                <!--@endif-->
                            </div>
                        @endif

                                <div class="product-section price-section">
                                    @if($product->negotiation == 1)
                                        <h3 class="single-price" style="color:black">
                                            {{ __('master.product_negotiation') }}
                                        </h3>
                                    @endif
                                </div>
                                <div class="product-section price-section">
{{--                                    <h3 class="single-price" style="color:black">--}}
{{--                                        {{ $product->quantity }}    {{ __('store.product_available') }}--}}
{{--                                    </h3>--}}

                                </div>
                                <div class="product-section description-section">
                                    <div class="single-description fr-view">
                                        <p style="text-align: right;">
                                            {!! $product['content_'.app()->getLocale()] !!}
                                        </p>

                                    </div> <!---->
                                </div>
                                <div class="product-section add-to-cart-section">
                                   {{-- <div class="quantity" style="color:black">
                                        <span class="quantity-handler quantity-handler-left minus"><i
                                                    class="yc yc-minus"></i></span>
                                        <input id="quantity" name="quantity" type="number" class="single-quantity"
                                               value="1">
                                        <span class="quantity-handler quantity-handler-right plus"><i
                                                    class="yc yc-plus"></i></span>
                                    </div>
                                    --}}
                                    <button type="button"
                                            onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}},'checkout')"
                                            class="background_buy_now_button button single-submit">
                                        {{ __('master.buy_now')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sticky-cart-bar show-on-desktop show-on-mobile">
                        <div class="container">
                            <div class="product-section add-to-cart-section">
                                <div class="quantity">
                                    <span class="quantity-handler quantity-handler-left minus"><i
                                                class="yc yc-minus"></i></span>
                                    <input id="quantity2" name="quantity" type="number" class="single-quantity"
                                           value="1">
                                    <span class="quantity-handler quantity-handler-right plus"><i
                                                class="yc yc-plus"></i></span>
                                </div>
                                <button type="button"
                                        onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}},'checkout')"
                                        class="background_buy_now_button button single-submit">
                                    {{ __('master.buy_now')}}
                                </button>
                            </div>
                            <div class="share-box">

                            </div>
                        </div>
                    </div>
                    <div class="fixed-share-box">
                        <div class="share-box">

                        </div>
                    </div>
                    <section class="section section-reviews">
                      @include('Store.components.Rate')


                        <div class="container-fluid">
                            <div class="row">
                                <div class="clearfix"></div>
                                <div class="app-heading-2">
                                    <h2 style="font-size: 28px;color: rgb(245 52 70);" class="mt-4">
                                        <span>  @if(app()->getLocale() == 'ar') منتجات مرتبطة  @else Related
                                            Products @endif  </span>
                                    </h2>
                                </div>
                                @forelse($simlier as $product)
                                    <?php
                                    $getimg = [];
                                    if (isset($product->image)) {
                                        foreach ($product->image ?? [] as $img) {
                                            $last = last(explode('.', $img));
                                            if (in_array($last, ["jpg", "png", "gif"])) {
                                                $getimg[] = $img;
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                                        <div class="product-item">
                                            <a class="product-thumbnail lazy" href="{{ $product->route_details() }}">
                                                <img onclick="window.location.href='{{ $product->route_details() }}'"
                                                     data-src="@if(!empty($getimg) )
                                                     {{ asset($getimg[array_rand($getimg,1)]) }}
                                                     @else
                                                             https://semantic-ui.com/images/wireframe/image.png
@endif" alt="" class="">
                                            </a>
                                            <div class="product-details">
                                                <div class="product-info">
                                                    <h3 class="product-title">
                                                        <a href="{{ $product->route_details() }}"> {{ $product['name_'.app()->getLocale()] }} </a>
                                                    </h3>
                                                    <div class="product-price">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                            <span class="currency-value before">
                                                            <span class="value">  {{ $product->price_before }}  </span>
                                                            @endif
                                                            @endif
                                                    </span>
                                                        <span class="currency-value after">
                                                                @if($product->get_current_offer() ?? false)
                                                                {{ round($product->get_current_offer()->discount) }} {{ $product->getCurrency() }}

                                                                {{ $product->price }}
                                                            @else
                                                                {{ $product->price }} {{ $product->getCurrency() }}
                                                            @endif
                                                    <span class="value"></span>
                                            </span>
                                                    </div>
                                                </div>
                                                <div class="product-actions">
                                                    <a class="background_buy_now_button button small-button secondary-button"
                                                       style="margin-bottom:10px"
                                                       href="{{ $product->route_details() }}">

                                                        {{ __('master.buy_now') }}
                                                    </a>
                                                    <button class="background_add_to_cart_button button small-button secondary-button"
                                                            onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})">

                                                        {{ __('master.add_to_cart') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!--</main>-->
@endsection



@section('script')
    <script type="text/javascript" src="js/jquery.rating.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"
            integrity="sha512-4kpSNboTxdWYwnZCaqnuwO3gGFaZTAhBT6ygWNdpeNrpGnw/rjweaxQ2C9OgwERR5RBWlIQ+Yh9lLce5+jNpVA=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-uni/theme.min.js"
            integrity="sha512-gKhUOikEITx8bym+96IpTS8Fgy3a2g0FVeAb/OrmI09da7lYqZSwNciZCmWi5FzQWGkRHM2JcmQUG50XGKt0EA=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/locales/ar.js"
            integrity="sha512-j9dWyLBFRier7ykZJL8CLGyb1WW6xVkkrV3lHFQxRRTtXHt7UbWnrcOWKHvxWAydyEtjIF1Fs/Xao0AaBLWrmA=="
            crossorigin="anonymous"></script>
    <script src="{{ asset('dashboard/light/assets/editor/summernote-lite.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/lang/summernote-ar-AR.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/title_image.js') }}"></script>
    <script>

     $(document).on('change','.selectAttr',function(){
        console.log('select change',$(this).val());
          if($('input[name="attrval"]:checked').val()  != undefined){
                    data=  {name:$(this).val()+'_'+$('input[name="attrval"]:checked').val() ,
                    name1:$('input[name="attrval"]:checked').val() +'_'+$(this).val(),product_id:$('#product_id').val(),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    };
              }else if($('input[name=color_filt]:checked').val()!= undefined){
                  console.log($('input[name=color_filt]:checked').val());
                    data=  {name:$(this).val()+'_'+$('input[name=color_filt]:checked').val(),
                    name1:$('input[name=color_filt]:checked').val()+'_'+$(this).val(),product_id:$('#product_id').val(),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    };
                  
              }
              else{
                   data=  {name:$(this).val(),name1:$(this).val(),product_id:$('#product_id').val(),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   };
              }
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
//                    "url": "https://marssas2.marssa.shop/api/getVariants",
                    "url": "<?php echo"https://". $store->domain .".marssa.shop/api/getVariants";?>",
                    type:"GET",
                    data:data,
                    cors:true,
                    success:function(data)
                    {
                        $('#div_1').removeClass('hidden');
                        $('#div_1').html('');
                        $('#div_1').html(data);
                    },
                    error:function(data)
                    {
                        $('#div_1').addClass('hidden');
                        console.log('error', data)
                    }
                });
        
     });
     $(document).on('change','.attrval',function(){
        console.log('radio change',$(this).val())
          if($(this).is(':checked')){
              console.log($(this).val(), ' - ',$('input[name=color_filt]:checked').val())
              if($('input[name=color_filt]:checked').val() != undefined){
                    data=  {name:$(this).val()+'_'+$('input[name=color_filt]:checked').val(),
                    name1:$('input[name=color_filt]:checked').val()+'_'+$(this).val(),product_id:$('#product_id').val(),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    };
              }else if($('.selectAttr').val() != undefined){
                  console.log($('.selectAttr').val());
                    data=  {name:$(this).val()+'_'+$('.selectAttr').val(),
                    name1:$('.selectAttr').val()+'_'+$(this).val(),product_id:$('#product_id').val(),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    };
                  
              }
              else{
                   data=  {name:$(this).val(),name1:$(this).val(),product_id:$('#product_id').val(),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   };
              }
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
//                    "url": "https://marssas2.marssa.shop/api/getVariants",
                    "url": "<?php echo"https://". $store->domain .".marssa.shop/api/getVariants";?>",
                    type:"get",
                    data:data,
                    cors:true,
                    success:function(data)
                    {
                        $('#div_1').removeClass('hidden');
                        $('#div_1').html('');
                        $('#div_1').html(data);
                    },
                    error:function(data)
                    {
                        $('#div_1').addClass('hidden');
                        console.log('error', data)
                    }
                });
          }
    });
     $(document).on('click', '.attr_val_name ', function(){
                $(this).parent().parent().find('.attr_value_name').val($(this).attr('data-value')+'-'+$(this).attr('data-value-key'));
                $(this).parent().parent().find('.attr_value_id').val($(this).attr('data-value')+'-'+$(this).attr('data-value-key'));
                if ($(this).attr('color') == "color") {
                    $(this).closest('.color_List').find('.attr_clr').removeClass('selected_btn');
                }
                if ($(this).attr('color') == "not") {
                    $(this).closest('.color_List').find('.not_111').removeClass('selected_btn');
                }
                $(this).addClass('selected_btn');
                
          //  $('#div_1').text($('input[name=attrval]:checked').val()+'_'+$(this).val() )
        console.log('color change',$(this).val(),'select',$('.selectAttr').val())
        let data=[];
              if($('input[name="attrval"]:checked').val() != undefined){
                    data=  {name:$(this).val()+'_'+$('input[name="attrval"]:checked').val(),name1:$('input[name="attrval"]:checked').val()+'_'+$(this).val(),product_id:$('#product_id').val(),
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 };
              }
              else if($('.selectAttr').val() != undefined){
                  console.log($('.selectAttr').val());
                    data=  {name:$(this).val()+'_'+$('.selectAttr').val(),
                    name1:$('.selectAttr').val()+'_'+$(this).val(),product_id:$('#product_id').val(),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    };
                  console.log('data',data);
              }
              else{
                   data=  {name:$(this).val(),name1:$(this).val(),product_id:$('#product_id').val(),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
            
              }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
//                    "url": "https://marssas2.marssa.shop/api/getVariants",
                    "url": "<?php echo"https://". $store->domain .".marssa.shop/api/getVariants";?>",
                    type:"GET",
                    data:data,
                    cors:true,
                    success:function(data)
                    {
                        $('#div_1').removeClass('hidden');
                        $('#div_1').html('');
                        $('#div_1').html(data);
                    },
                    error:function(data)
                    {
                        $('#div_1').addClass('hidden');
                        console.log('error', data)
                    }
                });  
     });

        $(document).ready(function () {
            $('.star_disabled').rating({
                hoverOnClear: false,
                disabled: true,
                rtl: true,
                theme: 'krajee-uni',
                language: 'ar',
                step: 1,
            });
            $('.submit_review').rating({
                hoverOnClear: false,
                rtl: true,
                theme: 'krajee-uni',
                language: 'ar',
                step: 1,
            });
            $('#content').summernote({
                toolbar: [
                    ['insert', ['picture']],
                ],
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
                height: 'auto',
                tabsize: 2
            });
        });

        $("#submit_review").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function (data) {
                    if (data.success) {
                        Swal.fire({
                            title: data.response,
                            icon: 'success',
                            // toast:false,
                            // position: 'top-end',
                            timerProgressBar: true,
                            timer: 5000,
                            showConfirmButton: false
                        });
                    }
                    $("#submit_review")[0].reset();
                    $('#content').summernote('reset');
                }
            });
        });
    </script>








    <script type='application/ld+json'>
  {"@context":"https://schema.org/","@type":"Product","name":"\u0641\u0631\u0634\u0627\u0629 \u0633\u064a\u0644\u064a\u0643\u0648\u0646 \u0644\u0644\u0627\u0633\u062a\u062d\u0645\u0627\u0645 \u064a\u0648\u0636\u0639 \u0641\u064a \u062f\u0627\u062e\u0644\u0647\u0627 \u062c\u0644","image":"https://cdn.ycan.shop/stores/e783bea461683c42569f0bece9bcfa92/products/Elx1XuhKyxsYlTE2VIbwCBg98KDdesSdcPRdsgpF_md.jpeg","description":"\u062a\u0635\u0645\u064a\u0645 \u062c\u062f\u064a\u062f \u0627\u062b\u0646\u064a\u0646 \u0641\u064a \u0648\u0627\u062d\u062f: \u0641\u0631\u0634\u0627\u0629 \u0644\u064a\u0641\u0629 \u0627\u0644\u0627\u0633\u062a\u062d\u0645\u0627\u0645 \u0627\u0644\u0645\u0635\u0646\u0648\u0639\u0629 \u0645\u0646 \u0627\u0644\u0633\u064a\u0644\u064a\u0643\u0648\u0646 \u0644\u062f\u064a\u0647\u0627 \u0648\u0638\u0627\u0626\u0641 \u0645\u0648\u0632\u0639 \u062c\u0644 \u0627\u0644\u0627\u0633\u062a\u062d\u0645\u0627\u0645 \u0648\u0641\u0631\u0634\u0627\u0629 \u062a\u062f\u0644\u064a\u0643 \u0627\u0644\u062c\u0633\u0645. \u064a\u0645\u0643\u0646 \u062a\u062e\u0632\u064a\u0646 \u062c\u0644 \u0627\u0644\u0627\u0633\u062a\u062d\u0645\u0627\u0645 80 \u0645\u0644 \u0641\u064a \u0641\u0631\u0634\u0627\u0629 \u0627\u0644\u0627\u0633\u062a\u062d\u0645\u0627\u0645 \u0647\u0630\u0647. \u064a\u0645\u0643\u0646\u0643 \u0627\u0644\u0636\u063a\u0637 \u0639\u0644\u0649 \u0641\u0631\u0634\u0627\u0629 \u0627\u0644\u0627\u0633\u062a...","offers":{"@type":"Offer","priceCurrency":"XOF","price":350,"availability":"https://schema.org/InStock","seller":{"@type":"Store","name":"\u0643\u0648\u0631\u0646 \u0634\u0648\u0628","image":"https://cdn.ycan.shop/stores/cornshop/others/bS5Xfkr9Cd8KQtHjZcSGum9XKXTVVbHN1xTPIy3d.png","logo":"https://cdn.ycan.shop/stores/cornshop/others/bS5Xfkr9Cd8KQtHjZcSGum9XKXTVVbHN1xTPIy3d.png"}},"category":"\u0627\u0644\u0641\u0626\u0629 \u0627\u0644\u0627\u0641\u062a\u0631\u0627\u0636\u064a\u0629"}



    </script>
    <script src="https://static3.youcan.shop/store-front/js/bootstrap.js?id=cbab8543a95e4c786082"></script>
    <script src="https://static3.youcan.shop/store-front/js/app.js?id=7afa8c14cae20da4adfd"></script>
    <script src="https://static3.youcan.shop/store-front/js/product/app.js?id=690542b661747a92b7f3"></script>
    <!-- Custom JavaScript code -->

    <script type="text/javascript">
        $(document).ready(function () {
            $('.minus').click(function () {
                console.log('rrr');
                //var $input = $(this).parent().find('input');
                var $input = $('#quantity');
                var $input1 = $('#quantity2');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                $input1.val(count);
                $input1.change();
                return false;
            });
            $('.plus').click(function () {
                var $input1 = $('#quantity');
                var $input = $('#quantity2');

                $input1.val(parseInt($input.val()) + 1);
                $input1.change();
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
            $('.review-button').click(function () {
                $(".review-model").show();
            });
            $('.close').click(function () {
                $(".review-model").hide();
            });
        });

    </script>




    <script type="module">
        function isMobileView() {
            var newWindowWidth = $(window).width();
            if (newWindowWidth < 700) {
                return true;
            } else {
                return false;
            }
        }


        //   let sliderId = "section-xiYRXmErFPRQ0HUw",
        let sliderId = isMobileView() ? "section-xiYRXmErFPRQ0HUm" : "section-xiYRXmErFPRQ0HUw",
            direction = "horizontal",
            frequency = "5",
            customHeight = null,
            slideImages = document.querySelectorAll(isMobileView() ? '.mobile-image' : '.desktop-image');
        console.log('mobile', isMobileView());
        Array.from(slideImages).forEach(image => {
            image.remove();
        });
        console.log('slider', slideImages);
        if (!isMobileView() && customHeight !== null) {
            document.getElementById(`${sliderId}`).style.height = `${customHeight}px`;
        }

        let slickOptions = {
            dots: true,
            infinite: false,
            arrows: direction === "horizontal" ? true : false,
            speed: 1000,
            autoplay: true,
            autoplaySpeed: frequency * 1000,
            slidesToShow: 1,
            slidesToScroll: 1,
            vertical: direction !== "horizontal" ? true : false,
            verticalSwiping: direction !== "horizontal" ? true : false,
            rtl: $('html').attr('dir') == 'rtl' && direction === "horizontal" ? true : false
        };

        $(`#${sliderId} .slider`).slick(slickOptions);

        // Document Ready
        document.addEventListener("DOMContentLoaded", () => {
            $(`#${sliderId}`).removeClass('show-first-image');
        });
    </script>



@endsection
