@extends('layouts.site')

@section('content')

<section class="row">
<article class="crate-password_reset medium-12 columns">

    <h2>Reset Password</h2>

    {{ Form::open(array('route'=>'site.password.postReset', 'method'=>'POST', 'class'=>'form-custom form-reset_password')) }}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="row">
            <div class="small-4 columns">
                {{ Form::label('email','Email Address*') }}
                {{ Form::text('email', \Input::old('email'), ['class'=>'formelem-custom','placeholder'=>'Confirm E-mail']) }}
                <div class="tag-verr tag-email_verr"></div>
            </div>
        </div>

        <div class="row">
            <div class="small-4 columns">
                {{ Form::label('password','New Password*') }}
                {{ Form::password('password', ['class'=>'formelem-custom','placeholder'=>'Type New Password']) }}
                <div class="tag-verr tag-password_verr"></div>
            </div>
        </div>

        <div class="row">
            <div class="small-4 columns">
                {{ Form::label('password','Confirm Password*') }}
                {{ Form::password('password_confirmation', ['class'=>'formelem-custom','placeholder'=>'Confirm Password']) }}
                <div class="tag-verr tag-password_confirmation_verr"></div>
            </div>
        </div>

        <input type="submit" value="Reset Password">
    {{ Form::close() }}

    <div class="row">
        <?php //dd($errors); ?>
        <ul class="errors">
        @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach
        </ul>
    </div>
</article>
</section>

@stop
