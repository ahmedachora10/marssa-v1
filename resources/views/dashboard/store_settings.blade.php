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
                <div class="col-12 mb-2">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        @if(app()->getLocale() == 'ar')
                            رجوع
                        @else
                            back
                        @endif
                        
                    </a>
                    <hr>
                </div>
                @role('User|SubUser')
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.store_settings.store_design') }}">
                                <i class="fas fa-desktop"></i>
                                <p>{{ __('master.store_design') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.store_design_des') }}</small>
                        </div>
                    </div>
                </div>
                @endrole

                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.store_settings.basic_settings') }}">
                                <i class="fas fa-store"></i>
                                <p>{{ __('master.basic_settings') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.basic_settings_des') }}</small>
                        </div>
                    </div>
                </div>

                @role('User|SubUser')
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.store_settings.store_payment') }}">
                                <i class="fas fa-dollar-sign"></i>
                                <p>{{ __('master.payment_settings') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.payment_settings_des') }}</small>
                        </div>
                    </div>
                </div>
                @endrole

                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect"
                               href="{{ route('dashboard.admin.store_settings.linking_services') }}">
                                <i class="fas fa-puzzle-piece"></i>
                                <p>{{ __('master.linking_services') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.linking_services_des') }}</small>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.store_settings.seo') }}">
                                <i class="fas fa-search"></i>
                                <p>SEO</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.seo') }}</small>
                        </div>
                    </div>
                </div>


                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.store_settings.store_staff') }}">
                                <i class="fas fa-users"></i>
                                <p>{{ __('master.store_staff') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.store_staff_des') }}
                            </small>
                        </div>
                    </div>
                </div>

                @role('User')
                @PlanPermissions('sell-by-branches')
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-dollar-cash"></i>
                        <div>
                            <a class="waves-effect" href="{{ url('dashboard/admin/store_settings/branches') }}">
                                <i class="fas fa-map-marker"></i>
                                <p>{{ __('master.branches') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.branches_desc') }}</small>
                        </div>
                    </div>
                </div>
                @endPlanPermissions
                @endrole


                @role('User|SuperAdmin')
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.store_settings.pages') }}">
                                <i class="fas fa-file-invoice"></i>
                                <p>{{ __('master.sub_pages') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.sub_pages_des') }}</small>
                        </div>
                    </div>
                </div>
                @endrole
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.slider.index') }} ">
                                <i class="fas fa-wrench"></i>
                                <p>{{ __('store.slider') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('store.slider') }}
                            </small>
                        </div>
                    </div>
                </div>
                @role('User|SubUser')
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect"
                               href="{{ route('dashboard.admin.store_settings.domain_settings') }}">
                                <i class="fas fa-globe-americas"></i>
                                <p>{{ __('master.domain_settings') }}</p>
                            </a>
                            <small class="store-setup-desc   display-block"
                                   style="color:black;font-weight:bold">{{ __('master.domain_settings_des') }}
                            </small>
                        </div>
                    </div>
                </div>
                {{--<div class="col-xs-6 col-md-3">--}}
                {{--<div class="store-setup-item">--}}
                {{--<i class="sicon-settings"></i>--}}
                {{--<div>--}}
                {{--<a class="waves-effect"--}}
                {{--href="{{ route('dashboard.admin.store_settings.account_control') }}">--}}
                {{--<i class="fas fa-exclamation-triangle"></i>--}}
                {{--<p>{{ __('master.account_control') }}</p>--}}
                {{--</a>--}}
                {{--<small class="store-setup-desc hidden-xs display-block">{{ __('master.account_control_des') }}</small>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}

                @endrole

{{--                @role('User')--}}
{{--                <div class="col-xs-6 col-md-3">--}}
{{--                    <div class="store-setup-item">--}}
{{--                        <i class="sicon-settings"></i>--}}
{{--                        <div>--}}
{{--                            <a class="waves-effect"--}}
{{--                               href="{{ route('dashboard.admin.store_settings.domain_settings') }}">--}}
{{--                                <i class="fas fa-trash"></i>--}}
{{--                                <p>{{ __('master.remove_store') }}</p>--}}
{{--                            </a>--}}
{{--                            <small class="store-setup-desc   display-block"--}}
{{--                                   style="color:black;font-weight:bold">{{ __('master.you_can_remove_your_store') }}--}}
{{--                            </small>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                @endrole--}}
                @role('SuperAdmin')
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.counters.index') }}">
                                <i class="fas fa-chart-line"></i>
                                <p>{{ __('master.counters') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block"
                                   style="color:black;font-weight:bold">{{ __('master.counters_des') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" target="_blank" href="{{ url('dashboard/admin/languages') }}">
                                <i class="fas fa-language"></i>
                                <p>{{ __('master.languages') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block"
                                   style="color:black;font-weight:bold">{{ __('master.languages_des') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect"
                               href="{{ route('dashboard.admin.contacts.index') }}">
                                <i class="fas fa-headset"></i>
                                <p>{{ __('master.technical_support') }}kkk</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block"
                                   style="color:black;font-weight:bold">{{ __('master.technical_support_des') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.feedback.index') }}">
                                <i class="fas fa-quote-right"></i>
                                <p>{{ __('master.feedback') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block"
                                   style="color:black;font-weight:bold">{{ __('master.feedback_des') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.store_settings.models_stores') }}">
                                <i class="fas fa-layer-group"></i>
                                <p>{{ __('master.models_stores') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block"
                                   style="color:black;font-weight:bold">{{ __('master.models_stores_des') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect"
                               href="{{ route('dashboard.admin.store_settings.features_platform') }}">
                                <i class="fas fa-thumbs-up"></i>
                                <p>{{ __('master.features_platform') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block"
                                   style="color:black;font-weight:bold">{{ __('master.features_platform_des') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect"
                               href="{{ route('dashboard.admin.store_settings.explanations.create') }}">
                                <i class="fas fa-play-circle"></i>
                                <p>{{ __('master.explanations') }}</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block"
                                   style="color:black;font-weight:bold">{{ __('master.explanations_des') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect"
                               href="{{ route('dashboard.admin.store_settings.scheduled_messages.index') }}">
                                <i class="fas fa-comment-alt"></i>
                                <p>الرسائل المجدولة</p>
                            </a>
                            <small class="store-setup-desc hidden-xs display-block"
                                   style="color:black;font-weight:bold">{{ __('master.scheduled_messages_des') }}</small>
                        </div>
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </div>
@endsection
{{--Developed Saed Z. Sinwar--}}
