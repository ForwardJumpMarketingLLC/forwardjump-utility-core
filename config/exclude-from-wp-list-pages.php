<?php
/**
 * Exclude from `wp_list_pages` metabox.
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
	'metabox' => [
		'object_types' => [ 'page' ],
		'title'        => 'Additional Settings',
		'context'      => 'side',
		'priority'     => 'default',
		'show_names'   => false,
		'cmb_styles'   => false,
	],
	'fields'       => [
		[
			'name' => 'Remove from 404 not found page list.',
			'desc' => 'Remove from 404 not found page list.',
			'id'   => 'fj_hide_on_404',
			'type' => 'checkbox',
		],
	],
];
