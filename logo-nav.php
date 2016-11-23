<div class="headerTop">
    

<!-- logo -->
<div class="logo">      
    <?php $maries = get_field('maries', 'option'); ?>

    <a href="<?php echo home_url(); ?>">
        <span class="logoName1">
            <?php echo $maries[0]['prenom']; ?>
        </span>
        <span class="separateurLogo">&</span>
        <span class="logoName2">
            <?php echo $maries[1]['prenom']; ?>
        </span>
    </a>
    
    <p>Le <span><?php the_field('date_du_mariage', 'option'); ?></span></p>
    
</div>

<!-- nav -->
<nav class="nav" role="navigation">

    <input type="checkbox" id="checkboxMenu">
   <label for="checkboxMenu"><span class="icon"></span>Menu</label>

   <div class="linkNav">
       <?php html5blank_nav(); ?>
   </div>

</nav>


</div>