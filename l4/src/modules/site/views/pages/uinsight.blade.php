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

    <section id="uinsight-content" class="row">
        <article class="small-11 small-centered medium-9 columns">

            <div class="image-toppest-wrap">
                <img class="image-toppest" src="/static/images/uinsight-icon.jpg">
            </div>

            <p class="regular-writing nom">Presenting data gathered from spreadsheets in a clear and concise way is an issue that large organizations with multiple units struggle with on a daily basis.</p>

            <div class="divider blue"></div>

            <p class="regular-writing">UInsight is a customizable, easy to use BI suite application that provides centralized data capture, and centralized reporting and output to proactively communicate the challenges within an organization.</p>
            <p class="regular-writing">The application gives users the ability to create reports using real time data as needed. UInsight captures the specific data points and runs reports created during structured user entries, all of which can be organized by customizable categories.</p>
            <p class="regular-writing">The information gathered is then organized and presented through clear visuals that drive discussion around the performance trends revealed by the data. This allows users to pinpoint areas of concern or address specific topics.</p>
            <p class="regular-writing">By uncovering the main data points used by an organization, centralizing around these points, and providing the information in a visible manner, UInsight provides companies with a tool for clear and efficient communication from leadership to staff. With UInsight, a path is paved to visualize and explore information to reach vital organization-specific insights.</p>

        </article>
    </section>

    <section class="row">
        <article id="service-bottom-buttons" class="small-11 small-centered medium-11 columns">
            @include('site::pages._servicebuttons',['pageslug'=>'uinsight'])
        </article>
    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')

@stop
