@extends('dashboard.master')


@section('Reviews_index')
    current active
@endsection

@section('content')
    @role('User|SubUser')
    <div class="col-xs-12 margin-bottom-20">
        <a href="{{ route('dashboard.admin.Reviews.add') }}"
           class="btn btn-primary btn-rounded waves-effect waves-light">
            <i class="ico ico-left fa fa-plus"></i>
            {{ __('master.add_new') }}
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
                        <th>{{__('master.store_name')}}</th>
                        <th>{{ __('master.product_name') }}</th>
                        <th>{{ __('master.rate') }}</th>
                        <th>{{ __('master.status') }}</th>
                        @role('User|SubUser')
                        <th>{{ __('master.edit')}}</th>
                        <th>{{ __('master.delete')}}</th>
                        @endrole
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($Reviews as $review)
                        <tr class="text-center">
                            <td>{{ $review->id }}</td>
                            <td><a target="_blank"
                                   href="{{route('store.index',['sub_domain'=> $review->store->domain])}}">{{ $review->store->name }}</a>
                            </td>
                            <td><a target="_blank"
                                   href="{{ route('store.product_details_ads',['sub_domain'=> $review->store->domain,'id'=>$review->product->id ?? 1]) }}">{{ $review->product['name_'.app()->getLocale()] ?? '-' }}</a>
                            </td>
                            <td>{{ $review->rate }} / 5</td>
                            <td>
                                @if($review->status == 1)
                                    <span class="notice notice-green">{{ __('master.Active') }}</span>
                                @else
                                    <span class="notice notice-danger">{{ __('master.Inactive') }}</span>
                                @endif
                            </td>
                            @role('User|SubUser')
                            <td><a class="btn btn-primary btn-block"
                                   href="{{ route('dashboard.admin.Reviews.edit',['productReview'=>$review->id]) }}"><span><i
                                                class="fas fa-edit"></i></span></a></td>
                            <td><a class="btn btn-danger btn-block"
                                   href="{{ route('dashboard.admin.Reviews.delete',['productReview'=>$review->id]) }}">
                                    <span><i class="fas fa-trash-alt"></i></span>
                                </a></td>
                            @endrole
                        </tr>
                    @empty
                       <p> لا يوجد تقيمات </p>
                    @endforelse
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
