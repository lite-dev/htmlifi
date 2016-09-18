<?php
	add_filter( 'the_content', 'htmlifi_tables', 99 );
	
	function htmlifi_tables( $content ) {
		//if ( is_singular( 'htmlifi' )  ) :
			global $post, $wpdb;
			$table_name = HTMLIFI::$GLOBALS->table_name;
			$post_id = $post->ID;
			$database = get_post_custom( $post_id );
			
			$htmlifi = ( $database['htmlifi'][0] == true ? true : false );
			if( $htmlifi ) :
			
			$database = $database["htmlifi_dbname"][0];		
			$query = "SELECT * FROM $table_name WHERE post_id = '%s'";
			$results = $wpdb->get_row( $wpdb->prepare( $query, $post_id ), ARRAY_A );
		
			$tables = maybe_unserialize( $results['tables'] );
			$text = maybe_unserialize( $results['text'] );
			$columns = maybe_unserialize( $results['columns'] );
			$rowtable = maybe_unserialize( $results['rowtable'] );
			$custom_table = maybe_unserialize( $results['custom_table'] );
			
			$text = array_values( $text );
			
			if( !empty( $custom_table ) ) :
				$custom_table = array_values( $custom_table );
			endif;
		
			ob_start();
		
			for( $i = 0; $i < count($tables); $i++ ) :
				if( empty( $custom_table[$i] ) ) :
					echo "<table data-role=\"table\" data-mode=\"columntoggle\" class=\"htmlifi $database ui-responsive\" id=\"$tables[$i]\">";
					echo HTMLIFI::$FUNCTIONS->outputcol( $tables[$i], $columns[$tables[$i]] );
					echo HTMLIFI::$FUNCTIONS->outputrow( $tables[$i], $columns[$tables[$i]], $database );
					echo "</table>";
				else :
					echo $custom_table[$i];
				endif;
		
				if( $text[$i] !== "" ) :
					echo "<p>$text[$i]</p>";
				endif;
			endfor;
			
			$htmlifi_tables = ob_get_clean();
	
			return $new_content = $content . $htmlifi_tables;
		endif;
		
		return $content;
	}
?>