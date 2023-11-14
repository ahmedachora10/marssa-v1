@extends('dashboard.master')
@section('affiliatees_my_profits')
    current active
@endsection
@section('head_tag')
 <style>
     .info-box{
        border-radius: 0.25rem;
        background-color: #fff;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 1rem;
        min-height: 80px;
        padding: 0.5rem;
        position: relative;
        width: 100%;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
     }
     .info-box .info-box-icon{
        border-radius: 0.25rem;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 70px;
        display: flex;
        font-size: 1.875rem;
     }
     .info-box .info-box-content{
        flex: 1;
        padding: 0 10px;
        justify-content: center;
        line-height: 1.8;
     }
     .info-box .info-box-text, .info-box .progress-description {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
     }
     .info-box .info-box-number {
        display: block;
        margin-top: 0.25rem;
        font-weight: 700;
     }
     .container-button-create-account{
        padding: 12px;
     }
     .input-group {
        position: relative;
        display: table;
        border-collapse: separate;
        width: 100%;
        padding: 10px;
     }
     .model .badge{
        padding: 8px 37px;
     }
 </style>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="fas fa-check-circle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> عدد المدعويين</span>
                        <span class="info-box-number">{{ auth()->user()->affiliates ? auth()->user()->affiliates->affiliatees()->count()  : 0 }} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="fas fa-money-bill"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('master.affiliate_total') }}</span>
                        <span class="info-box-number">{{ auth()->user()->affiliates ? auth()->user()->affiliates->value_profits()  : 0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            

            <div class="col-md-3 col-sm-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="fas fa-fist-raised"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> اجمالى المبالغ المسحوبة</span>
                        <span class="info-box-number">{{ auth()->user()->affiliates ? auth()->user()->affiliates->withdraw->where('status',1)->sum('withdraw_value')  : 0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="fas fa-fist-raised"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> المتبقي فى الارباح الافيليت</span>
                        <span class="info-box-number">{{ auth()->user()->affiliates ? (auth()->user()->affiliates->value_profits() - auth()->user()->affiliates->withdraw->where('status',1)->sum('withdraw_value'))  : 0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            
             <div class="col-md-3 col-sm-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="fas fa-fist-raised"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> طلبات السحب المكتملة</span>
                        <span class="info-box-number"> {{ auth()->user()->affiliates ? auth()->user()->affiliates->withdraw->where('status',1)->count() :0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div> 
            
            <div class="col-md-3 col-sm-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="fas fa-fist-raised"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> طلبات السحب المعلقة</span>
                        <span class="info-box-number"> {{ auth()->user()->affiliates ? auth()->user()->affiliates->withdraw->where('status',0)->count() :0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div> 
            
            <div class="col-md-3 col-sm-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="fas fa-fist-raised"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> طلبات السحب المرفوضة</span>
                        <span class="info-box-number"> {{ auth()->user()->affiliates ? auth()->user()->affiliates->withdraw->where('status',2)->count() :0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div> 
            
        </div>
        <div class="text-left container-button-create-account">
            <button class="btn btn-success create-new-account" data-toggle="modal" data-target="#modalLg" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-plus"></i>
                    طلبات سحب الرباح
            </button>
        </div>
    </div>
    
    <div class="row">

        @if(!empty(session('message')))
                <div class="alert alert-success">
                    <ul>
                        <li>{{  session('message') }}</li>
                    </ul>
                </div>
        @endif
        
        
        <div class="col-xs-12">
            
            <div class="box-content bordered primary ">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('master.inviter') }}</th>
                        <th>{{ __('master.invitee') }}</th>
                        <th>{{ __('master.profit') }}</th>
                        <th>{{ __('master.date') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($profits)
                        @forelse($profits as $profit)
                            <tr class="text-center">
                                <td class="">
                                   {{ $profit->id }}
                                </td>
                                <td>{{ $profit->affiliater->affiliaters->email  ?? $profit->affiliater->affiliaters->name }}</td>
                                <td class="">
                                   {{ $profit->affiliatee->email ?? $profit->affiliatee->name }}
                                </td>
                                <td class="">
                                   {{ $profit->value }}
                                </td>
                                <td class="">
                                   {{ $profit->created_at }}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    @endif
                    </tbody>
                </table>
            </div>
     
        </div>
    </div>
    

    
@stop

@section('script')
    
    <div class="modal fade " id="modalLg" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('master.withdraw-order-profit') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="badge badge-info" style="font-size:100%"> {{ __('master.profit-text') }}    : {{ auth()->user()->affiliates ? auth()->user()->affiliates->value_profits() : 0 }}</p>
                    @if( auth()->user()->affiliates && auth()->user()->affiliates->value_profits() > 0)
                        <form method="post" action="{{ route('dashboard.admin.affiliatees-order-withdraw') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <p class="label-model">{{ __('master.withdraw-value') }}</p>
                                        <input name="value" type="number" class="form-control" max="{{ auth()->user()->affiliates->value_profits() }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <p class="label-model">{{ __('master.notice-payment-withdraw') }}</p>
                                        <textarea name="notice_payment" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group container-button">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('master.profit-send') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </form>
                    @else
                        <p class="alert alert-danger"> {{ __('master.text-error-profit')  }}</p>
                    @endif
                </div>

            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    
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
