<?php /* Template Name: Home Template */ get_header(); ?>

<?php 
        
    //Heure et date du mariage

    $dateMariage = get_field('date_du_mariage', 'option', false);
    $heureMariage = get_field('heure_de_debut_du_mariage', 'option', false);

    $dateMariage = new DateTime($dateMariage);
    $heureMariage = new DateTime($heureMariage);

?>

<!-- header -->
<header class="header" role="banner"> 

    <?php include('logo-nav.php');?>

    <div class="headerContent">
        <div>     
            <p class="h1">Save the date !</p>
            <p class="date-header">Le <span><?php the_field('date_du_mariage', 'option'); ?></span> à partir de <span><?php echo $heureMariage->format('G\hi'); ?></span></p>

            <p class="text-compteur">On a compté, il reste exactement :</p>
            
            <div id="clock" class="countdown"></div>
        </div>
    </div>

</header>
<!-- /header -->

<?php include('blocs/rappelRSVP.php'); ?>


<?php
    // Les news
    $argsPosts = array(
        'post_type'		=> 'post',
        'posts_per_page' => 3,
    ); 

    $queryPosts = new WP_Query( $argsPosts );
?>
<?php if( $queryPosts->have_posts() ): ?>
<section class="wrapperPadding news">
    <div class="wrapper-title">
        <h2>Actualités du mariage</h2>
        <p class="subtitle">Suivez l'actualité du mariage</p>
        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>	
     
<?php while( $queryPosts->have_posts() ) : $queryPosts->the_post(); ?>
   <div class="singleArticle">
       <div class="contentSingle">
           <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
           <p><?php the_excerpt();?></p>
           <p><a href="<?php the_permalink();?>" class="bt btVide">Lire l'article</a></p>
       </div>
       <div class="imgSingle">
           <a href="<?php the_permalink();?>"><?php the_post_thumbnail('s300');?></a>
       </div>
   </div>   
<?php endwhile;?>
    
</section>
<?php endif;?>

<section class="gmap bgsection">
               
    <div class="wrapper-title">
        <h2>Déroulement</h2>
        <p class="subtitle">Quand ? Où ? Comment ?</p>
        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>
                
    <div class="acf-map">
      
      <?php if(have_rows('deroulement_general','option')): ?>
       
       <?php while( have_rows('deroulement_general', 'option') ): the_row(); ?>
           
            <?php $location = get_sub_field('adresse_du_lieu'); ?>
            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                <p class="address"><span class="title-map"><?php the_sub_field('titre');?></span> <?php echo $location['address']; ?></p>
            </div>       
       <?php endwhile; ?>
           <?php endif;?>
           
                 <?php if(have_rows('deroulement_repas','option')): ?>
       
       <?php while( have_rows('deroulement_repas', 'option') ): the_row(); ?>
           
            <?php $location = get_sub_field('adresse_du_lieu'); ?>
            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                <p class="address"><span class="title-map"><?php the_sub_field('titre');?></span> <?php echo $location['address']; ?></p>
            </div>       
       <?php endwhile; ?>
           <?php endif;?>

    </div>
    
    <p class="wrapperBt"><a href="<?php echo ods_getTemplatePermalink('template_mariage.php'); ?>" class="bt">Voir le déroulement</a></p>

</section>

<script>

    
(function ($, root, undefined) {

$(function () {

    'use strict';

    //Countdown
    
    var dateMariage = '<?php echo $dateMariage->format('Y/m/d');?> <?php echo $heureMariage->format('G:i:s'); ?>';
    $('#clock').countdown(dateMariage, {elapse: true}).on('update.countdown', function(event) {
        var $this = $(this);
        if (event.elapsed) {
            //Après la fin
            $this.html(event.strftime('<div><span>%D</span> jour%!D</div><div><span>%H</span> heure%!H</div><div><span>%M</span> minute%!M</div><div><span>%S</span> seconde%!S</div>'));
            $this.parent().find('.text-compteur').html('Heureux mariés depuis :')
        } else {
            //Avant la fin
            $this.html(event.strftime('<div><span>%D</span> jour%!D</div><div><span>%H</span> heure%!H</div><div><span>%M</span> minute%!M</div><div><span>%S</span> seconde%!S</div>'));
        }
    });    

});

})(jQuery, this);	


    
</script>

<?php get_footer(); ?>