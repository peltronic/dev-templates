<!DOCTYPE html>
<html class="no-js" lang="en">

@include('layouts._head', [])

<body class="admin">

<div id="page-wrapper" class="layout-admin page-admin">

    <header id="mast_header" class="row">
        @include('layouts._admin_header')
    </header>
    
    <div class="bar row"><div class="small-12 columns"></div></div>

    <div class="row container-admin_body">
        <div class="small-12 columns">
            @yield('content')
        </div>
    </div>

    <div class="bar"></div>

    <section id="footer-row" class="">
        @include('layouts._footer')
    </section>

</div>

<script type="application/javascript">
//var g_php2jsVars = <?php echo json_encode($g_php2jsVars); ?>;
</script>

<?php
echo $g_jsMgr->renderLibs();
echo $g_jsMgr->renderInlines();
?>
<script>
  $(document).foundation();
</script>

</body>
</html>
