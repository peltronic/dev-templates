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
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {!! \App\Libs\ViewHelpers::linkToRouteWithHtml('site.auth.doFacebookLogin','<i class="fa fa-lg fa-facebook"></i>Login with Facebook',null,['class'=>'btn btn-primary tag-clickme_to_login_with_facebook']) !!}
                    </div>
                </div>
            </form>
            <div class="panel-body">
            </div>
@endif
        </div>
    </div>
</div>
@endsection
