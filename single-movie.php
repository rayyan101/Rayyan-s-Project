

<?php
       
       get_header( );

   ?>    <h1 style="text-align: center;"> Movie Details  </h1>
<?php
        
    
            $args = array
            (
                'post_type'      => 'movie'
            );


            $query = new WP_Query($args);
            
?>
                
                   
                    
                <div style="background-color: DBEFDB; margin-left: 30%  width: 40%; border: 1px solid black;  ">
        <h1 style="text-align: center;">  <?php the_title(); ?></h2></h1>
        <img style="height: 80%; width: 50%; margin-left: 25%;" src=" <?php the_post_thumbnail();?>  
        <p style="text-align: center;" ><?php the_content(); ?></p>
        <h5 style="text-align: center;"> <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
        <?php echo $name ?>
       </h5>
        <h6  style="text-align: center;"> <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
        <?php echo $email ?>
    </h6>
        </div>

                    
         
                
            <?php
                    
            
          
  get_footer(  );
  
            
  
                    
            ?>

                  