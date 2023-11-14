@extends('Store.master_2')
@section('head')
  <link href="https://static3.youcan.shop/store-front/css/app.css?id=fe1a983726b2d082aff6" rel="stylesheet">
  <style>
  .product-quantity {
    border-radius: 50%;
    background-color: #159393;
    text-align: center;
        left: -10px;
    box-shadow: 3px 5px 3px #000000;
}
.all-in-one .all-in-one-step {
    border: 1px solid #e5e5e5;
    border-radius: 5px;
    
}
.checkout-section .all-in-one .all-in-one-step .all-in-one-body {
    border-radius: 0 0 5px 5px;
    margin: -1px 0 0;
    padding: 15px;
}
.checkout-section .all-in-one .sidebar .aside-body {
    padding: 0;
    background-color: transparent;
    border-radius: 0;
}
.checkout-section .all-in-one .all-in-one-step.expanded .all-in-one-header {
    border-radius: 5px 5px 0 0;
    border-bottom: 1px solid #e5e5e5;
    
}
.all-in-one-header  h5{
    margin: 0px;
    
}
.sidebar .aside-body .aside-products li {
    display: -webkit-box;
    display: flex;
    -webkit-box-align: start;
    align-items: flex-start;
    -webkit-box-pack: justify;
    justify-content: space-between;
    margin-bottom: 15px;
}
 .checkout-section .all-in-one .all-in-one-step .all-in-one-header h5 .step-number {
    border-radius: 0 5px 0 0;
    margin: 0 0 0 15px;
    border-left: 1px solid #e5e5e5;
}
 .checkout-section .all-in-one .all-in-one-step .all-in-one-header h5 .step-number {
    text-align: center;
    background-color: #f1f1f1;
}
.checkout-section .all-in-one .all-in-one-step .all-in-one-header h5 .step-number {
    width: 50px;
    height: 50px;
    line-height: 50px;
    font-size: 18px;
    color: #c6c6c6;
}
.checkout-section .checkout .sidebar .aside-body .aside-total-details {
    margin: 15px 0;
    padding: 15px 0;
    border-top: 1px solid #e5e5e5;
    border-bottom: 1px solid #e5e5e5;
}
.checkout-section .checkout .sidebar .aside-body .aside-total-details li .title {
    color: #525252;
    font-weight: 500;
    font-family: dinnextltw23,'sans-serif'!important;
}
</style>
@endsection
@section('content')
    @include('Store.components.checkout',['bg_color'=>'#28a745','color'=>'#fff'])
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var isEmpty = $('#promo_code').val();
            if (!isEmpty) {
                $('#ApplyPromoCode').removeClass('d-none');
            } else {
                $('#RemovePromoCode').removeClass('d-none');
            }
        });
        document.getElementById("pay").focus();
    </script>
@endsection
