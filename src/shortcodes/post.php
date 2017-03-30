<?php
/**
 * Shortcodes
 *
 * @package     ForwardJump\Utility
 * @since       0.1.3
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\Shortcodes;

add_shortcode( 'recent-posts', __NAMESPACE__ . '\recent_posts_shortcode' );
/**
 * Renders featured posts
 *
 * @param array $atts Accepts 'post_type' and 'count'
 *
 * @return string
 */
function recent_posts_shortcode( $atts ) {

	$defaults = [
		'count'     => 1,
		'post_type' => 'post'
	];

	$atts = array_merge( $defaults, $atts );

	$args = [
		'post_type'      => $atts['post_type'],
		'posts_per_page' => $atts['count'],
	];

	$recent_posts = new \WP_Query( $args );

	wp_reset_postdata();

	ob_start();
	foreach ( $recent_posts->posts as $post ) {
		include FJ_UTILITY_SHORTCODES_DIR . 'views/recent-posts.php';
	}

	return ob_get_clean();
}