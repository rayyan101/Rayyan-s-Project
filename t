
add_action('wp_ajax_data_abcd' , 'data_abcd');
add_action('wp_ajax_nopriv_data_abcd' , 'data_abcd');

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





add_action('wp_ajax_data_abcde' , 'data_abcde');
add_action('wp_ajax_nopriv_data_abcde' , 'data_abcde');

function data_abcde() {

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
} 

























    
$("#btnsort").click(function(){
    // alert("Clickeddd");
    var keyword = "";
    jQuery.ajax({
        url:   ajax_object.ajaxurl,
        type: 'POST',
        data: { 
            action: 'data_abcd',  
            keyword: keyword 
        },
        success: function(data) {
            jQuery('#datafetch').html( data );
        }
    });;
});

$("#btnsortt").click(function(){
    // alert("Clickeddd");
    var keyword = "";
    jQuery.ajax({
        url:   ajax_object.ajaxurl,
        type: 'POST',
        data: { 
            action: 'data_abcde',  
            keyword: keyword 
        },
        success: function(data) {
            jQuery('#datafetch').html( data );
        }
    });
});
