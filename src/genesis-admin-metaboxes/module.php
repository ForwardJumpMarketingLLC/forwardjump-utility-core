<?php
/**
 * Genesis Admin Metaboxes Module
 *
 * @package     ForwardJump\Utility
 * @since       0.2.4
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\GenesisAdminMetaboxes;

if ( ! defined( 'FJ_UTILITY_GENESIS_DIR' ) ) {
	define( 'FJ_UTILITY_GENESIS_DIR', dirname( __FILE__ ) );
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\init' );
/**
 * Initializes the Genesis CPT Archive and Theme Settings metaboxes.
 *
 * @since 0.2.4
 *
 * @return void
 */
function init() {

	if ( ! is_admin() ) {
		return;
	}

	include_once FJ_UTILITY_GENESIS_DIR . '/class-genesis-cmb2-admin-metabox.php';
	include_once FJ_UTILITY_GENESIS_DIR . '/class-genesis-cpt-archives-metabox.php';
	include_once FJ_UTILITY_GENESIS_DIR . '/class-genesis-settings-metabox.php';

	do_genesis_settings_metaboxes();
	do_genesis_cpt_archives_metaboxes();
}

/**
 * Instantiate the Genesis Settings Metabox(es)
 *
 * @since 0.2.4
 *
 * @return void
 */
function do_genesis_settings_metaboxes() {

	$config = apply_filters( 'fj_utility_core_genesis_settings_config', null );

	if ( empty( $config ) ) {
		return;
	}

	foreach ( (array) $config as $metabox ) {
		new Genesis_Settings_Metabox( $metabox );
	}
}

/**
 * Instantiate the Genesis CPT Archives Metabox(es)
 *
 * @since 0.2.4
 *
 * @return void
 */
function do_genesis_cpt_archives_metaboxes() {

	$config = apply_filters( 'fj_utility_core_genesis_cpt_archives_config', null );

	if ( empty( $config ) ) {
		return;
	}

	foreach ( (array) $config as $metabox ) {
		new Genesis_CPT_Archives_Metabox( $metabox );
	}
}
