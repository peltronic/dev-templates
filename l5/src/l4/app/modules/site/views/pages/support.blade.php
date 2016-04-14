@extends('layouts.site')

@section('title')
24/7 Support | UTILITWORX
@stop
@section('description')
Please contact us if you are experiencing any challenges with UINSIGHT, UQUALITY, UPERMITS, and Database or Training services. Urgent matters can be addressed by phone. 
@stop

@section('content')
    <div id="banner-row-support" class="banner-row">
        {{-- 
        <img id="banner-image" src="/static/images/Support_Banner.jpg" alt=""> 
        --}}
        <div class="row text-banner-holder">
            <div id="about-header" class="lined-header small-10 small-centered">
                <h2 class="underlined-header">Support</h2>
            </div>
        </div>
    </div>
    <div class="bar"></div>

    <section id="support-content" class="row">
        <article class="small-11 small-centered medium-9 columns">
            <h3 id="question-medium" class="medium-text">Questions or Comments?</h3>
            <p id="questions-para" class="statement">We'd love to hear from you! We're here to answer any questions you may have and get you the information you need. Simply fill in the fields and we'll quickly get back to you with a response. If you would like to speak with someone directly, please call us at (630) 799-8061. We look forward to helping you.</p>
        </article>
    </section>

    <section class="row">
        {{-- this is what replaces it via ajax 
           views.py: HelperFunctions.sendEmail(request,form_class_fhalf,form_class_shalf)
           utils.py: 
            specialfordotemail = "y.chekmareva@utilitworx.com"
            <div id="error-form-wrap" style="display:none"><div class="error">Thank you for contacting us. <br />Someone will be in touch with you soon.</div></div>
        --}}
        <article id="support-form-wrap" class="small-11 small-centered medium-9 columns">
            <form action="{{route('site.support.store')}}" method="POST" id="support-form">
                <section class="row">
                    <input type="hidden" name="csrfmiddlewaretoken" value="8G6QAN7ZOBJnxnXfVptpHCsiekKIOqPX">
                    <div class="columns small-12 medium-6">
                        <input class="input-text" id="id_from_name" name="from_name" placeholder="Your Name" type="text">
                        <div class="tag-verr tag-from_name_verr"></div>
                        <input class="input-text" id="id_from_email" name="from_email" placeholder="Your Email Address" type="text">
                        <div class="tag-verr tag-from_email_verr"></div>
                        <input class="input-text" id="id_subject" name="subject" placeholder="Subject of the Email" type="text">
                        <div class="tag-verr tag-subject_verr"></div>
                        <!--<input class="input-text" type="text" placeholder="Your Name" id="" />
                            <input class="input-text" type="text" placeholder="Your Email Address" id="" />
                            <input class="input-text" type="text" placeholder="Subject of the Email" id="" />-->
                    </div>
                    <div class="columns small-12 medium-6">
                        <textarea class="input-textarea" cols="40" columns="" id="id_content" name="content" placeholder="Your Message" rows=""></textarea>
                        <!--<textarea placeholder="Your Message" class="input-textarea" ></textarea>-->
                    </div>
                    <div id="service-bottom-buttons" class="small-12 medium-12 columns">
                        <div class="buttons-wrap clearfix">
                            <button id="insight-button-second" class="submit-button action-button orange-button">Send<i class="fa fa-chevron-right"></i></button>
                        </div>
                    </div>
                </section>
            </form>
        </article>

    </section>

    <div class="bar last-bar"></div>

    @include('site::partials._joinform')
@stop
