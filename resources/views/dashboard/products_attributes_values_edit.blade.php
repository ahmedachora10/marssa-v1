@extends('dashboard.master')


@section('products_attributes_index')
    current active
@endsection

@section('head_tag')

   @endsection

@section('content')

    <div class="row small-spacing">
        <div class="col-xs-12">
            <div class="box-content bordered primary ">
                <form action="{{route('dashboard.admin.products.attributes.values.update',$value->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="col-xs-12 box-content">
                        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  @error('attribute_id') has-error @enderror">
                                <label for="attribute_id">{{ __('master.product_attribute') }}</label>
                                <select  id="attribute_id" name="attribute_id" class="form-control custom-select">
                                    <option value="" selected disabled>{{__('master.choose_product_attribute')}}</option>
                                    @foreach($attributes as $val)
                                    
                                    <option value="{{$val->id}}" {{$value->attribute_id == $val->id ? 'selected' : ''}}>
                                        {{$val['name_'.$store->getLang()]}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('attribute_id')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  @error('value') has-error @enderror">
                                <label for="value">{{ __('master.value') }}</label>
                                <input type="value" id="value" value="{{$value->value}}" name="value" class="form-control">
                                @error('value')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="d-flex justify-content-center text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="ico ico-left fa fa-edit"></i>
                            {{ __('master.edit') }}
                        </button>
                    </div>
                    </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
{{--Developed By Moayad Hassan--}}
