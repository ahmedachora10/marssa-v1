@extends('dashboard.master')

@section('participants_index')
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
                @role('SuperAdmin|Admin')
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.users.index') }}">
                                <i class="fas fa-users"></i>
                                <p>{{ __('master.subscribers') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block">{{ __('master.subscribers_des') }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.stores') }}">
                                <i class="fas fa-store"></i>
                                <p>{{ __('master.stores') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block">{{ __('master.stores_des') }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.subscriptions.index') }}">
                                <i class="fas fa-user-clock"></i>
                                <p>{{ __('master.subscriptions') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block">{{ __('master.subscriptions_des') }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.invoices.index') }}">
                                <i class="fas fa-wallet"></i>
                                <p>{{ __('master.payments') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block">{{ __('master.payments_des') }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.domains.requests') }}">
                                <i class="fas fa-globe-africa"></i>
                                <p>{{ __('master.DomainChangeOrders') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block">{{ __('master.DomainChangeOrders_des') }}
                            </small>
                        </div>
                    </div>
                </div>

                 <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.wallet-orders') }}">
                                <i class="fas fa-wallet"></i>
                                <p>{{ __('master.ChargeWalletOrders') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block">{{ __('master.ChargeWalletOrders_des') }}
                            </small>
                        </div>
                    </div>
                </div>
                @endrole

                @role('User')

                @if($deadline)
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="small-spacing">
                                <div class="col-xs-12">
                                    <div class="alert @if(Carbon\Carbon::parse($deadline) < now()) alert-error @else alert-success @endif alert-dismissible"
                                         role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <p>
                                            @if(Carbon\Carbon::parse($deadline) < now())
                                                <strong>{{ __('master.activate_store_again')}}</strong>
                                            @else
                                                {{ __('master.deadline_date_des')}}<strong>{{ Carbon\Carbon::parse($deadline)->format('d/m/Y') }}</strong>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.store_settings.upgrade_plan') }}">
                                <i class="fas fa-award"></i>
                                <p>{{ __('master.upgrade_plan') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block">{{ __('master.upgrade_plan_des') }}</small>
                        </div>
                    </div>
                </div>--}}

                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.invoices.index') }}">
                                <i class="fas fa-wallet"></i>
                                <p>{{ __('master.payments') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block">{{ __('master.user_payments_des') }}
                            </small>
                        </div>
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </div>
@endsection
{{--Developed Saed Z. Sinwar--}}
