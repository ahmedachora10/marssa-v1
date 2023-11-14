@extends('Store.master_1')
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
    </script>
@endsection
