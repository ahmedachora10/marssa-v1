@extends('dashboard.master')


@section('store_settings')
    current active
@endsection



@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/dropify/css/dropify.min.css') }}">
    <style>
        .dropify-wrapper {
            border: none !important;
        }
    </style>
@endsection



@section('content')
    @if (session('message'))
        <div class="small-spacing">
            <div class="col-xs-12">
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ __('master.'.session('message')) }}</strong>
                </div>
            </div>
        </div>
    @endif
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                @role('User')

                <div class="col-xs-12">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title">{{ __('master.Shipping_fee') }}</h6>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('dashboard.admin.information.store') }}">
                                @csrf
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="card-content">
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="ig-shipping" class="btn btn-default"><i class="fa fa-ship"></i></label>
                                                    </div>
                                                    <input id="ig-shipping" type="text" class="form-control" name="shipping"
                                                           value='{{ $store->shipping }}'
                                                           placeholder="{{ __('master.Shipping_fee')  }}">
                                                </div>
                                            </div>

                                            <div class="panel-heading">
                                                <h6 class="panel-title">{{ __('master.display_sold') }}</h6>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group col-xs-12">
                                                    <label for="paypal_status" hidden >{{ __('master.display_sold')  }}</label>
                                                    <select name="display_sold" id="display_sold" class="form-control">
                                                        <option value="0" {{($store->display_sold == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->display_sold == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                        class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                    {{ __('master.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title">{{ __('master.footer_payments_image') }}</h6>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('dashboard.admin.information.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="card-content">
                                                <div class="form-group col-xs-12">
                                                    <div class="card-content margin-bottom-10">
                                                        @include("dashboard.components.fileUploadJson",['name'=>'footer_payments_image','product'=> $information['footer_payments_image'] ])
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                        class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                    {{ __('master.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title">{{ __('master.Notes') }} </h6>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('dashboard.admin.information.notes') }}">
                                @csrf
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">{{ __('master.payment_note') }}</h6>
                                            </div>
                                            <div class="card-content">
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="ig-shipping" class="btn btn-default">
                                                            <i class="fa fa-sticky-note"></i></label>
                                                    </div>
                                                    <input id="payment_note" type="text" class="form-control" name="payment_note"
                                                           value='{{ data_get($store->paymentNote,'value') }}'
                                                           placeholder="{{ __('master.payment_note')  }}">
                                                </div>
                                            </div>
                                            <div class="panel-heading">
                                                <h6 class="panel-title">{{ __('master.thanks_note') }}</h6>
                                            </div>
                                            <div class="card-content">
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="ig-shipping" class="btn btn-default">
                                                            <i class="fa fa-check-circle"></i></label>
                                                    </div>
                                                    <input id="thanks_note" type="text" class="form-control" name="thanks_note"
                                                           value='{{ data_get($store->thanksNote,'value') }}'
                                                           placeholder="{{ __('master.thanks_note')  }}">
                                                </div>
                                            </div>
                                            <div class="text-center"><button type="submit" class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                    {{ __('master.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @PlanPermissions('paypal-bankily')
                <div class="col-md-6 col-xs-12">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title">{{ __('master.PayPal') }}</h6>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('dashboard.admin.information.store') }}">
                                @csrf
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="card-content">
                                                <div class="form-group @error('payment.paypal_status') has-error @enderror col-xs-12">
                                                    <label for="paypal_status" >{{ __('master.paypal_status')  }}</label>
                                                    <select name="payment[paypal][paypal_status]" id="paypal_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['paypal']['paypal_status'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['paypal']['paypal_status'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="paypal_client_id" class="btn btn-default">
                                                            <i class="fa fa-star"></i></label>
                                                    </div>
                                                    <input id="paypal_client_id" type="text" class="form-control" name="payment[paypal][paypal_client_id]"
                                                           value="{{ $store->payment_methods['paypal']['paypal_client_id'] }}"
                                                           placeholder="{{ __('master.paypal_client_id')  }}">
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="paypal_secret" class="btn btn-default">
                                                            <i class="fa fa-star"></i></label>
                                                    </div>
                                                    <input id="paypal_secret" type="text" class="form-control" name="payment[paypal][paypal_secret]"
                                                           value="{{ $store->payment_methods['paypal']['paypal_secret'] }}"
                                                           placeholder="{{ __('master.paypal_secret')  }}">
                                                </div>
                                            </div>

                                            <div class="card-content">
                                                <div class="form-group @error('payment.paypal_type') has-error @enderror col-xs-12">
                                                    <label for="paypal_type" >{{ __('master.paypal_type')  }}</label>
                                                    <select name="payment[paypal][paypal_type]" id="paypal_type" class="form-control">
                                                        <option value="sandbox"  {{($store->payment_methods['paypal']['paypal_type'] == 'sandbox') ? 'selected' : ''}}>{{ __('master.paypal_sandbox')  }}</option>
                                                        <option value="live"  {{($store->payment_methods['paypal']['paypal_type'] == 'live') ? 'selected' : ''}}>{{ __('master.paypal_live')  }}</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <hr>
                                                    <b>{{__('master.required_data')}}</b>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Feilds.more_details') has-error @enderror col-xs-12">
                                                    <label for="paypal_status" >{{ __('master.more_details')  }}</label>
                                                    <select name="payment[paypal][Feilds][more_details]" id="paypal_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['paypal']['Feilds']['more_details'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['paypal']['Feilds']['more_details'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                        class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                    {{ __('master.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title">{{ __('master.Bankily') }}</h6>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('dashboard.admin.information.store') }}">
                                @csrf
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Bankily_status') has-error @enderror col-xs-12">
                                                    <label for="paypal_status" >{{ __('master.Bankily_status')  }}</label>
                                                    <select name="payment[Bankily][Bankily_status]" id="Bankily_status" class="form-control">
                                                        <option value="0"  {{($store->payment_methods['Bankily']['Bankily_status'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1"  {{($store->payment_methods['Bankily']['Bankily_status'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group">
                                                    <label>{{__('master.phone')}}</label>
                                                    <input id="Bankily_account_number" type="text" class="form-control" name="payment[Bankily][Feilds][Bankily_to_phone]"
                                                           value="{{ $store->payment_methods['Bankily']['Feilds']['Bankily_to_phone'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <hr>
                                                    <b>{{__('master.required_data')}}</b>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Feilds.fullname') has-error @enderror col-xs-12">
                                                    <label for="Bankily_status" >{{ __('master.full_name')  }}</label>
                                                    <select name="payment[Bankily][Feilds][fullname]" id="Bankily_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Bankily']['Feilds']['fullname'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Bankily']['Feilds']['fullname'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Feilds.address') has-error @enderror col-xs-12">
                                                    <label for="Bankily_status" >{{ __('store.address')  }}</label>
                                                    <select name="payment[Bankily][Feilds][address]" id="Bankily_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Bankily']['Feilds']['address'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Bankily']['Feilds']['address'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Feilds.email') has-error @enderror col-xs-12">
                                                    <label for="Bankily_status" >{{ __('store.email')  }}</label>
                                                    <select name="payment[Bankily][Feilds][email]" id="Bankily_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Bankily']['Feilds']['email'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Bankily']['Feilds']['email'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Feilds.more_details') has-error @enderror col-xs-12">
                                                    <label for="Bankily_status" >{{ __('master.more_details')  }}</label>
                                                    <select name="payment[Bankily][Feilds][more_details]" id="Bankily_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Bankily']['Feilds']['more_details'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Bankily']['Feilds']['more_details'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                        class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                    {{ __('master.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endPlanPermissions
                @PlanPermissions('cod')
                <div class="col-md-6 col-xs-12">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title">{{ __('master.Paiement_when_receiving') }}</h6>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('dashboard.admin.information.store') }}">
                                @csrf
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="card-content set-align">
                                                <div class="form-group @error('payment.Paiement_when_receiving_status') has-error @enderror col-xs-12">
                                                    <label for="Paiement_when_receiving_status" >{{ __('master.Paiement_when_receiving_status')  }}</label>

                                                    <select name="payment[Paiement_when_receiving][Paiement_when_receiving_status]" id="Paiement_when_receiving_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Paiement_when_receiving']['Paiement_when_receiving_status'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Paiement_when_receiving']['Paiement_when_receiving_status'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                           
                                            <div class="card-content set-align">
                                                <div class="col-md-12">
                                                    <hr>
                                                    <b>{{__('master.required_data')}}</b>
                                                    <hr>
                                                </div>
                                                <div class="form-group @error('payment.Feilds.fullname') has-error @enderror col-xs-12">
                                                    <label for="Bank_transfer_status" >{{ __('master.full_name')  }}</label>
                                                    <select name="payment[Paiement_when_receiving][Feilds][fullname]" id="Paiement_when_receiving_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Paiement_when_receiving']['Feilds']['fullname'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Paiement_when_receiving']['Feilds']['fullname'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content set-align">
                                                <div class="form-group @error('payment.Feilds.address') has-error @enderror col-xs-12">
                                                    <label for="Paiement_when_receiving_status" >{{ __('store.address')  }}</label>
                                                    <select name="payment[Paiement_when_receiving][Feilds][address]" id="Paiement_when_receiving_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Paiement_when_receiving']['Feilds']['address'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Paiement_when_receiving']['Feilds']['address'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content set-align">
                                                <div class="form-group @error('payment.Feilds.email') has-error @enderror col-xs-12">
                                                    <label for="Paiement_when_receiving_status" >{{ __('store.email')  }}</label>
                                                    <select name="payment[Paiement_when_receiving][Feilds][email]" id="Paiement_when_receiving_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Paiement_when_receiving']['Feilds']['email'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Paiement_when_receiving']['Feilds']['email'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content set-align">
                                                <div class="form-group @error('payment.Feilds.more_details') has-error @enderror col-xs-12">
                                                    <label for="Paiement_when_receiving_status" >{{ __('master.more_details')  }}</label>
                                                    <select name="payment[Paiement_when_receiving][Feilds][more_details]" id="Paiement_when_receiving_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Paiement_when_receiving']['Feilds']['more_details'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Paiement_when_receiving']['Feilds']['more_details'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-center set-align">
                                                <button type="submit"
                                                        class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                    {{ __('master.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endPlanPermissions
                @PlanPermissions('paypal-bankily')
                <div class="col-md-6 col-xs-12">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title">{{ __('master.Bank_transfer') }}</h6>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('dashboard.admin.information.store') }}">
                                @csrf
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Bank_transfer_status') has-error @enderror col-xs-12">
                                                    <label for="Bank_transfer_status" >{{ __('master.Bank_transfer_status')  }}</label>
                                                    <select name="payment[Bank_transfer][Bank_transfer_status]" id="Bank_transfer_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Bank_transfer']['Bank_transfer_status'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Bank_transfer']['Bank_transfer_status'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group margin-bottom-20">
                                                    <label for="bank_name">{{__('master.bank_name')}}</label>
                                                    <input id="bank_name" type="text" class="form-control" name="payment[Bank_transfer][Feilds][bank_name]" value="{{ $store->payment_methods['Bank_transfer']['Feilds']['bank_name'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group margin-bottom-20">
                                                    <label for="bank_account_number">{{__('master.bank_account_number')}}</label>
                                                    <input id="bank_account_number" type="text" class="form-control" name="payment[Bank_transfer][Feilds][bank_account_number]" value="{{ $store->payment_methods['Bank_transfer']['Feilds']['bank_account_number'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group margin-bottom-20">
                                                    <label for="bank_account_name">{{__('master.bank_account_name')}}</label>
                                                    <input id="bank_account_name" type="text" class="form-control" name="payment[Bank_transfer][Feilds][bank_account_name]" value="{{ $store->payment_methods['Bank_transfer']['Feilds']['bank_account_name'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group margin-bottom-20">
                                                    <label for="bank_iban">{{__('master.bank_iban')}}</label>
                                                    <input id="bank_iban" type="text" class="form-control" name="payment[Bank_transfer][Feilds][bank_iban]" value="{{ $store->payment_methods['Bank_transfer']['Feilds']['bank_iban'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <hr>
                                                    <b>{{__('master.required_data')}}</b>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Feilds.fullname') has-error @enderror col-xs-12">
                                                    <label for="Bank_transfer_status" >{{ __('master.full_name')  }}</label>
                                                    <select name="payment[Bank_transfer][Feilds][fullname]" id="Bank_transfer_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Bank_transfer']['Feilds']['fullname'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Bank_transfer']['Feilds']['fullname'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Feilds.address') has-error @enderror col-xs-12">
                                                    <label for="Bank_transfer_status" >{{ __('store.address')  }}</label>
                                                    <select name="payment[Bank_transfer][Feilds][address]" id="Bank_transfer_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Bank_transfer']['Feilds']['address'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Bank_transfer']['Feilds']['address'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Feilds.email') has-error @enderror col-xs-12">
                                                    <label for="Bank_transfer_status" >{{ __('store.email')  }}</label>
                                                    <select name="payment[Bank_transfer][Feilds][email]" id="Bank_transfer_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Bank_transfer']['Feilds']['email'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Bank_transfer']['Feilds']['email'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="form-group @error('payment.Feilds.more_details') has-error @enderror col-xs-12">
                                                    <label for="Bank_transfer_status" >{{ __('master.more_details')  }}</label>
                                                    <select name="payment[Bank_transfer][Feilds][more_details]" id="Bank_transfer_status" class="form-control">
                                                        <option value="0" {{($store->payment_methods['Bank_transfer']['Feilds']['more_details'] == 0) ? 'selected' : ''}}>{{ __('master.disabled')  }}</option>
                                                        <option value="1" {{($store->payment_methods['Bank_transfer']['Feilds']['more_details'] == 1) ? 'selected' : ''}}>{{ __('master.enable')  }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                        class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                    {{ __('master.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endPlanPermissions

                @endrole
            </div>
        </div>
    </div>
    <style>
        @media(max-width:600px){
            .set-align{
                float:right;
                width:100%;
            }
        }
    </style>
@endsection


@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/fileUpload.demo.min.js') }}"></script>

@endsection
{{--Developed Saed Z. Sinwar--}}
