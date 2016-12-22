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
                <li><a href="#photosLive">Vos photos live</a></li>
                <li><a href="#addLive">Ajoutez vos photos live</a></li>
                <?php if($imagesOfficielle): ?>
                <li><a href="#photosOfficielles">Photos officielles</a></li>
                <?php endif;?>
            </ul>
        </div>  
        
        <?php endif;?>  
    </div>

</header>
<!-- /header -->

<?php include('blocs/live/timeline.php'); ?>

<?php include('blocs/live/form.php'); ?>
	
	
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

<?php get_footer(); ?>