<?php /* Template Name: Home Template */ get_header(); ?>

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
        <div>     
            <p class="h1">Save the date !</p>
            <p class="date-header">Le <span><?php the_field('date_du_mariage', 'option'); ?></span> à partir de <span><?php echo $heureMariage->format('G\hi'); ?></span></p>

            <p class="text-compteur">On a compté, il reste exactement :</p>
            
            <div id="clock" class="countdown"></div>
        </div>
    </div>

</header>
<!-- /header -->

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