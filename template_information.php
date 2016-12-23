<?php /* Template Name: Informations */ get_header(); ?>

<!-- header -->
<header class="header" role="banner">

    <?php include('logo-nav.php');?>
    
    <div class="headerContent">    
        <h1><?php the_title();?></h1>    
    </div>

</header>
<!-- /header -->
   
<?php            
    $argsHotel = array(
        // Query des témoins du marié
        'post_type'		=> 'hotels',
    );  

    $queryHotel = new WP_Query( $argsHotel );
?>

<?php if( $queryHotel->have_posts() ): ?>

<section class="hotels">
       
    <div class="wrapper-title">
        <h2><?php the_field('titre_hotel', 'option');?></h2>
        <p class="subtitle"><?php the_field('sous-titre_hotel', 'option');?></p>
       <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>

    <?php while( $queryHotel->have_posts() ) : $queryHotel->the_post(); ?>

    <div class="singleHalf">
        <div class="halfPhoto" style="background-image:url('<?php echo get_field('photo')['sizes']['sL1200']; ?>');"></div>
        <div class="contentHalf">
            <h3><?php the_title();?></h3>
            <p class="adresse"><?php the_field('adresse');?></p>
            <div class="descriptionHalf"><?php the_field('description');?></div>
            <ul>
                <?php if(get_field('telephone')): ?>
                <li>
                    <svg viewBox="0 0 100 100" width="30" height="30">
                        <use xlink:href="#icon-telephone"></use>
                    </svg>
                    <a href="tel:<?php echo(str_replace(' ','',get_field('telephone')));?>" class=""><?php the_field('telephone');?></a></li>
               <?php endif;?>
               <?php if(get_field('email')):?>
                <li>
                   <svg viewBox="0 0 100 100" width="30" height="30">
                        <use xlink:href="#icon-mail"></use>
                    </svg>
                    <a href="mailto:<?php the_field('email');?>" class=""><?php the_field('email');?></a></li>
                <?php endif;?>
                <?php if(get_field('site_web')):?>
                <li>
                    <svg viewBox="0 0 100 100" width="30" height="30">
                        <use xlink:href="#icon-lien"></use>
                    </svg>
                    <a href="<?php the_field('site_web');?>" class=""><?php the_field('site_web');?></a></li>
                <?php endif;?>
            </ul>

        </div>
    </div>

    <?php endwhile;?>
</section>

<?php endif;?>

<?php include('blocs/covoiturage.php');?>

<?php get_footer(); ?>