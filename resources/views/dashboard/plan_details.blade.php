@extends('dashboard.master')

@section('index')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal-default-theme.css') }}">

    <style>
    .d-font{
        font-weight :800;
        display:block;
        margin-top:12px;
        margin-bottom:10px;
        text-align: right;
    margin-right: 20px;
    }
        .gray {
            padding: 5px;
        }

        .gray div {
            background: rgba(92, 213, 196, 0.31);
            box-shadow: 0 5px 20px rgba(1, 1, 1, .03);
            border-radius: 5px;
            margin: 5px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            min-height: 175px;
        }

        .gray div p {
            font-weight: bold;
            color: #000;
        }

        .gray div span {
            display: block;
            margin-top: 15px;
            color: #222;
        }

        .gray div span i {
            font-size: 20px;
            color: #222;
        }

        .panel-body {
            padding: 10px 25px;
        }

        .plan_details p {
            color: #000;
            font-size: 18px;
        }

        .plan_details ul li {
            margin-bottom: 10px;
        }

        #payment_method .container {
            background: #fff;
            width: 80%;
            height: auto;
            margin: 0 auto;
            position: relative;
            margin-top: 10%;
            box-shadow: 2px 5px 20px rgba(119, 119, 119, .5);
        }

        #payment_method .logo {
            margin-right: 12px;
            margin-top: 12px;
            color: #5cd5c4;
            font-weight: 900;
            font-size: 1.5em;
            letter-spacing: 1px;
        }

        #payment_method .leftbox {
            float: right;
            top: -5%;
            right: 5%;
            position: absolute;
            width: 15%;
            height: 110%;
            background: #5cd5c4;
            box-shadow: 3px 3px 10px rgba(119, 119, 119, .5);
        }

        #payment_method nav a {
            list-style: none;
            padding: 30px 0;
            text-align: center;
            color: #333;
            font-size: 3em;
            display: block;
            transition: all 0.3s ease-in-out;
        }

        #payment_method nav a:hover {
            color: #fff;
            transform: scale(1.2);
            cursor: pointer;
        }

        #payment_method nav a:first-child {
            margin-top: 7px;
        }

        #payment_method .active {
            color: #fff;
            font-size: 35px;
        }

        #payment_method .rightbox {
            float: left;
            width: 60%;
            height: 100%;
        }

        #payment_method .paypal, #payment_method .visa, #payment_method .bank, #payment_method .money-check {
            transition: opacity 0.5s ease-in;
            position: absolute;
            /*width: 70%;*/
        }

        #payment_method h1 {
            color: #5cd5c4;
            font-size: 1em;
            margin-top: 40px;
            margin-bottom: 35px;
        }

        #payment_method .noshow {
            display: none;
        }

        .rightbox div {
            text-align: center;
            padding: 10px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .rightbox .title {
            margin-top: 15px;
            position: absolute;
            top: 0;
            right: 0;
            font-weight: bold;
        }

        input[name="promo_code"], input[name="check_promo"] {
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 16px
        }

        table tbody tr td:first-child {
            text-align: right;
        }

        table tbody tr td:nth-child(2) {
            text-align: left;
        }

        .fail_checked {
            color: #ab0b27 !important;;
        }

        .done_checked {
            color: #008000 !important;;
        }

        .money-check .fail_checked, .money-check .done_checked, .money-check .error, .bank .fail_checked, .bank .done_checked, .bank .error {
            padding: 0;
        }

        p.hint {
            font-size: 14px !important;
        }

        input[type="file"] {
            width: 100%;
            font-size: 15px;
        }
        .payment_methods
        {
            position: relative;
            padding: 49px;
        }

        @if(app()->getLocale() == 'en')
        #payment_method .leftbox {
            float: left;
            left: 5%;
        }

        table tbody tr td:first-child {
            text-align: left;
        }

        table tbody tr td:nth-child(2) {
            text-align: right;
        }

        .rightbox .title {
            left: 0;
            right: auto
        }

        #payment_method .logo {
            float: right;
        }

        #payment_method .rightbox {
            float: right;
        }

        @endif
        @media only screen and (max-width: 600px) {

            .plan_small {
                padding: 0;
            }
            #payment_method nav a {
                 font-size: 1.1em;
            }
            #payment_method .container{
                width:100%;
            }
            .panel-body{
                padding: 7px 16px;
            }
            html[dir=rtl] .main-content{
                float:right;
            }
            .main-content{
                margin-right:auto !important;
                margin-left:auto  !important;
            }
            html[dir='rtl'] #c-group{
                width:100%;
            }
            .c-group h3{
                font-size:15px;
            }
            #c-group .c-field {
                display: block;
                padding: 15px 8px;
            }
            html[dir='rtl'] #payment_method .leftbox{
                right: 1%;
            }
            .rightbox div{
                justify-content: unset;
            }

            #payment_method .rightbox{
                width: 81%;
            }
            #payment_method nav a{
                font-size: 1.6em;
            }
            html[dir='ltr'] #c-group {
                width:100%;
            }
        }



        @media only screen and (min-width: 1000px) {
            .big_screen {
                display:block;
            }

            .mobile_only {
                display:none;
            }

        }

        @media only screen and (max-width: 1000px) {

            .big_screen {
                display:none;
            }

            .mobile_only {
                display:block;
            }

        }

    </style>
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        @if (session('message'))
                            <div class="small-spacing">
                                <div class="col-xs-12">
                                    <div class="alert @if(session('message') == 'payment_failed') alert-error @else alert-success @endif alert-dismissible"
                                         role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ __('master.'.session('message')) }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if($current_plan->price != 0 or !$upgrade_plan_status or $upgrade_plan_status  or $current_plan->id  == $plan['id'])
                    <div class="col-xs-12 p-0">
                        <div class="panel panel-default panel-small-title margin-bottom-20">
                            <div class="panel-heading">
                                <h6 class="panel-title padding-10">{{ __('master.subscribe_now') }}</h6>
                            </div>
                            <div class="panel-body margin-bottom-40">
                                <div class="panel-body plan_small">
                                    <div class="col-xs-12">
                                        <div class="row plan_details">
                                            @if($plan->price == 0)
                                                <form method="post" autocomplete="off"
                                                      class="margin-top-20"
                                                      action="{{ route('dashboard.admin.payment.free') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $plan->id }}">
                                                    <p class="text-center">
                                                        @if(app()->getLocale() == 'ar')
                                                        ملاحظة: ينبغي أن يكون رصيد في متجرك بشكل مسبق لتجنب فشل عملية الدفع.
                                                        @else
                                                        Note: You must have a balance in your store in advance to avoid payment failure.

                                                        @endif
                                                    </p>
                                                    <p class="text-center">
                                                        <button type="submit"
                                                                class="order-btn btn btn-tiffany btn-rounded btn-xs">
                                                            {{ __('master.subscribe_now') }}
                                                        </button>
                                                    </p>
                                                </form>
                                            @else
                                                @if($pending_payment)
                                                    <p class="text-center margin-top-40 margin-bottom-30 ">{!! __('master.have_pending_payment') !!}</p>
                                                    <table class="table table-hover">
                                                        <tbody>
                                                        <tr>
                                                            <td>ID</td>
                                                            <td>
                                                                <span>{{ $pending_payment->id }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('master.payment_method') }}</td>
                                                            <td>
                                                                <span>{{ $pending_payment->type }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('master.promo_code') }}</td>
                                                            <td>
                                                            <span class="notice notice-yellow">{{ $pending_payment->discount }}
                                                                $</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('master.total_price') }}</td>
                                                            <td>
                                                            <span class="notice notice-blue">{{ $pending_payment->amount_total }}
                                                                $</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>{{ __('master.date') }}</b></td>
                                                            <td>
                                                        <span>
                                                            {{ Carbon\Carbon::parse($pending_payment->created_at)->toFormattedDateString() }}
                                                        </span>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="text-center margin-top-20">{!! __('master.message_pay') !!}</p>
                                                    <div class="form-group @error('bill') has-error @enderror col-xs-12">
                                                        @error('bill')
                                                        <div class="invalid-feedback text-center margin-top-20"
                                                             role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                        @enderror
                                                    </div>


                                                   	<div class="">
                                                   	    <div class="select-period-for-plann">

                                                            <div id="c-group">
                                                                <h3> {{ __('master.select_period_plane')  }}</h3>
                                                                <div class="c-field" for="c1" style="color:red;">
                                                                    <input type="radio"  checked id="c1" name="c-group" value="1">
                                                                    <span class="label-text"> {{ env('currency_symbol') }} {{ $plan->percentage_discount(1,0) }}   / {{ __('master.selectmonths',['number'=>1]) }}  </span>
                                                                </div>
                                                                <div class="c-field" for="c1" style="color:red;">
                                                                    <input type="radio"   id="c1" name="c-group" value="2">
                                                                    <span class="label-text"> {{ env('currency_symbol') }} {{ $plan->percentage_discount(2,0) }}   / {{ __('master.selectmonths',['number'=>2]) }}  </span>
                                                                </div>
                                                                <div class="c-field" for="c2" style="color:#36992a;">
                                                                <input type="radio" id="c2" name="c-group" value="3">
                                                                <span class="label-text"> {{ env('currency_symbol') }} {{ $plan->percentage_discount(3,5) }}  /  {{ __('master.selectmonths',['number'=>3]) }} {{ __('master.withdiscount',['number'=>'5%']) }}</span>
                                                                </div>
                                                                <div class="c-field" for="c3" style="color:#1d6aae;">
                                                                <input type="radio" id="c3" name="c-group" value="6">
                                                                <span class="label-text">{{ env('currency_symbol') }} {{ $plan->months_discount(6,1) }} /  {{ __('master.selectmonths',['number'=>6]) }} {{ __('master.withfreeemonth',['number'=>1]) }}</span>
                                                                </div>
                                                                <div class="c-field" for="c4" style="color:#795548;">
                                                                <input type="radio" id="c4" name="c-group" value="12">
                                                                <span class="label-text">{{ env('currency_symbol') }} {{ $plan->months_discount(12,2) }}  /  {{ __('master.selectyear'  ,['number'=>1]) }} {{ __('master.withfreeemonth',['number'=>2]) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="payment_method" class="margin-top-40 ">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div id="logo">
                                                                        <h1 class="logo">{{ $information['title_page_'.app()->getLocale()] }}</h1>
                                                                    </div>

                                                                    <div class="payment">

                                                                            <div class="payment_methods">
                                                                                <p class="title">
                                                                                    {{ __('master.pay_with') }} <b> {{ __('master.wallet')  }}</b>
                                                                                </p>
                                                                                <form method="post" autocomplete="off"
                                                                                    class="margin-top-20"
                                                                                    action="{{ route('dashboard.admin.payment.subscription_package') }}">
                                                                                    @csrf
                                                                                    <input type="hidden" name="id"
                                                                                        value="{{ $plan->id }}">
                                                                                    <input class="months" type="hidden" name="months"
                                                                                        value="1">
                                                                                    <input type="hidden" name="valid_code"
                                                                                        class="valid_code">
                                                                                    <p>
                                                                                        <input name="promo_code" type="text"
                                                                                            placeholder="{{ __('master.promo_code') }}">
                                                                                        <input type="button" name="check_promo"
                                                                                            class="check_promo"
                                                                                            value="{{ __('master.apply') }}">
                                                                                    </p>
                                                                                    <p class="invisible error"></p>
                                                                                    <table class="table table-hover margin-top-40">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td>{{ __('master.package_price') }}</td>
                                                                                            <td>
                                                                                <span class="notice notice-green">{{ $plan->price }}
                                                                                    {{ env('currency_symbol') }}</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>{{ __('master.promo_code') }}</td>
                                                                                            <td>
                                                                                                <span class="notice notice-yellow promo_code">0</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <b>{{ __('master.total_price') }}</b>
                                                                                            </td>
                                                                                            <td>
                                                                                <span class="notice notice-blue total_price">
                                                                                    <b>{{ $plan->price }} {{ env('currency_symbol') }}</b>
                                                                                </span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <p>
                                                                                        <button type="submit"
                                                                                                class="order-btn btn btn-tiffany btn-rounded btn-xs">
                                                                                            {{ __('master.subscribe_now') }}
                                                                                        </button>
                                                                                    </p>
                                                                                </form>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                   	    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xs-12">
                        <div class="panel panel-default panel-small-title margin-bottom-20">
                            <div class="panel-heading">
                                <h6 class="panel-title padding-10">{{ __('master.upgrade_plan') }}</h6>
                            </div>
                            <div class="panel-body margin-bottom-40">
                                <div class="panel-body">
                                    <div class="col-xs-12">
                                        <p class="margin-top-20 margin-bottom-20 text-center">
                                            <b>{!! __('master.message_upgrade_plan') !!}</b>
                                        </p>

                                        @if($current_plan->id > $plan->id)
                                            <p><b>{{ __('master.upgrade_restrictions') }}:</b><br></p>
                                            <ul>
                                                @if($current_plan->integration and !$plan->integration)
                                                    <li>{{ __('master.doesNotFeature') . ' ' . __('master.integration_fb_google') }}</li>
                                                @endif
                                                @if($current_plan->language == 1 and $plan->language == 0)
                                                    <li>{{ __('master.doesNotFeature') . ' ' . __('master.multi_language') }}</li>
                                                @endif
                                                @if($current_plan->custom_domain and !$plan->custom_domain)
                                                    <li>{{ __('master.doesNotFeature') . ' ' . __('master.custom_domain') }}</li>
                                                @endif
                                                @if($current_plan->custom_design and !$plan->custom_design)
                                                    <li>{{ __('master.doesNotFeature') . ' ' . __('master.custom_design') }}</li>
                                                @endif
                                                @if($current_plan->offer_count > $plan->offer_count)
                                                    <li>{{ __('master.offer_count') . __('master.is') . $plan->offer_count }}</li>
                                                @endif
                                                @if($current_plan->order_count > $plan->order_count)
                                                    <li>{{ __('master.order_count') . __('master.is') . $plan->order_count }}</li>
                                                @endif
                                                @if($current_plan->users_count > $plan->users_count)
                                                    <li>{{ __('master.users_count') . __('master.is') . $plan->users_count }}</li>
                                                @endif
                                            </ul>
                                        @endif
                                        <p><b>{{ __('master.upgrade_notes') }}:</b></p>
                                        <ul>
                                            @if($current_plan->id > $plan->id)
                                                @if($current_plan->language == 1 and $plan->language == 0)
                                                    <li>{!! __('master.upgrade_restrictions_attention_language') !!}</li>
                                                @endif
                                                <li>{!! __('master.upgrade_restrictions_attention_inactive') !!}</li>
                                                <li>{!! __('master.upgrade_restrictions_attention_process') !!}</li>
                                            @endif
                                            <li>
                                                <p>{!! __('master.message_upgrade_plan_price_difference') !!}</p>
                                                <p class="text-center">
                                                    <span class="notice notice-blue padding-10"> {{__('master.deadline_date') . ' ' .  __('master.for_current_subscription')}}
                                                        <b>{{ Carbon\Carbon::parse($subscriptions->deadline)->toDateTimeString() }}</b>
                                                    </span>
                                                    <span class="notice notice-yellow padding-10"> {{__('master.deadline_date') . ' ' .  __('master.for_new_subscription')}}
                                                        <b>{{ Carbon\Carbon::parse($subscriptions->DeadlineForNewSubscription($plan->id))->toDateTimeString() }}</b>
                                                    </span>
                                                </p>
                                            </li>
                                        </ul>
                                        <form method="post" class="margin-top-40"
                                              action="{{ route('dashboard.admin.store_settings.upgrade_plan') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $plan->id }}">
                                            <p class="text-center">
                                                <button type="submit"
                                                        class="order-btn btn btn-tiffany btn-rounded btn-xs">
                                                    {{ __('master.upgrade_plan') }}
                                                </button>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="remodal" data-remodal-id="financial_information" role="dialog" aria-labelledby="modal1Title"
         aria-describedby="modal1Desc">
        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
        <div class="remodal-content">
            <h2 id="modal1Title">{{ __('master.financial_information_platform') }}</h2>
            <br>
            <div class="card-content">
                <table class="table table-hover margin-top-5">
                    <tbody>
                    <tr>
                        <td>{{ __('master.name') }}</td>
                        <td>
                            <p>{{ env('money_transfers_full_name') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __('master.mobile') }}</td>
                        <td>
                            <p>{{ env('money_transfers_mobile_phone') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{ __('master.address') }}</b></td>
                        <td>
                            <p>{{ env('money_transfers_address') }}</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <p class="title">
                <b>
                    <span>{{ __('master.pay_with') }}</span>
                    <span class="notice notice-yellow">Western Union</span>
                    <span class="notice notice-danger"> MoneyGram</span>
                    <span class="notice notice-green"> Xpress Money</span>
                </b>
            </p>
            <p class="title">
                {!!  __('master.hint_pay_bill') !!}
            </p>
        </div>
    </div>
    <div class="remodal" data-remodal-id="bank_information" role="dialog" aria-labelledby="modal1Title"
         aria-describedby="modal1Desc">
        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
        <div class="remodal-content">
            <h2 id="modal1Title">{{ __('master.bank_information_platform') }}</h2>
            <br>
            <div class="card-content">
                <table class="table table-hover margin-top-5">
                    <tbody>
                    <tr>
                        <td>{{ __('master.bank_name') }}</td>
                        <td>
                            <p>{{ __(env('bank_transfers_bank_name')) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __('master.recipient_name') }}</td>
                        <td>
                            <p>{{ __(env('bank_transfers_recipient_name')) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{ __('master.iban_number') }}</b></td>
                        <td>
                            <p>{{ __(env('bank_transfers_iban_number')) }}</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <p class="title">
                {!!  __('master.hint_pay_bill') !!}
            </p>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.min.js') }}"></script>
    <script>
        /*active button class onclick*/
        $('nav a').click(function (e) {
            e.preventDefault();
            $('nav a').removeClass('active');
            $(this).addClass('active');
            if (this.id === !'visa') {
                $('.visa').addClass('noshow');
            } else if (this.id === 'visa') {
                $('.visa').removeClass('noshow');
                $('.rightbox').children().not('.visa').addClass('noshow');
            } else if (this.id === 'paypal') {
                $('.paypal').removeClass('noshow');
                $('.rightbox').children().not('.paypal').addClass('noshow');
            } else if (this.id === 'mastercard') {
                $('.mastercard').removeClass('noshow');
                $('.rightbox').children().not('.mastercard').addClass('noshow');
            } else if (this.id === 'bank') {
                $('.bank').removeClass('noshow');
                $('.rightbox').children().not('.bank').addClass('noshow');
            } else if (this.id === 'money-check') {
                $('.money-check').removeClass('noshow');
                $('.rightbox').children().not('.money-check').addClass('noshow');
            }
        });

        $('.check_promo').click(function (e) {
            let input = $(this).parent().find("input").val(),
                valid_code = $(this).parent().parent().find('.valid_code'),
                months_subscription = $('.c-field input:checked').val() ?? 1,
                promo_code = $(this).parent().parent().find('.promo_code'),
                total_price = $(this).parent().parent().find('.total_price'),
                error = $(this).parent().parent().find('.error');
            error.removeClass('invisible done_checked fail_checked');
            error.html("{{ __('master.being_checked') }}");
            promo_code.html('0');
            total_price.html('{{ $plan->price . env('currency_symbol') }} ');
            $.ajax({
                url: "{{ route('dashboard.admin.payment.check_promo', $plan->id) }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": input,
                    "months_subscription":months_subscription,
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status === 'done') {
                        error.addClass('done_checked');
                        error.html("{{ __('master.done_checked') }}");
                        promo_code.html(data.discount + "{{ env('currency_symbol') }}");
                        total_price.html(data.total + "{{ env('currency_symbol') }}");
                        valid_code.val(input);
                        $('.c-field input').attr('data-discount',data.discount);

                    } else {
                        error.addClass('fail_checked');
                        error.html("{{ __('master.fail_checked') }}");
                        total_price.html(data.total + "{{ env('currency_symbol') }}");
                    }
                }
            });
        });




        $('.c-field input').change(function (e) {
            let months_subscription = jQuery(this).val();
            let discount            = jQuery(this).attr('data-discount') ?? 0;
            let total_price = $('.total_price');
            $.ajax({
                url: "{{ route('dashboard.admin.payment.check_subscription_term', $plan->id) }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "months_subscription": months_subscription,
                    "discount":discount,
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status === 'done') {
                        console.log(data);
                        total_price.html(data.total + "{{ env('currency_symbol') }}");
                        $('input.months').val(months_subscription);
                    } else {
                        error.addClass('fail_checked');
                        error.html("{{ __('master.fail_checked') }}");
                    }
                }
            });
        });

    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
