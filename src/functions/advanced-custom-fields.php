<?php
/**
 * Advanced Custom Fields
 *
 * Description
 *
 * @package     ForwardJump\Utility
 * @since       0.1.0
 * @author      Tim Jensen
 * @link        https://www.timjensen.us
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\AdvancedCustomFields;

function deactivate_acf() {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	$plugin_names = [
	        'advanced-custom-fields-pro/acf.php',
    ];

	deactivate_plugins( $plugin_names, true );
}