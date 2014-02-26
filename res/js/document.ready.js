/**/
jQuery( document ).ready(function() { 

    jQuery("input[name|='post_direction']").picker({ toggle: true, labels: {on: "LTR", off: "RTL"} }); 
    jQuery("#post_direction-title").click( function () { 
        //alert( (this) ); 
        //title_checkbox = jQuery("#post_direction-title").attr('checked');
        title_checkbox = jQuery("#post_direction-title").prop("checked");
        if (title_checkbox == true)
        {
            //alert( 'yes' ); console.log("LTR");
            jQuery("input#title").css("direction", "ltr")
        }
        else
        {
            //alert( 'no' ); console.log("RTL");
            jQuery("input#title").css("direction", "rtl")
        }
    });

    jQuery("#post_direction-content").click( function () { 
        //alert( (this) ); 
        //title_checkbox = jQuery("#post_direction-title").attr('checked');
        title_checkbox = jQuery("#post_direction-content").prop("checked");
        if (title_checkbox == true)
        {
            //alert( 'yes' ); console.log("LTR");
            jQuery("#content_ifr").contents().find("#tinymce").css("direction", 'ltr')
            jQuery("textarea#content").css("direction", "ltr")

        }
        else
        {
            //alert( 'no' ); console.log("RTL");
            jQuery("#content_ifr").contents().find("#tinymce").css("direction", 'rtl')
            jQuery("textarea#content").css("direction", "rtl")

        }
    });

    if ( jQuery("#post_direction-title").prop("checked") ) {
        jQuery("input#title").css("direction", "ltr");
    }
    else {
        jQuery("input#title").css("direction", "rtl");
    }

    if ( jQuery("#post_direction-content").prop("checked") ) {
        jQuery("#content_ifr").contents().find("#tinymce").css("direction", 'ltr');
        jQuery("textarea#content").css("direction", "ltr");        
    } 
    else{
        jQuery("#content_ifr").contents().find("#tinymce").css("direction", 'rtl')
        jQuery("textarea#content").css("direction", "rtl")
    };

});