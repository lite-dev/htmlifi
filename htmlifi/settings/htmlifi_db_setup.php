<?php
	function table_install() {
		global $wpdb;

		$table_name = HTMLIFI::$GLOBALS->table_name;
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			post_id bigint(20) NOT NULL,
			tables text,
			text longtext,
			columns tinytext,
			custom_table tinytext,
			PRIMARY KEY (post_id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	register_activation_hook( 'htmlifi/htmlifi.php', 'table_install' );
?>