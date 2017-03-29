<?php
/**
 * Helper Functions
 *
 * @package     ForwardJump\Utility
 * @since       1.0.0
 * @author      Tim Jensen
 * @link        https://www.timjensen.us
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility;

/**
 * Get the post type labels configuration.
 *
 * @since 1.0.0
 *
 * @param string $post_type
 * @param string $singular_label
 * @param string $plural_label
 * @param string $description
 *
 * @return array
 */
function get_post_type_labels_config( $post_type, $singular_label, $plural_label, $description ) {
	return array(
		'name'               => _x( $plural_label, 'post type general name', FJ_UTILITY_TEXT_DOMAIN ),
		'singular_name'      => _x( $singular_label, 'post type singular name', FJ_UTILITY_TEXT_DOMAIN ),
		'menu_name'          => _x( $description, 'admin menu', FJ_UTILITY_TEXT_DOMAIN ),
		'name_admin_bar'     => _x( $singular_label, 'add new on admin bar', FJ_UTILITY_TEXT_DOMAIN ),
		'add_new'            => _x( 'Add New', $post_type, FJ_UTILITY_TEXT_DOMAIN ),
		'add_new_item'       => __( 'Add New ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
		'new_item'           => __( 'New ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
		'edit_item'          => __( 'Edit ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
		'view_item'          => __( 'View ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
		'all_items'          => __( 'All ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
		'search_items'       => __( 'Search ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
		'parent_item_colon'  => __( 'Parent ' . $singular_label . ':', FJ_UTILITY_TEXT_DOMAIN ),
		'not_found'          => __( 'No ' . $plural_label . ' found.', FJ_UTILITY_TEXT_DOMAIN ),
		'not_found_in_trash' => __( 'No ' . $plural_label . ' found in Trash.', FJ_UTILITY_TEXT_DOMAIN ),
	);
}

/**
 * Retrieves all post meta data according to the structure in the $config array.
 *
 * Provides a convenient and more performant alternative to ACF's `get_field()`.
 *
 * This function is especially useful when working with ACF repeater fields and flexible content layouts.
 *
 * @param integer $post_id Post ID
 * @param array   $config  An array that represents the structure of the custom fields.
 *                         Follows the same format as the ACF export field groups array.
 * @param string  $prefix  The necessary meta_key prefix is generated automatically as the function iterates
 *
 * @return array
 */
function get_all_custom_field_meta( $post_id, $config = [], $prefix = '' ) {

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

			// Get array position of the current layout type
			$layout_keys = array_flip( wp_list_pluck( $field['layouts'], 'name' ) );

			foreach ( $field_value as $key => $layout_row ) {
				$prefix                      = $meta_key . "_{$key}_";
				$new_config                  = $field['layouts'][ $layout_keys[ $layout_row ] ]['sub_fields'];
				$results[ $field['name'] ][] = array_merge( [ 'acf_fc_layout' => $layout_row ], get_all_custom_field_meta( $post_id, $new_config, $prefix ) );
				$prefix                      = ''; // reset
			}

		} elseif ( isset( $field['sub_fields'] ) ) { // We're dealing with repeater fields.

			for ( $i = 0; $i < $field_value; $i ++ ) {
				$prefix                      = $meta_key . "_{$i}_";
				$new_config                  = $field['sub_fields'];
				$results[ $field['name'] ][] = get_all_custom_field_meta( $post_id, $new_config, $prefix );
				$prefix                      = ''; // reset
			}

		} else {
			$results[ $field['name'] ] = $field_value;
		}
	}

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

	$more_link = sprintf( '<a href="%s" class="more-link read-more-link">%s</a>', get_the_permalink( $post->ID ), apply_filters( 'get_post_excerpt_read_more_text', 'Read More' ) );

	return $excerpt . apply_filters( 'get_post_excerpt_read_more_link', $more_link );
}