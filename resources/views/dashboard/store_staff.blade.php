@extends('dashboard.master')

@section('store_settings')
    current active
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
        @if($users_count ?? 1 > count($users ?? []))
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
                        <form method="POST" action="{{ $route }}" autocomplete="off">
                            @csrf
                            <input type="hidden" value="{{ $user->id ?? ''}}" name="id">
                            <div class="form-group @error('name') has-error @enderror col-xs-12 col-md-6">
                                <label for="input-states-1">{{ __('master.full_name') }}</label>
                                <div class="form-with-icon">
                                    <input name="name" type="text" class="form-control" id="input-states-1"
                                           value="{{ $user->name ?? old('name') }}">
                                    <i class="item-icon item-icon-right"><i class="fas fa-user-edit"></i></i>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group @error('username') has-error @enderror col-xs-12 col-md-6">
                                <label for="input-states-2">{{ __('master.UserName') }}</label>
                                <div class="form-with-icon">
                                    <input name="username" type="text" class="form-control" id="input-states-2"
                                           value="{{ $user->username ?? old('username') }}">
                                    <i class="item-icon item-icon-right"><i class="fas fa-user-tag"></i></i>
                                </div>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group @error('email') has-error @enderror col-xs-12 col-md-6">
                                <label for="input-states-2">{{ __('master.email_address') }}</label>
                                <div class="form-with-icon">
                                    <input name="email" type="email" class="form-control" id="input-states-2"
                                           value="{{ $user->email ?? old('email') }}">
                                    <i class="item-icon item-icon-right"><i class="fas fa-envelope-open-text"></i></i>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            @if($title_page !== 'admin_edit')
                                <div class="form-group @error('password') has-error @enderror col-xs-12 col-md-6">
                                    <label for="input-states-4">{{ __('master.Password') }}</label>
                                    <div class="form-with-icon">
                                        <input name="password" type="password" class="form-control" id="input-states-4"
                                        >
                                        <i class="item-icon item-icon-right"><i class="fas fa-lock"></i></i>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif

                            <div class="form-group @error('status') has-error @enderror col-xs-12 col-md-6">
                                <label for="input-states-5">{{ __('master.user_status') }}</label>
                                <div class="form-with-icon">
                                    <select name="status" class="form-control" id="input-states-5">
                                        <option disabled selected> {{ __('master.user_status') }} </option>
                                        <option value="1"
                                                @if($title_page === 'admin_edit')
                                                @if($user->status) selected @endif
                                                @else
                                                @if(old('status') == '1') selected @endif
                                            @endif>
                                            {{ __('master.Active') }}
                                        </option>
                                        <option value="0"
                                                @if($title_page === 'admin_edit')
                                                @if(!$user->status) selected @endif
                                                @else
                                                @if(old('status') == '0') selected @endif
                                            @endif>
                                            {{ __('master.Inactive') }}
                                        </option>
                                    </select>
                                    <i class="fa fa-star item-icon item-icon-right"></i>
                                </div>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                            <div class="form-group @error('status') has-error @enderror col-xs-12 col-md-6">
                                <label for="input-states-5">{{ __('master.branch') }}</label>
                                <div class="form-with-icon">
                                    <select name="branch_id" class="form-control" id="input-states-5">
                                        <option disabled selected> {{ __('master.branch') }} </option>
                                         @foreach( auth()->user()->store->branches as $branch )
                                            <option value="{{ $branch->id }}"
                                            {{ ($title_page == 'admin_edit') && ($branch->id == $user->branch_id) ? 'selected' :''}}
                                            > {{ $branch->name }}</option>
                                         @endforeach
                                    </select>
                                    <i class="fas fa-map-marker item-icon item-icon-right"></i>
                                </div>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group @error('mobile') has-error @enderror col-xs-12 col-md-6">
                                <label for="input-states-6">{{ __('master.mobile') }}</label>
                                <div class="form-with-icon">
                                    <input name="mobile" type="text" class="form-control" id="input-states-6"
                                           value="{{ $user->mobile ?? old('mobile') }}">
                                    <i class="item-icon item-icon-right"><i class="fas fa-mobile"></i></i>
                                </div>
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group row mb-0" style="float: left;width: 100%;">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        @if($title_page !== 'admin_edit')
                                            {{ __('master.add_new') }}
                                        @else
                                            {{ __('master.update_item') }}
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if($title_page !== 'admin_edit')
            <div class="col-xs-12">
                <div class="box-content bordered primary ">
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>أسم</th>
                            <th>صورة</th>
                            <th>{{ __('master.full_name') }}</th>
                            <th>{{ __('master.user_status') }}</th>
                            <th>{{ __('master.store_name') }}</th>
                            <th>{{ __('master.branch') }}</th>
                            <th>{{ __('master.email_address') }}</th>
                            <th>{{ __('master.mobile') }}</th>
                            <th>{{ __('master.permission') }}</th>
                            <th>{{ __('master.date_created') }}</th>
                            <th>{{ __('master.user_edit') }}</th>
                            <th>{{ __('master.user_delete') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="text-center">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username ?? __('master.no_data') }}</td>
                                <td>
                                    <img class="img-rounded"
                                         alt="image {{ $user->name }} user"
                                         src="{{ asset($user->image ?? 'dashboard/light/assets/images/sativa.png') }}">
                                </td>
                                <td>{{ $user->name ?? __('master.no_data') }}</td>
                                <td>
                                    @if($user->status)
                                        <span class="notice notice-green">{{ __('master.Active') }}</span>
                                    @else
                                        <span class="notice notice-danger">{{ __('master.Inactive') }}</span>
                                    @endif
                                </td>
                                <td>{{ $user->store()->first()->name ?? '' }}</td>
                                <td>{{ $user->branch->name ?? '' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    @if($user->getRoleNames()[0] == 'User')
                                        <span class="notice notice-yellow">{{ $user->getRoleNames()[0] }}</span>
                                    @else
                                        <span class="notice notice-purple">{{ $user->getRoleNames()[0] }}</span>
                                    @endif
                                </td>
                                <td>{{ Carbon\Carbon::parse($user->created_at)->toFormattedDateString() }}</td>
                                @if($loop->index != 0)
                                    <td><a class="btn btn-success btn-block" target="_blank"
                                           href="{{ route('dashboard.admin.administrator.admin_edit',['id'=>$user->id]) }}">
                                            <span><i class="fas fa-user-edit"></i></span>
                                        </a></td>
                                    <td><a class="btn btn-danger btn-block" target="_blank"
                                           href="{{ route('dashboard.admin.administrator.delete',['id'=>$user->id]) }}">
                                            <span><i class="fas fa-user-times"></i></span>
                                        </a></td>
                                @else
                                    <td>-</td>
                                    <td>-</td>
                                @endif

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
