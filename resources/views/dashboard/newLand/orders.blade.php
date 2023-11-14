@extends('dashboard.master')


@section('orders_index')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/RWD-table-pattern/css/rwd-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal-default-theme.css') }}">
@endsection

@section('content')
    <div class="row small-spacing">
        <div class="col-xs-12">
            <div class="box-content bordered primary ">
                <div class="table-responsive">
                    
                <table class="table table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('master.order_id')}}</th>
                        <th>{{__('master.offer')}}</th>
                        <th>{{ __('master.amount') }}</th>
                        <th>{{ __('master.name') }}</th>
                        <th>{{ __('master.mobile') }} </th>
                        <th>{{ __('master.address') }} </th>
                        <!--th>{{ __('master.offer_price') }} 4</th>
                        <th>{{ __('master.offer_price') }} 5</th-->
                        <th>{{ __('master.status') }}</th>
                        @role('User|SubUser')
                        <th>{{ __('master.copy_link')}}</th>
                        <th>{{ __('master.view')}}</th>
                        @endrole
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $index=>$order)
                    <tr class="text-center" style="background-color: @if($order->viewed==1) #e7e7e7 @else #fff; @endif">
                        <td>{{ $index + 1}} </td>
                        <td>{{ $order->order_id }}</td>
                            
                            <td>{{ $order->product['name_'.app()->getLocale()] }}</td>
                            <td>{{ $order->amount }} {{$order->currency}}</td>
                            
                            <td>{{ $order->name}}</td>
                            <td>{{ $order->mobile}}</td>
                            <td>{{ $order->address }}</td>
                            <!--td>{{ ($offer->price3) ?? '0' }} {{ $store->getCurrency() }}</td>
                            <td>{{ ($offer->price4) ?? '0' }} {{ $store->getCurrency() }}</td-->
                            <td>
                                @if($order->status=='pend')
                               {{__('master.Pending')}}
                               @elseif($order->status=='accept')
                               {{__('master.Accept')}}
                               @elseif($order->status=='accept')
                               {{__('master.Accept')}}
                               @elseif($order->status=='process')
                               {{__('master.Process')}}
                               @elseif($order->status=='deliverypayment')
                               {{__('master.DeliveryPayment')}}
                               @elseif($order->status=='cancel')
                               {{__('master.Cancel')}}
                               @endif
                            </td>
                            @role('User|SubUser')
                            <td>
                            <button class="btn btn-success btn-sm copy-plyr-link"   data-clipboard-target="#plink_{{$index}}"
                             data-url="{{'https://'.$store->domain.'.marssa.shop/orders/thank_you/'.$order->order_id}}">
                                    <span><i class="fas fa-copy"></i></span>
                                </button></td>
                            <td><a class="btn btn-primary btn-sm" href="{{ route('dashboard.admin.landing_pages.orders.show',$order->id) }}">
                                    <span><i class="fas fa-eye"></i></span>
                                </a></td>
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
    
function copyToClipboard(text) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
}        
$(document).on('click', '.copy-plyr-link', function () {
    var $this = $(this);
    $this.attr('data-original-title',"{{__('master.copied')}}");
    var url = $(this).attr('data-url');
    copyToClipboard(url);
    $this.tooltip('show');

    setTimeout(function() { 
        var t = "{{__('master.copy_link')}}";
        $this.attr('data-original-title',t);
    }, 1500);

});
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
{{--Developed By Moayad Hassan--}}