
jQuery(document).ready(function($){  
    $("#keyword").on("keyup",function(){
        var keyword = $(this).val();
        jQuery.ajax({
            url:   ajax_object.ajaxurl,
            type: 'POST',
            data: { 
                action: 'data_fetch',  
                keyword: keyword 
            },
            success: function(data) {
                jQuery('#datafetch').html( data );
            }
        });
    });



    
    $("#language").change(function(){
        var keyword = $(this).find("option:selected").val();

        // alert(keyword);
        jQuery.ajax({
            url:   ajax_object.ajaxurl,
            type: 'POST',
            data: { 
                action: 'data_drop', 
                keyword: keyword 
            },
            success: function(data) {
                jQuery('#datafetch').html( data );
            }
        });

    

    });

});




    // $("#ddlFruits").onChange(function(){
    //     alert("Selected Text");

        // var selectedText = $(this).find("option:selected").text();
        // var selectedValue = $(this).val();

        // alert("Clickeddd");
        // var keyword = "KKHH";
        // jQuery.ajax({
        //     url:   ajax_object.ajaxurl,
        //     type: 'POST',
        //     data: { 
        //         action: 'data_abcd',  
        //         keyword: keyword 
        //     },
            // success: function(data) {
            //     jQuery('#datafetch').html( data );
            // }
    //     });;
    // });



    // $("#btnsorting").click(function(){
    //     // alert("Clickeddd");
    //     var keyword = "DDLJ";
    //     jQuery.ajax({
    //         url:   ajax_object.ajaxurl,
    //         type: 'POST',
    //         data: { 
    //             action: 'data_abcde',  
    //             keyword: keyword 
    //         },
    //         success: function(data) {
    //             jQuery('#datafetch').html( data );
    //         }
    //     });;
    // });

    // $(function () {
    //     $("#ddlFruits").change(function () {
    //         var selectedText = $(this).find("option:selected").text();
    //         var selectedValue = $(this).val();
    //         alert("Selected Text: " + selectedText + " Value: " + selectedValue);
    //     });
    // });













    

    
























// $('#filter').submit(function(){
//     var filter = $('#filter');
//     $.ajax({
//         url:filter.attr('action'),
//         data:filter.serialize(), // form data
//         type:filter.attr('method'), // POST
//         beforeSend:function(xhr){
//             filter.find('button').text('Processing...'); // changing the button label
//         },
//         success:function(data){
//             filter.find('button').text('Apply filter'); // changing the button label back
//             $('#response').html(data); // insert data
//         }
//     });
//     return false;
// });

// });























 
// $("#btnsort").click(function(){
//     var keyword = "rayyan";
//     jQuery.ajax({
//         url:   ajax_object.ajaxurl,
//         type: 'POST',
//         data: { 
//             action: 'data_fetch1',  
//             keyword: keyword  
//         },
//         success: function(data) {
//             jQuery('#datafetch').html( data );
//         }
//     });
// });



