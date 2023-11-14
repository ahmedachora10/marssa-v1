@extends('dashboard.master')


@section('store_settings')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/styles/store_settings.css') }}">
    <style>
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
       <div class="col-12" style="padding: 20px;text-align: center;font-weight: bold">
          {{ $Branch->name }}
       </div>
        <div class="isotope-filter js__filter_isotope">
            <ul class="filter-controls">
                <li><a href="#" class="js__filter_control js__active" data-filter=".orders">
                        <i class="fas fa-box"></i>
                        <span>{{ __('master.orders') }}</span>
                    </a>
                </li>
                <li><a href="#" class="js__filter_control" data-filter=".sales">
                        <i class="fas fa-cart-arrow-down"></i>
                        <span>{{ __('master.sales') }}</span>
                    </a>
                </li>
                <li><a href="#" class="js__filter_control" data-filter=".visits">
                        <i class="fas fa-link"></i>
                        <span>{{ __('master.visits') }}</span>
                    </a>
                </li>
                @role('SuperAdmin|User')
                <li><a href="#" class="js__filter_control" data-filter=".export_data">
                        <i class="fas fa-file-export"></i>
                        <span>{{ __('master.export_data') }}</span>
                    </a>
                </li>
                @endrole
            </ul>
            <div class="grid row row-inline-block small-spacing js__isotope_items">
                <div class="col-xs-12 js__isotope_item orders">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="panel panel-default panel-small-title min-height">
                                    <div class="panel-heading ">
                                        <h6 class="panel-title">
                                            {{ __('master.total_orders') }} ({{ $total_orders }})
                                        </h6>
                                    </div>
                                    <div>
                                        <div id="orders_chart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="panel panel-default panel-small-title min-height">
                                    <div class="panel-heading ">
                                        <h6 class="panel-title">
                                            {{ __('master.most_wanted') }}
                                        </h6>
                                    </div>
                                    <div>
                                        <div id="most_wanted_chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 js__isotope_item sales">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="panel panel-default panel-small-title min-height">
                                    <div class="panel-heading ">
                                        <h6 class="panel-title">
                                            {{ __('master.total_sales') }}

                                            @role('SuperAdmin|Admin')
                                            ({{ $total_sales }})
                                            @endrole

                                            @role('User|SubUser')
                                            ({{ $amount_sales }} {{auth()->user()->getCurrency()}})
                                            @endrole

                                        </h6>
                                    </div>
                                    <div>
                                        <div id="sales_chart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="panel panel-default panel-small-title min-height">
                                    <div class="panel-heading ">
                                        <h6 class="panel-title">
                                            {{ __('master.best_seller') }}
                                        </h6>
                                    </div>
                                    <div>
                                        <div id="best_seller_chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 js__isotope_item visits">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="panel panel-default panel-small-title min-height">
                                    <div class="panel-heading ">
                                        <h6 class="panel-title">
                                            {{ __('master.visitors') }}
                                        </h6>
                                    </div>
                                    <div>
                                        <div id="visitors_country"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="panel panel-default panel-small-title min-height">
                                    <div class="panel-heading ">
                                        <h6 class="panel-title">
                                            {{ __('master.devices') }}
                                        </h6>
                                    </div>
                                    <div>
                                        <div id="visitors_platform"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @role('SuperAdmin|User')
                <div class="col-xs-12 js__isotope_item export_data">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="store-setup-row">
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'users','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-user-friends"></i>
                                                    <p>{{ __('master.users') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_users') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    @role('SuperAdmin')
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'stores','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-store-alt"></i>
                                                    <p>{{ __('master.stores') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_stores') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'subscribers','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-user-clock"></i>
                                                    <p>{{ __('master.subscribers') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_subscribes') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'invoices','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-wallet"></i>
                                                    <p>{{ __('master.invoices') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_invoices') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    @endrole
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'orders','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-cart-plus"></i>
                                                    <p>{{ __('master.orders') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_orders') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'clients','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-id-card"></i>
                                                    <p>{{ __('master.clients') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_clients') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'products','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-tshirt"></i>
                                                    <p>{{ __('master.products') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_products') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    @role('SuperAdmin')
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'contacts','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-file-signature"></i>
                                                    <p>{{ __('master.contacts_us') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_contacts') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    @endrole
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'information','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-question-circle"></i>
                                                    <p>{{ __('master.information') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_information') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'order_record','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-receipt"></i>
                                                    <p>{{ __('master.order_records') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_order_record') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'offers','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-gem"></i>
                                                    <p>{{ __('master.offers') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_offers') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'promo_code','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-cut"></i>
                                                    <p>{{ __('master.promo_code') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_promo_code') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <div class="store-setup-item">
                                            <i class="sicon-settings"></i>
                                            <div>
                                                <a class="waves-effect"
                                                   href="{{ route('dashboard.admin.export.data',['table' =>'visitors','branch_id'=>$Branch->id]) }}">
                                                    <i class="fas fa-street-view"></i>
                                                    <p>{{ __('master.visitors') }}</p>
                                                </a>
                                                <small class="store-setup-desc hidden-xs display-block">
                                                    {{ __('master.export_visitors') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('dashboard/light/assets/scripts/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/cells-by-row.min.js') }}"></script>

    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/variable-pie.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/series-label.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/exporting.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/export-data.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/highcharts/accessibility.js') }}"></script>
    <script>
        var $grid = $('.grid').isotope({
            // options
        });
        $grid.isotope({filter: '.orders'});

        let orders = JSON.parse("{{ $orders }}"),
            sales = JSON.parse("{{ $sales }}"),
            visitors_country = JSON.parse('{!! $visitors_country !!}'),
            visitors_platform = JSON.parse('{!! $visitors_platform !!}'),
            best_selling = JSON.parse('{!! $best_selling !!}'),
            most_wanted = JSON.parse('{!! $most_wanted !!}'),
            current_month = "{{ $current_month }}",
            categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];


        categories = categories.slice(current_month, 12).concat(categories.slice(0, current_month));
        Highcharts.chart('orders_chart', {
            chart: {
                type: 'area'
            },
            title: {
                text: '{{ __("master.TotalAnnualOrders") }}'
            },
            subtitle: {
                text: 'Source: {{ auth()->user()->get_store_domain() }}'
            },
            xAxis: {
                categories: categories,
            },
            yAxis: {
                title: {
                    text: 'Number of Orders'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                }
            },
            series: [{
                name: 'Orders',
                data: orders
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        Highcharts.chart('most_wanted_chart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '{{ __("master.MostWantedProducts") }}'
            },
            subtitle: {
                text: 'Source: {{ auth()->user()->get_store_domain() }}'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Orders',
                colorByPoint: true,
                data: most_wanted
            }]
        });

        Highcharts.chart('sales_chart', {
            chart: {
                type: 'area'
            },
            title: {
                text: '{{ __("master.TotalAnnualSales") }}'
            },
            subtitle: {
                text: 'Source: {{ auth()->user()->get_store_domain() }}'
            },
            xAxis: {
                categories: categories,
            },
            yAxis: {
                title: {
                    text: 'Number of Sales'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                }
            },
            series: [{
                name: 'Sales',
                data: sales
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });

        Highcharts.chart('best_seller_chart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '{{ __("master.BestSellingProducts") }}'
            },
            subtitle: {
                text: 'Source: {{ auth()->user()->get_store_domain() }}'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Sales',
                colorByPoint: true,
                data: best_selling
            }]
        });

        Highcharts.chart('visitors_country', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '{{ __("master.VisitorsStoreCountry") }}'
            },
            subtitle: {
                text: 'Source: {{ auth()->user()->get_store_domain() }}'
            },
            tooltip: {
                pointFormat: '{point.x}: <b>{point.y}</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Visitors',
                colorByPoint: true,
                data: visitors_country
            }]
        });
        Highcharts.chart('visitors_platform', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '{{ __("master.VisitorsStorePlatform") }}'
            },
            subtitle: {
                text: 'Source: {{ auth()->user()->get_store_domain() }}'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Visitors',
                colorByPoint: true,
                data: visitors_platform
            }]
        });
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
