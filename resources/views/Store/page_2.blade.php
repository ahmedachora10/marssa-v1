@extends('Store.master_2')

@section('content')

    <div class="our-blog blog-details pt-150 mb-200">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-blog-post">
                        <div class="post-data">
                            <h5 class="blog-title-two title">{{ $page['title_'.app()->getLocale()] }}</h5>
                            {!!  $page['content_'.app()->getLocale()] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--Developed Saed Z. Sinwar--}}