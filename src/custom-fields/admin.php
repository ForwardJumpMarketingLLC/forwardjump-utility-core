<?php
/**
 * Adds Custom Fields
 */
namespace ForwardJump\Utility\CustomFields;

add_action( 'cmb2_admin_init', __NAMESPACE__ . '\register_team_members_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function register_team_members_metabox() {
	$prefix = 'fj_';

	$cmb_demo = new_cmb2_box( array(
		'id'           => $prefix . 'team_members_metabox',
		'title'        => esc_html__( 'Team Data', 'cmb2' ),
		'object_types' => array( 'team' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
//		'context'      => 'side',
		'priority'   => 'high',
//		 'show_names' => true, // Show field names on the left
//		 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Job Title', 'cmb2' ),
		'id'               => $prefix . 'job_title',
		'type'             => 'text',
	) );
}

//add_action( 'cmb2_admin_init', __NAMESPACE__ . '\register_byline_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function register_byline_metabox() {
	$prefix = 'fj_';

	$cmb_demo = new_cmb2_box( array(
		'id'           => $prefix . 'edit_screen_side_metabox',
		'title'        => esc_html__( 'Customizations', 'cmb2' ),
		'object_types' => array( 'page', 'post', 'team' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'      => 'side',
		 'priority'   => 'default',
		// 'show_names' => true, // Show field names on the left
//		 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Hide author byline', 'cmb2' ),
		'id'               => $prefix . 'hide_byline',
		'type'             => 'radio_inline',
//		'show_option_none' => 'No Selection',
		'default'           => '0',
		'options'          => array(
			'0' => esc_html__( 'No', 'cmb2' ),
			'1'   => esc_html__( 'Yes', 'cmb2' ),
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Display featured image', 'cmb2' ),
		'id'               => $prefix . 'show_featured_image',
		'type'             => 'radio_inline',
//		'show_option_none' => 'No Selection',
		'default'           => '1',
		'options'          => array(
			'0' => esc_html__( 'No', 'cmb2' ),
			'1'   => esc_html__( 'Yes', 'cmb2' ),
		),
	) );
}