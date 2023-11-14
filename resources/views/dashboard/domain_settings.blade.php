@extends('dashboard.master')


@section('store_settings')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/styles/store_settings.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/timeline/css/style.css') }}">
    <style>
        .counter_step {
            color: #fff;
            font-size: 40px;
            margin: 0 20px;
        }

        @media (max-width: 768px) {
            .counter_step {
                font-size: 25px;
                margin: 0 13px;
            }
        }

        tspan {
            font-family: DINN-Medium;
        }

        .fa, .fas {
            margin-bottom: 10px;
        }

        .isotope-filter .filter-controls a {
            color: #4a4a4a;
            border: 2px solid #e0e0e0;
            padding: 8px 30px;
        }

        .isotope-filter .filter-controls a:hover {
            color: #5dd5c4;
            border: 2px solid #5dd5c4;
        }

        .isotope-filter .filter-controls .js__active {
            color: #5dd5c4;
            border: 2px solid #5dd5c4;
        }
    </style>
@endsection

@section('content')

    <div class="row small-spacing">
        <div class="col-xs-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ __('master.'.session('success')) }}</strong>
                </div>
            @endif
        </div>
        <div class="isotope-filter js__filter_isotope">
            <ul class="filter-controls">
                <li><a href="#" class="js__filter_control js__active" data-filter=".subdomain">
                        <i class="fas fa-globe"></i>
                        <span>{{ __('master.subdomain') }}</span>
                    </a>
                </li>
                <li><a href="#" class="js__filter_control" data-filter=".customdomain">
                        <i class="fas fa-link"></i>
                        <span>{{ __('master.customdomain') }}</span>
                    </a>
                </li>
            </ul>
            <div class="grid row row-inline-block small-spacing js__isotope_items">
                <div class="col-xs-12 js__isotope_item subdomain">
                    <div class="container">
                        <div class="row">
                            <div class="panel panel-default panel-small-title">
                                <div class="panel-heading">
                                    <h6 class="panel-title padding-10">{{ __('master.subdomain') }}</h6>
                                </div>
                                <div class="panel-body">
                                    <form method="POST" action="{{ route('dashboard.admin.domains.subdomain') }}"
                                          autocomplete="off">
                                        @csrf
                                        <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="card-content">
                                                        <div class="input-group @error('domain') has-error @enderror margin-bottom-20">
                                                            <div class="input-group-btn">
                                                                <label for="input-subdomain"
                                                                       class="btn btn-default">
                                                                    <i class="fas fa-globe"></i>
                                                                </label>
                                                            </div>
                                                            <input id="input-subdomain" type="text"
                                                                   class="form-control"
                                                                   name="domain"
                                                                   value='{{ $store->domain ?? "" }}'
                                                                   placeholder="{{ __('master.subdomain')  }}">
                                                        </div>
                                                        @error('domain')
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
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
                    </div>
                </div>
                <div class="col-xs-12 js__isotope_item customdomain margin-bottom-20">
                    <div class="container">
                        <div class="row">
                            @if(!$plan_domain)
                                <div class="text-center margin-bottom-60">
                                    <p class="lead">{{ __('master.package_cannot') }}</p>
                                    <p class="margin-top-10">
                                        <a href="{{ route('dashboard.admin.store_settings.upgrade_plan') }}"
                                           class="btn btn-primary btn-sm waves-effect waves-light">
                                            {{ __('master.upgrade_plan') }}
                                        </a>
                                    </p>
                                </div>
                            @endif

                            <section id="cd-timeline" class="cd-container">
                                <div class="cd-timeline-block">
                                    <div class="cd-timeline-img domain_selection">
                                        <strong class="counter_step lead">1</strong>
                                    </div>
                                    <div class="cd-timeline-content">
                                        <h2 class="margin-bottom-20">{{ __('master.domain_selection') }}</h2>
                                        @if($plan_domain)
                                            @if(!$customDomain)
                                                <form method="POST" autocomplete="off"
                                                      action="{{ route('dashboard.admin.domains.customdomain') }}">
                                                    @csrf
                                                    @endif
                                                    <div class="col-xs-12">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="card-content">
                                                                    <div class="input-group @error('customdomain') has-error @enderror margin-bottom-20">
                                                                        <div class="input-group-btn">
                                                                            <label for="input-customdomain"
                                                                                   class="btn btn-default">
                                                                                <i class="fas fa-link"></i>
                                                                            </label>
                                                                        </div>
                                                                        <input id="input-customdomain" type="text"
                                                                               class="form-control"
                                                                               name="customdomain"
                                                                               value='{{ $customDomain->custom ?? old("customdomain") }}'
                                                                               placeholder="{{ __('master.customdomain')  }}">
                                                                    </div>
                                                                    @error('customdomain')
                                                                    <span class="invalid-feedback"
                                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                                    @enderror
                                                                </div>
                                                                <div class="text-center">
                                                                    @if(!$customDomain)
                                                                        <button type="submit"
                                                                                class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                                            {{ __('master.save') }}
                                                                        </button>
                                                                    @endif
                                                                    <p class="text-danger">{{ __('master.domain_written_correctly') }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!$customDomain)
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="cd-timeline-block">
                                    <div class="cd-timeline-img change_name_server">
                                        <strong class="counter_step lead">2</strong>
                                    </div>
                                    <div class="cd-timeline-content">
                                        <h2>{{ __('master.change_name_server') }}</h2>
                                        @if($plan_domain)
                                            <p>{{ __('master.name_server_must_changed') }}</p>
                                            <div style="direction: ltr;text-align: left">
                                                <p>{{ env('ns1') }}</p>
                                                <p>{{ env('ns2') }}</p>
                                            </div>
                                            <p class="text-warning">{{ __('master.take_up_24') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="cd-timeline-block">
                                    <div class="cd-timeline-img check_data">
                                        <strong class="counter_step lead">3</strong>
                                    </div>
                                    <div class="cd-timeline-content">
                                        <h2>{{ __('master.check_data') }}</h2>
                                        @if($plan_domain)
                                            <p>{{ __('master.verify_name_server') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="cd-timeline-block">
                                    <div class="cd-timeline-img connect_domain">
                                        <strong class="counter_step lead">4</strong>
                                    </div>
                                    <div class="cd-timeline-content">
                                        <h2>{{ __('master.connect_domain') }}</h2>
                                        @if($plan_domain)
                                            @if($customDomain)
                                                @if($customDomain->status)
                                                    <p>{{ __('master.domain_associated') }}</p>
                                                    <p>{{ $customDomain->custom }}</p>
                                                @else
                                                    <p>{{ __('master.domain_connection_request') }}</p>
                                                @endif
                                            @else
                                                <p>{{ __('master.no_domain_associated') }}</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('dashboard/light/assets/scripts/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/cells-by-row.min.js') }}"></script>
    <script>
        var $grid = $('.grid').isotope({
            // options
        });
        $grid.isotope({filter: '.subdomain'});
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}