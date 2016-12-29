<?php 
    if(isset($_GET['id']) && $_GET['id'] != ""){
        $id = $_GET['id'];
    }

    if(isset($_POST['hidden_id']) && $_POST['hidden_id'] != ""){
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
?>
<?php /* Template Name: Validation */ get_header(); ?>

<section class="validation">
   <div>
        <h2>Suppression de votre covoiturage</h2>
        <p>Êtes vous-sûr ?</p>

        <form action="<?php echo ods_getTemplatePermalink('template_validation.php'); ?>" method="POST">
            <input type="hidden" value="<?php echo $id;?>" name="hidden_id"/>
            <a class="bt btVide" href="<?php echo ods_getTemplatePermalink('template_information.php'); ?>/#covoiturage">Non, annuler</a>
            <input type="submit" name="validate_delete" value="Oui, supprimer" />
            
        </form>
    </div>
</section>

<?php get_footer(); ?>