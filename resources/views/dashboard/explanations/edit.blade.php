@extends('dashboard.master')

@section('store_settings')
    current active
@endsection
@section('head_tag')
    <style>
    html[dir="rtl"]  .watch_video
    {
        float: left;
        border-radius: 1px;
    }
    @media (min-width: 992px)
         .modal-lg {
            width: 90%;
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
                        {{ __('master.update_item') }}
                </h4>
                <div class="card-content">
                    <form method="POST" action="{{ url('dashboard/admin/store_settings/explanations/'.$explanation->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="input-states-1">{{ __('master.Explanation_title') }}</label>
                            <div class="form-with-icon">
                                <input name="title" type="text" class="form-control" id="input-states-1"
                                        value="{{ $explanation->title ?? '' }}" required>
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
                                 {{ $explanation->description ?? '' }}
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
                                        <option value="store_settings"  {{ $explanation->section == 'store_settings' ? 'selected' : ''  }}>{{ __('master.store_settings') }}</option>
                                        <option value="home"            {{ $explanation->section == 'home' ? 'selected' : ''  }}>{{ __('master.home') }}</option>
                                        <option value="orders"          {{ $explanation->section == 'orders' ? 'selected' : ''  }}>{{ __('master.orders')}}</option>
                                        <option value="products"        {{ $explanation->section == 'products' ? 'selected' : ''  }}>{{ __('master.products')}}</option>
                                        <option value="clients"         {{ $explanation->section == 'clients' ? 'selected' : ''  }}>{{ __('master.clients') }}</option>
                                        <option value="marketing"       {{ $explanation->section == 'marketing' ? 'selected' : ''  }}>{{ __('master.marketing') }}</option>
                                        <option value="reports"         {{ $explanation->section == 'reports' ? 'selected' : ''  }}>{{ __('master.reports')}}</option>
                                        <option value="subscription"    {{ $explanation->section == 'subscription' ? 'selected' : ''  }}>{{ __('master.subscription')}}</option>
                                        <option value="Wallet"          {{ $explanation->section == 'Wallet' ? 'selected' : ''  }}>{{ __('master.Wallet')}}</option>
                                        <option value="calculations"    {{ $explanation->section == 'calculations' ? 'selected' : ''  }}>{{ __('master.calculations') }}</option>
                                        <option value="our_platform"    {{ $explanation->section == 'our_platform' ? 'selected' : ''  }}>{{ __('master.our_platform') }}</option>
                                </select>

                            </div>
                            @error('section')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input-states-1">{{ __('master.Explanation_video_link') }}</label>

                            <button type="button" class="btn btn-info watch_video"
                                data-video-id="{{ $explanation->section }}"
                                data-backdrop="static"
                                data-keyboard="false"
                                data-toggle="modal"
                                data-target="#exampleModalCenter">
                                {{ __('master.watch_video') }}
                            </button

                        </div>

                        <div class="form-group @error('video_link') has-error @enderror">


                            <div class="form-with-icon">
                                <input name="video_link" type="text" class="form-control" id="input-states-1"
                                        value="{{ $explanation->video_link ?? '' }}" required>
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
                                        {{ __('master.edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br/>
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


@endsection
