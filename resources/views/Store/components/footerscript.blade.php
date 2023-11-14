<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.13.0/dist/sweetalert2.all.min.js"></script>
<script>
    function addToCart(id,name,price,$url='') {
        let price1=0;
        if(price===0){
            price1=$('#selectedPrice').val();
            console.log(price1)
        }else{
            price1=price;
        }
        let variant=$('#selectedVarinat').val();
        let variantID=$('#selectedVarinatId').val();
        console.log(variant);
        console.log(variantID)
            console.log(price1)
          var number_cart = $('.badge').html();
            $('.badge').val(number_cart++);
            $('.badge').html(number_cart++);
        var qua=$('#quantity').val();
        $.ajax({
            method: "POST",
            url: "{{url('add_to_cart')}}",
            data: { id: id, name: name,price:price1,variant:variant,variant_id:variantID,qua:qua,_token: '{{csrf_token()}}' },
            dataType: "json"
        }).success(function( msg ) {
            Swal.fire({
                title: '{{__('master.Successfully')}}',
                icon: 'success',
                // toast:false,
                // position: 'top-end',
                timerProgressBar:true,
                timer:1500,
                showConfirmButton: false
            });
            $('.cartCount').html('<i class="fa fa-shopping-cart"></i> '+msg.count);
            if ($url !== '') {
                var currentUrl = window.location.hostname;

                window.location.href =  '/'+ $url;
            }
        }).fail(function (msg){
            Swal.fire({
                title: '{{__('master.Fail')}}',
                icon: 'error',
                // toast:false,
                // position: 'top-end',
                timerProgressBar:true,
                timer:1500,
                showConfirmButton: false
            })
        });
    }
</script>
<script type="text/javascript">
        $(document).ready(function() {
        $('.show-promo-code').click(function(e){
               $('.fields-promo-code').toggleClass('show'); 
        });
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
<script>
    function EgSwalSuccess(){
        Swal.fire({
            title: '{{__('master.Successfully')}}',
            icon: 'success',
            // toast:false,
            // position: 'top-end',
            timerProgressBar:true,
            timer:1500,
            showConfirmButton: false
        });
    }
    function EgSwalFail(){
        Swal.fire({
            title: '{{__('master.Fail')}}',
            icon: 'error',
            // toast:false,
            // position: 'top-end',
            timerProgressBar:true,
            timer:1500,
            showConfirmButton: false
        })
    }
    function CartAction(url, rowId, type = '') {
        
        if ($('#qty_'+rowId).val() < 1) {
            return false;
        }
        $.ajax({
            method: "POST",
            url: url,
            data: {_token: '{{csrf_token()}}', rowId: rowId, qty: $('#qty_'+rowId).val()},
            dataType: "json",
            beforeSend: function (){
                $('.loadding').show();
            },
            complete: function (){
                $('.loadding').hide();
            },
            success: function (msg) {
            if (msg.status == 'success') {
                //EgSwalSuccess();
            console.log(msg);
            $('.badge').val(msg.count);
            $('.badge').html(msg.count);
                $('.cartCount').html('<i class="fa fa-shopping-cart"></i> ' + msg.count);
                $('#subTotal').html(msg.subTotal);
                $('#Tax').html(msg.Tax);
                $('#Total').html(msg.Total);
                $('#Total_USD').html(msg.Total_USD+' $');
                $('#shipping').html(msg.shipping);
                if (type === 'delete') {
                    $('#' + rowId).remove();
                }
            } else {
                EgSwalFail();
            }
        }
        
        }).fail(function (msg) {
            EgSwalFail();
        });
    }
    function ApplyPromoCode(){
        var code = $('#promo_code').val();
        $.ajax({
            method: "POST",
            url: "{{url('add_coupon')}}",
            data: { promo_code: code,_token: '{{csrf_token()}}' },
            dataType: "json",
            beforeSend: function (){
                $('.loadding').show();
            },
            complete: function (){
                $('.loadding').hide();
            },
            success: function( msg ) {
                if (msg.status == 'success') {
                    EgSwalSuccess();
                    $('.cartCount').html('<i class="fa fa-shopping-cart"></i> ' + msg.count);
                    $('#subTotal').html(msg.subTotal);
                    $('#Promo').html(msg.Promo);
                    $('#Total').html(msg.Total);
                    $('#Total_USD').html(msg.Total_USD+' $');
                    $('#shipping').html(msg.shipping);
                    $('#RemovePromoCode').toggleClass('d-none');
                    $('#ApplyPromoCode').toggleClass('d-none');
                } else {
                    EgSwalFail();
                }
            },
            error: function (msg){
                EgSwalFail();
            }
        });
    }
    function RemovePromoCode(){
        $.ajax({
            method: "POST",
            url: "{{url('remove_coupon')}}",
            data: { _token: '{{csrf_token()}}' },
            dataType: "json",
            beforeSend: function (){
                $('.loadding').show();
            },
            complete: function (){
                $('.loadding').hide();
            },
            success: function( msg ) {
                if (msg.status == 'success') {
                    EgSwalSuccess();
                    $('.cartCount').html('<i class="fa fa-shopping-cart"></i> ' + msg.count);
                    $('#subTotal').html(msg.subTotal);
                    $('#Promo').html(msg.Promo);
                    $('#Total').html(msg.Total);
                    $('#Total_USD').html(msg.Total_USD+' $');
                    $('#shipping').html(msg.shipping);
                    $('#RemovePromoCode').toggleClass('d-none');
                    $('#ApplyPromoCode').toggleClass('d-none');
                    $('#promo_code').val('');
                } else {
                    EgSwalFail();
                }
            },
            fail: function (msg){
                EgSwalFail();
            }
        });
    }
</script>
<script>
    //plugin bootstrap minus and plus
    //http://jsfiddle.net/laelitenetwork/puJ6G/
    $('.btn-number').click(function(e){
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {

                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $(document).ready(function(){
        $("#pay").focus();
    });
</script>

