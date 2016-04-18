<div class="tag-listfilterform panel-body">
    {{ Form::open(['route'=>$route,'method'=>'GET','class'=>'form-index_search form-horizontal','data-type'=>'text']) }}
        <fieldset>
            <legend>Search</legend>

            @foreach ($avail_filters as $f)
                <div class="form-group{{ $errors->has($f) ? ' has-error' : '' }}">
                    {{ Form::label($f,ucfirst($f), ['class'=>'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text($f,\Input::old($f),['class'=>'form-control']) }}
                        @if ($errors->has($f))
                            <span class="help-block"><strong>{{$errors->first($f)}}</strong></span>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                {{ Form::submit('Search', ['aria-label'=>'search', 'class'=>'btn btn-primary'])}}
                {{ link_to($clear_url,'Clear',['class'=>'btn btn-default']) }}
            </div>
            {!! csrf_field() !!}
        <fieldset>
    {{ Form::close() }}
</div>
