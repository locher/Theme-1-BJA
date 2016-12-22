<?php if(get_field('pack_achete', 'option') == "pack2" OR get_field('pack_achete', 'option') == "pack3"): ?>
   <?php
    $argsLive = array('post_type' => 'live'); 
    $queryLive = new WP_Query($argsLive);
    if( $queryLive->have_posts() ):
?>
    

    <div id="photosLive" class="wrapperPadding">
		<div class="wrapper-title">
			<h2><?php the_field('titre_live', 'option', false); ?></h2>
            <p class="subtitle"><?php the_field('sous-titre_live', 'option', false); ?></p>
			<svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
		</div>		
		
		<?php

			$previous_year = $year = 0;
			$previous_month = $month = 0;
			$previous_day = $day = 0;
			$ul_open = false;

			$myposts = get_posts(array(
				'post_type'=>'live',
				'posts_per_page'=>-1,
				'post_status' => 'publish',
			));

		?>

		<section class="timeline-live">

		<?php foreach($myposts as $post) : ?>	

			<?php

			setup_postdata($post);

			$year = mysql2date('Y', $post->post_date);
			$month = mysql2date('n', $post->post_date);
			$day = mysql2date('j', $post->post_date);

			?>

			<?php if($year != $previous_year || $month != $previous_month || $day != $previous_day)  : ?>

				<?php if($ul_open == true) : ?>
				</ul>
				<?php endif; ?>

				<p class="day"><?php the_time('l d F'); ?></p>

				<ul>

				<?php $ul_open = true; ?>

			<?php endif; ?>

			<?php $previous_year = $year; $previous_month = $month; $previous_day = $day; ?>

						<li class="single_moment">
							<div class="col1">
								<p class="meta_moment"><span class="heure_moment"><?php the_time('G\hi');?></span> par <span class="nom_moment"><?php the_field('nom');?></span></p>
								<div class="comment_moment"><?php the_field('texte_live');?></div>
							</div>
							<div class="milieu">
								<svg viewBox="0 0 100 100" width="30" height="30" class="icon">
								  <use xlink:href="#icon-coeur"></use>
								</svg>
							</div>
							<div class="col2">

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

										<a href="<?php echo $image['sizes']['sL1200']; ?>" class="<?php echo $classImage; ?> lightbox" title="<?php the_field('nom');?>">
											 <img src="<?php echo $image['sizes'][$sizeImage]; ?>" alt="<?php echo $image['alt']; ?>" class="<?php echo $classImage;?>" />
										</a>

								<?php endforeach; ?>

							<?php endif; ?>

							</div>
						</li>

		<?php endforeach; ?>

			</ul>

		</section>	
</div>

<?php endif;?>
<?php endif;?>