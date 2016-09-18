<?php
	function add_my_custom_menu() {
		$capability = 'manage_options';
		$menu_slug = 'htmlifi/admin/htmlifi_options.php';
	
		HTMLIFI::$ADMIN->menu_pages['MAIN'] = add_menu_page ( 
			'HTMLifi', 
			'HTMLifi', 
			$capability, 
			$menu_slug, 
			'', 
			'', 
			3
		);
	
		HTMLIFI::$ADMIN->menu_pages['OPTION'] = add_submenu_page(
			$menu_slug,
			'HTMLIFI Options',
			'HTMLIFI Options',
			$capability,
			'htmlifi/admin/htmlifi_options.php',
			''
		);
		
		HTMLIFI::$ADMIN->menu_pages['CREATOR'] = add_submenu_page(
			$menu_slug,
			'HTMLIFI Create',
			'HTMLIFI Create',
			$capability,
			'htmlifi/admin/htmlifi_creator.php',
			''
		);
	
		HTMLIFI::$ADMIN->menu_pages['EDITOR'] = add_submenu_page(
			$menu_slug,
			'HTMLIFI Editor',
			'HTMLIFI Editor',
			$capability,
			'htmlifi/admin/htmlifi_editor.php',
			''
		);
	}
	
	add_action( 'admin_menu', 'add_my_custom_menu', 9 );
?>