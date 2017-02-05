(function ($, root, undefined) {
	
	$(function () {
		
        'use strict';
        
        // Apparition formulaire

        // Je vérifie si c'est checké, si oui des trucs apparaissent, si non ils disparaissent

        function verif_participation(){

            if($('#participeOk').prop('checked')){
                $('#plusOne').parent().slideDown();

            }

            else{
                $('#plusOne').parent().slideUp();
            }
        }

        function verif_accompagnants(){

            if($('#plusOne').prop('checked') && $('#participeOk').prop('checked')){
                $('.accompagnants').slideDown();
            }

            else{
                $('.accompagnants').slideUp();
            }
        }

         // Je lance la vérif une fois au chargement (si refresh)
            verif_participation();
            verif_accompagnants();

        // Et au changement dans le formulaire
        $('#reponseInvit').change(function(){
            verif_participation();
            verif_accompagnants();
        });
        
        //        
		
			
    $( '.inputfile' ).each( function(){
		var $input	 = $( this ),
			$label	 = $input.next( 'label' ),
			labelVal = $label.html();

		$input.on( 'change', function( e ){
            
            console.log('change');
			var fileName = '';

			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else if( e.target.value )
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				$label.find( 'span' ).html( fileName );
			else
				$label.html( labelVal );
		});

		// Firefox bug fix
		$input
		.on( 'focus', function(){ $input.addClass( 'has-focus' ); })
		.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
	});
        
        
    $('body').on('submit', '#addPhotos', function(e){
        $('#addPhotos .hide').toggleClass('hide');
        $('#addPhotos .show').toggleClass('hide');
    });  
        
    // Input accompagnants
        
    $('#nomInvites').tagsInput({
        'defaultText': '',
        'width' : '100%',
        'height' : '50px'

    });
        
        
    //End function jquery
	});
	
})(jQuery, this);


