@extends('dashboard.master')


@section('store_settings')
    current active
@endsection

@section('head_tag')
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <div class="panel panel-default panel-small-title margin-bottom-20">
                    <div class="panel-heading">
                        <h6 class="panel-title padding-10">{{ __('master.store_information') }}</h6>
                    </div>
                    <div class="panel-body margin-bottom-20">
                        <form method="POST" action="{{ route('dashboard.admin.information.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 col-md-offset-3 col-xs-12" style="float: left">
                                <div class="row">
                                    <div class="col-xs-12">
                                        text
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--Developed Saed Z. Sinwar--}}