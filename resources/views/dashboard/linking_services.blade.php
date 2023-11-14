@extends('dashboard.master')


@section('store_settings')
    current active
@endsection

@section('content')
    @if (session('message'))
        <div class="small-spacing">
            <div class="col-xs-12">
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ __('master.'.session('message')) }}</strong>
                </div>
            </div>
        </div>
    @endif
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                @if(!$integration)
                    <div class="col-xs-12">
                        <div class="panel panel-default panel-small-title">
                            <div class="panel-heading">
                                <h6 class="panel-title padding-10">{{ __('master.linking_services') }}</h6>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-8 col-md-offset-2 col-xs-12 text-center margin-top-30"
                                     style="float: left">
                                    <p>{{ __('master.package_cannot') }}</p>
                                    <p class="margin-top-30">
                                        <a href="{{ route('dashboard.admin.store_settings.upgrade_plan') }}"
                                           class="btn btn-primary btn-sm waves-effect waves-light">
                                            {{ __('master.upgrade_plan') }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
                <div class="col-md-6 col-xs-12">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">Facebook Pixel</h6>
                        </div>
                        <div class="panel-body">
                            @if($integration)
                                <form method="POST" action="{{ route('dashboard.admin.information.store') }}">
                                    @csrf
                                    @endif
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="card-content">
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="ig-1" class="btn btn-default">
                                                            <i class="fab fa-facebook-square"></i></label>
                                                    </div>
                                                    <input id="ig-1" type="text" class="form-control"
                                                           name="facebook_pixel_id"
                                                           value='{{ $information["facebook_pixel_id"] }}'
                                                           placeholder="Pixel ID">
                                                </div>
                                            </div>
                                            @if($integration)
                                                <div class="text-center">
                                                    <button type="submit"
                                                            class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                        {{ __('master.save') }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if($integration)
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">Google Tag Manager</h6>
                        </div>
                        <div class="panel-body">
                            @if($integration)
                                <form method="POST" action="{{ route('dashboard.admin.information.store') }}">
                                    @csrf
                                    @endif
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="card-content">
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="ig-1" class="btn btn-default">
                                                            <i class="fab fa-google"></i></label>
                                                    </div>
                                                    <input id="ig-1" type="text" class="form-control"
                                                           name="google_tag_manager"
                                                           value='{{ $information["google_tag_manager"] }}'
                                                           placeholder="Container ID">
                                                </div>
                                            </div>
                                            @if($integration)
                                                <div class="text-center">
                                                    <button type="submit"
                                                            class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                        {{ __('master.save') }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if($integration)
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                @role('SuperAdmin')
                <div class="col-md-12 col-xs-12">
                    <div class="panel panel-default panel-small-title">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">WhatsApp API INTEGRATION</h6>
                        </div>
                        <div class="panel-body">
                            @if($integration)
                                <form method="POST" action="{{ route('dashboard.admin.information.whatsapp') }}">
                                    @csrf
                                    @endif
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="card-content">
                                                <label>{{__("master.whatsapp_api_token")}}</label>
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="ig-1" class="btn btn-default">
                                                            <i class="fab fa-whatsapp"></i></label>
                                                    </div>
                                                    <input id="ig-1" type="text" class="form-control"
                                                           name="token"
                                                           value='{{ data_get(json_decode($whatsapp->value ??''),'token') }}'
                                                           placeholder="{{__("master.whatsapp_api_token")}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="card-content">
                                                <label>{{__("master.whatsapp_api_instance_id")}}</label>
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="ig-1" class="btn btn-default">
                                                            <i class="fab fa-whatsapp"></i></label>
                                                    </div>
                                                    <input id="ig-1" type="text" class="form-control"
                                                           name="instance_id"
                                                           value='{{ data_get(json_decode($whatsapp->value ??''),'instance_id') }}'
                                                           placeholder="{{__("master.whatsapp_api_instance_id")}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xs-12">
                                            <div class="card-content">
                                                <label>{{__("master.whatsapp_api_status")}}</label>
                                                <div class="input-group margin-bottom-20">
                                                    <div class="input-group-btn">
                                                        <label for="ig-1" class="btn btn-default">
                                                            <i class="fab fa-whatsapp"></i></label>
                                                    </div>
                                                    <select class="form-control" name="status">
                                                        <option
                                                                {{data_get(json_decode($whatsapp->value ??''),'status') == 1 ?'active':''}}
                                                                value="1">{{__("master.active")}}</option>
                                                        <option
                                                                {{data_get(json_decode($whatsapp->value ??''),'status') == 0 ?'active':''}}
                                                                value="0">{{__("master.disable")}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @if($integration)
                                                <div class="text-center">
                                                    <button type="submit"
                                                            class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                                        {{ __('master.save') }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if($integration)
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                @endrole
            </div>
        </div>
    </div>
@endsection
{{--Developed Saed Z. Sinwar--}}