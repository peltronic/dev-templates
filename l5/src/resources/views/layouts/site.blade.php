<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('layouts._head')
</head>

<body id="app-layout">

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        @include('layouts._nav')
    </div>
</nav>

<div id="container-content" class="container">
    @yield('content')
</div>

<footer class="container">
    @include('layouts._footer')
</footer>

<?php echo $g_jsMgr->renderLibs(); ?>
<script>

/*
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
*/
</script>
<?php echo $g_jsMgr->renderInlines(); ?>

</body>

</html>
