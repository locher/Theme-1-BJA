<?php

$dateMariage = get_field('date_du_mariage', 'option', false);
$now = time();

//Le formulaire de photo est affiché qu'à partir du jour du mariage
if(strtotime($dateMariage) <= $now):

?>   

<section class="upload_photos bgsection wrapperPadding" id="addLive">
    <div class="wrapper-title">
        <h2><?php the_field('titre_formulaire_live', 'option', false); ?></h2>
        <p class="subtitle"><?php the_field('sous-titre_formulaire_live', 'option', false); ?></p>
        <svg viewBox="0 0 100 100" width="50" height="50"><use xlink:href="#icon-fleur"></use></svg>
    </div>	

    <form action="<?php echo ods_getTemplatePermalink('template_galerieLive.php'); ?>" method="post" enctype="multipart/form-data" class="" id="addPhotos">

        <div class="form_text">
            <p>
                <label for="name">Votre nom ?</label>
                <input type="text" id="name" name="name_author" value="<?php if(isset($_COOKIE["name"])){echo $_COOKIE["name"];} ?>">
            </p>

            <p>
                <label for="upload">Sélectionnez vos photos <span>(Max 5, jpeg uniquement)</span></label>
                <input type="file" name="upload_attachment[]" class="inputfile" multiple="multiple" id="upload" accept="image/jpeg" data-multiple-caption="{count} fichiers sélectionnés" />
                <label for="upload" class="file_label"><span>Choisir mes photos</span></label>
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

<?php endif;?>