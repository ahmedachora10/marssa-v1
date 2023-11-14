@extends('dashboard.master')

@section('store_settings')
    current active
@endsection
@section('head_tag')
    <style>
    @media screen and (min-width:1200px){
      .btn-form{
          float: right;
          width: 100%;
      }
    }
    </style>
@endsection
@section('content')
    <div class="row small-spacing">

        <div class="col-xs-12">
            <div class="row">
                @if (session('error'))
                    <div class="small-spacing">
                        <div class="col-xs-12">
                            <div class="alert alert-error alert-dismissible"
                                 role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                @if(session('error') == "package_cannot")
                                    <span>{{ __('master.package_cannot') }}
                                        <a style="color: white;font-weight: bold"
                                           href="{{ route('dashboard.admin.store_settings.upgrade_plan') }}">
                                           ( {{ __('master.upgrade_plan') }} )
                                        </a>
                                </span>
                                @else
                                    <strong>{{ __('master.'.session('error')) }}</strong>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if (session('success'))
                    <div class="small-spacing">
                        <div class="col-xs-12">
                            <div class="alert alert-success alert-dismissible"
                                 role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ __('master.'.session('success')) }}</strong>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box-content card white">
                <h4 class="box-title">

                        {{ __('master.update_item') }}

                </h4>
                <div class="card-content">
                    <form method="POST" action="{{ url('dashboard/admin/store_settings/branches',['id'=>$branch->id]) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group @error('name') has-error @enderror ">
                            <label for="input-states-1">{{ __('master.branch_name') }}</label>
                            <div class="form-with-icon">
                                <input name="name" type="text" class="form-control" id="input-states-1"
                                        value="{{ $branch->name ?? old('name') }}" required>
                                <i class="item-icon item-icon-right"><i class="fas fa-user-edit"></i></i>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group btn-form">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('master.update_item') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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
