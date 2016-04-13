@extends('layouts.site')

@section('content')
    <div id="banner-row-uinsight" class="banner-row">
        {{--
        <img id="banner-image" src="/static/images/UQuality_Banner.jpg" alt="">
        --}}
        <div class="row text-banner-holder">
            <div id="about-header" class="lined-header small-10 small-centered">
                <h2 class="underlined-header">UQuality</h2>
            </div>
        </div>
    </div>

    <div class="bar"></div>

    <section id="uinsight-content" class="row">
        <article class="small-11 small-centered medium-9 columns">

            <div class="image-toppest-wrap">
                <img class="image-toppest" src="/static/images/uquality-icon.jpg">
            </div>

            <p class="regular-writing nom">Many companies are still using basic databases and spreadsheets to keep track of projects and programs in multiple, remote locations.  By the time the information is acquired and manually entered and re-entered, it is already out-of-date and mistakes are made along the way. As a result, companies are spending an increased amount of time managing these spreadsheets instead of focusing on making informed data-based decisions.</p>

            <div class="divider blue"></div>

            <p class="regular-writing">UQuality is an easy-to-use application designed to provide operational excellence. Our customizable workflow application allows our clients to capture data and report on projects and programs in real-time. A company can see how long it takes to complete a task or how much data is being gathered for every client.</p>
            <p class="regular-writing">UQuality is built to capture real-life feed from geographically remote locations and gives companies the ability to log data instantaneously. This allows for greater efficiency in coordination and organization of assignments and people, all based on up-to-date information.</p>
            <p class="regular-writing">UQuality creates a tailored workflow management suite that will allow you to review any future, ongoing, and completed tasks from one central place. UQuality addresses the challenges of functionality, speed, accuracy, and repeatability. The insights are communicated clearly to enable data driven decisions across the entire enterprise.</p>
    
        </article>
    </section>

    <section class="row">
        <article id="service-bottom-buttons" class="small-11 small-centered medium-11 columns">
            @include('site::pages._servicebuttons',['pageslug'=>'uquality'])
        </article>
    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')
@stop
