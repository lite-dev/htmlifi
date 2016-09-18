<?php
	add_action( 'wp_ajax_register_db', 'register_db' );

	function register_db() {
		$data = sanitize_text_field( $_POST['htmlifi_dbname'] );
		update_option( 'htmlifi_dbname', $data );
	}
?>