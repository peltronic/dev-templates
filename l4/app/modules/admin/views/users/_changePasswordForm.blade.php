<div class="partial-change_password">

    <section class="row">
        <article class="tag-heading small-11 medium-offset-2 medium-6 columns">
            <h3>Change Password</h3>
        </article>
    </section>

    <section class="row">
        <article class="tag-body small-11 medium-offset-2 medium-6 columns">

            {{ Form::open(['route'=>['admin.users.updatePassword',$user->id], 'method'=>'PUT', 'class'=>'form-generic form-change_password']) }}
    
            {{ Form::label('password','New Password') }}
            {{ Form::password('password', null, ['class'=>'form-control', 'placeholder'=>'Type to change password']) }}
            <div class="tag-verr tag-password_verr"></div>
    
            {{ Form::label('password_confirmation','Retype Password') }}
            {{ Form::password('password_confirmation', null, ['class'=>'form-control', 'placeholder'=>'Retype to confirm password']) }}
            <div class="tag-verr tag-password_confirmation_verr"></div>
    
    
            <div class="tag-submit">
                {{ Form::submit('Save New Password', ['class'=>'button small radius tag-save_profile-btn'])}}
                {{ link_to_route('admin.users.show','Cancel',[$user->id],['class'=>'tag-clickme_to_cancel button small radius secondary']) }}
            </div>

            <div class="tag-errors">
                <?php //dd($errors); ?>
                <ul class="errors">
                @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
                </ul>
            </div>
    
            {{ Form::close() }}

        </article>
    </section>

</div>
