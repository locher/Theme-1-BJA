(function ($, root, undefined) {
	
	$(function () {
		
        'use strict';
        
        //Affichage form covoiturage

        $('.covoit').find('.bt').click(function(){
           $('.covoitForm').show();

            $('html, body').animate({
                scrollTop: $(".covoitForm").offset().top
        }, 500);
            $(this).hide();
        });
        
        //Post covoiturage en AJAX
        
        jQuery('body').on('submit', '#submitCovoit', function(e){
        
        e.preventDefault();
            
        // Je récupère les valeurs
        var nom = jQuery(this).find('input[name="name_covoit"]').val();
        var telephone = jQuery(this).find('input[name="phone_covoit"]').val();
        var email = jQuery(this).find('input[name="email_covoit"]').val();
        var nombreDePlaces = jQuery(this).find('input[name="place_covoit"]').val();
        var villeDeDepart = jQuery(this).find('input[name="depart_covoit"]').val();
        var arretsPossible = jQuery(this).find('input[name="via_covoit"]').val();
        var horaireDeDepart = jQuery(this).find('input[name="DateDepart_covoit"]').val();
        var horaireDeRetour = jQuery(this).find('input[name="DateRetour_covoit"]').val();
        
        jQuery.post(
            ajaxurl,
            {
                'action': 'ajax_covoiturage',
                'nom': nom,
                'telephone' : telephone,
                'email' : email,
                'nombreDePlaces': nombreDePlaces,
                'villeDeDepart': villeDeDepart,
                'arretsPossible': arretsPossible,
                'horaireDeDepart': horaireDeDepart,
                'horaireDeRetour': horaireDeRetour
            },
            function(response){
                $('#listCovoit').append($(response).hide().fadeIn());
                $('.alertOk').fadeIn().delay(2000).fadeOut(500);
                $('html, body').animate({
                    scrollTop: $(".new_covoit").offset().top
                }, 500);
               $('.covoitForm').slideUp();
                $('.covoit .bt').fadeIn();
            }
        );
            
        });
        
   //End function jquery
	});
	
})(jQuery, this);