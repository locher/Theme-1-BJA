(function ($, root, undefined) {
	
	$(function () {
		
        'use strict';
        
        //Post covoiturage en AJAX
        
        jQuery('body').on('submit', '#resaGift', function(e){
        
        e.preventDefault();
            
        // Je récupère les valeurs
        var id_gift = jQuery(this).find('input[name="id_cadeau"]').val();
        var name_gift = jQuery(this).find('input[name="name_cadeau"]').val();
        var email = jQuery(this).find('input[name="email"]').val();
        
        jQuery.post(
            ajaxurl,
            {
                'action': 'ajax_wishlist',
                'id_gift': id_gift,
                'email': email,
                'name_gift': name_gift
            },            
            
            function(response){
            
                if(response.reponse === 'success'){
                    
                }
                
                else if(response.reponse === 'error'){
                }
                
            }, "json"
        );
            
        });
        
   //End function jquery
	});
	
})(jQuery, this);