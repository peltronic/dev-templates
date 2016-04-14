@extends('layouts.site')

@section('content')
<div class="container-contact">
	<h1 class="page-title">Contact Us</h1>
    <form method="POST" action="/contact-us_post" accept-charset="UTF-8" class="form" role="form"><input name="_token" type="hidden" value="FCcecwnfjjlyo50acnnS8jkixz0oV6qt2uVQtoNT">        <input name="redirect_to" type="hidden" value="/">    
    <div class="form-group">
    	<label>Name</label>
    	<input class="form-control ltr" placeholder="Name ..." name="name" type="text">    </div>
    <div class="form-group">
    	<label>Phone</label>
    	<input class="form-control ltr" placeholder="Phone ..." name="phone" type="text">    </div>
    <div class="form-group">
    	<label>Email</label>
    	<input class="form-control ltr" placeholder="Email ..." name="email" type="text">    </div>

    <div class="form-group">
    	<label>Message</label>
    	<textarea rows="5" cols="43" class="form-control ltr" placeholder="Message ... " name="message"></textarea>    </div>

	<input class="btn btn-sm btn-primary" type="reset" value="CLEAR FORM">	
    <input class="btn btn-sm btn-primary" type="submit" value="SEND">

    </form>
</div>
@stop
