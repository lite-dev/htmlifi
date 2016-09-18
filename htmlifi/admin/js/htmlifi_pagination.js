function repaginate( $single ) {
	$tables = $('table.htmlifi');
	if( typeof $single !== 'function' ) { $tables = $single; }
	$tables.each( function() {
		var current_page = 0;
		var rows_per_page = htmlifi.cells;
		
    		var $table = $(this);
		var $rows = $table.find( 'tbody tr:visible' ).not('.htmlifi_pagination');
    
		$table.off().on( 'repaginate', function() {
			start = current_page * rows_per_page;
			end = ( current_page + 1 ) * rows_per_page;
			$rows.hide().slice( start, end  ).show();
		} );

		$table.on('insert_repaginate', function() {
			num_of_cells = $rows.filter(':first').children('td').length;
			num_of_pages = Math.ceil( $rows.length / rows_per_page );
		
			$cell = $('<td></td>').text('Pages: ');
			$cell.attr( 'colspan', num_of_cells );
			$pagination = $('<tr class="htmlifi_pagination"></tr>').append($cell);

			for( var page = 0; page < num_of_pages; page++ ) {
				$span = $('<span></span>');
				$span.text( page + 1 ).css( {'display':'inline-block', 'cursor':'pointer', 'padding':'5px 8px'} ).on( 'click', page, function(event) {
					current_page = event.data;
					$table.trigger('repaginate');
					$(this).css({'background':'lightgrey', 'color':'white'}).siblings().css({'background':'initial', 'color':'initial'});
				} ).appendTo($cell);
			}
			
			$cell.find( 'span:first' ).css({'background':'lightgrey', 'color':'white'});
    			if( $table.find('.htmlifi_pagination').length ) { $table.find('.htmlifi_pagination').remove(); }
			if( $rows.length > rows_per_page ) { $table.append($pagination); }
    		} );

  		$table.trigger('repaginate');
    		$table.trigger('insert_repaginate');
  	});
}

$(document).ready( repaginate );