<?php
	add_action( 'wp_ajax_admin_tables', 'admin_tables' );

	function admin_tables() {
		$tables = HTMLIFI::$FUNCTIONS->list_of_customdb_tables();

		ob_start();
		
		require_once( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_modifier.php' );
		
		foreach( $tables as $table ) :
			require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_post_top.php' );
					require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_table_top.php' );
						$current_table_columns = HTMLIFI::$FUNCTIONS->colnames( $table, 'custom' );
						foreach( $current_table_columns as $col ) :
							echo "<td><input class=\"columns\" value=\"$col\" name=\"columns[]\" type=\"checkbox\" checked/><label>$col</label></td>";
						endforeach;
						$column_size = count($current_table_columns);
					require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_table_bottom.php' );
			require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_post_bottom.php' );
		endforeach;
	
		$output = ob_get_clean();

		echo $output;
		die();
	}
?>