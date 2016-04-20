$( document ).ready(function() {

    var pluHelper = {

        _context: null,
        _response: null,
    
        //DEPRECATED_plu_cb_doPluSubmit: null,
        _afterStore: null,
        //_plu_cb_FilesAdded: null,
    
        reset: function() {
            this._response = null;
        },
        init: function() {
            // http://stackoverflow.com/questions/4616202/self-references-in-object-literal-declarations
            //return this;
        }
    
    };

    // %TODO %FIXME: Can we move this into a library??
    $("#plu-container").plupload({
        

	    runtimes : 'html5,flash,silverlight,html4',
	    file_data_name : 'mediafile', // name of attr used in controller to grab file: Input::hasFile('mediafile')
	    browse_button : 'plu-pickfiles', // you can pass an id...
	    //container: document.getElementById('plu-container'), // ... or DOM Element itself
	    url : $('#plu-pickfiles').data('store_plu_url'), // uploader.settings.url

        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },
 
        flash_swf_url : '/js/vendor/plupload/Moxie.swf', // Flash settings
     
        silverlight_xap_url : '/js/vendor/plupload/js/Moxie.xap', // Silverlight settings

	    filters : {
		    max_file_size : '20mb',
		    mime_types: [ {title : "Image files", extensions : "jpg,jpeg,gif,png"} ]
	    },
    
	    init: {
		    PostInit: function() {
			    document.getElementById('plu-filelist').innerHTML = '';
    
                    // Promises...
                    // (1) Do form upload
                    // (2) Do plupload (files)
                    //   ~ need to attach pkid of new newly created message (or 
                    //   related obj) so files attach to it
                    // (3) Do rendering stuff
                    // ---
                    //ClBoards.doPluSubmit(context,cbStartUploader);
                    // ?? %TODO %FIXME: call function here, but have a hook for  
                    // (1) pre-ajax stuff
                    // (2) ajax callback stuff

			    document.getElementById('plu-submit_upload').onclick = function(e) {

                    e.preventDefault();
                    var context = $(this).closest('form');
                    pluHelper._context = context;

                    psgFormUtils.clearErrors(context);

                    $.ajax({
                        url     : context.attr('action'), // %FIXME: case where this is null (no assoc obj)
                        type    : 'POST', 
                        dataType: 'json',
                        data    : context.serialize(),
                        success : function( response ) {
                            if (!response.is_ok) {
                                psgFormUtils.renderErrors(context,response);
                            } else {
                                pluHelper._response = response;
                                // Form upload is done, now do the Plupload (files)
                                //uploader.settings.multipart_params = {"related_obj_id":response.obj.id};
                                uploader.settings.url += '/'+response.obj.id; // %FIXME only if exist
				                uploader.start();
                            }
                        },
                        error   : function( xhr, err ) {
                            console.log('ERROR');
                        }
                    });
				    return false;
			    };
		    }, // PostInit()

            BeforeUpload: function(up, file) {
                // attach per-upload caption if any %FIXME: ??
                var captionVal = $('input[name=caption-'+file.id+']').val();
                $.extend(up.settings.multipart_params,{"caption":captionVal});
		    },

            // Called when all files are either uploaded or failed
            UploadComplete: function(up, files) {
                psgFormUtils.clearVals(pluHelper._context);
                pluHelper._afterStore(pluHelper._context,pluHelper._response); 
                pluHelper.reset();
			    document.getElementById('plu-filelist').innerHTML = '';
                console.log('[UploadComplete]');
            },
    
		    FilesAdded: function(up, files) {
			    plupload.each(files, function(file) {
                    var html = '<div class="superbox-file">';
				    html += '<span id="'+file.id+'">'+file.name+' ('+plupload.formatSize(file.size)+') <b></b>'+'</span>';
                    html += '<span><input class="tag-caption" placeholder="Type a caption..." name="caption-'+file.id+'" type="text" value="" data-file_id="'+file.id+'" id="caption-'+file.id+'"></span>';
                    html += '</div>';
				    document.getElementById('plu-filelist').innerHTML += html;
			    });
                console.log('[FilesAdded]');
		    }, // FilesAdded()
    
		    UploadProgress: function(up, file) {
			    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>'+file.percent+"%</span>";
		    },
    
		    Error: function(up, err) {
			    console.log("Error #"+err.code+": "+err.message);
		    }

	    } 
    }); //plupload.Uploader()

    // %FIXME:
    $(document).on('blur', 'input.tag-caption', function(e) {
        e.preventDefault();
        var context = $(this);
        var fileID = context.data('file_id');
        var val = context.val();
        context.attr('value',val); // %FIXME %NOTE: workaround b/c input vals keep getting removed ??
        return false;
    });

    
    //uploader.init();
    
});

                /*
        for (var i in files) {
            $('#filelist').append('<div style="height:75px;border-bottom:1px solid #666" id="' + files[i].id + '"> <small>Fichier :' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ')</small><b></b><i></i><div><label>Titre <input id="' + files[i].id + 'Titre" type="text" size="25" name="media[' + files[i].id + '][titre]" value="" /></label><label>Légende <input id="' + files[i].id + 'Legende" type="text" size="25" name="media[' + files[i].id + '][legende]" value="" /></label> <label><input id="' + files[i].id + 'Marquage" type="checkbox" checked="checked" name="media[' + files[i].id + '][marquage]" value="1"/><small>Copyright Journal</small></label><input type="hidden" name="media[' + files[i].id + '][uploaded]" value="0" /></div></div>');
            }
            */
                /*
                $.extend(up.settings.multipart_params, 
                    { 
                        legende : $('#' + file.id + 'Legende').val(), 
                        titre : $('#' + file.id + 'Titre').val(), 
                        marquage :  $('#' + file.id + 'Marquage').is(':checked')
                    }
                );
                */
                    /*
				    document.getElementById('plu-filelist').innerHTML += '<div id="' + file.id + '">' 
                            + file.name 
                            + ' (' + plupload.formatSize(file.size) + ')' 
                            + '<b></b></div>';
var captionVal = ClPlupload._meta[file.id] === undefined ? '' :  ClPlupload._meta[file.id];
ClPlupload._meta[file.id] = {"val":captionVal};
                            */
                /*
			    $('input.tag-caption').each(function(i, elem) {
                    var fileID = $(elem).data('file_id');
                    $(elem).val(ClPlupload._meta[fileID]);
                });
                */
			    //document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
