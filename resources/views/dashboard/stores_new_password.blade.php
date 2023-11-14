@extends('dashboard.master')


@section('participants_index')
    current active
@endsection


@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box-content bordered primary ">
                  <div class="alert alert-success">
                    {!! __('master.reset_password_status',['name'=>$name,'password'=>'<code>'.$new_password.'</code>']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
{{--Developed Moayad Hassan--}}
