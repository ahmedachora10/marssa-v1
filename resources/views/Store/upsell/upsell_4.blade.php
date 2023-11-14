@extends('Store.master_2')
@section('content')
<style>
    iframe {
        width: 100% !important;
    }
</style>
    <br>
    <div class="container mb-3 bg-white shadow-sm">
        <div class="row">
            <input type="hidden" name="upselldone">
            <div class="col-12 text-center p-3">

                <h2 class="text-secondary"> {{$pro->upsell['title_'.app()->getLocale()]}} </h2>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6" style="height: 200px;">
                <img style="height: 250px;margin-bottom: 20px;" src="{{ asset($getimg[array_rand($getimg,1)]) }}">
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6" >
                <p>{!! $pro->upsell['desc_'.app()->getLocale()] !!}<br></p>


            </div><hr>
            <div class="col-12 text-center p-3">
                <form method="post" action="{{url('add_offer')}}">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="pro_id" value="{{$pro->upsell->offer_id}}">
                    <input type="hidden" name="order_id" value="{{$order_id}}">
                    <button type="submit"  style="width: 200px;background: {{$pro->upsell->accept_color}};"  class="btn btn-success">
                        <span class="fa fa-plus"></span> {{$pro->upsell['accept_'.app()->getLocale()]}}

                    </button>
                </form>
                <a class="btn btn-danger" style="margin-top: 20px;background: {{$pro->upsell->cancel_color}};"  href="{{url('/thank_you?orderId='.$order_id)}}" >{{$pro->upsell['cancel_'.app()->getLocale()]}}</a>            </div>
            </div>
        </div>
    </div>
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
    </script>
@endsection