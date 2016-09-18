<?php
	function htmlifi_scripts() {
		$screen = get_current_screen();

		if( strpos( $screen->base, 'htmlifi' ) !== false ) :
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'newjquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js' );

			wp_enqueue_script( 'htmlifi_standard', HTMLIFI::$PLUGIN_URL . 'admin/js/standard.js' );
			wp_enqueue_style( 'backend_css', HTMLIFI::$PLUGIN_URL . 'admin/css/css.css' );
		endif;

		if( $screen->base == 'htmlifi/admin/htmlifi_creator' ) :
			wp_enqueue_script( 'admin_sent', HTMLIFI::$PLUGIN_URL . 'admin/js/jquery.js' );
		endif;
		
		if( $screen->base == 'htmlifi/admin/htmlifi_creator' || $screen->base == 'htmlifi/admin/htmlifi_editor' ) :
			wp_enqueue_script( 'user_submit', HTMLIFI::$PLUGIN_URL . 'admin/js/user_submit.js' );
			wp_enqueue_script( 'mod_click', HTMLIFI::$PLUGIN_URL . 'admin/js/mod_click_event.js' );
			wp_enqueue_script( 'mod_object', HTMLIFI::$PLUGIN_URL . 'admin/js/moderator_object.js' );
		endif;

		$htmlifi_requests = array(
			'url'  => HTMLIFI::$PLUGIN_URL,
			'dir'  => HTMLIFI::$PLUGIN_DIR
		);

		wp_localize_script( 'admin_sent', 'htmlifi', $htmlifi_requests );
		wp_localize_script( 'mod_click', 'htmlifi', $htmlifi_requests );
	}
	
	function htmlifi_frontend_scripts() {
		wp_enqueue_script( 'newjquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js' );
		//wp_enqueue_script( 'mobilejquery', 'http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js' );
		//wp_enqueue_style( 'mobilecss', 'http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css' );
		wp_enqueue_script( 'htmlifi_pagination', HTMLIFI::$PLUGIN_URL . 'admin/js/htmlifi_pagination.js' );
		wp_enqueue_script( 'htmlifi_search', HTMLIFI::$PLUGIN_URL . 'admin/js/htmlifi_search.js' );
		wp_enqueue_script( 'htmlifi_sort', HTMLIFI::$PLUGIN_URL . 'admin/js/htmlifi_sort.js' );
		
		$data = array(
			'cells' => get_option( 'htmlifi_pagination', 20 )
		);
		
		wp_localize_script( 'htmlifi_pagination', 'htmlifi', $data );
	}
	
	add_action( 'admin_enqueue_scripts', 'htmlifi_scripts' );
	add_action( 'wp_enqueue_scripts', 'htmlifi_frontend_scripts' );
?>