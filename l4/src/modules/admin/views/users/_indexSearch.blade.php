<section class="crate-sidebar">
    {{ Form::open(['route'=>'admin.users.index','method'=>'GET','class'=>'form-index_search','data-type'=>'text']) }}
        <fieldset>
            <legend>Search Messages</legend>
            {{ Form::label('username','Username') }}
            {{ Form::text('username',Input::old('username'),['class'=>'OFF']) }}
            {{ Form::label('email','Email') }}
            {{ Form::text('email',\Input::old('email'),['class'=>'OFF']) }}
            {{ Form::submit('Search', ['aria-label'=>'search', 'class'=>'button tiny radius'])}}
        <fieldset>
    {{ Form::close() }}
</section>
