@extends('frontend.layouts.master')

@section('content')
    <!--=============================
            BREADCRUMB START
        ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset(config('settings.breadcumb')) }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>about UniFood</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="javascript:;">about us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
            BREADCRUMB END
        ==============================-->


    <!--=============================
            ABOUT PAGE START
        ==============================-->
    <section class="fp__about_us mt_120 xs_mt_90">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-5 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__about_us_img">
                        <img src="{{ asset(@$about->image) }}" alt="about us" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__section_heading mb_40">
                        <h4>{!! @$about->title !!}</h4>
                        <h2>{!! @$about->main_title !!}</h2>
                    </div>
                    <div class="fp__about_us_text">
                        {!! @$about->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--=============================
             WHY CHOOSE US START
        ==============================-->
    @include('frontend.home.components.why-choose')
<!--=============================
             WHY CHOOSE US END
        ==============================-->

    <!--=============================
             VIDEO SECTION START
        ==============================-->

    <section class="fp__about_video mt_100 xs_mt_70">
        <div class="container wow fadeInUp" data-wow-duration="1s">
            <div class="fp__about_video_bg" style="background: url({{ asset(config('settings.breadcumb')) }}) getYtThumbnail($about->video_link)  }});">
                <div class="fp__about_video_overlay">
                    <div class="row">
                        <div class="col-12">
                            <div class="fp__about_video_text">
                                <p>Watch Videos</p>
                                <a class="play_btn venobox" data-autoplay="true" data-vbtype="video"
                                    href="{{ @$about->video_link }}">
                                    <i class=" fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
             VIDEO SECTION END
        ==============================-->

    <!--=============================
             Chef SECTION START
        ==============================-->

    @include('frontend.home.components.team')


    <!--=============================
             Chef SECTION END
        ==============================-->

    <!--=============================
             Counter SECTION START
        ==============================-->
    @include('frontend.home.components.counter')

    <!--=============================
             Counter SECTION END
        ==============================-->

    <!--=============================
             Testimonial SECTION START
        ==============================-->

    @include('frontend.home.components.testimonial')

    <!--=============================
             Counter SECTION END
        ==============================-->

    <!--=============================
            ABOUT PAGE END
        ==============================-->
@endsection
