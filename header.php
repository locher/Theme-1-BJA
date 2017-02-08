<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		
		<?php 
            $maries = get_field('maries', 'option'); 
       ?>
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php echo $maries[0]['prenom']; ?> & <?php echo $maries[1]['prenom']; ?>
</title>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		
		<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300,500,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Alegreya:400,400i,700" rel="stylesheet"> 

		<?php wp_head(); ?>
		
		<?php
            if(get_field('toolbar_bja', 'option')){
                $classToolbar = 'bja-bar';
            }else{
                $classToolbar = '';
            }
        ?>

	</head>
	<body <?php body_class(array(get_field('pack_achete', 'option'), $classToolbar)); ?>>
		
    <div class="svg-wrapper" aria-hidden="true">
        <?php echo file_get_contents(get_template_directory_uri().'/img/svg-prod/sprite/svgs.svg'); ?>
    </div>
    
    <?php if(get_field('toolbar_bja', 'option')): ?>
    
    <div class="toolbar-bja">
       
       <div class="wrapper">
           
            <a href="http://bonjouramour.fr" class="logo-bja"><img src="<?php echo get_template_directory_uri().'/img/logo-small-bja.svg';?>" alt="Bonjour Amour" width="40"></a>

            <div class="select-pack">
                <span class="title_pack">Pack présenté</span>
                <ul class="list-pack">
                   <li class="actuel_pack">Pack 1 : Châton mignon <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleche"></use></svg></li>
                    <li>
                        <ul class="submenu">
                            <li><a href="http://pack1.bjramour.fr">Pack 1 : Châton mignon</a></li>
                            <li><a href="http://pack2.bjramour.fr">Pack 2 : Chatounette</a></li>
                            <li><a href="http://pack3.bjramour.fr">Pack 3 : Matou d'la street</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <div class="bt-toolabars">
                <a href="#" class="bt-vente bt-vide bt-contact">Nous contacter</a>
                <a href="#" class="bt-vente bt-commander">Commander</a>
            </div>
        
        </div>
    </div>  
    
    <?php endif; ?>

    <?php

        $imageGenerale = get_field('photo_principale', 'option');
        $imagePage = get_field('image_page');
        
        $size = 'sL1500';

        if(!empty($imagePage)){ 
            // vars
            $url = $imagePage['url'];
            $title = $imagePage['title'];
            $alt = $imagePage['alt'];
            $caption = $imagePage['caption'];

            // thumbnail
            $thumb = $imagePage['sizes'][ $size ];
            $width = $imagePage['sizes'][ $size . '-width' ];
            $height = $imagePage['sizes'][ $size . '-height' ];
            
        }elseif(has_post_thumbnail()){
            $thumb_id = get_post_thumbnail_id();
            $url = wp_get_attachment_image_src($thumb_id,'sL1500', true)[0];
        }elseif( !empty($imageGenerale) ){ 
            // vars
            $url = $imageGenerale['url'];
            $title = $imageGenerale['title'];
            $alt = $imageGenerale['alt'];
            $caption = $imageGenerale['caption'];

            // thumbnail
            $thumb = $imageGenerale['sizes'][ $size ];
            $width = $imageGenerale['sizes'][ $size . '-width' ];
            $height = $imageGenerale['sizes'][ $size . '-height' ];
        }else{
             echo "Aucune image définie";
        }

    ?>
    
        <style>.headerContent{background-image:url('<?php echo $url;?>')}</style>
        
       <div class="wrapper">