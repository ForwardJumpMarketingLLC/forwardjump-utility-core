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
		'taxonomy'    => 'portfolio_tax',
		'object_type' => [
			'post',
			'portfolio',
		],
		'args'        => [
			'label'  => 'Portfolio Tax Label',
			'labels' => [
				'singular' => 'Portfolio Taxonomy',
				'plural'   => 'Portfolio Taxonomies',
			],
			'public' => true,
		],
	],
];
