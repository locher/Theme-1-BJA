<?php if(get_field('pack_achete', 'option') == "pack3"): ?>

<section class="wrapperPadding bgsection covoit">
    
		<div class="wrapper-title">
			<h2>Covoiturage</h2>
            <p class="subtitle">Lorem ipsum</p>
			<svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
		</div>		
		
		<?php    
    
            $argsPosts = array(
                'post_type'		=> 'covoiturage',
                'posts_per_page' => -1,
            ); 
                
            $queryPosts = new WP_Query( $argsPosts );

            ?>
        <?php if( $queryPosts->have_posts() ): ?>
        
        <table>
            <thead>
               <tr>
                   <td><p>Ville de départ</p><p>Arrêts possibles</p></td><td><p>Date allé</p><p>Date retour</p></td><td class="nbPlaces"><p>Places</p></td><td><p>Contact</p></td>
               </tr>
                
            </thead>
            
            <tbody id="listCovoit">
        
            <?php while( $queryPosts->have_posts() ) : $queryPosts->the_post(); ?>
            <tr>
                <td><p><?php the_field('ville_de_depart');?></p><p><?php the_field('arrêts_possible');?></p></td>
                <td><p><?php the_field('horaire_de_depart');?></p><p><?php the_field('horaire_de_retour');?></p></td>
                <td class="nbPlaces"><p><?php the_field('nombre_de_places');?></p></td>
                <td><p><?php the_field('nom');?></p><p><a href="tel:<?php echo(str_replace(' ','',get_field('telephone')));?>"><?php the_field('telephone');?></a> / <a href="mailto:<?php the_field('email');?>"><?php the_field('email');?></a></p></td>
            </tr>
            <?php endwhile;?>
            
            </tbody>
		
		</table>
		
		<?php else:?>
		
		<table class="noCovoit">
            <thead>
               <tr>
                   <td><p>Ville de départ</p><p>Arrêts possibles</p></td><td><p>Dates</p></td><td><p>Places</p></td><td><p>Contact</p></td>
               </tr>
                
            </thead>
            
            <tbody id="listCovoit">
            
            </tbody>
		
		</table>
		
		<p class="nopost">Aucun covoiturage proposé pour le moment.</p>
		
		<?php endif;?>
		
		<button class="bt">Proposer un covoiturage</button>		

</section>

<section class="upload_photos wrapperPadding bgsection covoitForm">
        <div class="wrapper-title">
            <h2>Proposer un covoiturage</h2>
            <p class="subtitle">Vous avez des places dans votre voiture ?</p>
            <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
        </div>	

        <form action="" method="post" enctype="multipart/form-data" id="submitCovoit">

            <div class="form_text">
                <p>
                    <label for="name">Votre nom ? <span class="required">*</span></label>
                    <input type="text" id="name" name="name_covoit" required>
                </p>

                <p class="formHalf">
                    <label for="phone">Votre numéro de téléphone ? <span class="required">*</span></label>
                    <input type="text" id="phone" name="phone_covoit" required>
                </p>

                <p class="formHalf halfRight">
                    <label for="email">Votre email ? <span class="required">*</span></label>
                    <input type="email" id="email" name="email_covoit" required>
                </p> 
                
                <p class="formHalf">
                    <label for="places">Nombre de places ? <span class="required">*</span></label>
                    <input type="number" id="places" name="place_covoit" required>
                </p>
                
                <br>
                
                <p class="formHalf">
                    <label for="villeDepart">Ville de départ <span class="required">*</span></label>
                    <input type="text" id="villeDepart" name="depart_covoit" required>
                </p>
                
                <p class="formHalf halfRight">
                    <label for="via">Arrêts possibles</label>
                    <input type="text" id="via" name="via_covoit">
                </p>
                
                <p class="formHalf">
                    <label for="date_depart">Horaire de départ <span class="required">*</span></label>
                    <input type="text" id="date_depart" name="DateDepart_covoit" required>
                </p>
                
               <p class="formHalf halfRight">
                    <label for="date_retour">Horaire de retour</label>
                    <input type="text" id="date_retour" name="DateRetour_covoit">
                </p>

                <p class="tcenter">
                    <button type="submit">
                        <span class="value_submit show">Publier mon covoiturage</span>
                        <span class="wait-submit hide">
                           <svg viewBox="0 0 100 100" width="30" height="30">
                                <use xlink:href="#icon-refresh"></use>
                            </svg>
                        </span>
                    </button>
                </p>
                


            </div>

        </form>
</section>

                <div class="alert alertOk">
                   <div class="wrapper_alert">
                        <div>
                                                    <svg viewBox="0 0 100 100" width="30" height="30">
                            <use xlink:href="#icon-tick"></use>
                        </svg>
                        <p>Covoiturage ajouté !</p>
                        </div>
                    </div>
                </div>


<?php endif;?>