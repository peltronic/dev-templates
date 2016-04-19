@extends('layouts.site')

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Welcome</div>
            <div class="panel-body">
                Your Application's Landing Page.
            </div>
@if (\Auth::guest())
            <div class="panel-heading">Login</div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                @include('auth._login')
                {!! \App\Libs\ViewHelpers::linkToRouteWithHtml('auth.doFacebookLogin','<i class="fa fa-lg fa-facebook"></i>Login with Facebook',null,['class'=>'button small radius tag-clickme_to_login_with_facebook']) !!}
            </form>
            <div class="panel-body">
            </div>
@endif
        </div>
    </div>
</div>
@endsection
