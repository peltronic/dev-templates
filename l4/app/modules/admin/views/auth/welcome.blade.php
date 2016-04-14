
@extends('layouts.home')
@section('content')

<section class="small-12 columns view-welcome">

    <article class="crate-register hideme">
        <h2>Create Account</h4>
        {{ Form::open(array('route'=>'site.doregister', 'method'=>'POST', 'class'=>'form-custom form-register')) }}
        <div class="row">
            <div class="small-12 medium-4 large-4 columns">
                @include('site::partials._registerFormFieldset',[])
            </div>
        </div>
        <div class="row">
            <div class="medium-2 columns">
                {{ Form::submit('Sign Up', array('class'=>'button small radius tag-register-btn'))}}
            </div>
            <div class="medium-3 columns end">
                {{ link_to('#','Already Have An Account?',['class'=>'tag-clickme_to_login']) }}
            </div>
            {{ Form::close() }}
        </div>
        <div class="row">
            <?php //dd($errors); ?>
            <ul class="errors">
            @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
            </ul>
        </div>
    </article>

    <article class="crate-login hideme">
        <h2>Login Here</h4>
        {{ Form::open(array('route'=>'site.dologin', 'method'=>'POST', 'class'=>'form-custom form-login')) }}
        <div class="row">
            <div class="small-12 medium-4 large-4 columns">
                @include('site::partials._loginFormFieldset',[])
            </div>
        </div>
        <div class="row">
            <div class="medium-2 columns">
                {{ Form::submit('Login', array('class'=>'button small radius tag-login-btn'))}}
            </div>
            <div class="medium-3 columns end">
                {{ link_to('#','New User?',['class'=>'tag-clickme_to_register']) }}
            </div>
            {{ Form::close() }}
        </div>
        <div class="row">
            <div class="small-6 medium-6 large-6 columns">
                {{ link_to_route('site.password.getForgot','Forgot Password?',[],['class'=>'tag-clickme_to_reset_password']) }}
            </div>
            {{ Form::close() }}
        </div>
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
