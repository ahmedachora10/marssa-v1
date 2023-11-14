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
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.products.attributes.index') }}">
                                <i class="fas fa-tshirt"></i>
                                <p>{{ __('master.all_products_attributes') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.products_attributes') }}</small>
                        </div>
                    </div>
                </div>
                 <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.products.attributes.values.index') }}">
                                <i class="fas fa-tshirt"></i>
                                <p>{{ __('master.all_products_attributes_values') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.products_attributes') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.products.index') }}">
                                <i class="fas fa-tshirt"></i>
                                <p>{{ __('master.all_products') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.products') }}</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.Reviews') }}">
                                <i class="fas fa-star"></i>
                                <p>{{ __('master.Reviews') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.products') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.categorize.index') }}">
                                <i class="fas fa-cart-plus"></i>
                                <p>{{ __('master.categorize') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.products') }}</small>
                        </div>
                    </div>
                </div>
                
                 <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect"  href="{{ route('dashboard.admin.categorize.add') }}">
                                <i class="fas fa-plus"></i>
                                <p>{{ __('master.add_category') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.products') }}</small>
                        </div>
                    </div>
                </div>
                @endrole

            </div>
        </div>
    </div>
@endsection
{{--Developed Saed Z. Sinwar--}}
