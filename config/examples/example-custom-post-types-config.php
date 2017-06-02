<?php
/**
 * Custom Post Types Configuration
 *
 * @package     ForwardJump\Utility\CustomPostTypes
 * @since       0.1.1
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\CustomPostTypes\Config;

/**
 * The configuration array for registering custom post types.
 * The args array follows the same format as the Codex except for labels,
 * which are auto generated based upon the values for 'singular' and 'plural'
 *
 * @see https://codex.wordpress.org/Function_Reference/register_post_type
 */
return [
	[
		'post_type' => 'example-cpt',
		'args'      => [
			'labels'        => [
				'singular'  => 'Example CPT',
				'plural'    => 'Example CPT',
				'menu_name' => 'Example CPT'
			],
			'public'        => true,
			'supports'      => [
				'title',
				'editor',
//				'author',
				'thumbnail',
				'excerpt',
				'revisions',
				'genesis-cpt-archives-settings',
			],
			'has_archive'   => true,
			'menu_icon'     => 'dashicons-welcome-write-blog',
			'show_in_rest'  => true,
			'menu_position' => 25,
		],
	],
];
