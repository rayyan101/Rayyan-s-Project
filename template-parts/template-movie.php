

<?php

/** Template Name: Movies */

get_header();   ?>




<div class="search_bar">
<input type="text" name="keyword" placeholder="Search Code..." id="keyword" class="input_search">  
<!-- 
<button id="btnsort">Sorting By Ascending</button>

<button id="btnsortt">Sorting By Decending</button>  -->
</div
<!-- <div class="filters">

<select id="language">
<option value="">Filters</option>
<option value="asc">Sorting By Ascending</option>
<option value="desc">Sorting By Decending</option>
<option value="old">Sorting By Oldest</option>
<option value="new" >Sorting By Newest</option>
</select>





            <?php
            $curentpage = get_query_var('paged');
            $args = array
            (
                'post_type'      => 'movie',

                'post_status' => 'publish',
                'orderby' => 'publish_date',
                'order' => 'DESC',
                'posts_per_page' => '3',
                'paged' => $curentpage
            );

        $query = new WP_Query($args);
        if($query->have_posts()) : ?>  
        
<div id="datafetch" class="container">
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
        endwhile;  ?>   
</div>
        <?php 
        pag();   
     endif;     ?>   
<?php 
get_footer();
?>

