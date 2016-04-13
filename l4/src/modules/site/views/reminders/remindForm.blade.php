@extends('layouts.site')

@section('content')

<section class="row">
  <article class="crate-password_remind medium-12 columns">

    <h2>Forgotten Password</h2>

    {{ Form::open(array('route'=>'site.password.postForgot', 'method'=>'POST', 'class'=>'form-custom form-remind_password')) }}

        <div class="row">
            <div class="small-4 columns">
                {{ Form::label('email','Email Address*') }}
                {{ Form::text('email', \Input::old('email'), ['class'=>'formelem-custom','placeholder'=>'Type in E-mail to reset password']) }}
                <div class="tag-verr tag-email_verr"></div>
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
