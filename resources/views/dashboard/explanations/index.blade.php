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
                                    <span>{{ __('master.package_cannot') }}</span>
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
                    @if($title_page !== 'admin_edit')
                        {{ __('master.add_new') }}
                    @else
                        {{ __('master.update_item') }}
                    @endif
                </h4>
                <div class="card-content">
                    <form method="POST" action="{{ url('dashboard/admin/store_settings/explanations') }}" autocomplete="off">
                        @csrf

                        <div class="form-group @error('title') has-error @enderror">
                            <label for="input-states-1">{{ __('master.Explanation_title') }}</label>
                            <div class="form-with-icon">
                                <input name="title" type="text" class="form-control" id="input-states-1"
                                        value="{{ old('title') }}" required>
                                <i class="item-icon item-icon-right"><i class="fas fa-user-edit"></i></i>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group @error('description') has-error @enderror">
                            <label for="input-states-1">{{ __('master.Explanation_description') }}</label>
                            <div class="form-with-icon">
                                <textarea name="description" class="form-control" >
                                </textarea>

                            </div>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group @error('section') has-error @enderror">
                            <label for="input-states-1">{{ __('master.Explanation_section') }}</label>
                            <div class="form-with-icon">
                                <select name="section" type="text" class="form-control" id="input-states-1" required>
                                        <option value="store_settings"  >{{ __('master.store_settings') }}</option>
                                        <option value="home"            >{{ __('master.home') }}</option>
                                        <option value="orders"          >{{ __('master.orders')}}</option>
                                        <option value="products"        >{{ __('master.products')}}</option>
                                        <option value="clients"         >{{ __('master.clients') }}</option>
                                        <option value="marketing"       >{{ __('master.marketing') }}</option>
                                        <option value="reports"         >{{ __('master.reports')}}</option>
                                        <option value="subscription"    >{{ __('master.subscription')}}</option>
                                        <option value="Wallet"          >{{ __('master.Wallet')}}</option>
                                        <option value="calculations"    >{{ __('master.calculations') }}</option>
                                        <option value="our_platform"    >{{ __('master.our_platform') }}</option>
                                </select>

                            </div>
                            @error('section')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group @error('video_link') has-error @enderror">
                            <label for="input-states-1">{{ __('master.Explanation_video_link') }}</label>
                            <div class="form-with-icon">
                                <input name="video_link" type="text" class="form-control" id="input-states-1"
                                        value="{{ old('video_link') }}" required>
                                <i class="item-icon item-icon-right"><i class="fas fa-user-edit"></i></i>
                            </div>
                            @error('video_link')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group btn-form">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('master.add_new') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if($title_page !== 'admin_edit')
            <div class="col-xs-12">
                <div class="box-content bordered primary ">
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('master.Explanation_title')  }}</th>
                            <th>{{ __('master.Explanation_description') }}</th>
                            <th>{{ __('master.Explanation_section') }}</th>
                            <th>{{ __('master.Explanation_video_link') }}</th>
                            <th>{{ __('master.edit') }}</th>
                            <th>{{ __('master.delete') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($explanations as $explan)
                            <tr class="text-center">
                                <td>{{ $explan->id }}</td>
                                <td class="">
                                    {{ $explan->title ?? '-' }}
                                </td>
                                <td>
                                    {{ substr($explan->description , 0 , 100).'....' ?? '-' }}
                                </td>
                                <td>
                                    {{ __("master.".$explan->section) }}
                                </td>

                                <td class="">
                                    <button type="button" class="btn btn-info watch_video"
                                        data-video-id="{{ $explan->section }}"
                                        data-backdrop="static"
                                        data-keyboard="false"
                                        data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        {{ __('master.watch_video') }}
                                    </button
                                </td>
                                <td>
                                    <a class="btn btn-success btn-block"
                                        href="{{ url('dashboard/admin/store_settings/explanations/'.$explan->id.'/edit') }}">
                                        <span><i class="fas fa-user-edit"></i></span>
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action="{{ url('dashboard/admin/store_settings/explanations',['id'=>$explan->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"class="btn btn-danger btn-block" target="_blank">
                                                <span><i class="fas fa-user-times"></i></span>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @endif
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
                            columns: [ 0,2,3,4,5,6,7 ]
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
