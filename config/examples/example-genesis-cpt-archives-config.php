<?php
/**
 * Genesis CPT Archive Settings Meta Box configuration.
 *
 * @package ForwardJump\Utility
 * @since   1.0.0
 * @author  Tim Jensen
 * @link    https://forwardjump.com/
 * @license GNU General Public License 2.0+
 */

/**
 * This is an example config array.
 *
 * 'metabox' (array) => Configuration array to pass to `CMB2()`.
 * 'fields'  (array) => Configuration arrays to pass to
 *                      `CMB2->add_field()`.
 *
 * @see https://github.com/CMB2/CMB2/blob/master/example-functions.php
 *
 * @return array
 */
return [
	[
		'metabox' => [
			'title'        => 'Example Genesis CPT Settings CMB2 meta box', // String. Translation function is handled by the class.
			'object_types' => [ 'example-cpt' ], // Array. CPT slug(s).
			'priority'     => 'high', // 'high' or 'low'.
			'show_names'   => true,
			'closed'       => false,
			'classes'      => 'extra-classes',
		],
		'fields'  => [
			[
				'name'    => 'Example field',
				'id'      => 'example_cmb2_field',
				'type'    => 'text',
			],
			[
				'name'    => 'Example Group',
				'id'      => 'example_group',
				'type'    => 'group',
				'repeatable' => false,
				'options'     => array(
					'group_title'   => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
					'add_button'    => __( 'Add Another Entry', 'cmb2' ),
					'remove_button' => __( 'Remove Entry', 'cmb2' ),
					'sortable'      => true, // beta
					// 'closed'     => true, // true to have the groups closed by default
				),
				'fields'  => [
					[
						'name'    => 'Example group field',
						'id'      => 'example_group_field',
						'type'    => 'text',
						'repeatable' => true,
					],
				],
			],
		],
	],
];
