<?php
?>

{{ Form::label('slug','Slug*') }}
{{ Form::text('slug',\Cl\Utils::_formval($obj,'slug'),['disabled'],['class'=>'tag-slug']) }}
<div class="tag-verr tag-slug_verr"> {{ $errors->first('slug') }} </div>

{{ Form::label('value','Value') }}
{{ Form::text('value',\Cl\Utils::_formval($obj,'value'),['placeholder'=>'value...'],['class'=>'tag-value']) }}
<div class="tag-verr tag-value_verr">{{$errors->first('value')}}</div>

{{ Form::label('data','Json Data') }}
{{ Form::textarea('data',\Cl\Utils::_formval($obj,'data'),['placeholder'=>'data...'],['class'=>'tag-data']) }}
<div class="tag-verr tag-value_verr">{{$errors->first('value')}}</div>

{{ Form::label('comment','Comment*') }}
{{ Form::text('comment',\Cl\Utils::_formval($obj,'comment'),['placeholder'=>'comment...'],['class'=>'tag-comment']) }}
<div class="tag-verr tag-comment_verr">{{$errors->first('comment')}}</div>
