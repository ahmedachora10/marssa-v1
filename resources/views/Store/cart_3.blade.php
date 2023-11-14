@extends('Store.master_3')
@section('content')
    @include('Store.components.cart')
@endsection
@section('script')
    <script>
        $(document).ready(function (){
            var isEmpty = $('#promo_code').val();
            if (!isEmpty) {
                $('#ApplyPromoCode').removeClass('d-none');
            } else {
                $('#RemovePromoCode').removeClass('d-none');
            }
        });
    </script>
@endsection
