@extends('dashboard.master')


@section('store_settings')
    current active
@endsection

@section('head_tag')
    <style>
        .img_rounded i {
            font-size: 40px;
        }
    </style>
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <div class="row small-spacing">
                    <div class="col-xs-12">
                        <div class="row">
                            <a href="{{ route('dashboard.admin.pages.add') }}"
                               class="btn btn-lg btn-block btn-primary waves-effect waves-light">
                                <i class="ico ico-left fa fa-plus-circle"></i>
                                <span>{{__('master.add_page')}}</span>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix margin-bottom-50"></div>
                    <div class="col-xs-12">
                        <div class="row">
                            @forelse($pages as $page)
                                <div class="col-xs-12">
                                    <div class="box-content bordered primary margin-bottom-20">
                                        <div class="dropdown js__drop_down">
                                            <a href="#"
                                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="{{ route('dashboard.admin.pages.edit',['id'=>$page->id]) }}">
                                                        <span><i class="fas fa-user-edit"></i></span>
                                                        <span>{{ __('master.page_edit')}}</span>
                                                    </a>
                                                    <a href="{{ route('dashboard.admin.pages.delete',['id'=>$page->id]) }}">
                                                        <span><i class="fas fa-user-times"></i></span>
                                                        <span>{{ __('master.page_delete')}}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <h4 class="box-title">{{ __('master.page') }} #{{ $page['link'] }}</h4>
                                        <div class="profile-avatar">
                                            <h4>{{ $page['title_'.app()->getLocale()] ?? $page->id }}</h4>
                                            <p> {{ Str::limit($page['description_'.app()->getLocale()], 150, ' ...') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="no_data">
                                    <p><i class="fas empty fa-database fa-4x"></i></p>
                                    <p>{{ __('master.no_data') }}</p>
                                </div>
                                <div class="clearfix margin-bottom-50"></div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
{{--Developed Saed Z. Sinwar--}}