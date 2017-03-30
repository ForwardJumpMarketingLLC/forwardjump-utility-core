<?php
/**
 * Settings Module
 *
 * @package     ForwardJump\Utility
 * @since       0.1.0
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\Settings;

if ( ! defined( 'FJ_UTILITY_SETTINGS_DIR' ) ) {
	define( 'FJ_UTILITY_SETTINGS_DIR', plugin_dir_path( __FILE__ ) );
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\init' );
/**
 * Initializes the settings page(s).
 *
 * @since 0.1.0
 */
function init() {

	if ( ! is_admin() ) {
		return;
	}

	include FJ_UTILITY_SETTINGS_DIR . 'class-settings.php';

	$config = include FJ_UTILITY_SETTINGS_DIR . 'config/settings-config.php';

	foreach ( (array) $config as $setting ) {
		new Settings_Page( $setting );
	}
}
