@extends('layouts.site')

@section('content')
    <!-- %%% BANNER %%% -->
    <section id="banner-row" class="banner-row">
        {{--
        <img id="banner-image" src="/static/images/overlayed-banner-working-2.jpg" alt="">
        --}}
        <div class="row">
            <div id="banner-writing" class="small-10 small-centered medium-10 medium-offset-1 OFF-end columns">
<!--
            <div id="banner-writing" class="large-6 large-offset-1 medium-offset-1 columns">
-->
                <h2>Workflow Optimization:</h2>
                <h3>Business Intelligence Suite<br>
				Customized to Your Work Environment</h3>
				
			</div>
        </div>
    </section>

    <div class="bar"></div>

    <section id="home-writing-row" class="writing-row row">
        <article class="small-10 small-centered columns">
            <p id="writing-row-p-1">
                UTILITWORX is a leading provider of web and mobile applications tailored specifically to your environment. Built on the U Platform, UTILITWORX applications address the everyday challenges businesses face and enables our clients to manage their business  instead of managing data.
            </p>
            <p>
                Whether you're a small business or a large enterprise, our applications are customized around how your organization works and provide stream-lined data flow specifically tailored to your needs, allowing you to focus on your goals instead of being burdened by ineffective systems.
            </p>
        </article>
    </section>

    <section id="solutions-row" class="row">
        <article class="small-10 small-centered columns">
            <div id="solutions-header" class="solutions-header-first medium-12">
                <div id="solutions-header-child" class="underlined-header">
                    <div class="solutions-header-grandchild ">Solutions</div>
                </div>
            </div>
            <div class="row">
                <div class="crate crate-solution medium-4 columns">
                    <div class="superbox-img">
                        <img class="solutions-img" src="/static/images/uinsight-window.jpg" alt="window">
                        <img class="solutions-icon" src="/static/images/uinsight-icon.jpg" alt="uinsight">
                    </div>
                    <div class="superbox-text">
                        <p class="solutions-bold-text solutions-text">Struggling to keep track of all the data needed to keep your operations going?</p>
                        <p class="solutions-regular-text solutions-text">UInsight captures and organizes all  the data in one central location and allows for effective communication with visible data. </p>
                    </div>
                    <div class="superbox-button show-for-small-only">
                        <a href="uinsight" alt=""><button class="learn-more action-button blue-button">Learn More<i class="fa fa-chevron-right"></i></button> </a>
                    </div>
                </div>
                <div class="crate  crate-solution medium-4 columns">
                    <div class="superbox-img">
                        <img class="solutions-img" src="/static/images/upermits-wires.jpg" alt="wires">
                        <img class="solutions-icon" src="/static/images/upermits-icon.jpg" alt="upermits">
                    </div>
                    <div class="superbox-text">
                        <p class="solutions-bold-text solutions-text">Drowning under the multiple regulations involved in submitting a permit? </p>
                        <p class="solutions-regular-text solutions-text">UPermits provides users with the tools to submit and track your permit application in a fast and efficient way, all on a single platform. </p>
                    </div>
                    <div class="superbox-button show-for-small-only">
                        <a href="upermits" alt=""><button class="learn-more action-button blue-button">Learn More<i class="fa fa-chevron-right"></i></button> </a>
                    </div>
                </div>
                <div class="crate  crate-solution medium-4 columns">
                    <div class="superbox-img">
                        <img class="solutions-img" src="/static/images/uquality-image.jpg" alt="wires">
                        <img class="solutions-icon" src="/static/images/uquality-icon.jpg" alt="upermits">
                    </div>
                    <div class="superbox-text">
                        <p class="solutions-bold-text solutions-text">Having trouble keeping track of multiple projects in remote locations?</p>
                        <p class="solutions-regular-text solutions-text">With UQuality you get real-time data that enables you to coordinate the next steps of your project, no matter the  time or place.</p>
                    </div>
                    <div class="superbox-button show-for-small-only">
                        <a href="uquality" alt=""><button class="learn-more action-button blue-button">Learn More<i class="fa fa-chevron-right"></i></button> </a>
                    </div>
                </div>
            </div>
            <div class="row supercrate-medium_buttons show-for-medium">
                <div class="crate crate-solution medium-4 columns">
                    <div class="superbox-button">
                        <a href="uinsight" alt=""><button class="learn-more action-button blue-button">Learn More<i class="fa fa-chevron-right"></i></button> </a>
                    </div>
                </div>
                <div class="crate crate-solution medium-4 columns">
                    <div class="superbox-button">
                        <a href="upermits" alt=""><button class="learn-more action-button blue-button">Learn More<i class="fa fa-chevron-right"></i></button> </a>
                    </div>
                </div>
                <div class="crate crate-solution medium-4 columns">
                    <div class="superbox-button">
                        <a href="uquality" alt=""><button class="learn-more action-button blue-button">Learn More<i class="fa fa-chevron-right"></i></button> </a>
                    </div>
                </div>
            </div>
        </article>
    </section>


    <section id="service-bottom-buttons" class="medium-12">
        <div class="buttons-wrap">
            <a href="#" alt=""><button id="insight-button-second" class="insight-button action-button orange-button">Learn More<i class="fa fa-chevron-right"></i></button> </a>
            <a href="javascript:void(0);" alt=""><button id="insight-button-first" class="insight-button action-button orange-button">Client Testimonials<i class="fa fa-chevron-right"></i></button> </a>
        </div>
    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')

@stop
