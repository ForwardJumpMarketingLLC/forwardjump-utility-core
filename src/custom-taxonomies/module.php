<?php
/**
 * Custom Post Type Module
 *
 * @package     ForwardJump\Utility
 * @since       0.1.2
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\CustomTaxonomies;

if ( ! defined( 'FJ_UTILITY_CUSTOM_TAXONOMIES_DIR' ) ) {
	define( 'FJ_UTILITY_CUSTOM_TAXONOMIES_DIR', plugin_dir_path( __FILE__ ) );
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\init' );
/**
 * Initializes the Taxonomies.
 *
 * @since 0.1.0
 */
function init() {

	include FJ_UTILITY_CUSTOM_TAXONOMIES_DIR . 'class-custom-taxonomies.php';

	$config = include FJ_UTILITY_CUSTOM_TAXONOMIES_DIR . 'config/custom-taxonomies-config.php';

	foreach ( (array) $config as $taxonomy ) {
		new Custom_Taxonomies( $taxonomy );
	}
}