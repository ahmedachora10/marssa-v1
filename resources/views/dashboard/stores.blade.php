@extends('dashboard.master')


@section('participants_index')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/RWD-table-pattern/css/rwd-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal-default-theme.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @if(!empty(session('new_password')))
                <div class="alert alert-success">
                    {!! __('master.reset_password_status',['name'=>session('name'),'password'=>'<code>'.session('new_password').'</code>']) !!}
                </div>
            @endif
            <div class="box-content bordered primary ">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>أسم</th>
                        <th>صورة</th>
                        <th>{{__("master.store_phone")}}</th>
                        <th>وصف</th>
                        <th>رصيد المحفظة</th>
                        <th>{{ __('master.store_status') }}</th>
                        <th>{{ __('master.cancel') }}</th>
                        <th>{{ __('master.store_admin') }}</th>
                        <th>{{ __('master.store_plan') }}</th>
                        <th>{{ __('master.store_domain') }}</th>
                        <th>{{ __('master.language') }}</th>
                        <th>{{ __('master.date_created') }}</th>
                        <th>{{ __('master.deadline_date') }}</th>
                        <th>{{ __('master.generate_password') }}</th>
                        <th>{{ __('master.visit_website') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stores as $store)
                        @isset($store->users->first()->id)
                            <tr class="text-center">
                                <td>{{$store->users->first()->id}}</td>
                                <td>{{ $store->information['title_page_'.app()->getLocale()] ?? $store->name }}</td>
                                <td>
                                    <img class="img-rounded" alt="logo {{ $store->name }} store"
                                         src="{{ asset($store->information['logo'] ?? 'dashboard/light/assets/images/sativa.png') }}">
                                </td>
                                <td>{{ $store->users->first()->mobile }}</td>
                                <td>{{ $store->information['description_'.app()->getLocale()] ?? __('master.no_data') }}</td>
                                <td>{{ $store->total_balance }} {{ env('currency_symbol') }}</td>
                                <td>
                                    @if($store->status)
                                        <span class="notice notice-green">{{ __('master.Active') }}</span>
                                    @else
                                        <span class="notice notice-danger">{{ __('master.Inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <small>
                                        <a href="{{ route('dashboard.admin.orders.canceledOrders',$store->id) }}">
                                            @if(app()->getLocale() == 'ar')
                                                رؤية الطلبات الملغية
                                            @else
                                                Cancelled Orders
                                            @endif
                                        </a>
                                    </small>
                                </td>
                                <td>
                                    @if(isset( $store->users->first()->name))
                                        {{ $store->users->first()->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($store->plan->is_commission == 0)
                                    <span class="notice notice-purple">
                                        {{ $store->plan['name_'.app()->getLocale()] }}
                                    </span>
                                    @else   
                                        <a href="{{ route('dashboard.admin.updateIndView',$store->id) }}" class="btn btn-primary">
                                            {{ $store->plan['name_'.app()->getLocale()] }}
                                        </a>
                                      
                                    
                                    @endif
                                </td>
                                <td>{{ $store->domain }}</td>
                                <td>
                                    @if($store->language == 0)
                                        {{ __('master.arabic') }}
                                    @elseif($store->language == 1)
                                        {{ __('master.english') }}
                                    @else
                                        {{ __('master.arabic') . __('master.and') . __('master.english')}}
                                    @endif
                                </td>
                                <td>{{ Carbon\Carbon::parse($store->created_at)->toFormattedDateString() }}</td>
                                <td>{{ $store->getCurrentSubscriptions() ? Carbon\Carbon::parse($store->getCurrentSubscriptions()->deadline)->toFormattedDateString() : ''}}</td>

                                <td>
                                    <form class="reset-password" method="post"
                                          action="{{ route('dashboard.admin.reset_password',['participant_id'=>$store->users->first()->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-block"><span> <i
                                                        class="fas fa-unlock"></i> </span></button>
                                    </form>
                                </td>
                                <td><a class="btn btn-primary btn-block" href="{{ $store->route_store()  }}"><span><i
                                                    class="fas fa-eye"></i></span></a></td>
                            </tr>
                        @endisset
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
                            columns: [0,1, 2, 3, 4, 5]
                        }
                    }, {
                        extend: 'colvis',
                        text: 'العواميد الظاهرة'
                    }
                ],
                checkboxes: {'selectRow': true},
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

        //sweetalert to generate password for user
        $('form.reset-password').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: "<?php echo __('master.do_you_want_to_generate_new_password'); ?>",
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: "<?php echo __('master.confirm_button') ?>",
                cancelButtonText: "<?php echo __('master.cancel_button') ?>",
            }).then((isConfirmed) => {
                /* Read more about isConfirmed, isDenied below */
                if (isConfirmed.value == true) {
                    e.currentTarget.submit();
                }
            })

        });


    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
