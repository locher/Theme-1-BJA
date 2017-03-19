<?php

$args_tous = array(
    //Déroulement NON REPAS
    'post_type'		=> 'deroulement',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'meta_key'		=> 'categorie',
    'meta_value'	=> '0',
); 

$query_tous = new WP_Query( $args_tous );

?>
<?php if( $query_tous->have_posts() ): ?>  


<section class="bgsection">

<div class="wrapper-title">
    <h2><?php the_field('titre_deroulement', 'option', false);?></h2>
    <p class="subtitle"><?php the_field('sous-titre_deroulement', 'option', false);?></p>
    <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
</div>

<div>
    
    <?php while( $query_tous->have_posts() ) : $query_tous->the_post(); ?>

        <div class="singleHalf textContent">


            <?php $image = get_field('photo_illustrative'); ?>

            <?php if( !empty($image) ): ?>

            <div class="halfPhoto" style="background-image:url('<?php echo $image['sizes']['sL1200']; ?>');"></div>

            <?php endif; //empty $image ?>

            <div class="contentHalf">
                <h3><?php the_title();?></h3>

                <p class="h4 lieu"><?php the_field('titre_du_lieu');?></p>
                    <?php     
        $dateformat = "l j F \à G\hi";
        $unixtimestamp_mariage = strtotime(get_field('date_et_heure_mariage'));
    ?>
<?php if(get_field('date_et_heure_mariage')):?><p><?php echo date_i18n($dateformat, $unixtimestamp_mariage); ?></p><?php endif;?>
                <?php the_field('date_et_heure');?>
            </div>

        </div>                

    <?php endwhile;?>

</div>

</section>
         
<?php endif;?>
                                      
                       
<?php

$args_tous = array(
    //Déroulement NON REPAS
    'post_type'		=> 'deroulement',
    'meta_key'		=> 'categorie',
    'meta_value'	=> '1',
    'orderby' => 'menu_order',
    'order' => 'ASC',
); 

$query_tous = new WP_Query( $args_tous );

?>
<?php if( $query_tous->have_posts() ): ?> 

<section class="wrapperPadding">
<div class="wrapper-title">
    <h2>Vous êtes invité au repas ?</h2>
    <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
</div>

<div class="wrapper-halfBlock">

    <?php while( $query_tous->have_posts() ) : $query_tous->the_post(); ?>

        <div class="singleHalf textContent">


            <?php $image = get_field('photo_illustrative'); ?>

            <?php if( !empty($image) ): ?>

            <div class="halfPhoto" style="background-image:url('<?php echo $image['sizes']['sL1200']; ?>');"></div>

            <?php endif; //empty $image ?>

            <div class="contentHalf">
                <h3><?php the_title();?></h3>

                <p class="h4 lieu"><?php the_field('titre_du_lieu');?></p>
                <span class="date"><?php the_field('date_et_heure');?></span>

                <?php the_field('description');?>
            </div>

        </div>                

    <?php endwhile;?>

</div>

</section>


<?php endif;?>