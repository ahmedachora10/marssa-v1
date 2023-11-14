@extends('dashboard.master')

@section('participants_index')
    current active
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box-content bordered primary ">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('master.store_name') }}</th>
                        <th>{{ __('master.store_plan') }}</th>
                        <th>{{ __('master.status') }}</th>
                        <th>{{ __('master.customdomain') }}</th>
                        <th>{{ __('master.date_created') }}</th>
                        @role('SuperAdmin')
                        <th>{{ __('master.change_request_status')}}</th>
                        @endrole
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                        <tr class="text-center">
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->store()->first()->name ?? '' }}</td>
                            <td>
                               
                             
                                @php
                                
                                 $get_store_plan = App\Plan::where( 'id',1  )->get()->first();
                                 $n = 'name_'.app()->getLocale();
                                 echo  $get_store_plan->$n;
                                
                                @endphp
                             </td>
                            <td>
                                @if($request->status ?? false)
                                    <span class="notice notice-green">{{ __('master.Verified') }}</span>
                                @else
                                    <span class="notice notice-danger">{{ __('master.AwaitingVerification') }}</span>
                                @endif
                            </td>
                            <td>{{ $request->custom }}</td>
                            <td>{{ Carbon\Carbon::parse($request->created_at)->toFormattedDateString()}}</td>
                            @role('SuperAdmin')
                            <td><a class="btn btn-primary btn-block" href="{{ route('dashboard.admin.domains.change_requests',['id'=>$request->id]) }}"><span><i class="fas fa-check"></i></span></a></td>
                            @endrole
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
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
