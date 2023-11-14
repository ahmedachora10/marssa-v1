@extends('dashboard.master')

@section('participants_index')
    current active
@endsection

@section('content')
    @role('SuperAdmin')
    @if($title_page == 'invoice_edit')
        <div class="col-xs-12">
            <div class="col-xs-12">
                <div class="box-content card white">
                    <div class="card-content">
                        <table class="table table-hover no-margin">
                            <tbody>
                            <tr>
                                <td>{{ __('master.by') }}</td>
                                <td>
                                    <span>{{ $invoice->user->name }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.payment_method') }}</td>
                                <td>
                                    <span>{{ $invoice->type }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.deadline_date') }}</td>
                                <td>
                                    <span>{{ Carbon\Carbon::parse($invoice->deadline)->toFormattedDateString()}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.invoice_status') }}</td>
                                <td>
                                    @if($invoice->status == 1)
                                        <span class="notice notice-green">{{ __('master.Verified') }}</span>
                                    @elseif($invoice->status == 0)
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
                            </tr>
                            <tr>
                                <td>{{ __('master.store_name') }}</td>
                                <td>
                                    <span>{{ $invoice->user->store->name ?? '' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.store_plan') }}</td>
                                <td>
                                    <span class="notice notice-purple">{{ $invoice->plan['name_'.app()->getLocale()] ?? '' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.discount') }}</td>
                                <td>
                                    {{ $invoice->discount . ' $' ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.total_price') }}</td>
                                <td>
                                    {{ $invoice->amount_total . ' $' ?? '' }}
                                </td>
                            </tr>
                            @if($invoice->pay_id)
                                <tr>
                                    <td>Payment ID</td>
                                    <td>
                                        {{ $invoice->pay_id }}
                                    </td>
                                </tr>
                            @endif
                            @if($invoice->token)
                                <tr>
                                    <td>Token</td>
                                    <td>
                                        {{ $invoice->token }}
                                    </td>
                                </tr>
                            @endif
                            @if($invoice->payer_id)
                                <tr>
                                    <td>Payer ID</td>
                                    <td>
                                        {{ $invoice->payer_id }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>{{ __('master.date_created') }}</td>
                                <td>
                                    <span>{{ Carbon\Carbon::parse($invoice->created_at)->toFormattedDateString()}}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($invoice->bill)
                <div class="col-xs-12">
                    <div class="box-content card white">
                        <div class="card-content">
                            @if($invoice->status == 0)
                                <div class="col-md-3 col-xs-12">
                                    <form method="POST" action="{{ route('dashboard.admin.invoices.update') }}">
                                        @csrf
                                        <input type="hidden" value="{{ $invoice->id ?? ''}}" name="id">
                                        <div class="form-group  @error('status') has-error @enderror">
                                            <!--<div class="switch primary margin-top-30">-->
                                            <!--    <input type="checkbox" name="status" id="status" value="1"-->
                                        <!--           @if($invoice->status) checked @endif>-->
                                        <!--    <label for="status">{{ __('master.invoice_status') }}</label>-->
                                            <!--</div>-->

                                            <input type="radio" name="status" value="1"
                                                   @if($invoice->status == 1) checked @endif>
                                            <label> @if(app()->getLocale() == 'ar' )
                                                    <span class="text-success"> الموافقة </span>
                                                @else
                                                    <span class="text-success"> Agree </span>
                                                @endif </label>


                                            <input style="margin-right:100px;" type="radio" name="status" value="2"
                                                   @if($invoice->status == 2) checked @endif>
                                            <label> @if(app()->getLocale() == 'ar' )
                                                    <span class="text-danger"> الرفض </span>
                                                @else
                                                    <span class="text-danger"> Refuse </span>
                                                @endif </label>

                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group row mb-0 margin-top-20">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    {{ __('master.invoice_edit') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                            <div class="@if($invoice->status == 0) col-md-9 col-xs-12  @else col-xs-12 @endif margin-bottom-20">
                                <img src="{{ url('storage/'.$invoice->bill )  }}" width="100%" alt="{{ $invoice->id }}">
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
    @endrole
    @if($title_page !== 'invoice_edit')
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
                            <th>{{ __('master.store_plan') }}</th>
                            <th>{{ __('master.promo_code') }}</th>
                            <th>{{ __('master.total_price') }}</th>
                            @role('SuperAdmin')
                            <th>{{ __('master.deadline_date') }}</th>
                            @endrole
                            @role('User')
                            <th>{{ __('master.date') }}</th>
                            @endrole
                            @role('SuperAdmin')
                            <th>{{ __('master.more_details')}}</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            @if(isset($invoice->user))
                                <tr class="text-center">
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->user->name }}</td>
                                    <td>{{ $invoice->type }}</td>
                                    <td>
                                        @if($invoice->status == 1)
                                            <span class="notice notice-green">{{ __('master.Verified') }}</span>
                                        @elseif($invoice->status == 0)
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
                                    <td>{{ $invoice->user->store->name ?? '' }}</td>
                                    @endrole
                                    <td>
                                        <span class="notice notice-purple">{{ $invoice->plan['name_'.app()->getLocale()] ?? '' }}</span>
                                    </td>
                                    <td>
                                        <span class="notice notice-purple">{{ $invoice->promo_code ? $invoice->promo_code->discount . ' $' : '' }}</span>
                                    </td>
                                    <td>{{ $invoice->amount_total . ' $' ?? '' }}</td>
                                    @role('SuperAdmin')
                                    <td>
                                        <span>{{ Carbon\Carbon::parse($invoice->deadline)->toFormattedDateString()}}</span>
                                    </td>

                                    @endrole
                                    @role('User')
                                    <td>
                                        <span>{{ Carbon\Carbon::parse($invoice->created_at)->toFormattedDateString()}}</span>
                                    </td>
                                    @endrole
                                    @role('SuperAdmin')
                                    <td><a class="btn btn-primary btn-block"
                                           href="{{ route('dashboard.admin.invoices.edit',['id'=>$invoice->id]) }}"><span><i
                                                        class="fas fa-info-circle"></i></span></a></td>
                                    @endrole
                                </tr>
                            @endif
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
