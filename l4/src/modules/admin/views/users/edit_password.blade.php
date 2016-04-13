@extends('layouts.admin-sidebar')
@section('content')
@include('admin::users._changePasswordForm',['user'=>$user,'errors'=>$errors])
@stop

@section('sidebar')
<aside class="tag-sidebar tag-panel_sidebar">
    {{ \UtAdmin\ViewHelpers::renderSidebarMenu($g_routes) }}
</aside>
@stop
