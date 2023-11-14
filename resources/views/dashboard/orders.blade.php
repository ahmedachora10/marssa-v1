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
    @PlanPermissions('count-orders',count($orders))
    @role('User')
    <div class="col-xs-12" style="display:none;">
        <form method="post" action="" autocomplete="off" id="order_product">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 box-content">
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group @error('product') has-error @enderror">
                            <label for="input-states-5">{{ __('master.product_name') }}</label>
                            <select name="product" class="form-control" id="input-states-5">
                                <option disabled selected> {{ __('master.product_name') }} </option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">
                                        {{ $product['name_'.$product->store->getLang()] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <div class="form-group  @error('quantity') has-error @enderror">
                            <label for="quantity">{{ __('store.quantity') }}</label>
                            <input id="quantity" name="quantity" type="text" class="form-control"
                                   value="{{ old('quantity') }}"/>
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <div class="form-group  @error('promo_code') has-error @enderror">
                            <label for="promo_code">{{ __('store.promo_code') }}</label>
                            <input id="promo_code" name="promo_code" type="text" class="form-control"
                                   value="{{ old('promo_code') }}"/>
                            @error('promo_code')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <div class="form-group  @error('name') has-error @enderror">
                            <label for="name">{{ __('store.full_name') }}</label>
                            <input id="name" name="name" type="text" class="form-control"
                                   value="{{ old('name') }}"/>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <div class="form-group  @error('email') has-error @enderror">
                            <label for="email">{{ __('store.email') }}</label>
                            <input id="email" name="email" type="email" class="form-control"
                                   value="{{ old('email') }}"/>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <div class="form-group  @error('mobile') has-error @enderror">
                            <label for="mobile">{{ __('store.mobile') }}</label>
                            <input id="mobile" name="mobile" type="text" class="form-control"
                                   value="{{ old('mobile') }}"/>
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-xs-12 col-md-4">
                        <div class="form-group  @error('address') has-error @enderror">
                            <label for="address">{{ __('store.address') }}</label>
                            <input id="address" name="address" type="text" class="form-control"
                                   value="{{ old('address') }}"/>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="col-xs-12 margin-bottom-30 text-center">
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                        @if($title_page !== 'offer_edit')
                            {{ __('master.add_new') }}
                        @else
                            {{ __('master.update_item') }}
                        @endif
                    </button>
                </div>
            </div>
        </form>
    </div>
    @endrole
    @else
        <div class="col-xs-12">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default panel-small-title">
                            <div class="panel-heading">
                                <h6 class="panel-title padding-10">{{ __("master.$title_page") }}</h6>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-8 col-md-offset-2 col-xs-12 text-center margin-top-30"
                                     style="float: left">
                                    <p>{{ __('master.package_cannot') }}</p>
                                    <p class="margin-top-30">
                                        <a href="{{ route('dashboard.admin.store_settings.upgrade_plan') }}"
                                           class="btn btn-primary btn-sm waves-effect waves-light">
                                            {{ __('master.upgrade_plan') }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endPlanPermissions
        <div class="row">
            <div class="col-xs-12">
                <div class="box-content bordered primary table-responsive">
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            {{--                        <th>{{ __('master.product_name') }}</th>--}}
                            {{--                        <th>{{ __('master.order_quantity') }}</th>--}}
                            {{--                        <th>{{ __('master.product_price') }}</th>--}}
                            {{--                        <th>{{ __('master.discount_offers') }}</th>--}}
                            {{--                        <th>{{ __('master.discount_coupons') }}</th>--}}
                            {{--                        <th>{{ __('master.order_discount') }}</th>--}}
                            <th>{{ __('master.Order Number') }}</th>
                           {{-- <th>{{ __('master.order_amount') }}</th>
                            <th>{{ __('master.mobile') }}</th>--}}
                            {{--<th>{{ __('master.address') }}</th>--}}
                            <th>{{ __('master.order_status') }}</th>
                            <th>{{ __('master.payment_method') }}</th>
                            {{--<th>{{ __('master.branch') }}</th>--}}
                            @if(Auth::user()->getRoleNames()[0] != 'User' and Auth::user()->getRoleNames()[0] != 'SubUser')
                                <th>{{ __('master.store_name') }}</th>
                            @endif
                            <th>{{ __('master.more_details') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $index=>$order)
                            <tr class="text-center tbl_td"style="background-color: @if($order->viewed==1) #e7e7e7 @else #fff; @endif"
                            onclick="rowid({{$order->id }});">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $order->id}}</td>
                                {{--                            <td> {{ $order->product['name_'.app()->getLocale()] }} </td>--}}
                                {{--                            <td> {{ $order->quantity }} </td>--}}
                                {{--                            <td> {{ $order->product->price ?? '' }} $ </td>--}}
                                {{--                            <td> {{ $order->offer['id'] }} </td>--}}
                                {{--                            <td> {{ $order->promo_code['id'] }} </td>--}}
                                {{--                            <td> {{ $order->discount ?? 0 }} {{ $order->currency }} </td>--}}
                                {{--<td> {{ $order->payment->data->cart->total }} {{ $order->currency }} </td>
                                <td> {{ $order->client->mobile }} 
                    <a class="btn btn-success btn-block" onclick="event.stopPropagation();"
                     target="_blank"
                       href="https://wa.me/{{$order->client->mobile}}"><i class="fab fa-whatsapp"></i></a>
                       </td>
                                
                                <td> {{ $order->client->address }} </td>--}}
                                <td>
                                    @if($order->status == 0)
                                        <span class="notice notice-yellow">{{ __('master.Pending') }}</span>
                                    @elseif($order->status == 1)
                                        <span class="notice notice-blue">{{ __('master.Accept') }}</span>
                                    @elseif($order->status == 2)
                                        <span class="notice notice-blue">{{ __('master.Process') }}</span>
                                    @elseif($order->status == 3)
                                        <span class="notice notice-purple">{{ __('master.Shipping') }}</span>
                                    @elseif($order->status == 4)
                                        <span class="notice notice-green">{{ __('master.DeliveryPayment') }}</span>
                                    @elseif($order->status == 5)
                                        <span class="notice notice-danger">{{ __('master.Cancel') }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{__('master.'.@$order->payment->data->type)}}
                                </td>

                                {{--<td>
                                    {{ $order->payment->branch->name ?? ' - ' }}
                                </td>--}}

                                @if(Auth::user()->getRoleNames()[0] != 'User' and Auth::user()->getRoleNames()[0] != 'SubUser')
                                    <td><span class="notice notice-purple">{{ $order->product ? $order->product->store->name : ''  }}</span>
                                    </td>

                                @endif

                                <td>
                                    {{--<a class="btn btn-primary btn-sm"
                                       href="{{ route('dashboard.admin.orders.order_details',['id'=>$order->id]) }}"><span><i
                                                    class="fas fa-eye"></i></span></a>
                                    <a class="btn btn-success btn-md" onclick="event.stopPropagation();"
                                     target="_blank"
                                       href="whatsapp://send?text={{ __('master.product_name') }} : *{{ $order->product['name_'.app()->getLocale()] ?? '' }}*
                                        %0A{{ __('master.order_quantity') }} : *{{ $order->quantity }}*
                                        %0A{{ __('master.product_price') }} : *{{ $order->product->price ?? '' }} $*
                                        %0A{{ __('master.order_discount') }} : *{{ $order->discount ?? 0 }} {{ $order->currency }}*
                                        %0A{{ __('master.mobile') }} : *{{ $order->client->mobile }}*
                                        %0A{{ __('master.address') }} : *{{ $order->client->address }}*
                                        %0A{{ __('master.store_name') }} : *{{ $order->product->store->name ?? '' }}*
                                        %0A{{ __('master.order_amount') }} : *{{ $order->payment->data->cart->total }} {{ $order->currency }}*
                                      @elseif($order->order_records->count() == 0) @foreach($orders as $order1)  {{ __('master.product_name') }} : @if(!empty($order1->product['name_'.app()->getLocale()])) *{{ $order1->product['name_'.app()->getLocale()] }}* @endif
                                        %0A{{ __('master.order_quantity') }} : *{{ $order1->quantity }}*
                                      @if(!empty($order1->product->price))  %0A{{ __('master.product_price') }} : *{{ $order1->product->price }} $* @endif %0A @endforeach  @endif
                                               "><i class="fab fa-whatsapp"></i>
                                    </a>--}}
                                    @if($order->order_records->count() > 0)
                                    <a class="btn btn-success btn-md" onclick="event.stopPropagation();"
                                     target="_blank"
                                       href="https://api.whatsapp.com/send?text= @if($order->order_records->count() > 0) @foreach($order->order_records as $order1) {{ __('master.product_name') }} : @if(!empty($order1->product['name_'.app()->getLocale()])) *{{ $order1->product['name_'.app()->getLocale()] }}* @endif
                                        %0A{{ __('master.order_quantity') }} : *{{ $order1->quantity }}*
                                      @if(!empty($order1->product->price))  %0A{{ __('master.product_price') }} : *{{ $order1->product->price }} $* @endif %0A @endforeach  @endif
                                        %0A{{ __('master.order_discount') }} : *{{ $order->discount ?? 0 }} {{ $order->currency }}*
                                        %0A{{ __('master.mobile') }} : *{{ $order->client->mobile }}*
                                        %0A{{ __('master.address') }} : *{{ $order->client->address }}*
                                       @if(!empty( $order->product->store->name)) %0A{{ __('master.store_name') }} : *{{ $order->product->store->name ?? '' }}* @endif
                                        %0A{{ __('master.order_amount') }} : *{{ $order->payment->data->cart->total }} {{ $order->currency }}*
                                        
                                        "><i class="fab fa-whatsapp"></i>
                                    </a>
                                    @endif
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
    </script>
    <script>
    function rowid(td){
        var url="{{ route('dashboard.admin.orders.order_details','')}}" +"/"+ td;
        document.location.href =url;
    }
        $('select[name ="product"]').on('change', function () {
            let route = "{{ $route }}",
                id = $(this).children("option:selected").val();
            route = route.replace('/0', '/' + id);
            route = route.replace('https', 'http');
            console.log(route);
            $('#order_product').attr('action', route);
        });
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
