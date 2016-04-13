@extends('layouts.admin')
@section('content')

<div class="row">

    <section class="small-12 columns view-login">

        <article class="crate-login">

@if(\Session::has('message'))
        <div class="alert-box success">
            <h4>{{ \Session::get('message') }}</h4>
        </div>
@endif
            <section class="row">
                <article class="small-12 medium-5 medium-centered columns">
                    <h2>Login Here</h2>
                </article>
            </div>
            <section class="row">
                <article class="small-12 medium-5 medium-centered columns">

                    {{ Form::open(array('route'=>'admin.dologin', 'method'=>'POST', 'class'=>'form-custom form-login')) }}

                    {{ Form::label('email','Email Address') }}
                    {{ Form::text('email', null, ['class'=>'form-control','placeholder'=>'Enter email...']) }}
                    <div class="tag-verr tag-email_verr"></div>
                    
                    {{ Form::label('password','Password') }}
                    {{ Form::password('password', ['class'=>'form-control','placeholder'=>'Enter password...']) }}
                    <div class="tag-verr tag-password_verr"></div>

                    {{ Form::submit('Login', ['class'=>'button small radius tag-clickme_to_login tag-login-btn'])}}

                    <?php //dd($errors); ?>
                    <ul class="errors">
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                    @if(\Session::has('meta_error'))
                        <li>{{ \Session::get('meta_error') }}</li>
                    @endif
                    </ul>

                    {{ Form::close() }}

                </article>
            </section>

        </article>

    </section>

</div>

@stop
