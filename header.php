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

	</head>
	<body <?php body_class(); ?>>
		
    <div class="svg-wrapper" aria-hidden="true">
        <?php echo file_get_contents(get_template_directory_uri().'/img/svg-prod/sprite/svgs.svg'); ?>
    </div>

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

        }else if( !empty($imageGenerale) ){ 

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