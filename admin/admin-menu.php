<?php
function myslider_add_toplevel_menu() {
	
	/* 
		add_menu_page(
			string   $page_title, 
			string   $menu_title, 
			string   $capability, 
			string   $menu_slug, 
			callable $function = '', 
			string   $icon_url = '', 
			int      $position = null 
		)
	*/
	
	add_menu_page(
		'MyPlugin Settings',
		'MyPlugin',
		'manage_options',
		'myplugin',
		'myplugin_display_settings_page',
		'dashicons-admin-generic',
		null
	);
	
}
add_action( 'admin_menu', 'myslider_add_toplevel_menu' );



// add sub-level administrative menu
function myslider_add_sublevel_menu() {
	
	/*
	
	add_submenu_page(
		string   $parent_slug,
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug,
		callable $function = ''
	);
	
	*/
	
	add_submenu_page(
		'options-general.php',
		'MyPlugin Settings',
		'MyPlugin',
		'manage_options',
		'myplugin',
		'myplugin_display_settings_page'
	);
	
}
add_action( 'admin_menu', 'myslider_add_sublevel_menu' );
