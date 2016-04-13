@extends('layouts.site')

@section('content')
    <div id="banner-row-uinsight" class="banner-row">
        {{--
        <img id="banner-image" src="/static/images/UPermits_Banner.jpg" alt="">
        --}}
        <div class="row text-banner-holder">
            <div id="about-header" class="lined-header small-10 small-centered">
                <h2 class="underlined-header">UPERMITS</h2>
            </div>
        </div>
    </div>

    <div class="bar"></div>

    <section id="upermits-content" class="row">
        <article class="small-11 small-centered medium-9 columns">

            <div class="image-toppest-wrap">
                <img class="image-toppest" src="/static/images/upermits-icon.jpg">
            </div>
            <p class="regular-writing nom">Obtaining a permit is a manual and time consuming process that requires an understanding of the permit acquisition rules and regulations for every city. We know this variability in requirements makes it difficult to comply with these rules, leading to delays and fines. UPermits simplifies the permit application process by providing users with the information necessary to obtain a permit in a simple and fast way, allowing users to save time and money.</p>

            <section class="row crate-applicants_and_agencies">

                <article class="small-12 medium-6 columns">
                    <h3 class="thumb-label">Applicants</h3>
                    <div class="video-thumb">
                        <a href="#permitvideo1" class="open-popup-link tag-applicant" data-videoid="applicant-video"><img src="/static/images/jake-video-thumb.jpg"></a> 
                        <div id="permitvideo1" class="white-popup mfp-hide">
                            <video onclick="this.play();" poster="/static/images/jake-video-thumb.jpg" controls="" id="applicant-video">
                                <source src="/videos/UPermits_Applicant.mp4" type="video/mp4">
                                <source src="/videos/UPermits_Applicant.webm" type="video/webm">
                                Your browser does not support the <code>video</code> element.
                            </video>
                        </div>
                    </div>
                    <p class="regular-writing permits-writing">UPermits provides a single platform to apply, review and receive approved permits. Simply enter your project’s address, fill out the agency specific information, attach required documents, and let UPermits do the rest.</p>
                    <p class="regular-writing permits-writing">We’ll deliver your permit application directly to the appropriate departments and keep you in contact with these agencies during the approval process, allowing you to track your application and react instantly to any changes.</p>
                </article>

                <article class="small-12 medium-6 columns">
                    <h3 class="thumb-label">Agencies</h3>
                    <div class="video-thumb">
                        <a href="#permitvideo2" class="open-popup-link tag-agency" data-videoid="agency-video"><img src="/static/images/anime-video-thumb.jpg"></a>
                        <div id="permitvideo2" class="white-popup mfp-hide">
                            <video onclick="this.play();" poster="/static/images/anime-video-thumb.jpg" controls="" id="agency-video">
                                <source src="/videos/UPermits_Agency.mp4" type="video/mp4">
                                <source src="/videos/UPermits_Agency.webm" type="video/webm">
                                Your browser does not support the <code>video</code> element.
                            </video>
                        </div>
                    </div>
                    <p class="regular-writing permits-writing">UPermits provides a secure and customizable solution where your team can easily receive, review, track, and issue permits. Simply set up your account and let UPermits handle the rest.</p>
                    <p class="regular-writing permits-writing">We’ll provide a centralized location where applicants can view all permit requirements and can submit applications with the click of a button, allowing you to streamline - the permit process.</p>
                </article>

            </section>

        </article>
    </section>

    <section class="row">
        <article id="service-bottom-buttons" class="small-11 small-centered medium-11 columns">
            @include('site::pages._servicebuttons',['pageslug'=>'upermits'])
        </article>
    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')

@stop
