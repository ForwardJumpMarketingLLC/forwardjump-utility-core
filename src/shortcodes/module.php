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
		'post',
	];

	foreach ( (array) $files as $file ) {
		if ( file_exists( $filepath = FJ_UTILITY_SHORTCODES_DIR . $file . '.php' ) ) {
			include $filepath;
		}
	}
}

autoload();