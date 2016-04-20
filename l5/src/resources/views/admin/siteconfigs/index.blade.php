@extends('layouts.admin')
@section('content')

<div class="tag-view view-siteconfigs tag-index">

    <section class="row"> 

        <aside class="col-xs-11 col-md-4 tag-sidebar">
            {!! $crud_table->renderFilterForm() !!}
        </aside>

        <article class="col-xs-11 col-md-8">
            <section class="row">
                <article class="col-xs-12">
                    <h1>Siteconfigs</h1>
                    @role('admin')
                        <div>This is visible to users with the admin role. Gets translated to role('admin')</div>
                    @endrole
                </article>
            </section>
            <section class="row">
                <article class="col-xs-12">
                    <span>Total Siteconfigs:</span>
                    <span>{{{ $cnt }}}</span>
                </article>
            </section>
            <section class="row">
                <article class="col-xs-12">
                    @if (Session::has('flmessage'))
                        <h6>{{{ Session::get('flmessage') }}}</h6>
                    @endif
                </article>
            </section>
            <section class="row">
                <article class="col-xs-12">
                    {{ $records->appends($crud_table->headerparams())->links() }}
                    <table class="table">
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
        </article>

    </section>

@endsection
