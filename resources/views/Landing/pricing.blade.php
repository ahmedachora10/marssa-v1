@extends('Landing.master')

@section('pricing_page')
    active
@endsection


@section('head')
    @if(app()->getLocale() == 'en')
        <style type="text/css">
            .p-table .p-cell:first-child {
                text-align: left;
            }
        </style>
    @endif
    <style>
        @font-face {
    font-family: glyphter;
    src: url(../../fonts/Glyphter.eot);
    src: url(../../fonts/Glyphter.eot?#iefix) format('embedded-opentype'), url(../../fonts/Glyphter.woff) format('woff'), url(../../fonts/Glyphter.ttf) format('truetype'), url(../../fonts/Glyphter.svg#Glyphter) format('svg');
    font-weight: 400;
    font-style: normal
}

.navbar-nav li a{
    color: inherit;
}

[class*=icon-]:before {
    display: inline-block;
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale
}

.pricing-table-header h2:before {
    margin-left: 80px

   
}

.section-header {
    margin-top:110px;    
}
.pricing-table-header h2:after {
    margin-right: 80px
}



.p-table-wrap {
    border-radius: 10px;
    overflow: hidden;
    border-bottom: 1px solid #ebeef1
}

.p-table.bg-color {
    background: #f9fafb
}

.p-table {
    display: table;
    width: 100%;
    color: #2b2d34;
    font-size: 16px;
    font-weight: 500;
    background: #fefefe
}

.p-cell {
    display: table-cell;
    vertical-align: middle;
    width: 25%;
    padding: 15px 25px;
    text-align: center;
    border-right: 1px solid #ebeef1
}

.p-table .p-cell:first-child {
    text-align: right;
    border: none
}

.p-header {
    text-align: center;
    padding: 15px 0;
    background: #f2f4f6;
    color: #2b2d34;
    font-size: 18px;
    font-weight: 900
}

.p-bold {
    color: #2b2d34;
    font-weight: 900;
    font-size: 18px
}

.p-table-b {
    background: #f2f4f6
}

.p-package span {
    display: block;
    font-size: 18px;
    font-weight: 900
}

.p-package span.small {
    font-size: 14px;
    font-weight: 500;
    color: #888b98;
    margin-top: 8px
}

.p-price {
    font-size: 20px;
    font-weight: 900
}

.p-price b {
    font-weight: 600;
    font-size: 16px
}

.p-package.basic {
    color: #ff9e01
}

.p-package.plus {
    color: #0471a5
}

.p-package.team {
    color: #9381f1
}


.icon-error:before {
    content: '\004a';
    font-family: glyphter
}


.icon-success:before {
    content: '\006c';
    font-family: glyphter
}

.p-cell i {
    font-size: 22px
}

.p-cell i:before {
    vertical-align: middle
}

.p-cell i.icon-error {
    color: #ff6767;
}

.p-cell i.icon-success {
    color: #8fd049
}

.p-cell img {
    max-width: 90%
}

.p-table-main.fixed {
    position: fixed;
    top: 0;
    right: 50%;
    transform: translateX(50%);
    width: calc(100% - 30px);
    max-width: 1140px;
    z-index: 55;
    border-bottom: 2px solid #ebeef1
}

.p-note {
    display: block;
    font-size: 13px;
    font-weight: 300;
    color: #999
}
.gradient-button {
    background-size: 300% 100%;
    moz-transition: all .4s ease-in-out;
    -o-transition: all .4s ease-in-out;
    -webkit-transition: all .4s ease-in-out;
    transition: all .4s ease-in-out
}

.gradient-button:hover {
    background-position: 100% 0;
    moz-transition: all .4s ease-in-out;
    -o-transition: all .4s ease-in-out;
    -webkit-transition: all .4s ease-in-out;
    transition: all .4s ease-in-out
}
@media (max-width: 600px) {
    .main-section-imgs {
        height: 350px
    }

    .blog-tags span, .blog-tags a {
        font-size: 10px
    }

    .p-cell {
        padding: 10px
    }
}

    </style>
@endsection

@section('content')


<section id="pricing" class="section-block" data-scroll-index="4">
        <div class="container">
            <div class="row" >
                
                <div class="col-md-12">
                     <h2> {{ __('site.packages') .' ' . $information['title_page_'.app()->getLocale()]  ?? '' }} </h2>
                        <p>
                            @if(app()->getLocale() == 'ar')
                                    
                                    اختر الخدمة الأنسب لاحتياجاتك بسعر معقول.

                                
                            @else
                                
                                choose your package with perfect price.
                                
                            @endif
                        </p>
                    <div class="tab-content">
                        <!-- Start Tab content 1 -->
                        <div id="monthly" class="tab-pane fade in active show">
                            <div class="row">
                                @forelse($plans->take(3) as $key=>$plan)
                                <!--if($key <= 1)-->
                                <!-- Start pricing table-->
                                <div class="col-md-4">
                                    <div class="pricing-card">
                                        <header class="card-header">
                                            <h4>{{ $plan['name_' . app()->getLocale()] }}</h4>
                                            <span class="card-header-price">
                                                <span class="simbole">{{ env('currency_symbol') }}</span>
                                                <span class="price-num"> {{  round($plan->price) }} </span>
                                                <span class="price-date">/{{ __('site.month') }}</span>
                                            </span>
                                            <div class="shape-bottom">
                                                <img src="{{ asset('/site/images/new_theme/price-shape.svg') }}" alt="shape" class="bottom-shape img-fluid">
                                            </div>
                                        </header>
                                        <div class="card-body">
                                            <ul>
                                                @forelse(explode('*', $plan['description_' . app()->getLocale()]) as $item)
                                                <li> <span class="fas fa-check"></span>
                                                    {{ $item }}</li>
                                            @empty
                                                <li>{{ __('master.no_data') }}</li>
                                            @endforelse
                                               
                                            </ul>
                                            <a href="{{ route('site.register') }}"
                                   class="btn btn-sm btn-block"
                                   data-wpel-link="external" rel="nofollow external noopener noreferrer">
                                    {{ __('site.choose_package') }}
                                </a>
                                          
                                        </div>
                                    </div>
                                </div>
                                <!-- End pricing table-->
                                <!--endif-->
                                @empty
                                     <p style="text-align: center"> {{ __('master.no_data') }}</p>
                                @endforelse
                            </div>
                        </div>
                        <!-- End Tab content 1 -->
                        <!-- Start Tab content 2 -->
                        <div id="yearly" class="tab-pane fade">
                            <div class="row">
                                <!-- Start pricing table-->
                               @forelse($plans as $key=>$plan)
                                @if($key > 1)
                                <!-- Start pricing table-->
                                <div class="col-md-6">
                                    <div class="pricing-card">
                                        <header class="card-header">
                                            <h4>{{ $plan['name_' . app()->getLocale()] }}</h4>
                                            <span class="card-header-price">
                                                <span class="simbole">{{ env('currency_symbol') }}</span>
                                                <span class="price-num"> {{  round($plan->price) }} </span>
                                                <span class="price-date">/{{ __('site.month') }}</span>
                                            </span>
                                            <div class="shape-bottom">
                                                <img src="{{ asset('/site/images/new_theme/price-shape.svg') }}" alt="shape" class="bottom-shape img-fluid">
                                            </div>
                                        </header>
                                        <div class="card-body">
                                            <ul>
                                                @forelse(explode('*', $plan['description_' . app()->getLocale()]) as $item)
                                                <li> <span class="fas fa-check"></span>
                                                    {{ $item }}</li>
                                            @empty
                                                <li>{{ __('master.no_data') }}</li>
                                            @endforelse
                                               
                                            </ul>
                                            <a href="{{ route('site.register') }}"
                                   class="btn btn-sm btn-block"
                                   data-wpel-link="external" rel="nofollow external noopener noreferrer">
                                    {{ __('site.choose_package') }}
                                </a>
                                          
                                        </div>
                                    </div>
                                </div>
                                <!-- End pricing table-->
                                @endif
                                @empty
                                     <p style="text-align: center"> {{ __('master.no_data') }}</p>
                                @endforelse
                                <!-- End pricing table-->
                                
                            </div>
                        </div>
                        

<div class="text-center clearfix compare-wrap table-page wow fadeInDown mt-3" data-wow-delay="0.1s">
                <a href="{{ route('site.register') }}" class="gradient-button compare-link btn theme-btn" data-wpel-link="external"
                   rel="nofollow external noopener noreferrer">{{ __('site.create_store') . ' ' . __('site.free') }}</a>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
  


@endsection
{{--Developed Saed Z. Sinwar--}}