@extends('layouts.admin')
@section('content')

<section class="row view-configs tag-view">
    <article class="small-11 medium-12 columns">
            <h1>Configs</h1>
    </article>
</section>

<section class="row view-configs tag-view">
    <article class="small-11 medium-12 columns">
        <span>Total Subscribers:</span>
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
        {{ $data['records']->links() }}
        <table>
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Value</th>
                <th>Comment</th>
                <th>Created</th>
                <th></th>
            </tr>
            @foreach($data['configs'] as $o)
            <tr>
                <td>{{{$o->id}}}</td>
                <td>{{ link_to_route('admin.configs.show',$o->slug,$o->id) }}</td>
                <td>{{{$o->value}}}</td>
                <td>{{$o->comment}}</td>
                <td>{{{$o->created_at}}}</td>
                <td>{{link_to_route('admin.configs.edit','edit',$o->id)}}</td>
            </tr>
            @endforeach
        </table>
    </article>
</section>

@stop

@section('sidebar')
    @include('admin::configs._indexSearch')
@stop
