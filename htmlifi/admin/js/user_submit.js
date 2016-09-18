$(document).ready( function() {
	$("#form_data").on( 'submit', '.post_init', function(event) { 
		var $data = $(this).serialize();
		$.ajax({ url: 'admin-ajax.php', data: $data, type: 'POST' });
	} );
		
	$("body").on( 'click', '#submit', function() { 
		$(".post_init").each( function( event ) { 
			$(this).submit();
		} );
	} );
} );