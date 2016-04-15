<article id="branding" class="supercrate-branding small-12 medium-3 columns">
    <div id="site-title">
        <a href="/" title="Directory" rel="Home">
            <img class="logo" src="/static/images/mycompany-logo.jpg" alt="mycompany Logo">
        </a>
    </div>
</article>
@if (!\Auth::guest())
<article class="supercrate-nav small-12 medium-8 columns">
    <ul class="crate-nav_admin_tabs">
        <li>{{ link_to_route('admin.home','Home',[],['class'=>'button tiny radius']) }}</li>
        <li>{{ link_to_route('admin.subscribers.index','Subscribers',[],['class'=>'button tiny radius']) }}</li>
        <li>{{ link_to_route('admin.supportemails.index','Support',[],['class'=>'button tiny radius']) }}</li>
        <li>{{ link_to_route('admin.consultrequests.index','Requests',[],['class'=>'button tiny radius']) }}</li>
        <li>{{ link_to_route('admin.users.index','Users',[],['class'=>'button tiny radius']) }}</li>
        <li>{{ link_to_route('admin.dologout','Logout',[],['class'=>'button tiny radius tag-clickme_to_logout']) }}</li>
    </ul>
    <div class="tag-adminuser">User:{{\Auth::user()->email}}</div>
</article>
@endif
