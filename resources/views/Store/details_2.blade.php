@extends('Store.master_2')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
          crossorigin="anonymous"/>
{{--
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
          integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
          crossorigin="anonymous"/>
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
        .select-custom {
            display: inline-block;
            cursor: pointer;
            outline: none;
            border-radius: .25rem !important;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem 1.75rem .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: rgb(73, 80, 87);
            vertical-align: middle;
            background-color: rgb(255, 255, 255);
            border: 1px solid rgb(206, 212, 218);
        }

        .select-custom:hover {
            border: 1px solid rgb(186, 192, 197) !important;
        }

        .select-custom:focus {
            border: 1px solid rgb(0, 180, 120) !important;
            box-shadow: 0 0.313rem 0.719rem rgba(0, 105, 70, 0.1), 0 0.156rem 0.125rem rgba(0, 0, 0, 0.06) !important;
        }

        .description {
            font-weight: 500;
            font-size: 20px;
        }

        .description li {
            font-size: 15px !important;
        }

        @media screen and (-webkit-min-device-pixel-ratio: 0) {
            .select-custom {
                background: #ffffff;
            }
        }

        .discount {
            position: absolute;
            display: inline-block;
            background: burlywood;
            color: #eee;
            padding: 11px;
            right: -11px;
        }

        .discount:before {
            content: '';
            position: absolute;
            height: 0;
            width: 0;
            top: 100%;
            right: 0;
            border-top: 10px solid #000000;
            border-right: 10px solid transparent;
        }


    </style>
    <style>
        .show-mobile {
            display: none !important;
        }

        @media screen and (min-device-width: 81px) and (max-device-width: 768px) {
            /* STYLES HERE */
            .xs-hidden {
                display: none !important;
            }

            .toTop {
                display: none !important;
            }

            .checkoutbtn {
                position: fixed;
                bottom: 0px;
                z-index: 9999;
                width: 100%;
                box-shadow: -1px -5px 9px #23222226;
            }

            .show-mobile {
                display: block !important;
            }

            .pt-5, .py-5 {
                padding-top: 0px !important;
            }

            .main-logo {
                max-width: 43%;
            }

            .top-mobile {
                margin-top: -60px !important;
            }

            .review-block-description {
                width: 415px !important;;
                overflow: hidden !important;;
            }
        }

        .review-block-description {
            width: 715px;
            overflow: hidden;
        }


        .custpm .rating-md .caption {
            font-size: 12px !important;
        }

        .theme-krajee-uni .star {
            font-size: 20px !important;
        }

        .theme-krajee-uni .clear-rating {
            font-size: 10px !important;;
        }

        .checkout-form th, .checkout-form td {
            font-family: dinnextltw23, 'sans-serif' !important;
            font-weight: normal;
            color: black;
        }

        .checkout-form .order-confirm-sheet .order-review {
            border: 1px solid #e5e5e5;
            padding: 50px 40px;
        }

        .checkout-form .order-confirm-sheet .order-review .product-review {
            width: 100%;
        }

        .theme-btn {
            background-color: #fff;
            border-radius: 40px;
            bottom: 10px;
            color: #fff;
            display: table;
            height: 70px;
            left: 20px;
            min-width: 70px;
            position: fixed;
            text-align: center;
            z-index: 9999
        }

        .theme-btn i {
            font-size: 30px;
            line-height: 70px
        }

        .theme-btn.bt-support-now {
            background: #1ebbf0;
            background: -moz-linear-gradient(45deg, #1ebbf0 8%, #39dfaa 100%);
            background: -webkit-linear-gradient(45deg, #1ebbf0 8%, #39dfaa 100%);
            background: linear-gradient(45deg, #1ebbf0 8%, #39dfaa 100%);
            bottom: 70px
        }

        .theme-btn.bt-buy-now {
            background: #1fdf61;
            background: -moz-linear-gradient(top, #a3d179 0, #88ba46 100%);
            background: -webkit-linear-gradient(top, #a3d179 0, #88ba46 100%);
            background: linear-gradient(to bottom, #a3d179 0, #88ba46 100%)
        }

        .theme-btn:hover {
            color: #fff;
            padding: 0 20px
        }

        .theme-btn span {
            display: table-cell;
            vertical-align: middle;
            font-size: 16px;
            letter-spacing: -15px;
            opacity: 0;
            line-height: 50px;
            transition: all .5s;
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            text-transform: uppercase
        }

        .theme-btn:hover span {
            opacity: 1;
            letter-spacing: 1px;
            padding-left: 10px
        }

        #big .item {
            padding: 0px 0px;
            margin: 2px;
            color: #FFF;
            border-radius: 3px;
            text-align: center;
        }

        #thumbs .item {
            height: 70px;
            line-height: 70px;
            padding: 0px;
            margin: 2px;
            color: #FFF;
            border-radius: 3px;
            text-align: center;
            cursor: pointer;
        }

        #thumbs .item h1 {
            font-size: 18px;
        }

        .owl-theme .owl-nav [class*='owl-'] {
            -webkit-transition: all .3s ease;
            transition: all .3s ease;
        }

        #big.owl-theme {
            position: relative;
        }

        #big.owl-theme .owl-next, #big.owl-theme .owl-prev {
            border-radius:50%;
            background: #333;
            width: 22px;
            line-height: 40px;
            height: 40px;
            margin-top: -20px;
            position: absolute;
            text-align: center;
            top: 50%;
        }
        #big.owl-theme .owl-next, #big.owl-theme .owl-prev i{
            color:#fff;
        }
        #big.owl-theme .owl-prev {
            left: 10px;
        }

        #big.owl-theme .owl-next {
            right: 10px;
        }

        #thumbs.owl-theme .owl-next, #thumbs.owl-theme .owl-prev {
            background: #333;
        }


        .minus, .plus {
            width: 20px;
            background: #f2f2f2;
            border-radius: 4px;
            border: 1px solid #ddd;
            display: inline-block;
            vertical-align: middle;
            text-align: center;
            cursor: pointer;
        }

        .quantity_counter {
            height: 34px;
            width: 100px;
            text-align: center;
            font-size: 26px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
    </style>
    <style>
        .select-custom {
            display: inline-block;
            cursor: pointer;
            outline: none;
            border-radius: .25rem !important;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem 1.75rem .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: rgb(73, 80, 87);
            vertical-align: middle;
            background-color: rgb(255, 255, 255);
            border: 1px solid rgb(206, 212, 218);
        }

        .select-custom:hover {
            border: 1px solid rgb(186, 192, 197) !important;
        }

        .select-custom:focus {
            border: 1px solid rgb(0, 180, 120) !important;

        }

        @media screen and (-webkit-min-device-pixel-ratio: 0) {
            .select-custom {
                background: #ffffff;
            }
        }
    </style>
    <style>
        .shadow-sm {
            box-shadow: none !important;
        }

        .swiper-container {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .mySwiper2 {
            height: 80%;
            width: 100%;
        }

        .mySwiper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .mySwiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    <style>
        .btn-price {
            color: #9a33c7 !important;
            font-size: 21px;
            border: 1px dotted;
            font-weight: 400;
            box-shadow: 1px 3px 6px 2px #9a33c71f;
            background: transparent;
            display: block;

        }
        .owl-carousel .owl-stage{
            height:345px !important;
        }
        .owl-stage-outer.owl-height{
            height:fit-content !important;
            max-height:fit-content !important;
            margin-bottom:5px !important;
        }
        .owl-carousel .owl-item img{
            height:100% !important;
        }
        .section-details > .container{
            padding:18px;
        }
    </style>
@endsection
@section('content')
    <?php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <section class="container-fluid bg-light py-5 p-0">

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
                    {{ round($product->price - $offer->discount) }} {{-- $offer->getCurrency() --}}@if(app()->getLocale() == "en") {{ __('store.discount') }}@endif
                </span>
                </p>
                <div class="countdown">
                    <ul style="direction: ltr !important;">
                        <li><span id="days"></span>{{ __('store.days') }}</li>
                        <li><span id="hours"></span>{{ __('store.Hours') }}</li>
                        <li><span id="minutes"></span>{{ __('store.Minutes') }}</li>
                        <li><span id="seconds"></span>{{ __('store.Seconds') }}</li>
                    </ul>
                </div>
            </div>
        @endif
        <div class="container mb-3 ">

            <div class="row" id="app">
                <a onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}},'checkout')"
                   class="btn btn-danger  btn-lg background_buy_now_button show-mobile checkoutbtn">
                    <h4 class="text-white ">{{__('master.Complete the order')}}</h4>
                </a>
                <!-- preview products-->
                <div class="col-lg-5 py-2 section-details" style="overflow: hidden;">
                    <h3 class="text-secondary show-mobile mb-3 mb-3 text-center text-secondary">{{ $product['name_'.app()->getLocale()] }} </h3>
                  {{--  <div style="--swiper-navigation-color: black; --swiper-pagination-color: #fff"
                         class="swiper-container mySwiper2">
                        <div class="swiper-wrapper">

                            @foreach($product->image as $img)
                                <div class="swiper-slide">
                                    <?php
                                    $getlast = last(explode('.', $img));
                                    ?>
                                    @if(in_array($getlast,['jpg','jpeg','svg','png','gif','webp']))
                                        <a href="{{asset($img)}}" data-lightbox="roadtrip">
                                            @if($product->type =='single' )
                                                <span class="discount">
                                                {{ $product->price }}
                                            </span>
                                            @else
                                            @if($product->variations->count() > 0)
                                            @foreach($product->variations as $vari)
                                                {{$vari->price}}
                                            @endforeach
                                            @endif
                                            @endif
                                            <img src="{{asset($img)}}">
                                        </a>

                                    @else
                                        <video controls style="width: 100%">
                                            <source src="{{asset($img)}}">
                                        </video>
                                    @endif
                                </div>
                            @endforeach


                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                    <div class="container bg-light rounded" >


                        <div thumbsSlider="" class="swiper-container mySwiper">
                            <div class="swiper-wrapper">


                                @foreach($product->image as $img)
                                    <div class="swiper-slide">
                                        <?php
                                        $getlast = last(explode('.', $img));
                                        ?>
                                        @if(in_array($getlast,['jpg','jpeg','svg','png','gif','webp']))

                                            <img src="{{asset($img)}}">
                                        @else

                                            <video controls style="width: 100%">
                                                <source src="{{asset($img)}}">
                                            </video>


                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>


                    </div>--}}
                     <div class="mx-0 container bg-white rounded" style="    height: 460 !important;">
                         @if(isset($product->image))
                            <div id="big" class="owl-carousel owl-theme">

                                @foreach($product->image as $img)
                                    <?php
                                    $getlast = last(explode('.', $img));
                                    ?>
                                    @if(in_array($getlast,['jpg','jpeg','svg','png','gif','webp']))
                                        <div class="item" style="height:100%"><img src="{{asset($img)}}" ></div>
                                    @else
                                        <div class="item-video" data-merge="2">
                                            <video controls style="width: 100%">
                                                <source src="{{asset($img)}}">
                                            </video>
                                        </div>

                                    @endif

                                @endforeach
                            </div>
                            <div id="thumbs" class="owl-carousel owl-theme">
                                @foreach($product->image as $img)
                                    <?php
                                    $getlast = last(explode('.', $img));
                                    ?>
                                    @if(in_array($getlast,['jpg','jpeg','svg','png','gif','webp']))
                                        <div class="item"><img src="{{asset($img)}}"></div>
                                    @else
                                        <div class="item-video" data-merge="2">
                                            <video controls style="width: 100%">
                                                <source src="{{asset($img)}}">
                                            </video>
                                        </div>

                                    @endif

                                @endforeach
                            </div>
                         @endif
                     </div>
                </div> 
                
                <div class="col-lg-7 pt-5 pb-lg-5 pb-2 section-details">
                    <div class="container">
                        <h3 class="text-secondary mb-3">{{ $product['name_'.app()->getLocale()] }} </h3>
                        <p class="text-muted">
                       {{-- <ul class="rating">
                            @if(count($product->orders()->get()) > 0)
                                <li>{{ $product->orders()->sum('quantity') .' '. __('store.sold') }}</li>
                            @endif
                        </ul>--}}
                        </p>

                        <p class="row custpm">
                            <input class="kv-ltr-theme-uni-star rating-loading star_disabled" value="{{$rate_avg}}"
                                   data-size="md">
                        </p>
                        <div class="d-flex flex-nowrap p-2">
                            @if($product->status1==1)
                                @if(!empty($product->price_before))
                                <del class="px-2 text-secondary " style='margin-top: 10px;color:red !important;text-decoration:line-through'>
                                    {{ $product->price_before }} 
                                </del>
                                @endif
                            @endif
                            <span class="">{{$product->price}}</span>
                        </div>
                        <div class="d-flex flex-nowrap p-2">
                            
                            <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">
                               {{--     {{ $product->price }}  $product->getCurrency() --}}
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
                                            <div style="display:grid;width: 100%;justify-content: start;">
                                    @foreach ($product->attributes as $attr )
                                    @if($attr)
                                               @if($attr->display_type=='radio')
                                              
                                               <h5 clas="text-danger" style="margin-bottom: 2px;margin-top: 12px;">
                                                     {{$attr->attribute['name_'.app()->getLocale()]}}</h5>
                                                    <div class="d-flex">
                                                        @foreach (json_decode($attr->vals,true) as  $index=>$val)
                                                            <div class=""> 
                                                                    <div class="form-group mx-1" style="margin-bottom: 1px;">
                                                                        <input type="radio" name="attrval" class="attrval" id="attrval_{{$index}}" value="{{$val}}">
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
                                                                    <hr/>
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
                                                                        <option value="{{$val}}" >{{$val}}</option>
                                                                    @endforeach
                                                                        
                                                                    </select>
                                                    </div>
                                                    @endif
                                            @endif
                                    @endforeach 
                                    </div>
                                            @endif
                                            @endif
                                @if($offer ?? false)
                                    <del class="px-2 text-secondary " style="font-size: 1rem">
                                        {{ $product->price }}</del>
                                @endif
                           {{-- </div>--}}
                            @if($offer ?? false)
                                <span class="px-2 text-secondary " style="font-size: 1rem">
                           {{ round($offer->discount) }} {{-- $product->getCurrency() --}}
                           </span>
                            @endif



                        </div>
                        @if($product->type =='variant' && $product->variations->count() > 0)
                        <div class="d-flex flex-col flex-nowrap px-2 pt-1">
                           {{-- @if($product->variations )
                                    {{$product->variations[0]}}
                                @endif
                                --}}
                                
                                
                                {{--\App\ProductVariations::where('product_id',$product->id)->where('name',json_decode($product->attributes[1]->vals,true)[0] .'_'.json_decode($product->attributes[0]->vals,true)[0] )->get()->first()--}}
                            <div id="div_1" style="width: 100%;">
                                <!--@if($product->attributes->count() == 1)-->
                                <!-- @if(\App\ProductVariations::where('product_id',$product->id)->where('name',json_decode($product->attributes[0]->vals,true)[0]  )->count() > 0)-->
                                <!--@include('Store.components.attributesVals',['variants'=>[\App\ProductVariations::where('product_id',$product->id)->where('name',json_decode($product->attributes[0]->vals,true)[0]  )->get()->first()] ?? null,'currency'=>$product->getCurrency() ?? null])</div>-->
                                <!--@endif-->
                                <!--@elseif($product->attributes->count() >1)-->
                                <!--@if(\App\ProductVariations::where('product_id',$product->id)->where('name',json_decode($product->attributes[1]->vals,true)[0] .'_'.json_decode($product->attributes[0]->vals,true)[0] )->count() > 0)-->
                                <!--@include('Store.components.attributesVals',['variants'=>[\App\ProductVariations::where('product_id',$product->id)->where('name',json_decode($product->attributes[1]->vals,true)[0] .'_'.json_decode($product->attributes[0]->vals,true)[0] )->get()->first()] ?? null,'currency'=>$product->getCurrency() ?? null])</div>-->
                                <!--@endif-->
                                <!--@endif-->

                                <div id="div_z" style="width: 100%; display:none">
                                    <div class="d-flex justify-content-between">
                                    <div style="display:grid;width: 100%;">
                                       <span id="selectedVarinatName"></span>
                                         <input type="hidden" id="selectedVarinat" name="selectedVarinat" value="" class="form-control">
                                         <input type="hidden" id="selectedVarinatId" name="selectedVarinatId" value="" class="form-control">
                                       <div>
                                            السعر
                                            <span id="selling_price">
                                                <input type="hidden" id="selectedPrice" name="selectedPrice" value="0" class="form-control">
                                               <span class="text-danger" id="selling_price_new">0</span>  <span id="currency"></span>
                                            </span>
                                        </div>
                                        <div>
                                            <span id="total"></span> 
                                        </div>
                                    </div>
                            </div>
                                        
                                    <hr>
                            <div style="display:inline-flex;justify-content:space-between;width:100%;">
                                <div class="row p-2 align-items-center">
                                    <div class=" d-flex flex-nowrap p-2 align-items-center px-1 w-100">
                                        <span class="text-muted px-2" id="available">0</span>
                                        <div class="quantity d-flex flex-nowarp align-items-center">
                                         <span id="quantity1" class="count quantity-count mx-2">
                                         منتج متاح في المخزن
                                         </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="2391" id="product">
                                <div class="product-section add-to-cart-section">
                                    <div class="form-group quantity " style="color:black">
                                        <span class="minus quantity-handler quantity-handler-left">-</span>
                                        <input class="quantity_counter single-quantity" id="quantity" name="quantity" min="1" max="5" type="number" value="1">
                                        <span class=" quantity-handler quantity-handler-right plus">+</span>
                                    </div>
                                </div>
                            </div>  
                        
                        </div>

                        </div>
                        @endif
                        <div class="d-flex flex-nowrap px-2 pt-1">
                            @if($product->negotiation == 1)
                                <h3 class="badge badge-success" style="color:black">
                                    {{ __('master.product_negotiation') }}
                                </h3>
                            @endif
                        </div>

                        <div class="py-2 px-md-5 px-1 m-auto" style="width: 100%">


                        </div>


                        @if($product->variations->count() ==0)
                        <hr>
                        <div class="row p-2 align-items-center">
                            <div class="col-lg-5 col-12 d-flex flex-nowrap p-2 align-items-center px-1 w-100">
                                <span class="text-muted px-2">{{ $product->quantity }} </span>
                                <div class="quantity d-flex flex-nowarp align-items-center">
                                 <span id="quantity1" class="count quantity-count mx-2">
                                 {{ __('store.product_available') }}
                                 </span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row p-2">
                        @if($product->variations->count() ==0)
                            <input type="hidden" name="id" value="6" id="product">

                            <div class="form-group">
                                <span class="minus">-</span>
                                <input class="quantity_counter" id="quantity" name="quantity" type="text" value="1"/>
                                <span class="plus">+</span>
                            </div>
                        @endif

                            <div class="col-lg-12 col-12 px-1 w-100 mb-2 d-flex justify-content-center">
                                <div class="col-md-6 d-flex justify-content-center px-0">
                                <button type="submit" id="addToCart"
                                        onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}},'checkout')"
                                        class="btn btn__checkout px-4 py-2 xs-hidden shadow-sm  btn-block text-nowrap">
                                    اشتري الان <i class="fa fa-truck" style="color: #005a3c;"></i></button>
                                </div>
                             </div>
                            <div class="col-lg-12 col-12 px-1 w-100 mb-2 d-flex justify-content-center">
                                <div class="col-md-6 d-flex justify-content-center px-0">
                                <button type="button" data-target="1"
                                        onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"
                                        class="btn xs-hidden btn-block btn-theme px-4 py-2 text-nowrap addToCart">اضف
                                    الى السلة <i class="fa fa-shopping-cart" style="color: #005a3c;"></i></button>
                                </div>
                            </div>

{{--                            <a class="btn btn-outline-success btn-block"--}}
{{--                               target="_blank"--}}
{{--                               href="https://wa.me/send?text={{ route('store.product_details_ads',['sub_domain'=> $product->store->domain,'id'=>$product->id]) }}"><i--}}
{{--                                        class="fab fa-whatsapp"></i>--}}
{{--                            </a>--}}
                        </div>


                    </div>
                </div>

            </div>
        </div>
        <!-- desc  -->
        <div class="container mb-3 bg-white">
            <div class="row">
                <div class="col-12 text-center p-3">
                    <h3 class="text-secondary"> تفاصيل المنتج </h3>
                </div>
                <div class="col-12 p-3 description">
                    <p>{{ $product['name_'.app()->getLocale()] }}<br></p>
                    <p>{!! $product['content_'.app()->getLocale()] !!}</p>


                </div>
                <a onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}},'checkout')"
                   class="btn btn-success btn-block btn-lg  background_buy_now_button">
                    <h4 class="text-white ">{{__('master.Complete the order')}}</h4>
                </a>
                <hr style="width: -webkit-fill-available;">

            </div>
        </div>
        <div class="container mb-3 bg-white">
            <div class="row">
                <div class="col-12 p-3">
                    @include('Store.components.Rate')
                </div>
            </div>
        </div>

        <div class="container-fluid max960">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid product-panel">
                        <div class="row mt-4">
                            <div class="col-12">
                            </div>
                            @forelse($simlier as $product)
                                <?php
                                $getimg = array();

                                if (isset($product->image)) {
                                    foreach ($product->image as $img) {
                                        $last = last(explode('.', $img));

                                        if (in_array($last, ["jpeg", "jpg", "png", "gif"])) {
                                            $getimg[] = $img;
                                        }
                                    }
                                }
                                ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="panel">

                                        <div class="product-card">

                                            <banner>
                                                <a href="{{ $product->route_details() }}">
                                                    <img onclick="window.location.href='{{ $product->route_details() }}'"
                                                         class="product-img lazy"
                                                         src="@if(!empty($getimg) )
                                                         {{ asset($getimg[array_rand($getimg,1)]) }}
                                                         @else https://semantic-ui.com/images/wireframe/image.png
                                                     @endif"/>

                                                    <div class="overlay"></div>
                                                </a>
                                            </banner>
                                            <content>
                                                <a href="{{ $product->route_details() }}">
                                                    <name>{{ $product['name_'.app()->getLocale()] }}</name>
                                                </a>
                                                <hr/>
                                                <div class="flex-row w100 flex-center align-center mt-2 mb-1 pl-1 pr-1">
                                            @if($product->status1==1)
                                            @if(!empty($product->price_before))
                                                    <div class="dummy" style="width: 56pt;">
                                                        <del style="color: #4455448a;">{{ $product->price_before }} {{-- $product->getCurrency() --}}</del>
                                                    </div>
                                                    @endif @endif
                                                    <div class="price">


                                                        @if($product->get_current_offer() ?? false)
                                                            {{ round($product->get_current_offer()->discount) }} {{-- $product->getCurrency() --}}
                                                            <small>
                                                                <del class="text-secondary">
                                                                    {{ round($product->price) }}
                                                                </del>
                                                            </small>
                                                        @else
                                                        @endif


                                                    </div>
                                                    <div style="width: 56pt; text-align: right;" hidden>

                                                    </div>
                                                </div>
                                                <div class="flex-row w100 flex-center align-center mt-2 mb-1 pl-1 pr-1">
                                                    <button style="cursor: pointer;border: solid 2px black;"
                                                            type="button" data-target="1"
                                                            onclick="addToCart('{{$product->id}}','{{ $product['name_'.app()->getLocale()] }}',{{$product->price}})"
                                                            class="btn-block btn-theme px-4 py-2  text-nowrap addToCart">{{ __('store.buy_now') }} </button>

                                                </div>
                                            </content>

                                        </div>

                                    </div>
                                </div>
                            @empty
                                <p class="lead" style="text-align: center"> {{ __('master.no_data') }}</p>
                            @endforelse


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- reviews -->
    </section>
@endsection
@section('script')

    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    $('#attrval').on('change',function(e){
        console.log('select change',$(this).val())
        if($('input:radio[name="attrval"]').val() != undefined){
            console.log('raio change',$('input:radio[name="attrval"]').val())
        }
        if($('.attr_val_name').val() != undefined){
          console.log($('.attr_val_name').val());
        }
    });  $(document).on('change','.selectAttr',function(){
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
                    "url": "<?php echo"https://". $store->domain .".marssa.shop/api/getVariants";?>",
//                    "url": "https://marssas2.marssa.shop/api/getVariants",
                    type:"GET",
                    data:data,
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
                });  /**/
        
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

             $.ajax({
                    "url": "<?php echo"https://". $store->domain .".marssa.shop/api/getVariants";?>",
                    //"url": "https://"+{{$store->domain}}+".marssa.shop/api/getVariants",
                    type:"get", // you must use post method
                    data:data,
                   // dataType:  'json',
                    success:function(data)
                    {
                        /*$('#div_1').hide();
                        $('#div_2').show();
                        $('#selectedVarinatId').val(data.variants[0]['id']);
                        $('#selectedVarinat').val(data.variants[0]['name']);
                        $('#selectedVarinatName').text(data.variants[0]['name']); // you can change it by use first in elqouent in controller
                        $('#selectedPrice').val(data.product.price);
                        $('#selling_price_new').text(data.product.price);
                        $('#currency').text(data.currency);
                        $('#total').text(data.product.price);
                        $('#available').text(data.product.quantity);
                        $('#quantity').val(data.product.quantity);
                        $('#quantity').attr('max',data.product.quantity);
                        $('#quantity').attr('min',1);*/
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
                    "url": "<?php echo"https://". $store->domain .".marssa.shop/api/getVariants";?>",
                    //"url": "https://marssas2.marssa.shop/api/getVariants",
                    type:"get",
                    data:data,
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
                    
                });  /**/
     });

    </script>
    <script>
/*
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
*/

        $(document).ready(function () {
            var bigimage = $("#big");
            var thumbs = $("#thumbs");
            //var totalslides = 10;
            var syncedSecondary = true;

            bigimage
                .owlCarousel({
                    items: 1,
                    autoHeight: true,
                    slideSpeed: 3000,
                    nav: true,
                    rtl: true,
                    autoplay: true,
                    dots: false,
                    loop: false,
                    responsiveRefreshRate: 200,
                    navText: [
                        '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                        '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
                    ]
                })
                .on("changed.owl.carousel", syncPosition);

            thumbs
                .on("initialized.owl.carousel", function () {
                    thumbs
                        .find(".owl-item")
                        .eq(0)
                        .addClass("current");
                })
                .owlCarousel({
                    items: 4,
                    autoHeight: true,
                    dots: true,
                    rtl: true,
                    nav: false,
                    navText: [
                        '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                        '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
                    ],
                    slideBy: 4,
                    responsiveRefreshRate: 100
                })
                .on("changed.owl.carousel", syncPosition2);

            function syncPosition(el) {
                //if loop is set to false, then you have to uncomment the next line
                //var current = el.item.index;

                //to disable loop, comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
                //to this
                thumbs
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = thumbs.find(".owl-item.active").length - 1;
                var start = thumbs
                    .find(".owl-item.active")
                    .first()
                    .index();
                var end = thumbs
                    .find(".owl-item.active")
                    .last()
                    .index();

                if (current > end) {
                    thumbs.data("owl.carousel").to(current, 100, true);
                }
                if (current < start) {
                    thumbs.data("owl.carousel").to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    bigimage.data("owl.carousel").to(number, 100, true);
                }
            }

            thumbs.on("click", ".owl-item", function (e) {
                e.preventDefault();
                var number = $(this).index();
                bigimage.data("owl.carousel").to(number, 300, true);
            });
        });
        //
        // $('.owl-carousel').owlCarousel({
        //     items: 1,
        //     loop: true,
        //     rtl: true,
        //     autoHeight: true,
        //     videoHeight: 300,
        //     dots:false,
        //     videoWidth: 600,
        //     center: true,
        //     margin : 30,
        //     nav    : true,
        //     smartSpeed :900,
        //     navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
        // })
    </script>


    <!-- whatsapp -->
    <script>
        $(document).ready(function () {
            $('#whatsapp_message').fadeIn();
            $('#messagebtn').fadeIn();
        });
    </script>
    <script type="text/javascript">
        function loadLivechat() {
            $('body').prepend('<div id="messagebtn" style="display:none" class="messagebtn d-flex flex-columns align-items-center justify-content-center " data-toggle="modal" data-target="#livechat"><span id="messagenumber">0</span><i class="fa fa-comments"></i></div><div id="chatloader"></div>');
            $('#chatloader').load(Routing.generate('popupchat'));
        }

        //loadLivechat();
    </script>
    <!-- Popup notif -->
    <script type="text/javascript">
        var typeTime = 's';
        if (typeTime == 's') {
            var time = '6' * 1000;
        } else if (typeTime == 'm') {
            var time = '6' * 60000;
        } else if (typeTime == 'h') {
            var time = '6' * 360000;
        }
/*
        function loadPopUp() {

            $('#popuploader').load(Routing.generate('popupNoti'), function () {
                console.log('popup tr');
                $(".notifPop").fadeIn("slow");
                $(".custom-close-pop").click(function () {
                    $(".notifPop").fadeOut("slow")
                });

                setTimeout(() => {
                    $(".notifPop").fadeOut("slow")
                }, 8000);
            });*/

        }

        setInterval(() => {
            loadPopUp();
        }, time);
    </script>
    <script>
        function getRandomizer(bottom, top) {
            return Math.floor(Math.random() * (1 + top - bottom)) + bottom;
        }

        function setCookie(cname, cvalue, seconds) {
            var d = new Date();
            d.setTime(d.getTime() + (seconds * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
            }
            return "";
        }

        /*
        countdowntitle
        countdownnum
        countdownquantity
        countdowntimer
        countdowndate
        countdownmessage
        countdownshowtitle
        countdownshowbar
        */
        var product_timer_top_text_enable = 1;
        var product_progressbar_enable = 1;
        if (!progressbar_message) var progressbar_message = " لم يتبقى سوى [num] لإنتهاء العرض";
        var percentage = 30;
        var totalStock = 100;
        var prevStock = 0;

        var rollDie = parseInt(getCookie("random_6"));
        if (!rollDie) rollDie = getRandomizer(0, totalStock);

        function showStock() {

            if (rollDie >= 6) rollDie = rollDie - (0.0005 * (rollDie - 4) * (rollDie - 4));

            var intRollDie = parseInt(rollDie);

            if (prevStock != intRollDie) {

                setCookie("random_6", intRollDie, 24 * 60 * 60);

                var percentagetoshow = parseInt(intRollDie / totalStock * 100);
                var html = '';
                if (product_timer_top_text_enable) html += '<p class="limited_edt"><span>' + progressbar_message.replace('[num]', '<span class="num">' + intRollDie + '</span>') + '</span></p>';
                if (product_progressbar_enable) html += '<div class="meter red"><div class="inside" style="width: ' + percentagetoshow + '%"></div></div>';
                $('.progressbar').html(html);
                if (prevStock > 0) {
                    $('.progressbar span.num').addClass('flash');
                    setTimeout(function () {
                        $('.progressbar span.num').removeClass('flash');
                    }, 1500);
                }
                prevStock = intRollDie;
            }
        }

        showStock();
        setInterval(showStock, 1000);
        var time_left = parseInt("73260");
        var target_date = parseInt(getCookie("timer_6")) || new Date().getTime() / 1000 + time_left;

        setCookie("timer_6", target_date, 24 * 60 * 60);

        setInterval(function () {
            var days, hours, minutes, seconds;

            var current_time = new Date().getTime() / 1000;
            var seconds_left = target_date - current_time;
            if (seconds_left <= 0) {
                target_date = new Date().getTime() / 1000 + time_left;
                seconds_left = target_date - current_time;


                setCookie("timer_6", target_date, 24 * 60 * 60);

            }
            days = parseInt(seconds_left / 86400);
            seconds_left = seconds_left % 86400;
            hours = parseInt(seconds_left / 3600);
            seconds_left = seconds_left % 3600;

            minutes = parseInt(seconds_left / 60);
            seconds = parseInt(seconds_left % 60);

            $('#countdown').html('<div class="counting">' + days + '<span>أيام</span></div><div class="counting">' + hours + '<span>ساعات</span></div><div class="counting">' + minutes + '<span>دقائق</span></div><div class="counting">' + seconds + '<span>ثواني</span></div>');
        }, 1000);
    </script>
    <!------------------- End Countdown Timer ------------------->
    <script src="../../storeinocdn.com/dev/templates/flate/assets/js/theme.js"></script>
    <script>


        function toastTrigger(title, text) {
            if (!$("#snackbar").length) {
                var textHtml = '<div id="snackbar" ></div>';
                $("body").prepend(textHtml);
            }
            $('#snackbar').empty();
            var textView = '<i class="fa fa-cart-plus pr-2"></i>' + title + text;
            $('#snackbar').prepend(textView);
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.minus').click(function () {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus').click(function () {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        });
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
@endsection
