@extends('dashboard.master')
@section('store_settings')
    current
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/styles/store_settings.css') }}">
    <style>
        .fa, .fas {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="row small-spacing">
        <div class="col-xs-12">
            @if (session('error'))
                <div class="row">
                    <div class="small-spacing">
                        <div class="col-xs-12">
                            <div class="alert alert-error alert-dismissible"
                                 role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{!! __('master.'.session('error')) !!}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-xs-12">
            <div class="store-setup-row">
                <div class="col-xs-6 col-md-6">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.analyze.stores') }}">
                                <i class="fas fa-store"></i>
                                <p>المتاجر</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-6">
                    <div class="store-setup-item">
                        <i class="sicon-settings"></i>
                        <div>
                            <a class="waves-effect" href="{{ route('dashboard.admin.analyze.platform') }}">
                                <i class="fas fa-store"></i>
                                <p>المنصة</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
