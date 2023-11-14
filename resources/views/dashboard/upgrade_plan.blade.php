@extends('dashboard.master')


@section('participants_index')
    current active
@endsection

@section('head_tag')
    <style>
        .store-item__plan {
            background: #fff url("{{ asset('site/images/bg.png') }}") no-repeat top left;
            background-size: 80% auto;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .05);
            transition: transform .2s;
        }

        .plan1 {
            background: url({{ asset('site/images/sparkles.svg') }}) no-repeat
        }

        .plan2 {
            background: url({{ asset('site/images/plan-plus.png') }}) no-repeat
        }

        .plan3 {
            background: url({{ asset('site/images/falling-star.svg') }}) no-repeat
        }

        .plan2_color {
            color: #764aaf !important;
        }

        .plan3_color {
            color: #55ccfc !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-xs-12">
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
    <div class="col-xs-12">
        <div class="container-fluid margin-bottom-20">
            <div class="store-heading">
                <h6 class="">
                    <i class="sicon-shopping-bag2"></i>{{ __('master.current_package') }}
                </h6>
            </div>
            <div class="row text-center">
                <div class="store-item-wrapper  col-12 col-lg-4 col-md-6">
                    <a href="{{ route('dashboard.admin.package',['id'=>$user_plan->id]) }}"
                       style="display: block;"
                       class="store-item__plan store-item__plan-basic store-item__plan-1 align-center">
                        <div class="plan-top plan{{$user_plan->id}}">
                            <h6 class="plan-title">
                                <strong>{{ $user_plan['name_'.app()->getLocale()] }}</strong>
                            </h6>
                        </div>
                        @if($plan->price > 0) <!--Carbon\Carbon::parse($deadline)->subDays(800) < now()-->
                            <div class="plan-bottom">
                                @if($plan->price == 0)
                                    <span class="plan-price plan{{$plan->id}}_color">{{ __('site.free') }}</span>
                                @else
                                    <span class="plan-price plan{{$plan->id}}_color">{{ round($plan->price,0) }}</span>
                                    <span class="plan-currency plan{{$plan->id}}_color"> </span>
                                @endif
                                <span class="clearfix"></span>
                                
                                <button class="order-btn btn btn-tiffany btn-rounded btn-xs">
                                    {{ __('master.renew_current_package') }}
                                </button>
                            </div>
                        @endif
                    </a>
                </div>
            </div>

            <div class="store-heading">
                <h6 class="">
                    <i class="sicon-shopping-bag2"></i>{{ __('master.choose_new_package') }}
                </h6>
            </div>
            <div class="row">
            
                @foreach($plans as $plan)
                    @if($user_plan['id'] != $plan->id)
                        @if((Carbon\Carbon::parse($deadline) >= now() and !($user_plan['price'] > 0 and $plan->price == 0)) or Carbon\Carbon::parse($deadline) < now() )
                            <div class="store-item-wrapper  col-12 col-lg-4 col-md-6">
                                <a href="{{ route('dashboard.admin.package',['id'=>$plan->id]) }}"
                                   style="display: block;"
                                   class="store-item__plan store-item__plan-basic store-item__plan-1 align-center">
                                    <div class="plan-top plan{{$plan->id}}">
                                        <h6 class="plan-title plan{{$plan->id}}_color">
                                            <strong>{{ $plan['name_'.app()->getLocale()] }}</strong>
                                        </h6>
                                    </div>
                                    <div class="plan-bottom">
                                        @if($plan->price == 0)
                                            <span class="plan-price plan{{$plan->id}}_color">{{ __('site.free') }}</span>
                                        @else
                                            <span class="plan-price plan{{$plan->id}}_color">{{ round($plan->price,0) }}</span>
                                            <span class="plan-currency plan{{$plan->id}}_color"> </span>
                                        @endif
                                        <span class="clearfix"></span>
                                        <button class="order-btn btn btn-tiffany btn-rounded btn-xs">
                                            {{ __('master.upgrade_plan') }}
                                        </button>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            <div class="store-heading">
                <h6 class="">
                    <i class="sicon-shopping-bag2"></i>{{ __('master.previous_upgrade') }}
                </h6>
            </div>
            <div class="col-xs-12">
                <div class="row">
                    @forelse($previous_upgrade as $subscribe)
                        <div class="col-md-4 col-xs-12">
                            <div class="box-content bordered primary margin-bottom-20">
                                <h4 class="box-title"># {{ $subscribe->id }}</h4>
                                <table class="table table-hover no-margin">
                                    <tbody>
                                    <tr>
                                        <td>{{ __('master.store_plan') }}</td>
                                        <td>
                                            <span class="notice notice-purple">{{ $subscribe->plan['name_'.app()->getLocale()] ?? '' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('master.deadline_date') }}</td>
                                        <td>
                                            <span>{{ Carbon\Carbon::parse($subscribe->deadline)->toFormattedDateString()}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('master.upgrade_date') }}</td>
                                        <td>
                                            <span>{{ Carbon\Carbon::parse($subscribe->created_at)->toFormattedDateString()}}</span>
                                        </td>
                                    </tr>
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
                    <div>
                    </div>
                    <div class="clearfix text-center">
                        {{ $previous_upgrade->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--Developed Saed Z. Sinwar--}}
