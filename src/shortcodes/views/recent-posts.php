<?php
/**
 * Example shortcode view file.
 *
 * @var $atts
 */
$args = [
	'post_type'      => $atts['post_type'],
	'posts_per_page' => $atts['count'],
];

$recent_posts = new \WP_Query( $args );

foreach ( $recent_posts->posts as $post ) {
	// Output HTML here.
}
