@extends('dashboard.master')

@section('plan_index')
    current active
@endsection
@section('content')
<div class="col-xs-12">
    <div class="container">
       <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default panel-small-title">
                    <div class="panel-heading">
                        <h6 class="panel-title padding-10">{{ __("master.$section") }}</h6>
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
        </div>
    </div>
</div>
@endsection