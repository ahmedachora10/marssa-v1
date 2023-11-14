<div id="option_{{$index_property}}" class="col-xs-12 option" style="border: 1px solid #e4e7e9">
    <div class="row">
        <div class="col-xs-12" style="background:#e4e7e9;padding: 10px">
            <p><b>{{ __('master.property_number') . ' #' . $index_property}}</b></p>
        </div>
        <div class="col-xs-12" style="padding: 10px">
            <div class="col-xs-12 col-md-4">
                <div class="form-group">
                    <label for="input-states-6">{{ __('master.display_style') }}</label>
                    <select name="common_property" class="form-control" id="input-states-6">
                        <option disabled selected> {{ __('master.display_style') }} </option>
                        <option value="1">{{ __('master.radio_button') }}</option>
                        <option value="2">{{ __('master.dropdown_list') }}</option>
                        <option value="3">{{ __('master.textual_buttons') }}</option>
                        <option value="4">{{ __('master.color_based_buttons') }}</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-md-4">
                @foreach($language as $lang)
                    <div class="form-group">
                        <label for="property_{{$index_property}}_name_{{$lang}}">{{ __('master.option_name'). ' (' . __('master.'.$lang ).')' }}</label>
                        <input id="property_{{$index_property}}_name_{{$lang}}"
                               name="property_{{$index_property}}_name_{{$lang}}"
                               type="text"
                               class="form-control"
                               value="{{ old('property_'.$index_property.'_name_'.$lang)}}"/>
                    </div>
                @endforeach
            </div>

            <div class="col-xs-12 col-md-4">
                @foreach($language as $lang)
                    <div class="form-group">
                        <label for="property_{{$index_property}}_value_{{$lang}}">{{ __('master.values') . ' (' . __('master.'.$lang ).')' }}</label>
                        <textarea id="property_{{$index_property}}_value_{{$lang}}"
                                  class="property_values form-control"></textarea>
                    </div>
                @endforeach
            </div>

            {{--<div class="col-xs-12 col-md-4 common_property_div">--}}
            {{--<label for="option_{{$index_property}}">{{ __('master.option') }}</label>--}}
            {{--<input id="option_{{$index_property}}" name="option_{{$index_property}}" type="text"--}}
            {{--class="form-control"--}}
            {{--value="{{ old('option_'.$index_property)}}"/>--}}
            {{--@error('option_{{$index_property}}')--}}
            {{--<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
            {{--@enderror--}}
            {{--</div>--}}
            {{--<div class="col-xs-12 col-md-4 product_price">--}}
            {{--<label for="price_{{$index_property}}">{{ __('master.product_price') }}</label>--}}
            {{--<input id="price_{{$index_property}}" name="price_{{$index_property}}" type="text"--}}
            {{--class="form-control"--}}
            {{--value="{{ old('price_'.$index_property)}}"/>--}}
            {{--@error('price_{{$index_property}}')--}}
            {{--<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
            {{--@enderror--}}
            {{--</div>--}}
        </div>
    </div>
</div>

