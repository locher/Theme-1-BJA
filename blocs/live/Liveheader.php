<?php

$destination_photos = "live";
$dateMariage = get_field('date_du_mariage', 'option', false);
$now = time();

//Date à laquelle on arrête la timeline : lendemain à midi
$lendemain8h = strtotime($dateMariage) + (24 + 12) * 3600;

// Si on est avant le lendemain 8h, on met le résultat du formulaire dans la timeline
if($now <= $lendemain8h){
    $destination_photos = "live";
}

// Si on est après le lendemain 8h, on met le résultat du formulaire dans la galerie invité
if($now > $lendemain8h){
    $destination_photos = "photos-invites";
}

///

if(isset($_POST['name_author']) && $_POST['name_author'] != ""){
    $name_correct = true;
    $name_author = $_POST['name_author'];
    
    // On garde son nom en cookie pour le mettre dans l'input pour les prochains uploads
    setcookie("name", $name_author);
}

if(isset($_POST['message_fac']) && $_POST['message_fac'] != ""){
    $message_correct = true;
    $message = $_POST['message_fac'];
}

// On vérifie qu'au moins 1 image est ok

if($_FILES && $name_correct == true){

    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    $files = $_FILES['upload_attachment'];
    $count = 0;
    $galleryImages = array();

    foreach ($files['name'] as $count => $value):

        if ($files['name'][$count]) {

            $file = array(
                'name'     => $files['name'][$count],
                'type'     => $files['type'][$count],
                'tmp_name' => $files['tmp_name'][$count],
                'error'    => $files['error'][$count],
                'size'     => $files['size'][$count]
            );
            
            if($file['type'] == "image/jpeg"){                
                $file_image = true;                 
            }
        }

        $count++;  
        
    endforeach;
}

// Si le nom du mec est valide et que y a au moins 1 images valide, on post le truc et on upload ensuite les images
if(isset($name_correct) && $name_correct == true && $file_image == true){
    
    $postArgs = array(
        'post_title' => $name_author.' '.time(),
        'post_type' => $destination_photos,
        'post_status' => 'publish',
    ); 
    
    $id = wp_insert_post($postArgs);    
    
    //Si y a un message on le met dans acf
    if($message_correct == true){        
        update_field('texte_live', $message, $id);	        
    }

    update_field('nom', $name_author, $id);	
    
}

// On a déjà lancé le post parce qu'on sait qu'1 image est ok, maintenant on upload les images 

if($_FILES && $name_correct == true){

    $files = $_FILES['upload_attachment'];
    $count = 0;
    $galleryImages = array();

    foreach ($files['name'] as $count => $value):

        if ($files['name'][$count]) {

            $file = array(
                'name'     => $files['name'][$count],
                'type'     => $files['type'][$count],
                'tmp_name' => $files['tmp_name'][$count],
                'error'    => $files['error'][$count],
                'size'     => $files['size'][$count]
            );
            
            if($file['type'] == "image/jpeg"){
                
                $file_image = true;   

                $upload_overrides = array( 'test_form' => false );
                $upload = wp_handle_upload($file, $upload_overrides);

                // $filename should be the path to a file in the upload directory.
                $filename = $upload['file'];

                // The ID of the post this attachment is for.
                $parent_post_id = $post_id;

                // Check the type of tile. We'll use this as the 'post_mime_type'.
                $filetype = wp_check_filetype( basename( $filename ), null );

                // Get the path to the upload directory.
                $wp_upload_dir = wp_upload_dir();

                // Prepare an array of post data for the attachment.
                $attachment = array(
                    'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                    'post_mime_type' => $filetype['type'],
                    'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                );

                // Insert the attachment.
                $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

                // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                require_once( ABSPATH . 'wp-admin/includes/image.php' );

                // Generate the metadata for the attachment, and update the database record.
                $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
                wp_update_attachment_metadata( $attach_id, $attach_data );

                array_push($galleryImages, $attach_id);
                
            }
        }

        $count++;
    
        if($file_image == true){
            update_field('galerie', $galleryImages, $id);
        }
        
    endforeach;
    
    // On redirige sur la même page pour effacer le formulaire correctement et pouvoir refresh après
    header('Location: '.get_permalink());
}

?>