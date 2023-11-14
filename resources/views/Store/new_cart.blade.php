@extends('Store.master_5')
@section('content')
    <br>
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
