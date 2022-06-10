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









































function data_abcd() {

    $the_query = new WP_Query( array( 
        'posts_per_page' => 3, 
        'orderby' => 'title',
        'order' => 'ASC',
        'post_type' => array('movie') ) );
    if( $the_query->have_posts() ) :
        ob_start();
        while( $the_query->have_posts() ): $the_query->the_post();  ?>
        
<div style="background-color: DBEFDB; border: 1px solid black; float:left; " class="col-4"> 
    <h1 style="text-align: center;"> <a style="align-items: center;" href=" <?php the_permalink(); ?> "> <?php the_title(); ?></a></h2></h1>
    <a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
    <p style="text-align: center;" ><?php the_content(); ?></p>
    <h5 style="text-align: center;"> <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
    <?php echo $name ?>
    </h5>
    <h6  style="text-align: center;"> <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
    <?php echo $email ?> </h6>  
</div>  
    <?php  
        endwhile; 

        $output_string = ob_get_contents();
        ob_end_clean();
        wp_die($output_string); 
        wp_reset_postdata(); 

    endif;
    die();
} 




















<select id="language" onChange="update()">
<option value="en">English</option>
<option value="es">Español</option>
<option value="pt">Português</option>
</select>
<input type="text" id="value">
<input type="text" id="text">

<script type="text/javascript">
function update() {
    var select = document.getElementById('language');
    var option = select.options[select.selectedIndex];

    document.getElementById('value').value = option.value;
    document.getElementById('text').value = option.text;
}

update();
</script>





















importenet


$the_query = new WP_Query( array( 
    'posts_per_page' => 3, 
    'orderby' => 'title',
    'order' => 'DESC',
    'post_type' => array('movie') ) );
if( $the_query->have_posts() ) :
    ob_start();
    while( $the_query->have_posts() ): $the_query->the_post();  ?>
    
<div style="background-color: DBEFDB; border: 1px solid black; float:left; " class="col-4"> 
<h1 style="text-align: center;"> <a style="align-items: center;" href=" <?php the_permalink(); ?> "> <?php the_title(); ?></a></h2></h1>
<a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
<p style="text-align: center;" ><?php the_content(); ?></p>
<h5 style="text-align: center;"> <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
<?php echo $name ?>
</h5>
<h6  style="text-align: center;"> <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
<?php echo $email ?> </h6>  
</div>  
<?php  
    endwhile; 

    $output_string = ob_get_contents();
    ob_end_clean();
    wp_die($output_string); 
    wp_reset_postdata(); 

endif;
die();