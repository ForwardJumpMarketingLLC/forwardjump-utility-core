<?php
/**
 * Term metaboxes.
 *
 * @package ForwardJump\Utility\TermMetaboxes
 * @since   1.1.0
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
			'taxonomies' => [ 'category' ],
			'title'      => 'Featured Image',
			'show_names' => false,
		],
		'fields'  => [
			[
				'name'  => 'Featured Image',
				'id'    => 'featured_image',
				'type'  => 'file',
				'allow' => [ 'attachment' ],
			],
		],
	],
];
