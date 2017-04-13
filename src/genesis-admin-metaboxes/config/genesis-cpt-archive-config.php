<?php
/**
 * Genesis CPT Archive metaboxes.
 *
 * @package ForwardJump\Utility\GenesisAdminMetaboxes
 * @since   0.2.4
 * @author  Tim Jensen
 * @link    https://forwardjump.com/
 * @license GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\GenesisAdminMetaboxes;

/**
 * This is an example config array.
 *
 * 'post_type'      (string) => Post type slug.
 * 'metabox_title'  (string) => Title of the metabox.
 * 'metabox_fields' (array)  => The CMB2 fields that will display within the metabox.
 */
return [
	[
		'post_type'      => 'new-post-type',
		'metabox_title'  => 'Example Metabox',
		'metabox_fields' => [
			[
				'name'    => __( 'Example field', FJ_UTILITY_TEXT_DOMAIN ),
				'id'      => 'example_field',
				'type'    => 'text',
				'default' => false,
			],
		],
	],
];
