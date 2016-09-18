	var moderator = {
		page_count : 0,
		table_count : 0,
		page_arrays : [],
		table_arrays : [],
		array_id : [],
		
		delete_array_index : function( array_name, index ) {
			arr = $.grep( array_name, function( n, i ) {
				return i !== index;
			} );
			
			return arr;
		},
		
		add_post_id : function( page ) {
			id = page.find( "input[name='ID[]']" ).val();
			if( id ) { this.array_id.push( id ); }
		},

		add_dom_object : function( check_object, jq_object, type ) {
			if( type == 'page' ) {
				this.page_arrays.push( { check_object : check_object, page : jq_object } );
				this.page_count++;
			}

			else {
				this.table_arrays.push( { check_object : check_object, table : jq_object } );
				this.table_count++;
			}
		},

		delete_dom_object : function( check_object, type ) {
			var mod = this;
			
			if( type == 'page' ) {
				$.each( this.page_arrays, function( index, value ) {
					if ( value['check_object'][0] == check_object[0] ) {
						mod.page_arrays = mod.delete_array_index( mod.page_arrays, index );
					}
				} );
				
				this.page_count--;
			}

			else {
				$.each( this.table_arrays, function( index, value ) {
					if ( value['check_object'][0] == check_object[0] ) {
						mod.table_arrays = mod.delete_array_index( mod.table_arrays, index );
					}
				} );
				
				this.table_count--;
				
			}
		},

		merge_action : function() {
			var mod = this;
			
			if( this.page_count > 0 ) {
				var $primary = this.page_arrays[0]['page'];
				if( this.page_count > 1 ) {
					for( i = 1; i < this.page_count; this.page_count-- ) {
						$current = this.page_arrays[i]['page'];
						$primary.append( $current.children( ".htmlifi_table_editor" ) );
						this.page_arrays = this.delete_array_index( this.page_arrays, i );
						this.add_post_id( $current );
						$current.remove();
					}
				}
				
				if( this.table_count > 0 ) {
					$.each( this.table_arrays, function( index, value ) {
						$primary.append( value['table'] );
					} );
				}
			}
		},

		delete_action : function() {
			var mod = this;
			
			if( this.page_count > 0 ) {
				$.each( this.page_arrays, function( index, value ) { 
					mod.add_post_id( value['page'] );
					value['page'].parent().remove();
					mod.page_arrays = mod.delete_array_index( mod.page_arrays, 0 );
					mod.page_count--;
				} );
			}

			if( this.table_count > 0 ) {
				$.each( this.table_arrays, function( index, value ) { 
					value['table'].remove();
					mod.table_arrays = mod.delete_array_index( mod.table_arrays, 0 );
					mod.table_count--;
				} );
			}
		},

		create_action : function() {
			if( this.page_count == 0 ) {
				$.post( 'admin-ajax.php', { action: 'add_form_post' }, function(data) {
					$( "#form_data" ).append( $(data) );
				} );
			}
			
			else {
				table_field = $('#table_field').val();
				var mod = this;
				$.post( 'admin-ajax.php', { action: 'add_form_table', table_name: table_field }, function(data) {
				var table = $(data);
					$.each( mod.page_arrays, function( index, value ) {
						value['page'].append( table.clone() );
					} );
				} );
			}
		}
	}
