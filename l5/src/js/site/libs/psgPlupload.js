var ClPlupload = {

    _plu_context: null,
    _plu_response: null,
    _plu_meta: {},

    DEPRECATED_plu_cb_doPluSubmit: null,
    _plu_cb_afterStore: null,
    _plu_cb_FilesAdded: null,

    init: function() {
    }

} 

/* callback defined & assigend elsewhere
    afterStore: function(context,response)
    {
        var parentMessage = context.closest('li.tag-message');
        var level = context.closest('ul.tag-messagelist').data('level');
        var unit = context.closest('.crate-messages').data('unit')
        var showMsgUrl = '/api/messages/'+response.obj.id; // show

        $.getJSON(showMsgUrl, {}, function(response2) {
            ClBoards.renderMsgShow(context,response2.html);

            if (parentMessage.length > 0) {
                $.getJSON('/api/messages/getPartialsActions',
                        { 'message_id':parentMessage.data('message_id') },
                        function(response3) {
                            // This makes the formgroup disappear (replaces full html block)
                            context.closest('.tag-ctrl').html(response3.html);
                        }
                );
            } else {
$('.tag-messagelist .tag-root.tag-ctrl > .partial-create_message').fadeOut();
$('.view-boards_show .crate-formctrl > span a.tag-clickme_to_show_post_form').show();
            }
        });
    },

    init: function() {
        ClPlupload.DEPRECATED_plu_cb_doPluSubmit = ClBoards.DEPRECATEDdoPluSubmit;
        ClPlupload._plu_cb_afterStore = ClBoards.afterStore;
    }
*/
