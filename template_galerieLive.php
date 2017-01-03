<?php include('blocs/live/Liveheader.php');?>
<?php /* Template Name: Live Galerie */ get_header(); ?>

<!-- header -->
<header class="header" role="banner">

    <?php include('logo-nav.php');?>
    
    <div class="headerContent">
   
        <h1><?php the_title();?></h1>
        
        <?php if(get_field('pack_achete', 'option') == "pack2" OR get_field('pack_achete', 'option') == "pack3"): ?>
        
        <div class="ss-menu">
            <ul>
                <?php

$args_photoOfficielles = array(
    //Galerie officielle
    'post_type'		=> 'photos_officielles'
); 

$query_photosOfficielles = new WP_Query( $args_photoOfficielles );

?>
                <?php if( $query_photosOfficielles->have_posts() ): ?>  
                <li><a href="#photosOfficielles">Photos officielles</a></li>
                <?php endif;?>
                <?php
                    $argsLive = array('post_type' => 'live'); 
                    $queryLive = new WP_Query($argsLive);
                    if( $queryLive->have_posts() ): ?>
                <li><a href="#photosLive"><?php the_field('titre_live', 'option', false); ?></a></li>
                <?php endif;?>                
                <?php
                
                    $argsPhotosInvites = array(
                        'post_type'		=> 'photos-invites',
                        'posts_per_page' => -1,
                    ); 

                    $queryPhotosInvites = new WP_Query( $argsPhotosInvites );?>
                <li><a href="#photosInvites"><?php the_field('titre_invites', 'option', false); ?></a></li>
                <?php if(strtotime($dateMariage) <= strtotime(now)):?>
                <li><a href="#addLive"><?php the_field('titre_formulaire_live', 'option', false); ?></a></li>
                <?php endif;?>
            </ul>
        </div>  
        
        <?php endif;?>  
    </div>

</header>
<!-- /header -->

<?php

$args_photoOfficielles = array(
    //Galerie officielle
    'post_type'		=> 'photos_officielles'
); 

$query_photosOfficielles = new WP_Query( $args_photoOfficielles );

?>
<?php if( $query_photosOfficielles->have_posts() ): ?>  
	
<div id="galerieOff">

<?php while( $query_photosOfficielles->have_posts() ) : $query_photosOfficielles->the_post(); ?>	

<section class="gallery wrapperPadding" id="photosOfficielles">
    <div class="wrapper-title">
        <h2><?php the_title();?></h2>
        <p class="subtitle"><?php the_field('sous_titre_galerie');?></p>
        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>	
           <ul>
   <?php $imagesOfficielle = get_field('photos');?>
    <?php foreach( $imagesOfficielle as $image ): ?>
        <li>
            <a href="<?php echo $image['sizes']['sL1200']; ?>" class="lightbox">
                 <img src="<?php echo $image['sizes']['s300']; ?>" alt="<?php echo $image['alt']; ?>" />
            </a>                
        </li>
    <?php endforeach; ?>
    </ul>   

</section>
<?php endwhile;?>

</div>
<?php endif;?>


<?php include('blocs/live/timeline.php'); ?>

<?php if(get_field('pack_achete', 'option') == "pack2" OR get_field('pack_achete', 'option') == "pack3"): ?>

<?php
    // Photos invités

    $argsPhotosInvites = array(
        'post_type'		=> 'photos-invites',
        'posts_per_page' => -1,
    ); 

    $queryPhotosInvites = new WP_Query( $argsPhotosInvites );
?>
    <?php if( $queryPhotosInvites->have_posts() ): ?>
    

<section class="gallery wrapperPadding" id="photosInvites">
    <div class="wrapper-title">
        <h2><?php the_field('titre_invites', 'option', false); ?></h2>
        <p class="subtitle"><?php the_field('sous-titre_invite', 'option', false); ?></p>
        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>	
        
    <ul>
        <?php while( $queryPhotosInvites->have_posts() ) : $queryPhotosInvites->the_post(); ?>
                
                
        <?php 
            $images = get_field('galerie');

            if( $images ): ?>
                
            <?php foreach( $images as $image ): ?>

                <?php 

                    $classImage = "taille1";
                    $sizeImage = "s300";

                    if(count($images) < 4 && count($images) > 1)
                    {
                        $classImage = "taille2";
                        $sizeImage = "s200";
                    }

                    if(count($images) >= 4)
                    {
                        $classImage = "taille3";
                        $sizeImage = "s150";
                    } 
                ?>
                <li>
            <a href="<?php echo $image['sizes']['sL1200']; ?>" class="lightbox">
                 <img src="<?php echo $image['sizes']['s300']; ?>" alt="<?php echo $image['alt']; ?>" />
            </a>                
        </li>
                <?php endforeach; ?>
                <?php endif;?>
                  
        <?php endwhile;?>            
    </ul>   

</section>

<?php endif;?>

<?php include('blocs/live/form.php'); ?>

<?php endif;?>

<?php get_footer(); ?>