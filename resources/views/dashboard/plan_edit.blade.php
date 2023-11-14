@extends('dashboard.master')

@section('plan_index')
    current active
@endsection

@section('head_tag')
    <style>
        .col img {
            height: 100px;
            width: 100%;
            cursor: pointer;
            transition: transform 1s;
            object-fit: cover;
        }

        .col label {
            overflow: hidden;
            position: relative;
        }

        .imgbgchk:checked + label > .tick_container {
            opacity: 1;
        }

        .imgbgchk:checked + label > img {
            opacity: 0.3;
        }

        input.imgbgchk {
            display: contents;
        }

        .tick_container {
            transition: .5s ease;
            opacity: 0;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            cursor: pointer;
            text-align: center;
        }

        .tick {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            padding: 8px 12px;
            height: 40px;
            width: 40px;
            border-radius: 100%;
            display: block;
        }

        .title_design {
            padding: 15px 10px;
            font-weight: bold;
            display: block;
        }
        .table-plans-permisions
        {
            width: 80%;
        }
        .table-plans-permisions td
        {
            padding: 10px;
        }
        .select-props-permission select{
            width: 100%;
            border: 1px solid lightgray;
            height: 2.2em;
            background-color: #d9f3ff;
        }
        @media(max-width:1000px){
            .table-plans-permisions td
            {
               display:block; 
               box-sizing:border-box; 
               clear:both;
            }        
            .table-plans-permisions td{
                padding:1px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <div class="panel panel-default panel-small-title margin-bottom-20">
                    <div class="panel-heading">
                        <h6 class="panel-title padding-10">{{ __('master.plan_details') }}</h6>
                    </div>
                    <div class="panel-body margin-bottom-20">
                        <form method="post" action="{{ route('dashboard.admin.plans.update',['id'=> $plan->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group  @error('name_ar') has-error @enderror">
                                        <label for="name_ar">{{ __('master.package_name') . ' (' . __('master.arabic').')'  }}</label>
                                        <input id="name_ar" name="name_ar" type="text" class="form-control"
                                               value="{{ $plan->name_ar}}"
                                               placeholder="{{ __('master.package_name_ar_placeholder') }}"/>
                                        @error('name_ar')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  @error('description_ar') has-error @enderror">
                                        <label for="description_ar">{{ __('master.package_description') . ' (' . __('master.arabic').')'  }}</label>
                                        <textarea class="form-control" id="description_ar" rows="3"
                                                  name="description_ar"
                                                  placeholder="{{ __('master.package_description_ar_placeholder') }}">{{ $plan->description_ar}}</textarea>
                                        @error('description_ar')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  @error('name_en') has-error @enderror">
                                        <label for="name_en">{{ __('master.package_name') . ' (' . __('master.english').')'  }}</label>
                                        <input id="name_en" name="name_en" type="text" class="form-control"
                                               value="{{ $plan->name_en}}"
                                               placeholder="{{ __('master.package_name_en_placeholder') }}"/>
                                        @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  @error('description_en') has-error @enderror">
                                        <label for="description_en">{{ __('master.package_description') . ' (' . __('master.english').')'  }}</label>
                                        <textarea class="form-control" id="description_en" rows="3"
                                                  name="description_en"
                                                  placeholder="{{ __('master.package_description_en_placeholder') }}">{{ $plan->description_en}}</textarea>
                                        @error('description_en')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group  @error('name_fr') has-error @enderror">
                                        <label for="name_fr">{{ __('master.package_name') . ' (' . __('master.french').')'  }}</label>
                                        <input id="name_fr" name="name_fr" type="text" class="form-control"
                                               value="{{ $plan->name_fr}}"
                                               placeholder="{{ __('master.package_name_fr_placeholder') }}"/>
                                        @error('name_fr')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  @error('description_fr') has-error @enderror">
                                        <label for="description_fr">{{ __('master.package_description') . ' (' . __('master.french').')'  }}</label>
                                        <textarea class="form-control" id="description_fr" rows="3"
                                                  name="description_fr"
                                                  placeholder="{{ __('master.package_description_fr_placeholder') }}">{{ $plan->description_fr}}</textarea>
                                        @error('description_fr')`
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group  @error('price') has-error @enderror">
                                        <label for="price">{{ __('master.package_price') }}</label>
                                        <input id="price" name="price" type="text" class="form-control"
                                               value="{{ $plan->price }}"/>
                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  @error('offer_count') has-error @enderror">
                                        <label for="offer_count">{{ __('master.offer_count') }}</label>
                                        <input id="offer_count" name="offer_count" type="text" class="form-control"
                                               value="{{ $plan->offer_count }}"/>
                                        @error('offer_count')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  @error('order_count') has-error @enderror">
                                        <label for="order_count">{{ __('master.order_count') }}</label>
                                        <input id="order_count" name="order_count" type="text" class="form-control"
                                               value="{{ $plan->order_count }}"/>
                                        @error('order_count')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  @error('users_count') has-error @enderror">
                                        <label for="users_count">{{ __('master.users_count') }}</label>
                                        <input id="users_count" name="users_count" type="text" class="form-control"
                                               value="{{ $plan->users_count }}"/>
                                        @error('users_count')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-4 col-xs-12">
                                    <div id="toastTypeGroup">
                                        <div class="form-group  @error('language') has-error @enderror">
                                            <div class="switch primary margin-top-30 ">
                                                <input type="checkbox" name="language" id="language" value="1"
                                                       @if($plan->language) checked @endif>
                                                <label for="language">{{ __('master.multi_language') }}</label>
                                            </div>
                                            @error('language')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group  @error('ssl') has-error @enderror">
                                            <div class="switch primary margin-top-30">
                                                <input type="checkbox" name="ssl" id="ssl" value="1"
                                                       @if($plan->ssl) checked @endif>
                                                <label for="ssl">{{ __('master.ssl_support') }}</label>
                                            </div>
                                            @error('ssl')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group  @error('integration') has-error @enderror">
                                            <div class="switch primary margin-top-30">
                                                <input type="checkbox" name="integration" id="integration" value="1"
                                                       @if($plan->integration) checked @endif>
                                                <label for="integration">{{ __('master.integration_fb_google') }}</label>
                                            </div>
                                            @error('integration')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group  @error('custom_domain') has-error @enderror">
                                            <div class="switch primary margin-top-30">
                                                <input type="checkbox" name="custom_domain" id="custom_domain" value="1"
                                                       @if($plan->custom_domain) checked @endif>
                                                <label for="custom_domain">{{ __('master.custom_domain') }}</label>
                                            </div>
                                            @error('custom_domain')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group  @error('custom_design') has-error @enderror">
                                            <div class="switch primary margin-top-30">
                                                <input type="checkbox" name="custom_design" id="custom_design" value="1"
                                                       @if($plan->custom_design) checked @endif>
                                                <label for="custom_design">{{ __('master.custom_design') }}</label>
                                            </div>
                                            @error('custom_design')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 margin-top-30 text-center">
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                                        {{ __('master.update_data') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  here show properites of plan  -->
    
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <div class="panel panel-default panel-small-title margin-bottom-20">
                    <div class="panel-heading">
                        <h6 class="panel-title padding-10">{{ __('master.plan_details') }}</h6>
                    </div>
                    <div class="panel-body margin-bottom-20">
                        <form method="post" action="{{ route('dashboard.admin.plans.permissions',['id'=> $plan->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                     <table class="table-plans-permisions">
                                        
                                        @forelse($plan->plan_permissions()->chunk(3) as $permissions_chunk)
                                            <tr>
                                                @foreach( $permissions_chunk as $name => $permissions )
                                                    <td> 
                                                        @if ($loop->parent->last)
                                                            <div class="form-group select-props-permission ">
                                                                <label for="quantity">{{ __("master.{$name}") }}</label>
                                                                <input type="text"  class="form-control" id="{{ $name }}" name="{{ 'PlanPermission['.$name.']' }}" placeholder="{{ __('master.all') }}" value="{{ $permissions == 'unlimited' ? '':$permissions }}">
                                                            </div>
                                                        @else
                                                            <div class="form-group select-props-permission ">
                                                                <div class="margin-top-30">
                                                                    <label for="{{ $name }}">{{ __("master.{$name}") }}</label>
                                                                    <select type="checkbox" name="{{ 'PlanPermission['.$name.']' }}" >
                                                                        <option value="1"  {{ $permissions == 1  ? 'selected' : '' }}>{{ __('master.allow') }}</option>
                                                                        <option value="0"  {{ $permissions == 0  ? 'selected' : '' }}>{{ __('master.disallow') }}</option>
                                                                    </select>
                                                                    
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                             
                                                @endforeach
                                            </tr>
                                        @empty
                                           null
                                        @endforelse
                                        
                                     </table>
                                </div>
                                <div class="col-xs-12 margin-top-30 text-center">
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                                        {{ __('master.update_data') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if($plan->custom_design)
        <div class="col-xs-12">
            <div class="container">
                <div class="row">
                    <div class="panel panel-default panel-small-title margin-bottom-20">
                        <div class="panel-heading">
                            <h6 class="panel-title padding-10">{{ __('master.custom_design') }}</h6>
                        </div>
                        <div class="panel-body margin-bottom-20">
                            <form method="post"
                                  action="{{ route('dashboard.admin.plans.plan_design',['id'=> $plan->id]) }}">
                                @csrf
                                <div class="row">
                                    @foreach($designs as $design)
                                        <div class="col-md-4 col-xs-6">
                                            <div class='text-center'>
                                                <input type="checkbox" name="design[]" id="img{{ $loop->index }}"
                                                       class="d-none imgbgchk" value="{{$design->id}}" @if($design->check_plan($plan) == 1) checked @endif>
                                                <label for="img{{ $loop->index }}">
                                                    <span class="title_design">
                                                        {{$design->name}}
                                                    </span>
                                                    <img src="{{ asset($design->image) }}"
                                                         alt="design {{ $loop->index }}" width="200">
                                                    <span class="tick_container">
                                                        <span class="tick"><i class="fa fa-check"></i></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-xs-12 margin-top-30 text-center">
                                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                                            {{ __('master.update_data') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
{{--Developed Saed Z. Sinwar--}}
