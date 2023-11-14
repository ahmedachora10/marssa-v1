@extends('dashboard.master')

@section('offers_index')
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
                <input type="hidden" value="{{ $offer->id ?? ''}}" name="id">
                @csrf
                <div class="row">
                    <div class="col-xs-12 box-content">
                        @if($title_page !== 'offer_edit')
                            <div class="form-group @error('product') has-error @enderror">
                                <label for="input-states-5">{{ __('master.product_name') }}</label>
                                <select name="product" class="form-control" id="input-states-5" required>
                                    <option value="" disabled selected> {{ __('master.product_name') }} </option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">
                                            {{ $product['name_'.$product->store->getLang()] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif
                        <div class="form-group @error('offer_start') has-error @enderror">
                            <label class="control-label"
                                   for="offer_start">{{ __('master.offer_start') }}</label>
                            <input required type="text" class="form-control datepicker-autoclose"
                                   id="offer_start" placeholder="mm/dd/yyyy" name="offer_start"
                                   value="{{ $offer ? $offer->FormatStart() : old('offer_start')}}">
                            @error('offer_start')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('offer_end') has-error @enderror">
                            <label class="control-label" for="offer_end">{{ __('master.offer_end') }}</label>
                            <input required type="text" class="form-control datepicker-autoclose"
                                   id="offer_end" placeholder="mm/dd/yyyy" name="offer_end"
                                   value="{{ $offer ? $offer->FormatEnd() : old('offer_end')}}">
                            @error('offer_end')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('discount_offer') has-error @enderror">
                            <label for="discount_offer">{{ __('master.new_price_after_discount') }}</label>
                            <input required id="discount_offer" name="discount_offer" type="text" class="form-control"
                                   value="{{ $offer->discount ?? old('discount_offer')}}"/>
                            @error('discount_offer')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 margin-bottom-30 text-center">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                            @if($title_page !== 'offer_edit')
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
