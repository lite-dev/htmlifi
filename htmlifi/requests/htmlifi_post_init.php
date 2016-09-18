<?php
	add_action( 'wp_ajax_post_init', 'post_init' );

	function post_init() {
		global $wpdb;
		$table_name = HTMLIFI::$GLOBALS->table_name;

		$ID = HTMLIFI::$FUNCTIONS->sanitize_array( $_POST['ID'] );
		$titles = HTMLIFI::$FUNCTIONS->sanitize_array( $_POST['title'] );
		$contents = HTMLIFI::$FUNCTIONS->sanitize_array( $_POST['content'] );
		$tables = HTMLIFI::$FUNCTIONS->sanitize_array( $_POST['table'] );
		$columns = HTMLIFI::$FUNCTIONS->sanitize_array( $_POST['columns'] );
		$text = HTMLIFI::$FUNCTIONS->sanitize_array( $_POST['text'] );
		$custom_table = HTMLIFI::$FUNCTIONS->sanitize_array( $_POST['custom_table'] );
		$colquantity = HTMLIFI::$FUNCTIONS->sanitize_array( $_POST['column_quantity'] );
		
		$col = array();
		$text = array_combine( $tables, $text );
		$custom_table = array_combine( $tables, $custom_table );
		
		for( $i = 0, $x = 0; $i < count($tables); $x += $colquantity[$i], $i++ ) :
			for( $j = $x; $j < ( $colquantity[$i] + $x ); $j++ ) :
				$col[ $tables[$i] ][] = $columns[$j];
			endfor;
		endfor;
		
		if( !isset( $ID[0] ) ) :
			$the_post = array(
				'post_title'     => $titles[0],
				'post_content'   => $contents[0],
				'post_type'      => 'page'
			);
			
			$post_id = wp_insert_post( $the_post );
		
		else :
			$the_post = get_post( $ID[0], ARRAY_A );
			$the_post['post_title'] = $titles[0];
			$the_post['post_content'] = $contents[0];
			$post_id = wp_update_post( $the_post );
		endif;
		
		$entry = array(
			$post_id,
			maybe_serialize($tables),
			maybe_serialize($text),
			maybe_serialize($col),
			maybe_serialize($custom_table)
		);

		$colnames = HTMLIFI::$FUNCTIONS->colnames( $table_name, 'wp' );
		$data = array_combine( $colnames, $entry );

		if( !isset( $ID[0] ) ) :
			$wpdb->insert( $table_name, $data );
			
			$dbname = get_option( 'htmlifi_dbname' );
		else :
			$wpdb->update( $table_name, $data, array( 'post_id' => $post_id ) );
			
			$dbname = get_post_meta( $ID[0], '', true );
			$dbname = $dbname['htmlifi_dbname'][0];
		endif;
		
		update_post_meta( $post_id, 'htmlifi_dbname', $dbname );
		update_post_meta( $post_id, 'htmlifi', true );
	}
?>