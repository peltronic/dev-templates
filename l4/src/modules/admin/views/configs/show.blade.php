@extends('layouts.admin')
@section('content')

<section class="small-12 columns subcontainer-view view-configs_show">
    <div class="row">
        <h1>Config {{{ $obj->slug }}}</h1>
    </div>

    <article class="row">
        <table>
            <tr>
                <td>PKID:</td>
                <td>{{{$obj->id}}}</td>
            </tr>
            <tr>
                <td>Slug:</td>
                <td>{{{$obj->slug}}}</td>
            </tr>
            <tr>
                <td>Value:</td>
                <td>{{$obj->value}}</td>
            </tr>
            <tr>
                <td>Comment:</td>
                <td>{{$obj->comment}}</td>
            </tr>
            <tr>
                <td>Data:</td>
                <td>{{$obj->data}}</td>
            </tr>
            <tr>
                <td>Created:</td>
                <td>{{{$obj->created_at}}}</td>
            </tr>
        </table>
    </article>

</section>

@stop

@section('sidebar')
    {{ \ClAdmin\ViewHelpers::renderSidebarMenu($g_routes) }}
@stop
