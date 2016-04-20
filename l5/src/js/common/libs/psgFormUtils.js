var psgFormUtils = {

    //_plu_context: null,

    renderErrors: function(context,response) {
        $.each( response.messages, function(key, value) {
            var classStr = 'tag-'+key+'_verr'; 
            context.find('.'+classStr).html(value);
            console.log(key+': '+value);
        });
    },

    clearErrors: function(context) {
        context.find('.tag-verr').html(''); // clear any validation err messages on submit
    },

    clearVals: function(context) {
        context.find('input[type=text]').val('');
        context.find('textarea').val('');
    },

    init: function() {
    }

} 
