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

return [
	[
		'slug' => 'recent-posts',
		'args' => [
			'count'     => 1,
			'post_type' => 'post',
		],
		'view' => FJ_UTILITY_SHORTCODES_DIR . 'views/recent-posts.php',
	],
];
