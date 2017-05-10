<?php
/**
 * Shortcodes configuration array.
 *
 * @package     ForwardJump\Utility\Shortcodes
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @link        https://www.timjensen.us
 * @since       0.2.0
 */

namespace ForwardJump\Utility\Shortcodes;

/**
 * Shortcode configuration.
 *
 * @see https://codex.wordpress.org/Function_Reference/add_shortcode
 */
return [
	[
		'tag' => 'recent-posts',
		'args' => [
			'count'     => 1,
			'post_type' => 'post',
		],
		'view' => FJ_UTILITY_SHORTCODES_DIR . 'views/recent-posts.php',
	],
];
