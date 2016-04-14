<section class="row">
    <article class="superblock-nav small-12 columns">
        <nav>
            <ul>
                <li>{!! link_to('/','Home') !!}</li>
                <li>{!! link_to_route('site.pages.show','Services','services') !!}</li>
                <li>{!! link_to_route('site.pages.show','Portfolio','portfolio') !!}</li>
                <li>{!! link_to_route('site.pages.show','Rates','rates') !!}</li>
                <li>{!! link_to('#','Blog') !!}</li>
                <li>{!! link_to('#','Contact') !!}</li>
            </ul>
        </nav>
    </article>
</section>
