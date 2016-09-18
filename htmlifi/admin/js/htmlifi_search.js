function search() {
	$('body').on( 'keyup', 'input.htmlifi_search', function() {
	  	$search = $(this).val().toUpperCase();
		$table = $(this).parents('div.htmlifi_search').next('.htmlifi');
		$rows = $table.find('tbody tr');
	
		$rows.each( function() {
			value = $(this).text().toUpperCase().indexOf( $search )
			if( value === -1 ) { $(this).hide(); }
			else { $(this).show(); }
		} );
		
		repaginate( $table );
	} );
  
	$search = $('<input />');
	$search.addClass('htmlifi_search');
  	$search.attr('type', 'search');
  	$row = $('<div></div>').addClass('htmlifi_search').text('Search: ').append($search);
  	$row.insertBefore('table.htmlifi');   
}

$(document).ready( search );