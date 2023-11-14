@extends('dashboard.master')


@section('participants_index')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/RWD-table-pattern/css/rwd-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal-default-theme.css') }}">
    <style>
        .active__reports{
            background: #0a5cc1;
        }

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 margin-bottom-30">
            <a class="btn btn-success margin-bottom-30 {{request()->type =='all' ? 'active__reports':'' }}"
               href="{{route('dashboard.admin.reportsStores',['type'=>'all'])}}">
                {{__("master.all_stores")}}
            </a>
            <a class="btn btn-success margin-bottom-30 {{request()->type =='plan_stander' ? 'active__reports':'' }}"
               href="{{route('dashboard.admin.reportsStores',['type'=>'plan_stander'])}}">
                {{__("master.plan_stander")}}
            </a>
            <a class="btn btn-success margin-bottom-30 {{request()->type =='plan_free' ? 'active__reports':'' }}"
               href="{{route('dashboard.admin.reportsStores',['type'=>'plan_free'])}}">
                {{__("master.plan_free")}}
            </a>
            <a class="btn btn-success margin-bottom-30 {{request()->type =='plan_start_up' ? 'active__reports':'' }}"
               href="{{route('dashboard.admin.reportsStores',['type'=>'plan_start_up'])}}">
                {{__("master.plan_start_up")}}
            </a>
            <a class="btn btn-success margin-bottom-30 {{request()->type =='plan_super' ? 'active__reports':'' }}"
               href="{{route('dashboard.admin.reportsStores',['type'=>'plan_super'])}}">
                {{__("master.plan_super")}}
            </a>
            <a class="btn btn-success margin-bottom-30 {{request()->type =='stores_not_work_but_has_products' ? 'active__reports':'' }}"
               href="{{route('dashboard.admin.reportsStores',['type'=>'stores_not_work_but_has_products'])}}">
                {{__("master.stores_not_work_but_has_products")}}
            </a>
            <a class="btn btn-success margin-bottom-30 {{request()->type =='stores_active_without_products' ? 'active__reports':'' }}"
               href="{{route('dashboard.admin.reportsStores',['type'=>'stores_active_without_products'])}}">
                {{__("master.stores_active_without_products")}}
            </a>
            <a class="btn btn-success margin-bottom-30 {{request()->type =='stores_disable_without_products' ? 'active__reports':'' }}"
               href="{{route('dashboard.admin.reportsStores',['type'=>'stores_disable_without_products'])}}">
                {{__("master.stores_disable_without_products")}}
            </a>
            <a class="btn btn-success margin-bottom-30 {{request()->type =='stores_active_and_have_product' ? 'active__reports':'' }}"
               href="{{route('dashboard.admin.reportsStores',['type'=>'stores_active_and_have_product'])}}">
                {{__("master.stores_active_and_have_orders")}}
            </a>
            <a class="btn btn-success margin-bottom-30 {{request()->type =='stores_7_day_left_to_end' ? 'active__reports':'' }}"
               href="{{route('dashboard.admin.reportsStores',['type'=>'stores_7_day_left_to_end'])}}">
                {{__("master.stores_7_day_left_to_end")}}
            </a>
        </div>
        <div class="col-xs-12">

            <div class="box-content bordered primary ">
                <form method="POST" action="{{route('dashboard.admin.store_settings.send.whatsapp')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="switch primary margin-top-30 ">
                        <input type="checkbox" name="files" id="files" value="1">
                        <label for="files">{{ __('master.files') }}</label>
                    </div>
                    <div class="d-flex">
                        <button type="button" onclick="toggleUserSelect()" class="btn btn-success"
                                style="margin-bottom: 20px">{{__("Select All")}}</button>
                        <textarea name="message" class="form-control d-inline-block"
                                  id="text"
                                  placeholder="{{__("master.message")}}"></textarea>
                        <div id="file" style="display: none">
                            @include("dashboard.components.fileUpload")
                        </div>
                        <button class="btn btn-success margin-top-20 margin-bottom-20"
                                type="submit">{{__("master.send")}}</button>
                    </div>
                    <table class="table table-bordered " style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>أسم</th>
                            <th>صورة</th>
                            <th>{{__("master.store_phone")}}</th>
                            <th>تاريخ نهاية الاشتراك</th>
                            <th>رصيد المحفظة</th>
                            <th>{{ __('master.store_status') }}</th>
                            <th>{{ __('master.store_admin') }}</th>
                            <th>{{ __('master.store_plan') }}</th>
                            <th>{{ __('master.store_domain') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stores as $store)
                            @isset($store->users->first()->id)
                                <tr class="text-center">
                                    <td><input type="checkbox" class="selectUser" name="user[]"
                                               value="{{$store->users->first()->id }}"></td>
                                    <td>{{ $store->information['title_page_'.app()->getLocale()] ?? $store->name }}</td>
                                    <td>
                                        <img class="img-rounded" alt="logo {{ $store->name }} store"
                                             src="{{ asset($store->information['logo'] ?? 'dashboard/light/assets/images/sativa.png') }}">
                                    </td>
                                    <td>{{ $store->users->first()->mobile }}</td>
                                    @if(isset($store->subscribe_last->deadline))
                                        <td>{{ $store->subscribe_last->deadline }}</td>
                                    @else
                                        <td>غير معروف</td>
                                    @endif
                                    <td>{{ $store->total_balance }} {{ env('currency_symbol') }}</td>
                                    <td>
                                        @if($store->status)
                                            <span class="notice notice-green">{{ __('master.Active') }}</span>
                                        @else
                                            <span class="notice notice-danger">{{ __('master.Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset( $store->users->first()->name))
                                            {{ $store->users->first()->name}}
                                        @endif
                                    </td>
                                    <td>
                                        <span class="notice notice-purple">{{ $store->plan['name_'.app()->getLocale()] }}</span>
                                    </td>
                                    <td>{{ $store->domain }}</td>

                                </tr>
                            @endisset
                        @endforeach
                        </tbody>
                    </table>
                </form>

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
            $("#files").on("change", function (e) {

                if (e.target.checked) {
                    $("#text").hide('slow');
                    $("#file").show('slow');
                } else {
                    $("#text").show('slow');
                    $("#file").hide('slow');
                }

            })
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
            var checkBoxes = $("input[type=checkbox]:not(#files)");
            checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        }

    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
