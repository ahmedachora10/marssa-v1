@extends('dashboard.master')

@section('participants_index')
    current active
@endsection

@section('head_tag')

    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.css') }}">
    <!-- FlexDatalist -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/flexdatalist/jquery.flexdatalist.min.css') }}">

    <!-- Popover -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/popover/jquery.popSelect.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/select2/css/select2.min.css') }}">

    <!-- Timepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.css') }}">

    <!-- Touch Spin -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/touchspin/jquery.bootstrap-touchspin.min.css') }}">

    <!-- Colorpicker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/colorpicker/css/bootstrap-colorpicker.min.css') }}">

    <!-- Datepicker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/datepicker/css/bootstrap-datepicker.min.css') }}">

    <!-- DateRangepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
    @role('SuperAdmin')
    <div class="col-xs-12">
        <div class="box-content card white">
            <h4 class="box-title">
                @if($title_page !== 'subscription_edit')
                    {{ __('master.add_new') }}
                @else
                    {{ __('master.update_item') }}
                @endif
            </h4>
            <div class="card-content">
                <form method="POST" action="{{ $route }}" autocomplete="off">
                    @csrf
                    <div class="col-xs-12">

                        <input type="hidden" value="{{ $subscribe->id ?? ''}}" name="id">

                        @if($title_page !== 'subscription_edit')
                            <div class="form-group @error('store') has-error @enderror col-xs-12 col-md-4">
                                <label for="input-states-5">{{ __('master.store_name') }}</label>
                                <select name="store" class="form-control" id="input-states-5">
                                    <option disabled selected> {{ __('master.store_name') }} </option>
                                    @foreach($stores as $store)
                                        <option value="{{$store->id}}"
                                                @if($title_page === 'subscription_edit')
                                                @if($subscribe->store_id == $store->id) selected @endif
                                                @endif>
                                            {{ '#' . $store->id . ' ' . $store->name  }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('store')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @else
                            <div class="form-group col-xs-12 col-md-4">
                                <label class="control-label"
                                       for="store">{{ __('master.store_name') }}</label>
                                <input type="text" class="form-control"
                                       id="store" name="store" disabled
                                       value="{{ $subscribe->store()->first()->name ?? __('store.full_name_error')}}">
                            </div>
                        @endif

                        <div class="form-group @error('plan') has-error @enderror col-xs-12 col-md-4">
                            <label for="input-states-5">{{ __('master.plan') }}</label>
                            <select name="plan" class="form-control" id="input-states-5">
                                <option disabled selected> {{ __('master.plan') }} </option>
                                @foreach($plans as $plan)
                                    <option value="{{ $plan->id }}"
                                            @if($title_page === 'subscription_edit')
                                            @if($subscribe->plan_id == $plan->id) selected @endif
                                            @endif>
                                        {{ $plan['name_'.app()->getLocale()] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('plan')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="form-group  @error('deadline') has-error @enderror col-xs-12 col-md-4">
                            <label class="control-label"
                                   for="deadline">{{ __('master.deadline_date') }}</label>
                            <input type="text" class="form-control datepicker-autoclose"
                                   placeholder="mm/dd/yyyy"
                                   id="deadline" name="deadline"
                                   value="{{ $title_page == 'subscription_edit' ? $subscribe->FormatDeadline() : old('deadline')}}">
                            @error('deadline')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>


                        <div class="form-group col-xs-12 col-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                @if($title_page !== 'subscription_edit')
                                    {{ __('master.add_new') }}
                                @else
                                    {{ __('master.update_item') }}
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endrole
    @if($title_page !== 'subscription_edit')
        <div class="row">
            <div class="col-xs-12">
                <div class="box-content bordered primary ">
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('master.by') }}</th>
                            <th>{{ __('master.store_name') }}</th>
                            <th>{{ __('master.store_plan') }}</th>
                            <th>{{ __('master.store_status') }}</th>
                            <th>{{ __('master.deadline_date') }}</th>
                            <th>{{ __('master.subscription_edit') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscribes as $subscribe)
                            <tr class="text-center">
                                <td>{{  $subscribe->id  }}</td>
                                <td>{{ $subscribe->pay }}</td>
                                <td><span class="notice notice-blue">{{ $subscribe->store()->first()->name ?? '' }}</span></td>
                                <td><span class="notice notice-purple">{{ $subscribe->plan['name_'.app()->getLocale()] ?? '' }}</span></td>
                                <td>
                                    @if($subscribe->store()->first()->status ?? false)
                                        <span class="notice notice-green">{{ __('master.Active') }}</span>
                                    @else
                                        <span class="notice notice-danger">{{ __('master.Inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span>{{ Carbon\Carbon::parse($subscribe->deadline)->toFormattedDateString() }}</span>
                                </td>
                                <td><a class="btn btn-success btn-block" target="_blank"
                                       href="{{ route('dashboard.admin.subscriptions.edit',['id'=>$subscribe->id]) }}">
                                        <span><i class="fas fa-bullhorn"></i></span>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/moment/moment.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/form.demo.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.5/js/dataTables.autoFill.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.5/js/autoFill.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'تصدير الي أكسيل',
                        exportOptions: {
                            columns: [ 0,2,3,4,5 ]
                        }
                    },{
                        extend: 'colvis',
                        text: 'العواميد الظاهرة'
                    }
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'تفاصيل';
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                },
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": "{{(app()->getLocale() == 'ar') ? '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json' : '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json'}}"
                }
            });
        } );
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
