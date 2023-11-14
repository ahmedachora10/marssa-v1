@extends('dashboard.master')

@section('participants_index')
    current active
@endsection

@section('content')
    @role('SuperAdmin')
    <a href="{{route('dashboard.admin.wallet-recharge')}}" class="btn btn-success d-inline" style="display: inline-block ;margin-bottom: 20px">
        {{__("master.manual_recharge")}}
    </a>
    @endrole
    @if($title_page == 'wallet_stores')
        <div class="row">
            <div class="col-xs-12">
                <div class="box-content bordered primary ">
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('master.by') }}</th>
                            <th>{{ __('master.payment_method') }}</th>
                            <th>{{ __('master.invoice_status') }}</th>
                            @role('SuperAdmin')
                            <th>{{ __('master.store_name') }}</th>
                            @endrole
                            <th>{{ __('master.total_price') }}</th>
                            <th>{{ __('master.WayCharge') }}</th>

                            @role('SuperAdmin')
                            <th>{{ __('master.more_details')}}</th>
                            @endrole

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wallet_stores as $wallet_store)
                            <tr class="text-center">
                                <td>{{ $wallet_store->id }}</td>
                                <td>{{ $wallet_store->merchant ? $wallet_store->merchant->name : '' }}</td>
                                <td>{{ $wallet_store->type_operation == 0 ? __('master.charge_account') : __('master.withdraw_from_account') }}</td>
                                <td>
                                    @if($wallet_store->status == 1)
                                        <span class="notice notice-green">{{ __('master.Verified') }}</span>
                                    @elseif($wallet_store->status == 0)
                                        <span class="notice notice-danger">{{ __('master.AwaitingVerification') }}</span>
                                    @else
                                        <span class="badge badge-warning">
                                        @if(app()->getLocale() == 'ar')
                                                تم الرفض
                                            @else
                                                Verification Refused
                                            @endif
                                    </span>
                                    @endif
                                </td>
                                @role('SuperAdmin')
                                <td>{{ $wallet_store->store->name ?? '' }}</td>
                                @endrole
                                <td>{{ $wallet_store->amount . env('currency_symbol') ?? '' }}</td>
                                <td><span class="notice notice-purple">{{ $wallet_store->type_method  }}</span></td>
                                @role('SuperAdmin')
                                <td><a class="btn btn-primary btn-block"
                                       href="{{ route('dashboard.admin.wallet-charge-order-edit',['id'=>$wallet_store->id]) }}"><span><i
                                                    class="fas fa-info-circle"></i></span></a></td>
                                @endrole
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
          var t =   $('.table').DataTable({
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
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
