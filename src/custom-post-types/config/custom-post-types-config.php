<?php
/**
 * Custom Post Types Configuration
 *
 * @package     ForwardJump\Utility\CustomPostTypes
 * @since       0.1.1
 * @author      Tim Jensen
 * @link        https://www.timjensen.us
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
		'post_type' => 'portfolio',
		'args'  => [
			'label' => 'Portfolio Label',
			'labels'    => [
				'singular' => 'Portfolio Item',
				'plural' => 'Portfolio Items',
			],
			'public'    => true,
		],
	]
];
