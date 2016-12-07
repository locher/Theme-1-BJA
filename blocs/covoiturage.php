<?php if(get_field('pack_achete', 'option') == "pack3"): ?>

<?php

if(isset($_POST['name_covoit']) && $_POST['name_covoit'] != "" && isset($_POST['phone_covoit']) && $_POST['phone_covoit'] != "" && isset($_POST['email_covoit']) && $_POST['email_covoit'] != "" && isset($_POST['place_covoit']) && $_POST['place_covoit'] != "" && isset($_POST['depart_covoit']) && $_POST['depart_covoit'] != "" && isset($_POST['via_covoit']) && $_POST['via_covoit'] != "" && isset($_POST['DateDepart_covoit']) && $_POST['DateDepart_covoit'] != "" && isset($_POST['DateRetour_covoit']) && $_POST['DateRetour_covoit'] != ""){
    $name_correct = true;
    $name_covoit = $_POST['name_covoit'];
    $phone_covoit = $_POST['phone_covoit'];
    $email_covoit = $_POST['email_covoit'];
    $place_covoit = $_POST['place_covoit'];
    $depart_covoit = $_POST['depart_covoit'];
    $via_covoit = $_POST['via_covoit'];
    $DateDepart_covoit = $_POST['DateDepart_covoit'];
    $DateRetour_covoit = $_POST['DateRetour_covoit'];
}	

// Si le nom du mec est valide et que y a au moins 1 images valide, on post le truc et on upload ensuite les images
if($name_correct == true){
    
    $postArgs = array(
        'post_title' => $name_covoit,
        'post_type' => 'covoiturage',
        'post_status' => 'publish',
    ); 
    
    $id = wp_insert_post($postArgs);    

    update_field('nom', $name_covoit, $id);	
    update_field('telephone', $phone_covoit, $id);	
    update_field('email', $email_covoit, $id);	
    update_field('nombre_de_places', $place_covoit, $id);	
    update_field('ville_de_depart', $depart_covoit, $id);	
    update_field('arrêts_possible', $via_covoit, $id);	
    update_field('horaire_de_depart', $DateDepart_covoit, $id);	
    update_field('horaire_de_retour', $DateRetour_covoit, $id);	
}

?>

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
                   <td><p>Ville de départ</p><p>Arrêts possibles</p></td><td><p>Dates</p></td><td><p>Places</p></td><td><p>Contact</p></td>
               </tr>
                
            </thead>
            
            <tbody>
        
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
		
		<?php endif;?>
		
		<button class="bt">Proposer un covoiturage</button>		

</section>

<section class="upload_photos wrapperPadding bgsection covoitForm" id="addcovoit">
        <div class="wrapper-title">
            <h2>Proposer un covoiturage</h2>
            <p class="subtitle">Vous avez des places dans votre voiture ?</p>
            <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
        </div>	

        <form action="<?php echo ods_getTemplatePermalink('template_information.php'); ?>" method="post" enctype="multipart/form-data">

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
                    <label for="date_retour">Horaire de retour <span class="required">*</span></label>
                    <input type="text" id="date_retour" name="DateRetour_covoit" required>
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

<?php endif;?>