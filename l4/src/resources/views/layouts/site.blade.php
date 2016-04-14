<html>
<head>
    <title>@yield('title')</title>
    @include('layouts._head')
</head>
<body>
    @include('layouts._nav')

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
