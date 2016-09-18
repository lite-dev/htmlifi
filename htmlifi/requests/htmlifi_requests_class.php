<?php
	class HTMLIFI_REQUESTS extends HTMLIFI {
		function __construct() {
			require_once( HTMLIFI::$PLUGIN_DIR . 'requests/htmlifi_add_form_table.php' );
			require_once( HTMLIFI::$PLUGIN_DIR . 'requests/htmlifi_add_form_post.php' );
			require_once( HTMLIFI::$PLUGIN_DIR . 'requests/htmlifi_admin_tables.php' );
			require_once( HTMLIFI::$PLUGIN_DIR . 'requests/htmlifi_editor_delete.php' );
			require_once( HTMLIFI::$PLUGIN_DIR . 'requests/htmlifi_post_init.php' );
			require_once( HTMLIFI::$PLUGIN_DIR . 'requests/htmlifi_register_db.php' );
		}
	}
?>