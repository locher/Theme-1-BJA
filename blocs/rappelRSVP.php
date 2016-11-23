<?php 

$expire = get_field('date_suppression_formulaire_inscription', 'option', false);

if(strtotime($expire) > strtotime(now)):

?>

<div class="bgsection wrapperPadding rappelRsvp">
    <div class="wrapper-title">
        <h2>Vous êtes invité à notre mariage !</h2>
        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>
    <p>Veuillez s'il vous plait confirmer votre présence avant le <?php the_field('reponse_souhaitee_avant', 'option'); ?></p>
    <a href="<?php echo ods_getTemplatePermalink('template_formReponse.php'); ?>" class="bt">Votre réponse</a>
</div>


<?php endif;?>