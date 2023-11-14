@extends('dashboard.master')

@section('store_settings')
    current active
@endsection


@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/RWD-table-pattern/css/rwd-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal-default-theme.css') }}">
    <style>
        .box-content .dropdown.js__drop_down {
            top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="row small-spacing">
        <div class="col-xs-12">
            @if (count($errors) > 0)
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
        </div>
        <div class="col-xs-12">
            <div class="panel panel-default panel-small-title margin-bottom-20">
                <div class="panel-heading">
                    <h6 class="panel-title padding-10">{{ __('master.section_status') }}</h6>
                </div>
                <div class="panel-body margin-bottom-20">
                    <form method="POST"
                          action="{{ route('dashboard.admin.section.store', ['type' => 'feedback']) }}"
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
        </div>
        <div class="col-xs-12">
            <a href="{{ route('dashboard.admin.feedback.add') }}"
               class="btn btn-lg btn-block btn-primary waves-effect waves-light">
                <i class="ico ico-left fa fa-plus-circle"></i>
                <span>{{__('master.add_feedback')}}</span>
            </a>
        </div>
        <div class="clearfix margin-bottom-50"></div>
        <div class="col-xs-12">
            <div class="box-content">
                <h4 class="box-title">{{__('master.view')}} {{ __('master.'.$title_page) }}</h4>
                @forelse($feedbacks as $feedback)
                    <div class="col-lg-4 col-md-6">
                        <div class="box-contact">
                            <img src="{{ asset($feedback->image) }}"
                                 alt="feedback-{{ $feedback->id }}"
                                 class="avatar">
                            <h3 class="name margin-top-10">{{ $feedback['name_'.app()->getLocale()] }}</h3>
                            <h4 class="job"></h4>
                            <div class="text-muted">
                                <p class="margin-bottom-20">{{ $feedback['comment_'.app()->getLocale()] }}</p>
                                <ul class="contact-social list-inline">
                                    <li><a onclick="
                                                $('#input_delete_item').val('{{ $feedback->id }}');"
                                           type="button" data-remodal-target="modal_delete"
                                           class="btn btn-danger btn-circle waves-effect waves-light">
                                            <i class="ico fas fa-trash-alt"></i>
                                        </a></li>
                                    <li><a href="{{route('dashboard.admin.feedback.edit',[$feedback->id])}}"
                                           class="btn btn-info btn-circle waves-effect waves-light">
                                            <i class="ico fas fa-pencil-alt"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center">{{ __('master.no_data') }}</p>
                @endforelse
            </div>

        </div>
    </div>

    <div class="remodal" data-remodal-id="modal_delete" role="dialog" aria-labelledby="modal1Title"
         aria-describedby="modal1Desc">
        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
        <div class="remodal-content">
            <h2 id="modal1Title">{{ __('master.remove_item') }}</h2>
            <p id="modal1Desc">
                {{ __('master.remove_notice_item') }}
            </p>
            <form method="post" id="form_delete_item" action="">
                @csrf
                <input type="hidden" name="id" id="input_delete_item" value="">
            </form>
        </div>
        <button data-remodal-action="cancel" class="remodal-cancel">{{ __('master.cancel')}}</button>
        <button data-remodal-action="confirm" class="remodal-confirm"
                id="confirm_delete_item">{{ __('master.remove_item') }}</button>
    </div>
@endsection


@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/fileUpload.demo.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.min.js') }}"></script>
    <script>
        $('#confirm_delete_item').on('click', function () {
            $.ajax({
                type: 'POST',
                url: '{{ route("dashboard.admin.feedback.delete") }}',
                data: $('#form_delete_item').serialize(),
                success: function (data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        customClass: 'swal-wide',
                        timer: 3000
                    });
                    if (data.status) {
                        Toast.fire({
                            type: 'success',
                            title: '{{ __('master.Successfully') }}'
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: '{{ __('master.Fail') }}'
                        })
                    }
                }
            });
        });
    </script>
@endsection
{{--Developed Saed Z. Sinwar--}}