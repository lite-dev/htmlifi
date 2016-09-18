$(document).ready( function() {
	$form = $("#initial");
	function insertion() { $("#form_data").load( 'admin-ajax.php', { action: 'admin_tables' } ); }
	
	if( $("#form_data").is( ":empty" ) ) { insertion(); }

	$form.children(":first").keyup( function() {
		var $string = $form.serialize();
		$.ajax({ url: 'admin-ajax.php', data: $string, type: $form.attr("method"), success: function() { insertion(); } });
	} );
} );



