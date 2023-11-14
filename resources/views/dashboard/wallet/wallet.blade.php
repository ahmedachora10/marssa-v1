@extends('dashboard.master')

@section('products_add')
    current active
@endsection
@section('head_tag')
    <!-- FlexDatalist -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/flexdatalist/jquery.flexdatalist.min.css') }}">
    <!-- Popover -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/popover/jquery.popSelect.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/select2/css/select2.min.css') }}">
    <!-- Timepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- Touch Spin -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/touchspin/jquery.bootstrap-touchspin.min.css') }}">
    <!-- Colorpicker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Datepicker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/datepicker/css/bootstrap-datepicker.min.css') }}">
    <!-- DateRangepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/editor/summernote-lite.css') }}">
    
<script  src="https://www.paypal.com/sdk/js?client-id=AQXxPkxqqs6pzsHrAi1iu_WNb-pX2-vOjEEgQsEqL2FOS5j-sCeaLHkIKfM3AeURx6NIJ24gCvzfLj-K&currency=USD&intent=capture&enable-funding=venmo" data-namespace="paypal_sdk"></script>
 
    <style>
        .dropify-wrapper {
            height: 150px;
        }
        .tag-editor {
            line-height: 24px;
            padding: 7px 14px;
            min-height: 45px;
            border-color: #ccd1d9;
            box-shadow: none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            border-radius: 2px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
        }
        .disable{
            display: none;
        }
    </style>
    @if(app()->isLocale('ar'))
        <style>
            .tag-editor li {
                float: right;
                display: flex;
            }
            .tag-editor-hidden-src {
                right: -99999px;
                left: auto;
            }



            #contact {
                background: #F9F9F9;
                padding: 25px;
                margin: 15px auto;
                width: 100%;
                border: 2px solid #e9eef1;
                background-color: white;
            }

            #contact h3 {
              display: block;
              font-size: 30px;
              font-weight: 300;
              margin-bottom: 10px;
            }

            #contact h4 {
              margin: 5px 0 15px;
              display: block;
              font-size: 13px;
              font-weight: 400;
            }

            fieldset {
              border: medium none !important;
              margin: 0 0 10px;
              min-width: 100%;
              padding: 0;
              width: 100%;
            }

            #contact input[type="text"],
            #contact input[type="email"],
            #contact input[type="tel"],
            #contact input[type="url"],
            #contact select,
            #contact textarea {
              width: 100%;
              border: 1px solid #ccc;
              background: #FFF;
              margin: 0 0 5px;
              padding: 10px;
              height: 3em;
              border: 1px solid #2196f3;
            }

            #contact input[type="text"]:hover,
            #contact input[type="email"]:hover,
            #contact input[type="tel"]:hover,
            #contact input[type="url"]:hover,
            #contact select:hover,
            #contact textarea:hover {
              -webkit-transition: border-color 0.3s ease-in-out;
              -moz-transition: border-color 0.3s ease-in-out;
              transition: border-color 0.3s ease-in-out;
              border: 1px solid #aaa;
              height: 3em;
              border: 1px solid #2196f3;
            }

            #contact textarea {
              height: 100px;
              max-width: 100%;
              resize: none;
            }

            #contact button[type="submit"] {
              cursor: pointer;

              border: none;
              background: #4CAF50;
              color: #FFF;
              margin:auto;
              padding: 10px;
              font-size: 15px;
            }

            #contact button[type="submit"]:hover {
              background: #43A047;
              -webkit-transition: background 0.3s ease-in-out;
              -moz-transition: background 0.3s ease-in-out;
              transition: background-color 0.3s ease-in-out;
            }

            #contact button[type="submit"]:active {
              box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
            }

            .copyright {
              text-align: center;
            }

            #contact input:focus,
            #contact textarea:focus {
              outline: 0;
              border: 1px solid #aaa;
            }

            ::-webkit-input-placeholder {
              color: #888;
            }

            :-moz-placeholder {
              color: #888;
            }

            ::-moz-placeholder {
              color: #888;
            }

            :-ms-input-placeholder {
              color: #888;
            }
            .head-form
            {
                line-height: 2em;
                font-size: 18px !important;
                text-align: right;
            }
            .disabled{
                border:0px solid white !important;
                background-color:#efefef !important;
            }
            .disabled input{
                border: 1px solid #d6d9db !important;
            }
            .sales-results{
                text-align: center;
            }
            .box-results
            {
                background-color: #ff9800;
                padding: 15px;
                display: inline-block;
                margin: 20px;
                color: white;
                font-size: 15px;
                font-size: 15px;
                direction: ltr;
                padding: 11px 29px;
                box-shadow: 0px 0px 8px 9px #f3f3f3;
                border: 1px solid #dddddd;
            }
            .sales-results
            {
               display:none;
            }
             @media(max-width:1000px){
                #contact {
                    width:100%;
                }
            }
            .content-wallet .wallet-value
            {
                text-align: center;
                font-size: 48px !important;
                color: #2e8f35;
            }
            .content-wallet .wallet-value .currency{
                font-size:20px !important;
                color: black !important;
            }
            .charge_balance{
                float:left;
            }
            .redclass{
                color:red;
            }
            .greenclass
            {
                color: green;
            }
            @media(max-width:800px){
                .table.table-striped *{
                   font-size:13px;
                }
                #contact .content-exchange
                {
                    width: 100%;
                    overflow-y: auto;
                }
                .nav-tabs > li > a{
                    font-size:14px;
                }
                .tab-content{
                    padding:0px;
                }
            }
        </style>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">

            <form method="post" class="form_cal_growth"  autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-10 col-xs-12">
                        @if (count($errors) > 0)
                            <div class="alert alert-error alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span>
                                </button>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif

                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ __('master.'.session('message')) }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="container">
                        
                        
                        
                        <div class="alert alert-warning">
                            {{__("master.You can also transfer the value of the subscription to the number 26440645 by bankily or masrvi and we will renew it on your behalf")}}
                        </div>
                        
                        <div class="alert alert-info">
                             <i class="fas fa-money-bill-alt" style="font-size: 12px;"></i> 
                                
                                    @if(app()->getLocale() == 'ar')
                                         الحد الاقصي للعمولة المستحقة 
                                    @else
                                        Max Commission Limits
                                    @endif
                                @if(auth()->user()->getCurrency() == 'أوقية قديمة')
                                (<b class="text-danger ">{{ auth()->user()->store->plan->max_indebtedness }}</b>)
                                @elseif(auth()->user()->getCurrency() == 'أوقية جديدة')
                                (<b class="text-danger ">{{ (auth()->user()->store->plan->max_indebtedness) / 10}}</b>)
                                @else
                                (<b class="text-danger ">{{ (auth()->user()->store->plan->max_indebtedness) / 10}}</b>)
                                @endif
                                {{auth()->user()->getCurrency()}}
                                
                        </div>
                        @if(auth()->user()->store->plan->is_commission == 1) 
                            <div class="alert alert-info">
                                
                                <a class="" style="font-size:20px" href="{{ route('dashboard.choose-dashboard','months-packages') }}">
                                        <i class="fas fa-bell" style="font-size: 12px;"></i> 
                                        <small>
                                            @if(app()->getLocale() == 'ar')
                                                 يمكنك الاشتراك في الباقات الشهرية من هنا 
                                            @else
                                                You can subscribe to monthely packages from here
                                            @endif
                                        </small>
                                        
                                       
                                    </a>
                            </div>
                        @endif

                        <div >
                            <a class="btn btn-info" href="{{ route('dashboard.admin.participants.index') }}" style="position:relative">
                                {{ __('master.subscription')}}
                                <i class="fas fa-play-circle watch_video" style="position: unset;float: left;margin: 7px 9px 3px 0px;"
                                    data-video-id="subscription"
                                    data-backdrop="static"
                                    data-keyboard="false"
                                    data-toggle="modal"
                                    >
                                </i>
                            </a>
                        </div>
                        <div id="contact" action="" method="post">
                            <h4 class="head-form"><i class="fas fa-wallet"></i> {{ __("master.$title_page") }}
                            <button type="button" class="btn btn-primary charge_balance" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#exampleModalCenter">{{ __("master.charge_balance")}}</button>
                            </h4>

                            <div class="content-wallet">
                                <h3 class="wallet-value">
                                    <label>{{ $wallet_total ?? 0 }}</label>
                                    <span class="currency"> {{-- env('currency_symbol') --}} 
                                {{auth()->user()->getCurrency()}} </span>
                                </h3>
                            </div>
                            @if( ( env('commission') != 0 ) || !empty( env('commission') ) )
                                <div class="alert alert-warning">
                                {{ __('master.commission_desc',[ 'value' => env('commission',0).'%' ]) }}
                                </div>
                            @endif
                            <div class="content-exchange">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col" colspan="4">
                                        {{ __('master.all-operators') }}
                                        </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($wallet_payments as $payment)
                                            <tr>
                                                <th scope="row">{{ $payment->created_at }}</th>
                                                <td>{{ $payment->type_operation == 0 ? __('master.charge_account') : __('master.withdraw_from_account') }}</td>
                                                <td class="{{ $payment->type_operation == 0 ? 'greenclass':'redclass' }}"> {{ $payment->type_operation == 0 ? '+':'-' }} {{ floatval($payment->amount) }}
                                                {{-- env('currency_symbol') --}} 
                                {{auth()->user()->getCurrency()}}</td>
                                                <td>
                                                        @if($payment->status == 0)
                                                        {{ __('master.pending') }}
                                                        @elseif($payment->status == 1)
                                                        {{ __('master.approve') }}
                                                        @elseif($payment->status == 2)
                                                        {{ __('master.refuse') }}
                                                        @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                            <th colspan="3"></th>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('script')
  <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('master.charge_account') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <form method="POST"  action="{{ route('dashboard.admin.add_balance_wallet') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('master.value-charge') }}:</label>
                            <input name="value-charge" type="number" placeholder="0.0" step="0.01" min="900" max="15000" class="form-control" id="recipient-name"
                            required>
                            <p class="alert alert-info">{{ __('master.alert-wallet-balance') }}</p>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#bankily" data-type-method=".bankily">
                                     <i class="fas fa-money-check-alt"></i>
                                    <input type="radio" name="paymentMethod" value="bankily" class="bankily"  checked="true"  hidden/>
                                    {{ __('master.money_transfers') }}
                                </a>
                            </li>
                            <li >
                                <a data-toggle="tab" href="#paypal" data-type-method=".paypal">

                                    <i class="fab fa-cc-paypal"></i>
                                    <input type="radio" name="paymentMethod" value="paypal" class="paypal"  hidden/>
                                    {{ __('master.paypal') }}
                                </a>
                            </li>

                        </ul>

                        <div class="tab-content">
                           <div id="bankily" class="tab-pane active">
                                <div class="card-content">
                                    <table class="table table-hover margin-top-5">
                                        <tbody>
                                            <tr>
                                                <td>{{ __('master.mobile') }}</td>
                                                <td>
                                                    <p>{{ env('money_transfers_mobile_phone') }}</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <p class="text-center">
                                        <label for="bank_bill"
                                                class="small d-font">
                                            {{ __('master.attach_bill') }}
                                        </label>
                                        <input class="bankily-file" style="margin: auto;" type="file" name="bill"/>
                                    </p>

                                </div>
                            </div>
                            <div id="paypal" class="tab-pane fade">
                                 <div id="paypal-button-container"></div>
                                
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('master.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('master.charge_account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>

    jQuery('.nav-tabs').on('click','a',function(){
        jQuery('input[type="file"]').attr('required',false);
    });
    jQuery('.nav-tabs a').on('shown.bs.tab', function(event){
        var payment = $(event.target).attr('data-type-method');
        jQuery('input[type="radio"]').attr('checked',false);
        jQuery('input[type="file"]').attr('required',false);
        jQuery(payment).attr('checked',true);
        jQuery('input[type="file"]' + payment + '-file').attr('required',true);
    });
</script>
                               <script>
                                  const paypalButtonsComponent = paypal_sdk.Buttons({
                                      // optional styling for buttons
                                      // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
                                      style: {
                                        color: "gold",
                                        shape: "rect",
                                        layout: "vertical"
                                      },
                        
                                      // set up the transaction
                                      createOrder: (data, actions) => {
                                          // pass in any options from the v2 orders create call:
                                          // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                                          const createOrderPayload = {
                                              purchase_units: [
                                                  {
                                                      amount: {
                                                          value: $('#recipient-name').val(),
                                                      }
                                                  }
                                              ]
                                          };
                        
                                          return actions.order.create(createOrderPayload);
                                      },
                        
                                      // finalize the transaction
                                      onApprove: (data, actions) => {
                                          const captureOrderHandler = (details) => {
                                              const payerName = details.payer.name.given_name;
                                              console.log('Transaction completed');
                                              //save amount to amount ;)
                                              console.log(details);
                                              $.get('{{route("dashboard.admin.wallet_paypal_success_v2")}}', {body : details} , function(data) {
                                                  alert('success');
                                              });
                                          };
                        
                                         // return actions.order.capture().then(captureOrderHandler);
                                      },
                        
                                      // handle unrecoverable errors
                                      onError: (err) => {
                                          console.error('An error prevented the buyer from checking out with PayPal');
                                      }
                                  });
                        
                                  paypalButtonsComponent
                                      .render("#paypal-button-container")
                                      .catch((err) => {
                                          console.error('PayPal Buttons failed to render');
                                      });
                                </script>

@endsection
{{--Developed Saed Z. Sinwar--}}
