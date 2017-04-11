<?php
/**
 * @var $atts
 */
$args = [
	'post_type'      => $atts['post_type'],
	'posts_per_page' => $atts['count'],
];

$recent_posts = new \WP_Query( $args );

foreach ( $recent_posts->posts as $post ) {
	var_dump( $post );
	echo '////////////////END POST////////////////';

}
