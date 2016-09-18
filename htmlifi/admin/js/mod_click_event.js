$(document).ready( function() {
	$( "body" ).on( 'click', '#moderate', function(event) {
		event.preventDefault();
		
		switch( $("#mod").val() ) {
			case "merge" : moderator.merge_action();
			break;
			case "delete" : moderator.delete_action();
			break;
			case "create" : moderator.create_action();
			break;
		}
	} );
	
	$( "#form_data" ).on( 'change', '.page_selector', function() {
		if( $(this).is( ":checked" ) ) { moderator.add_dom_object( $(this), $(this).parents('.htmlifi_post_editor'), 'page' ); }
		else { moderator.delete_dom_object( $(this), 'page' ); }
	} );
	
	$( "#form_data" ).on( 'change', '.table_selector', function() {
		if( $(this).is( ":checked" ) ) {moderator. add_dom_object( $(this), $(this).parent(), 'table' ); }
		else { moderator.delete_dom_object( $(this), 'table' ); }
	} );
	
	$( "body" ).on( 'click', '#submit', function(event) {
		event.preventDefault();
		
		if( moderator.array_id.length > 0 ) {
			var data = JSON.stringify( moderator.array_id );
			$.post( 'admin-ajax.php', { action: 'editor_delete', dir: htmlifi.dir, array_id: data } );
		}
	} );
	
	$( "body" ).on( 'change', '#mod', function() {
		$selected = $("#mod");
		
		if( $selected.val() == "create" ) {
			$table_field = $( "<input id=\"table_field\" type=\"text\" name=\"table_name\" />" );
			$selected.after($table_field);
		}
		
		else { $("#table_field").remove(); }
	} );
	
	$("#form_data").on( 'change', '.columns', function() { 
		$counter = $(this).parents("table").next(); 
		$value = $counter.val();
		
		if( $(this).is(":checked") ) { $value++; $counter.val($value); }
		else { $value--; $counter.val($value); }
	} );
} );