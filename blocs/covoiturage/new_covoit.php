<?php


if(isset($_POST['name_covoit']) && $_POST['name_covoit'] != "" && isset($_POST['phone_covoit']) && $_POST['phone_covoit'] != "" && isset($_POST['email_covoit']) && $_POST['email_covoit'] != "" && isset($_POST['place_covoit']) && $_POST['place_covoit'] != "" && isset($_POST['depart_covoit']) && $_POST['depart_covoit'] != "" && isset($_POST['DateDepart_covoit']) && $_POST['DateDepart_covoit'] != "" && isset($_POST['DateRetour_covoit']) && $_POST['DateRetour_covoit'] != ""){
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
    
    $reponse = 'success';
    
    echo json_encode(array(
        'reponse' => $reponse,
		'nom'=>$nom,
		'telephone'=>$telephone,
		'email'=>$email,
		'nombre_de_places'=>$nombre_de_places,
		'ville_de_depart' =>$ville_de_depart,
		'arrêts_possible' =>$arrêts_possible,
		'horaire_de_depart' =>$horaire_de_depart,
		'horaire_de_retour' =>$horaire_de_retour
        
	));    
}

?>