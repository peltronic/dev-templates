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

    <section id="upermits_request-content" class="row">
        <article class="small-11 small-centered medium-9 columns">

            <div class="crate row">
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/clock-icon.png">
                </div>
                <div class="small-9 medium-10 columns">
                    <h5>Efficient</h5>
                    <p>Eliminate manual workload, save hours of manpower and expedite the permit approval time.</p>
                </div>
            </div>

            <div class="crate row">
                <div class="small-9 medium-10 columns">
                    <h5>Tracking</h5>
                    <p>Easily track permits by status - Submitted, Approved, Open, Rejected, and Closed.</p>
                </div>
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/search-review-icon.png">
                </div>
            </div>

            <div class="crate row">
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/map-icon.png">
                </div>
                <div class="small-9 medium-10 columns">
                    <h5>Map</h5>
                    <p>View locations for permit applications submitted and approved for each project.</p>
                </div>
            </div>

            <div class="crate row">
                <div class="small-9 medium-10 columns">
                    <h5>Simple</h5>
                    <p>Simple and intuitive features designed with the user in mind allow for an effortless use each and every time.</p>
                </div>
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/puzzle-icon.png">
                </div>
            </div>

            <div class="crate row">
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/comments-icon.png">
                </div>
                <div class="small-9 medium-10 columns">
                    <h5>Communication</h5>
                    <p>Respond quickly and easily to and from permit applicants and agencies via our simple comment feature. </p>
                </div>
            </div>

            <div class="crate row">
                <div class="small-9 medium-10 columns">
                    <h5>Reports</h5>
                    <p>Review and report the quantity, processing time and permit status of the applications submitted and processed. </p>
                </div>
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/reports-icon.png">
                </div>
            </div>

            <div class="crate row">
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/leaf-icon.png">
                </div>
                <div class="small-9 medium-10 columns">
                    <h5>Green</h5>
                    <p>Paperless permit applications equals less waste!</p>
                </div>
            </div>

            <div class="crate row">
                <div class="small-9 medium-10 columns">
                    <h5>Support</h5>
                    <p>You’re in good hands with training and 24/7 support available any time of day or night.</p>
                </div>
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/question-mark-icon.png">
                </div>
            </div>

            <div class="crate row tag-last">
                <div class="small-3 medium-2 columns">
                    <img class="" src="/static/images/check-icon.png">
                </div>
                <div class="small-9 medium-10 columns">
                    <h5>Hassle Free</h5>
                    <p>No need to purchase, install, configure, or maintain any software.</p>
                </div>
            </div>

            <div class="divider blue"></div>

            <div class="supercrate supercrate-form row">
                <div id="consult-form-wrap" class="crate-consult_form small-11 small-centered columns">
                        @include('site::partials._consultform',['requesttype'=>'upermits'])
                </div>
            </div>

        </article>
    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')

@stop
