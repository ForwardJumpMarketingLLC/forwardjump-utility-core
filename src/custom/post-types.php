<?php
/**
 * Custom Post Type Handler
 *
 * @package     ForwardJump\Utility
 * @since       1.0.0
 * @author      Tim Jensen
 * @link        https://www.timjensen.us
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility;

add_action( 'init', __NAMESPACE__ . '\register_portfolio_custom_post_type' );
/**
 * Register the custom post type.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_portfolio_custom_post_type() {

	$supports = array(
		'title',
		'editor',
		'author',
		'thumbnail',
		'excerpt',
		'revisions',
		'page-attributes',
		'genesis-cpt-archives-settings'
	);

	$args = array(
		'labels'        => get_post_type_labels_config( 'portfolio', 'Portfolio Item', 'Portfolio Items', $description = 'Portfolio' ),
		'description'   => $description,
		'label'         => __( 'Portfolio', FJ_UTILITY_TEXT_DOMAIN ),
		'public'        => true,
		'supports'      => $supports,
		'menu_icon'     => 'dashicons-format-aside',
		'menu_position' => 5,
		'has_archive'   => true,
	);

	register_post_type( 'portfolio', $args );
}

add_action( 'init', __NAMESPACE__ . '\register_team_custom_post_type' );
/**
 * Register the custom post type.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_team_custom_post_type() {

	$supports = array(
		'title',
		'editor',
		'author',
		'thumbnail',
		'excerpt',
		'revisions',
		'page-attributes',
//		'genesis-cpt-archives-settings'
	);

	$args = array(
		'labels'        => get_post_type_labels_config( 'team', 'Team Member', 'Team Members', $description = 'Team' ),
		'description'   => $description,
		'label'         => __( 'Team', FJ_UTILITY_TEXT_DOMAIN ),
		'public'        => false,
		'show_ui'       => true,
		'supports'      => $supports,
		'menu_icon'     => 'dashicons-groups',
		'menu_position' => 5,
		'has_archive'   => false,
	);

	register_post_type( 'team', $args );
}