<?php
	add_action( 'wp_ajax_add_form_post', 'add_form_post' );

	function add_form_post() {
		require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_post_top.php' );
		require( HTMLIFI::$PLUGIN_DIR . 'forms/htmlifi_form_post_bottom.php' );
	}
?>