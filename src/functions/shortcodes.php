<?php
/**
 * Shortcodes
 *
 * @package     ForwardJump\Utility
 * @since       1.0.0
 * @author      Tim Jensen
 * @link        https://www.timjensen.us
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility;

add_shortcode( 'recent-posts', __NAMESPACE__ . '\recent_posts_shortcode' );
/**
 * Renders featured posts
 *
 * @param $atts Accepts 'post_type' and 'count'
 *
 * @return string
 */
function recent_posts_shortcode( $atts ) {

	$defaults = [
		'count'    => 1,
		'post_type' => 'post'
	];

	$atts = array_merge( $defaults, $atts );

	$args = [
		'post_type' => $atts['post_type'],
		'posts_per_page'    => $atts['count']
	];

	$recent_posts = query_posts( $args );

	wp_reset_query();

	ob_start();
	foreach ( $recent_posts as $post ) {
		include FJ_UTILITY_DIR . '/src/views/recent-posts.php';
	}

	return ob_get_clean();
}
