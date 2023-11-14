@extends('dashboard.master')

@section('affiliates_create')
    current active
@endsection
@section('head_tag')
    <style>
        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
       .row-image-cashback{
           margin:0% 25% !important;
           text-align: center;
       }
       .send-invitation {
            width: 100%;
            background-color: #eee;
            border: 2px dashed #3f51b5 !important;
       }
       .send-invitation td {
          padding-top: 28px;
          text-align: center;
       }
       .heading-invitation {
            font-size: 20px;
            color: #174474;
            font-weight: bold;
       }
       .send-invitation input {
            width: 50%;
            margin: auto;
            border-radius: 0px;
            height: 50px;
       }
       .button-invite-send {
           padding-bottom: 30px;
       }
       
    </style>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(!empty(session('message')))
                <div class="alert alert-success">
                    <ul>
                        <li>{{  session('message') }}</li>
                    </ul>
                </div>
            @endif
        </div>
        @if(!auth()->user()->is_affiliater())
            <div class="container-image-chashback col-md-12 col-xs-12">
                <div class="row-image-cashback col-md-6 col-xs-12">
                    <img src="{{ asset('dashboard/light/assets/images/affiliate-blogs.png') }}"/>
                    <h2 class="title-image-chashback">{{ __('master.affiliate') }} </h2>
                    <p  class="description-image-cachback">
                     {{ __('master.description_affiliate') }}
                    </p>
                    <form method="post" action="{{ route('dashboard.admin.affiliates-store') }}">
                        @csrf()
                        <button class="btn btn-success create-new-account" data-toggle="modal" data-target="#modal-lg">
                            <i class="fas fa-plus"></i>
                            {{ __('master.create-affiliate-account') }}
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">{{ __('master.affiliate') }}</h5>
                            </div>
                            <div class="card-body">
                            <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td> {{ __('master.affilaite-link') }}</td>
                                                <td>
                                                    <input id="affiliateUrl" class="form-control" type="url" value="{{ url('register?reference_id='.auth()->user()->affiliates->code_affiliate) }}" readonly/>
                                                </td>
                                                <td class="clone-url-affiliate">
                                                    <i onclick="copyData(affiliateUrl,event)" class="far fa-clone affiliateUrl"></i>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td> {{ __('master.affiliate-code') }}</td>
                                                <td>
                                                    <input id="codeaffiliate" class="form-control" type="text" value="{{ auth()->user()->affiliates->code_affiliate }}" readonly/>
                                                </td>
                                                <td class="clone-code-affiliate">
                                                    <i onclick="copyData(codeaffiliate,event)" class="far fa-clone codeaffiliate"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
                                    <form method="post" action="{{ route('dashboard.admin.affiliatees-send-message-whatsapp') }}" target="_blank">
                                        @csrf()
                                        <table class="send-invitation" style="border: 2px dashed #00bf4f !important;">
                                            <tbody>
                                                <tr>
                                                    <td colspan="3">
                                                       <p class="text-center heading-invitation"> {{ __('master.invite-phone-text') }} </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <p class="alert alert-info">{{ __('master.invite-phone-alert-text') }}</p>
                                                        <input name="mobile" class="form-control" type="tel" value="" placeholder="{{ __('master.phone') }} "/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="button-invite-send">
                                                        <button type="submit" class="btn btn-success"> {{ __('master.send-invite') }}</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                    <br/>
                                    <form method="post" action="{{ route('dashboard.admin.affiliatees-send-invitation') }}">
                                        @csrf()
                                        <table class="send-invitation">
                                            <tbody>
                                                <tr>
                                                    <td colspan="3">
                                                       <p class="text-center heading-invitation"> {{ __('master.invite-text') }} </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <input name="invitee_email" class="form-control" type="email" value="" placeholder="{{ __('master.email') }} "/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="button-invite-send">
                                                        <button type="submit" class="btn btn-info"> {{ __('master.send-invite') }}</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop


@push('js')
    {{-- rtl bootstrap  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
           $('.select-companies').select2();
        })
    </script>
    <script>
        function copyData(containerid,event) {
            event.target.style.color= 'orange';
            var range = document.createRange();
            range.selectNode(containerid); //changed here
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
            setTimeout(function(){
                event.target.style.color= '#444';
            },2000);
        }
        
    </script>

@endpush
