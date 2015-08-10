		// REMOVE ITEM ON CREATION OF ORDER VIA JS
		$( ".canceladditem" ).click(function() {
			console.log(".glyphicon-minus" );
		  //var parent = $(currObj).parents('.class')); 
		  $(this).parents('.singleitem').remove();
		});