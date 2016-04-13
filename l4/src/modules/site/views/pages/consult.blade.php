@extends('layouts.site')

@section('content')

    <div id="banner-row-about" class="banner-row">
        {{--
        <img id="banner-image" src="/static/images/Services_Banner.jpg" alt="">
        --}}
        <div class="row text-banner-holder">
            <div id="about-header" class="lined-header small-10 small-centered">
                <h2 class="underlined-header">Our Services</h2>
            </div>
        </div>
    </div>

    <div class="bar"></div>

    <section class="row">

        <article class="section-header small-11 small-centered medium-10 columns">
                <div class="section-header-child underlined-header">
                    <h3 class="section-header-grandchild">Professional and Consulting Services</h3>
                </div>
            </div>
        </article>
    </section>

    <section class="row crate-services_detail">
        <article class="small-11 small-centered medium-9 columns">
            <section class="row">
                <article class="small-12 medium-6 columns">
                    <h4 class="thumb-label">Database Services</h4>
                    <p class="regular-writing consult-writing">For large time-consuming projects, we provide dedicated database specialists to manage database administrative tasks. Our specialists can supplement your staff on a single project or on an as-needed basis. Our skills and experience allow us to provide you with solutions to ensure success.</p>
                </article>
                <article class="small-12 medium-6 columns">
                    <h4 class="thumb-label">Training Services</h4>
                    <p class="regular-writing consult-writing">We understand that training is the key to the successful implementation of any changes to an organization. UTILITWORX provides training for all employees affected by system changes. We offer instructor-led online classes, self-paced e-learning, and onsite training to guarantee that employees will walk away with the knowledge needed to accomplish progress.</p>
                </article>
            </section>
        </article>
    </section>
        
            {{-- ================================= --}}

    <section class="row">
        <article id="service-bottom-buttons" class="small-11 small-centered medium-9 columns">
            <div class="row crate-lets_talk_button">
                <div class="small-12 columns">
                    <a href="consult2" class="tag-lets_talk_button" alt=""><button id="lets-talk-button" class="tag-lets_talk_button insight-button action-button orange-button">Let's Talk<i class="fa fa-chevron-right"></i></button> </a>
                </div>
            </div>
            <div id="consult-form-wrap" class="row">
                <div class="crate-consult_form small-12 columns">
                    @include('site::partials._consultform',['requesttype'=>'consult'])
                </div>
            </div>
        </article>
    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')
@stop
