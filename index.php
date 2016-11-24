<?php get_header(); ?>


<!-- header -->
<header class="header" role="banner"> 

    <?php include('logo-nav.php');?>

    <div class="headerContent">
        <div>     
            <p class="h1">Actualités</p>
        </div>
    </div>

</header>
<!-- /header -->

<?php
    // Les news
    $argsPosts = array(
        'post_type'		=> 'post',
        'posts_per_page' => -1,
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

<?php get_footer(); ?>