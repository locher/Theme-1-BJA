<?php /* Template Name: Live Galerie */ get_header(); ?>

<?php
    //Photos officielles
    $imagesOfficielle = get_field('galerie_photo');
?>

<!-- header -->
<header class="header" role="banner">

    <?php include('logo-nav.php');?>
    
    <div class="headerContent">
   
        <h1><?php the_title();?></h1>
        <div class="ss-menu">
            <ul>
                <li><a href="#photosLive">Vos photos live</a></li>
                <li><a href="#addLive">Ajoutez vos photos live</a></li>
                <?php if($imagesOfficielle): ?>
                <li><a href="#photosOfficielles">Photos officielles</a></li>
                <?php endif;?>
            </ul>
        </div>    
    </div>

</header>
<!-- /header -->

<?php

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
if($name_correct == true && $file_image == true){
    
    $postArgs = array(
        'post_title' => $name_author.' '.time(),
        'post_type' => 'live',
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


<div id="photosLive" class="wrapperPadding">
		<div class="wrapper-title">
			<h2><?php the_title(); ?></h2>
            <p class="subtitle">Retracez le mariage, minute par minute</p>
			<svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
		</div>		
		
		<?php

			$previous_year = $year = 0;
			$previous_month = $month = 0;
			$previous_day = $day = 0;
			$ul_open = false;

			$myposts = get_posts(array(
				'post_type'=>'live',
				'posts_per_page'=>-1,
				'post_status' => 'publish',
			));

		?>

		<section class="timeline-live">

		<?php foreach($myposts as $post) : ?>	

			<?php

			setup_postdata($post);

			$year = mysql2date('Y', $post->post_date);
			$month = mysql2date('n', $post->post_date);
			$day = mysql2date('j', $post->post_date);

			?>

			<?php if($year != $previous_year || $month != $previous_month || $day != $previous_day)  : ?>

				<?php if($ul_open == true) : ?>
				</ul>
				<?php endif; ?>

				<p class="day"><?php the_time('l d F'); ?></p>

				<ul>

				<?php $ul_open = true; ?>

			<?php endif; ?>

			<?php $previous_year = $year; $previous_month = $month; $previous_day = $day; ?>

						<li class="single_moment">
							<div class="col1">
								<p class="meta_moment"><span class="heure_moment"><?php the_time('G\hi');?></span> par <span class="nom_moment"><?php the_field('nom');?></span></p>
								<div class="comment_moment"><?php the_field('texte_live');?></div>
							</div>
							<div class="milieu">
								<svg viewBox="0 0 100 100" width="30" height="30" class="icon">
								  <use xlink:href="#icon-coeur"></use>
								</svg>
							</div>
							<div class="col2">

							<?php 

							$images = get_field('galerie');

							if( $images ): ?>

								<?php foreach( $images as $image ): ?>

										<?php 

											$classImage = "taille1";
											$sizeImage = "s300";

											if(count($images) < 4 && count($images) > 1)
											{
												$classImage = "taille2";
												$sizeImage = "s200";
											}

											if(count($images) >= 4)
											{
												$classImage = "taille3";
												$sizeImage = "s150";
											} 
										?>

										<a href="<?php echo $image['sizes']['sL1200']; ?>" class="<?php echo $classImage; ?> lightbox" title="<?php the_field('nom');?>">
											 <img src="<?php echo $image['sizes'][$sizeImage]; ?>" alt="<?php echo $image['alt']; ?>" class="<?php echo $classImage;?>" />
										</a>

								<?php endforeach; ?>

							<?php endif; ?>

							</div>
						</li>

		<?php endforeach; ?>

			</ul>

		</section>
		
		</div>

	<section class="upload_photos bgsection wrapperPadding" id="addLive">
			<div class="wrapper-title">
				<h2>Ajoutez vos photos</h2>
				<p class="subtitle">Laisser un souvenir aux mariés, votre plus beau cadeau !</p>
				<svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
			</div>	

			<form action="<?php echo ods_getTemplatePermalink('template_galerieLive.php'); ?>" method="post" enctype="multipart/form-data" class="" id="addPhotos">

				<div class="form_text">
					<p>
						<label for="name">Votre nom ?</label>
						<input type="text" id="name" name="name_author" value="<?php echo $_COOKIE["name"]; ?>">
					</p>
					
					<p>
					    <label for="upload">Sélectionnez vos photos <span>(Max 5, jpeg uniquement)</span></label>
					    <input type="file" name="upload_attachment[]" class="inputfile" multiple="multiple" id="upload" accept="image/jpeg" data-multiple-caption="{count} fichiers sélectionnés" />
					    <br><label for="upload" class="file_label"><span>Choisir mes photos</span></label>
					</p>
					

					<p>
						<label for="message">Votre message ? <span>(facultatif)</span></label>
						<textarea name="message_fac" id="message" cols="30" rows="5"></textarea>
                    </p>

					<?php wp_nonce_field( 'upload_attachment', 'image_upload_nonce' ); ?>

					<p class="tcenter">
                        <button type="submit">
                            <span class="value_submit show">Publier mes photos </span>
                            <span class="wait-submit hide">
                               <svg viewBox="0 0 100 100" width="30" height="30">
                                    <use xlink:href="#icon-refresh"></use>
                                </svg>
                            </span>
                        </button>
					</p>
					

					
				</div>

			</form>
	</section>
	
	<?php
        wp_reset_query();
        if( $imagesOfficielle ):

    ?>

	
	<section class="gallery wrapperPadding" id="photosOfficielles">
        	    <div class="wrapper-title">
	        <h2><?php the_field('titre_galerie');?></h2>
	        <p class="subtitle"><?php the_field('sous-titre_galerie');?></p>
	        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
	    </div>	
	    	   <ul>
        <?php foreach( $imagesOfficielle as $image ): ?>
            <li>
                <a href="<?php echo $image['sizes']['sL1200']; ?>" class="lightbox">
                     <img src="<?php echo $image['sizes']['s300']; ?>" alt="<?php echo $image['alt']; ?>" />
                </a>                
            </li>
        <?php endforeach; ?>
        </ul>   
	    
	</section>
	
	<?php endif;?>



<script>

    
(function ($, root, undefined) {

$(function () {

    'use strict';

    //Countdown
    
    var dateMariage = '<?php echo $dateMariage->format('Y/m/d');?> <?php echo $heureMariage->format('G:i:s'); ?>';
    $('#clock').countdown(dateMariage, {elapse: true}).on('update.countdown', function(event) {
        var $this = $(this);
        if (event.elapsed) {
            //Après la fin
            $this.html(event.strftime('<div><span>%D</span> jour%!D</div><div><span>%H</span> heure%!H</div><div><span>%M</span> minute%!M</div><div><span>%S</span> seconde%!S</div>'));
            $this.parent().find('.text-compteur').html('Heureux mariés depuis :')
        } else {
            //Avant la fin
            $this.html(event.strftime('<div><span>%D</span> jour%!D</div><div><span>%H</span> heure%!H</div><div><span>%M</span> minute%!M</div><div><span>%S</span> seconde%!S</div>'));
        }
    });    

});

})(jQuery, this);	


    
</script>

<?php get_footer(); ?>