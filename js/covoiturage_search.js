(function ($, root, undefined) {
	
	$(function () {
		
        'use strict';
        
        //Post covoiturage en AJAX
        
        jQuery('body').on('submit', '#citySearchForm', function(e){
            e.preventDefault();
        });
        
        jQuery('body').on('change', '#searchCity', function(e){
            
        // Je récupère les valeurs
        var keyword = jQuery(this).val();
        
        jQuery.post(
            ajaxurl,
            {
                'action': 'ajax_covoiturage_search',
                'keyword': keyword
            },            
            
            function(response){
                
                if(response.resultats === "oui"){                
                    $("#listCovoit").find('tr').hide();
                    $(".noCovoitResults").hide();

                    var nbReponse = response.results.length;

                    console.log(nbReponse);

                    for (var i = 0; i < nbReponse; i++){
                        $("#listCovoit").find('[data_id="'+response.results[i]+'"]').fadeIn();
                    }
                }
                if(response.resultats === "non"){ 
                    $("#listCovoit").find('tr').hide();
                    $('#citySearchForm').append('<p class="noCovoitResults">'+response.message+'</p>');
                    console.log(response.message);
                }
                
            }, "json"
        );
            
        });
        
   //End function jquery
	});
	
})(jQuery, this);