<?php
/**
 * Custom Post Type Module
 *
 * @package     ForwardJump\Utility
 * @since       0.1.1
 * @author      Tim Jensen
 * @link        https://www.timjensen.us
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\CustomPostTypes;

if ( ! defined( 'FJ_UTILITY_CUSTOM_POST_TYPES_DIR' ) ) {
	define( 'FJ_UTILITY_CUSTOM_POST_TYPES_DIR', plugin_dir_path( __FILE__ ) );
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\init' );
/**
 * Initializes the CPT(s).
 *
 * @since 0.1.0
 */
function init() {

	include FJ_UTILITY_CUSTOM_POST_TYPES_DIR . 'class-custom-post-types.php';

	$config = include FJ_UTILITY_CUSTOM_POST_TYPES_DIR . 'config/custom-post-types-config.php';

	foreach ( (array) $config as $cpt ) {
		new Custom_Post_Types( $cpt );
	}
}