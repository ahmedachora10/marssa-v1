@extends('Store.master_5')
@section('head')
<style>
        .mobile-bar .header-left, 
        .header-right,
        .notice-bar,
        .mobile-notice-bar,
        .footer,
        .desktop-bar .header-center{
            display:none !important;
        }
        .desktop-bar .header-left{
            display:inline-block !important;
        }
        .desktop-bar .header-left
        {
            margin: auto !important;
            right: 46%;
        }
        .order-process{
            background: #28a745!important;
        }
    </style>
@endsection
@section('content')    
    @include('Store.components.checkout',['bg_color'=>'#28a745','color'=>'#fff'])
@endsection
@section('script')
    
    <script>
        jQuery(document).ready(function () {
            var isEmpty = jQuery('#promo_code').val();
            if (!isEmpty) {
                jQuery('#ApplyPromoCode').removeClass('d-none');
            } else {
                jQuery('#RemovePromoCode').removeClass('d-none');
            }
            jQuery(document).on('submit','form.create-order-form',function(){
                jQuery('form.create-order-form .order-process').attr('disabled',true);
            })
        });
        document.getElementById("pay").focus();
    </script>
@endsection