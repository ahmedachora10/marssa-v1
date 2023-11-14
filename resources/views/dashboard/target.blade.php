@extends('dashboard.master')

@section('traget')
    current active
@endsection
@section('head_tag')
<style>
   .small-spacing{
       background-color: white;
       padding: 23px;
   }
   .img-target{
       width: 70%;
   }
   .percent-value ,
   .victor-img
   {
      text-align: left;
   }
   .percent
   {
       font-size: 30px;
       line-height: 3em;
   }
   .victor-img .img-target{
        margin-top: 15px;
   }
   .container-form-target{
        padding: 50px !important;
   }
   .container-form-target .btn
   {
        background: #14b9c6 !important;
   }
   .from_section{
       text-align: center;
   }
   @media (max-width: 1000px) {
        .img-target{
            width:30%;

        }
        .small-spacing div {
           text-align: center;
        }
        .container-form-target {
            padding: 50px 10px !important;
        }

   }

</style>
@endsection


@section('content')
    @php $store = auth()->user()->store()->first() @endphp
    <div class="row small-spacing">
        <div class="col-xs-12">
             <div class="col-md-2 col-sm-12">
                <img class="img-target" src="https://media.istockphoto.com/vectors/trophy-icon-on-transparent-background-vector-id1282548092?k=6&m=1282548092&s=170667a&w=0&h=BT0F-W32qG-5kXmS05iYZCNbW59HX2ZNqaay6NboYSs="/>
             </div>
             <div class="col-md-3 col-sm-12">
                 <h4 class="percent"> {{ $store->chievment_of_target ?? 0 }} {{ env('currency_symbol') }} </h4>
                 <p>{{ __('master.achieved') }}</p>
             </div>
             <div class="col-md-2 col-sm-12 from_section">
                <p> {{ __('master.from') }} </p>
             </div>
             <div class="col-md-3 col-sm-12  percent-value">
                 <h4 class="percent"> {{ $store->target->value ?? 0 }} {{ env('currency_symbol') }}</h4>
                 <p>{{ __('master.target') }}</p>
             </div>
             <div class="col-md-2 col-sm-12 victor-img">
                <img class="img-target" src="https://freepikpsd.com/media/2019/10/recompensa-png-1-Transparent-Images.png"/>
             </div>
        </div>
        <div class="col-xs-12 container-form-target">
            <div class=" card white">
                <h4 class="box-title">
                    {{ __('master.target_desc') }}
                </h4>
                <div class="card-content">
                    <form method="POST" action="{{ url('dashboard/admin/target/re-target') }}" autocomplete="off">
                        @csrf

                        <div class="form-group @error('value') has-error @enderror">
                            <div class="form-with-icon">
                                <input name="value" type="text" class="form-control" id="input-states-1"
                                        value="{{ $store->target->value ?? 0 }}" required>
                                <i class="item-icon item-icon-right"><i class="fas fa-user-edit"></i></i>
                            </div>
                            @error('value')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group btn-form">

                                <button type="submit" class="btn btn-primary btn-block" style="width: auto;">
                                        {{ __('master.add_new') }}
                                </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
@endsection
