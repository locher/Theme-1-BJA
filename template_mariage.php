<?php /* Template Name: Le mariage */ get_header(); ?>

<?php 
        
    //Heure et date du mariage

    $dateMariage = get_field('date_du_mariage', 'option', false);
    $heureMariage = get_field('heure_de_debut_du_mariage', 'option', false);

    $dateMariage = new DateTime($dateMariage);
    $heureMariage = new DateTime($heureMariage);

?>

<!-- header -->
<header class="header" role="banner">

    <?php include('logo-nav.php');?>
    
    <div class="headerContent">    
        <h1><?php the_title();?></h1>
        <p class="date-header">Le <span><?php the_field('date_du_mariage', 'option'); ?></span> à partir de <span><?php echo $heureMariage->format('G\hi'); ?></span></p>  
    </div>

</header>
<!-- /header -->

<?php
    //Histoire couple
    include('blocs/histoire_couple.php');
?>
      
      
<?php
    //Déroulement
    include('blocs/deroulement/deroulement.php');
?>
   
<?php
    //Déroulement map
    include('blocs/deroulement/deroulementMap.php');
?>

<section class="temoins wrapperPadding bgsection">
        <div class="wrapper-title">
			<h2><?php the_field('titre_temoins', 'option');?></h2>
			<p class="subtitle"><?php the_field('sous-titre_temoins', 'option');?></p>
			<svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
		</div>
		
		<div class="wrapperTemoins">
           
            <div class="temoinsElle">
               
               <?php
                
                $args_elleMaster = array(
                    // Query de la témoin principale de la mariée
                    'post_type'		=> 'temoins',
                    'meta_key'		=> 'categorie',
                    'meta_value'	=> 'elle',
                    'meta_query'	=> array(
                        'relation'		=> 'AND',
                        array(
                            'key'	  	=> 'principal',
                            'value'	  	=> '1',
                            'compare' 	=> '==',
                        ),
                    ),
                ); 
                
                $query_elleMaster = new WP_Query( $args_elleMaster );
                
                ?>
               <?php if( $query_elleMaster->have_posts() ): ?>  
               <?php while( $query_elleMaster->have_posts() ) : $query_elleMaster->the_post(); ?>
                <div class="singleTemoin temoinMaster">
                    <div class="wrapperImgTemoin">
                        <div class="imgTemoin">
                            <img src="<?php echo get_field('photo')['sizes']['s200']; ?>" alt="">
                        </div>
                        <div class="imgMarie">
                            <img src="" alt="">
                        </div>
                    </div>
                    <p class="h3"><?php the_title();?></p>
                    <div class="wrapperText"><?php the_field('texte'); ?></div>

                    <?php if(get_field('email')):?>
                    <a class="bt" href="mailto:<?php the_field('email');?>">Contacter <?php the_title();?></a>
                    <?php endif;?>
                </div>
               <?php endwhile;?>
               <?php endif;?>
               
               
                <?php
                // Query des témoins de la mariée
                $args_elle = array(
                    'post_type'		=> 'temoins',
                    'meta_key'		=> 'categorie',
                    'meta_value'	=> 'elle',
                    'meta_query'	=> array(
                        'relation'		=> 'AND',
                        array(
                            'key'	  	=> 'principal',
                            'value'	  	=> '0',
                            'compare' 	=> '==',
                        ),
                    ),
                );  
            
                $query_elle = new WP_Query( $args_elle );
            ?>
            
            <?php if( $query_elle->have_posts() ): ?>           
               
                <?php 
                    while( $query_elle->have_posts() ) : $query_elle->the_post(); 
                ?>
                <div class="singleTemoin notMaster">
                    <div class="wrapperImgTemoin">
                        <div class="imgTemoin">
                            <img src="<?php echo get_field('photo')['sizes']['s200']; ?>" alt="">
                        </div>
                        <div class="imgMarie">
                            <img src="" alt="">
                        </div>
                    </div>
                    <p class="h3"><?php the_title();?></p>
                    <div class="wrapperText"><?php the_field('texte'); ?></div>

                    <?php if(get_field('email')):?>
                    <a href="mailto:<?php the_field('email');?>">Contacter <?php the_title();?></a>
                    <?php endif;?>
                </div>
                <?php endwhile;?>
            
            <?php endif;?>
            </div>
            
            <div class="temoinsLui">
               
                <?php
                
                $args_ilMaster = array(
                    // Query de la témoin principale de la mariée
                    'post_type'		=> 'temoins',
                    'meta_key'		=> 'categorie',
                    'meta_value'	=> 'lui',
                    'meta_query'	=> array(
                        'relation'		=> 'AND',
                        array(
                            'key'	  	=> 'principal',
                            'value'	  	=> '1',
                            'compare' 	=> '==',
                        ),
                    ),
                ); 
                
                $query_ilMaster = new WP_Query( $args_ilMaster );
                
                ?>
               <?php if( $query_ilMaster->have_posts() ): ?>  
               <?php while( $query_ilMaster->have_posts() ) : $query_ilMaster->the_post(); ?>
                <div class="singleTemoin temoinMaster">
                    <div class="wrapperImgTemoin">
                        <div class="imgTemoin">
                            <img src="<?php echo get_field('photo')['sizes']['s200']; ?>" alt="">
                        </div>
                        <div class="imgMarie">
                            <img src="" alt="">
                        </div>
                    </div>
                    <p class="h3"><?php the_title();?></p>
                    <div class="wrapperText"><?php the_field('texte'); ?></div>

                    <?php if(get_field('email')):?>
                    <a class="bt" href="mailto:<?php the_field('email');?>">Contacter <?php the_title();?></a>
                    <?php endif;?>
                </div>
               <?php endwhile;?>
               <?php endif;?>
               
               <?php            
                $args_il = array(
                    // Query des témoins du marié
                    'post_type'		=> 'temoins',
                    'meta_key'		=> 'categorie',
                    'meta_value'	=> 'lui',
                    'meta_query'	=> array(
                        'relation'		=> 'AND',
                        array(
                            'key'	  	=> 'principal',
                            'value'	  	=> '0',
                            'compare' 	=> '==',
                        ),
                    ),
                );  
            
                $query_il = new WP_Query( $args_il );
            ?>
            
            <?php if( $query_il->have_posts() ): ?>           
               
                <?php 
                    while( $query_il->have_posts() ) : $query_il->the_post(); 
                ?>
                <div class="singleTemoin notMaster">
                    <div class="wrapperImgTemoin">
                        <div class="imgTemoin">
                            <img src="<?php echo get_field('photo')['sizes']['s200']; ?>" alt="">
                        </div>
                        <div class="imgMarie">
                            <img src="" alt="">
                        </div>
                    </div>
                    <p class="h3"><?php the_title();?></p>
                    <div class="wrapperText"><?php the_field('texte'); ?></div>
                    

                    <?php if(get_field('email')):?>
                    <a href="mailto:<?php the_field('email');?>">Contacter <?php the_title();?></a>
                    <?php endif;?>
                </div>
                <?php endwhile;?>
            
            <?php endif;?>
            </div>
		</div>
</section>

<?php get_footer(); ?>