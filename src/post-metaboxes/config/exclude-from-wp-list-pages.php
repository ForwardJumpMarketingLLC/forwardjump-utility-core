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
 * 'post_type'      (string) => Post type slug.
 * 'metabox_title'  (string) => Title of the metabox.
 * 'metabox_fields' (array)  => The CMB2 fields that will display within the
 *                              metabox.
 *
 * @see https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Field-Types
 */
return [
	'object_types' => [ 'page' ],
	'title'        => 'Additional Settings',
	'fields'       => [
		[
			'name' => 'Remove from 404 not found page list.',
			'desc' => 'Remove from 404 not found page list.',
			'id'   => 'fj_hide_on_404',
			'type' => 'checkbox',
		],
	],
	'context'      => 'side',
	'priority'     => 'default',
	'show_names'   => false,
	'cmb_styles'   => false,
];
