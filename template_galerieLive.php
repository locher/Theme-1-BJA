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
                <?php if(have_rows('galerie_off')): ?>
                <li><a href="#photosOfficielles">Photos photographe</a></li>
                <?php endif;?>
                <?php
                    $argsLive = array('post_type' => 'live'); 
                    $queryLive = new WP_Query($argsLive);
                    if( $queryLive->have_posts() ): ?>
                <li><a href="#photosLive">Le live!</a></li>
                <?php endif;?>                
                <?php
                
                    $argsPhotosInvites = array(
        'post_type'		=> 'photos-invites',
        'posts_per_page' => -1,
    ); 

    $queryPhotosInvites = new WP_Query( $argsPhotosInvites );?>
            <li><a href="#photosInvites">Vos photos</a></li>
            <li><a href="#addLive">Invités, ajoutez vos photos !</a></li>
            </ul>
        </div>  
        
        <?php endif;?>  
    </div>

</header>
<!-- /header -->

	
<div id="galerieOff">
<?php
    wp_reset_query();

    if( have_rows('galerie_off') ):
    while ( have_rows('galerie_off') ) : the_row();

?>

<section class="gallery wrapperPadding" id="photosOfficielles">
            <div class="wrapper-title">
        <h2><?php the_sub_field('titre_galerie');?></h2>
        <p class="subtitle"><?php the_sub_field('sous_titre_galerie');?></p>
        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>	
           <ul>
   <?php $imagesOfficielle = get_sub_field('photos');?>
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
<?php endif;?>
</div>

<?php include('blocs/live/timeline.php'); ?>

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
        <h2>Les photos des invités</h2>
        <p class="subtitle">Le mariage vu par nos invités</p>
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

<?php get_footer(); ?>