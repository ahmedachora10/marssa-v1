@extends('dashboard.master')

@section('store_settings')
    current
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/styles/store_settings.css') }}">
    <style>
        .fa, .fas {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="row small-spacing">
        <div class="col-xs-12">
            @if (session('error'))
                <div class="row">
                    <div class="small-spacing">
                        <div class="col-xs-12">
                            <div class="alert alert-error alert-dismissible"
                                 role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{!! __('master.'.session('error')) !!}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-xs-12">
            <div class="store-setup-row">
                @role('User|SubUser')
                <div class="col-xs-12">
                    <p><strong>{{ __('master.affiliate_for_us')}}</strong></p>
                    <br/>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.affiliates-create') }}">
                                <i class="fas fa-chart-pie"></i>
                                <p>{{ __('master.create-affiliate') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.payment_settings_des') }}</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.affiliatees-show') }}">
                                <i class="fas fa-chart-pie"></i>
                                <p>{{ __('master.show-affiliate') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.payment_settings_des') }}</small>
                        </div>
                    </div>
                </div>
                
                 <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.affiliatees-my-profits') }}">
                                <i class="fas fa-chart-pie"></i>
                                <p>{{ __('master.affiliates-profits') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.payment_settings_des') }}</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.affiliatees-withdraw') }}">
                                <i class="fas fa-chart-pie"></i>
                                <p>{{ __('master.affiliatees-withdraw') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.payment_settings_des') }}</small>
                        </div>
                    </div>
                </div>
                @endrole
                
                
                @role('User|SubUser')
                <div class="col-xs-12">
                    <p><strong>{{ __('master.affiliate_for_your_maket')}}</strong></p>
                    <br/>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.marketplace-affiliates-create') }}">
                                <i class="fas fa-chart-pie"></i>
                                <p>{{ __('master.create-account-for-affiliate-marketing') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.payment_settings_des') }}</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.marketplace-affiliaters-show') }}">
                                <i class="fas fa-chart-pie"></i>
                                <p>{{ __('master.affiliaters') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.payment_settings_des') }}</small>
                        </div>
                    </div>
                </div>
                
                 <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.affiliates-withdraw-profites') }}">
                                <i class="fas fa-chart-pie"></i>
                                <p>{{ __('master.withdraw-profites') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.payment_settings_des') }}</small>
                        </div>
                    </div>
                </div>
                @endrole

            </div>
        </div>
    </div>
@endsection
{{--Developed Saed Z. Sinwar--}}
