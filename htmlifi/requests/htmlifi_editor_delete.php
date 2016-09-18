<?php
	add_action( 'wp_ajax_editor_delete', 'editor_delete' );

	function editor_delete() {
		global $wpdb;
		$table_name = HTMLIFI::$GLOBALS->table_name;
		
		$array_id = sanitize_text_field( $_POST['array_id'] );
		$array_id = stripslashes( $array_id );
		$array_id = json_decode( $array_id );
		$htmlifi_id = HTMLIFI::$FUNCTIONS->sanitize_array( $array_id );
		$length = count( $array_id );
		$substitute = array_fill( 0, $length, '%d' );
		$substitute = join( ', ', $substitute );
		
		$query = "DELETE FROM $table_name WHERE post_id IN ($substitute)";
		$wpdb->query( $wpdb->prepare( $query, $htmlifi_id ) );
		$new_table = $wpdb->prefix . 'posts';
		$query = "DELETE FROM $new_table WHERE ID IN ($substitute)";
		$wpdb->query( $wpdb->prepare( $query, $htmlifi_id ) );
	}
?>