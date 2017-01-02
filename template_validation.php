<?php

    $id = '';
    $type = '';

    if(isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['type']) && $_GET['type'] != ""){
        $id = $_GET['id'];
        $type = $_GET['type'];
    }

    // Suppression covoiturage
    if(isset($_POST['hidden_id']) && $_POST['hidden_id'] != "" && $_POST['actionType'] === "covoiturage"){
    
        $hidden_id = $_POST['hidden_id'];
        
        include('inc/covoiturage_key.php');
        
        function decrypt( $string ) {
          $algorithm =  'rijndael-128';
          $key = md5($covoiturageKey, true );
          $iv_length = mcrypt_get_iv_size( $algorithm, MCRYPT_MODE_CBC );
          $string = base64_decode( $string );
          $iv = substr( $string, 0, $iv_length );
          $encrypted = substr( $string, $iv_length );
          $result = mcrypt_decrypt( $algorithm, $key, $encrypted, MCRYPT_MODE_CBC, $iv );
            
          return $result;
        }
        
        $hidden_id = decrypt($hidden_id);
        
        wp_delete_post( $hidden_id);
        
        header('Location: '.ods_getTemplatePermalink('template_information.php').'/#covoiturage');
    }


    // Annulation résa cadeau
    if(isset($_POST['hidden_id']) && $_POST['hidden_id'] != "" && $_POST['actionType'] === "wishlist"){
    
        $hidden_id = $_POST['hidden_id'];
        
        include('inc/covoiturage_key.php');
        
        function decrypt( $string ) {
          $algorithm =  'rijndael-128';
          $key = md5($covoiturageKey, true );
          $iv_length = mcrypt_get_iv_size( $algorithm, MCRYPT_MODE_CBC );
          $string = base64_decode( $string );
          $iv = substr( $string, 0, $iv_length );
          $encrypted = substr( $string, $iv_length );
          $result = mcrypt_decrypt( $algorithm, $key, $encrypted, MCRYPT_MODE_CBC, $iv );
            
          return $result;
        }
        
        $hidden_id_decrypt = decrypt($hidden_id);    
        $hidden_id_decrypt = (int)$hidden_id_decrypt;    
        
        update_field('etat_reservation', '0', $hidden_id_decrypt);
        
        header('Location: '.ods_getTemplatePermalink('template_information.php').'/#wishlist');
    }

    // Annulation réservation cadeau
?>

<?php /* Template Name: Validation */ get_header(); ?>

<section class="validation">
    
    <?php 
        //Cas suppression covoiturage
        if($type === "covoiturage"):
    ?>
  
   <div>
        <h2>Suppression de votre covoiturage</h2>
        <p>Êtes vous-sûr ?</p>

        <form action="<?php echo ods_getTemplatePermalink('template_validation.php'); ?>" method="POST">
            <input type="hidden" value="covoiturage" name="actionType"/>
            <input type="hidden" value="<?php echo $id;?>" name="hidden_id"/>
            <a class="bt btVide" href="<?php echo ods_getTemplatePermalink('template_information.php'); ?>/#covoiturage">Non, annuler</a>
            <input type="submit" name="validate_delete" value="Oui, supprimer" />
            
        </form>
    </div>
    
    <?php endif;?>
    
    <?php
        // Cas Annulation réservation cadeau
        if($type === "gift"):
    ?>
    
       <div>
        <h2>Annulation de la réservation</h2>
        <p>Êtes vous-sûr ?</p>

        <form action="<?php echo ods_getTemplatePermalink('template_validation.php'); ?>" method="POST">
            <input type="hidden" value="wishlist" name="actionType"/>
            <input type="hidden" value="<?php echo $id;?>" name="hidden_id"/>
            <a class="bt btVide" href="<?php echo ods_getTemplatePermalink('template_information.php'); ?>/#covoiturage">Non, quitter</a>
            <input type="submit" name="validate_delete" value="Oui, annuler" />
            
        </form>
    </div>
    
    <?php endif;?>
    
</section>

<?php get_footer(); ?>