<?php
/*
Plugin Name: wpLinksManager
Plugin URI: http://wordpress.linksmanager.com
Description: This Plugin connects your WordPress blog with your LinksManager account.
Version: 1.0.1
Author: Phillip Chafin
Author URI: http://www.thelastwebmaster.com
*/

/*  Copyright 2008 and Beyond  - LinksManager LLC */

// Here We Go!!

require_once('wpLinksManager.inc.php');

if (class_exists("wpLinksManagerPlugin")){
	$wpLinksManager_pluginSeries = new wpLinksManagerPlugin();
}

//Initialize the admin options
if (!function_exists("wpLinksManagerPlugin_ap")){
	function wpLinksManagerPlugin_ap() {
		global $wpLinksManager_pluginSeries;
		if (!isset($wpLinksManager_pluginSeries)){
			return;
		}
		if (function_exists('add_options_page')){
			add_options_page('LinksManager','LinksManager', 9, basename(__FILE__),
			array(&$wpLinksManager_pluginSeries, 'printAdminPage'));
		}
	}
}

//Actions and Filters
if (isset($wpLinksManager_pluginSeries)){

	//Actions
	add_action('admin_menu','wpLinksManagerPlugin_ap');
	add_action('wp_head', array(&$wpLinksManager_pluginSeries, 'xcss'));
	add_action('activate_wpLinksManager/wpLinksManager.php', array(&$wpLinksManager_pluginSeries, 'init'));

	//Filters
	add_filter('the_content', array(&$wpLinksManager_pluginSeries, 'xreplacewords'));

	register_activation_hook(__FILE__, array(&$wpLinksManager_pluginSeries, 'wplinksmanager_install'));
}
?>