<section class="crate-sidebar tag-filterform">
    {{ Form::open(['route'=>$route,'method'=>'GET','class'=>'form-index_search','data-type'=>'text']) }}
        <fieldset>
            <legend>Search</legend>

            @foreach ($avail_filters as $f)
            {{ Form::label($f,ucfirst($f)) }}
            {{  Form::text($f,\Input::old($f),['class'=>'OFF']) }}
            @endforeach

            <div class="form-ctrl">
                {{ Form::submit('Search', ['aria-label'=>'search', 'class'=>'button tiny radius'])}}
                {{ link_to($clear_url,'Clear',['class'=>'button tiny radius secondary']) }}
            </div>
        <fieldset>
    {{ Form::close() }}
</section>
