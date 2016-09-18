$(document).ready( function() { 
	$('.htmlifi thead th').click( function() {
		$inverse = $(this).data('inverse');
		$table = $(this).parents('table.htmlifi');
  		$tbody = $table.find('tbody');
  		thIndex = $(this).index();
  		$rows = $tbody.find('tr').not('.htmlifi_pagination');
		$rows.show().detach();
      
		var rows = [];
  
		$rows.each( function() { rows.push( $(this) ); } );
    
		rows.sort( function( a, b ) {
    			var item1 = a.find('td:eq('+thIndex+')').text();
      			var item2 = b.find('td:eq('+thIndex+')').text();
      			
			if( isNaN(item1) && isNaN(item2) ) {
				if( item1 < item2 ) { return -1; }
				else if( item1 == item2 ) { return 0; }
				else { return 1; }
			}
			
			else { return item1 - item2; }
		} );

		if( $inverse == true ) { rows.reverse(); }
		$(this).data( 'inverse', !$inverse );

		$.each( rows, function( index, value ) {
			$tbody.append(value);
		});

		repaginate( $table );
		$table.prev().find('.htmlifi_search').trigger('keyup');
	}).css( { 'cursor': 'pointer' } );
});