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
	define( 'FJ_UTILITY_SHORTCODES_DIR', __DIR__ . '/' );
}

include_once FJ_UTILITY_SHORTCODES_DIR . 'class-add-shortcode.php';

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
		( new Add_Shortcode( $shortcode_config ) )->init();
	}
}
