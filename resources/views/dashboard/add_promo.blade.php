@extends('dashboard.master')

@section('promo_codes_index')
    current active
@endsection

@section('head_tag')
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
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/editor/summernote-lite.css') }}">
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
            <form method="post" action="{{ $route }}" autocomplete="off"
                  enctype="multipart/form-data">
                <input type="hidden" value="{{ $promo_code->id ?? ''}}" name="id">
                @csrf
                <div class="row">
                    <div class="col-xs-12 box-content">
{{--                        @if($title_page !== 'promo_code_edit')--}}
{{--                            <div class="form-group @error('product') has-error @enderror">--}}
{{--                                <label for="input-states-5">{{ __('master.product_name') }}</label>--}}
{{--                                <select name="product" class="form-control" id="input-states-5">--}}
{{--                                    <option disabled selected> {{ __('master.product_name') }} </option>--}}
{{--                                    @foreach($products as $product)--}}
{{--                                        <option value="{{$product->id}}">--}}
{{--                                            {{ $product['name_'.$product->store->getLang()] }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('product')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        @endif--}}
                            <div class="form-group  @error('code') has-error @enderror">
                                <label for="code">{{ __('master.code') }}</label>
                                <input required id="code" name="code" type="text" class="form-control"
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
                                <input required type="text" class="form-control datepicker-autoclose"
                                       placeholder="mm/dd/yyyy"
                                       id="promo_code_start" name="promo_code_start"
                                       value="{{ $promo_code ? $promo_code->FormatStart() : old('promo_code_start')}}">
                                @error('promo_code_start')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                            <div class="form-group  @error('promo_code_end') has-error @enderror">
                                <label class="control-label"
                                       for="promo_code_end">{{ __('master.promo_code_end') }}</label>
                                <input required type="text" class="form-control datepicker-autoclose"
                                       placeholder="mm/dd/yyyy"
                                       id="promo_code_end" name="promo_code_end"
                                       value="{{ $promo_code ? $promo_code->FormatEnd() : old('promo_code_end')}}">
                                @error('promo_code_end')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                            <div class="form-group  @error('type_discount') has-error @enderror">
                                <label for="type_promo_code">{{ __('master.type_discount') }}</label>
                                <select name="type_discount" class="form-control">
                                     <option value="0" {{ !empty($promo_code->type_discount) && ($promo_code->type_discount == 0) ? 'selected':'' }}>{{ __('master.By_Value') }}</option>
                                     <option value="1" {{ !empty($promo_code->type_discount) && ($promo_code->type_discount == 1) ? 'selected':'' }}>{{ __('master.By_Percent') }}</option>
                                </select>
                                @error('type_discount')
                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group  @error('discount_promo') has-error @enderror">
                                <label for="discount_promo">{{ __('master.discount') }}</label>
                                <input required id="discount_promo" name="discount_promo" type="text" class="form-control"
                                       value="{{ $promo_code->discount ?? old('discount_promo')}}"/>
                                @error('discount_promo')
                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group  @error('count') has-error @enderror">
                                <label for="count_using">{{ __('master.count_using') }}</label>
                                <input  id="count_using" name="count" type="number" class="form-control" placeholder="{{ __('master.unlimited') }}"
                                       value="{{ $promo_code->count ?? old('count')}}"/>
                                @error('count')
                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group  @error('count_used') has-error @enderror">
                                <label class="control-label" for="count_used">{{ __('master.count_used') }}</label>
                                <input id="count_used" name="count_used" type="text" class="form-control"
                                   value="{{ $promo_code->count_used ?? '0' }}" readonly/>
                            </div>
                    </div>

                    <div class="col-xs-12 margin-bottom-30 text-center">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                            @if($title_page !== 'product_edit')
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

@endsection

@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/moment/moment.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/form.demo.js') }}"></script>
@endsection
{{--Developed Saed Z. Sinwar--}}
