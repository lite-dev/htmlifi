<?php
	global $wpdb;
	$post_table = $wpdb->prefix . 'posts';
	$table_name = HTMLIFI::$GLOBALS->table_name;
	$screen = get_current_screen();

	$query = "SELECT * FROM $table_name, $post_table WHERE post_id = ID";
	$results = $wpdb->get_results( $query, ARRAY_A );

	ob_start();
	
	echo "<h1>"; echo esc_html( get_admin_page_title() ) . "</h1>";

	require_once( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_modifier.php' );
	
	echo "<div id=\"form_data\">";
	
		foreach( $results as $row ) :
	
			foreach( $row as $key => $value ) :
				$row[$key] = maybe_unserialize( $value );
				extract( $row );
			endforeach;
		
			require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_post_top.php' );
					
					foreach( $tables as $table ) :
						require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_table_top.php' );
								$column_array = $columns[$table];
								if( isset( $post_id ) ) :
									HTMLIFI::$FUNCTIONS->_checkedcols($table, $column_array, $post_id);
								else :
									HTMLIFI::$FUNCTIONS->checkedcols($table, $column_array);
								endif;
								$column_size = count($column_array);
						require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_table_bottom.php' );
					endforeach;
					
			require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_post_bottom.php' );
			
		endforeach;
		
	echo "</div>";
	
	submit_button();
	
	$output = ob_get_clean();
	echo $output;
?>