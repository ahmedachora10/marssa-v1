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
                        <div id="container2"></div>
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


        const chart = Highcharts.chart('container', {
            title: {
                text: 'متواسط تجديد التجار'
            },
            xAxis: {
                categories: [
                    'منذ البداية',
                    'نصف سنة',
                    'ثلاث شهور',
                    'هذا الشهر',
                ]
            },
            series: [{
                type: 'column',
                colorByPoint: true,
                data: [
                    {{$renewStore['all']}},
                    {{$renewStore['sixMonth']}},
                    {{$renewStore['threeMonth']}},
                    {{$renewStore['month']}},
                ],
                showInLegend: false
            }]
        });
        const chart2 = Highcharts.chart('container2', {
            title: {
                text: 'معدل نمو المنصة'
            },
            xAxis: {
                categories: [
                    'سنة',
                    'ست شهور',
                    'ثلاث شهور',
                    'هذا الشهر',

                ]
            },
            series: [{
                type: 'column',
                colorByPoint: true,
                data: [
                    {{$averagePlatformGrowth['year']}},
                    {{$averagePlatformGrowth['sixMonth']}},
                    {{$averagePlatformGrowth['threeMonth']}},
                    {{$averagePlatformGrowth['month']}},
                ],
                showInLegend: true
            }]
        });


    </script>
@endsection
