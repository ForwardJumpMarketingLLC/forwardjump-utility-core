<?php
/**
 * Post metaboxes.
 *
 * @package ForwardJump\Utility\PostMetaboxes
 * @since   0.4.0
 * @author  Tim Jensen
 * @link    https://forwardjump.com/
 * @license GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\PostMetaboxes;

/**
 * This is an example config array.
 *
 * 'post_type'      (string) => Post type slug.
 * 'metabox_title'  (string) => Title of the metabox.
 * 'metabox_fields' (array)  => The CMB2 fields that will display within the
 *                              metabox.
 */
return [
	[
		'object_types' => [ 'post' ],
		'title'        => 'Example Metabox',
		'fields'       => [
			[
				'name'    => __( 'Example field', FJ_UTILITY_TEXT_DOMAIN ),
				'id'      => 'example_field',
				'type'    => 'text',
				'default' => false,
			],
			[
				'name'    => __( 'Example field 2', FJ_UTILITY_TEXT_DOMAIN ),
				'id'      => 'example_field_2',
				'type'    => 'text',
				'default' => false,
			],
		],
	],
];
