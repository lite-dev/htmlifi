<?php
	class HTMLIFI_SETTINGS extends HTMLIFI {
		function __construct() {
			require_once( HTMLIFI::$PLUGIN_DIR . 'settings/htmlifi_db_setup.php' );
			//require_once( HTMLIFI::$PLUGIN_DIR . 'settings/htmlifi_post_type.php' );
		}

		function run_styles_and_scripts() {
			require_once( HTMLIFI::$PLUGIN_DIR . 'settings/htmlifi_styles_scripts.php' );
		}
	}
?>