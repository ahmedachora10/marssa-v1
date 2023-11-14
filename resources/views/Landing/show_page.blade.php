@extends('Landing.master')

@section('pricing_page')
    active
@endsection


@section('head')
    @if(app()->getLocale() == 'en')
        <style type="text/css">
            html, body {
                direction: ltr !important;
            }
        </style>
    @endif

@endsection

@section('content')
    <section class="page pricing-table-section wow fadeIn">
        <div class="container">
            <div class="section-header pricing-table-header">
                <h2 class="wow fadeInDown"><span
                            class="gradient-button link--kukuri">{{ $page['title_'.app()->getLocale()] }}</span>
                </h2>
                <div class="text-center inline-path">
                    <a href="{{ route('site.index') }}" data-wpel-link="internal">{{ __('site.main') }}</a>
                    <i>/</i>
                    <span>{{ $page['title_'.app()->getLocale()] }}</span>
                </div>
            </div>
            <div style="line-height: 2;">
                {!! $page['content_'.app()->getLocale()] !!}
            </div>
        </div>
    </section>
@endsection
{{--Developed Saed Z. Sinwar--}}