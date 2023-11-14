@extends('Landing.master')

@section('content')



@if($information['home_image'])


<style>




* {
  box-sizing: border-box;
}

svg {
  position: absolute;
  top: -4000px;
  left: -4000px;
}

#gooey-button {
    padding: 10px;
  font-size: 2rem;
  border: none;
  color: white;
  filter: url("#gooey");
  position: relative;
  background-color:#ECAB40;
}

#gooey-button h3{
    font-size: 16px;
}
#gooey-button:focus {
  outline: none;
}
#gooey-button .bubbles {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
#gooey-button .bubbles .bubble {
  background-color: #ECAB40;
  border-radius: 100%;
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  z-index: -1;
}
#gooey-button .bubbles .bubble:nth-child(1) {
  left: 44px;
  width: 25px;
  height: 25px;
  -webkit-animation: move-1 3.02s infinite;
          animation: move-1 3.02s infinite;
  -webkit-animation-delay: 0.2s;
          animation-delay: 0.2s;
}
#gooey-button .bubbles .bubble:nth-child(2) {
  left: 87px;
  width: 25px;
  height: 25px;
  -webkit-animation: move-2 3.04s infinite;
          animation: move-2 3.04s infinite;
  -webkit-animation-delay: 0.4s;
          animation-delay: 0.4s;
}
#gooey-button .bubbles .bubble:nth-child(3) {
  left: 16px;
  width: 25px;
  height: 25px;
  -webkit-animation: move-3 3.06s infinite;
          animation: move-3 3.06s infinite;
  -webkit-animation-delay: 0.6s;
          animation-delay: 0.6s;
}
#gooey-button .bubbles .bubble:nth-child(4) {
  left: 90px;
  width: 25px;
  height: 25px;
  -webkit-animation: move-4 3.08s infinite;
          animation: move-4 3.08s infinite;
  -webkit-animation-delay: 0.8s;
          animation-delay: 0.8s;
}
#gooey-button .bubbles .bubble:nth-child(5) {
  left: 75px;
  width: 25px;
  height: 25px;
  -webkit-animation: move-5 3.1s infinite;
          animation: move-5 3.1s infinite;
  -webkit-animation-delay: 1s;
          animation-delay: 1s;
}
#gooey-button .bubbles .bubble:nth-child(6) {
  left: 37px;
  width: 25px;
  height: 25px;
  -webkit-animation: move-6 3.12s infinite;
          animation: move-6 3.12s infinite;
  -webkit-animation-delay: 1.2s;
          animation-delay: 1.2s;
}
#gooey-button .bubbles .bubble:nth-child(7) {
  left: 52px;
  width: 25px;
  height: 25px;
  -webkit-animation: move-7 3.14s infinite;
          animation: move-7 3.14s infinite;
  -webkit-animation-delay: 1.4s;
          animation-delay: 1.4s;
}
#gooey-button .bubbles .bubble:nth-child(8) {
  left: 12px;
  width: 25px;
  height: 25px;
  -webkit-animation: move-8 3.16s infinite;
          animation: move-8 3.16s infinite;
  -webkit-animation-delay: 1.6s;
          animation-delay: 1.6s;
}
#gooey-button .bubbles .bubble:nth-child(9) {
  left: 84px;
  width: 25px;
  height: 25px;
  -webkit-animation: move-9 3.18s infinite;
          animation: move-9 3.18s infinite;
  -webkit-animation-delay: 1.8s;
          animation-delay: 1.8s;
}
#gooey-button .bubbles .bubble:nth-child(10) {
  left: 52px;
  width: 25px;
  height: 25px;
  -webkit-animation: move-10 3.2s infinite;
          animation: move-10 3.2s infinite;
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
}

@-webkit-keyframes move-1 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -97px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}

@keyframes move-1 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -97px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@-webkit-keyframes move-2 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -99px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@keyframes move-2 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -99px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@-webkit-keyframes move-3 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -81px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@keyframes move-3 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -81px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@-webkit-keyframes move-4 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -87px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@keyframes move-4 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -87px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@-webkit-keyframes move-5 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -99px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@keyframes move-5 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -99px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@-webkit-keyframes move-6 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -86px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@keyframes move-6 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -86px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@-webkit-keyframes move-7 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -85px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@keyframes move-7 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -85px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@-webkit-keyframes move-8 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -84px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@keyframes move-8 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -84px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@-webkit-keyframes move-9 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -61px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@keyframes move-9 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -61px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@-webkit-keyframes move-10 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -62px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}
@keyframes move-10 {
  0% {
    transform: translate(0, 0);
  }
  99% {
    transform: translate(0, -62px);
  }
  100% {
    transform: translate(0, 0);
    opacity: 0;
  }
}






    .start_home.demo2.demo6 {
    background: url({{ asset($information['home_image'])}});
    }
    .google-button{
        display: flex;
        width: 50%;
        MARGIN: AUTO;
        justify-content: space-around;
    }



    .google-button a{
        display: flex;
        width: 40%;
        border-radius: 20px;
    }

    .google-button .lite_login{
        background-color: transparent;
        border-color: #ECAB40;
        color: #ecab40 !important;
    }

    .google-button .register{
        background-color: #ECAB40;
        border-color: #ECAB40;
        color: white !important;
    }

    .google-button a .slider-button-title{
        margin: auto;
    }
    .google-button a h3{
        color: white;
    }
    .register_2{
        width: 30%;
        margin: auto;
        border-radius: 30px;
        display: flex;
        margin-bottom: 50px;
    }
    .register_2 div{
        display: flex;
    }
    .register_2 h3{
        margin: auto;
    }
    @media(max-width:768px) {
        .google-button{
            display: flex;
            flex-direction: column;
            width: 90%;
            MARGIN: AUTO;
            justify-content: space-around;
        }
        .google-button a {
            display: flex;
            width: 80%;
            MARGIN: auto;
            margin-bottom: 20px;
            margin-bottom: 12px;
        }
        .register_2{
            width: 50%;
        }
    }

    @media(max-width: 430px)  {
        .start_home.demo6 .start-home-content h1 {
            font-size: 50px;
            font-weight: 500;
            FONT-SIZE: 16pt;

        }
    }
     @media(max-height: 430px)  {
        .start_home.demo6 .start-home-content h1 {
            font-size: 50px;
            font-weight: 500;
            FONT-SIZE: 16pt;

        }
    }
</style>


@endif




<section class="start_home demo2 demo6">
        <div class="banner_top">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-12 start-home-content">
                        @if($information['video_url'])
                        <!--<a class="btn btn-video d-inline-block" target="_blank" href="{{ $information['video_url'] }}">-->
                        <!--    <i class="fas fa-play"></i>-->
                        <!--</a>-->
                        <a class="btn btn-video d-inline-block" data-toggle="modal"  href="#youtubeModal">
                            <i class="fas fa-play"></i>
                        </a>

                        @endif
                        <h1>
                         {{ __('site.main_details_1') }}
                        </h1>
                        <p>
                           {{ __('site.main_details_2') }}
                        </p>
                        <div class="app-button">

                            <div class="google-button" style="display: flex;">


                                 @guest
                                 <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
        <defs>
            <filter id="gooey">
                <!-- in="sourceGraphic" -->
                <feGaussianBlur in="SourceGraphic" stdDeviation="5" result="blur" />
                <feColorMatrix in="blur" type="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="highContrastGraphic" />
                <feComposite in="SourceGraphic" in2="highContrastGraphic" operator="atop" />
            </filter>
        </defs>
    </svg>
    
    
    
     <a id="gooey-button" style="display:none" data-wow-delay="0.4s"
                               href="{{route('be-affiliater')}}"
                               data-wpel-link="external"
                               rel="nofollow external noopener noreferrer" class="register">

                                <div style="width:100%;z-index: 100">
                                        <h3> @if(app()->getLocale() == 'ar') كن مسوق الان مجانا @else Be Affiliater Now  @endif </h3>
                                </div>

        <span class="bubbles">
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
        </span>
                                </a>

                            <a id="gooey-button" data-wow-delay="0.4s"
                               href="{{ route('site.register') }}"
                               data-wpel-link="external"
                               rel="nofollow external noopener noreferrer" class="register">

                                <div style="width:100%;z-index: 100">
                                        <h3>{{ __('site.create_store') }} {{  __('site.free') }} </h3>
                                </div>

        <span class="bubbles">
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
        </span>
                                </a>
                                
                                
                               

                            <!--<a target="_blank" data-wow-delay="0.4s"
                               href="{{ route('site.login') }}"
                               data-wpel-link="external"
                               rel="nofollow external noopener noreferrer" class="lite_login">


                                     <div class="slider-button-title">
                                        <h3>  {{ __('site.login') }} </h3>
                                    </div>
                                </a>-->


                        @else
                          <a data-wow-delay="0.4s"
                               href="{{ route('dashboard.index') }}"
                               data-wpel-link="external"
                               rel="nofollow external noopener noreferrer" style="background-color:#ECAB40;border-color:#ECAB40;color:white">

                                     <div class="slider-button-title">{{ auth()->user()->name.', ' . __('site.go_dashboard') }}
                                     </div>
                                </a>
                        @endguest


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-bottom">
            <img src="{{ asset('site/images/new_theme/shape-4.svg') }}" alt="shape" class="bottom-shape img-fluid">
        </div>
    </section>



<section id="how-it-work" class="section-block" data-scroll-index="2">
        <div class="container">




                                 <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
        <defs>
            <filter id="gooey">
                <!-- in="sourceGraphic" -->
                <feGaussianBlur in="SourceGraphic" stdDeviation="5" result="blur" />
                <feColorMatrix in="blur" type="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="highContrastGraphic" />
                <feComposite in="SourceGraphic" in2="highContrastGraphic" operator="atop" />
            </filter>
        </defs>
    </svg>
                            <a id="gooey-button" data-wow-delay="0.4s"
                               href="{{ route('site.register') }}"
                               data-wpel-link="external"
                               rel="nofollow external noopener noreferrer" class="register register_2">

                                <div style="width:100%;z-index:100">
                                        <h3>{{ __('site.create_store') }} {{  __('site.free') }} </h3>
                                </div>

        <span class="bubbles">
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
        </span>
                                </a>





            <div class="section-header">
                <h2>  {{ __('site.how_to_work') }} </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="{{ asset('/site/images/new_theme/how-work.png') }}" alt="Img" />
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Start Block 1 -->
                    <div class="description-block">
                        <div class="inner-box">
                            <div class="step_num"><img src="{{ asset('/site/images/new_theme/step1.png') }}" alt="Img" /></div>
                            <h3> {{ __('site.step_1') }} </h3>
                        </div>
                    </div>
                    <!-- End Block 1 -->
                    <!-- Start Block 2 -->
                    <div class="description-block">
                        <div class="inner-box">
                            <div class="step_num"><img src="{{ asset('/site/images/new_theme/step2.png') }}" alt="Img" /></div>
                            <h3> {{ __('site.step_2') }} </h3>
                        </div>
                    </div>
                    <!-- End Block 2 -->
                    <!-- Start Block 3 -->
                    <div class="description-block">
                        <div class="inner-box">
                            <div class="step_num"><img src="{{ asset('/site/images/new_theme/step3.png') }}" alt="Img" /></div>
                            <h3>{{ __('site.step_3') }} </h3>
                        </div>
                    </div>
                    <!-- End Block 3 -->
                </div>
            </div>
        </div>
    </section>



 @if($section['features_platform'] == 1)
    <section id="AppFeatures" class="section-block features-style2" data-scroll-index="1">
            <div class="container">
                <div class="section-header">
                    <h2>{{ __('site.Why') }} </h2>
                </div>
                <div class="row">

                   <div class="col-md-6">
                     @forelse($features as $key=>$feature)
                        @if($key % 2 == 0)

                            <div class="feature-block">
                                <span class="feature-icon">
                                    <img src="{{ asset($feature->icon) }}" class="img-fluid" alt="Img" />
                                </span>
                                <div class="feature-content">
                                    <h3>{{ $feature['title_' . app()->getLocale()] }}</h3>
                                    <p>{{ $feature['description_' . app()->getLocale()] }}</p>
                                </div>
                            </div>



                        @endif
                    @empty
                        <p style="text-align: center"> {{ __('master.no_data') }}</p>
                    @endforelse
                     </div>

                     <div class="col-md-6">
                     @forelse($features as $key=>$feature)
                        @if($key % 2 == 1)

                            <div class="feature-block">
                                <span class="feature-icon">
                                    <img src="{{ asset($feature->icon) }}" class="img-fluid" alt="Img" />
                                </span>
                                <div class="feature-content">
                                    <h3>{{ $feature['title_' . app()->getLocale()] }}</h3>
                                    <p>{{ $feature['description_' . app()->getLocale()] }}</p>
                                </div>
                            </div>



                        @endif
                    @empty
                        <p style="text-align: center"> {{ __('master.no_data') }}</p>
                    @endforelse
                     </div>


                </div>
            </div>
        </section>
 @endif

  <section id="regsiter_now" class="section-block text-center" data-scroll-index="5" style="    background: linear-gradient(to left, rgb(165, 71, 204) 0%, rgb(132, 3, 187) 100%);
;">

      <a  class="btn btn-warning btn-lg" data-wow-delay="0.4s"
                               href="{{ route('site.register') }}"
                               data-wpel-link="external"
                               rel="nofollow external noopener noreferrer" style="border-radius:0px;width:200px;background-color:#FFC619">



                                          <i class="fas fa-plus"></i>  {{ __('site.create_store') }}

                                </a>
  </section>
{{--
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
                        <!-- End Tab content 2 -->
                    </div>
                </div>
            </div>
        </div>
    </section>
--}}




  <section id="faqs" class="section-block" data-scroll-index="6" >
        <div class="container">
            <div class="section-header">
                <h2>
                    {{ __('site.common_questions') }}
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="{{asset('site/images/new_theme/faq2.png')}}" class="img-fluid" alt="Img" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="accordion" id="accordionExample">
                        <?php

                            $quests = json_decode($information['questions_'.app()->getLocale()]);

                        ?>


                        @foreach($quests as $key=>$quest)

                            <div class="card">
                            <div class="card-header" id="heading{{$key}}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                       {{ $quest->question }}
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse{{$key}}" class="collapse {{$key==0 ? 'show' : ''}}" aria-labelledby="heading{{$key}}" data-parent="#accordionExample">
                                <div class="card-body">
                                   {{ $quest->answer }}
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Start Faq item -->

                        <!-- End Faq item -->

                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="regsiter_now" class="section-block text-center" data-scroll-index="5" style="    background: linear-gradient(to left, rgb(165, 71, 204) 0%, rgb(132, 3, 187) 100%);
;">

      <a  class="btn btn-warning btn-lg" data-wow-delay="0.4s"
                               href="{{ route('site.register') }}"
                               data-wpel-link="external"
                               rel="nofollow external noopener noreferrer" style="border-radius:0px;width:200px;background-color:#FFC619">



                                          <i class="fas fa-plus"></i>  {{ __('site.create_store') }}

                                </a>
  </section>

    <section id="contact" class="section-block" data-scroll-index="8">
        <div class="bubbles-animate">
            <div class="bubble b_one"></div>
            <div class="bubble b_two"></div>
            <div class="bubble b_three"></div>
            <div class="bubble b_four"></div>
            <div class="bubble b_five"></div>
            <div class="bubble b_six"></div>
        </div>
        <div class="container">
            <div class="row">
                <!-- Start Contact Information -->
                <div class="col-md-5">
                    <div class="section-header-style2">
                        <h2> {{ __('site.connect_us') }} </h2>
                    </div>
                    <div class="contact-details">

                        <!-- Start Contact Block -->
                        <div class="contact-block">
                            <h4>{{ __('site.phone') }}</h4>
                            <div class="contact-block-side">
                                <i class="flaticon-smartphone-7"></i>
                                <p>
                                    <span>{{ $information->phone  ?? ''}}</span>
                                </p>
                            </div>
                        </div>
                        <!-- End Contact Block -->
                        <!-- Start Contact Block -->
                        <div class="contact-block">
                            <h4> {{ __('site.email') }} </h4>
                            <div class="contact-block-side">
                                <i class="flaticon-paper-plane-1"></i>
                                <p>
                                    <span>info@marssa.shop</span>
                                </p>
                            </div>
                        </div>
                        <!-- End Contact Block -->
                    </div>
                </div>
                <!-- End Contact Information -->
                <!-- Start Contact form Area -->
                <div class="col-md-7">
                    <div class="contact-shape">
                        <!--<img src="{{ asset($information->logo) }}" class="img-fluid" alt="Img" />-->
                    </div>
                    <div class="contact-form-block">
                        <div class="section-header-style2">
                            <h2>  {{ __('site.connect_us') }}  </h2>
                            <p>
                               {{ __('site.contact_us_details_2') }}
                            </p>
                        </div>
                        <form  class="contact-form" method="post" id="contact_form" action="{{route('send_contact_us')}}" >
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="{{ __('site.name') }}" data-val="true" data-val-required="&#x627;&#x644;&#x627;&#x633;&#x645; &#x645;&#x637;&#x644;&#x648;&#x628;" />
                                <span class="text-danger field-validation-valid" data-valmsg-for="Name" data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="{{ __('site.email') }}"  data-val="true" data-val-email="&#x627;&#x644;&#x631;&#x62C;&#x627;&#x621; &#x627;&#x62F;&#x62E;&#x627;&#x644; &#x628;&#x631;&#x64A;&#x62F; &#x627;&#x644;&#x643;&#x62A;&#x631;&#x648;&#x646;&#x64A; &#x635;&#x62D;&#x64A;&#x62D;"  />
                                <span class="text-danger field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="content" id="content"
                                          placeholder="{{ __('site.details') }}" data-val="true" data-val-required="&#x645;&#x62D;&#x62A;&#x648;&#x649; &#x627;&#x644;&#x631;&#x633;&#x627;&#x644;&#x647; &#x645;&#x637;&#x644;&#x648;&#x628;"></textarea>
                                <span class="text-danger field-validation-valid" data-valmsg-for="Message" data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn theme-btn">
                                    {{ __('site.send') }}
                                 </button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- End Contact form Area -->
            </div>
        </div>
    </section>


    <!-- Modal HTML -->
    <div id="youtubeModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="embed-responsive embed-responsive-16by9">
                      <iframe id="youtubeVideo"  src="{{$information['video_url']}}" style="width:100%"></iframe>
                </div>
                  </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
<script>
$(document).ready(function(){
    /* Get iframe src attribute value i.e. YouTube video url
    and store it in a variable */
    var url = $("#youtubeVideo").attr('src');

    /* Assign empty url value to the iframe src attribute when
    modal hide, which stop the video playing */
    $("#youtubeModal").on('hide.bs.modal', function(){
        $("#youtubeVideo").attr('src', '');
    });

    /* Assign the initially stored url back to the iframe src
    attribute when modal is displayed again */
    $("#youtubeModal").on('show.bs.modal', function(){
        $("#youtubeVideo").attr('src', url);
    });
});
</script>
        <script>
            $('#button_send_contact_us').on("click", function (e) {
                e.preventDefault();
                var name = $("input[name='name']").val(),
                    email = $("input[name='email']").val(),
                    content = $("textarea[name='content']").val(),
                    output_html = $(".output");

                function validateEmail(emailadd) {
                    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(emailadd);
                }

                if (name === '' || email === '' || content === '') {
                    output_html.html("<div class='text-warning text-center'>{{ __('site.fillAllFields') }}</div><br>").fadeIn().delay(3000).fadeOut();
                } else if (!validateEmail(email)) {
                    output_html.html("<div class='text-warning text-center'>{{ __('site.EnterValidEmail') }}</div><br>").fadeIn().delay(3000).fadeOut();
                } else {
                    $.ajax({
                        url: "{{ route('send_contact_us') }}",
                        type: "POST",
                        data: $('#contact_form').serialize(),
                        cache: false,
                        success: function (result) {
                            output_html.html("<div class='text-success text-center'>" + result + "</div><br>").fadeIn().delay(5000).fadeOut();
                            name.val('');
                            email.val('');
                            content.val('');
                        }
                    });
                }
                return false;
            });
        </script>

    @endsection


{{--Developed Saed Z. Sinwar--}}
