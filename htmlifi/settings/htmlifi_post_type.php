<?php
	add_action( 'init', 'create_htmlifi_post_type' );
	add_action( 'after_switch_theme', 'my_rewrite_flush' );
	register_activation_hook( __FILE__, 'my_rewrite_flush' );
	
	function create_htmlifi_post_type() {
		$args = array(
			'labels' => array(
				'name'                   => 'HTMLifi',
				'singular_name'          => 'HTMLifi',
				'add_new_item'           => 'Add New HTMLifi',
				'edit_item'              => 'Edit HTMLifi',
				'new_item'               => 'New HTMLifi',
				'view_item'              => 'View HTMLifi',
				'search_items'           => 'Search HTMLifis',
				'not_found'              => 'No htmlifis found',
				'not_found_in_trash'     => 'No htmlifis found in Trash',
				'parent_item_colon'      => 'Parent HTMLifi',
				'all_items'              => 'All HTMLifis',
				'archives'               => 'HTMLifi Archives',
				'insert_into_item'       => 'Insert into htmlifi',
				'uploaded_to_this_item'  => 'Uploaded to this htmlifi'
			),
			'description'           => 'HTMLifi based post type.',
			'menu_position'         => 16,
			'public'                => true,
			'menu_icon'             => '',
			'capability_type'       => array( 'htmlifi', 'htmlifis' ),
			'hierarchical'          => true,
			'has_archive'           => true,
			'map_meta_cap'          => true,
			'show_in_menu'          => 'htmlifi/admin/htmlifi_options.php',
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
			'rewrite' => array( 'slug' => '' )
		);
		
		register_post_type( 'htmlifi', $args );
	}
	
	function my_rewrite_flush() {
		create_htmlifi_post_type();
		flush_rewrite_rules();
	}
?>