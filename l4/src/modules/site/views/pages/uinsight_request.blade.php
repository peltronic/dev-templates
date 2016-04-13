@extends('layouts.site')

@section('content')
    <div id="banner-row-uinsight" class="banner-row">
        {{--
        <img id="banner-image" src="/static/images/UInsight_Banner.jpg" alt="">
        --}}
        <div class="row text-banner-holder">
            <div id="about-header" class="lined-header small-10 small-centered">
                <h2 class="underlined-header">UInsight</h2>
            </div>
        </div>
    </div>

    <div class="bar"></div>

    <section id="upermits_request-content" class="row">
        <article class="small-11 small-centered medium-9 columns">

            <div class="crate row">
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/custom-icon.png">
                </div>
                <div class="small-9 medium-10 columns">
                    <h5>Custom</h5>
                    <p>UINSIGHT is customizable to fit any organization or department-specific needs.</p>
                </div>
            </div>

            <div class="crate row">
                <div class="small-9 medium-10 columns">
                    <h5>Efficient</h5>
                    <p>Our workflow applications eliminate manual paperwork and allow you to take your work wherever you go, increasing overall workplace efficiency.</p>
                </div>
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/clock-icon.png">
                </div>
            </div>

            <div class="crate row">
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/comments-icon.png">
                </div>
                <div class="small-9 medium-10 columns">
                    <h5>Communication</h5>
                    <p>Communicating from staff to leadership, intra-departmental, and organization-wide, is made easy through notifications, alerts, and follow-up features.</p>
                </div>
            </div>

            <div class="crate row">
                <div class="small-9 medium-10 columns">
                    <h5>Support</h5>
                    <p>With training and a dedicated Account Manager provided to your team - you're in good hands any time of day or night.</p>
                </div>
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/question-mark-icon.png">
                </div>
            </div>

            <div class="crate row">
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/reports-icon.png">
                </div>
                <div class="small-9 medium-10 columns">
                    <h5>Reports</h5>
                    <p>UINSIGHT allows you to track data pertaining to your department and organization-specific operations, allowing you to pin-point opportunities for change through our various reporting abilities and visuals.</p>
                </div>
            </div>

            <div class="crate row">
                <div class="small-9 medium-10 columns">
                    <h5>Green</h5>
                    <p>UINSIGHT allows you to go green with paperless reports and streamlined data capture.</p>
                </div>
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/leaf-icon.png">
                </div>
            </div>


            <div class="divider blue"></div>

            <div id="consult-form-wrap" class="supercrate supercrate-form row">
                <div class="crate-consult_form small-11 small-centered columns">
                    @include('site::partials._consultform',['requesttype'=>'uinsight'])
                </div>
            </div>

        </article>
    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')

@stop
