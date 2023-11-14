@extends('dashboard.master')

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/dropify/css/dropify.min.css') }}">
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
            <div class="box-content card white">
                <h4 class="box-title">{{ __('master.profile') }}</h4>
                <div class="card-content">
                    <form method="POST" action="{{ route('dashboard.profile_store') }}" enctype="multipart/form-data"
                          autocomplete="off">
                        @csrf
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group @error('image') has-error @enderror">
                                <label><span>{{ __('master.profile_image')}}</span>
                                    <span class="hint"> 70x70</span></label>
                                <div class="card-content">
                                    @if( Auth::user()->image ?? false)
                                        <input type="file" name="image" id="input-file-preview"/>
                                    @else
                                        <input type="file" name="image" id="input-file-preview" class="dropify"/>
                                    @endif
                                </div>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="form-group @error('name') has-error @enderror col-md-12">
                                <label for="input-states-1">{{ __('master.full_name') }}</label>
                                <div class="form-with-icon">
                                    <input name="name" type="text" class="form-control" id="input-states-1"
                                           value="{{ Auth::user()->name }}">
                                    <i class="fa fa-user item-icon item-icon-right"></i>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('username') has-error @enderror col-md-12">
                                <label for="input-states-2">{{ __('master.UserName') }}</label>
                                <div class="form-with-icon">
                                    <input name="username" type="text" class="form-control" id="input-states-2"
                                           value="{{ Auth::user()->username }}">
                                    <i class="item-icon item-icon-right"><i class="fas fa-user-tag"></i></i>
                                </div>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                            <div class="form-group @error('password') has-error @enderror col-md-12">
                                <label for="input-states-4">{{ __('master.Password') }}</label>
                                <div class="form-with-icon">
                                    <input name="password" type="password" class="form-control" id="input-states-4">
                                    <i class="item-icon item-icon-right"><i class="fas fa-lock"></i></i>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('mobile') has-error @enderror col-md-12">
                                <label for="input-states-5">{{ __('master.mobile') }}</label>
                                <div class="form-with-icon">
                                    <input name="mobile" type="text" class="form-control" id="input-states-5"
                                           value="{{ Auth::user()->mobile ?? old('mobile') }}">
                                    <i class="item-icon item-icon-right"><i class="fas fa-mobile"></i></i>
                                </div>
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit"
                                        class="btn btn-primary btn-block">{{ __('master.save_settings') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('dashboard/light/assets/plugin/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/light/assets/scripts/fileUpload.demo.min.js') }}"></script>

    @if(Auth::user()->image ?? false)
        <script>
            $("#input-file-preview").addClass('dropify');
            $("#input-file-preview").attr("data-height", 225);
            $("#input-file-preview").attr("data-default-file", "{{ asset(Auth::user()->image) }}");
            $("#input-file-preview").dropify();
        </script>
    @endif
@endsection
{{--Developed Saed Z. Sinwar--}}