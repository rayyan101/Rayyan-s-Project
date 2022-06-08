
jQuery(document).ready(function($){

    $("#keyword").on("keyup",function(){
    
        var keyword = $(this).val();
        
        console.log(keyword);
        
       
        jQuery.ajax({
            url:   ajax_object.ajax_url,
            type: 'post',
            data: { action: 'data_fetch', keyword: jQuery('#keyword').val() },
            success: function(data) {
                // jQuery('#datafetch').html( data );
    
                console.log(data)
            }
        });
    
    
    
    
    })
    
    
    
    });