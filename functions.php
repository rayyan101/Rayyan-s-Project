<?php


function my_theme_enqueue_styles() {

    wp_enqueue_script( 'custom-js ', get_stylesheet_directory_uri() . "/js/custom.js" ,   array('jquery') );
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



 function wpl_actor_call($post){


?>
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
  
    $result = '';
    if($query->have_posts()) :
  
        while($query->have_posts()) :
  
            $query->the_post();
          
            $result = $result . "<h2>" . get_the_title() . "</h2>";
            $result = $result . get_the_post_thumbnail();
            $result = $result . "<p>" . get_the_content() . "</p>";

        endwhile;
        wp_reset_postdata();
       
        echo paginate_links(array(
            'total' => $query->max_num_pages
        )); 
    endif;   
    return $result;
            
}
  
    add_shortcode( 'movie-list', 'shortcode_movie_post_type' ); 
  
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
