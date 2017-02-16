<?php if(get_field('pack_achete', 'option') == "pack3"): ?>

<?php    

    $argsPosts = array(
        'post_type'		=> 'wishlist',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ); 

    $queryPosts = new WP_Query( $argsPosts );

    ?>
<?php if( $queryPosts->have_posts() ): ?>

<section class="wrapperPadding wishlist" id="wishlist">
    
        <div class="wrapper-title">
            <h2><?php the_field('titre_wishlist', 'option');?></h2>
            <p class="subtitle"><?php the_field('sous-titre_wishlist', 'option');?></p>
           <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
        </div>	
		
        <ul>
        
            <?php while( $queryPosts->have_posts() ) : $queryPosts->the_post(); ?>
            
            <li class="<?php the_ID();?> <?php if(get_field('etat_reservation') == true){echo('giftReserve');}?>">
                <div class="textWishlist">
                    <h3><?php the_title();?></h3>
                    <?php the_field('description'); ?>
                    
                    <?php if(get_field('lien')):?>
                    <svg viewBox="0 0 100 100" width="25" height="25"><use xlink:href="#icon-lien"></use></svg>              
                    <a href="<?php the_field('lien');?>" target="_blank" class="seeGift">Voir le cadeau en ligne</a>
                    <?php endif;?>
                    
                </div>
                <div class="resaWishlist">
                    <?php if(get_field('reservation') == false AND get_field('etat_reservation') == false): ?>
                    <form action="" method="post" id="resaGift">
                        <div class="wrapper_resa">
                        <h3>Valider ma réservation</h3>
                        <input type="hidden" value="<?php echo get_the_ID();?>" name="id_cadeau">
                        <input type="hidden" value="<?php the_title();?>" name="name_cadeau">
                        <input type="email" name="email" placeholder="Votre email">
                        <input type="submit" value="Valider ma réservation" class="bt btVide">
                        </div>
                        <a class="closeModal icoClose" title="Fermer cette fenêtre"><span></span></a>
                    </form>
                    <button class="bt btVide" id="bt_reserver">Réserver ce cadeau</button>
                    <?php endif;?>
                    <?php if(get_field('etat_reservation') == true): ?>
                    <p class="etatReservation">Cadeau réservé</p>
                    <?php endif;?>
                </div>
            </li>
            
            
            <?php endwhile;?>
            
        </ul>		
        
    <div class="alert alertOk">
       <div class="wrapper_alert">
            <div>
            <svg viewBox="0 0 100 100" width="30" height="30">
                <use xlink:href="#icon-tick"></use>
            </svg>
            <p>Réservation effectuée !</p>  
            <p>Un mail vous a été envoyé, il vous permettra d'annuler cette réservation.</p>
            </div>
        </div>
    </div>

    <div class="alert alertError">
       <div class="wrapper_alert">
            <div>
            <svg viewBox="0 0 100 100" width="30" height="30">
                <use xlink:href="#icon-tick"></use>
            </svg>
            <p>Une erreur est survenue, merci de vérifier votre saisie.</p>
            </div>
        </div>
    </div>			

</section>



<?php endif;?>

<?php endif;?>