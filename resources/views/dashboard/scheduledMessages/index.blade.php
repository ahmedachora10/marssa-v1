@extends('dashboard.master')


@section('Reviews_index')
    current active
@endsection

@section('content')
    {{--    @dd($category)--}}
    <div>
        @role('SuperAdmin')
        <div class="col-xs-12 margin-bottom-20">
            <a href="{{ route('dashboard.admin.store_settings.scheduled_messages.create') }}"
               class="btn btn-primary btn-rounded waves-effect waves-light">
                <i class="ico ico-left fa fa-plus"></i>
                {{ __('master.add_new') }}
            </a>
            <a href="{{route('dashboard.admin.reportsStores')}}"
               class="btn btn-primary btn-rounded waves-effect waves-light">
                <i class="fas fa-store"></i>
                {{ __('master.stores') }}
            </a>
        </div>
        @endrole
        <div class="row">
            <div class="col-xs-12">
                <div class="box-content bordered primary ">
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('master.after_second')}}</th>
                            <th>{{__('master.after_minute')}}</th>
                            <th>{{__('master.after_hour')}}</th>
                            <th>{{__('master.after_day')}}</th>
                            <th>{{ __('master.message') }}</th>
                            <th>{{ __('master.date_created') }}</th>
                            @role('SuperAdmin')
                            <th>{{ __('master.edit')}}</th>
                            <th>{{ __('master.delete')}}</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $index=>$item)
                            <tr class="text-center">
                                <td>{{ $index }}</td>
                                <td>{{ data_get(json_decode($item->value),'second') }} </td>
                                <td>{{ data_get(json_decode($item->value),'minute') }} </td>
                                <td>{{ data_get(json_decode($item->value),'hour') }} </td>
                                <td>{{ data_get(json_decode($item->value),'day') }} </td>
                                <td>{{ data_get(json_decode($item->value),'message') }} </td>
                                <td>{{ $item->created_at }}</td>
                                @role('SuperAdmin')
                                <td><a class="btn btn-primary btn-block"
                                       href="{{ route('dashboard.admin.store_settings.scheduled_messages.edit',$item->id) }}"><span><i
                                                    class="fas fa-edit"></i></span></a></td>
                                <td>
                                    <form action="{{route('dashboard.admin.store_settings.scheduled_messages.destroy',$item->id)}}"
                                          method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger btn-block">
                                            <span><i class="fas fa-trash-alt"></i></span>
                                        </button>
                                    </form>
                                </td>
                                @endrole
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
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
    <script type="text/javascript"
            src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'تصدير الي أكسيل',
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5]
                        }
                    }, {
                        extend: 'colvis',
                        text: 'العواميد الظاهرة'
                    }
                ],
                "bPaginate": false,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'تفاصيل';
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
                "order": [[0, "desc"]],
                "language": {
                    "url": "{{(app()->getLocale() == 'ar') ? '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json' : '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json'}}"
                }
            });
        });

        function toggleUserSelect() {
            var checkBoxes = $("input[type=checkbox]");
            checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        }
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
