@extends('Store.master_1')

@section('content')

    <section class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-one__single">
                        <div class="blog-one__content">
                            <h3 class="blog-one__title">
                                {{ $page['title_'.app()->getLocale()] }}
                            </h3>
                            <div class="pt-50">
                                {!!  $page['content_'.app()->getLocale()] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
{{--Developed Saed Z. Sinwar--}}