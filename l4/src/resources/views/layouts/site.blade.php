<html>
<head>
    <title>App Name - @yield('title')</title>
    @include('layouts._head')
</head>
<body>
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

    {{--
    @section('sidebar')
        This is the master sidebar.
    @show
    --}}

    <div class="container">
        @yield('content')
    </div>
    @include('layouts._scripts')
<script>
{{--
$(document).ready(function(){
    alert('Foundation Core Version: ' + Foundation.version);
    alert('Foundation DropDown Version:' + Foundation.libs.dropdown.version);
});
--}}
</script>
</body>
</html>
