<?php /* Template Name: Live Galerie */ get_header(); ?>

<?php
    //Photos officielles
    $imagesOfficielle = get_field('galerie_photo');
?>

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

<?php include('blocs/live.php'); ?>
	
	<?php
        wp_reset_query();
        if( $imagesOfficielle ):

    ?>
	
	<section class="gallery wrapperPadding" id="photosOfficielles">
        	    <div class="wrapper-title">
	        <h2><?php the_field('titre_galerie');?></h2>
	        <p class="subtitle"><?php the_field('sous-titre_galerie');?></p>
	        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
	    </div>	
	    	   <ul>
        <?php foreach( $imagesOfficielle as $image ): ?>
            <li>
                <a href="<?php echo $image['sizes']['sL1200']; ?>" class="lightbox">
                     <img src="<?php echo $image['sizes']['s300']; ?>" alt="<?php echo $image['alt']; ?>" />
                </a>                
            </li>
        <?php endforeach; ?>
        </ul>   
	    
	</section>
	
	<?php endif;?>

<?php get_footer(); ?>