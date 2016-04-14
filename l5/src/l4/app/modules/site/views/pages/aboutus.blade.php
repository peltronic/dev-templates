@extends('layouts.site')

@section('content')
    <div id="banner-row-about" class="banner-row">
        {{--
        <img id="banner-image" src="/static/images/office-silohouette.jpg" alt="">
        --}}
        <div class="row text-banner-holder">
            <div id="about-header" class="lined-header small-10 small-centered">
                <h2 class="underlined-header">About Us</h2>
            </div>
        </div>
    </div>

    <div class="bar"></div>

    <section class="row">
        <article class="section-header small-11 small-centered medium-9 columns">
            {{--
            <div class="section-header-child underlined-header">
                <h3 class="section-header-grandchild ">Our Story</h3>
            </div>
            --}}
        </article>
    </section>

    <section class="row">
        <article class="small-11 small-centered medium-9 columns">
            <p class="regular-writing">UTILITWORX, Inc. (UTW) is a leading provider of web and mobile applications that optimize workflow for enterprises large and small, across multiple industries. Built on the U Platform, we provide stream-lined data flow via tailored applications –empowering our clients to manage their business.</p>
            <p class="regular-writing">We are a Silicon Valley based company with over 30 years of application development experience with an emphasis on customizable web, mobile, and desktop applications.</p>
        </article>
    </section>

    <section class="row">
        <div class="small-12 small-centered columns divider blue"></div>
    </section>

    <section class="row">
        <article class="small-9 small-centered columns">
            <div id="about-content-img">
                <img src="/static/images/writing-laptop-story.jpg">
            </div>
        </article>
    </section>

    <section class="row">
        <article class="small-9 small-centered columns">
            <section class="row">
                <article class="small-12 medium-6 columns">
                    <div class="divider blue"></div>
                    <div class="section-header-child OFF-overlined-header">
                        <h4 class="section-header-grandchild about-header-bottom blue">Our Mission</h4>
                    </div>
                    <p>UTILITWORX, Inc. is dedicated to bringing the best custom workflow applications to create opportunities from everyday challenges.</p>
                </article>
                <article class="small-12 medium-6 columns">
                    <div class="divider blue"></div>
                    <div class="section-header-child OFF-overlined-header">
                        <h4 class="section-header-grandchild about-header-bottom blue">Our Values</h4>
                    </div>
                    <ul class="utilitlist">
                        <li>We are committed to excellence</li>
                        <li>We champion diversity in all aspects</li>
                        <li>We foster creativity and continuous improvement</li>
                        <li>We support and sustain the communities that we serve</li>
                    </ul>
                </article>
            </section>
        </article>
    </section>

    <section class="row tag-last">
        <article class="small-9 small-centered">
            <div class="divider blue"></div>
            <div class="subcrate-join section-header-child OFF-overlined-header">
                <h4 class="section-header-grandchild about-header-bottom blue">Join Our Team</h4>
                <p id="join-our-para">Take a look at the available opportunities and learn how you can make a difference!</p>
                <a href="careers" alt=""><button id="careers-button" class="action-button orange-button">Careers<i class="fa fa-chevron-right"></i></button> </a>
            </div>
        </article>
    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')
@stop
