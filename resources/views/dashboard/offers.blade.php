@extends('dashboard.master')


@section('offers_index')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/RWD-table-pattern/css/rwd-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal-default-theme.css') }}">
@endsection

@section('content')
    @role('User|SubUser')
    <div class="col-xs-12 margin-bottom-20">
        <a href="{{ route('dashboard.admin.offers.add') }}"
           class="btn btn-primary btn-rounded waves-effect waves-light">
            <i class="ico ico-left fa fa-plus"></i>
            {{ __('master.add_new') }}
        </a>
    </div>
    @endrole

    <div class="row small-spacing">
        <div class="col-xs-12">
            <div class="box-content bordered primary ">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>أسم</th>
                        <th>صورة</th>
                        <th>وصف المنتج</th>
                        <th>{{ __('master.product_status') }}</th>
                        <th>{{ __('master.product_quantity') }}</th>
                        <th>{{ __('master.product_price') }}</th>
                        <th>{{ __('master.new_price') }}</th>
                        <th>{{ __('master.offer_start') }}</th>
                        <th>{{ __('master.offer_end') }}</th>
                        @role('User|SubUser')
                        <th>{{ __('master.offer_edit')}}</th>
                        <th>{{ __('master.offer_delete')}}</th>
                        @endrole
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $offer)
                    <?php
                    $getimg = ['dashboard/light/assets/images/sativa.png'];
                    if (isset($offer->product->image)) {
                        foreach ($offer->product->image as $img) {
                            $last = last(explode('.',$img));
                            if (in_array($last,["jpg", "png", "gif"])) {
                                $getimg[] = $img;
                            }
                        }
                    }

                    ?>
                    <tr class="text-center">
                        <td>{{ $offer->id }}</td>
                            <td>               <img class="img-rounded"
                                                    alt="image {{ $offer->product['name_'.$offer->store->getLang()] ?? null }} product"
                                                    src="{{ asset($getimg[array_rand($getimg,1)]) }}">
                            </td>
                            <td>{{ $offer->product['name_'.$offer->store->getLang()] ?? $offer->id }}</td>
                            <td>{{ $offer->product['description_'.$offer->store->getLang()] ?? __('master.no_data') }}</td>
                            <td>
                                @if($offer->status)
                                    <span class="notice notice-green">{{ __('master.Active') }}</span>
                                @else
                                    <span class="notice notice-danger">{{ __('master.Inactive') }}</span>
                                @endif
                            </td>
                            <td>{{ ($offer->product->quantity) ?? '-' }}</td>
                            <td>{{ ($offer->product->price) ?? '0' }} {{ $offer->getCurrency() }}</td>
                            <td>{{ $offer->discount }} {{ $offer->getCurrency() }}</td>
                            <td>{{ Carbon\Carbon::parse($offer->start)->toDateTimeString() }}</td>
                            <td>{{ Carbon\Carbon::parse($offer->end)->toDateTimeString() }}</td>

                            @role('User|SubUser')
                            <td><a class="btn btn-primary btn-block" href="{{ route('dashboard.admin.offers.edit',['id'=>$offer->id]) }}">
                                    <span><i class="fas fa-edit"></i></span>
                                </a></td>
                            <td><a class="btn btn-danger btn-block" href="{{ route('dashboard.admin.offers.delete',['id'=>$offer->id]) }}">
                                    <span><i class="fas fa-trash-alt"></i></span>
                                </a></td>
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
