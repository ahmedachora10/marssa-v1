@extends('dashboard.master')

@section('store_settings')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/RWD-table-pattern/css/rwd-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal-default-theme.css') }}">
    <style>
        .box-content .dropdown.js__drop_down {
            top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="row small-spacing">
        <div class="col-xs-12">
            @if (count($errors) > 0)
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
        </div>
        <div class="col-xs-12">
            <div class="box-content">
                <h4 class="box-title">{{__('master.view')}} {{ __('master.'.$title_page) }}</h4>
                <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                        <thead>
                        <tr>
                            <th data-priority="1">ID</th>
                            <th data-priority="2">الإحصائية باللغة العربية</th>
                            <th data-priority="2">الإحصائية باللغة الانجليزية</th>
                            <th data-priority="3">{{ __('master.value') }}</th>
                            <th data-priority="3">{{ __('master.numerical_ar') }}</th>
                            <th data-priority="3">{{ __('master.numerical_en') }}</th>
                            <th data-priority="4">{{ __('master.icon') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($counters as $counter)
                            <tr onclick="
                                    $('#input_update_item').val('{{$counter->id}}');
                                    $('#ig-1').val('{{$counter->title_ar}}');
                                    $('#ig-2').val('{{$counter->title_en}}');
                                    $('#ig-3').val('{{$counter->count}}');
                                    $('#ig-4').val('{{$counter->numerical_ar}}');
                                    $('#ig-5').val('{{$counter->numerical_en}}');
                                    $('#ig-6').val('{{$counter->icon}}');
                                    " type="button"
                                data-remodal-target="modal_update">
                                <th>{{$loop->iteration}}</th>
                                <td>{{ $counter->title_ar }}</td>
                                <td>{{ $counter->title_en }}</td>
                                <td>{{ $counter->count }}</td>
                                <td>{{ $counter->numerical_ar }}</td>
                                <td>{{ $counter->numerical_en }}</td>
                                <td>{{ $counter->icon }}</td>
                            </tr>
                        @empty
                            <th colspan="8" style="text-align: center">{{ __('master.no_data') }}</th>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="remodal" data-remodal-id="modal_update" role="dialog" aria-labelledby="modal1Title"
         aria-describedby="modal1Desc">
        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
        <div class="remodal-content">
            <h2 id="modal1Title" style="margin-bottom:20px">{{ __('master.update_item') }}</h2>
            <div class="card-content">
                <form action="" method="post" id="form_update_item">
                    @csrf
                    <input type="hidden" name="id" id="input_update_item" value="">
                    <div class=" col-xs-12">
                        <div class="form-group row">
                            <div class="col-xs-3">
                                <label for="ig-1" class="control-label">الإحصائية باللغة العربية</label>
                            </div>
                            <div class="col-xs-9">
                                <input id="ig-1" type="text" name="title_ar" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3">
                                <label for="ig-2" class="control-label">الإحصائية باللغة الانجليزية</label>
                            </div>
                            <div class="col-xs-9">
                                <input id="ig-2" type="text" name="title_en" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3">
                                <label for="ig-3" class="control-label">{{ __('master.value') }}</label>
                            </div>
                            <div class="col-xs-9">
                                <input id="ig-3" type="text" name="count" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3">
                                <label for="ig-4" class="control-label">{{ __('master.numerical_ar') }}</label>
                            </div>
                            <div class="col-xs-9">
                                <input id="ig-4" type="text" name="numerical_ar" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3">
                                <label for="ig-5" class="control-label">{{ __('master.numerical_en') }}</label>
                            </div>
                            <div class="col-xs-9">
                                <input id="ig-5" type="text" name="numerical_en" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3">
                                <label for="ig-6" class="control-label">{{ __('master.icon') }}</label>
                            </div>
                            <div class="col-xs-9">
                                <input id="ig-6" type="text" name="icon" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <button data-remodal-action="cancel" class="remodal-cancel">{{ __('master.cancel') }}</button>
        <button data-remodal-action="confirm" class="remodal-confirm"
                id="confirm_update_item">{{ __('master.update_item') }}</button>
    </div>
@endsection


@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.min.js') }}"></script>
    <script>
        $('#confirm_update_item').on('click', function () {
            $.ajax({
                type: 'POST',
                url: '{{ route("dashboard.admin.counters.store") }}',
                data: $('#form_update_item').serialize(),
                success: function (data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        customClass: 'swal-wide',
                        timer: 3000
                    });
                    if (data.status) {
                        Toast.fire({
                            type: 'success',
                            title: '{{ __('master.Successfully') }}'
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: '{{ __('master.Fail') }}'
                        })
                    }
                }
            });
        })
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}