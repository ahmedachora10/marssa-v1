@extends('dashboard.master')

@section('links_current')
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
            <div class="box-content bordered primary ">
                @role('SuperAdmin')
                    <button class="btn btn-success mb-2 show-create-form" style="margin-bottom:25px;" >
                        {{ app()->getLocale() == 'ar' ? 'اضافة موقع هام' : 'Add Important Website' }}
                    </button>
                    <div class="create-links-form" style="display:none;">
                        
                        <form method="post" action="{{ route('dashboard.store-link') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="store_id" value="{{auth()->user()->store->id}}">
                                <div class="col-12" style="margin-bottom:25px;">
                                    <h4 class="header"> {{ app()->getLocale() == 'ar' ? 'إنشاء رابط جديد' : 'Create New Link' }} </h4>
                                    <div class="hide-current-form" style="position: absolute;right: 20px;top: 70px;">
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label>
                                            {{ app()->getLocale() == 'ar' ? 'الرابط' : 'Link' }}
                                        </label>
                                        <input class="form-control" placeholder="https://web.facebook.com/" type="text" max="191" name="link" requried="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label>
                                            {{ app()->getLocale() == 'ar' ? 'الوصف' : 'Description' }}
                                        </label>
                                        <input class="form-control" type="text" max="191"  name="description" requried="true">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <input type="submit" name="submit" class="btn btn-success btn-block" style="margin-top:30px">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endrole
                <table class="table table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ app()->getLocale() == 'ar' ? 'الموقع' : 'Link' }}</th>
                        <th>{{ app()->getLocale() == 'ar' ? 'الوصف' : 'Description'}}</th>
                        @role('SuperAdmin')
                        <th>{{ __('master.delete') }}</th>
                        @endrole
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($links as $key=>$link)
                            <tr>
                                <td>
                                    {{ ++$key }}
                                </td>
                                <td>
                                    <a href="{{$link->link}}" class="btn btn-link" target="_blank">
                                        {{ $link->link }}
                                    </a>
                                </td>
                                <td>
                                    {{ $link->description }}
                                </td>
                                @role('SuperAdmin')
                                <td>
                                    
                                    <a href="{{ route('dashboard.links_destroy',$link->id) }}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
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
        $('.show-create-form').click(function() {
            $('.create-links-form').show();  
        });
        $('.hide-current-form').click(function() {
            $('.create-links-form').hide(); 
        });
    });
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
             
                "language": {
                    "url": "{{(app()->getLocale() == 'ar') ? '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json' : '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json'}}"
                }
            });
        } );
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}
