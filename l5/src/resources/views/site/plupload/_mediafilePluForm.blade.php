{{--
    [ ] if mediafile is not associated with any other object, just do a noop for $submitURL
    [ ] belongs_to_pkid should be part of storePluURL
    https://github.com/moxiecode/plupload/blob/e8b7cc3535cb25f7148366ee8987c72ce127daed/examples/jquery/jquery_ui_widget.html
--}}
{!! Form::open(['url'=>$submitURL,'enctype'=>'multipart/form-data','files'=>true,'class'=>implode(' ',$classes),'data-type'=>'image']) !!}

    <div class="row">
        <div class="col-md-12">
            {!! Form::label('title','Title*') !!}
            {!! Form::text('title',null,['class'=>'form-control', 'placeholder'=>'Type a title...']) !!}
            <div class="tag-verr tag-title_verr"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a id="plu-pickfiles" class="tag-clickme_to_add_file btn btn-primary" href="javascript:;" data-store_plu_url="{{$storePluURL}}">Add File</a> 
            <div class="tag-verr tag-mediafile_verr"></div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="tag-plu_filelist" id="plu-filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>

            <div id="plu-container" class="tag-plu_container">
                {{-- <a id="plu-pickfiles" href="javascript:;">[Select files]</a>  --}}
                {{-- <a id="plu-uploadfiles" href="javascript:;">[Upload files]</a> --}}
            </div>
        </div>
    </div>

    {{--
    <div class="row hide">
        <div class="small-6 columns">
            <pre id="console"></pre>
        </div>
    </div>
    --}}

    <div class="row">
        <div class="col-md-12 superbox-formctrl">
            {{-- Form::hidden('belongs_to_pkid',$parent_id) --}}
            {!! Form::submit('Submit', ['id'=>'plu-submit_upload','aria-label'=>'post', 'class'=>'btn btn-primary'])!!}
            {!! link_to('#','Cancel',['class'=>'tag-clickme_to_cancel_create_message btn btn-default']) !!}
        </div>
    </div>

{!! Form::close() !!}
