<?php if(get_field('pack_achete', 'option') == "pack3"): ?> 
   
<?php 
    $args_tous = array(
        //Tous les déroulements
        'post_type'		=> 'wishlist'
    ); 
    $query_tous = new WP_Query( $args_tous );
?>
   
<?php if( $query_tous->have_posts() ): ?>  

<div class="bgsection wrapperPadding rappelRsvp rappelGift">
    <div class="wrapper-title">
        <h2><?php the_field('titre_wishlist', 'option');?></h2>
        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>
    
    <?php     
        $dateformat = "j F";
        $unixtimestamp = strtotime(get_field('reponse_souhaitee_avant', 'option', false));
    ?>
    <p><?php the_field('sous-titre_wishlist', 'option');?></p>
    <a href="<?php echo ods_getTemplatePermalink('template_information.php'); ?>" class="bt">Voir la liste</a>
</div>

<?php endif;?>

<?php endif;?>