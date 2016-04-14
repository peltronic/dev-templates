@extends('layouts.admin-sidebar')
@section('content')

<div class="tag-view view-users tag-index">

<section class="row">
    <article class="small-11 medium-12 columns">
        <h1>Users</h1>
    </article>
</section>

<section class="row">
    <article class="small-11 medium-12 columns">
        <span>Total Users:</span>
        <span>{{{ $data['cnt'] }}}</span>
    </article>
</section>

<section class="row">
    <article class="small-11 medium-12 columns">
        @if (Session::has('flmessage'))
            <h6>{{{ Session::get('flmessage') }}}</h6>
        @endif
    </article>
</section>

<section class="row">
    <article class="small-11 medium-12 columns">
        {{ $data['records']->appends($data['crud_table']->headerparams())->links() }}
        <table>
            <tr>
                <th>{{ $data['crud_table']->headerlink('ID','id') }}</th>
                <th>{{ $data['crud_table']->headerlink('Email','email') }}</th>
                <th>{{ $data['crud_table']->headerlink('Created','created_at') }}</th>
                <th>Is Admin?</th>
                <th>Roles</th>
            </tr>
        @foreach($data['records'] as $o)
            <?php $userR = \User::find($o->id); ?>
            <tr>
                <td>{{{$o->id}}}</td>
                <td>{{ link_to_route('admin.users.show',$o->email,$o->id) }}</td>
                <td>{{{$o->created_at}}}</td>
                <td>{{{$userR->hasRole('admin')?'yes':'no'}}}</td>
                <td>{{implode(',',$userR->getRoleNames())}}</td>
            </tr>
        @endforeach
        </table>
    </article>
</section>

</div>

@stop

@section('sidebar')
<aside class="tag-sidebar tag-panel_sidebar">
    {{ $data['crud_table']->renderFilterForm() }}
    {{ \UtAdmin\ViewHelpers::renderSidebarMenu($g_routes) }}
</aside>
@stop
