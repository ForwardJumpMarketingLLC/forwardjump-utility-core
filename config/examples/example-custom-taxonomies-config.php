<?php
/**
 * Custom Taxonomies Configuration
 *
 * @package     ForwardJump\Utility\CustomTaxonomies
 * @since       0.1.2
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\CustomTaxonomies\Config;

/**
 * The configuration array for registering custom taxonomies.
 * The args array follows the same format as the Codex except for labels,
 * which are auto generated based upon the values for 'singular' and 'plural'
 *
 * @see https://codex.wordpress.org/Function_Reference/register_taxonomy
 */
return [
	[
		'taxonomy'    => 'example-tax',
		'object_type' => [
			'presidents-message',
			'bps-news',
			'media-watch',
			'political-action',
			'organizing-news',
			'prof-learning',
			'member-news',
			'ebulletin',
		],
		'args'        => [
			'label'        => 'Example Custom Tax',
			'labels'       => [
				'singular' => 'Example Custom Tax',
				'plural'   => 'Example Custom Tax',
			],
			'public'       => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'rewrite'      => [
//				'slug' => 'example-tax',
				'with_front' => true,
				'hierarchical' => true,
			],
		],
	],
];
