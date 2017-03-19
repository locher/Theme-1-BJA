<?php

$args_tous = array(
    //Tous les déroulements
    'post_type'		=> 'deroulement'
); 

$query_tous = new WP_Query( $args_tous );

?>

<?php if( $query_tous->have_posts() ): ?>  
               

<section class="gmap">
                
    <div class="acf-map">

       <?php while( $query_tous->have_posts() ) : $query_tous->the_post(); ?>
          
    <?php     
        $dateformat = "l j F \à G\hi";
        $unixtimestamp_mariage = strtotime(get_field('date_et_heure_mariage'));
    ?>
    
    <p>Le <span></span></p>
           
            <?php $location = get_field('adresse_du_lieu'); ?>
            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                <p class="address"><span class="title-map"><?php the_title();?></span></p>
                <?php if(get_field('date_et_heure_mariage')):?><p><?php echo date_i18n($dateformat, $unixtimestamp_mariage); ?></p><?php endif;?>
                <p><?php echo $location['address']; ?></p>
                
                <p class="linkMap"><a href="http://maps.google.com/?q=<?php echo $location['address']; ?>" class="bt">M'y rendre</a></p>
            </div>       
       <?php endwhile; ?>
       

    </div>

</section>


<?php endif;?>