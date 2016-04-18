<!DOCTYPE html>
<html lang="en">

@include('layouts._head', [])

<body id="app-layout" class="admin">

<header class="container">
    @include('layouts._admin_header')
</header>
    
<div id="container-content" class="container">
    @yield('content')
</div>

<footer>
    @include('layouts._footer')
</footer>

<script type="application/javascript">
//var g_php2jsVars = <?php echo json_encode($g_php2jsVars); ?>;
</script>

<?php
echo $g_jsMgr->renderLibs();
echo $g_jsMgr->renderInlines();
?>

</body>
</html>
