

<?php

/** Template Name: Movies */



get_header();   ?>

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

                while($query->have_posts()) :

                    $query->the_post();?>
                








                
                <div style="background-color: DBEFDB; float: left;  width: 33.33%; border: 1px solid black;  ">
        <h1 style="text-align: center;"> <a style="align-items: center;" href=" <?php the_permalink(); ?> "> <?php the_title(); ?></a></h2></h1>
        <a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
        <p style="text-align: center;" ><?php the_content(); ?></p>
        <h5 style="text-align: center;"> <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
        <?php echo $name ?>
    </h5>
        <<h6  style="text-align: center;"> <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
        <?php echo $email ?>
    </h6>
        </div>
                
            <?php
                endwhile;   

                pag();
                
                
            endif;    
            ?>
   

<?php 

get_footer();

?>

