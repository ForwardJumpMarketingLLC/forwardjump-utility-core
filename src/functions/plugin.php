<?php
/**
 * Plugin activation and deactivation functions.
 *
 * @package     ForwardJump\Utility
 * @author      Tim Jensen <tim@forwardjump.com>
 * @license     GNU General Public License 2.0+
 * @link        https://forwardjump.com
 * @since       0.5.0
 */

namespace ForwardJump\Utility;

register_activation_hook( FJ_UTILITY_FILE, __NAMESPACE__ . '\activate_the_plugin' );
/**
 * Initialize the rewrites for our new custom post type
 * upon activation.
 *
 * @since 0.1.0
 *
 * @return void
 */
function activate_the_plugin() {
	flush_rewrite_rules();
}

register_deactivation_hook( FJ_UTILITY_FILE, __NAMESPACE__ . '\deactivate_plugin' );
/**
 * The plugin deactivation cleanup.
 *
 * @since 0.1.0
 *
 * @return void
 */
function deactivate_plugin() {
	delete_option( 'rewrite_rules' );
}

register_uninstall_hook( FJ_UTILITY_FILE, __NAMESPACE__ . '\uninstall_plugin' );
/**
 * Plugin uninstall cleanup.
 *
 * @since 0.1.0
 *
 * @return void
 */
function uninstall_plugin() {
	delete_option( 'rewrite_rules' );
}
