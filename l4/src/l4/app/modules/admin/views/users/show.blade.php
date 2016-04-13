@extends('layouts.admin-sidebar')
@section('content')

<?php $userR = \User::find($user->id); ?>

<div class="tag-view view-supportemails tag-show">

<section class="row">
    <article class="small-11 medium-12 columns">
        <h1>User {{{ $user->email }}}</h1>
    </article>
</section>

<section class="row">
    <article class="small-11 medium-12 columns">
        <table>
            <tr>
                <td>Email:</td>
                <td>{{{$user->email}}}</td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>{{{$user->name}}}</td>
            </tr>
            <tr>
                <td>Roles:</td>
                <td>{{implode(',',$userR->getRoleNames())}}</td>
            </tr>
            <tr>
                <td>Created:</td>
                <td>{{{$user->created_at}}}</td>
            </tr>
        </table>
    </article>
</section>

</div>

@stop

@section('sidebar')
<aside class="tag-sidebar tag-panel_sidebar">
    {{ \UtAdmin\ViewHelpers::renderSidebarMenu($g_routes) }}
</aside>
@stop
