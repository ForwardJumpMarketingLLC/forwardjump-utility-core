<?php
/**
 * Post Metaboxes Module
 *
 * @package     ForwardJump\Utility
 * @since       0.4.0
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\PostMetaboxes;

add_action( 'plugins_loaded', __NAMESPACE__ . '\init' );
/**
 * Initializes the post metaboxes.
 *
 * @since 0.4.0
 *
 * @return void
 */
function init() {

	if ( ! is_admin() ) {
		return;
	}

	include_once __DIR__ . '/class-post-metabox.php';
}
