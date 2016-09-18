<?php
	add_action( 'wp_ajax_add_form_table', 'add_form_table' );

	function add_form_table() {
		$table = sanitize_text_field( $_POST['table_name'] );
		
		ob_start();
		
		require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_table_top.php' );
			
			$current_table_columns = HTMLIFI::$FUNCTIONS->colnames( $table, 'custom' );
			foreach( $current_table_columns as $col ) :
				echo "<td><input class=\"columns\" value=\"$col\" name=\"columns[]\" type=\"checkbox\" checked/><label>$col</label></td>";
			endforeach;
			$column_size = count($current_table_columns);
			
		require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_table_bottom.php' );
		
		$output = ob_get_clean();
		echo $output;
	}
?>