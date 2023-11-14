@extends('dashboard.master')

@section('participants_index')
    current active
@endsection

@section('content')
    @role('SuperAdmin')
        <div class="col-xs-12">
            <div class="col-xs-12">
                <div class="box-content card white">
                    <div class="card-content">
                        <table class="table table-hover no-margin">
                            <tbody>
                                <tr>
                                    <td>{{ __('master.affiliater') }}</td>
                                    <td>
                                        <span>{{   $order->Withdrawable->affiliaters->name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('master.withdraw_value') }}</td>
                                    <td>
                                        <span>{{  $order->withdraw_value ?? 0  }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('master.affiliate_total') }}</td>
                                    <td>
                                        <span>{{ $order->Withdrawable->affiliaters ? $order->Withdrawable->affiliaters->affiliates->value_profits()  : 0 }}</span>
                                    </td>
                                </tr>
                                
                                
                                <tr>
                                    <td>{{ __('master.withdraw_total') }}</td>
                                    <td>
                                        <span>{{  $order->withdraw_total ?? 0 }}</span>
                                    </td>
                                </tr>
                                
                                  <tr>
                                    <td>{{ __('master.withdraw_way') }}</td>
                                    <td>
                                        <span>{{  $order->notice_payment ?? '' }}</span>
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <td>{{ __('master.status') }}</td>
                                    <td>
                                        <span> {!! $order->status_order  !!}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('master.date') }}</td>
                                    <td>
                                        <span>{{  $order->created_at }}</span>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($order->status == 0)
            <div class="col-xs-12">
                <div class="box-content card white">
                    <div class="card-content">
                        <div class="col-md-3 col-xs-12">
                            <form method="POST" action="{{ route('dashboard.admin.affiliate-order-withdraw-update',['order_id'=>$order->id]) }}">
                                @csrf
                                <div class="form-group  @error('status') has-error @enderror">

                                    <input type="radio" name="status" value="1" @if($order->status == 1) checked @endif>
                                    <label> @if(app()->getLocale() == 'ar' )
                                        <span class="text-success"> الموافقة </span>
                                    @else
                                        <span class="text-success"> Agree </span>
                                    @endif </label>



                                     <input style="margin-right:100px;" type="radio" name="status" value="2" @if($order->status == 2) checked @endif>
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
                                            {{ __('master.update_order') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
        </div>
  
    @endrole

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
   
@endsection
{{--Developed Saed Z. Sinwar--}}
