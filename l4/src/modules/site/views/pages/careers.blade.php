@extends('layouts.site')

@section('content')
    <div id="banner-row-about" class="clearfix banner-row">
        {{--
        <img id="banner-image" src="/static/images/Careers_Banner.jpg" alt="">
        --}}
        <div class="row text-banner-holder">
            <div id="about-header" class="lined-header small-10 small-centered">
                <h2 class="underlined-header">Why work at UTILITWORX?</h2>
            </div>
        </div>
    </div>

    <div class="bar"></div>

    <section class="supercrate-career_details row">
        <article class="small-11 small-centered medium-10 columns">
            <div class="statement-row statement-careers-row  orange">
                <p class="statement statement-careers">We're looking for people that are excited about creating effective opportunities out of challenges, for both clients and internal teams. Let’s make a positive impact together.</p>
            </div>
            <div class="row careers-row">
                <ul class="utilitlist">
                    <li>Exceptional products, services, and applications that help businesses stay on top of their work</li>
                    <li>Great people who work together in intelligent and collaborative teams to make a difference</li>
                    <li>Opportunities to create exceptional experiences and generate change</li>
                </ul>
                <p id="after-list-careers">If you like new ideas and challenges, we want to hear from you.</p>
        </article>
    </section>

    <section class="supercrate-current_openings row">
        <article class="small-11 small-centered medium-10 columns">
                <div class="section-header large-12 columns">
                    <div class="section-header-child underlined-header">
                        <h3 class="section-header-grandchild ">Current Openings</h3>
                    </div>
                </div>
                <div id="careers-image-wrap">
                    <a href="javascript:void(0);"><img id="careers-img" src="/static/images/careers-block-whole.jpg"></a>
                </div>
            </div>

        </article>
    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')

@stop
