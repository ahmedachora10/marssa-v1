@extends('dashboard.master')
@section('affiliatees_show')
    current active
@endsection


@section('content')
    <div class="row">
        <div class="container mt-5">

            @if(!empty(session('message')))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{  session('message') }}</li>
                        </ul>
                    </div>
            @endif
            <div class="col-xs-12">
                <p style="line-height: 3em;background-color: white;padding: 5px;border-top:5px solid #9a33c7;">{{ $user->name }}</p>
                <form method="post" action="{{ route('dashboard.admin.update-status-affiliate-rate',['user'=> $user->id ]) }}">
                    @csrf
                    <div class="form-group">
                        <p>{{ __('master.status_affiliate_rate') }}</p>
                        <div class="">
                             <input name="status_affiliate_rate" type="number" value="{{ $user->affiliates->status_affiliate_rate != 0 ? $user->affiliates->status_affiliate_rate : ''  }}" placeholder="{{ __('master.affiliate_continue') }}" class="form-control" />                        
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                             <button type="submit"  class="btn btn-success" >  {{ __('master.update_data') }} </button>                      
                        </div>
                    </div>
                </form>
                <div class="box-content bordered primary ">
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('master.name') }}</th>
                            <th>{{ __('master.email') }}</th>
                            <th>{{ __('master.date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($affiliatees)
                                @forelse($affiliatees as $affilitees)
                                    <tr class="text-center">
                                        <td>{{ $affilitees->id }}</td>
                                        <td class="">
                                           {{ $affilitees->name }}
                                        </td>
                                        <td class="">
                                           {{ $affilitees->email ?? $affilitees->name  }}
                                        </td>
                                        <td class="">
                                           {{ $affilitees->created_at }}
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
    </div>
@stop

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
