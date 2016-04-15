<section class="crate-sidebar">
    {{ Form::open(['route'=>'api.messages.store','class'=>implode(' ',$classes),'data-type'=>'text']) }}
    {{ Form::close() }}
    <form action="/admin/products" class="OFF" method="GET">
        <fieldset>
            <legend>Looking for something?</legend>
            <ol>
                <li>
                    <span><label for="vf_sid">SID</label></span>
                    <span><input type="text" class="input" id="name" name="vf_sid" value=""></span>
                </li>
                <li>
                    <span><label for="vf_price">Price</label></span>
                    <span><input type="text" class="input" id="name" name="vf_price" value=""></span>
                </li>
                <li>
                    <span><label for="f_id">Format</label></span>
                    <select name="f_id">
                        <option value="" selected="selected"></option>
                        <option value="24">1080 ProRes HQ Red Log Film (id=24)</option>
                    </select>
                </li>
                <li>
                    <span><label for="v_file_name">Video (shotname)</label></span>
                    <span><input type="text" class="input" id="name" name="v_file_name" value=""></span>
                </li>
            </ol>
        </fieldset>
        <div class="submit" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
            <input type="submit" class="tag-button" value="Search">
        </div>
    </form>
</section>
