<?php
/**
 * Helper Functions
 *
 * @package     ForwardJump\Utility
 * @since       0.1.0
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\Functions;

/**
 * Returns a generated post excerpt of the specified length or the manual excerpt if it has been set.
 *
 * @param int    $post_id     Required. Post ID.
 * @param int    $word_length Optional. Length of the automatic except.
 *                            Does not affect the manual excerpt length.  Defaults to 50.
 * @param string $ellipsis    Optional. Text that appends the excerpt.  Defaults to '...'.
 * @param bool   $more_link   Optional. Includes a link to the singular post.  Defaults to true.
 *
 * @return string
 */
function get_post_excerpt( $post_id, $word_length = 50, $ellipsis = '&hellip;', $more_link = true ) {

	$post = get_post( $post_id );

	if ( $post->post_excerpt ) {

		$excerpt = $post->post_excerpt;
	} else {

		$excerpt = strip_tags( strip_shortcodes( $post->post_content ) );
		$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );

		$words = explode( ' ', $excerpt, $word_length + 1 );

		if ( count( $words ) > $word_length ) {

			array_pop( $words );

			$excerpt = implode( ' ', $words ) . $ellipsis;
		}
	}

	$excerpt = apply_filters( 'get_post_excerpt_excerpt', $excerpt );

	if ( ! $more_link ) {
		return $excerpt;
	}

	$more_link = sprintf( '<a href="%s" class="more-link read-more-link">%s</a>',
		get_the_permalink( $post->ID ),
		apply_filters( 'get_post_excerpt_read_more_text', 'Read More' )
	);

	return $excerpt . apply_filters( 'get_post_excerpt_read_more_link', $more_link );
}
