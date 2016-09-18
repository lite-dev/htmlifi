<?php
	function htmlifi_uninstall() {
		$table_name = HTMLIFI::$GLOBALS->table_name;

		delete_option( 'htmlifi_dbuser' );
		delete_option( 'htmlifi_dbpass' );
		delete_option( 'htmlifi_dbhost' );
		delete_option( 'htmlifi_dbname' );
		delete_option( 'htmlifi_pagination' );
	
		function delete_all_htmlifi_posts() {
			$query = "SELECT DISTINCT post_id FROM $table_name";
			$posts_id = $wpdb->get_col( $query );
	
			foreach( $posts_id as $id ) {
				wp_delete_post( $id, true );
			}
		}
	
		delete_all_htmlifi_posts();
	
		$query = "DROP TABLE IF_EXISTS $table_name";
		$wpdb->query($query);
	}
	
	register_deactivation_hook( __FILE__, 'htmlifi_uninstall' );
?>