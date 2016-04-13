@extends('layouts.site')

@section('content')

    <div id="banner-row-about" class="banner-row">
        {{--
        <img id="banner-image" src="/static/images/Services_Banner.jpg" alt="">
        --}}
        <div class="row text-banner-holder">
            <div id="about-header" class="lined-header small-10 small-centered">
                <h2 class="underlined-header">Our Clients</h2>
            </div>
        </div>
    </div>

    <div class="bar"></div>

    <section class="row statement-row">
        <article class="small-11 small-centered medium-10 columns">
            <h4>At UTILITWORX we take pride in our ability to provide the highest quality service to our clients.</h4>
         </article>
    </section>

    <section class="row">
        <article class="section-header small-11 small-centered medium-10 columns">
            <div class="underlined-header">
                <h3>Case Studies</h3>
            </div>
        </article> 
    </section>

    <section class="row">
        <article class="crate-case_studies small-11 small-centered medium-10 columns">

            <div id="pge-logo" class="OFF-logo-grey logo-case-study">
                <img src="static/images/pge-logo.png" />
            </div>
            <p>The utility industry faces challenges relating to the tracking of projects and programs through basic databases and spreadsheets. The expansion of the industry has led to an increased time in managing spreadsheets instead of utilizing the data from the spreadsheets.</p>
            <p>UQuality provided Pacific Gas &amp; Electric (PG&amp;E) a customized application built around the agency’s unique processes and requirements. We worked with construction supervisors, inspectors, and management to identify inspection needs and requirements and developed a strategic plan to implement.</p>
            <p>The end result was a product that allowed PG&amp;E to review future, present, and completed inspections, with the ability for these inspections to be viewed and sorted by division, regions, inspector, and contractor, month and year.  Further, UQuality provided inspectors with the resource to update a project with findings, photos, and videos in an instant, despite working from remote locations. Updates were timely and accurate and gave management a better way to deal with the inspection process.</p>

            <div class="divider blue"></div>

            <div id="western-logo" class="OFF-logo-grey logo-case-study">
                <img src="static/images/western-plains-logo-colored.png" />
            </div>
            <p>Healthcare agencies and hospitals are large entities that face everyday challenges with shortages in supplies, medications, and staffing. These challenges are further complicated by the multiple departments within these organizations that that all face unique situations on an everyday basis and have briefing and rounding requirements they must fulfill, all the while each department must keep in touch with the rest.</p>
            <p>UInsight provided WPMC with the ability to streamline data and proactively communicate everyday challenges faced by the medical complex by embedding the organization’s unique processes, procedures, and requirements into the application. Notifications customized to WPCM needs were used to schedule and assign tasks, follow-ups and testing and automated reporting was provided for the department leads. </p>
            <p>WPCM dashboards were generated and showed trends in performance organized by department, user, and role. WPCM had the data organized in a manner that allowed for leadership monitor shortages, expected patient admissions and discharges, and  anticipated procedures. </p>

            <div class="divider blue">
        </article>
    </section>

    <section class="row supercrate-client_logos">
        <article class="crate-client_logos small-12 small-centered medium-6 medium-uncentered columns">
            <div id="lcms"   class="logo-grey"><img class="" width="190" src="static/images/clients/L2CMS-colored.jpg" /></div>
            <div id="intren" class="logo-grey"><img class="" width="190" src="static/images/clients/intren-colored.jpg" /></div>
        </article>
        <article class="crate-client_logos small-12 small-centered medium-6 medium-uncentered columns">
            <div id="kdm"    class="logo-grey"><img class="" width="190" src="static/images/clients/kdm-engineering-colored.png" /></div>
            <div id="jmf"    class="logo-grey"><img class="" width="190" src="static/images/clients/jmf-logo-colored.png" /></div>
        </article>
    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')
@stop
