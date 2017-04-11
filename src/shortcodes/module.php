<?php
/**
 * Shortcodes module.
 *
 * @package     ForwardJump\Utility
 * @since       0.1.3
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\Shortcodes;

if ( ! defined( 'FJ_UTILITY_SHORTCODES_DIR' ) ) {
	define( 'FJ_UTILITY_SHORTCODES_DIR', plugin_dir_path( __FILE__ ) );
}

/**
 * Loads our plugin files.
 *
 * @since 0.1.0
 */
function autoload() {

	$files = [
		'class-add-shortcode',
	];

	foreach ( (array) $files as $file ) {

		$filepath = FJ_UTILITY_SHORTCODES_DIR . $file . '.php';

		if ( file_exists( $filepath ) ) {
			include_once $filepath;
		}
	}
}
autoload();

add_action( 'init', __NAMESPACE__ . '\register_shortcodes' );
/**
 * Register shortcodes.
 *
 * @return void
 */
function register_shortcodes() {

	$config = include FJ_UTILITY_SHORTCODES_DIR . 'config/shortcodes-config.php';
	$config = apply_filters( 'fj_utility_core_shortcodes_config', $config );

	foreach ( (array) $config as $shortcode_config ) {
		new Add_Shortcode( $shortcode_config );
	}
}
