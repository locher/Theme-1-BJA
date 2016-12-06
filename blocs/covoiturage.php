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
        'post_title' => $name_author,
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

<section class="wrapperPadding">
    
		<div class="wrapper-title">
			<h2>Covoiturage</h2>
            <p class="subtitle">Lorem ipsum</p>
			<svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
		</div>		
		
		<?php
			$myposts = get_posts(array(
				'post_type'=>'covoiturage',
				'posts_per_page'=>-1,
				'post_status' => 'publish',
			));
		?>

</section>

<section class="upload_photos bgsection wrapperPadding" id="addLive">
        <div class="wrapper-title">
            <h2>Proposer un covoiturage</h2>
            <p class="subtitle">Vous avez des places dans votre voiture ?</p>
            <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
        </div>	

        <form action="<?php echo ods_getTemplatePermalink('covoiturage.php'); ?>" method="post" enctype="multipart/form-data">

            <div class="form_text">
                <p>
                    <label for="name">Votre nom ?</label>
                    <input type="text" id="name" name="name_covoit">
                </p>

                <p>
                    <label for="phone">Votre numéro de téléphone ?</label>
                    <input type="text" id="phone" name="phone_covoit">
                </p>

                <p>
                    <label for="email">Votre email ?</label>
                    <input type="mail" id="email" name="email_covoit">
                </p>
                
                <p>
                    <label for="places">Nombre de places ?</label>
                    <input type="number" id="places" name="place_covoit">
                </p>
                
                <p>
                    <label for="villeDepart">Ville de départ</label>
                    <input type="text" id="villeDepart" name="depart_covoit">
                </p>
                
                <p>
                    <label for="via">Arrêts possibles</label>
                    <input type="text" id="via" name="via_covoit">
                </p>
                
                <p>
                    <label for="date_depart">Horaire de départ</label>
                    <input type="text" id="date_depart" name="DateDepart_covoit">
                </p>
                
               <p>
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

<?php endif;?>