@extends('dashboard.master')

@section('activities')
    current
@endsection

@section('visitors')
    current
@endsection

@section('head_tag')
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/datatables/extensions/Buttons/css/buttons.dataTables.min.css') }}">
@endsection

@section('content')
    <div class="row small-spacing">
        <div class="col-xs-12">
            <div class="box-content">
                <h4 class="box-title">{{__('master.view')}} {{ __('master.'.$title_page) }}</h4>
                <table id="example" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>IP</th>
                        <th>{{__('master.url')}}</th>
                        <th>{{__('master.device')}}</th>
                        <th>{{__('master.platform')}}</th>
                        <th>{{__('master.platform_version')}}</th>
                        <th>{{__('master.browser')}}</th>
                        <th>{{__('master.browser_version')}}</th>
                        <th>{{__('master.countryName')}}</th>
                        <th>{{__('master.countryCode')}}</th>
                        <th>{{__('master.cityName')}}</th>
                        <th>{{__('master.regionName')}}</th>
                        <th>{{__('master.date')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($visitors as $visitor)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $visitor->ipAddress }}</td>
                            <td>{{ $visitor->url }}</td>
                            <td>{{ $visitor->device }}</td>
                            <td>{{ $visitor->platform }}</td>
                            <td>{{ $visitor->platform_version }}</td>
                            <td>{{ $visitor->browser }}</td>
                            <td>{{ $visitor->browser_version }}</td>
                            <td>{{ $visitor->countryName }}</td>
                            <td>{{ $visitor->countryCode }}</td>
                            <td>{{ $visitor->cityName }}</td>
                            <td>{{ $visitor->regionName }}</td>
                            <td style="direction: ltr;text-align: right;">
                                {{ date('Y-m-d H:i', strtotime($visitor->created_at)) }}
                            </td>
                        </tr>
                    @empty
                        <th colspan="14" style="text-align: center">{{ __('master.no_data') }}</th>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/datatables/media/js/jquery-2.1.3.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/datatables/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/datatables/media/js/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/datatables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>

    @role('SuperAdmin|Admin|User')
    <script>
        $(window).load(function () {
            $('#example').dataTable({
                dom: 'Bfrtip',
                searching: true,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Excel - {{$title_page}}',
                        text: 'Excel',
                    }
                ]
            });
        });
    </script>
    @endrole
    @role('SubUser')
    <script>
        $(window).load(function () {
            $('#example').dataTable({
                dom: 'Bfrtip',
                searching: false,
            });
        });
    </script>
    @endrole

@endsection
{{--Developed Saed Z. Sinwar--}}