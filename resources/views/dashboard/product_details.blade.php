@extends('dashboard.master')

@section('products_add')
    current active
@endsection
@section('head_tag')
  
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/editor/summernote-lite.css') }}">
    <link rel="stylesheet" href="{{asset('select2/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('select2/select2-bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"
     integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    @if(app()->getLocale()=='ar')
        <style>
            .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__clear{
                left: 0.7em!important;
                right: auto!important;
            }
            .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice{
                float:right !important;
            }
        </style>
    @else
        <style>
            .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__clear{
                right: 0.7em!important;
                left: auto !important;
            }
            .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice{
                float:left !important;
            }
        </style>
        </style>    
    @endif
    <style>

    .dropzone {
        border: 2px dashed #dedede;
        border-radius: 5px;
        background: #f5f5f5;
    }

    .dropzone i{
        font-size: 5rem;
    }

    .dropzone .dz-message {
        color: rgba(0,0,0,.54);
        font-weight: 500;
        font-size: initial;
        text-transform: uppercase;
    }
    .dropzone .dz-message:before{
        content:"" !important;
    }
    
    div#price_before {
    display: none;
}


        .dropify-wrapper {
            height: 150px;
        }

        .tag-editor {
            line-height: 24px;
            padding: 7px 14px;
            min-height: 45px;
            border-color: #ccd1d9;
            box-shadow: none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            border-radius: 2px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
        }

        .disable {
            display: none;
        }

        #files-area {
            width: 30%;
            margin: 0 auto;
        }

        .file-block {
            border-radius: 10px;
            background-color: rgba(144, 163, 203, 0.2);
            margin: 5px;
            color: initial;
            display: inline-flex;

        &
        > span.name {
            padding-right: 10px;
            width: max-content;
            display: inline-flex;
        }

        }
        .file-delete {
            display: flex;
            width: 24px;
            color: initial;
            background-color: #6eb4ff00;
            font-size: large;
            justify-content: center;
            margin-right: 3px;
            cursor: pointer;

        &
        :hover {
            background-color: rgba(144, 163, 203, 0.2);
            border-radius: 10px;
        }

        &
        > span {
            transform: rotate(45deg);
        }

        }
        .loader {
            position: absolute;
            background: #fff;
            height: 100%;
            width: 100%;
            top: 0;
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
            align-content: center;
        }

        .spinner-border {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: text-bottom;
            border: .25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: spinner-border .75s linear infinite;
            animation: spinner-border .75s linear infinite;
        }

        @keyframes spinner-border {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    </style>
    @if(app()->isLocale('ar'))
        <style>
            .tag-editor li {
                float: right;
                display: flex;
            }

            .tag-editor-hidden-src {
                right: -99999px;
                left: auto;
            }
        </style>
    @endif
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
    @PlanPermissions('count-products',$prod->count() )
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <form method="post" action="{{ $route }}" autocomplete="off"
                  id="product_form"
                  enctype="multipart/form-data">
                <input type="hidden" value="{{ $product->id ?? ''}}" name="id" id="product_id">
                @csrf
                <div class="row">
                    <div class="@if($title_page=='add_new')  col-md-9 @else @if($title_page =='product_edit') @if($product->type=='single') col-md-9  @else col-md-6 @endif @endif @endif" id="name_image">
                        <div class="box-content">
                            <p>
                                <b>{{ __('master.product_information') }}</b>
                                <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                      title="{{ __('master.required_data') }}">*</span>

                            </p>
                            @if($title_page !== 'product_edit')
                                {{ __('master.add_new_product') }}
                            @else
                                {{ __('master.update_item') }}
                            @endif

                            <hr>{{--
                            <div class="row">
                                <div class="form-group custom-file-container">
                                     <label class="box-title">
                                        <span>{{ __('master.featured_image')}}</span>
                                        <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                              title="{{ __('master.required_data') }}">*</span>
                                        <span class="hint"> 700x800</span>
                                    </label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" name="featured_image" 
                                            class="custom-file-container__custom-file__custom-file-input image"
                                            accept="image/png, image/jpeg, image/gif"
                                                aria-label="{{ __('master.featured_image') }}"
                                         id="featured_image">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span
                                            class="custom-file-container__custom-file__custom-file-control aaa"
                                        >Choose File ...</span>
                                    </label>
                                    <img src="https://semantic-ui.com/images/wireframe/image.png "
                            style="width: 100%;height:250px;max-height:250px;"
                            class="img-thumbnail image-preview" alt="">
                                    @error('featured_image')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>--}}
                            <div class="row">

                                <div class="form-group @error('image') has-error @enderror">
                                    <label class="box-title">
                                        <span>{{ __('master.product_image')}}</span>
                                        <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                              title="{{ __('master.required_data') }}">*</span>
                                        <span class="hint"> 700x800</span>
                                    </label>
                                    <div class="card-content">
                                        @include("dashboard.components.fileUploadDzone",['product'=>$product ?? []])
                                        <!--@include("dashboard.components.fileUpload0",['product'=>$product?? []])
                                         @include("dashboard.components.fileUpload",['product'=>$product?? []]) -->

                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>


                                @foreach($language as $lang)

                                    <div class="@if(count($language) == 3) col-md-4 @endif col-xs-12">
                                        <div class="form-group  @error('name_{{$lang}}') has-error @enderror">
                                            <label for="name_{{$lang}}">{{ __('master.product_name') . ' (' . __('master.'.$lang ).')'  }}</label>
                                            <input id="name_{{$lang}}" name="name_{{$lang}}" type="text"
                                                   class="form-control"
                                                   value="{{ $product["name_$lang"] ?? old("name_$lang")}}"
                                                   placeholder="{{ __('master.product_name_'.$lang.'_placeholder') }}"
                                                   required/>
                                            @error('name_{{$lang}}')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <textarea id="content_{{$lang}}" title="content_{{$lang}}"
                                                  name="content_{{$lang}}">{{ $product["content_$lang"] ?? old("content_$lang")}}</textarea>

                                    </div>
                                @endforeach
                            </div>
                            
                        </div>


                    </div>

                    <div class="@if($title_page=='add_new')  col-md-3 @else @if($title_page =='product_edit') @if($product->type=='single')  col-md-3  @else col-md-6 @endif @endif @endif" id="price_qty">

                        <div class="row box-content">
                            <p><b>{{__('master.product_type')}}
                                            <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                                  title="{{ __('master.required_data') }}">*</span></b></p>
                            <div class="form-group  @error('status1') has-error @enderror">
                                <div class="switch primary margin-top-30 ">
                                    <input type="checkbox" name="status1" id="status1"
                                           value="1"
                                           @if(!isset($product->status1))
                                           checked
                                           @else
                                           @if($product->status1)
                                           checked
                                            @endif
                                            @endif
                                    >
                                    <label for="status1">
                                        {{ __('master.product_price_before') }}
                                        <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                              title="{{ __('master.required_data') }}">*</span>
                                    </label>
                                </div>
                                @error('status1')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                             <div class="form-group" id="price_before" 
                                           @if(!isset($product->status1))
                                           style="display:block"
                                           @else
                                           @if($product->status1)
                                           style="display:block"
                                            @endif
                                            @endif>
                                <label for="price_before">{{ __('master.product_price_before') }}
                                    <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                          title="{{ __('master.required_data') }}"></span>
                                </label>
                                <input id="price" name="price_before" type="number" class="form-control"
                                       value="{{ $product->price_before ?? old('price_before')}}"/>

                            </div>
                            <div class="form-group  @error('price') has-error @enderror">
                                <label for="price">{{ __('master.product_price') }}
                                    <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                          title="{{ __('master.required_data') }}">*</span>
                                </label>
                                <input id="price"  name="price" type="number" class="form-control"
                                       value="{{ $product->price ?? old('price')}}"/>
                                @error('price')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                              <div class="form-group  @error('quantity') has-error @enderror">
                                <label for="product_quantity">{{ __('master.product_quantity') }} 
                                    <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                          title="{{ __('master.required_data') }}">*</span>
                                </label>
                                <input  id="product_quantity" name="quantity" type="number"
                                       class="form-control"
                                       value="{{ $product->quantity ?? old('quantity')}}"/>
                                @error('quantity')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            
                            <div class="form-group  @error('status') has-error @enderror">
                                <div class="switch primary margin-top-30 ">
                                    <input type="checkbox"  id="status" name="status"
                                           value="1"
                                           @if(!isset($product->status))
                                           checked
                                           @else
                                           @if($product->status)
                                           checked
                                            @endif
                                            @endif
                                    >
                                    <label for="status">{{ __('master.product_status') }}
                                        <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                              title="{{ __('master.required_data') }}">*</span>
                                    </label>
                                </div>
                                @error('status')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                             <label for="variant">{{__('master.product_type')}}</label>
                               
                            <div class="d-flex" style="display: inline-flex;justify-content: start;width: 100%;">
                                <div class="form-group   @error('variant') has-error @enderror" style="margin: 0px 15px;">
                                      <input type="radio" name="variant" id="single"
                                               value="single" 
                                               @if($title_page=='add_new')
                                               checked
                                               @else
                                               @isset($product)
                                                @if($product->type=='single')
                                                    checked
                                                @endif
                                               @endisset
                                               @endif
                                        >
                                        <label for="variant">
                                            {{ __('master.single') }}
                                        </label>
                                    @error('variant')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group   @error('variant') has-error @enderror"style="margin: 0px 15px;">
                                    <input type="radio" name="variant" id="variant"
                                               value="variant"
                                               @if($title_page=='product_edit')
                                               @isset($product)
                                                @if($product->type == 'variant')
                                                    checked
                                                @endif
                                               @endisset
                                               @endif
                                        >
                                        <label for="variant">
                                            {{ __('master.variant') }}
                                        </label>
                                    @error('variant')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                           <div id="singleDiv" class="@if($title_page=='product_edit')  @if($product->type=='variant') hidden @endif @endif">
                               
                           </div>
                           <div id="variantDiv" class="@if($title_page=='product_edit') @isset($product) @if($product !=null && $product->type =='single') hidden @endif  @endisset @else hidden @endif">
  {{--     <div class="form-group" id="price_before" 
                                           @if(!isset($product->status1))
                                           style="display:block"
                                           @else
                                           @if($product->status1)
                                           style="display:block"
                                            @endif
                                            @endif>
                                <label for="price_before">{{ __('master.product_price_before') }}
                                    <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                          title="{{ __('master.required_data') }}"></span>
                                </label>
                                <input id="price" name="price_before" type="number" class="form-control"
                                       value="{{ $product->price_before ?? old('price_before')}}"/>

                            <div class="form-group  @error('price') has-error @enderror">
                                <label for="price">{{ __('master.product_price') }}
                                    <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                          title="{{ __('master.required_data') }}">*</span>
                                </label>
                                <input id="price"  name="price" type="number" class="form-control"
                                       value="{{ $product->price ?? old('price')}}"/>
                                @error('price')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                           </div>
                            <div class="form-group  @error('quantity') has-error @enderror">
                                <label for="product_quantity">{{ __('master.product_quantity') }}
                                    <span class="text-danger" data-toggle="tooltip" data-placement="top"
                                          title="{{ __('master.required_data') }}">*</span>
                                </label>
                                <input  id="product_quantity" name="quantity" type="number"
                                       class="form-control"
                                       value="{{ $product->quantity ?? old('quantity')}}"/>
                                @error('quantity')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            --}}
                                    <div class="form-group">
                                              {{-- @foreach ($attributes as $attr )
                                               
                                                @if($title_page=='product_edit')
                                                    @foreach ($product->attributes as $attr1 )
                                                        @if($attr->id == $attr1->attribute_id) 
                                                      {{$attr->id}} - {{ $attr1->attribute_id}} selected
                                                        @endif 
                                                    @endforeach
                                                @endif
                                                 @endforeach --}}
                                        <label for="attributes">{{__('master.product_attributes')}}</label>
                                        <select class=" form-control select2-multi" name="attributes[]" id="attributes" multiple="multiple">
                                            @foreach ($attributes as $attr )
                                                <option value="{{$attr->id}}"
                                                @if($title_page=='product_edit')
                                                    @foreach ($product->attributes as $attr1 )
                                                        @if($attr->id == $attr1->attribute_id) 
                                                        selected="selected" 
                                                        @endif 
                                                    @endforeach
                                                @endif
                                                >{{$attr['name_'.app()->getLocale()]}}</option>
                                            @endforeach
                                        </select>
                                        <span id="opr_type" class="hidden">@if($title_page =='product_edit') edit @else add @endif</span>
                                    </div>                    
                                    <div class="searching_div mt-4" id="searching_div">
                                        @if($title_page =='add_new')
                                            @include('dashboard.attrValues',['values'=>null ?? null,'pvalues'=>$product->attributes?? null,'product'=>$product ?? null,'type'=>'add'])
                                        @else
                                            @include('dashboard.attrValues',['values'=> $attributes,'pvalues'=>$product->attributes?? null,'product'=>$product ?? null,'type'=>'edit','page_type'=>'first'])
                                        @endif
                                    </div>
                                </div>
                        <!--<div class="form-group  @error('negotiation') has-error @enderror">

                                    <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01"><strong>{{ __('master.product_options') }}</strong></label>
                                          </div>
                                          <select name="negotiation" class="custom-select" id="inputGroupSelect01" required>
                                            @if(isset($product->negotiation))
                            <option value="0" {{($product->negotiation == 0) ? 'selected' : ''}}>
                                            {{ __('master.no_product_negotiation') }}</option>

                                            <option value="1" {{($product->negotiation == 1) ? 'selected' : ''}}>{{ __('master.product_negotiation') }}</option>
                                            @else
                            <option value="0">
{{ __('master.no_product_negotiation') }}</option>

                                            <option value="1">{{ __('master.product_negotiation') }}</option>

                                            @endif
                                </select>
                              </div>


@error('negotiation')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>-->


                        </div>

                        <div class="row box-content">
                            <p><b>{{ __('master.category') }}</b></p>
                            <hr>
                            @if(count($categories) > 0)
                                <div class="form-group @error('category') has-error @enderror">
                                    <label for="input-states-5">{{ __('master.category_exists') }}</label>
                                    <select name="category" class="form-control" id="input-states-5"
                                            value="{{old('category')}}">
                                        <option disabled selected> {{ __('master.category') }} </option>
                                        @if($title_page === 'product_edit')
                                            @if($product->category_id)
                                                <option value=""> {{ __('master.without_category') }} </option>
                                            @endif
                                        @endif

                                        @if($title_page === 'product_edit')
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @if($title_page === 'product_edit')
                                                        @if($product->category_id == $category->id) selected @endif

                                                        @endif>
                                                    {{ $category['name_'.app()->getLocale()] }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @if(old('category') == $category->id) selected @endif>
                                                    {{ $category['name_'.app()->getLocale()] }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <hr>
                            @endif
                            @foreach($language as $lang)
                                <div class="form-group @error('new_category_{{$lang}}') has-error @enderror">
                                    <label for="new_category_{{$lang}}">{{ __('master.new_category'). ' (' . __('master.'.$lang ).')' }}</label>
                                    <input id="new_category_{{$lang}}" name="new_category_{{$lang}}" type="text"
                                           class="form-control"
                                           value="{{ old('new_category_'.$lang.'')}}"/>
                                    @error('new_category_{{$lang}}')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>


                        <div class="row box-content">
                            <div class="text-center">
                                <button type="submit" id="product_submit"
                                        class="btn btn-success btn-sm waves-effect waves-light">
                                    @if($title_page !== 'product_edit')
                                        {{ __('master.add_new_product') }}
                                    @else
                                        {{ __('master.update_item') }}
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @isset($product)
        <div class="col-md-12 col-xs-12">
            <div class="col-md-9">
                <div class="row box-content">
                <p><b>{{ __('master.product_images') }}</b></p>
                <hr>
                <div class="row">
                    @foreach($product->image ?? [] as $img)
                    <div class="col-md-4">
                        <img src="{{asset($img)}}" alt="" class="img-fluid" style="width: 100%;height: 300px;max-height: 300px;">
                        <div style="display: flex;">
                        <form action="{{ route('dashboard.admin.products.featured_image')}}" method="post" 
                        style="padding-bottom: 10px;padding-top: 10px;margin-left: 5px;margin-right: 5px;">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="id">
                            <input type="hidden" value="{{$img}}" name="featured_image">
                            <button type="submit" class="btn btn-primary "><i class="fas fa-image"></i>   {{__('master.featured_image')}}</button>
                        </form>
                        <form action="{{ route('dashboard.admin.products.remove_image')}}" method="post" style="padding-bottom: 10px;padding-top: 10px;margin-left: 5px;margin-right: 5px;">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="id">
                            <input type="hidden" value="{{$img}}" name="featured_image">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>   {{__('master.delete')}}</button>
                        </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="row box-content">
                <p><b>{{ __('master.featured_image') }}</b></p>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <img src="@if(!empty($product->featured_image )){{ asset($product->featured_image)}} @else https://semantic-ui.com/images/wireframe/image.png @endif" alt="" class="img-fluid" style="width: 100%;height: 200px;">
                        <form action="{{ route('dashboard.admin.products.featured_image')}}" method="post" style="padding-bottom: 10px;padding-top: 10px;">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="id">
                            <input type="hidden" value="" name="featured_image">
                            <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-trash"></i>     {{__('master.delete')}}</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @endisset
    </div>
    @else
        <div class="col-xs-12">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default panel-small-title">
                            <div class="panel-heading">
                                <h6 class="panel-title padding-10">{{ __("master.$title_page") }}</h6>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-8 col-md-offset-2 col-xs-12 text-center margin-top-30"
                                     style="float: left">
                                    <p>{{ __('master.package_cannot') }}</p>
                                    <p class="margin-top-30">
                                        <a href="{{ route('dashboard.admin.store_settings.upgrade_plan') }}"
                                           class="btn btn-primary btn-sm waves-effect waves-light">
                                            {{ __('master.upgrade_plan') }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endPlanPermissions
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{asset('select2/select2.min.js')}}" ></script>
        <script>
        
     let vals=[];
        $('.select2').select2({
                theme: 'bootstrap4'});
        $('.select2-multi').select2({
                theme: 'bootstrap4',
            multiple: true,
            placeholder: "{{__('master.select_attributes')}}",
            allowClear: true
        });
       
        $('#attrs >tbody >tr >input[name=attr]').on('change',function(){
             var id = $(this).val();
             //$(this).find('option').not(':first').remove();
        });
        
    function selectAll(id,check){
        console.log(id,check)
        let attrsval=document.getElementsByClassName("attr-"+id);
        for(var i=0;i<attrsval.length;i++){
            attrsval.item(i).checked=check ;
        }
    }
    function getCombn(arr,pre){
        pre=pre || '';
        if(!arr.length){
            return pre;
        }
            var ans=arr[0].reduce(function(ans,val){
                return ans.concat(getCombn(arr.slice(1),pre +'_'+ val));
            },[]);
            return ans;
    }
    function search(nameKey, myArray){
        for (let i=0; i < myArray.length; i++) {
            if (myArray[i].name === nameKey) {
                return myArray[i];
            }
        }
    }
    function addVariants(e){
    //here I want to prevent default
    e = e || window.event;
    e.preventDefault();
      //  e.preventDefault();
        let attrs=document.getElementsByClassName("attribute");
        let arr=[];
        console.log('attribute',$('.attribute').val());
        //
        let variants=document.getElementById('variants');
        var tableRows = variants.getElementsByTagName('tr');
            if(variants.rows.length > 0){
                for (var i = 1; i < variants.rows.length; i++) {
                  //  console.log(i)
                    variants.deleteRow(i);
                } 
                
                while(variants.rows.length > 1) {
                    variants.deleteRow(1);
                    }
            }
                
        for(var i=0;i<attrs.length;i++){
        //console.log('attrs',attrs.length,i);
                let attrId=attrs.item(i).value;
                //console.log('attrId',attrId);
                arr[i]=[];
                let attrsval=document.getElementsByClassName("attr-"+attrId);
                //console.log('attrsval',attrsval.length)
                for(var i1=0;i1<attrsval.length;i1++){
                 //   console.log('i1 attrsval',i1,attrsval)
            if(attrsval.item(i1).checked){
                    let valId=attrsval.item(i1).value;
                  //  console.log('val',valId)
                    arr[i].push(valId);
                }
            }
            console.log('arr',JSON.stringify(arr))
            
            let comb=getCombn(arr);
            console.log('comb',JSON.stringify(comb));
        let page_Type='{{$title_page}}';
        let variations= <?php if(isset($product)){ echo json_encode($product->variations); } else echo '[]'; ?>;
            for(var p =0;p<comb.length;p++){
                
                 /*if(page_Type=='product_edit') {
                        for(var p1 =0;p1<variations.length;p1++){
                            //    console.log('variant',variations[p1],' - ',comb[p],' - ',comb[p].substr(1))
                            if(variations[p1][name]==comb[p].substr(1) )
                            {
                                console.log('variant',variations[p1][name],' - ',comb[p].substr(1));
                                
                                var row=variants.insertRow(rown);
                                var cell1=row.insertCell(0);
                                var cell2=row.insertCell(1);
                                var cell3=row.insertCell(2);
                                var cell4=row.insertCell(3);
                                cell1.innerHTML=comb[p].substring(1) + '<input type="hidden" class="form-control" name="names[]" id="names" placeholder="Name" value="'+variations[p1][name]+'">';
                                cell2.innerHTML=`<input type="number" class="form-control" name="prices[]" min="1" step="any" id="prices" placeholder="{{__('master.price')}}"value="${variations[p1][price]}">`;
                                cell3.innerHTML=`<input type="number" class="form-control" name="sku[]" min="1" id="sku" placeholder="{{__('master.qty')}}" value="${variations[p1][sku]}">`;
                                cell4.innerHTML='<a class="btn btn-danger btn-sm delete-row" href="#" onclick="deleteRow(event,this)"><i class="fas fa-trash"></i></a>';
                            }
                            
                    
                            
                        }
                 var rown=p+1;
                var row=variants.insertRow(rown);
                var cell1=row.insertCell(0);
                var cell2=row.insertCell(1);
                var cell3=row.insertCell(2);
                var cell4=row.insertCell(3);
                cell1.innerHTML=comb[p].substring(1) + '<input type="hidden" class="form-control" name="names[]" id="names" placeholder="Name" value="'+comb[p].substring(1)+'">';
                cell2.innerHTML=`<input type="number" class="form-control" name="prices[]" min="1" step="any" id="prices" placeholder="{{__('master.price')}}">`;
                cell3.innerHTML=`<input type="number" class="form-control" name="sku[]" min="1" id="sku" placeholder="{{__('master.qty')}}">`;
                cell4.innerHTML='<a class="btn btn-danger btn-sm delete-row" href="#" onclick="deleteRow(event,this)"><i class="fas fa-trash"></i></a>';
      
                    
                }      
                else{
                   */ 
                let resultObject = search(comb[p].substring(1), variations);
                console.log(resultObject)
                var rown= p+1;
                if(page_Type=='product_edit' && resultObject!=undefined){
                    for(var p1 =0;p1<variations.length;p1++){
                        console.log('resultObject',resultObject)
                           console.log('variant',variations[p1].name,' - ',comb[p],' - ',comb[p].substring(1))
                       if(variations[p1].name==comb[p].substr(1) )
                        {
                            console.log('variant',variations[p1][name],' - ',comb[p].substring(1));
                            var row=variants.insertRow(rown);
                            var cell1=row.insertCell(0);
                            var cell2=row.insertCell(1);
                            var cell3=row.insertCell(2);
                            var cell4=row.insertCell(3);
                            cell1.innerHTML=comb[p].substring(1) + '<input type="hidden" class="form-control" name="names[]" id="names" placeholder="Name" value="'+variations[p1].name+'">';
                            cell2.innerHTML=`<input type="number" class="form-control" name="prices[]" min="1" step="any" id="prices" placeholder="{{__('master.price')}}"value="${variations[p1].price}">`;
                            cell3.innerHTML=`<input type="number" class="form-control" name="sku[]" min="1" id="sku" placeholder="{{__('master.qty')}}" value="${variations[p1].sku}">`;
                            cell4.innerHTML='<a class="btn btn-danger btn-sm delete-row" href="#" onclick="deleteRow(event,this)"><i class="fas fa-trash"></i></a>';
                     /* */  }
                    }
                }
                else if(page_Type=='add_new' || resultObject==undefined){
                        console.log('undefined',comb[p].substring(1))
                    
                    var row=variants.insertRow(rown);
                    var cell1=row.insertCell(0);
                    var cell2=row.insertCell(1);
                    var cell3=row.insertCell(2);
                    var cell4=row.insertCell(3);
                    cell1.innerHTML=comb[p].substring(1) + '<input type="hidden" class="form-control" name="names[]" id="names" placeholder="Name" value="'+comb[p].substring(1)+'">';
                    cell2.innerHTML=`<input type="number" class="form-control" name="prices[]" min="1" step="any" id="prices" placeholder="{{__('master.price')}}">`;
                    cell3.innerHTML=`<input type="number" class="form-control" name="sku[]" min="1" id="sku" placeholder="{{__('master.qty')}}">`;
                    cell4.innerHTML='<a class="btn btn-danger btn-sm delete-row" href="#" onclick="deleteRow(event,this)"><i class="fas fa-trash"></i></a>';
                }
                /////}
                
            }
        }
    };
      $('#attributes').on('change',function(){ // AJAX request 
             let attributes={product_id:$('#product_id').val(),attributes:$('#attributes option:selected').toArray().map(item => item.value),type:$('#opr_type').text()};
         console.log($('#attributes option:selected').val(),$('#attributes option:selected').toArray().map(item => item.value));
         $.ajax({
            "url": "https://marssa.shop/dashboard/admin/products/getValues",
            type:"GET",
            data:attributes,
            success:function(data)
            {
                $('#searching_div').removeClass('hidden');
             //   console.log(data)
                $('#searching_div').html(data);
            },
            error:function(data)
            {
                $('#searching_div').addClass('hidden');
                console.log('error', data)
            }
        });
     });
     /*
        $(".delete-row").click(function() {
            console.log('variants delete row')
      //    $(this).closest("tr").remove();
        });
     $('#variants').on('click','.delete-row',function(e){
          e.preventDefault();
            console.log('variants delete row')
//          $(this).closest('tr').remove();
    });
     */
     function deleteRow(e,button) {
        console.log('variants delete row')
    //here I want to prevent default
    e = e || window.event;
    e.preventDefault();
         const tr = button.parentNode.parentNode;
         tr.parentNode.removeChild(tr);
     }
/*$('#values').on('change',function(){ // AJAX request 
            let values=$('#values').val();
              vals=[];
             for(var r=0;r<values.length;r++){
                 if(jQuery.inArray(values[r], vals) === -1)
                 {
                     vals.push(values[r]);
                 }
             }
  ///           console.log('vals',vals)
//             console.log('values',values)
         }); 
  */   
   /* $('#add_row').on('click',function(e){
        e.preventDefault();
       // console.log('click add_row',vals)
            let rowsarr=[];
            for(var q=0;q  < $('#values').val().length;q++){
             if(q == 0)
             {
                 //$('#attrs tbody').empty();
             }
        $("#attrs").each(function () {
            let exist=0;
             $("#attrs tbody").find("tr").each (function(){
                    var trElem = $(this);
                    if (($(this).find("td:eq(2)").text()) == $('#values').val()[q] && $('#attrs tbody tr:contains("' + $('#values').val()[q] +'")').length>0)
                    {
                        exist=1;
                        console.log('exists')
                    }
                    else{
                        exist=0;
                        console.log('not exists')
                    }  
                })
                
            if( exist===0){// 
                if($('#attrs tbody tr').length > 0 && !$('#attrs tbody tr:contains("' + $('#add_attr option:selected').text()[q] +'")').length>0)
                {
                    console.log('attr',$('#add_attr option:selected').text()[q]);
                }
                else
                {
                  var tds = `<tr><td>${$('#add_attr option:selected').text()}<input type="hidden" name="ids[]" value="${$('#add_attr option:selected').val()}"></td>
                  <td>${$('#display_type').val()}<input type="hidden" name="display_types[]" value="${$('#display_type').val()}"></td>
                  <td>${$('#values').val()[q]}</td>
                  <input type="hidden" name="values[]" value="${$('#values').val()[q]}">
                  <td><input type="text" class="form-control" name="prices[]"></td>
                  <td style="display:none;"><a hred="#" class="delete-row btn btn-sm btn-danger" ><i class="fas fa-trash"></i></td></tr>`;
                     if ($('tbody', this).length > 0) {
                         $('tbody', this).append(tds);
                    } 
                    else {
                         $(this).append(tds);
                    }
                }
                
            }
        });
             }
    });*/
    $('#single').on('click',function(){
        if ($(this).is(':checked'))
    {
        console.log('single');
       $('#singleDiv').removeClass('hidden');
       $('#variantDiv').addClass('hidden'); 
       $('#price_qty').removeClass('col-md-6');
       $('#price_qty').addClass('col-md-3'); 
       $('#name_image').removeClass('col-md-6');
       $('#name_image').addClass('col-md-9'); 
    }
    });
    $('#variant').on('click',function(){
        if ($(this).is(':checked'))
     {
        console.log('variant');
       $('#variantDiv').removeClass('hidden');
       $('#singleDiv').addClass('hidden'); 
       $('#name_image').removeClass('col-md-9');
       $('#name_image').addClass('col-md-6'); 
       $('#price_qty').removeClass('col-md-3');
       $('#price_qty').addClass('col-md-6'); 
    }
    });
        </script>
@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" 
    integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

    var uploadedDocumentMap = {}
    Dropzone.options.dpzMultipleFiles = {
        paramName: "file", // The name that will be used to transfer the file
        //autoProcessQueue: false,
        maxFilesize: 5, // MB
        clickable: true,
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
        dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
        dictCancelUpload: "الغاء الرفع ",
        dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
        dictRemoveFile: "حذف الصوره",
        dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هذا ",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        url: "{{ route('dashboard.admin.products.saveFile') }}", // Set the url
        success: function(file, response) {
            console.log(response);
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name;
        $('#file').val(response.name);
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
        init: function() {
            @if (isset($event) && $event->document)
                var files =
                {!! json_encode($event->document) !!}
                for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                }
            @endif
        }
    }
</script>
    <script src="{{ asset('dashboard/light/assets/editor/summernote-lite.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/lang/summernote-ar-AR.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/editor/title_image.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(function () {

                $('[data-toggle="tooltip"]').tooltip()
            });

            $('#content_ar').summernote({
                imageTitle: {
                    specificAltField: true,
                },
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
                placeholder: "{{ __('master.product_description') }}",
                lang: 'ar-AR',
                height: 350,
                tabsize: 2,
                disableDragAndDrop: true,
            });
            $('#desc_ar').summernote({
                imageTitle: {
                    specificAltField: true,
                },
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
                placeholder: "{{ __('master.more_details') }}",
                lang: 'ar-AR',
                height: 250,
                tabsize: 2,
                disableDragAndDrop: true,
            });
            $('#content_en').summernote({
                imageTitle: {
                    specificAltField: true,
                },
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
                placeholder: "{{ __('master.product_description') }}",
                height: 350,
                tabsize: 2,
                disableDragAndDrop: true,
            });
            $('#content_fr').summernote({
                imageTitle: {
                    specificAltField: true,
                },
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
                placeholder: "{{ __('master.product_description') }}",
                height: 350,
                tabsize: 2,
                disableDragAndDrop: true,
            });


            $('#upsell').click(function () {

                if ($(this).prop("checked") == true) {
                    $('.upsell').removeClass('disable');
                } else if ($(this).prop("checked") == false) {
                    $('.upsell').addClass('disable');
                }

            });

        });


        $("#product_form").on("submit", function (e) {
            $("#product_submit").html()
            $("#product_submit").html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span></div>')
        })
    </script>
    <script type="text/javascript">
    function preview_image()
    {
     var total_file=document.getElementById("fileup").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('#image_preview').append("<div><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'><br>");
     }
    }

$(".image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

    $("#status1").on('change', function() {
  if ($("#status1").is(':checked'))
  //  alert("checked");
    $("#price_before").fadeIn();
  else {
  //  alert("unchecked");
      $("#price_before").fadeOut();
  }
});

    </script>

@endsection
{{--Developed Saed Z. Sinwar--}}
