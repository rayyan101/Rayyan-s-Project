

<?php

/** Template Name: Movies */



get_header();   ?>


    <div class="search_bar">
    <form action="/" method="get" autocomplete="off">
    <input type="text" name="s" placeholder="Search Code..." id="keyword" class="input_search" > 
    </form> </div> 
  

            <?php
            $curentpage = get_query_var('paged');
            $args = array
            (
                'post_type'      => 'movie',
                'posts_per_page' => '3',
                'publish_status' => 'published',
                'paged' => $curentpage
            );

            $query = new WP_Query($args);
            if($query->have_posts()) :

?>  <div id="datafetch" class="container"> 
    <?php
    while($query->have_posts()) :
    $query->the_post();?>
                

<div class="row">
<div style="background-color: DBEFDB; border: 1px solid black;  class="col-4"> 
<h1 style="text-align: center;"> <a style="align-items: center;" href=" <?php the_permalink(); ?> "> <?php the_title(); ?></a></h2></h1>
        <a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
        <p style="text-align: center;" ><?php the_content(); ?></p>
        <h5 style="text-align: center;"> <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
        <?php echo $name ?> </h5>
        <h6  style="text-align: center;"> <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
        <?php echo $email ?> </h6>
</div>

                
        
</div>
   

    
            <?php
                endwhile;   
                ?>   
                </div>
                                <?php 
                pag();
  
                
            endif;    
            ?>   

<?php 

get_footer();

?>

