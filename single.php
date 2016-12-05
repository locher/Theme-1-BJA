<?php get_header(); ?>
    
    <!-- header -->
    <header class="header" role="banner">

    <?php include('logo-nav.php');?>

    <div class="headerContent">    
        <p class="h1">Actualité</p>
    </div>

    </header>
    <!-- /header -->

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class("wrapperPadding contentArticle"); ?>>

			<!-- post title -->
			<h1><?php the_title(); ?></h1>
			<!-- /post title -->

			<!-- post details -->
			<p>
			    <span class="date"><?php the_time('l j F Y');?> à <?php the_time('G\hi a'); ?></span>
			</p>
			<p>
			    <span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>
			</p>
			
			<!-- /post details -->

			<?php the_content(); ?>

		</article>
		<!-- /article -->
		
        <div class="bgsection wrapperPadding commentWrapper">
		    <?php comments_template(); ?>
		</div>

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

<?php get_footer(); ?>