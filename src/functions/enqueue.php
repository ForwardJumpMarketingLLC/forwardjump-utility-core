<?php
/**
 * Enqueue Assets
 *
 * @package     ForwardJump\Utility
 * @author      Tim Jensen <tim@forwardjump.com>
 * @license     GNU General Public License 2.0+
 * @link        https://forwardjump.com
 * @since       1.4.0
 */

namespace ForwardJump\Utility;

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\enqueue_admin_scripts' );

function enqueue_admin_scripts() {
	wp_enqueue_style( 'fj-cmb2-admin-styles', FJ_UTILITY_URL . '/assets/css/cmb2-admin-styles.css', [], '0.1.0' );
}
