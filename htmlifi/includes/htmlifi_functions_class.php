<?php
	class HTMLIFI_FUNCTIONS {
		function table_name() { 
			global $wpdb;
			return $wpdb->prefix . 'htmlifi';
		}

		function create_customdb() {
			if( sanitize_text_field( get_option( 'htmlifi_dbuser' ) ) !== false ) :
				$htmlifi_dbuser = sanitize_text_field( get_option( 'htmlifi_dbuser' ) );
			else :
				$htmlifi_dbuser = "";
			endif;

			if( sanitize_text_field( get_option( 'htmlifi_dbpass' ) ) !== false ) :
				$htmlifi_dbpass = sanitize_text_field( get_option( 'htmlifi_dbpass' ) );
			else :
				$htmlifi_dbpass = "";
			endif;

			if( sanitize_text_field( get_option( 'htmlifi_dbhost' ) ) !== false ) :
				$htmlifi_dbhost = sanitize_text_field( get_option( 'htmlifi_dbhost' ) );
			else :
				$htmlifi_dbhost = "";
			endif;

			if( sanitize_text_field( get_option( 'htmlifi_dbname' ) ) !== false ) :
				$htmlifi_dbname = sanitize_text_field( get_option( 'htmlifi_dbname' ) );
			else :
				$htmlifi_dbname = "";
			endif;
			
			return $customdb = new wpdb( $htmlifi_dbuser, $htmlifi_dbpass, $htmlifi_dbname, $htmlifi_dbhost );
		}

		function list_of_customdb_tables() {
			$customdb = HTMLIFI::$GLOBALS->customdb;
			$query = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '%s'";

			return $tables = $customdb->get_col( $customdb->prepare( $query, $customdb->dbname ) );
		}

		function sanitize_array( $item ) {
			$new_item = array();
	
			foreach( $item as $key => $value ) :
				$new_item[$key] = sanitize_text_field( $value );
			endforeach;
	
			return $new_item;
		}

		function colnum( $table, $type ) {
			if( $type == 'custom' ) :
				$customdb = HTMLIFI::$GLOBALS->customdb;
				$query = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '%s' AND table_name = '%s'";
				return $customdb->get_var( $customdb->prepare( $query, $customdb->dbname, $table ) );
	
			else :
				global $wpdb;
				$query = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '%s' AND table_name = '%s'";
				return $wpdb->get_var( $wpdb->prepare( $query, $wpdb->dbname, $table ) );
			endif;
		}

		function colnames( $table, $type ) {
			if( $type == 'custom' ) :
				$customdb = HTMLIFI::$GLOBALS->customdb;
				$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '%s' AND table_name = '%s'";
				return $customdb->get_col( $customdb->prepare( $query, $customdb->dbname, $table ) );
			else :
				global $wpdb;
				$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '%s' AND table_name = '%s'";
				return $wpdb->get_col( $wpdb->prepare( $query, $wpdb->dbname, $table ) );
			endif;
		}

		function checkedcols( $table_name, $checked_col ) {
			$all_cols = $this->colnames( $table_name, 'custom' );
			
			foreach( $all_cols as $col ) :
				if( in_array( $col, $checked_col ) ) :
					echo "<td><input name=\"columns[]\" type=\"checkbox\" class=\"columns\" checked=\"checked\" value=\"$col\" /><label>$col</label></td>";
				else :
					echo "<td><input name=\"columns[]\" type=\"checkbox\" class=\"columns\" value=\"$col\" /><label>$col</label></td>";
				endif;
			endforeach;
		}
	
		function _colnames( $table, $type, $post_id ) {
			if( $type == 'custom' ) :
				$database = get_post_custom( $post_id, '', true );
				$database = $database['htmlifi_dbname'][0];
				$customdb = clone HTMLIFI::$GLOBALS->customdb;
				$customdb->__set( 'dbname', $database );
				$customdb->db_connect();
				
				$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '%s' AND table_name = '%s'";
				return $customdb->get_col( $customdb->prepare( $query, $customdb->dbname, $table ) );
			else :
				global $wpdb;
				$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '%s' AND table_name = '%s'";
				return $wpdb->get_col( $wpdb->prepare( $query, $wpdb->dbname, $table ) );
			endif;
		}

		function _checkedcols( $table_name, $checked_col, $post_id ) {
			
			$all_cols = HTMLIFI::$FUNCTIONS->_colnames( $table_name, 'custom', $post_id );

			foreach( $all_cols as $col ) :
				if( in_array( $col, $checked_col ) ) :
					echo "<td><input name=\"columns[]\" type=\"checkbox\" class=\"columns\" checked=\"checked\" value=\"$col\" /><label>$col</label></td>";
				else :
					echo "<td><input name=\"columns[]\" type=\"checkbox\" class=\"columns\" value=\"$col\" /><label>$col</label></td>";
				endif;
			endforeach;
		}

		function outputcol( $table, $colist ) {
			ob_start();
			echo "<thead><tr>";
			foreach( $colist as $col ) { echo "<th data-priority=\"1\">$col</th>"; }
			echo "</tr></thead>";
			return $colum = ob_get_clean();
		}

		function outputrow( $table, $colist, $dbname ) {
			$customdb = HTMLIFI::$GLOBALS->customdb;
			
			if( $customdb->dbname != $dbname ) :
				$customdb = clone HTMLIFI::$GLOBALS->customdb;
				$customdb->__set( 'dbname', $dbname );
				$customdb->db_connect();
			endif;
			
			$colstring = implode( '`, `', $colist );
			$query = "SELECT `$colstring` FROM `$table`";
			$results = $customdb->get_results( $query, ARRAY_N );

			ob_start();
			
			echo '<tbody>';
			
			foreach( $results as $row ) :
				echo '<tr>';
				foreach( $row as $col ) { echo "<td>$col</td>"; }
				echo '</tr>';
			endforeach;
			
			echo '</tbody>';
			
			return $htmlrow = ob_get_clean();
		}
	}
?>