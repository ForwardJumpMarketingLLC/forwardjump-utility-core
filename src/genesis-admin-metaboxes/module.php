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

	include_once __DIR__ . '/class-genesis-cmb2-admin-metabox.php';
	include_once __DIR__ . '/class-genesis-cpt-archives-metabox.php';
	include_once __DIR__ . '/class-genesis-settings-metabox.php';
}
