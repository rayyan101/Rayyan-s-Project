Script ka kaaaaaam





jQuery(document).ready(function($){

$("#keyword").on("keyup",function(){

    var keyword = $(this).val();
    
    
   
    jQuery.ajax({
        url:   ajax_object.ajax_url,
        type: 'post',
        data: { action: 'data_fetch', keyword: jQuery('#keyword').val() },
        success: function(data) {
            jQuery('#datafetch').html( data );

            console.log(keyword);
        }
    });




})



});





























templete page ka kaaaaaam

<div class="search_bar">
    <form action="/" method="get" autocomplete="off">
    <input type="text" name="s" placeholder="Search Code..." id="keyword" class="input_search" onkeyup="fetch()"> 
    </form> </div> 


























    functio ka kaaaaaam


    add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
<script type="text/javascript">
function fetch(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch', keyword: jQuery('#keyword').val() },
        success: function(data) {
            jQuery('#datafetch').html( data );
        }
    });

}
</script>
<?php
}