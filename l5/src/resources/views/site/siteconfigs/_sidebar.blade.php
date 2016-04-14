<?php
$classA = [];
$classA['show'] = 'tag-clickme_to_view_profile button tiny secondary';
$classA['edit'] = 'tag-clickme_to_edit_profile button tiny secondary';
$classA['editPassword'] = 'tag-clickme_to_change_password button tiny secondary';
$classA['stories'] = 'tag-clickme_to_go button tiny secondary';
$classA['chapters'] = 'tag-clickme_to_go button tiny secondary';
if (!empty($active)) {
    $classA[$active] .= ' tag-active';
}
?>
<article class="crate-profile_sidebar tag-sidebar_style_1">
<ul class="stack button-group">
    <li>{{ link_to_route('site.profiles.show','View Profile',[$user->username],['class'=>$classA['show']]) }}</li>
    @if($is_account_owner)
    <li>{{ link_to_route('site.profiles.edit','Edit Profile',[$user->username],['class'=>$classA['edit']]) }}</li>
    <li>{{ link_to_route('site.profiles.editPassword','Change Password',[$user->username],['class'=>$classA['editPassword']]) }}</li>
    @endif
    @if ($user->hasRole('Writer') || $user->hasRole('Editor') )
    @if($is_account_owner)
    <li>{{ link_to_route('site.profiles.stories','My Stories',[$user->username],['class'=>$classA['stories']]) }}</li>
    <li>{{ link_to_route('site.profiles.chapters','My Chapters',[$user->username],['class'=>$classA['chapters']]) }}</li>
    @else
    <li>{{ link_to_route('site.profiles.stories','Stories',[$user->username],['class'=>$classA['stories']]) }}</li>
    <li>{{ link_to_route('site.profiles.chapters','Chapters',[$user->username],['class'=>$classA['chapters']]) }}</li>
    @endif
    @endif

    @if(!$is_account_owner)
    <li>{{ link_to_route('notifications.create','Message',['usernames'=>[$user->username]],['class'=>'button tiny secondary']) }}</li>
    @endif
</ul>
</article>
