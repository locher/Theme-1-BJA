(function ($, root, undefined) {
	
	$(function () {
		
        'use strict';
        
        //Apparition du modal pour réserver
        $('#bt_reserver').click(function(){
            $('#resaGift').toggleClass('actif');
        });
        
        $('.closeModal').click(function(){
            $('#resaGift').toggleClass('actif');
        });
        
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
                    $('#resaGift').toggleClass('actif')
                    $('#wishlist .alertOk').fadeIn().delay(3000).fadeOut(500);
                    $('#wishlist').find('.'+id_gift).addClass('giftReserve');
                    $('#wishlist').find('.'+id_gift+' #bt_reserver').hide();
                }
                
                else if(response.reponse === 'error'){
                    $('#wishlist .alertError').fadeIn().delay(3000).fadeOut(500);
                }
                
            }, "json"
        );
            
        });
        
   //End function jquery
	});
	
})(jQuery, this);