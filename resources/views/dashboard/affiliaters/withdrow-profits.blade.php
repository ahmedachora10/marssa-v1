@extends('dashboard.master')
@section('affiliatees_show')
    current active
@endsection


@section('content')
<style>
    .hidden-item-status{
        display:none !important;
    }
</style>
    <div class="row">
        <div class="container mt-5">

            @if(!empty(session('message')))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{  session('message') }}</li>
                        </ul>
                    </div>
            @endif
            <div class="col-xs-12">
                <div class="box-content bordered primary ">
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('master.affiliater') }}</th>
                            <th>{{ __('master.withdraw_value') }}</th>
                            <th>{{ __('master.status') }}</th>
                            <th>{{ __('master.change_status') }}</th>
                            <th>{{ __('master.date') }}</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                            @if($withdraw_orders)
                                @forelse($withdraw_orders as $order)
                                    <tr class="text-center">
                                        <td>{{ $order->id }}</td>
                                        <td class="">
                                           {{ $order->Withdrawable->affiliaters->name  }}
                                        </td>
                                        
                                        <td class="">
                                           {{ $order->withdraw_value ?? 0  }}
                                        </td>
                                        <td class="">
                                           {!! $order->status_order  !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-sm "   href="{{ url("dashboard/admin/withdraw-affiliate-order/".$order->id)}}" >{{ __('master.order_details') }} </a>
                                            <!--<a class="btn btn-info btn-sm   {{ ($order->status == 0 ? 'hidden-item-status':'') }}"   href="{{ url("dashboard/admin/change-withdraw-affiliate-order-status/".$order->id."/0")}}" >{{ __('master.pending') }} </a>-->
                                            <!--<a class="btn btn-success btn-sm {{ ($order->status == 1 ? 'hidden-item-status':'') }}"  href="{{ url("dashboard/admin/change-withdraw-affiliate-order-status/".$order->id."/1")}}"> {{ __('master.pay') }} </a>-->
                                            <!--<a class="btn btn-danger btn-sm  {{ ($order->status == 2 ? 'hidden-item-status':'') }}"  href="{{ url("dashboard/admin/change-withdraw-affiliate-order-status/".$order->id."/2")}}"> {{ __('master.refuse') }} </a>-->
                                                
                                        </td>
                                        <td class="">
                                           {{ $order->created_at }}
                                        </td>
                                        
                                    </tr>
                                @empty
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

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
