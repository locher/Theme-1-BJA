<?php 

if ($_GET['c']):

    $files = array();

    $live = new WP_Query(array(
        'post_type'=>'live',
        'posts_per_page'=>-1
    ));

    if ($live->have_posts()):
        while ($live->have_posts()) : $live->the_post();
            $images = get_field('galerie');
            foreach( $images as $image ):
                array_push($files, $image['url']);    
            endforeach;
        endwhile;
    endif;

# create new zip opbject
$zip = new ZipArchive();

# create a temp file & open it
$tmp_file = tempnam('.','');
$zip->open($tmp_file, ZipArchive::CREATE);

# loop through each file
foreach($files as $file){

    # download file
    $download_file = file_get_contents($file);

    #add it to the zip
    $zip->addFromString(basename($file),$download_file);

}

# close zip
$zip->close();

# send the file to the browser as a download
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
header('Content-type: application/zip');
header('Content-disposition: attachment; filename=photosLiveMariage.zip');
readfile($tmp_file);
// remove zip file from temp path
unlink($zip_name);
endif;

?>

<div class="wrap">

<h1>Télécharger toutes les photos lives</h1>

<p>Vous pouvez télécharger toutes les photos dans une seule archive (.zip) <br>
<strong>Attention, si les photos sont nombreuses, l'opération peut prendre plusieurs minutes.</strong></p>
<a href="<?php echo $_SERVER['REQUEST_URI']; ?>&noheader=true&c=1" class="button-primary">Télécharger toutes les photos</a>

<h2>Télécharger les photos individuellement</h2>

<?php
  
    $live = new WP_Query(array(
        'post_type'=>'live',
        'posts_per_page'=>-1
    ));

    if ($live->have_posts()):
    while ($live->have_posts()) : $live->the_post();
    
    $images = get_field('galerie');
    foreach( $images as $image ):

?>
   <style>.lienLive{text-decoration: none;}</style>
    
    <a href="<?php echo $image['url']; ?>" class="lienLive">
         <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
    </a>

<?php       
    endforeach;
    endwhile;
    endif;
?>



</div>