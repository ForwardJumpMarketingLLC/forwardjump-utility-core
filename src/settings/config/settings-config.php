<?php
/**
 * Settings configuration.
 *
 * @package     ForwardJump\Utility\Settings
 * @since       0.1.0
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\Settings;

/**
 * 'capability'         (string) => The capability required for this menu to be displayed to the user.
 *                                  Defaults to 'manage-options', which is admin level capability.
 *                                  See https://codex.wordpress.org/Roles_and_Capabilities#Capabilities for a list of capabilities.
 * 'menu_page_type'     (string) => Use 'theme' to add our options page to the 'Appearance' menu.
 *                                  Use 'management' to add options page to the 'Tools' menu.
 *                                  Use 'options' to add our options page to the 'Settings' menu.
 *                                  Use 'menu' to add our options page to the main Admin menu.
 *                                  Use 'submenu' to add our options page as a child of another menu. Must also specify
 *                                  'menu_page_parent'.
 *                                  See https://codex.wordpress.org/Administration_Menus for a complete list of possibilities.
 * 'menu_page_parent'   (string) => Required if 'menu_page_type' is set to 'submenu'.
 * 'menu_page_priority' (int)    => Positions the menu.  Defaults to 10.
 * 'menu_page_icon'     (string) => Icon URL. Can use a Dashicons icon name.
 * 'menu_slug'          (string) => Unique page identifier.  This slug appears in the URL.
 * 'menu_title'         (string) => The menu title that displays in the WP Admin menu.
 * 'page_title'         (string) => Title of the options page.
 * 'option_name'        (string) => This is the unique option ID that will be saved in the database.
 * 'option_group'       (string) => Optional. Defaults to 'option_name'.
 * 'metabox_id'         (string) => A unique metabox ID.
 * 'metabox_fields'     (array)  => The CMB2 fields will appear in the options page form.
 * 'view_file'          (string) => Full path to the view file.
 */
return [
	[
		'capability'         => 'manage_options',
		'menu_page_type'     => 'options',
		'menu_page_parent'   => '',
		'menu_page_priority' => 10,
		'menu_page_icon'     => '',
		'menu_slug'          => 'fj-options',
		'menu_title'         => 'FJ Utility Settings',
		'page_title'         => 'ForwardJump Utility Settings',
		'option_name'        => 'fj_options',
		'option_group'       => 'fj_options_group',
		'metabox_id'         => 'fj_settings',
		'metabox_fields'     => [
			[
				'name'    => __( 'Gravity Forms honeypots', FJ_UTILITY_TEXT_DOMAIN ),
				'desc'    => __( 'Force honeypots on all GF forms?', FJ_UTILITY_TEXT_DOMAIN ),
				'id'      => 'gf_honeypot',
				'type'    => 'checkbox',
				'default' => false,
			],
			[
				'name'    => __( 'Gravity Forms hidden labels', FJ_UTILITY_TEXT_DOMAIN ),
				'desc'    => __( 'Enable the option to hide field labels?', FJ_UTILITY_TEXT_DOMAIN ),
				'id'      => 'gf_hidden_labels',
				'type'    => 'checkbox',
				'default' => false,
			],
			[
				'name'    => __( 'Header Scripts', FJ_UTILITY_TEXT_DOMAIN ),
				'desc'    => __( 'Add scripts to be rendered in the page header', FJ_UTILITY_TEXT_DOMAIN ),
				'id'      => 'header_scripts',
				'type'    => 'textarea_code',
				'default' => false,
			],
			[
				'name'    => __( 'Footer Scripts', FJ_UTILITY_TEXT_DOMAIN ),
				'desc'    => __( 'Add scripts to be rendered in the page footer', FJ_UTILITY_TEXT_DOMAIN ),
				'id'      => 'footer_scripts',
				'type'    => 'textarea_code',
				'default' => false,
			],
		],
		'view_file'          => FJ_UTILITY_SETTINGS_DIR . '/views/admin-form.php',
	],
];
