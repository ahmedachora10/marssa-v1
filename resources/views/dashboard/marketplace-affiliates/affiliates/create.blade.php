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
        
            <div class="container-image-chashback col-md-12 col-xs-12">
                <div class="row-image-cashback col-md-6 col-xs-12">
                    <img src="{{ asset('dashboard/light/assets/images/Banner-2_a.jpg') }}"/>
                    <h2 class="title-image-chashback">{{ __('master.affiliate_for_your_maket') }} </h2>
                    <p  class="description-image-cachback">
                     {{ __('master.description_affiliate_for_your_maket') }}
                    </p>
                    @if(!auth()->user()->store->market_place_affilites)
                        <form method="post" action="{{ route('dashboard.admin.marketplace-affiliates-store') }}">
                            @csrf()
                            <button class="btn btn-success create-new-account" data-toggle="modal" data-target="#modal-lg">
                                <i class="fas fa-plus"></i>
                                {{ __('master.create-affiliate-account_for_your_market') }}
                            </button>
                        </form>
                    @elseif(auth()->user()->store->has_market_place_affiliates())
                       <p class="alert alert-success">
                           {{ __('master.you_had_market_place_affiliates') }}
                       </p>
                    @elseif(auth()->user()->store->wait_to_be_market_place_affiliates())
                       <p class="alert alert-info">
                           {{ __('master.wait_to_be_market_place_affiliates') }}
                       </p>
                    @elseif(auth()->user()->store->refused_market_place_affiliates())
                       <p class="alert alert-danger">
                           {{ __('master.refused_market_place_affiliates') }}
                       </p>
                    
                    @endif
                </div>
            </div>
        
        
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
