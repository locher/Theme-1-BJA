<?  if( have_rows('etapes_du_couple') ): ?>

<div class="timeline">
       
    <div class="wrapper-title">
        <h2><?php the_field('titre_histoire'); ?></h2>
        <p class="subtitle"><?php the_field('sous_titre_histoire'); ?></p>
        <svg viewBox="0 0 100 100" width="50" height="50">
          <use xlink:href="#icon-fleur"></use>
        </svg>
    </div>	

    <section>

        <ul>

            <span></span>

            <?php while ( have_rows('etapes_du_couple') ) : the_row(); ?>

            <li class="single_moment">
                <div class="col1">
                    <p class="meta_moment"><?php the_sub_field('date_de_letape'); ?></p>
                </div>
                <div class="milieu">
                    <svg viewBox="0 0 100 100" width="30" height="30" class="icon">
                      <use xlink:href="#icon-coeur"></use>
                    </svg>
                </div>
                <div class="col2">

                  <div class="wrapper-col2">

                    <?php $image = get_sub_field('photo_de_letape'); ?>

                    <a href="<?php echo $image['sizes']['sL1200']; ?>" class="<?php echo $classImage; ?> lightbox" title="<?php the_field('nom');?>">
                         <img src="<?php echo $image['sizes']['s300']; ?>" alt="<?php echo $image['alt']; ?>" class="<?php echo $classImage;?>" />
                    </a>

                    <div class="text-col2">
                        <h3><?php the_sub_field('titre_de_letape'); ?></h3>
                        <?php the_sub_field('texte_de_letape'); ?>
                    </div>

                  </div>

                </div>
            </li>

            <?php endwhile; ?>

        </ul>

    </section>
    
</div>


<?php endif; ?>