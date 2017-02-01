<?php 

$expire = get_field('date_suppression_formulaire_inscription', 'option', false);
$now = time();

if($expire == '' or strtotime($expire) > $now or get_field('mode_demo', 'option', false)):

?>

<div class="bgsection wrapperPadding rappelRsvp">
    <div class="wrapper-title">
        <h2>Vous êtes invité à notre mariage !</h2>
        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>
    
    <?php     
        $dateformat = "j F";
        $unixtimestamp = strtotime(get_field('reponse_souhaitee_avant', 'option', false));
    ?>
    <p>Veuillez s'il vous plait confirmer votre présence avant le <strong><?php echo date_i18n($dateformat, $unixtimestamp); ?></strong></p>
    <a href="<?php echo ods_getTemplatePermalink('template_formReponse.php'); ?>" class="bt">Votre réponse</a>
</div>

<?php endif;?>