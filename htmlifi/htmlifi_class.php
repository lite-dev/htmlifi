<?php 
	class HTMLIFI {
		public static $PLUGIN_DIR;
		public static $PLUGIN_URL;

		public static $GLOBALS;        //GLOBAL OBJECT
		public static $FUNCTIONS;      //FUNCTION OBJECT

		public static $ADMIN;          //ADMIN OBJECT
		public static $REQUESTS;       //REQUEST OBJECT
		public static $SETTINGS;       //SETTING OBJECT

		function __construct() {
			self::$PLUGIN_DIR = plugin_dir_path( __FILE__ );
			self::$PLUGIN_URL = plugins_url() . '/htmlifi/';
			
			require_once( self::$PLUGIN_DIR . 'htmlifi_template.php' );

			require_once( self::$PLUGIN_DIR . 'includes/htmlifi_globals_class.php' );
			require_once( self::$PLUGIN_DIR . 'includes/htmlifi_functions_class.php' );

			require_once( self::$PLUGIN_DIR . 'admin/htmlifi_admin_class.php' );
			require_once( self::$PLUGIN_DIR . 'requests/htmlifi_requests_class.php' );
			require_once( self::$PLUGIN_DIR . 'settings/htmlifi_settings_class.php' );

			require_once( self::$PLUGIN_DIR . 'uninstall.php' );

			self::$FUNCTIONS = new HTMLIFI_FUNCTIONS;
			self::$GLOBALS = new HTMLIFI_GLOBALS;

			self::$SETTINGS = new HTMLIFI_SETTINGS;
			self::$ADMIN = new HTMLIFI_ADMIN;
			self::$REQUESTS = new HTMLIFI_REQUESTS;
		}
	}
?>