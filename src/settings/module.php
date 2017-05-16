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
	define( 'FJ_UTILITY_SETTINGS_DIR', __DIR__ );
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

	$config = include FJ_UTILITY_SETTINGS_DIR . '/config/settings-config.php';
	$config = apply_filters( 'fj_utility_core_settings_config', $config );

	foreach ( (array) $config as $setting ) {
		( new Settings_Page( $setting ) )->init();
	}
}
