@extends('layouts.admin-sidebar')
@section('content')

<div class="tag-view view-siteconfigs tag-index">

<section class="row">
    <article class="small-11 medium-12 columns">
@role('admin'))
    <div>This is visible to users with the admin role. Gets translated to role('admin')</div>
@endrole
        @if (1)
        TEST
        @endif
        <h1>Siteconfigs</h1>
    </article>
</section>

<section class="row">
    <article class="small-11 medium-12 columns">
        <span>Total Siteconfigs:</span>
        <span>{{{ $cnt }}}</span>
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
        {{ $records->appends($crud_table->headerparams())->links() }}
        <table>
            <tr>
                <th>{{ $crud_table->headerlink('ID','id') }}</th>
                <th>{{ $crud_table->headerlink('Slug','slug') }}</th>
                <th>Value</th>
                <th>Comment</th>
                <th>{{ $crud_table->headerlink('Created','created_at') }}</th>
            </tr>
            @foreach($records as $o)
            <tr>
                <td>{{{$o->id}}}</td>
                <td>{{ link_to_route('admin.siteconfigs.show',$o->slug,$o->id) }}</td>
                <td>{{{$o->value}}}</td>
                <td>{{$o->comment}}</td>
                <td>{{{$o->created_at}}}</td>
                {{--<td>{{link_to_route('admin.siteconfigs.edit','edit',$o->id)}}</td>--}}
            </tr>
            @endforeach
        </table>
    </article>
</section>

@stop

@section('sidebar')
<aside class="tag-sidebar tag-panel_sidebar">
    {!! $crud_table->renderFilterForm() !!}
{{--
    {{ \App\Libs\ViewHelpers::renderSidebarMenu($g_routes) }}
--}}
</aside>
@stop
