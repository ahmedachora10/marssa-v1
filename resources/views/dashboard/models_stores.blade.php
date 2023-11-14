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
                        <h6 class="panel-title padding-10">{{ __('master.section_status') }}</h6>
                    </div>
                    <div class="panel-body margin-bottom-20">
                        <form method="POST"
                              action="{{ route('dashboard.admin.section.store', ['type' => 'models_stores']) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="col-xs-12">
                                <ul class="list-inline text-center">
                                    <li>
                                        <div class="radio">
                                            <input type="radio" name="status" id="radio-1" value="0"
                                                   @if($section['status'] == 0) checked @endif>
                                            <label for="radio-1">{{ __('master.hide_home') }}</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio info">
                                            <input type="radio" name="status" id="radio-2" value="1"
                                                   @if($section['status'] == 1) checked @endif>
                                            <label for="radio-2">{{ __('master.show_home') }}</label>
                                        </div>
                                    </li>
                                </ul>
                                <div class="text-center">
                                    <button type="submit"
                                            class="btn btn-sm btn-success btn-rounded btn-bordered waves-effect waves-light">
                                        {{ __('master.save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <a href="{{ route('dashboard.admin.models.add') }}"
                           class="btn btn-lg btn-block btn-primary waves-effect waves-light">
                            <i class="ico ico-left fa fa-plus-circle"></i>
                            <span>{{__('master.add_model')}}</span>
                        </a>
                    </div>
                </div>
                <div class="clearfix margin-bottom-50"></div>
                <div class="row small-spacing">
                    <div class="col-xs-12">
                        <div class="row">
                            @forelse($models as $model)
                                <div class="col-md-6 col-xs-12">
                                    <div class="box-content bordered primary margin-bottom-20">
                                        <div class="dropdown js__drop_down">
                                            <a href="#"
                                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="{{ route('dashboard.admin.models.edit',['id'=>$model->id]) }}">
                                                        <span><i class="fas fa-user-edit"></i></span>
                                                        <span>{{ __('master.model_edit')}}</span>
                                                    </a>
                                                    <a href="{{ route('dashboard.admin.models.delete',['id'=>$model->id]) }}">
                                                        <span><i class="fas fa-user-times"></i></span>
                                                        <span>{{ __('master.model_delete')}}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <h4 class="box-title">{{ __('master.model') }} #{{ $model->id }}</h4>
                                        <div class="profile-avatar">
                                            <p class="text-center">
                                                <img class="img-rounded"
                                                     alt="image {{ $model['title_'.app()->getLocale()] }} model"
                                                     src="{{ asset($model['icon'] != '' ? $model['icon'] : 'dashboard/light/assets/images/sativa.png') }}">
                                            </p>
                                            <h3 class="nowrap-overlay">
                                                <strong>{{ $model['title_'.app()->getLocale()] ?? $model->id }}</strong>
                                            </h3>
                                            <p class="nowrap-overlay">{{ $model['description_'.app()->getLocale()] ?? __('master.no_data') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="no_data">
                                    <p><i class="fas empty fa-database fa-4x"></i></p>
                                    <p>{{ __('master.no_data') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
{{--Developed Saed Z. Sinwar--}}