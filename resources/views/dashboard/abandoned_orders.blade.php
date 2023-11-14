@extends('dashboard.master')


@section('orders_index')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/RWD-table-pattern/css/rwd-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal-default-theme.css') }}">
    <style>
        .tbl_td{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
        <div class="row">
            <div class="col-xs-12">
                <div class="box-content bordered primary table-responsive">
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('master.name') }}</th>
                                <th>{{ __('master.mobile') }}</th>
                                <th>{{ __('master.address') }}</th>
                                <th>{{ __('master.Cart_Link') }}</th>
                                <th>{{ __('master.more_details') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $index => $order)
                            <tr>
                                <td> {{ $order->id }} </td>
                                <td> {{ $order->name }} </td>
                                <td> {{ $order->mobile }} </td>
                                <td> {{ $order->address }} </td>
                                <td> <label id="copy{{ $order->id }}">{{ route('regenerate_cart_items',['order' => $order->id]) }}</label> <br/>
                                  <button class="btn btn-primary btn-xs" onclick="copy({{$order->id}})"><i class="fas fa-copy"></i>{{-- __('master.copy') --}}</button>
                                </td>
                                <td> 
                                <div style="display: inline-flex;justify-content: space-between;width: 100%;">
                                    <a class="btn btn-info btn-xs" href="{{ route('dashboard.admin.orders.abandoned_order_show',['order' => $order->id]) }}"><i class="fas fa-list"></i>{{-- __('master.details') --}}</a>
                                    <a class="btn btn-success btn-xs" href="https://wa.me/{{ $order->mobile }}" target="_blank"><i class="fab fa-whatsapp"></i>{{-- __('master.send_message_on_whatsapp') --}}</a>
                                    <form method="post" action="{{route('dashboard.admin.orders.abandoned_orders.delete',$order)}}" >
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i>  </button>
                                    </form></div>
                                </td>
                            </tr>
                       
                        @endforeach
                        </tbody>
                    </table>
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
                "order": [[0, "asc"]],
                "language": {
                    "url": "{{(app()->getLocale() == 'ar') ? '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json' : '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json'}}"
                }
            });
        });
        
        // jQuery(document).ready(function(){
             
        // });
        
        function copy(id){
            let item = document.getElementById('copy'+id).innerText;
            navigator.clipboard.writeText(item);
        }
    </script>
    
@endsection
{{--Developed Saed Z. Sinwar--}}
