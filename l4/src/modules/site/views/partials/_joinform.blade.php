    <section id="email-row">
        <div class="row">
            <article class="small-12 columns">
                <div id="email-header" class="underlined-header">
                    <h3>Join Our Email List</h3>
                </div>
                <p id="email-para">Be sure to stay in touch with UTILITWORX to learn more about upcoming products, latest trends, and success stories.</p>
            </article>
            <article class="crate-newsletter_form medium-12 columns">
                <form id="newsletter-form" action="{{route('site.newsletter.store')}}" method="POST">
                    <div class="small-12 medium-6 medium-offset-2 columns">
                        <input class="email-input" id="email-input" name="email" placeholder="Email Address..." type="text">
                        <div class="tag-verr tag-email_verr"></div>
                        <input type="hidden" name="csrfmiddlewaretoken" value="8G6QAN7ZOBJnxnXfVptpHCsiekKIOqPX">
                    </div>
                    <div class="small-12 medium-2 columns end">
                        <button class="join-now action-button orange-button">Join<i class="fa fa-chevron-right"></i></button> 
                    </div>
                </form>
                <div id="news-form-wrap" class="small-12 columns"></div> <!-- for validation error msg -->
            </article>
        </div>
    </section>
