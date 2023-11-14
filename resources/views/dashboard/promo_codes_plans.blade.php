@extends('dashboard.master')

@section('plan_index')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.css') }}">
    <!-- FlexDatalist -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/flexdatalist/jquery.flexdatalist.min.css') }}">

    <!-- Popover -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/popover/jquery.popSelect.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/select2/css/select2.min.css') }}">

    <!-- Timepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.css') }}">

    <!-- Touch Spin -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/touchspin/jquery.bootstrap-touchspin.min.css') }}">

    <!-- Colorpicker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/colorpicker/css/bootstrap-colorpicker.min.css') }}">

    <!-- Datepicker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/datepicker/css/bootstrap-datepicker.min.css') }}">

    <!-- DateRangepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
    @if (session('message'))
        <div class="small-spacing">
            <div class="col-xs-12">
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ __('master.'.session('message')) }}</strong>
                </div>
            </div>
        </div>
    @endif
    <div class="col-xs-12">
        <div class="col-md-12 col-xs-12">
            <form method="post" action="{{ $route }}"
                  enctype="multipart/form-data">
                <input type="hidden" value="{{ $promo_code->id ?? ''}}" name="id">
                @csrf
                <div class="row">
                    <div class="col-xs-12 box-content">
                        <p><b>{{ __('master.promo_code') }}</b></p>
                        @if($title_page !== 'promo_code_edit')
                            <div class="form-group @error('plan_id') has-error @enderror">
                                <label class="control-label" for="plan_id">{{ __('master.plan') }}</label>
                                <select name="plan_id" class="form-control" id="plan_id">
                                    <option disabled selected> {{ __('master.packages') }} </option>
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan['name_'.app()->getLocale()] }}
                                            || {{ $plan->price }}$
                                        </option>
                                    @endforeach
                                </select>
                                @error('plan_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif
                        <div class="form-group  @error('code') has-error @enderror">
                            <label class="control-label" for="code">{{ __('master.code') }}</label>
                            <input id="code" name="code" type="text" class="form-control"
                                   value="{{ $promo_code->code ?? old('code')}}"/>
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('promo_code_start') has-error @enderror">
                            <label class="control-label"
                                   for="promo_code_start">{{ __('master.promo_code_start') }}</label>
                            <input type="text" class="form-control datepicker-autoclose"
                                   placeholder="mm/dd/yyyy"
                                   id="promo_code_start" name="promo_code_start"
                                   value=" {{ $promo_code ? $promo_code->FormatStart() : old('promo_code_start')}}">
                            @error('promo_code_start')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('promo_code_end') has-error @enderror">
                            <label class="control-label"
                                   for="promo_code_end">{{ __('master.promo_code_end') }}</label>
                            <input type="text" class="form-control datepicker-autoclose"
                                   placeholder="mm/dd/yyyy"
                                   id="promo_code_end" name="promo_code_end"
                                   value=" {{ $promo_code ? $promo_code->FormatEnd() : old('promo_code_end')}}">
                            @error('promo_code_end')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('discount_promo') has-error @enderror">
                            <label class="control-label" for="discount_promo">{{ __('master.discount') }}</label>
                            <input id="discount_promo" name="discount_promo" type="text" class="form-control"
                                   value="{{ $promo_code->discount ?? old('discount_promo')}}"/>
                            @error('discount_promo')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                      
                    </div>

                    <div class="col-xs-12 margin-bottom-30 text-center">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                            @if($title_page !== 'promo_code_edit')
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
    @if($title_page !== 'promo_code_edit')
        <div class="col-xs-12">
            @forelse($promo_codes as $promo_code)
                <div class="col-md-4 col-xs-12">
                    <div class="box-content bordered primary margin-bottom-20">
                        <div class="dropdown js__drop_down">
                            <a href="#"
                               class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('dashboard.admin.plans.promo_codes.edit',['id'=>$promo_code->id]) }}">
                                        <span><i class="fas fa-edit"></i></span>
                                        <span>{{ __('master.promo_code_edit')}}</span>
                                    </a>
                                    <a href="{{ route('dashboard.admin.plans.promo_codes.delete',['id'=>$promo_code->id]) }}">
                                        <span><i class="fas fa-trash-alt"></i></span>
                                        <span>{{ __('master.promo_code_delete')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <h4 class="box-title">{{ __('master.offer') }} #{{ $promo_code->id }}</h4>
                        <div class="profile-avatar">
                            <h3 class="nowrap-overlay">
                                <strong>{{ $promo_code->code }}</strong>
                            </h3>
                        </div>
                        <table class="table table-hover no-margin">
                            <tbody>
                            <tr>
                                <td>{{ __('master.plan') }}</td>
                                <td>
                                    <span class="notice notice-green">{{ $promo_code->plan['name_'.app()->getLocale()]}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.package_price') }}</td>
                                <td>
                                <span>
                                    {{ $promo_code->plan->price }} $
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.discount') }}</td>
                                <td>
                                <span>
                                    {{ $promo_code->discount }} $
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.times_use') }}</td>
                                <td>
                                    <span class="notice notice-danger">{{ count($promo_code->payments()->whereStatus(1)->get()) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('master.offer_start') }}</td>
                                <td>{{ Carbon\Carbon::parse($promo_code->start)->toDateTimeString() }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('master.offer_end') }}</td>
                                <td>{{ Carbon\Carbon::parse($promo_code->end)->toDateTimeString() }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="no_data">
                    <p><i class="fas empty fa-database fa-4x"></i></p>
                    <p>{{ __('master.no_data') }}</p>
                </div>
            @endforelse
        </div>
    @endif
@endsection

@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/fileUpload.demo.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/moment/moment.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/form.demo.js') }}"></script>

    @if($product['image'] ?? old('image'))
        <script>
            $("#input-file-preview").addClass('dropify');
            $("#input-file-preview").attr("data-height", 225);
            $("#input-file-preview").attr("data-default-file", "{{ old('image') }}");
            $("#input-file-preview").dropify();
        </script>
    @endif
@endsection
{{--Developed Saed Z. Sinwar--}}