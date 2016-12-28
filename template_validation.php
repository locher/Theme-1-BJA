<?php 
    if(isset($_GET['id']) && $_GET['id'] != ""){
        $id = $_GET['id'];
    }

    if(isset($_POST['hidden_id']) && $_POST['hidden_id'] != ""){
        $hidden_id = $_POST['hidden_id'];
        
        //On vire la clé
        $hidden_id = base64_decode($hidden_id);
        $hidden_id = str_replace('xmo12locher','M', $hidden_id);
        $hidden_id = base64_decode($hidden_id);
        $hidden_id = str_replace('c1402','',$hidden_id);
        
        
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