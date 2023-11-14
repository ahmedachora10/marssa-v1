use Illuminate\Support\Str;
@extends('dashboard.master')

@section('store_settings')
    current active
@endsection
@section('head_tag')
<style>
    .explan-card p {
        color: black;
    }

    .explan-card {
        display: inline-block;
        text-align: left;
        border-radius: 5px;
        box-shadow: 1px 0px 40px -14px #a0a0aa;
        padding: 30px 20px;
        margin: 20px;
        text-align: center;
        border-top: 5px solid #9a33c7;
    }
    .explan-card h2 {
        color: #9a33c7;
        font-size: 20px;
        line-height: 2em;
        margin-top:1px;
    }
    .explan-card img
    {
        width: 30%;
        cursor: pointer;
        width: 30%;
        cursor: pointer;
        border-radius: 50%;
        box-shadow: 1px 5px 5px 4px lightgrey;
    }
    @media (max-width: 1000px) {
        .explan-card{
            margin: 20px 0px;
        }
    }
</style>
@endsection


@section('content')
    
    <div class="row small-spacing">
        <div class="col-xs-12">
            @foreach($explanations as $explan)
                <div class="explan-card col-md-3 col-sm-5 col-xs-12 ">
                    <h2>{{ $explan->title }}</h2>
                    <p> {{ Str::substr($explan->description,0,100) }}</p>
                    <img class="watch_video" data-video-id="{{ $explan->section }}"  src="https://www.iconpacks.net/icons/1/free-video-icon-818-thumb.png" alt="">
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
@endsection
