<?php
/**
 * Plugin Name: ForwardJump Utility - CORE
 * Plugin URI: https://bitbucket.org/forwardjump/forwardjump-utility-core
 * Description: This plugin contains your site's custom functionality so that it is theme independent.
 *
 * Version: 0.1.0
 *
 * Author: Tim Jensen
 * Author URI: https://forwardjump.com/
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * Text Domain:     forwardjump-utility
 *
 * BitBucket Plugin URI: https://bitbucket.org/forwardjump/forwardjump-utility-core
 * BitBucket branch: master
 */

namespace ForwardJump\Utility;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

define( 'FJ_UTILITY_TEXT_DOMAIN', 'forwardjump-utility' );
define( 'FJ_UTILITY_DIR', plugin_dir_path( __FILE__ ) );
define( 'FJ_UTILITY_FILE', __FILE__ );

/**
 * Loads our plugin files.
 *
 * @since 0.1.0
 */
function autoload() {

	if ( file_exists( FJ_UTILITY_DIR . '/vendor/cmb2/init.php' ) ) {
		require_once FJ_UTILITY_DIR . '/vendor/cmb2/init.php';
	} elseif ( file_exists( FJ_UTILITY_DIR . '/vendor/CMB2/init.php' ) ) {
		require_once FJ_UTILITY_DIR . '/vendor/CMB2/init.php';
	}

	$files = array(
//		'custom/post-types',
//		'functions/genesis',
		'functions/gravity-forms',
		'functions/helper-functions',
		'functions/apply-settings',
		'functions/sandbox',
//		'functions/shortcodes',
		'custom-post-types/module',
		'settings/module',
	);

	foreach ( $files as $file ) {
		if ( file_exists( $filepath = FJ_UTILITY_DIR . 'src/' . $file . '.php' ) ) {
			include $filepath;
		}
	}
}

autoload();


register_activation_hook( FJ_UTILITY_FILE, __NAMESPACE__ . '\activate_the_plugin' );
/**
 * Initialize the rewrites for our new custom post type
 * upon activation.
 *
 * @since 1.0.0
 *
 * @return void
 */
function activate_the_plugin() {
	flush_rewrite_rules();
}

register_deactivation_hook( FJ_UTILITY_FILE, __NAMESPACE__ . '\deactivate_plugin' );
/**
 * The plugin is deactivating.  Delete out the rewrite rules option.
 *
 * @since 1.0.0
 *
 * @return void
 */
function deactivate_plugin() {
	delete_option( 'rewrite_rules' );
}

register_uninstall_hook( FJ_UTILITY_FILE, __NAMESPACE__ . '\uninstall_plugin' );
/**
 * Plugin is being uninstalled. Clean up after ourselves...silly.
 *
 * @since 1.0.0
 *
 * @return void
 */
function uninstall_plugin() {
	delete_option( 'rewrite_rules' );
}