@extends('layouts.admin')
@section('content')

<section class="small-12 columns subcontainer-view view-configs_edit">
    <div class="row">
        <div class="columns small-12">
            <h1>Edit Config</h1>
        </div>
    </div>

    <article class="row">
        <div class="columns small-12 medium-6">
            {{ Form::open(['route'=>['admin.configs.update',$obj->id],'method'=>'PUT','class'=>'form-edit_config']) }}

            @include('admin::configs._form',['obj'=>$obj])

            <div class="form-ctrl">
                {{ Form::submit('Save', ['aria-label'=>'post', 'class'=>'button tiny radius'])}}
                {{ link_to_route('admin.configs.index','Cancel',null,['class'=>'tag-clickme_to_cancel_edit_message button tiny radius']) }}
            </div>
            {{ Form::close() }}
        </div>
    </article>
</section>
@stop

@section('sidebar')
    {{ \ClAdmin\ViewHelpers::renderSidebarMenu($g_routes) }}
@stop
