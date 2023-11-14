@extends('dashboard.master')


@section('promo_codes_index')
    current active
@endsection

@section('content')
    @role('User|SubUser')
    <div class="col-xs-12 margin-bottom-20">
        <a href="{{ route('dashboard.admin.promo_codes.add') }}"
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
{{--                        <th>صورة</th>--}}
{{--                        <th>وصف</th>--}}
                        <th>{{__('master.promo_code')}}</th>
{{--                        <th>{{ __('master.product_status') }}</th>--}}
{{--                        <th>{{ __('master.product_price') }}</th>--}}
{{--                        <th>{{ __('master.product_quantity') }}</th>--}}
                        <th>{{ __('master.discount') }}</th>
                        <th>{{ __('master.promo_code_status') }}</th>
                        <th>{{ __('master.promo_code_start') }}</th>
                        <th>{{ __('master.promo_code_end') }}</th>

                        @role('User|SubUser')
                        <th>{{ __('master.promo_code_edit')}}</th>
                        <th>{{ __('master.promo_code_delete')}}</th>
                        @endrole
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($promo_codes as $promo_code)
                        <tr class="text-center">
                            <td>{{ $promo_code->id }}</td>
                            <td>{{ $promo_code->code }}</td>
                            <td>{{$promo_code->discount }} {{ $promo_code->getCurrency() }}</td>
                            <td>
                                @if($promo_code->status)
                                    <span class="notice notice-green">{{ __('master.Active') }}</span>
                                @else
                                    <span class="notice notice-danger">{{ __('master.Inactive') }}</span>
                                @endif
                            </td>
                            <td>{{ Carbon\Carbon::parse($promo_code->start)->toDateTimeString() }}</td>
                            <td>{{ Carbon\Carbon::parse($promo_code->end)->toDateTimeString() }}</td>
{{--                            <td>--}}
{{--                                @if(($promo_code->product->status)??false)--}}
{{--                                    <span class="notice notice-green">{{ __('master.Active') }}</span>--}}
{{--                                @else--}}
{{--                                    <span class="notice notice-danger">{{ __('master.Inactive') }}</span>--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td>{{ ($promo_code->product->price)??0 }} {{ $promo_code->getCurrency() }}</td>--}}
{{--                            <td>--}}
{{--                                <img class="img-rounded"--}}
{{--                                     alt="image {{ $promo_code->product['name_'.$promo_code->store->getLang()] }} product"--}}
{{--                                     src="{{ asset($promo_code->product->image ?? 'dashboard/light/assets/images/sativa.png') }}">--}}
{{--                            </td>--}}

{{--                            <td>{{ $promo_code->product['description_'.$promo_code->store->getLang()] ?? __('master.no_data') }}</td>--}}


{{--                            <td>{{ ($promo_code->product->quantity)??0 }}</td>--}}
{{--                            <td>{{$promo_code->discount }} {{ $promo_code->getCurrency() }}</td>--}}
{{--                            <td>--}}
{{--                                @if($promo_code->status)--}}
{{--                                    <span class="notice notice-green">{{ __('master.Active') }}</span>--}}
{{--                                @else--}}
{{--                                    <span class="notice notice-danger">{{ __('master.Inactive') }}</span>--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td>{{ Carbon\Carbon::parse($promo_code->start)->toDateTimeString() }}</td>--}}
{{--                            <td>{{ Carbon\Carbon::parse($promo_code->end)->toDateTimeString() }}</td>--}}
                            @role('User|SubUser')
                            <td><a class="btn btn-primary btn-block" href="{{ route('dashboard.admin.promo_codes.edit',['id'=>$promo_code->id]) }}"><span><i class="fas fa-edit"></i></span></a></td>
                            <td><a class="btn btn-danger btn-block" href="{{ route('dashboard.admin.promo_codes.delete',['id'=>$promo_code->id]) }}">
                                    <span><i class="fas fa-trash-alt"></i></span>
                                </a></td>
{{--                            <td><a class="btn btn-success btn-block" target="_blank"--}}
{{--                                   href="{{ route('store.product_details_ads',['sub_domain'=> $promo_code->store->domain,'id'=>$promo_code->id]) }}">--}}
{{--                                    <span><i class="fas fa-bullhorn"></i></span>--}}
{{--                                </a></td>--}}
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
{{--Developed Saed Z. Sinwar--}}
