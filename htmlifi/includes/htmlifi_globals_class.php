<?php
	class HTMLIFI_GLOBALS extends HTMLIFI {
		public $table_name;
		public $customdb;

		function __construct() {
			$this->table_name = HTMLIFI::$FUNCTIONS->table_name();
			$this->customdb = HTMLIFI::$FUNCTIONS->create_customdb();
		}
	}
?>