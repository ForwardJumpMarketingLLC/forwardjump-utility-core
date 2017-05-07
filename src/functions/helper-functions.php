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
 * Retrieves all post meta data according to the structure in the $config array.
 *
 * Provides a convenient and more performant alternative to ACF's `get_field()`.
 *
 * This function is especially useful when working with ACF repeater fields and flexible content layouts.
 *
 * @version 1.1.1
 *
 * @param integer $post_id Required. Post ID.
 * @param array   $config  Required. An array that represents the structure of the custom fields.
 *                         Follows the same format as the ACF export field groups array.
 * @param string  $prefix  The necessary meta_key prefix is generated automatically as the function iterates.
 *
 * @return array
 */
function get_all_custom_field_meta( $post_id, $config, $prefix = '' ) {

	$results = array();

	foreach ( $config as $field ) {

		if ( ! isset( $field['name'] ) ) {
			continue;
		}

		$meta_key = $field['name'];

		if ( $prefix ) {
			$meta_key = $prefix . $meta_key;
		}

		$field_value = get_post_meta( $post_id, $meta_key, true );

		if ( isset( $field['layouts'] ) ) { // We're dealing with flexible content layouts.

			// Get array position of the current layout type.
			$layout_keys = array_flip( wp_list_pluck( $field['layouts'], 'name' ) );

			foreach ( $field_value as $key => $layout_row ) {
				$prefix     = $meta_key . "_{$key}_";
				$new_config = $field['layouts'][ $layout_keys[ $layout_row ] ]['sub_fields'];

				$results[] = array_merge(
					[
						'acf_fc_layout' => $layout_row,
					],
					get_all_custom_field_meta( $post_id, $new_config, $prefix )
				);
			}

			// reset.
			$prefix = '';

		} elseif ( isset( $field['sub_fields'] ) ) { // We're dealing with repeater fields.

			for ( $i = 0; $i < $field_value; $i ++ ) {
				$prefix                      = $meta_key . "_{$i}_";
				$new_config                  = $field['sub_fields'];
				$results[ $field['name'] ][] = get_all_custom_field_meta( $post_id, $new_config, $prefix );
			}

			// reset.
			$prefix = '';

		} else {
			$results[ $field['name'] ] = $field_value;
		}
	} // End foreach().

	return $results;
}

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

/**
 * Show an error message to remind admins to make production sites public to search engines,
 * and staging sites hidden from search engines.
 *
 * @since 0.4.2
 *
 * @return void
 */
add_action( 'admin_notices', function () {

	if ( ! get_option( 'blog_public' ) && ! preg_match( '/(dev|staging|localhost)/i', home_url() ) ) {
		?>
		<div class="notice error">
			<p>Search engines are discouraged. If this is a production site, make sure to change the search engine visibility under <a href="/wp-admin/options-reading.php">Reading Settings</a>.</p>
		</div>
		<?php
	} elseif ( get_option( 'blog_public' ) && preg_match( '/(dev|staging|localhost)/i', home_url() ) ) {
		?>
		<div class="notice error">
			<p>Search engines are encouraged. If this is a staging site, make sure to discourage search engine visibility under <a href="/wp-admin/options-reading.php">Reading Settings</a>.</p>
		</div>
		<?php
	}
} );
