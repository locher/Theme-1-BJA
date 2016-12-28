(function ($, root, undefined) {
	
	$(function () {
		
        'use strict';
        
        // La fonction pour le delay au type sur l'input
        var delay = (function(){
          var timer = 0;
          return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
          };
        })();
        
        //Post covoiturage en AJAX
        
        jQuery('body').on('submit', '#citySearchForm', function(e){
            e.preventDefault();
        });
        
        //Quand je tape dans l'input
        jQuery('#searchCity').keyup(function(){
            
            delay(function(){
                
                // Je récupère les valeurs
                var keyword = jQuery('#searchCity').val();

                jQuery.post(
                    ajaxurl,
                    {
                        'action': 'ajax_covoiturage_search', //L'action dans function.php
                        'keyword': keyword
                    },            

                    function(response){

                        if(response.resultats === "oui"){                
                            $("#listCovoit").find('tr').hide();
                            $(".noCovoitResults").hide();

                            var nbReponse = response.results.length;

                            console.log(nbReponse);

                            for (var i = 0; i < nbReponse; i++){
                                $("#listCovoit").find('[data_id="'+response.results[i]+'"]').show();
                            }
                        }
                        if(response.resultats === "non"){ 
                            $('.noCovoitResults').hide();
                            $("#listCovoit").find('tr').hide();
                            $('#citySearchForm').append('<p class="noCovoitResults">'+response.message+'</p>');
                            console.log(response.message);
                        }

                    }, "json"
                );
                
            }, 400);
            
        });
        
   //End function jquery
	});
	
})(jQuery, this);