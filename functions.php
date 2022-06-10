<?php

function my_theme_enqueue_styles() {
    wp_enqueue_script( 'custom_js', get_stylesheet_directory_uri() . "/js/custom.js" ,   array('jquery') );
    wp_localize_script( 
        'custom_js', 
        'ajax_object', 
        array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) )
    );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style( 'child-style', get_stylesheet_uri());  
    }
    add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Registring Custom Posts Types and Details

function wpl_adding_movies() {
    $labels = array(
        'name'                  => __( 'movies'),
        'singular_name'         => __( 'movie'),
        'menu_name'             => __( 'movies'),
        'name_admin_bar'        => __( 'movie'),
        'add_new'               => __( 'Add New'),
        'add_new_item'          => __( 'Add New movie'),
        'new_item'              => __( 'New movie'),
        'edit_item'             => __( 'Edit movie'),
        'view_item'             => __( 'View movie'),
        'all_items'             => __( 'All movies'),
        'search_items'          => __( 'Search movies'),
        'parent_item_colon'     => __( 'Parent movies:'),
        'not_found'             => __( 'No movies found.'),
        'not_found_in_trash'    => __( 'No movies found in Trash.'),
        'featured_image'        => __( 'movie Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'movie' ),
        'set_featured_image'    => __( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'movie' ),
        'remove_featured_image' => __( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'movie' ),
        'use_featured_image'    => __( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'movie' ),
        'archives'              => __( 'movie archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'movie' ),
        'insert_into_item'      => __( 'Insert into movie', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'movie' ),
        'uploaded_to_this_item' => __( 'Uploaded to this movie', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'movie' ),
        'filter_items_list'     => __( 'Filter movies list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'movie' ),
        'items_list_navigation' => __( 'movies list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'movie' ),
        'items_list'            => __( 'movies list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'movie' ),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'movie custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'movie' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    );
    register_post_type( 'movie', $args );
}
    add_action( 'init', 'wpl_adding_movies' );

 // adding custom columns (metabox) to our post

    function wpl_register_metabox(){
    add_meta_box( "cpt-id", "Actores Details", "wpl_actor_call","movie","side","high");
}
    add_action("add_meta_boxes","wpl_register_metabox");

 function wpl_actor_call($post){ ?>
     <p>
     <label> Name </label>
	 <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
	 <input type="text" value="<?php echo $name ?>" name="TxtActoreName" placeholder="name"/>
     </p>
     <p>
     <label> Email </label>
	 <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
	 <input type="email" value="<?php echo $email ?>" name="TxtActoreEmail" placeholder="email"/>
     </p>
<?php

}

// getting data from (custom field) metabox 

    function wpl_save_values($post_id, $post){
    $TxtActoreName = isset($_POST['TxtActoreName'])?$_POST['TxtActoreName']:"";
	$TxtActoreEmail = isset($_POST['TxtActoreEmail'])?$_POST['TxtActoreEmail']:"";

    update_post_meta( $post_id,"wpl_actore_name",$TxtActoreName);
	update_post_meta( $post_id,"wpl_actore_email",$TxtActoreEmail);
}
    add_action("save_post","wpl_save_values",10,2);

// shortcode of data retrive

function shortcode_movie_post_type()
{
    $curentpage = get_query_var('paged');
    $args = array(
                    'post_type'      => 'movie',
                    'posts_per_page' => '2',
                    'publish_status' => 'published',
                    'paged' => $curentpage
            );

    $query = new WP_Query($args); 
    ob_start();
    $result = '';
    if($query->have_posts()) :   
        while($query->have_posts()) :
            $query->the_post();  
            $result = $result . "<h2>" . get_the_title() . "</h2>";
            $result = $result . get_the_post_thumbnail();
            $result = $result . "<p>" . get_the_content() . "</p>";

        endwhile;

        $output_string = ob_get_contents();
        ob_end_clean();
        wp_die($output_string); 

        echo paginate_links(array(
            'total' => $query->max_num_pages
        )); 
    endif;   
    return $result;          
}
    add_shortcode( 'movie_list', 'shortcode_movie_post_type' ); 

// shortcode code ends here

    function pag(){

        $curentpage = get_query_var('paged');
        $args = array(
        'post_type'      => 'movie',
        'posts_per_page' => '3',
        'publish_status' => 'published',
        'paged' => $curentpage
    );

    $query = new WP_Query($args);
    $pg = array( 
    'total' => $query->max_num_pages
    );
    echo paginate_links($pg); 
}

// add the ajax fetch js

    add_action('wp_ajax_data_fetch' , 'data_fetch');
    add_action('wp_ajax_nopriv_data_fetch' , 'data_fetch');

// the ajax function
function data_fetch() {

    $the_query = new WP_Query( array( 
        'posts_per_page' => 3, 
        's' => esc_attr( $_POST['keyword'] ), 
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




add_action('wp_ajax_data_drop' , 'data_drop');
add_action('wp_ajax_nopriv_data_drop' , 'data_drop');

function data_drop() {


    
    $the_query = new WP_Query( array( 
        'posts_per_page' => 3, 
        'orderby' => 'title',
        'order' => $_POST["keyword"],
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











?>












































