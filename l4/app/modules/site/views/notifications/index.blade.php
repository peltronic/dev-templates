@extends('layouts.site')
@section('content')

<?php
$liClasses = ['tag-notification'];
?>

<div class="supercrate-notifications_index">

<section class="row view-notifications_show">
    <article class="small-12 medium-12 columns">
        @if (\Auth::user()->id == $user->id)
        <h3 class="tag-page_title">My Notifications</h3>
        @else
        <h3 class="tag-page_title">{{{$user->username}}}'s Notifications ({{{$user->getUniversity()->name}}})</h3>
        @endif
        <div class="tag-total_notifications hide" data-total_notifications={{intval($total_notifications)}}>{{intval($total_notifications)}} notifications</div>{{-- %FIXME: put in sidebar --}}
    </article>
</section>

<section class="row view-notifications_show">

    <article class="crate-notifications small-12 columns" data-unit="my">
        <ul class="tag-notificationlist tag-bgwhite">
            @foreach ($notifications as $i => $n)
            <li class="{{implode(' ',$liClasses)}}" data-notification_id="{{$n->id}}" >
                    <div class="tag-content">
                        <span>{{$n->message}}</span>
                        <span class="tag-dash">-</span>
                        <span class="tag-datetime">{{\Cl\ViewHelpers::getTimeElapsed($n->created_at)}}</span>
                    </div>
                    @if (\Auth::user()->id == $n->notifyee_id)
                        {{\ClSite\ViewHelpers::renderNotificationDeleteIcon($user,$n)}}
                    @endif
                </li>
            @endforeach
        </ul>
    </article>

</section>
</div>

<script type="text/javascript">
    mixpanel.track('Viewed Notification Board', {"unit":"my","parent":"board" });
</script>
@stop

