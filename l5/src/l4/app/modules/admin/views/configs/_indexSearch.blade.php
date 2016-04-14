<section class="crate-sidebar">
    {{ Form::open(['route'=>'admin.universities.index','method'=>'GET','class'=>'form-index_search','data-type'=>'text']) }}
        <fieldset>
            <legend>Search Messages</legend>
            {{ Form::label('slug','Slug') }}
            {{ Form::text('slug',\Input::old('slug'),['class'=>'OFF']) }}
            {{ Form::submit('Search', ['aria-label'=>'search', 'class'=>'button tiny radius'])}}
        <fieldset>
    {{ Form::close() }}
</section>
