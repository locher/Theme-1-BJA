<?php if(get_field('pack_achete', 'option') == "pack2" OR get_field('pack_achete', 'option') == "pack3"): ?>  

   <div class="bgsection wrapperPadding rappelLive">
    <div class="wrapper-title">
        <h2>Galerie Live!</h2>
        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>
    <p>Pendant le mariage, publiez vos photos !</p>
    
    <div class="wrapperImgLive">
        <img src="<?php echo get_template_directory_uri() ?>/img/smartphoneLive.png" alt="">
    </div>
    
    <a href="<?php echo ods_getTemplatePermalink('template_galerieLive.php'); ?>" class="bt">Accéder à la galerie Live!</a>
</div>

<?php endif;?>