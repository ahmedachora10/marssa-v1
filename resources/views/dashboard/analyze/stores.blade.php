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
    <style>
        @import 'https://code.highcharts.com/css/highcharts.css';

        .highcharts-pie-series .highcharts-point {
            stroke: #EDE;
            stroke-width: 2px;
        }

        .highcharts-pie-series .highcharts-data-label-connector {
            stroke: silver;
            stroke-dasharray: 2, 2;
            stroke-width: 2px;
        }

        .highcharts-figure, .highcharts-data-table table {
            min-width: 320px;
            max-width: 600px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
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
        <div class="col-xs-12 mb-5">

        </div>
        <br>
        <br>
        <div class="col-xs-12" style="margin-top: 30px">
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container"></div>
                    </div>
                </div>
            </div>
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="planNamesWithCount"></div>
                    </div>
                </div>
            </div>
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container2"></div>
                    </div>
                </div>
            </div>

            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container3"></div>
                    </div>
                </div>
            </div>
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container4"></div>
                    </div>
                </div>
            </div>
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container5"></div>
                    </div>
                </div>
            </div>
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container51"></div>
                    </div>
                </div>
            </div>
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container52"></div>
                    </div>
                </div>
            </div>
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container53"></div>
                    </div>
                </div>
            </div>
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container55"></div>
                    </div>
                </div>
            </div>
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container54"></div>
                    </div>
                </div>
            </div>

            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">
                        <div id="container7"></div>
                    </div>
                </div>
            </div>
            <div class="store-setup-row">
                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                    <div class="box-content bordered primary ">

                        <h2> افضل المتاجر حسب عدد المنتجات المباعة</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <td>اليوم</td>
                                <td>امس</td>
                                <td>اسبوع</td>
                                <td>شهر</td>
                                <td>ثلاث اشهر</td>
                                <td>منذ البداية</td>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <td>اليوم</td>
                                <td>امس</td>
                                <td>اسبوع</td>
                                <td>شهر</td>
                                <td>ثلاث اشهر</td>
                                <td>منذ البداية</td>
                            </tr>
                            </tfoot>
                            <tbody>
                            <tr>
                                @if($stores_order_by_products['today'] != [])
                                    <td>
                                        @foreach($stores_order_by_products['today']  as $item)
                                            {{$item['name']}} : {{$item['countProduct']}}<br><br><br>
                                        @endforeach
                                    </td>
                                @else
                                    <td>لا يوجد بيانات</td>
                                @endif
                                @if($stores_order_by_products['yesterday'] != [])
                                    <td>
                                        @foreach($stores_order_by_products['yesterday']  as $item)
                                            {{$item['name']}} : {{$item['countProduct']}}<br><br><br>

                                        @endforeach
                                    </td>
                                @else
                                    <td>لا يوجد بيانات</td>
                                @endif
                                @if($stores_order_by_products['week'] != [])
                                    <td>
                                        @foreach($stores_order_by_products['week']  as $item)
                                            {{$item['name']}} : {{$item['countProduct']}}<br><br><br>

                                        @endforeach
                                    </td>
                                @else
                                    <td>لا يوجد بيانات</td>
                                @endif
                                @if($stores_order_by_products['month'] != [])
                                    <td>
                                        @foreach($stores_order_by_products['month']  as $item)
                                            {{$item['name']}} : {{$item['countProduct']}} <br><br><br>

                                        @endforeach
                                    </td>
                                @else
                                    <td>لا يوجد بيانات</td>
                                @endif
                                @if($stores_order_by_products['threeMonth'] != [])
                                    <td>
                                        @foreach($stores_order_by_products['threeMonth']  as $item)
                                            {{$item['name']}} : {{$item['countProduct']}}<br><br><br>


                                        @endforeach
                                    </td>
                                @else
                                    <td>لا يوجد بيانات</td>
                                @endif
                                @if($stores_order_by_products['all'] != [])
                                    <td>
                                        @foreach($stores_order_by_products['all']  as $item)
                                            {{$item['name']}} : {{$item['countProduct']}}<br><br><br>

                                        @endforeach
                                    </td>
                                @else
                                    <td>لا يوجد بيانات</td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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

        const planNamesWithCount = Highcharts.chart('planNamesWithCount', {
            title: {
                text: 'المتاجر المشتركة في الباقات المدفوعة'
            },
            xAxis: {
                categories: [
                    @foreach($planNamesWithCount as $index=>$item)
                    '{{$index}}',
                    @endforeach
                ]
            },
            series: [{
                type: 'column',
                colorByPoint: true,
                data: [
                    @foreach($planNamesWithCount as $index=>$item)
                        {{$item}},
                    @endforeach
                ],
                showInLegend: false
            }]
        });
        const chart = Highcharts.chart('container', {
            title: {
                text: 'المتاجر التي تم انشاؤها'
            },
            xAxis: {
                categories: [
                    'منذ البداية',
                    'ثلاث شهور',
                    'هذا الشهر',
                    'هذا الاسبوع',
                    'امس',
                    'اليوم',
                ]
            },
            series: [{
                type: 'column',
                colorByPoint: true,
                data: [
                    {{$stores['all']}},
                    {{$stores['threeMonth']}},
                    {{$stores['month']}},
                    {{$stores['week']}},
                    {{$stores['yesterday']}},
                    {{$stores['today']}},
                ],
                showInLegend: false
            }]
        });
        const chart2 = Highcharts.chart('container2', {
            title: {
                text: 'اجمالي طلبات المتاجر'
            },
            xAxis: {
                categories: [
                    'منذ البداية',
                    'ثلاث شهور',
                    'هذا الشهر',
                    'هذا الاسبوع',
                    'امس',
                    'اليوم',
                ]
            },
            series: [{
                type: 'column',
                colorByPoint: true,
                data: [
                    {{$orders['all']}},
                    {{$orders['threeMonth']}},
                    {{$orders['month']}},
                    {{$orders['week']}},
                    {{$orders['yesterday']}},
                    {{$orders['today']}},
                ],
                showInLegend: false
            }]
        });
        const chart3 = Highcharts.chart('container3', {
            title: {
                text: 'اجمالي مبيعات المتاجر من الطلبات'
            },
            xAxis: {
                categories: [
                    'منذ البداية',
                    'ثلاث شهور',
                    'هذا الشهر',
                    'هذا الاسبوع',
                    'امس',
                    'اليوم',
                ]
            },
            series: [{
                type: 'column',
                colorByPoint: true,
                data: [
                    {{$profit['all']}},
                    {{$profit['threeMonth']}},
                    {{$profit['month']}},
                    {{$profit['week']}},
                    {{$profit['yesterday']}},
                    {{$profit['today']}},
                ],
                showInLegend: false
            }]
        });
        const chart4 = Highcharts.chart('container4', {
            title: {
                text: 'اجمالي زوار الموقع'
            },
            xAxis: {
                categories: [
                    'منذ البداية',
                    'ثلاث شهور',
                    'هذا الشهر',
                    'هذا الاسبوع',
                    'امس',
                    'اليوم',
                ]
            },
            series: [{
                type: 'column',
                colorByPoint: true,
                data: [
                    {{$visitors['all']}},
                    {{$visitors['threeMonth']}},
                    {{$visitors['month']}},
                    {{$visitors['week']}},
                    {{$visitors['yesterday']}},
                    {{$visitors['today']}},
                ],
                showInLegend: false
            }]
        });
        Highcharts.chart('container5', {

            chart: {
                styledMode: true
            },

            title: {
                text: 'افضل المنتجات   في كل الوقت'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },

            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                        @foreach($most_wanted['all'] as $item)
                    ['{{$item['name']}}', {{$item['y']}}, false],
                    @endforeach
                ],
                showInLegend: true
            }]
        });
        Highcharts.chart('container51', {

            chart: {
                styledMode: true
            },

            title: {
                text: 'افضل المنتجات   اليوم'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },

            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                        @foreach($most_wanted['today'] as $item)
                    ['{{$item['name']}}', {{$item['y']}}, false],
                    @endforeach
                ],
                showInLegend: true
            }]
        });
        Highcharts.chart('container52', {

            chart: {
                styledMode: true
            },

            title: {
                text: 'افضل المنتجات امس'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },

            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                        @foreach($most_wanted['yesterday'] as $item)
                    ['{{$item['name']}}', {{$item['y']}}, false],
                    @endforeach
                ],
                showInLegend: true
            }]
        });
        Highcharts.chart('container53', {

            chart: {
                styledMode: true
            },

            title: {
                text: 'افضل المنتجات  هذا الاسبوع'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },

            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                        @foreach($most_wanted['week'] as $item)
                    ['{{$item['name']}}', {{$item['y']}}, false],
                    @endforeach
                ],
                showInLegend: true
            }]
        });
        Highcharts.chart('container54', {

            chart: {
                styledMode: true
            },

            title: {
                text: 'افضل المنتجات   في هذا الشهر'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },

            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                        @foreach($most_wanted['month'] as $item)
                    ['{{$item['name']}}', {{$item['y']}}, false],
                    @endforeach
                ],
                showInLegend: true
            }]
        });
        Highcharts.chart('container55', {

            chart: {
                styledMode: true
            },

            title: {
                text: 'افضل المنتجات   في ثلاث اشهر'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },

            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                        @foreach($most_wanted['threeMonth'] as $item)
                    ['{{$item['name']}}', {{$item['y']}}, false],
                    @endforeach
                ],
                showInLegend: true
            }]
        });

        const chart7 = Highcharts.chart('container7', {
            title: {
                text: 'متوسط مبلغ طلبات المتاجر'
            },
            xAxis: {
                categories: [
                    'منذ البداية',
                    'ثلاث شهور',
                    'هذا الشهر',
                    'هذا الاسبوع',
                    'امس',
                    'اليوم',
                ]
            },
            series: [{
                type: 'column',
                colorByPoint: true,
                data: [
                    {{$stores_average_sale['all']}},
                    {{$stores_average_sale['threeMonth']}},
                    {{$stores_average_sale['month']}},
                    {{$stores_average_sale['week']}},
                    {{$stores_average_sale['yesterday']}},
                    {{$stores_average_sale['today']}},
                ],
                showInLegend: false
            }]
        });

    </script>
@endsection
