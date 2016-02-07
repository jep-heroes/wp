(function($){
    'use strict';
    $("#tabs-kcseo-container").tabs();
    $("#tabs-container").tabs();
    $('.kcseo-date').datepicker({
        dateFormat : 'yy-mm-dd'
    });

    showHideWebUrl();
    $('#homeonly').click(function () {
        showHideWebUrl();
    });
    showHideType();
    $("#site_type").change(function(){
        showHideType();
    });

    $(".select2").select2({
        placeholder: "Select an item"
    });

    $(".social-remove").on('click', function(){
        $(this).parent('.sfield').slideUp('slow').remove();
    });

    $("#social-add").on('click', function(){
        var bindElement = jQuery("#social-add");
        var count = $("#social-field-holder .sfield").length;
        var arg = 'id='+count;
        AjaxCall( bindElement, 'newSocial', arg, function(data){
            if(data.data){
                console.log(data.data);
                $("#social-field-holder").append(data.data);
            }
        });
    });

    $('.schema-tooltip').each(function() { // Notice the .each() loop, discussed below
        $(this).qtip({
            content: {
                text: $(this).next('div') // Use the "div" element next to this for the content
            },
            hide: {
                fixed: true,
                delay: 300
            }
        });
    });

})(jQuery);

function showHideWebUrl(){
    if(jQuery('#homeonly').is(':checked')){
        jQuery(".field_homepage").show();
    }else{
        jQuery(".field_homepage").hide();
    }
}

function showHideType(){
    var id =  jQuery("#site_type option:selected").val();
    if(id == "Person"){
        jQuery(".form-table tr.person").show();
    }else{
        jQuery(".form-table tr.person").hide();
    }
    if(id == "Organization"){
        jQuery(".form-table tr.business-info").hide();
    }else{
        jQuery(".form-table tr.business-info").show();
    }
}
function wpSchemaSettings(e){

    jQuery('#response').hide();
    arg=jQuery( e ).serialize();
    bindElement = jQuery('#tlpSaveButton');
    AjaxCall( bindElement, 'kcSeoWpSchemaSettings', arg, function(data){
        console.log(data);
        jQuery('#response').addClass('updated');
        if(!data.error){
            jQuery('#response').removeClass('error');
            jQuery('#response').show('slow').text(data.msg);
        }else{
            jQuery('#response').addClass('error');
            jQuery('#response').show('slow').text(data.msg);
        }
    });

}

function AjaxCall( element, action, arg, handle){
    if(action) data = "action=" + action;
    if(arg)    data = arg + "&action=" + action;
    if(arg && !action) data = arg;
    data = data ;

    jQuery.ajax({
        type: "post",
        url: ajaxurl,
        data: data,
        beforeSend: function() { jQuery("<span class='wseo_loading'></span>").insertAfter(element); },
        success: function( data ){
            jQuery(".wseo_loading").remove();
            handle(data);
        }
    });
}
