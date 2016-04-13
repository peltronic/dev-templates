<form action="{{route('site.consult.store')}}" method="POST" class="row" id="consult-form">

    <input class="input-text" id="id_contact_name" name="contact_name" placeholder="Name*" type="text">
    <div class="tag-verr tag-contact_name_verr"></div>

    <input class="input-text" id="id_contact_email" name="contact_email" placeholder="Email*" type="text">
    <div class="tag-verr tag-contact_email_verr"></div>

    <input class="input-text" id="id_contact_phone" name="contact_phone" placeholder="Phone*" type="text">
    <div class="tag-verr tag-contact_phone_verr"></div>

    <input class="input-text" id="id_contact_zip_code" name="contact_zip_code" placeholder="Zip Code" type="text">
    <div class="tag-verr tag-contact_zip_code_verr"></div>

    <input class="input-text" id="id_contact_topic" name="contact_topic" placeholder="Topic*" type="text">
    <div class="tag-verr tag-contact_topic_verr"></div>

    <textarea class="input-textarea" cols="40" columns="" id="id_contact_message" name="contact_message" placeholder="Message*" rows=""></textarea>
    <div class="tag-verr tag-contact_message_verr"></div>

    <input name="requesttype" type="hidden" value="{{$requesttype or 'none'}}">
    <input id="id_which_form" name="which_form" type="hidden" value="4">
    <input type="hidden" name="csrfmiddlewaretoken" value="8G6QAN7ZOBJnxnXfVptpHCsiekKIOqPX">

    <div id="service-bottom-buttons">
        <button id="insight-button-second" class="submit-button action-button orange-button">Send Message<i class="fa fa-chevron-right"></i></button>
    </div>

</form>
