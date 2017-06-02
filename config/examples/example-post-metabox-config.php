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

/**
 * This is an example config array.
 *
 * 'metabox'  (array) => The CMB2 meta box configuration array.
 * 'fields'   (array) => The CMB2 fields that will display within the meta box.
 *
 * @see https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Field-Types
 */
return [
	[
		'metabox' => [
			'object_types' => [ 'post' ],
			'title'        => 'Example Metabox',
		],
		'fields'       => [
			[
				'name'    => 'Example field',
				'id'      => 'example_field',
				'type'    => 'text',
				'default' => false,
			],
			[
				'name'    => 'Example field 2',
				'id'      => 'example_field_2',
				'type'    => 'text',
				'default' => false,
			],
		],
	],
];
