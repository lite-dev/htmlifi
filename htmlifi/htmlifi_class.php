<?php 
	class HTMLIFI {
		public static $PLUGIN_DIR;     //Plugin Directory Path
		public static $PLUGIN_URL;     //Plugin URL Path

		public static $GLOBALS;        //GLOBAL OBJECT
		public static $FUNCTIONS;      //FUNCTION OBJECT

		public static $ADMIN;          //ADMIN OBJECT
		public static $REQUESTS;       //REQUEST OBJECT
		public static $SETTINGS;       //SETTING OBJECT

		function __construct() {
			self::$PLUGIN_DIR = plugin_dir_path( __FILE__ );                                //Initialize Directory Path
			self::$PLUGIN_URL = plugins_url() . '/htmlifi/';                                //Initialize URL Path
			
			require_once( self::$PLUGIN_DIR . 'htmlifi_template.php' );                     //Require Template file

			require_once( self::$PLUGIN_DIR . 'includes/htmlifi_globals_class.php' );       //Require GLOBAL CLASS
			require_once( self::$PLUGIN_DIR . 'includes/htmlifi_functions_class.php' );     //Require FUNCTIONS CLASS

			require_once( self::$PLUGIN_DIR . 'admin/htmlifi_admin_class.php' );            //Require ADMIN CLASS
			require_once( self::$PLUGIN_DIR . 'requests/htmlifi_requests_class.php' );	//Require REQUESTS CLASS
			require_once( self::$PLUGIN_DIR . 'settings/htmlifi_settings_class.php' );	//Require SETTINGS CLASS

			require_once( self::$PLUGIN_DIR . 'uninstall.php' );				//Require Uninstall file

			self::$FUNCTIONS = new HTMLIFI_FUNCTIONS;	//Initialize static FUNCTIONS
			self::$GLOBALS = new HTMLIFI_GLOBALS;		//Initialize static GLOBALS

			self::$SETTINGS = new HTMLIFI_SETTINGS;		//Initialize static SETTINGS
			self::$ADMIN = new HTMLIFI_ADMIN;		//Initialize static ADMIN
			self::$REQUESTS = new HTMLIFI_REQUESTS;		//Initialize static REQUESTS
		}
	}
?>
