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
                            <a class="waves-effect" href="{{ route('dashboard.admin.cal-cost-estimation') }}">
                                <i class="fas fa-calculator"></i>
                                <p>{{ __('master.cost_estimation') }}</p>
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
                            <a class="waves-effect" href="{{ route('dashboard.admin.cal-growth-rate') }}">
                                <i class="fas fa-calculator"></i>
                                <p>{{ __('master.growth_rate') }}</p>
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
                            <a class="waves-effect" href="{{ route('dashboard.admin.target.show-target') }}">
                                <i class="fa fa-check-square" aria-hidden="true"></i>
                                <p>{{ __('master.target') }}</p>
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
                            <a class="waves-effect" href="{{ route('dashboard.links') }}">
                                <i class="fa fa-link" aria-hidden="true"></i>
                                <p>
                                    @if(app()->getLocale() == 'ar')
                                    
                                        مواقع مهمة
                                    @else
                                     
                                      important websites
                                    
                                    @endif
                                    
                                </p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">
                                 @if(app()->getLocale() == 'ar')
                                    
                                         بعض المواقع الهامة يمكنكـ اضافتها من هنا
                                    @else
                                     
                                      Add important websites
                                    
                                    @endif
                                
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
