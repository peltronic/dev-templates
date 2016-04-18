<section class="row">

    <article class="col-xs-12 col-md-3" id="branding">
        <div id="site-title">
            <a href="/" title="Directory" rel="Home">
                <img class="logo" src="/static/images/mycompany-logo.jpg" alt="mycompany Logo">
            </a>
        </div>
    </article>
    
    @if (!\Auth::guest())
    <nav class="col-xs-12 col-md-8">
        <ul class="crate-nav_admin_tabs">
            <li>{{ link_to_route('admin.home','Home',[],['class'=>'btn btn-primary ']) }}</li>
            <li>{{ link_to_route('admin.siteconfigs.index','Site Configs',[],['class'=>'btn btn-primary ']) }}</li>
            <li>{{ link_to_route('admin.users.index','Users',[],['class'=>'btn btn-primary ']) }}</li>
            <li>{{ link_to('/logout','Logout',[],['class'=>'btn btn-primary tag-clickme_to_logout']) }}</li>
        </ul>
        <div class="tag-adminuser">User:{{\Auth::user()->email}}</div>
    </nav>
    @endif

</section>
