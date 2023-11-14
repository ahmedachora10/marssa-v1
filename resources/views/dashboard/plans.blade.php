@extends('dashboard.master')


@section('plan_index')
    current active
@endsection

@section('content')

    <div class="col-xs-12 margin-top-40">
        <a href="{{ route('dashboard.admin.plans.promo_codes') }}"
           class="btn btn-primary btn-rounded waves-effect waves-light">
            <i class="fas fa-cut"></i>
            {{ __('master.promo_code') }}
        </a>
    </div>
    <div class="col-xs-12">
        <div class="margin-top-50 center_dev">
            @forelse($plans as $plan)
                <div class="col-md-3 col-xs-12">
                    <div class="box-content bordered primary margin-bottom-20">
                        <div class="dropdown js__drop_down">
                            <a href="#"
                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('dashboard.admin.plans.edit',['id'=>$plan->id]) }}">{{ __('master.plan_edit')}}</a>
                                </li>
                            </ul>
                        </div>
                        <h4 class="box-title">{{ __('master.plan') }} #{{ $plan->id }}</h4>
                        <div class="profile-avatar">
                            <h3 class="nowrap-overlay">
                                <strong>{{ $plan['name_'.app()->getLocale()]}}</strong>
                            </h3>
                        </div>
                        <table class="table table-hover no-margin text-center">
                            <tbody>
                            <tr>
                                <td>
                                    <span>{{ __('master.stores_count') }}</span>&nbsp;&nbsp;&nbsp;
                                    <span class="notice notice-danger">{{ count($plan->stores()->get()) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="notice notice-green">{{ __('master.plan_details') }}</span>
                                </td>
                            </tr>
                            @forelse(explode('*', $plan['description_' . app()->getLocale()]) as $item)
                                <tr>
                                    <td>{{ $item }}</td>
                                </tr>
                            @empty
                                <li>{{ __('master.no_data') }}</li>
                            @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="no_data">
                    <p><i class="fas fa-database fa-4x"></i></p>
                    <p>{{ __('master.no_data') }}</p>
                </div>
            @endforelse
        </div>
    </div>
    <div class="col-xs-12">
        <div class="pricing-plan">
            <div class="pricing-table center_dev">
                <div class="col col-first">
                    <div class="thead">
                        <div class="center-v">{{ __('master.' . $title_page)}}</div>
                    </div>
                    <div class="td">{{ __('master.multi_language') }}</div>
                    <div class="td">{{ __('master.ssl_support') }}</div>
                    <div class="td">{{ __('master.integration_fb_google') }}</div>
                    <div class="td">{{ __('master.custom_domain') }}</div>
                    <div class="td">{{ __('master.custom_design') }}</div>
                    <div class="td">{{ __('master.offer_count') }}</div>
                    <div class="td">{{ __('master.order_count') }}</div>
                    <div class="td">{{ __('master.users_count') }}</div>
                </div>
                <div class="col">
                    <div class="thead bg-blue-1">
                        <h4>{{ $plans[0]['name_'.app()->getLocale()] }}</h4>
                        <div class="price">
                            <span class="currency">{{ env('currency_symbol') }}</span>
                            <span class="number">{{ $plans[0]['price'] }}</span>
                            <span class="time">{{ __('site.month_not$') }}</span>
                        </div>
                    </div>
                    <div class="td">
                        @if($plans[0]->language == 0)
                            {{ __('master.arabic') . __('master.or') . __('master.english')}}
                        @else
                            {{ __('master.both') }}
                        @endif
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[0]->ssl) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[0]->integration) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[0]->custom_domain) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[0]->custom_design) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        @if($plans[0]->offer_count == 1000000)
                            {{ __('master.unlimited') }}
                        @else
                            {{ $plans[0]->offer_count }}
                        @endif
                    </div>
                    <div class="td">
                        @if($plans[0]->order_count == 1000000)
                            {{ __('master.unlimited') }}
                        @else
                            {{ $plans[0]->order_count }}
                        @endif
                    </div>
                    <div class="td">
                        @if($plans[0]->users_count == 1000000)
                            {{ __('master.unlimited') }}
                        @else
                            {{ $plans[0]->users_count }}
                        @endif
                    </div>
                    <div class="td"><a href="{{ route('dashboard.admin.plans.edit',['id'=> 1]) }}"
                                       class="btn-order js__popup_open"
                                       data-target="#register-form-popup-2">{{ __('master.plan_edit') }}</a></div>
                </div>
                <div class="col col-featured">
                    <div class="thead bg-main-2">
                        <h4>{{ $plans[1]['name_'.app()->getLocale()] }}</h4>
                        <div class="price">
                            <span class="currency">{{ env('currency_symbol') }}</span>
                            <span class="number">{{ $plans[1]['price'] }}</span>
                            <span class="time">{{ __('site.month_not$') }}</span>
                        </div>
                    </div>
                    <div class="td">
                        @if($plans[1]->language == 0)
                            {{ __('master.arabic') . __('master.or') . __('master.arabic')}}
                        @else
                            {{ __('master.both') }}
                        @endif
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[1]->ssl) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[1]->integration) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[1]->custom_domain) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[1]->custom_design) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        @if($plans[1]->offer_count == 1000000)
                            {{ __('master.unlimited') }}
                        @else
                            {{ $plans[1]->offer_count }}
                        @endif
                    </div>
                    <div class="td">
                        @if($plans[1]->order_count == 1000000)
                            {{ __('master.unlimited') }}
                        @else
                            {{ $plans[1]->order_count }}
                        @endif
                    </div>
                    <div class="td">
                        @if($plans[1]->users_count == 1000000)
                            {{ __('master.unlimited') }}
                        @else
                            {{ $plans[1]->users_count }}
                        @endif
                    </div>
                    <div class="td"><a href="{{ route('dashboard.admin.plans.edit',['id'=> 2]) }}"
                                       class="btn-order js__popup_open"
                                       data-target="#register-form-popup-2">{{ __('master.plan_edit') }}</a></div>

                </div>
                <div class="col">
                    <div class="thead bg-blue-2">
                        <h4>{{ $plans[2]['name_'.app()->getLocale()] }}</h4>
                        <div class="price">
                            <span class="currency">{{ env('currency_symbol') }}</span>
                            <span class="number">{{ $plans[2]['price'] }}</span>
                            <span class="time">{{ __('site.month_not$') }}</span>
                        </div>
                    </div>
                    <div class="td">
                        @if($plans[2]->language == 0)
                            {{ __('master.arabic') . __('master.or') . __('master.arabic')}}
                        @else
                            {{ __('master.both') }}
                        @endif
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[2]->ssl) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[2]->integration) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[2]->custom_domain) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        <i class="fa @if($plans[2]->custom_design) fa-check @else fa-times @endif"></i>
                    </div>
                    <div class="td">
                        @if($plans[2]->offer_count == 1000000)
                            {{ __('master.unlimited') }}
                        @else
                            {{ $plans[2]->offer_count }}
                        @endif
                    </div>
                    <div class="td">
                        @if($plans[2]->order_count == 1000000)
                            {{ __('master.unlimited') }}
                        @else
                            {{ $plans[2]->order_count }}
                        @endif
                    </div>
                    <div class="td">
                        @if($plans[2]->users_count == 1000000)
                            {{ __('master.unlimited') }}
                        @else
                            {{ $plans[2]->users_count }}
                        @endif
                    </div>
                    <div class="td"><a href="{{ route('dashboard.admin.plans.edit',['id'=> 3]) }}"
                                       class="btn-order js__popup_open"
                                       data-target="#register-form-popup-2">{{ __('master.plan_edit') }}</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
{{--Developed Saed Z. Sinwar--}}
