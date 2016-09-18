<?php
	class HTMLIFI_ADMIN {
		public $menu_pages;

		function __construct() {
			require_once( HTMLIFI::$PLUGIN_DIR . 'admin/htmlifi_index.php' );
			HTMLIFI::$SETTINGS->run_styles_and_scripts();
		}
	}
?>